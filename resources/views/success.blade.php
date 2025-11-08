@extends('layouts.app')

@section('title', 'Paiement réussi')

@section('content')
<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <img src="{{ asset('images/logo3.webp') }}" alt="Logo CINFr" style="width: 150px; height: auto; margin: 0 auto 20px; display: block;">
                    <h1 class="card-title text-success mt-4">✅ Paiement effectué avec succès !</h1>
                    <p class="card-text lead">Merci pour votre paiement. Votre transaction a été traitée avec succès.</p>
                    <p class="card-text">Votre commande est actuellement en cours de traitement.</p>
                    <p class="card-text" id="email-confirmation-message"></p>
                    @if(!empty($receiptUrl))
                    <p class="card-text">
                        <a href="{{ $receiptUrl }}" target="_blank" class="btn btn-primary rounded-pill mt-3">Consulter votre reçu</a>
                        <small class="d-block text-muted mt-2">Votre reçu vous a également été envoyé par e-mail.</small>
                    </p>
                    @endif
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill mt-3">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.addEventListener('load', async () => {
        try {
            const fieldKeys = [
                'type', 'situation_familiale', 'raison', 'departement', 'sexe', 
                'nom_naissance', 'deuxieme_nom', 'prenom1', 'prenom2', 'prenom3', 
                'taille', 'couleur_yeux', 'nationalite', 'date_naissance', 
                'pays_naissance', 'dept_naissance', 'commune_naissance', 
                'pere_inconnu', 'pere_nom', 'pere_prenom1', 'pere_prenom2', 
                'pere_naissance_date', 'pere_naissance_ville', 'pere_nationalite', 
                'mere_inconnue', 'mere_nom', 'mere_prenom1', 'mere_prenom2', 
                'mere_naissance_date', 'mere_naissance_ville', 'mere_nationalite', 
                'nat_naissance_parent_france', 'nat_naissance_parent_ancien', 
                'nat_naissance_parent_francais', 'nat_etranger_parent_francais', 
                'nat_parent_devenu_francais', 'nat_mariage', 'nat_reintegre', 
                'nat_declaration', 'nat_autre', 'nat_autre_texte', 'adresse', 
                'ville', 'code_postal', 'adresse_complement', 'telephone', 'email'
            ];

            const data = {};
            fieldKeys.forEach(key => {
                const value = sessionStorage.getItem(key);
                if (value !== null && value !== '') {
                    data[key] = value;
                }
            });

            const email = sessionStorage.getItem('email'); // Assuming email is stored in sessionStorage
            const emailMessageElement = document.getElementById('email-confirmation-message');
            if (email) {
                emailMessageElement.textContent = `Un e-mail de confirmation a été envoyé à ${email}.`;
            } else {
                emailMessageElement.textContent = `Un e-mail de confirmation a été envoyé.`;
            }

            const urlParams = new URLSearchParams(window.location.search);
            const stripeSessionId = urlParams.get('session_id');

            if (!stripeSessionId) {
                console.error('Session ID manquant dans l’URL');
                return;
            }

            // Vérifie que les données n’ont pas déjà été envoyées
            if (sessionStorage.getItem('data_sent') === 'true') {
                console.log('Données déjà envoyées, on stoppe.');
                return;
            }

            const res = await fetch("/success", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    data: data,
                    stripe_session_id: stripeSessionId
                })
            });

            const json = await res.json();
            console.log('Réponse serveur :', json);

            // Marquer comme déjà envoyé
            sessionStorage.setItem('data_sent', 'true');

        } catch (error) {
            console.error('Erreur JS :', error);
        }
    });
</script>
@endsection
