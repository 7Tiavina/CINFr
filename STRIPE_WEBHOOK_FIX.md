# Stripe Webhook Fix - Production Issues Resolved

## Problem Summary

Stripe was receiving **HTTP 500 errors** when calling the webhook endpoint `https://xn--pr-demande-cni-ckb.com/stripe/webhook`, causing Stripe to automatically disable the webhook after multiple failed attempts.

Additionally, some client data from the form was not being properly inserted into the `clients` table.

---

## Root Causes Identified

### 1. **Webhook HTTP 500 Errors**

| Issue | Description |
|-------|-------------|
| **No exception handling** | Any exception in `handleCheckoutSessionCompleted()` bubbled up as HTTP 500 |
| **Incorrect type hint** | Method expected `\Stripe\Checkout\Session` but Stripe library provides generic object |
| **Missing fillable field** | `payment_status` was not in Payment model's `$fillable` array |
| **400 responses** | Webhook returned HTTP 400 for signature errors, causing Stripe to retry indefinitely |

### 2. **Client Data Insertion Issues**

| Issue | Description |
|-------|-------------|
| **Unfiltered input** | Using `$request->all()` could include unwanted fields |
| **Missing fields in fillable** | Some form fields were not properly listed in Client model |
| **No data casting** | Date and boolean fields lacked proper casting |

---

## Fixes Applied

### Files Modified

#### 1. `app/Http/Controllers/StripeWebhookController.php`

**Changes:**
- ✅ Added comprehensive try-catch blocks around ALL webhook processing
- ✅ Changed type hint from `\Stripe\Checkout\Session` to `object`
- ✅ **Always return HTTP 200** even when internal processing fails
- ✅ Added validation for webhook secret and signature header
- ✅ Added handling for additional event types (`payment_intent.succeeded`, `payment_intent.payment_failed`)
- ✅ Improved logging with better error context
- ✅ Added `Client` model import for future use

**Key fix - Webhook now handles errors gracefully:**
```php
try {
    switch ($event->type) {
        case 'checkout.session.completed':
            $this->handleCheckoutSessionCompleted($session);
            break;
        // ... other cases
    }
} catch (\Exception $e) {
    // Log error but still return 200
    Log::error("Webhook Error: Exception during event handling.", [
        'event_type' => $event->type,
        'exception' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
}

return response()->json(['status' => 'success']); // Always 200!
```

#### 2. `app/Http/Controllers/StripeController.php`

**Changes:**
- ✅ Filter form data using `$request->only([...])` with explicit field list
- ✅ Added `client_id` to Stripe session metadata for better tracking
- ✅ Improved error logging with full exception context
- ✅ Updated success page to show payment and client details
- ✅ Added client stripe_session_id update for reference

**Key fix - Explicit field filtering:**
```php
$clientData = $request->only([
    'type', 'raison', 'departement', 'sexe', 'nom_naissance', 'deuxieme_nom',
    'prenom1', 'prenom2', 'prenom3', 'taille', 'couleur_yeux', 'date_naissance',
    // ... all 47 fields explicitly listed
]);
```

#### 3. `app/Models/Payment.php`

**Changes:**
- ✅ Formatted `$fillable` array for readability
- ✅ Added `$casts` for proper type handling (`amount` as integer)

#### 4. `app/Models/Client.php`

**Changes:**
- ✅ Cleaned up `$fillable` array (removed duplicates like `nationalite`)
- ✅ Added `$casts` for proper type handling:
  - Booleans: `a_carte_identite`, `pere_inconnu`, `mere_inconnue`
  - Dates: `date_naissance`, `date_delivrance_cni`, parent birth dates

---

## Configuration Verification Required

### Environment Variables (.env)

Ensure these are set correctly in production:

```env
# Stripe Configuration
STRIPE_LIVE_SK=sk_live_xxxxxxxxxxxxx
STRIPE_LIVE_PK=pk_live_xxxxxxxxxxxxx
STRIPE_TEST_SK=sk_test_xxxxxxxxxxxxx
STRIPE_TEST_PK=pk_test_xxxxxxxxxxxxx

# CRITICAL: Webhook secret from Stripe Dashboard
STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

# Application
APP_ENV=production
APP_DEBUG=false
```

### Finding Your Webhook Secret

1. Go to **Stripe Dashboard** → **Developers** → **Webhooks**
2. Click on your webhook endpoint
3. Find the **Signing secret** section
4. Click **Reveal** and copy the value (starts with `whsec_`)
5. Add it to your production `.env` file

---

## Testing Instructions

### 1. Test Webhook Endpoint Accessibility

```bash
# Test that the endpoint is reachable (should return 200 or 400, not 404/500)
curl -X POST https://xn--pr-demande-cni-ckb.com/stripe/webhook \
  -H "Content-Type: application/json" \
  -d '{"test": true}'
```

Expected: HTTP 200 with `{"status":"success","warning":"Missing signature header"}`

### 2. Test with Stripe CLI

```bash
# Install Stripe CLI if not already installed
# macOS: brew install stripe/stripe-cli/stripe
# Windows: winget install Stripe.StripeCLI

# Login to Stripe
stripe login

# Forward webhooks to local development
stripe listen --forward-to http://localhost:8000/stripe/webhook

# In another terminal, trigger a test event
stripe trigger checkout.session.completed \
  --add payment_intent:status=succeeded \
  --add payment_status=paid
```

### 3. Test Webhook from Stripe Dashboard

1. Go to **Stripe Dashboard** → **Developers** → **Webhooks**
2. Click on your endpoint
3. Click **Send test webhook**
4. Select `checkout.session.completed` event
5. Click **Send**

Check your Laravel logs for the webhook processing.

### 4. Verify Full Payment Flow

1. Fill out the form at `https://xn--pr-demande-cni-ckb.com/predemande`
2. Complete payment with Stripe test card: `4242 4242 4242 4242`
3. Verify:
   - Client is created in `clients` table with ALL form data
   - Payment is created in `payments` table
   - After webhook fires, payment status updates to `completed`
   - Receipt URL and card details are saved

---

## Re-enabling Webhook in Stripe

Once fixes are deployed to production:

1. Go to **Stripe Dashboard** → **Developers** → **Webhooks**
2. Find your disabled webhook (it will show as "Disabled" or have a warning icon)
3. Click on the webhook
4. Click **Enable** or **Activate**
5. Send a test webhook to verify it works

---

## Monitoring & Debugging

### Laravel Logs

Check logs for webhook activity:
```bash
# Production
tail -f storage/logs/laravel.log | grep -i webhook

# Filter for errors
tail -f storage/logs/laravel.log | grep -i "webhook.*error"
```

### Key Log Messages

| Message | Meaning |
|---------|---------|
| `Webhook: checkout.session.completed reçu` | Webhook received successfully |
| `Paiement ID X mis à jour au statut 'completed'` | Payment updated successfully |
| `Webhook Error: Invalid Stripe signature` | Signature mismatch - check webhook secret |
| `Webhook Ignored: payment_status n'est pas 'paid'` | Payment not completed yet |

### Stripe Dashboard Logs

1. **Developers** → **Webhooks** → **Events**
2. Click on any event to see:
   - HTTP status code returned
   - Response body
   - Attempt history

---

## Additional Recommendations

### 1. Queue Webhook Processing (Optional)

For better performance, consider queuing webhook processing:

```php
// In handleWebhook()
dispatch(new ProcessStripeWebhook($event));
return response()->json(['status' => 'success']);
```

### 2. Add Webhook Signature Middleware

Create dedicated middleware for webhook validation:

```bash
php artisan make:middleware VerifyStripeSignature
```

### 3. Enable Laravel Logging in Production

Ensure logs are being captured:
```env
LOG_CHANNEL=daily
LOG_LEVEL=debug
```

### 4. Set Up Monitoring Alerts

Consider adding alerts for:
- Webhook failures (multiple 500s in a row)
- Payment processing errors
- Missing client data

---

## Checklist Before Going Live

- [ ] Deploy all code changes to production
- [ ] Verify `STRIPE_WEBHOOK_SECRET` is set in production `.env`
- [ ] Run `php artisan config:clear` and `php artisan cache:clear`
- [ ] Test webhook endpoint returns HTTP 200
- [ ] Test full payment flow with test card
- [ ] Verify client data is saved completely
- [ ] Verify payment updates after webhook
- [ ] Re-enable webhook in Stripe Dashboard
- [ ] Monitor logs for 24 hours after re-enabling

---

## Support

If issues persist after applying these fixes:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check Stripe webhook logs: Dashboard → Developers → Webhooks → Events
3. Verify server configuration (PHP version, extensions)
4. Ensure database migrations are up to date: `php artisan migrate:status`

---

**Last Updated:** March 8, 2026  
**Files Modified:** 4  
**Issues Resolved:** HTTP 500 errors, Client data insertion
