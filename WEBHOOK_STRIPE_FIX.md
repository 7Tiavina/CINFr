# Dépannage Webhook Stripe - Emails non envoyés

## Problème constaté
Les emails ne sont pas envoyés après une commande car le webhook Stripe échoue avec l'erreur :
```
Webhook Error: Invalid Stripe signature.
No signatures found matching the expected signature for payload
```

## Solution étape par étape

### 1. Vérifier la configuration du webhook secret

Le `STRIPE_WEBHOOK_SECRET` dans le `.env` doit correspondre EXACTEMENT à celui de Stripe.

#### Sur le dashboard Stripe :
1. Allez sur https://dashboard.stripe.com/test/webhooks (mode test)
2. OU https://dashboard.stripe.com/webhooks (mode production)
3. Cliquez sur votre webhook `https://cinfr.com/stripe/webhook`
4. Dans la section **Signing secret**, cliquez sur **Reveal**
5. Copiez la clé (commence par `whsec_...`)

#### Sur votre serveur :
1. Connectez-vous à votre panneau de contrôle (cPanel, DirectAdmin, etc.)
2. Ouvrez le fichier `.env` à la racine du site
3. Mettez à jour la ligne :
   ```env
   STRIPE_WEBHOOK_SECRET=whsec_votre_vrai_secret_ici
   ```
4. Sauvegardez

### 2. Vider le cache de configuration

Après avoir modifié le `.env`, exécutez :
```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Vérifier l'URL du webhook sur Stripe

Sur le dashboard Stripe, vérifiez que :
- **URL** : `https://cinfr.com/stripe/webhook`
- **Événements** cochés :
  - ✅ `checkout.session.completed`
  - ✅ `payment_intent.succeeded` (optionnel)
  - ✅ `payment_intent.payment_failed` (optionnel)

### 4. Tester le webhook

#### Option A : Refaire un paiement test
1. Allez sur votre site
2. Remplissez le formulaire
3. Payez avec une carte test Stripe :
   - Numéro : `4242 4242 4242 4242`
   - Date : n'importe quelle date future
   - CVC : n'importe quels 3 chiffres
4. Vérifiez les logs après le paiement

#### Option B : Utiliser Stripe CLI (en local uniquement)
```bash
# Installer Stripe CLI
stripe login

# Écouter les webhooks
stripe listen --forward-to https://cinfr.com/stripe/webhook
```

### 5. Vérifier les logs après correction

Les logs doivent montrer :
```
[timestamp] local.INFO: Webhook: checkout.session.completed reçu pour la session cs_test_...
[timestamp] local.INFO: Paiement mis à jour {"payment_id":X,"status":"completed"}
[timestamp] local.INFO: Invoice PDF generated {"path":"...","payment_id":X}
[timestamp] local.INFO: Order confirmation email sent to client {"payment_id":X,"client_email":"..."}
[timestamp] local.INFO: Agent notification email sent successfully {"payment_id":X,"agent_email":"..."}
```

### 6. Problèmes courants

#### a) Secret incorrect
**Symptôme** : `Invalid Stripe signature`
**Solution** : Recopiez exactement le secret depuis le dashboard Stripe

#### b) Cache non vidé
**Symptôme** : La modification du .env n'a pas d'effet
**Solution** : `php artisan config:clear`

#### c) Webhook en mode test vs production
**Symptôme** : Les paiements réels ne déclenchent pas le webhook
**Solution** : Vérifiez que vous utilisez le bon secret :
- Mode test : `whsec_test_...` + cartes de test
- Mode production : `whsec_live_...` + cartes réelles

#### d) URL du webhook incorrecte
**Symptôme** : Stripe ne peut pas atteindre votre serveur
**Solution** : Vérifiez que l'URL est accessible : `https://cinfr.com/stripe/webhook`

### 7. Vérifier que les migrations sont exécutées sur le serveur

```bash
# Sur le serveur
php artisan migrate --force
```

Les tables `clients` et `payments` doivent avoir toutes les colonnes nécessaires.

### 8. Vérifier les permissions de dossier

Le dossier pour les factures PDF doit être accessible en écriture :
```bash
# Sur le serveur
chmod -R 755 storage/app/public/invoices
chown -R www-data:www-data storage/app/public/invoices
```

## Résumé des commandes à exécuter sur le serveur

```bash
# 1. Mettre à jour .env avec le bon STRIPE_WEBHOOK_SECRET
# 2. Vider le cache
php artisan config:clear
php artisan cache:clear

# 3. Exécuter les migrations
php artisan migrate --force

# 4. Vérifier les logs
tail -f storage/logs/laravel.log
```

## Après correction

Testez une nouvelle commande et vérifiez que :
1. ✅ Le paiement Stripe fonctionne
2. ✅ Les logs montrent "checkout.session.completed reçu"
3. ✅ Les logs montrent "Invoice PDF generated"
4. ✅ Les logs montrent "Order confirmation email sent to client"
5. ✅ Les logs montrent "Agent notification email sent successfully"
6. ✅ Le client reçoit l'email avec facture
7. ✅ L'agent reçoit l'email de notification
