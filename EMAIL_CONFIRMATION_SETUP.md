# Email de Confirmation de Commande avec Facture

## Vue d'ensemble

Après chaque paiement réussi via Stripe, un email de remerciement avec la facture en pièce jointe est automatiquement envoyé au client.

## Fichiers créés

### 1. Mailable
- **Fichier** : `app/Mail/OrderConfirmationMail.php`
- **Rôle** : Gère l'envoi de l'email avec pièce jointe PDF

### 2. Templates Email
- **Email HTML** : `resources/views/emails/order_confirmation.blade.php`
- **Facture PDF** : `resources/views/emails/invoice_pdf.blade.php`

### 3. Service
- **Fichier** : `app/Services/InvoiceService.php`
- **Rôle** : Génère le PDF de la facture

### 4. Controller mis à jour
- **Fichier** : `app/Http/Controllers/StripeWebhookController.php`
- **Modification** : Ajout de la méthode `sendOrderConfirmationEmail()` appelée après `handleCheckoutSessionCompleted`

## Fonctionnement

1. Le client effectue un paiement via Stripe
2. Stripe envoie un webhook `checkout.session.completed` à `/stripe/webhook`
3. Le `StripeWebhookController` traite le webhook :
   - Met à jour le statut du paiement à `completed`
   - Récupère les détails de la transaction
   - **Génère la facture PDF** via `InvoiceService`
   - **Envoie l'email de confirmation** avec la facture en pièce jointe

## Configuration requise

### SMTP Gmail (déjà configuré dans .env)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=cinfr.official@gmail.com
MAIL_PASSWORD=votre_mot_de_passe_application
MAIL_FROM_ADDRESS="cinfr.official@gmail.com"
MAIL_FROM_NAME="Contact-CINFr"
```

### Important : Mot de passe d'application Gmail

Pour utiliser Gmail avec Laravel, vous devez :
1. Activer la validation en 2 étapes sur votre compte Google
2. Générer un **mot de passe d'application** dans : https://myaccount.google.com/apppasswords
3. Remplacer `MAIL_PASSWORD` dans le `.env` par ce mot de passe d'application (16 caractères)

## Test local

Pour tester l'envoi d'email en local :

```bash
# Lancer le queue worker (si QUEUE_CONNECTION=database)
php artisan queue:work

# Ou pour un envoi synchrone (QUEUE_CONNECTION=sync)
# Aucun commande supplémentaire nécessaire
```

## Logs

Les logs d'envoi d'email sont disponibles dans `storage/logs/laravel.log` :
- `Invoice PDF generated` : Quand le PDF est généré
- `Order confirmation email sent successfully` : Quand l'email est envoyé
- `Error sending order confirmation email` : En cas d'erreur

## Personnalisation

### Modifier le template d'email
Éditez `resources/views/emails/order_confirmation.blade.php`

### Modifier la facture PDF
Éditez `resources/views/emails/invoice_pdf.blade.php`

### Changer les informations de la facture
Modifiez `app/Services/InvoiceService.php`

## Dépannage

### L'email ne s'envoie pas
1. Vérifiez les logs : `storage/logs/laravel.log`
2. Vérifiez que `MAIL_PASSWORD` est correct dans `.env`
3. Assurez-vous que la validation en 2 étapes est activée sur Gmail
4. Testez la connexion SMTP avec un outil comme Telnet

### Erreur de génération PDF
1. Vérifiez que le dossier `storage/app/public/invoices` existe et est accessible en écriture
2. Vérifiez les permissions du dossier

### Webhook non reçu
1. En local, utilisez Stripe CLI pour tester : `stripe listen --forward-to localhost/stripe/webhook`
2. Vérifiez que `STRIPE_WEBHOOK_SECRET` est correct dans `.env`
