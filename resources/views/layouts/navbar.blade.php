<!-- layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg custom-navbar fixed-top">
  <div style="background-color: #f7f9fc; color: #8c8e91; font-size: 0.8rem; padding: 5px 15px; text-align: center; position: absolute; top: 0; left: 0; right: 0; margin: 0 auto; max-width: 600px; border-radius: 10px;">
    Service d'accompagnement indépendant de l'administration
  </div>

  <a href="{{ route('index') }}" class="navbar-brand">
    <img src="{{ asset('images/logo3.png') }}" alt="Company Logo" class="nav-logo img-fluid">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="icon ion-md-menu"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('mairies') }}">LISTE DES MAIRIES</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownInfo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          INFORMATIONS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownInfo">
          <a class="dropdown-item" href="{{ route('index') }}#cni-documents">Pièces nécessaires</a>
          <a class="dropdown-item" href="{{ route('index') }}#faq">Questions fréquentes</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#testimonials">CONTACTS</a>
      </li>
    </ul>
    <div class="ml-auto">
      <a class="nav-link btn btn-demo-small" href="{{ route('predemande') }}">Pré-Demande en Ligne</a>
    </div>
  </div>
</nav>
