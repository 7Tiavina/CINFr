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
            max-width: 800px;
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
        .content {
            padding: 30px 25px;
            color: #333333;
            line-height: 1.6;
        }
        .recap-title {
            font-size: 18px;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .recap-item {
            margin-bottom: 12px;
            font-size: 14px;
        }
        .recap-item strong {
            color: #555;
            display: inline-block;
            min-width: 220px;
        }
        .recap-item span {
            color: #333;
        }
        .section-divider {
            margin-top: 25px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
            font-weight: 600;
            color: #667eea;
        }
        .order-summary {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
        }
        .order-summary p {
            margin: 8px 0;
            font-size: 14px;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📋 Nouvelle Commande CNI</h1>
            <p>Traitement requis par l'agent</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Order Summary -->
            <div class="order-summary">
                <p><strong>Numéro de commande :</strong> #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Date de paiement :</strong> {{ $payment->updated_at->format('d/m/Y à H:i') }}</p>
                <p><strong>Statut :</strong> <span class="status-badge">{{ strtoupper($payment->payment_status ?? $payment->status) }}</span></p>
                <p><strong>Montant payé :</strong> {{ number_format($payment->amount / 100, 2, ',', ' ') }} €</p>
                <p><strong>Email client :</strong> {{ $client->email }}</p>
            </div>

            <!-- Recap Title -->
            <div class="recap-title">Récapitulatif de vos informations</div>

            <!-- Informations Principales -->
            <div class="section-divider">📝 Informations Principales</div>
            <div class="recap-item"><strong>Type de demande :</strong> <span>{{ ucfirst($client->type ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Situation Familiale :</strong> <span>{{ ucfirst($client->situation_familiale ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Raison de la demande :</strong> <span>{{ ucfirst(str_replace('_', ' ', $client->raison ?? 'N/A')) }}</span></div>
            <div class="recap-item"><strong>Département :</strong> <span>{{ $client->departement ?? 'N/A' }}</span></div>
            <div class="recap-item"><strong>Sexe :</strong> <span>{{ ucfirst($client->sexe ?? 'N/A') }}</span></div>

            <!-- Identité du Demandeur -->
            <div class="section-divider">👤 Identité du Demandeur</div>
            <div class="recap-item"><strong>Nom de naissance :</strong> <span>{{ strtoupper($client->nom_naissance ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Deuxième nom :</strong> <span>{{ strtoupper($client->deuxieme_nom ?? 'N/A') }}</span></div>
            @if($client->deuxieme_nom_origine)
            <div class="recap-item"><strong>Origine du deuxième nom :</strong> <span>{{ ucfirst($client->deuxieme_nom_origine) }}</span></div>
            @endif
            @if($client->mot_devant === 'oui')
            <div class="recap-item"><strong>Mot devant le nom :</strong> <span>oui</span></div>
            <div class="recap-item"><strong>Mot à afficher :</strong> <span>{{ ucfirst($client->mot_a_afficher ?? 'N/A') }}</span></div>
            @endif
            <div class="recap-item"><strong>Prénoms :</strong> <span>{{ ucfirst($client->prenom1 ?? 'N/A') }} @if($client->prenom2) {{ ucfirst($client->prenom2) }} @endif @if($client->prenom3) {{ ucfirst($client->prenom3) }} @endif</span></div>
            @if($client->taille)
            <div class="recap-item"><strong>Taille :</strong> <span>{{ $client->taille }} cm</span></div>
            @endif
            <div class="recap-item"><strong>Couleur des yeux :</strong> <span>{{ ucfirst($client->couleur_yeux ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Date de naissance :</strong> <span>{{ $client->date_naissance ? $client->date_naissance->format('Y-m-d') : 'N/A' }}</span></div>
            <div class="recap-item"><strong>Pays de naissance :</strong> <span>{{ ucfirst($client->pays_naissance ?? 'N/A') }}</span></div>
            @if($client->departement_naissance)
            <div class="recap-item"><strong>Département de naissance :</strong> <span>{{ $client->departement_naissance }}</span></div>
            @endif
            <div class="recap-item"><strong>Commune de naissance :</strong> <span>{{ ucfirst($client->commune_naissance ?? 'N/A') }}</span></div>

            <!-- Nationalité -->
            <div class="section-divider">🌍 Nationalité</div>
            <div class="recap-item"><strong>Nationalité :</strong> <span>{{ ucfirst($client->nationalite ?? 'N/A') }}</span></div>
            @if($client->motif_nationalite)
            <div class="recap-item"><strong>Vous êtes Français(e) car :</strong> <span>{{ ucfirst($client->motif_nationalite) }}</span></div>
            @endif

            <!-- Carte d'identité -->
            <div class="section-divider">🪪 Carte d'identité</div>
            <div class="recap-item"><strong>Possède une CNI :</strong> <span>{{ $client->a_carte_identite ? 'Oui' : 'Non' }}</span></div>
            @if($client->a_carte_identite)
            <div class="recap-item"><strong>Numéro CNI :</strong> <span>{{ $client->numero_cni ?? 'N/A' }}</span></div>
            <div class="recap-item"><strong>Date de délivrance :</strong> <span>{{ $client->date_delivrance_cni ? $client->date_delivrance_cni->format('d/m/Y') : 'N/A' }}</span></div>
            <div class="recap-item"><strong>Lieu de délivrance :</strong> <span>{{ ucfirst($client->lieu_delivrance_cni ?? 'N/A') }}</span></div>
            @endif

            <!-- Père -->
            <div class="section-divider">👨 Informations Père</div>
            <div class="recap-item"><strong>Père inconnu :</strong> <span>{{ $client->pere_inconnu ? 'Oui' : 'Non' }}</span></div>
            @if(!$client->pere_inconnu)
            <div class="recap-item"><strong>Nom du père :</strong> <span>{{ strtoupper($client->nom_naissance_pere ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Prénoms du père :</strong> <span>{{ ucfirst($client->prenom_pere ?? 'N/A') }} @if($client->pere_prenom2) {{ ucfirst($client->pere_prenom2) }} @endif @if($client->pere_prenom3) {{ ucfirst($client->pere_prenom3) }} @endif</span></div>
            <div class="recap-item"><strong>Date de naissance du père :</strong> <span>{{ $client->pere_naissance_date ? \Carbon\Carbon::parse($client->pere_naissance_date)->format('Y-m-d') : 'N/A' }}</span></div>
            <div class="recap-item"><strong>Ville de naissance du père :</strong> <span>{{ ucfirst($client->pere_naissance_ville ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Nationalité du père :</strong> <span>{{ ucfirst($client->pere_nationalite ?? 'N/A') }}</span></div>
            @if($client->pere_pays_naissance)
            <div class="recap-item"><strong>Pays de naissance du père :</strong> <span>{{ ucfirst($client->pere_pays_naissance) }}</span></div>
            @endif
            @endif

            <!-- Mère -->
            <div class="section-divider">👩 Informations Mère</div>
            <div class="recap-item"><strong>Mère inconnue :</strong> <span>{{ $client->mere_inconnue ? 'Oui' : 'Non' }}</span></div>
            @if(!$client->mere_inconnue)
            <div class="recap-item"><strong>Nom de la mère :</strong> <span>{{ strtoupper($client->nom_naissance_mere ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Prénoms de la mère :</strong> <span>{{ ucfirst($client->prenom_mere ?? 'N/A') }} @if($client->mere_prenom2) {{ ucfirst($client->mere_prenom2) }} @endif @if($client->mere_prenom3) {{ ucfirst($client->mere_prenom3) }} @endif</span></div>
            <div class="recap-item"><strong>Date de naissance de la mère :</strong> <span>{{ $client->mere_naissance_date ? \Carbon\Carbon::parse($client->mere_naissance_date)->format('Y-m-d') : 'N/A' }}</span></div>
            <div class="recap-item"><strong>Ville de naissance de la mère :</strong> <span>{{ ucfirst($client->mere_naissance_ville ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Nationalité de la mère :</strong> <span>{{ ucfirst($client->mere_nationalite ?? 'N/A') }}</span></div>
            @if($client->mere_pays_naissance)
            <div class="recap-item"><strong>Pays de naissance de la mère :</strong> <span>{{ ucfirst($client->mere_pays_naissance) }}</span></div>
            @endif
            @endif

            <!-- Adresse -->
            <div class="section-divider">📍 Adresse</div>
            <div class="recap-item"><strong>Adresse :</strong> <span>{{ $client->adresse ?? 'N/A' }}</span></div>
            @if($client->adresse_complement)
            <div class="recap-item"><strong>Complément d'adresse :</strong> <span>{{ $client->adresse_complement }}</span></div>
            @endif
            <div class="recap-item"><strong>Ville :</strong> <span>{{ ucfirst($client->ville ?? 'N/A') }}</span></div>
            <div class="recap-item"><strong>Code postal :</strong> <span>{{ $client->code_postal ?? 'N/A' }}</span></div>
            @if($client->pays)
            <div class="recap-item"><strong>Pays :</strong> <span>{{ ucfirst($client->pays) }}</span></div>
            @endif

            <!-- Coordonnées -->
            <div class="section-divider">📞 Coordonnées</div>
            <div class="recap-item"><strong>Téléphone :</strong> <span>{{ $client->telephone ?? 'N/A' }}</span></div>
            <div class="recap-item"><strong>Email :</strong> <span>{{ $client->email }}</span></div>

            <!-- Documents -->
            <div class="section-divider">📎 Documents joints</div>
            <div class="recap-item"><strong>Photo d'identité :</strong> <span>{{ $client->photo_identite ? '✅ Fournie' : 'Non fournie' }}</span></div>
            <div class="recap-item"><strong>Justificatif de domicile :</strong> <span>{{ $client->justificatif_domicile ? '✅ Fourni' : 'Non fourni' }}</span></div>
            <div class="recap-item"><strong>Acte de naissance :</strong> <span>{{ $client->acte_naissance ? '✅ Fourni' : 'Non fourni' }}</span></div>
            <div class="recap-item"><strong>Autre document :</strong> <span>{{ $client->autre_document ? '✅ Fourni' : 'Non fourni' }}</span></div>
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
