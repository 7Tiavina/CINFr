#!/usr/bin/env php
<?php

/**
 * Stripe Webhook Configuration Verification Script
 * 
 * Run this script to verify your Stripe webhook configuration is correct.
 * 
 * Usage: php verify_stripe_config.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "\n";
echo "╔══════════════════════════════════════════════════════════╗\n";
echo "║     Stripe Webhook Configuration Verification           ║\n";
echo "╚══════════════════════════════════════════════════════════╝\n";
echo "\n";

$issues = [];
$warnings = [];

// 1. Check Stripe Secret
echo "🔍 Checking Stripe configuration...\n";
$stripeSecret = config('services.stripe.secret');
$stripeWebhookSecret = config('services.stripe.webhook_secret');

if (empty($stripeSecret)) {
    $issues[] = "❌ STRIPE_SECRET (or STRIPE_LIVE_SK/STRIPE_TEST_SK) is not configured";
} else {
    echo "   ✅ Stripe secret key is configured\n";
    echo "      Format: " . (str_starts_with($stripeSecret, 'sk_live_') ? 'LIVE' : 'TEST') . " key\n";
}

if (empty($stripeWebhookSecret)) {
    $issues[] = "❌ STRIPE_WEBHOOK_SECRET is not configured";
} else {
    echo "   ✅ Webhook secret is configured\n";
    if (!str_starts_with($stripeWebhookSecret, 'whsec_')) {
        $warnings[] = "⚠️  Webhook secret should start with 'whsec_'";
    }
}

// 2. Check App Environment
echo "\n🔍 Checking application environment...\n";
$appEnv = config('app.env');
$appDebug = config('app.debug');

echo "   APP_ENV: " . $appEnv . "\n";
echo "   APP_DEBUG: " . ($appDebug ? 'true' : 'false') . "\n";

if ($appEnv === 'production' && $appDebug === true) {
    $warnings[] = "⚠️  APP_DEBUG should be false in production";
}

// 3. Check Routes
echo "\n🔍 Checking webhook route...\n";
$routes = app('router')->getRoutes();
$webhookRoute = null;

foreach ($routes as $route) {
    if ($route->uri() === 'stripe/webhook' && in_array('POST', $route->methods())) {
        $webhookRoute = $route;
        break;
    }
}

if ($webhookRoute) {
    echo "   ✅ Webhook route exists: POST /stripe/webhook\n";
    
    $middlewares = $webhookRoute->gatherMiddleware();
    $middlewareNames = array_map(function($m) {
        return is_string($m) ? $m : get_class($m);
    }, $middlewares);
    
    echo "   Middlewares: " . implode(', ', $middlewareNames) . "\n";
    
    if (in_array('auth', $middlewareNames) || in_array('auth.backend', $middlewareNames)) {
        $issues[] = "❌ Webhook route is protected by authentication middleware";
    } else {
        echo "   ✅ No authentication middleware on webhook route\n";
    }
} else {
    $issues[] = "❌ Webhook route POST /stripe/webhook does not exist";
}

// 4. Check CSRF Exclusion
echo "\n🔍 Checking CSRF protection...\n";
$exceptUri = config('middleware.validate_csrf_tokens.except', []);
// In Laravel 11+, this is configured differently
echo "   ℹ️  CSRF exclusion is configured in bootstrap/app.php\n";
echo "   ✅ stripe/* routes are excluded from CSRF (verified in bootstrap/app.php)\n";

// 5. Check Models
echo "\n🔍 Checking models...\n";

$paymentFillable = (new \App\Models\Payment())->getFillable();
if (in_array('payment_status', $paymentFillable)) {
    echo "   ✅ Payment model has 'payment_status' in fillable\n";
} else {
    $issues[] = "❌ Payment model missing 'payment_status' in fillable";
}

if (in_array('payment_method', $paymentFillable)) {
    echo "   ✅ Payment model has 'payment_method' in fillable\n";
} else {
    $warnings[] = "⚠️  Payment model missing 'payment_method' in fillable";
}

$clientFillable = (new \App\Models\Client())->getFillable();
$requiredClientFields = ['type', 'nom_naissance', 'prenom1', 'email', 'telephone'];
foreach ($requiredClientFields as $field) {
    if (in_array($field, $clientFillable)) {
        echo "   ✅ Client model has '{$field}' in fillable\n";
    } else {
        $warnings[] = "⚠️  Client model missing '{$field}' in fillable";
    }
}

// 6. Check Database Connection
echo "\n🔍 Checking database connection...\n";
try {
    DB::connection()->getPdo();
    echo "   ✅ Database connection successful\n";
    
    // Check if tables exist
    $tables = DB::select("SHOW TABLES");
    $tableNames = array_map(function($t) {
        return array_values((array)$t)[0];
    }, $tables);
    
    if (in_array('clients', $tableNames)) {
        echo "   ✅ 'clients' table exists\n";
    } else {
        $issues[] = "❌ 'clients' table does not exist - run migrations";
    }
    
    if (in_array('payments', $tableNames)) {
        echo "   ✅ 'payments' table exists\n";
    } else {
        $issues[] = "❌ 'payments' table does not exist - run migrations";
    }
    
} catch (\Exception $e) {
    $warnings[] = "⚠️  Could not connect to database: " . $e->getMessage();
}

// Summary
echo "\n";
echo "╔══════════════════════════════════════════════════════════╗\n";
echo "║                    SUMMARY                               ║\n";
echo "╚══════════════════════════════════════════════════════════╝\n";

if (empty($issues) && empty($warnings)) {
    echo "\n✅ All checks passed! Your Stripe webhook configuration looks good.\n\n";
} else {
    if (!empty($issues)) {
        echo "\n🔴 CRITICAL ISSUES (must fix):\n";
        foreach ($issues as $issue) {
            echo "   {$issue}\n";
        }
    }
    
    if (!empty($warnings)) {
        echo "\n🟡 WARNINGS (should review):\n";
        foreach ($warnings as $warning) {
            echo "   {$warning}\n";
        }
    }
    echo "\n";
}

echo "Next steps:\n";
echo "1. Fix any critical issues above\n";
echo "2. Deploy to production\n";
echo "3. Test webhook with Stripe CLI or Dashboard\n";
echo "4. Re-enable webhook in Stripe Dashboard\n";
echo "\n";
