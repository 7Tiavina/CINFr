<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture {{ $invoiceNumber }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #667eea;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #667eea;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .invoice-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
        }
        .invoice-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-info table td {
            padding: 5px 0;
        }
        .invoice-info table td:first-child {
            font-weight: bold;
            width: 150px;
        }
        .client-section {
            margin-bottom: 25px;
        }
        .client-section h3 {
            background-color: #667eea;
            color: white;
            padding: 8px 12px;
            margin: 0 0 15px 0;
            font-size: 14px;
            border-radius: 3px;
        }
        .client-info {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .client-info p {
            margin: 5px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        .items-table th {
            background-color: #667eea;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 13px;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .items-table tr:last-child td {
            border-bottom: none;
        }
        .items-table .text-right {
            text-align: right;
        }
        .totals {
            width: 300px;
            margin-left: auto;
            margin-top: 20px;
        }
        .totals table {
            width: 100%;
            border-collapse: collapse;
        }
        .totals td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .totals tr.total-row {
            background-color: #667eea;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        .totals tr.total-row td {
            border-bottom: none;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
        .footer p {
            margin: 5px 0;
        }
        .mentions {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>CINFr</h1>
        <p>Service de pré-demande de Carte Nationale d'Identité</p>
        <p><a href="mailto:service@pré-demande-cni.com">service@pré-demande-cni.com</a></p>
        <p><a href="https://www.cinfr.com">https://www.cinfr.com</a></p>
    </div>

    <!-- Invoice Info -->
    <div class="invoice-info">
        <table>
            <tr>
                <td>Numéro de facture :</td>
                <td>{{ $invoiceNumber }}</td>
            </tr>
            <tr>
                <td>Date d'émission :</td>
                <td>{{ $invoiceDate }}</td>
            </tr>
            <tr>
                <td>Numéro de commande :</td>
                <td>#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td>Statut du paiement :</td>
                <td>{{ strtoupper($payment->payment_status ?? $payment->status) }}</td>
            </tr>
        </table>
    </div>

    <!-- Client Section -->
    <div class="client-section">
        <h3>Informations du client</h3>
        <div class="client-info">
            <p><strong>Nom :</strong> {{ strtoupper($client->nom_naissance ?? 'N/A') }}</p>
            <p><strong>Prénom :</strong> {{ strtoupper($client->prenom1 ?? 'N/A') }}</p>
            @if($client->prenom2)
            <p><strong>Deuxième prénom :</strong> {{ strtoupper($client->prenom2) }}</p>
            @endif
            <p><strong>Email :</strong> {{ $client->email }}</p>
            <p><strong>Adresse :</strong> {{ $client->adresse ?? 'N/A' }}, {{ $client->code_postal ?? 'N/A' }} {{ $client->ville ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th width="60%">Désignation</th>
                <th width="15%">Quantité</th>
                <th width="25%" class="text-right">Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Pré-demande de Carte Nationale d'Identité</strong><br>
                    <small>Type : {{ ucfirst($client->type ?? 'N/A') }}</small>
                </td>
                <td>1</td>
                <td class="text-right">{{ number_format($amount, 2, ',', ' ') }} €</td>
            </tr>
        </tbody>
    </table>

    <!-- Totals -->
    <div class="totals">
        <table>
            <tr>
                <td>Sous-total</td>
                <td class="text-right">{{ number_format($amount, 2, ',', ' ') }} €</td>
            </tr>
            <tr>
                <td>TVA (Non applicable)</td>
                <td class="text-right">0,00 €</td>
            </tr>
            <tr class="total-row">
                <td>Net à payer</td>
                <td class="text-right">{{ number_format($amount, 2, ',', ' ') }} €</td>
            </tr>
        </table>
    </div>

    <!-- Mentions -->
    <div class="mentions">
        <p><strong>Éditeur & informations légales :</strong></p>
        <p><strong>Éditeur :</strong> CINFr — filiale de SETTIS LLC</p>
        <p><strong>Raison sociale :</strong> SETTIS LLC</p>
        <p><strong>Numéro d'enregistrement :</strong> LC014645808</p>
        <p><strong>Forme juridique :</strong> Limited Liability Company (LLC) — États-Unis</p>
        <p><strong>Adresse légale :</strong> 117 South Lexington Street, Ste 100, Harrisonville, MO 64701, United States of America</p>
        <p><strong>Site :</strong> <a href="https://www.cinfr.com">https://www.cinfr.com</a></p>
        <br>
        <p><strong>Mentions légales :</strong></p>
        <p>- TVA non applicable, art. 293 B du CGI</p>
        <p>- Cette facture tient lieu de justificatif de paiement</p>
        <p>- En cas de contestation, merci de nous contacter sous 48h</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>CINFr - Service de pré-demande de CNI</strong></p>
        <p>Email : <a href="mailto:service@pré-demande-cni.com">service@pré-demande-cni.com</a> | Site : <a href="https://www.cinfr.com">https://www.cinfr.com</a></p>
        <p>Cette facture a été générée automatiquement et est valable comme justificatif de paiement.</p>
    </div>
</body>
</html>
