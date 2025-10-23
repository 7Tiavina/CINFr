<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Tableau de Bord Admin') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f4f7f6; /* Light background for content area */
        }
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        .backend-sidebar {
            width: 250px;
            background-color: rgba(255, 255, 255, 0.8); /* Soft white with transparency */
            color: #343a40; /* Dark text for contrast */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Subtle shadow for mirror effect */
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(0,0,0,0.05); /* Light border */
        }
        .backend-logo {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .backend-navbar-brand {
            color: #0444ec; /* Blue for brand */
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 30px;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .backend-navbar-brand:hover {
            color: #212529; /* Darker on hover */
            text-decoration: none;
        }
        .backend-sidebar .nav-item {
            margin-bottom: 10px;
        }
        .backend-sidebar .nav-link {
            color: #343a40; /* Dark text for links */
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 1.1rem;
        }
        .backend-sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.3rem;
        }
        .backend-sidebar .nav-link:hover,
        .backend-sidebar .nav-link.active {
            background-color: #0444ec; /* Primary blue for hover/active */
            color: #ffffff;
        }
        .backend-logout-btn {
            background-color: #dc3545; /* Red for logout */
            color: #ffffff;
            border: none;
            border-radius: 25px; /* Rounded */
            width: 100%;
            padding: 12px 15px;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: auto; /* Pushes to bottom */
            transition: background-color 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .backend-logout-btn:hover {
            background-color: #c82333;
        }
        .backend-logout-btn i {
            margin-right: 10px;
            font-size: 1.3rem;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .backend-footer {
            background-color: rgba(255, 255, 255, 0.8); /* Soft white with transparency */
            color: #343a40; /* Dark text for contrast */
            text-align: center;
            padding: 15px 0;
            font-size: 0.9rem;
            width: 100%;
            box-shadow: 0 -4px 8px rgba(0,0,0,0.05); /* Subtle shadow for mirror effect */
            border-top: 1px solid rgba(0,0,0,0.05); /* Light border */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="backend-sidebar">
            <img src="{{ asset('images/logo3.webp') }}" alt="CINFr Logo" class="backend-logo">
            <a href="#" class="backend-navbar-brand">{{ __('Panneau Admin') }}</a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="icon ion-md-speedometer"></i> {{ __('Tableau de Bord') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}"><i class="icon ion-md-card"></i> {{ __('Paiements') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts.index') }}"><i class="icon ion-md-mail"></i> {{ __('Contacts') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}"><i class="icon ion-md-people"></i> {{ __('Clients') }}</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="backend-logout-btn"><i class="icon ion-md-log-out"></i> {{ __('Déconnexion') }}</button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <footer class="backend-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} CINFr. {{ __('Tous droits réservés.') }}</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>