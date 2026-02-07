@extends('layouts.app')
@php header('Content-Type: text/html; charset=utf-8'); @endphp

<!doctype html>
<html lang="en-US">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="icon" href="images/favicon.webp" type="image/webp">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css" type="text/css" />

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Pré-demande Carte d’Identité (CNI) – Démarches en Ligne</title>
    <meta name="description" content="Pré-demande ou renouvellement de carte d’identité (CNI). Démarches en ligne simples, rapides et sécurisées. Traitement sous 48h.">
    
      <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Service",
          "name": "Pré-demande Carte d’Identité",
          "provider": {
            "@type": "Organization",
            "name": "CINFr",
            "url": "https://cinfr.com"
          },
          "description": "Service d'accompagnement pour la pré-demande de carte d'identité.",
          "areaServed": "France"
        }
        </script>
  </head>

  <body>
@include('layouts.navbar')
<main style="flex-grow: 1;">
  <!-- H E R O -->
  <section id="hero">
  <div id="lottie-bg"></div>
  <div class="container">
    <div class="row align-items-center">
      <!-- Image à gauche (desktop only) -->
      <div class="col-md-5 d-none d-md-flex" id="cinhand-container">
        <img src="images/cinhand.webp"
             loading="lazy"
             class="img-fluid"
             alt="Demo image">
      </div>

      <!-- Lottie + texte à droite -->
      <div class="col-md-7 d-flex flex-row flex-md-column content-box hero-content" style="flex-direction: row !important;">
        <div id="lottie-container" class="mb-3">
          <!-- Lottie ici -->
        </div>
        <div class="hero-text-wrapper text-left">
          <h1 class="hero-title">
            Simplifiez votre<br>
            <span class="primary">pré-demande</span> de<br>
            <span class="primary">carte d’identité</span><br>
            en quelques clics
          </h1>
        </div>


      </div>
    </div>
  </div>
</section>




  <!-- E N D  H E R O -->

<div id="hero-text-portrait-container" class="container text-center mt-4"></div>

<!-- E N D  M A R K E T I N G --> 
<section id="marketing">
  <div class="container">
    <div class="row justify-content-center">

      <!-- MAJEUR -->
      <div class="col-md-5">
        <div class="subscription-box text-center">

          <h2 style="color: #0444ec; font-weight: 700; margin-bottom: 5px;">
            Pour un Majeur
          </h2>

          <span style="font-size: 1.6rem; font-weight: 600; color: #333;">
            {{ config('prix.majeur') }}€
            <span style="font-size: 0.9rem; color: #666; font-weight: normal;">TTC</span>
          </span>

          <p>Traitement Sous 48h</p>

          <picture>
            <source srcset="images/Parents-rafiki.webp" type="image/webp">
            <img src="images/Parents-rafiki.png" alt="Logo CINFr"
                 style="max-width: 100%; height: auto; margin-bottom: 10px;">
          </picture>

          <a href="{{ route('predemande') }}?type=majeur" class="btnfos btnfos-1">
            <svg>
              <rect x="0" y="0" rx="25" ry="25" fill="none" width="100%" height="100%"/>
            </svg>
            Pré-Demande
          </a>
        </div>
      </div>

      <!-- MINEUR -->
      <div class="col-md-5">
        <div class="subscription-box text-center">

          <h2 style="color: #0444ec; font-weight: 700; margin-bottom: 5px;">
            Pour un Mineur
          </h2>

          <span style="font-size: 1.6rem; font-weight: 600; color: #333;">
            {{ config('prix.mineur') }}€
            <span style="font-size: 0.9rem; color: #666; font-weight: normal;">TTC</span>
          </span>

          <p>Traitement Sous 48h</p>

          <picture>
            <source srcset="images/Recess-rafiki.webp" type="image/webp">
            <img src="images/Recess-rafiki.png" alt="Logo CINFr"
                 style="max-width: 100%; height: auto; margin-bottom: 10px;">
          </picture>

          <a href="{{ route('predemande') }}?type=mineur" class="btnfos btnfos-1">
            <svg>
              <rect x="0" y="0" rx="25" ry="25" fill="none" width="100%" height="100%"/>
            </svg>
            Pré-Demande
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- T E S T I M O N I A L S -->
<section id="testimonials">
  <div class="container">
    <div class="title-block">
      <h2 class="wrapped-title">Étapes pour la Pré-demande de Carte Nationale d'Identité</h2>
    </div>
    <div class="row h-100 align-items-center">
      <div class="col-md-4 text-center">
        <h6>Préparation de la Pré-demande</h6>
        <p>Nous réalisons pour vous la pré-demande de votre carte nationale d'identité française via le service en ligne officiel de l'ANTS (Agence Nationale des Titres Sécurisés).</p>
      </div>
      <div class="col-md-4 text-center">
        <h6>Réception et Prise de Rendez-vous</h6>
        <p>Vous recevrez sous 48 heures un récapitulatif complet de votre pré-demande. Munissez-vous de ce document pour prendre rendez-vous auprès de la mairie de votre choix afin de finaliser la procédure.</p>
      </div>
      <div class="col-md-4 text-center">
        <h6>Retrait de votre Carte d'Identité</h6>
        <p>Une fois prête, votre carte nationale d'identité sera disponible au retrait dans un délai dépendant des services de la mairie. La remise s'effectue exclusivement en personne, sur présentation de vos justificatifs.</p>
      </div>
    </div>
  </div>
</section>



  <!-- E N D  T E S T I M O N I A L S -->


         <!-- C R E S T I M O N I A L S -->
<section id="crestimonials">
  <div class="container">
    <div class="title-block text-center">
      <h2>À quoi sert la Carte d'Identité Nationale (CNI)?</h2>

      <p>En France, la carte d'identité est un document officiel qui atteste de l'identité d'une personne. Elle permet également aux citoyens français de voyager sans passeport au sein de l'Union européenne et de l'espace Schengen, avec une durée de validité de 15 ans pour les adultes et de 10 ans pour les mineurs.</p>
    </div>
    <div class="row align-items-center mt-5">
      <div class="col-md-6">
        <picture>
          <source srcset="images/cinstyle.webp" type="image/webp">
          <img src="images/cinstyle.png" alt="Simplified Process" class="img-fluid">
        </picture>
      </div>

      <div class="col-md-6">
        <div class="benefits-box">
          <h3 class="text-primary">CINFr vous aides a:</h3>
          <ul class="benefits-list">
            <li><i class="icon ion-md-checkmark-circle-outline demo"></i> Formuler une pré-demande CNI en quelques clics</li>
            <li><i class="icon ion-md-checkmark-circle-outline demo"></i> La vérification des informations et du traitement de votre demande</li>
            <li><i class="icon ion-md-checkmark-circle-outline demo"></i> La prise de rendez-vous en mairie pour le dépôt de votre dossier</li>
            <li><i class="icon ion-md-checkmark-circle-outline demo"></i>Une fois prête, votre carte d'identité pourra être retirée</li>
          </ul>        
          <a href="{{ route('predemande') }}" class="btnfos btnfos-1">
      <svg>
        <rect x="0" y="0" rx="25" ry="25" fill="none" width="100%" height="100%"/>
      </svg>
    Je fais ma pre-demande
    </a>
        </div>
      </div>
    </div>
  </div>
</section>




  <!-- E N D  M A R K E T I N G -->

  

<!-- I N F O R M A T I O N S - C N I -->
<section id="cni-information">
  <div class="container">
    <div class="title-block text-center">
      <h2>Tout Savoir sur la Carte Nationale d’Identité (CNI)</h2>
      <p>Facilitez vos démarches administratives grâce à ce document indispensable.</p>
    </div>
    <div class="row mt-5">
      <!-- Colonne gauche -->
      <div class="col-md-6">
        <div class="info-box equal-height">
          <h3>Pourquoi la CNI est-elle importante?</h3>
          <p>La Carte Nationale d’Identité (CNI) est un document essentiel dans de nombreux aspects de la vie quotidienne:</p>
          <ul>
            <li><i class="icon ion-md-checkmark-circle"></i> Elle certifie officiellement votre identité et votre nationalité française.</li>
            <li><i class="icon ion-md-checkmark-circle"></i> Indispensable pour des démarches administratives comme:
              <ul>
                <li>Participer à des concours ou examens.</li>
                <li>Effectuer des opérations bancaires.</li>
                <li>S’inscrire auprès de services publics tels que Pôle Emploi.</li>
              </ul>
            </li>
            <li><i class="icon ion-md-checkmark-circle"></i> Document gratuit, généralement délivré sous 20 jours.</li>
          </ul>
          <p class="mt-3">Disposer d’une CNI est facultatif, mais elle facilite grandement vos démarches, que ce soit en France ou à l’étranger.</p>
          
        </div>
      </div>
      <!-- Colonne droite -->
      <div class="col-md-6">
        <div class="info-box equal-height">
          <h3>Comment réaliser une pré-demande gratuitement en ligne?</h3>
          <p>La procédure de pré-demande en ligne est une étape simple et rapide, disponible directement sur le site officiel de l’Agence Nationale des Titres Sécurisés (ANTS). Voici les étapes à suivre pour bénéficier de ce serviceâ¯:</p>
          <ol>
            <li><strong>Connectez-vous au site officiel de l’ANTS :</strong> Rendez-vous sur <a href="https://ants.gouv.fr" target="_blank" class="text-primary">https://ants.gouv.fr</a>, la plateforme officielle et gratuite de l’État français pour gérer vos titres sécurisés.</li>
            <li><strong>Créez un compte utilisateur ou connectez-vous :</strong> Si vous êtes déjà inscrit, connectez-vous avec vos identifiants FranceConnect ou votre compte ANTS. Sinon, suivez les instructions pour créer un compte.</li>
            <li><strong>Remplissez votre pré-demande :</strong> Une fois connecté, choisissez le motif de votre demande, puis renseignez vos informations personnelles, notamment votre état civil et votre nationalité.</li>
            <li><strong>Validez et obtenez votre récapitulatif :</strong> Une fois les informations complétées, vous recevrez un récapitulatif avec un numéro de pré-demande. Ce document sera nécessaire pour finaliser votre demande en mairie.</li>
          </ol>
          <p class="mt-3">Ce service est entièrement gratuit et vous permet de gagner du temps avant votre rendez-vous en mairie. N’oubliez pas d’apporter les documents nécessaires lors de votre passage en mairie pour finaliser la demande.</p>
          <a href="https://ants.gouv.fr" target="_blank" class="btn btn-link">En savoir plus</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- E N D  I N F O R M A T I O N S - C N I -->

  <!-- D E M A N D E - D O C U M E N T S -->
<section id="cni-documents" class="styled-section" >
  <div class="container">
    <div class="title-block text-center">
      <h2>Documents Requis pour la Carte Nationale d'Identité</h2>
      <p>Préparez facilement votre dossier avec notre guide complet pour une demande réussie.</p>
    </div>
    <div class="row mt-5">
      <!-- Colonne gauche : Pour les majeurs -->
      <div class="col-md-6 styled-column">
        <h3><i class="icon ion-md-person"></i> Pour les Majeurs</h3>
        <p>Les documents nécessaires incluent :</p>
        <ul>
          <li><strong>Photos d’identité :</strong> 2 photos récentes (35x45 mm), tête nue, sur fond clair.</li>
          <li><strong>Justificatif de domicile :</strong> Facture récente ou avis d’imposition de moins d’un an.</li>
          <li><strong>Document d’identité :</strong> Passeport ou CNI valide/obsolète depuis moins de 2 ans.</li>
          <li><strong>Nationalité :</strong> Décret de naturalisation ou autre document, si nécessaire.</li>
        </ul>
      </div>
      <!-- Colonne droite : Pour les mineurs -->
      <div class="col-md-6 styled-column">
        <h3><i class="icon ion-md-people"></i> Pour les Mineurs</h3>
        <p>Documents spécifiques à fournir :</p>
        <ul>
          <li><strong>Représentant légal :</strong> Parent ou tuteur avec pièce d’identité.</li>
          <li><strong>Justificatif de tutelle :</strong> Décision de justice (si applicable).</li>
          <li><strong>Justificatif de domicile :</strong> Celui des parents/tuteurs datant de moins d’un an.</li>
          <li><strong>Photos d’identité :</strong> Conformes aux normes officielles.</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- E N D  D E M A N D E - D O C U M E N T S -->

<!-- F A Q Section -->
<section id="faq" class="styled-section">
  <div class="container">
    <div class="title-block text-center">
      <h2>Questions Fréquentes</h2>
      <p>Retrouvez les réponses aux questions les plus fréquentes concernant la carte nationale d’identité.</p>
    </div>
    <div class="faq-list">
      <div class="faq-item">
        <button class="faq-question">Où peut-on voyager avec une CNI ?</button>
        <div class="faq-answer">
          <p>Vous pouvez voyager avec une CNI dans les pays de l’espace Schengen ainsi que certains autres pays acceptant ce document comme justificatif d’identité.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-question">Quelles sont les durées de validité pour une CNI ?</button>
        <div class="faq-answer">
          <p>Pour les majeurs, la CNI est valable 15 ans. Pour les mineurs, elle est valable 10 ans.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-question">Est-il possible de voyager avec une carte d’identité périmée ?</button>
        <div class="faq-answer">
          <p>Cela dépend des pays. Certains pays de l’UE acceptent une carte d’identité périmée depuis moins de 5 ans.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-question">Quel pays refuse la carte d’identité périmée ?</button>
        <div class="faq-answer">
          <p>La plupart des pays hors de l’espace Schengen n’acceptent pas une carte d’identité périmée.</p>
        </div>
      </div>
      <div class="faq-item">
        <button class="faq-question">Quels sont les pays qui acceptent la carte d’identité périmée ?</button>
        <div class="faq-answer">
          <p>Des pays comme la Belgique, l’Italie ou le Luxembourg peuvent accepter une CNI périmée sous conditions.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section contenant une grande image centrée avec une hauteur réduite -->
<section id="grande-image" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 95vh; overflow: hidden;">
  <img src="images/pexels-victorfreitas-1381415.webp" alt="Description de l'image" style="max-width: 140%; height: auto; object-fit: contain; display: block;">
</section>
<p style="font-size:11px;color:#777;margin-top:10px;text-align:center;">
Service indépendant de l'État – Nous ne sommes pas affiliés à l’ANTS. Notre service vous accompagne dans la réalisation de votre pré-demande.
</p>

<button id="scrollTopBtn">
          ↑
        </button>
</main>

  <!--  F O O T E R  -->

  <!--  E N D  F O O T E R  -->
    

    <!-- External JavaScripts -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/lottie-web/build/player/lottie.min.js"></script>



        <script>
  // Sélectionner toutes les questions
  const faqQuestions = document.querySelectorAll('.faq-question');

  // Ajouter un événement de clic à chaque question
  faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
      // Trouver la réponse associée
      const answer = question.nextElementSibling;

      // Basculer l'affichage (visible/invisible)
      if (answer.style.display === 'block') {
        answer.style.display = 'none';
      } else {
        // Fermer toutes les autres réponses
        document.querySelectorAll('.faq-answer').forEach(item => {
          item.style.display = 'none';
        });
        // Afficher la réponse sélectionnée
        answer.style.display = 'block';
      }
    });
  });
</script>


<script>
  let previousScrollPosition = window.pageYOffset;
  const navbar = document.querySelector('.custom-navbar');
  const threshold = 100; // Seuil pour activer l'affichage via le pointeur

  // Gérer le défilement
  window.addEventListener('scroll', () => {
    const currentScrollPosition = window.pageYOffset;

    if (previousScrollPosition > currentScrollPosition) {
      // L'utilisateur défile vers le haut, afficher la navbar
      navbar.style.top = "0";
    } else {
      // L'utilisateur défile vers le bas, cacher la navbar
      navbar.style.top = "-100px"; // Ajustez selon la hauteur de la navbar
    }
    previousScrollPosition = currentScrollPosition;
  });

  // Gérer la position du pointeur
  window.addEventListener('mousemove', (event) => {
    if (event.clientY <= threshold) {
      // Si le pointeur est proche du haut de la page, afficher la navbar
      navbar.style.top = "0";
    }
  });
</script>

<script>
    //Boutons de scroll

  const scrollTopBtn = document.getElementById("scrollTopBtn");
  const footer = document.querySelector("footer");

  window.addEventListener("scroll", () => {
    const footerTop = footer.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    if (window.pageYOffset > 300) {
      scrollTopBtn.style.display = "block";
    } else {
      scrollTopBtn.style.display = "none";
    }

    if (footerTop < windowHeight) {
      scrollTopBtn.style.bottom = (windowHeight - footerTop + 30) + "px";
    } else {
      scrollTopBtn.style.bottom = "30px";
    }
  });

  scrollTopBtn.addEventListener("click", function (e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
</script>


<script>
    lottie.loadAnimation({
        container: document.getElementById('lottie-bg'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '/lotties/Animation - 1745500384634.json'
    });
</script>

<script>
  function toggleCinhand() {
    const cinhand = document.getElementById('cinhand-container');
    if (window.innerWidth < 768) {
      cinhand.style.display = 'none';
    } else {
      cinhand.style.display = 'block';
    }
  }

  window.addEventListener('load', toggleCinhand);
  window.addEventListener('resize', toggleCinhand);
</script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const heroTextWrapper = document.querySelector('.hero-text-wrapper');
    const originalParent = document.querySelector('.hero-content');
    const portraitParent = document.getElementById('hero-text-portrait-container');

    function moveHeroText() {
      if (window.innerWidth < 1100) {
        if (portraitParent && !portraitParent.contains(heroTextWrapper)) {
          portraitParent.appendChild(heroTextWrapper);
        }
      } else {
        if (originalParent && !originalParent.contains(heroTextWrapper)) {
          originalParent.appendChild(heroTextWrapper);
        }
      }
    }

    moveHeroText();
    window.addEventListener('resize', moveHeroText);
  });
</script>


  </body>
</html>