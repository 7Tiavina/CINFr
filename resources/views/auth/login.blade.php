<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .login-container h2 {
            margin-bottom: 25px;
            text-align: center;
            color: #0444ec;
            font-weight: 700;
            font-size: 32px;
        }
        .login-container .form-group {
            margin-bottom: 20px;
        }
        .login-container .form-control {
            border-radius: 25px; /* More rounded */
            border: 1px solid #ced4da;
            padding: 10px 20px;
            font-size: 16px;
        }
        .login-container .form-control:focus {
            border-color: #0444ec;
            box-shadow: 0 0 0 0.2rem rgba(4, 68, 236, 0.25);
        }
        .login-container .btn-primary-custom {
            background-color: #0444ec;
            color: #ffffff;
            border: none;
            border-radius: 25px;
            width: 100%;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative; /* Needed for spinner positioning if not flex item */
        }
        .login-container .btn-primary-custom:hover {
            background-color: #022c99;
            transform: translateY(-2px);
        }
        .login-container .staff-message {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        .login-container .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #ffffff;
            border-radius: 25px;
            width: 100%;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container .btn-secondary-custom:hover {
            background-color: #5a6268;
            border-color: #545b62;
            transform: translateY(-2px);
        }
        .login-container .loading-spinner {
            display: none; /* Hidden by default */
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #fff;
            width: 20px;
            height: 20px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
            margin-left: 10px; /* Space between text and spinner */
        }
        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <p class="staff-message">Cette page est réservée au personnel de CINFR.</p>
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary-custom" id="loginButton">
                <span class="button-text">Se connecter</span>
                <div class="loading-spinner"></div>
            </button>
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
        <a href="/" class="btn-secondary-custom">Retour à l'accueil</a>
    </div>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const loginButton = document.getElementById('loginButton');
            const buttonText = loginButton.querySelector('.button-text');
            const loadingSpinner = loginButton.querySelector('.loading-spinner');
            
            loginButton.setAttribute('disabled', 'disabled');
            buttonText.style.display = 'none'; // Hide the text
            loadingSpinner.style.display = 'block'; // Show the spinner
            loginButton.style.pointerEvents = 'none'; // Prevent further clicks
        });
    </script>
</body>
</html>