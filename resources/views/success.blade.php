<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Paiement réussi</title>
</head>
<body>
  <h1>✅ Paiement effectué avec succès !</h1>

  <script>
    window.addEventListener('load', () => {
      // Récupérer tout le sessionStorage
      const data = {};
      for (let i = 0; i < sessionStorage.length; i++) {
        const key = sessionStorage.key(i);
        data[key] = sessionStorage.getItem(key);
      }

      // Et l'ID de la session Stripe passé en blade
      const stripeSessionId = "{{ $stripeSessionId }}";

      // Envoyer en POST AJAX
      fetch("{{ route('success.store') }}", {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
          data,
          stripe_session_id: stripeSessionId
        })
      })
      .then(res => res.json())
      .then(json => console.log('Enregistré en DB:', json))
      .catch(err => console.error('Erreur enregistrement client:', err));
    });
</script>

</body>
</html>
