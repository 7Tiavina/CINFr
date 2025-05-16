<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Paiement réussi</title>
</head>
<body>
  <h1>✅ Paiement effectué avec succès !</h1>
  @if(!empty($receiptUrl))
  <p>Votre paiement est confirmé. <a href="{{ $receiptUrl }}" target="_blank">Télécharger votre reçu de paiement</a></p>
@endif

    
<script>
window.addEventListener('load', async () => {
    try {
        const data = {};
        for (let i = 0; i < sessionStorage.length; i++) {
            const key = sessionStorage.key(i);
            data[key] = sessionStorage.getItem(key);
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




</body>
</html>
