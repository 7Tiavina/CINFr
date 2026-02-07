<!-- layouts/navbar.blade.php -->

<!-- N A V B A R -->
<nav class="navbar navbar-expand-lg custom-navbar fixed-top">
  <div class="hide-on-portrait-header" style="background-color: #f7f9fc; color: #8c8e91; font-size: 0.9rem; padding: 5px 15px; text-align: center; position: absolute; top: 0; left: 0; right: 0; margin: 0 auto; max-width: 600px; border-radius: 10px; ">
    Service d'accompagnement indépendant de l'administration
  </div>

  <a href="{{ route('index') }}" class="navbar-brand">
    <picture>
      <source srcset="{{ asset('images/logo3.webp') }}" type="image/webp">
      <img src="{{ asset('images/logo3.png') }}" alt="Company Logo" class="nav-logo img-fluid" width="230" height="125.219">
    </picture>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="icon ion-md-menu"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link svg-underline" href="{{ route('mairies') }}">
          LISTE DES MAIRIES
          <svg class="underline" viewBox="0 0 120 4" preserveAspectRatio="none">
            <path d="M0,2 L120,2"/>
          </svg>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link svg-underline d-flex align-items-center" href="#" id="navbarDropdownInfo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          INFORMATIONS
          <svg class="underline" viewBox="0 0 120 4" preserveAspectRatio="none">
            <path d="M0,2 L120,2"/>
          </svg>
          <span class="dropdown-arrow">&#9662;</span>
        </a>
        <div class="dropdown-menu animated-dropdown" aria-labelledby="navbarDropdownInfo">
          <a class="dropdown-item" href="{{ route('index') }}#cni-documents">Pièces nécessaires</a>
          <a class="dropdown-item" href="{{ route('index') }}#faq">Questions fréquentes</a>
        </div>
      </li>




      <li class="nav-item">
        <a class="nav-link svg-underline" href="{{ route('contact') }}">
          CONTACTS
          <svg class="underline" viewBox="0 0 120 4" preserveAspectRatio="none">
            <path d="M0,2 L120,2"/>
          </svg>
        </a>
      </li>
    </ul>
    <div>
  <a class="nav-link btn btn-wave" href="{{ route('predemande') }}">
    <span style="--i:0">P</span><span style="--i:1">r</span><span style="--i:2">é</span><span style="--i:3">-</span>
    <span style="--i:4">D</span><span style="--i:5">e</span><span style="--i:6">m</span><span style="--i:7">a</span><span style="--i:8">n</span><span style="--i:9">d</span><span style="--i:10">e</span>
    <span style="--i:11">&nbsp;</span>
    <span style="--i:12">e</span><span style="--i:13">n</span><span style="--i:14">&nbsp;</span>
    <span style="--i:15">L</span><span style="--i:16">i</span><span style="--i:17">g</span><span style="--i:18">n</span><span style="--i:19">e</span>
  </a>
</div>

  </div>
</nav>

<!-- E N D  N A V B A R -->