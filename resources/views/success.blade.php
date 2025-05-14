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
          const data = {};
          for (let i = 0; i < sessionStorage.length; i++) {
            const key = sessionStorage.key(i);
            data[key] = sessionStorage.getItem(key);
          }

          fetch("{{ route('success.store') }}", {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ data })
          })
          .then(res => {
            if (!res.ok) throw new Error(res.statusText);
            return res.json();
          })
          .then(json => console.log('Enregistré en DB:', json))
          .catch(err => console.error('Erreur enregistrement client:', err));
        });
</script>
</body>
</html>
