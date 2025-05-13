<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Page de paiement Stripe</h1>
    <form method="POST" action="{{ route('test') }}">
        @csrf
        <button type="submit">Payer 39,00 €</button>
    </form>
</body>
</html>
