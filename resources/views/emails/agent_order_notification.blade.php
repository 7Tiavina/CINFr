<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande CNI - Traitement requis</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        .header p {
            color: #e0e0e0;
            margin: 10px 0 0 0;
            font-size: 14px;
        }
        .alert-banner {
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 15px 20px;
            margin: 20px;
            border-radius: 4px;
        }
        .alert-banner p {
            margin: 0;
            color: #856404;
            font-size: 14px;
            font-weight: 600;
        }
        .content {
            padding: 30px 25px;
            color: #333333;
            line-height: 1.6;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 15px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .info-row {
            display: table-row;
        }
        .info-row:nth-child(even) {
            background-color: #f8f9fa;
        }
        .info-cell {
            display: table-cell;
            padding: 10px 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 13px;
            vertical-align: top;
        }
        .info-cell:first-child {
            width: 40%;
            font-weight: 600;
            color: #555;
        }
        .info-cell:last-child {
            color: #333;
        }
        .empty-value {
            color: #999;
            font-style: italic;
        }
        .order-summary {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 25px;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary td {
            padding: 8px 0;
            font-size: 14px;
        }
        .order-summary td:first-child {
            font-weight: 600;
            color: #555;
            width: 150px;
        }
        .status-badge {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 25px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .footer p {
            margin: 8px 0;
            font-size: 13px;
            color: #777777;
        }
        .action-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            margin: 15px 0;
        }
        .yes { color: #28a745; font-weight: 600; }
        .no { color: #dc3545; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📋 Nouvelle Commande CNI</h1>
            <p>Traitement requis par l'agent</p>
        </div>

        <!-- Alert Banner -->
        <div class="alert-banner">
            <p>⚠️ Nouvelle commande à traiter - Veuillez vérifier les informations et procéder au traitement du dossier</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Order Summary -->
            <div class="order-summary">
                <table>
                    <tr>
                        <td>Numéro de commande :</td>
                        <td><strong>#{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                    </tr>
                    <tr>
                        <td>Date de paiement :</td>
                        <td>{{ $payment->updated_at->format('d/m/Y à H:i') }}</td>
                    </tr>
                    <tr>
                        <td>Statut :</td>
                        <td><span class="status-badge">{{ strtoupper($payment->payment_status ?? $payment->status) }}</span></td>
                    </tr>
                    <tr>
                        <td>Montant payé :</td>
                        <td><strong>{{ number_format($payment->amount / 100, 2, ',', ' ') }} €</strong></td>
                    </tr>
                    <tr>
                        <td>Email client :</td>
                        <td>{{ $client->email }}</td>
                    </tr>
                </table>
            </div>

            <!-- Informations Principales -->
            <div class="section">
                <div class="section-title">📝 Informations Principales</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Type de demande</div>
                        <div class="info-cell">{{ ucfirst($client->type ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Raison</div>
                        <div class="info-cell">{{ ucfirst($client->raison ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Département</div>
                        <div class="info-cell">{{ $client->departement ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Sexe</div>
                        <div class="info-cell">{{ strtoupper($client->sexe ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Situation familiale</div>
                        <div class="info-cell">{{ ucfirst($client->situation_familiale ?? 'N/A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Identité du Demandeur -->
            <div class="section">
                <div class="section-title">👤 Identité du Demandeur</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Nom de naissance</div>
                        <div class="info-cell">{{ strtoupper($client->nom_naissance ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Deuxième nom</div>
                        <div class="info-cell">{{ strtoupper($client->deuxieme_nom ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Origine du deuxième nom</div>
                        <div class="info-cell">{{ $client->deuxieme_nom_origine ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Mot devant le nom</div>
                        <div class="info-cell">{{ $client->mot_devant ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Mot à afficher</div>
                        <div class="info-cell">{{ $client->mot_a_afficher ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 1</div>
                        <div class="info-cell">{{ ucfirst($client->prenom1 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 2</div>
                        <div class="info-cell">{{ ucfirst($client->prenom2 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 3</div>
                        <div class="info-cell">{{ ucfirst($client->prenom3 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Taille</div>
                        <div class="info-cell">{{ $client->taille ?? 'N/A' }} cm</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Couleur des yeux</div>
                        <div class="info-cell">{{ ucfirst($client->couleur_yeux ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Date de naissance</div>
                        <div class="info-cell">{{ $client->date_naissance ? $client->date_naissance->format('d/m/Y') : 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Pays de naissance</div>
                        <div class="info-cell">{{ ucfirst($client->pays_naissance ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Département de naissance</div>
                        <div class="info-cell">{{ $client->departement_naissance ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Commune de naissance</div>
                        <div class="info-cell">{{ ucfirst($client->commune_naissance ?? 'N/A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Adresse -->
            <div class="section">
                <div class="section-title">📍 Adresse</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Adresse</div>
                        <div class="info-cell">{{ $client->adresse ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Complément d'adresse</div>
                        <div class="info-cell">{{ $client->adresse_complement ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Code postal</div>
                        <div class="info-cell">{{ $client->code_postal ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Ville</div>
                        <div class="info-cell">{{ ucfirst($client->ville ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Pays</div>
                        <div class="info-cell">{{ ucfirst($client->pays ?? 'N/A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Coordonnées -->
            <div class="section">
                <div class="section-title">📞 Coordonnées</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Email</div>
                        <div class="info-cell">{{ $client->email }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Téléphone</div>
                        <div class="info-cell">{{ $client->telephone ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Nationalité -->
            <div class="section">
                <div class="section-title">🌍 Nationalité</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Nationalité</div>
                        <div class="info-cell">{{ ucfirst($client->nationalite ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Motif</div>
                        <div class="info-cell">{{ ucfirst($client->motif_nationalite ?? 'N/A') }}</div>
                    </div>
                </div>
            </div>

            <!-- Carte d'identité -->
            <div class="section">
                <div class="section-title">🪪 Carte d'identité</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Possède une CNI</div>
                        <div class="info-cell">{{ $client->a_carte_identite ? '<span class="yes">Oui</span>' : '<span class="no">Non</span>' }}</div>
                    </div>
                    @if($client->a_carte_identite)
                    <div class="info-row">
                        <div class="info-cell">Numéro CNI</div>
                        <div class="info-cell">{{ $client->numero_cni ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Date de délivrance</div>
                        <div class="info-cell">{{ $client->date_delivrance_cni ? $client->date_delivrance_cni->format('d/m/Y') : 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Lieu de délivrance</div>
                        <div class="info-cell">{{ ucfirst($client->lieu_delivrance_cni ?? 'N/A') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Père -->
            <div class="section">
                <div class="section-title">👨 Informations Père</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Père inconnu</div>
                        <div class="info-cell">{{ $client->pere_inconnu ? '<span class="yes">Oui</span>' : '<span class="no">Non</span>' }}</div>
                    </div>
                    @if(!$client->pere_inconnu)
                    <div class="info-row">
                        <div class="info-cell">Nom</div>
                        <div class="info-cell">{{ strtoupper($client->nom_naissance_pere ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 1</div>
                        <div class="info-cell">{{ ucfirst($client->prenom_pere ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 2</div>
                        <div class="info-cell">{{ ucfirst($client->pere_prenom2 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 3</div>
                        <div class="info-cell">{{ ucfirst($client->pere_prenom3 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Date de naissance</div>
                        <div class="info-cell">{{ $client->pere_naissance_date ? \Carbon\Carbon::parse($client->pere_naissance_date)->format('d/m/Y') : 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Ville de naissance</div>
                        <div class="info-cell">{{ ucfirst($client->pere_naissance_ville ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Nationalité</div>
                        <div class="info-cell">{{ ucfirst($client->pere_nationalite ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Pays de naissance</div>
                        <div class="info-cell">{{ ucfirst($client->pere_pays_naissance ?? 'N/A') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Mère -->
            <div class="section">
                <div class="section-title">👩 Informations Mère</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Mère inconnue</div>
                        <div class="info-cell">{{ $client->mere_inconnue ? '<span class="yes">Oui</span>' : '<span class="no">Non</span>' }}</div>
                    </div>
                    @if(!$client->mere_inconnue)
                    <div class="info-row">
                        <div class="info-cell">Nom</div>
                        <div class="info-cell">{{ strtoupper($client->nom_naissance_mere ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 1</div>
                        <div class="info-cell">{{ ucfirst($client->prenom_mere ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 2</div>
                        <div class="info-cell">{{ ucfirst($client->mere_prenom2 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Prénom 3</div>
                        <div class="info-cell">{{ ucfirst($client->mere_prenom3 ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Date de naissance</div>
                        <div class="info-cell">{{ $client->mere_naissance_date ? \Carbon\Carbon::parse($client->mere_naissance_date)->format('d/m/Y') : 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Ville de naissance</div>
                        <div class="info-cell">{{ ucfirst($client->mere_naissance_ville ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Nationalité</div>
                        <div class="info-cell">{{ ucfirst($client->mere_nationalite ?? 'N/A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Pays de naissance</div>
                        <div class="info-cell">{{ ucfirst($client->mere_pays_naissance ?? 'N/A') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Documents -->
            <div class="section">
                <div class="section-title">📎 Documents joints (à vérifier dans l'espace admin)</div>
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-cell">Photo d'identité</div>
                        <div class="info-cell">{{ $client->photo_identite ? '✅ Fournie' : '<span class="empty-value">Non fournie</span>' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Justificatif de domicile</div>
                        <div class="info-cell">{{ $client->justificatif_domicile ? '✅ Fourni' : '<span class="empty-value">Non fourni</span>' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Acte de naissance</div>
                        <div class="info-cell">{{ $client->acte_naissance ? '✅ Fourni' : '<span class="empty-value">Non fourni</span>' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-cell">Autre document</div>
                        <div class="info-cell">{{ $client->autre_document ? '✅ Fourni' : '<span class="empty-value">Non fourni</span>' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>CINFr - Espace Agent</strong></p>
            <p>Cet email contient toutes les informations nécessaires pour traiter la commande.</p>
            <p style="margin-top: 15px; font-size: 11px; color: #999;">
                La facture du client est jointe à cet email pour référence.
            </p>
        </div>
    </div>
</body>
</html>
