<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande - CINFr</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            color: #667eea;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            margin-bottom: 25px;
        }
        .order-details {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .order-details h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 16px;
        }
        .order-details p {
            margin: 8px 0;
            font-size: 14px;
        }
        .order-details strong {
            color: #333;
        }
        .attachment-info {
            background-color: #e8f4f8;
            border: 1px dashed #667eea;
            padding: 15px;
            border-radius: 4px;
            margin: 25px 0;
            text-align: center;
        }
        .attachment-info p {
            margin: 0;
            color: #555;
            font-size: 14px;
        }
        .attachment-info strong {
            color: #667eea;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 35px;
            border-radius: 25px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 8px 0;
            font-size: 13px;
            color: #777777;
        }
        .footer .contact {
            margin-top: 15px;
            font-size: 12px;
        }
        .success-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('images/logo3.webp') }}" alt="CINFr Logo">
            <h1>Merci pour votre confiance !</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="success-icon">✅</div>
            
            <div class="greeting">
                Bonjour {{ $client->prenom1 ?? $client->nom_naissance ?? 'Cher client' }},
            </div>

            <div class="message">
                Nous vous remercions d'avoir choisi <strong>CINFr</strong> pour votre demande de Carte Nationale d'Identité.
                <br><br>
                Votre paiement a été traité avec succès et votre dossier est maintenant en cours de traitement par nos services.
            </div>

            <!-- Order Details -->
            <div class="order-details">
                <h3>📋 Récapitulatif de votre commande</h3>
                <p><strong>Numéro de commande :</strong> #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Type de demande :</strong> {{ ucfirst($client->type ?? 'N/A') }}</p>
                <p><strong>Montant payé :</strong> {{ number_format($payment->amount / 100, 2, ',', ' ') }} €</p>
                <p><strong>Date de paiement :</strong> {{ $payment->updated_at->format('d/m/Y à H:i') }}</p>
                <p><strong>Email :</strong> {{ $client->email }}</p>
            </div>

            <!-- Attachment Info -->
            <div class="attachment-info">
                <p>📎 <strong>Votre facture est jointe à cet email</strong></p>
                <p style="margin-top: 8px; font-size: 13px;">Vous la trouverez en pièce jointe au format PDF.</p>
            </div>

            <div style="text-align: center;">
                <a href="{{ config('app.url') }}" class="cta-button">Accéder à mon espace</a>
            </div>

            <div class="message" style="margin-top: 30px; font-size: 14px; color: #666;">
                <p>Nos équipes examineront votre dossier dans les plus brefs délais. Vous recevrez un email de confirmation lorsque votre carte sera prête à être retirée.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>CINFr - Service de pré-demande de CNI</strong></p>
            <p class="contact">
                📧 service@pré-demande-cni.com<br>
                📞 Disponible du Lundi au Vendredi, 9h00 - 17h00
            </p>
            <p style="margin-top: 20px; font-size: 11px; color: #999;">
                Cet email a été envoyé automatiquement. Merci de ne pas y répondre directement.
            </p>
        </div>
    </div>
</body>
</html>
