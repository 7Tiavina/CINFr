@extends('layouts.app')
@php header('Content-Type: text/html; charset=utf-8'); @endphp
 
{{-- ============================================================
     SEO META — à placer dans layouts/app.blade.php ou via @push
     ============================================================ --}}
@section('seo')
  <title>Pré-Demande CNI France en Ligne – Renouvellement Carte d'Identité | CINFr</title>
  <meta name="description"
        content="Faites votre pré-demande CNI France en ligne en quelques clics. Assistance pour le renouvellement carte d'identité, pré-demande CNI adulte ou mineur. Traitement sous 48 h.">
  <meta name="keywords"
        content="pré demande cni france, renouvellement cni, cni pré demande, assistance pré demande, cni france">
  <link rel="canonical" href="{{ url()->current() }}">
 
  {{-- Open Graph --}}
  <meta property="og:type"        content="website">
  <meta property="og:title"       content="Pré-Demande CNI France en Ligne | CINFr">
  <meta property="og:description" content="Assistance rapide pour votre pré-demande CNI France ou renouvellement carte d'identité. Résultat sous 48 h.">
  <meta property="og:url"         content="{{ url()->current() }}">
  <meta property="og:image"       content="{{ asset('images/og-cinfr.jpg') }}">
 
  {{-- Schema.org – Service --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "Pré-Demande CNI France",
    "description": "Service d'assistance pour la pré-demande de Carte Nationale d'Identité française (CNI) en ligne pour adultes et mineurs.",
    "provider": {
      "@type": "Organization",
      "name": "CINFr",
      "url": "{{ url('/') }}"
    },
    "areaServed": "FR",
    "serviceType": "Assistance administrative CNI",
    "offers": [
      {
        "@type": "Offer",
        "name": "Pré-demande CNI Majeur",
        "price": "{{ config('prix.majeur') }}",
        "priceCurrency": "EUR"
      },
      {
        "@type": "Offer",
        "name": "Pré-demande CNI Mineur",
        "price": "{{ config('prix.mineur') }}",
        "priceCurrency": "EUR"
      }
    ]
  }
  </script>
 
  {{-- Schema.org – FAQ --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {
        "@type": "Question",
        "name": "Comment faire une pré-demande CNI France en ligne ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "La pré-demande CNI France s'effectue en trois étapes : remplissez le formulaire en ligne sur CINFr, recevez votre récapitulatif sous 48 h, puis présentez-vous en mairie avec vos justificatifs pour finaliser le dossier."
        }
      },
      {
        "@type": "Question",
        "name": "Quels documents fournir pour un renouvellement CNI ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Pour un renouvellement CNI, vous devez fournir : 2 photos d'identité récentes, un justificatif de domicile de moins d'un an, votre ancienne carte d'identité (ou passeport), et si besoin un justificatif de nationalité française."
        }
      },
      {
        "@type": "Question",
        "name": "Quelle est la durée de validité de la CNI France ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "La CNI France est valable 15 ans pour les adultes (majeurs) et 10 ans pour les mineurs."
        }
      },
      {
        "@type": "Question",
        "name": "Combien coûte l'assistance pré-demande CNI sur CINFr ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Le service d'assistance pré-demande CNI est proposé à {{ config('prix.majeur') }} € TTC pour un majeur et {{ config('prix.mineur') }} € TTC pour un mineur. La pré-demande directement sur le site officiel ANTS reste gratuite."
        }
      },
      {
        "@type": "Question",
        "name": "Peut-on voyager avec une CNI périmée ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Certains pays de l'Union européenne acceptent une CNI France périmée depuis moins de 5 ans (Belgique, Italie, Luxembourg…). En dehors de l'espace Schengen, une carte d'identité en cours de validité est généralement exigée."
        }
      },
      {
        "@type": "Question",
        "name": "Combien de temps faut-il pour obtenir sa carte d'identité après la pré-demande ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Après dépôt du dossier en mairie, la CNI est généralement délivrée dans un délai de 20 jours ouvrés, selon les services de la mairie concernée."
        }
      },
      {
        "@type": "Question",
        "name": "Quelle est la différence entre pré-demande CNI et demande complète ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "La pré-demande CNI est une étape préalable réalisée en ligne : elle génère un numéro de dossier que vous présentez en mairie. La demande complète est finalisée en personne à la mairie, avec remise des documents originaux et prise d'empreintes."
        }
      },
      {
        "@type": "Question",
        "name": "Comment renouveler la CNI d'un mineur ?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Le renouvellement CNI d'un mineur nécessite la présence d'un représentant légal (parent ou tuteur). Les documents requis sont : pièce d'identité du représentant, justificatif de domicile, ancienne CNI du mineur et photos d'identité conformes."
        }
      }
    ]
  }
  </script>
@endsection
 
@section('content')
<main style="flex-grow: 1;">
 
  {{-- ===================== H E R O ===================== --}}
  <section id="hero">
  <div id="lottie-bg"></div>
  <div class="container">
    <div class="row align-items-center">

      {{-- Image desktop --}}
      <div class="col-md-5 d-none d-md-flex" id="cinhand-container">
        <img src="images/cinhand.webp"
             loading="lazy"
             width="480" height="520"
             class="img-fluid"
             alt="Illustration pré-demande carte d'identité France">
      </div>

      {{-- Texte hero --}}
      <div class="col-md-7 d-flex flex-row flex-md-column content-box hero-content"
           style="flex-direction: row !important;">
        <div id="lottie-container" class="mb-3"></div>
        <div class="hero-text-wrapper text-left">
          <h1 class="hero-title">
            Simplifiez votre<br>
            <span class="primary">pré-demande</span> de<br>
            <span class="primary">carte d'identité</span><br>
            en quelques clics
          </h1>
          {{-- Sous-titre SEO : visible uniquement si le hero a assez de hauteur --}}
          <p class="hero-subtitle"
             style="font-size:0.95rem; color:#555; margin-top:6px; margin-bottom:0; line-height:1.4;">
            Renouvellement CNI ou première demande&nbsp;—
            recevez votre récapitulatif <strong>sous&nbsp;48&nbsp;h</strong>.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>
  {{-- =================== END HERO ==================== --}}
 
  <div id="hero-text-portrait-container" class="container text-center mt-4"></div>
 
  {{-- ================= M A R K E T I N G ============= --}}
  <section id="marketing" aria-label="Tarifs pré-demande CNI France">
    <div class="container">
      <div class="row justify-content-center">
 
        {{-- MAJEUR --}}
        <div class="col-md-5">
          <div class="subscription-box text-center">
            <h2 style="color:#0444ec; font-weight:700; margin-bottom:5px;">
              <span style="font-size:0.9rem; color:#000; font-weight:400;">Pré-Demande CNI – </span>Majeur
            </h2>
            <div style="margin-bottom:10px;">
              <span style="font-size:1.6rem; font-weight:600; color:#28a745;">
                {{ config('prix.majeur') }}€
                <span style="font-size:0.9rem; color:#666; font-weight:normal;">TTC</span>
              </span>
              <span style="font-size:1.2rem; color:#999; text-decoration:line-through; margin-left:10px;">39€</span>
            </div>
            <p>Traitement sous 48&nbsp;h – Renouvellement CNI adulte</p>
            <picture>
              <source srcset="images/Parents-rafiki.webp" type="image/webp">
              <img src="images/Parents-rafiki.png"
                   alt="Assistance pré-demande carte d'identité adulte"
                   style="max-width:100%; height:auto; margin-bottom:10px;">
            </picture>
            <a href="{{ route('predemande') }}?type=majeur" class="btnfos btnfos-1"
               title="Faire ma pré-demande CNI France – Majeur">
              <svg><rect x="0" y="0" rx="25" ry="25" fill="none" width="100%" height="100%"/></svg>
              Pré-Demande CNI Majeur
            </a>
          </div>
        </div>

        {{-- MINEUR --}}
        <div class="col-md-5">
          <div class="subscription-box text-center">
            <h2 style="color:#0444ec; font-weight:700; margin-bottom:5px;">
              <span style="font-size:0.9rem; color:#000; font-weight:400;">Pré-Demande CNI – </span>Mineur
            </h2>
            <div style="margin-bottom:10px;">
              <span style="font-size:1.6rem; font-weight:600; color:#28a745;">
                {{ config('prix.mineur') }}€
                <span style="font-size:0.9rem; color:#666; font-weight:normal;">TTC</span>
              </span>
              <span style="font-size:1.2rem; color:#999; text-decoration:line-through; margin-left:10px;">39€</span>
            </div>
            <p>Traitement sous 48&nbsp;h – CNI enfant &amp; adolescent</p>
            <picture>
              <source srcset="images/Recess-rafiki.webp" type="image/webp">
              <img src="images/Recess-rafiki.png"
                   alt="Assistance pré-demande carte d'identité mineur"
                   style="max-width:100%; height:auto; margin-bottom:10px;">
            </picture>
            <a href="{{ route('predemande') }}?type=mineur" class="btnfos btnfos-1"
               title="Faire ma pré-demande CNI France – Mineur">
              <svg><rect x="0" y="0" rx="25" ry="25" fill="none" width="100%" height="100%"/></svg>
              Pré-Demande CNI Mineur
            </a>
          </div>
        </div>
 
      </div>
    </div>
  </section>
  {{-- ============= END MARKETING ============= --}}
 
  {{-- ================= É T A P E S ================= --}}
  <section id="testimonials" aria-label="Étapes pré-demande CNI France">
    <div class="container">
      <div class="title-block">
        <h2 class="wrapped-title">
          Comment fonctionne notre assistance pré-demande CNI France&nbsp;?
        </h2>
      </div>
      <div class="row h-100 align-items-center">
 
        <div class="col-md-4 text-center">
          <h3 style="font-size:1.1rem;">1. Remplissez votre pré-demande CNI</h3>
          <p>Notre service vous guide pas à pas pour compléter votre <strong>pré-demande CNI France</strong> via le formulaire en ligne. Chaque information est vérifiée avant envoi au service officiel de l'ANTS (Agence Nationale des Titres Sécurisés).</p>
        </div>
 
        <div class="col-md-4 text-center">
          <h3 style="font-size:1.1rem;">2. Recevez votre récapitulatif sous 48&nbsp;h</h3>
          <p>Vous recevez par e-mail un récapitulatif complet de votre <strong>pré-demande carte d'identité</strong> avec votre numéro de dossier. Présentez ce document à la mairie de votre choix pour fixer votre rendez-vous de dépôt.</p>
        </div>
 
        <div class="col-md-4 text-center">
          <h3 style="font-size:1.1rem;">3. Retirez votre nouvelle CNI</h3>
          <p>Une fois votre dossier traité par la mairie, votre <strong>carte nationale d'identité</strong> est disponible au retrait en personne, sur présentation de vos justificatifs. Délai habituel&nbsp;: 20&nbsp;jours ouvrés.</p>
        </div>
 
      </div>
    </div>
  </section>
  {{-- =========== END ÉTAPES =========== --}}
 
  {{-- ================= C R E S T I M O N I A L S ================= --}}
  <section id="crestimonials" aria-label="Pourquoi choisir CINFr pour votre CNI France">
    <div class="container">
      <div class="title-block text-center">
        <h2>Pourquoi utiliser CINFr pour votre pré-demande CNI&nbsp;?</h2>
        <p>
          La <strong>carte nationale d'identité France</strong> (CNI) est le document officiel qui atteste de votre identité et de votre nationalité. 
          Elle vous permet de voyager librement dans l'espace Schengen et l'Union européenne sans passeport. 
          Sa durée de validité est de <strong>15&nbsp;ans pour les adultes</strong> et <strong>10&nbsp;ans pour les mineurs</strong>. 
          Notre service simplifie chaque étape de la <strong>pré-demande CNI France</strong>, 
          du remplissage du formulaire jusqu'à la prise de rendez-vous en mairie.
        </p>
      </div>
      <div class="row align-items-center mt-5">
        <div class="col-md-6">
          <picture>
            <source srcset="images/cinstyle.webp" type="image/webp">
            <img src="images/cinstyle.png"
                 alt="Carte nationale d'identité France - exemple recto-verso"
                 class="img-fluid">
          </picture>
        </div>
        <div class="col-md-6">
  <div class="benefits-box">
    <h3 class="text-primary">CINFr vous aide à&nbsp;:</h3>
    <ul class="benefits-list">
      <li><i class="icon ion-md-checkmark-circle-outline demo"></i>
        Réaliser votre <strong>pré-demande CNI France</strong> en quelques clics
      </li>
      <li><i class="icon ion-md-checkmark-circle-outline demo"></i>
        Vérifier toutes les informations de votre dossier avant transmission
      </li>
      <li><i class="icon ion-md-checkmark-circle-outline demo"></i>
        Préparer votre <strong>renouvellement CNI</strong> adulte ou mineur
      </li>
      <li><i class="icon ion-md-checkmark-circle-outline demo"></i>
        Obtenir votre récapitulatif pour la prise de rendez-vous en mairie
      </li>
    </ul>
    <a href="{{ route('predemande') }}" class="btnfos btnfos-1"
       title="Lancer ma pré-demande CNI France">
      <svg><rect x="0" y="0" rx="25" ry="25" fill="none" width="100%" height="100%"/></svg>
      Je fais ma pré-demande CNI
    </a>
  </div>
</div>
      </div>
    </div>
  </section>
  {{-- =========== END CRESTIMONIALS =========== --}}
 
  {{-- ============= I N F O R M A T I O N S - C N I ============= --}}
  <section id="cni-information" aria-label="Tout savoir sur la CNI France">
    <div class="container">
      <div class="title-block text-center">
        <h2>Tout savoir sur la Carte Nationale d'Identité (CNI) France</h2>
        <p>Informations officielles sur la <strong>CNI France</strong>, son utilité et la procédure de pré-demande gratuite.</p>
      </div>
      <div class="row mt-5">
 
        {{-- Colonne gauche --}}
        <div class="col-md-6">
          <div class="info-box equal-height">
            <h3>Pourquoi la CNI France est-elle indispensable&nbsp;?</h3>
            <p>La <strong>Carte Nationale d'Identité France</strong> est bien plus qu'un simple justificatif d'identité. Elle est exigée ou acceptée dans de nombreuses situations&nbsp;:</p>
            <ul>
              <li><i class="icon ion-md-checkmark-circle"></i>
                Atteste officiellement de votre identité et de votre nationalité française.
              </li>
              <li><i class="icon ion-md-checkmark-circle"></i>
                Indispensable pour&nbsp;:
                <ul>
                  <li>Passer des concours ou examens officiels.</li>
                  <li>Réaliser des opérations bancaires ou administratives.</li>
                  <li>S'inscrire auprès de France Travail (ex-Pôle Emploi) ou d'autres services publics.</li>
                </ul>
              </li>
              <li><i class="icon ion-md-checkmark-circle"></i>
                Document <strong>gratuit</strong>, délivré généralement sous 20&nbsp;jours ouvrés.
              </li>
            </ul>
            <p class="mt-3">
              Bien que non obligatoire, la CNI facilite l'ensemble de vos démarches 
              en France comme à l'étranger. Anticipez votre <strong>renouvellement CNI</strong> 
              dès que votre carte approche de son expiration.
            </p>
          </div>
        </div>
 
        {{-- Colonne droite --}}
        <div class="col-md-6">
          <div class="info-box equal-height">
            <h3>Comment réaliser gratuitement sa pré-demande CNI en ligne&nbsp;?</h3>
            <p>
              La <strong>pré-demande CNI France</strong> est disponible gratuitement sur le site officiel 
              de l'ANTS. Notre service vous guide pour éviter toute erreur de saisie. 
              Voici les étapes officielles&nbsp;:
            </p>
            <ol>
              <li>
                <strong>Accédez au portail ANTS&nbsp;:</strong> Rendez-vous sur 
                <a href="https://ants.gouv.fr" target="_blank" rel="noopener noreferrer" class="text-primary">
                  ants.gouv.fr
                </a>, plateforme officielle et gratuite de l'État français.
              </li>
              <li>
                <strong>Connectez-vous ou créez un compte&nbsp;:</strong> Utilisez FranceConnect ou créez 
                un compte ANTS pour accéder au formulaire de <strong>pré-demande carte d'identité</strong>.
              </li>
              <li>
                <strong>Remplissez votre pré-demande CNI&nbsp;:</strong> Renseignez votre état civil, 
                votre nationalité et le motif de votre demande (première demande ou renouvellement CNI).
              </li>
              <li>
                <strong>Obtenez votre numéro de pré-demande&nbsp;:</strong> Un récapitulatif vous est remis. 
                Conservez-le&nbsp;: il est indispensable pour votre rendez-vous en mairie.
              </li>
            </ol>
            <p class="mt-3">
              Vous pouvez déléguer cette étape à CINFr pour un <strong>traitement sous 48&nbsp;h</strong>, 
              sans risque d'erreur dans votre dossier.
            </p>
            <a href="https://ants.gouv.fr" target="_blank" rel="noopener noreferrer" class="btn btn-link">
              Site officiel ANTS →
            </a>
          </div>
        </div>
 
      </div>
    </div>
  </section>
  {{-- =========== END INFORMATIONS-CNI =========== --}}
 
  {{-- ============= D O C U M E N T S ============= --}}
  <section id="cni-documents" class="styled-section"
           aria-label="Documents requis pré-demande CNI France">
    <div class="container">
      <div class="title-block text-center">
        <h2>Documents requis pour la pré-demande CNI France</h2>
        <p>Préparez votre dossier en avance pour un <strong>renouvellement CNI</strong> ou une première demande sans retard.</p>
      </div>
      <div class="row mt-5">
 
        {{-- Majeurs --}}
        <div class="col-md-6 styled-column">
          <h3><i class="icon ion-md-person"></i> Documents CNI – Majeur</h3>
          <p>Pièces à fournir pour une <strong>pré-demande CNI France adulte</strong>&nbsp;:</p>
          <ul>
            <li><strong>Photos d'identité&nbsp;:</strong> 2 photos récentes (35×45&nbsp;mm), tête nue, fond neutre clair.</li>
            <li><strong>Justificatif de domicile&nbsp;:</strong> Facture (eau, électricité, gaz) ou avis d'imposition datant de moins d'un an.</li>
            <li><strong>Pièce d'identité&nbsp;:</strong> Ancienne CNI ou passeport valide (ou périmé depuis moins de&nbsp;2&nbsp;ans).</li>
            <li><strong>Justificatif de nationalité&nbsp;:</strong> Décret de naturalisation ou acte de naissance, si nécessaire.</li>
          </ul>
        </div>
 
        {{-- Mineurs --}}
        <div class="col-md-6 styled-column">
          <h3><i class="icon ion-md-people"></i> Documents CNI – Mineur</h3>
          <p>Pièces spécifiques au <strong>renouvellement CNI mineur</strong>&nbsp;:</p>
          <ul>
            <li><strong>Représentant légal&nbsp;:</strong> Parent ou tuteur présent avec sa propre pièce d'identité.</li>
            <li><strong>Justificatif de tutelle&nbsp;:</strong> Décision de justice ou acte de naissance, si applicable.</li>
            <li><strong>Justificatif de domicile&nbsp;:</strong> Document au nom des parents/tuteurs, datant de moins d'un an.</li>
            <li><strong>Photos d'identité&nbsp;:</strong> Conformes aux normes biométriques officielles.</li>
          </ul>
        </div>
 
      </div>
    </div>
  </section>
  {{-- =========== END DOCUMENTS =========== --}}
 
  {{-- =================== F A Q =================== --}}
  <section id="faq" class="styled-section"
           aria-label="FAQ pré-demande CNI France et renouvellement carte d'identité"
           itemscope itemtype="https://schema.org/FAQPage">
    <div class="container">
      <div class="title-block text-center">
        <h2>FAQ – Pré-demande CNI France &amp; Renouvellement Carte d'Identité</h2>
        <p>Toutes les réponses aux questions les plus fréquentes sur la <strong>pré-demande CNI</strong>, 
           le <strong>renouvellement carte d'identité</strong> et notre service d'<strong>assistance CNI France</strong>.</p>
      </div>
 
      <div class="faq-list">
 
        {{-- FAQ 1 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Comment faire une pré-demande CNI France en ligne&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>
                Réaliser votre <strong>pré-demande CNI France</strong> en ligne n'a jamais été aussi simple.
                Notre service vous guide pas à pas&nbsp;: remplissez le formulaire en quelques minutes,
                notre équipe vérifie l'ensemble de votre dossier et vous envoie votre récapitulatif complet
                <strong>sous&nbsp;48&nbsp;h</strong>. Il ne vous reste plus qu'à vous présenter en mairie
                avec ce document pour déposer vos originaux et finaliser votre demande.
                Fini les erreurs de saisie et les allers-retours inutiles.
              </p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 2 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Quels documents fournir pour un renouvellement CNI&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>Pour un <strong>renouvellement carte d'identité</strong>, il vous faut&nbsp;: 2&nbsp;photos d'identité biométriques récentes, 
              un justificatif de domicile de moins d'un an, votre ancienne CNI ou passeport, 
              et le cas échéant un justificatif de nationalité française.</p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 3 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Quelle est la durée de validité de la CNI France&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>La <strong>CNI France</strong> est valable <strong>15&nbsp;ans pour les adultes</strong> (majeurs) 
              et <strong>10&nbsp;ans pour les mineurs</strong>. Anticipez votre <strong>renouvellement CNI</strong> 
              plusieurs mois avant l'expiration pour éviter les délais en mairie.</p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 4 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Combien coûte l'assistance pré-demande CNI sur CINFr&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>Le service d'<strong>assistance pré-demande CNI</strong> de CINFr est de 
              <strong>{{ config('prix.majeur') }}&nbsp;€&nbsp;TTC</strong> pour un majeur et 
              <strong>{{ config('prix.mineur') }}&nbsp;€&nbsp;TTC</strong> pour un mineur. 
              Il inclut la vérification de votre dossier, la saisie sécurisée et la transmission de votre récapitulatif sous 48&nbsp;h. 
              La pré-demande CNI directement sur le site officiel ANTS reste gratuite.</p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 5 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Quelle est la différence entre pré-demande CNI et demande complète&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>La <strong>pré-demande CNI</strong> est une étape en ligne qui génère un numéro de dossier. 
              La demande complète est finalisée physiquement en mairie&nbsp;: vous y déposez vos documents originaux 
              et donnez vos empreintes digitales. Notre service couvre la partie pré-demande.</p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 6 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Combien de temps faut-il pour obtenir sa carte d'identité après la pré-demande&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>Après dépôt de votre dossier complet en mairie, la <strong>CNI France</strong> est généralement 
              délivrée dans un délai de <strong>20&nbsp;jours ouvrés</strong>. Ce délai peut varier selon 
              la période et la charge de la mairie choisie. Commencez votre <strong>pré-demande CNI</strong> 
              le plus tôt possible.</p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 7 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Peut-on voyager en Europe avec une CNI périmée&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>Certains pays de l'Union européenne comme la Belgique, l'Italie ou le Luxembourg acceptent 
              une <strong>CNI France</strong> périmée depuis moins de 5&nbsp;ans. 
              Hors espace Schengen, une carte d'identité en cours de validité est généralement requise. 
              Planifiez votre <strong>renouvellement CNI</strong> avant tout voyage.</p>
            </div>
          </div>
        </div>
 
        {{-- FAQ 8 --}}
        <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
          <button class="faq-question" itemprop="name">
            Comment renouveler la CNI d'un enfant ou adolescent&nbsp;?
          </button>
          <div class="faq-answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
              <p>Le <strong>renouvellement CNI mineur</strong> nécessite la présence d'un représentant légal 
              (père, mère ou tuteur) lors du dépôt du dossier en mairie. Documents requis&nbsp;: 
              pièce d'identité du représentant légal, justificatif de domicile, ancienne CNI de l'enfant 
              et 2&nbsp;photos d'identité conformes. CINFr prend en charge la <strong>pré-demande CNI mineur</strong> pour vous.</p>
            </div>
          </div>
        </div>
 
      </div>{{-- /.faq-list --}}
    </div>
  </section>
  {{-- =========== END FAQ =========== --}}

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
@endsection

@section('scripts')
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
  // Système de navigation mobile personnalisé sans Bootstrap
  document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.getElementById('navbarToggler');
    const navbarMenu = document.getElementById('navbarMenu');
    const infoDropdown = document.getElementById('navbarDropdownInfo');
    const infoDropdownMenu = document.getElementById('infoDropdownMenu');
    
    // Gestion du menu principal
    if (navbarToggler && navbarMenu) {
      navbarToggler.addEventListener('click', function() {
        // Basculer la visibilité du menu
        navbarMenu.classList.toggle('show');
        
        // Basculer les icônes
        const menuIcon = navbarToggler.querySelector('.ion-md-menu');
        const closeIcon = navbarToggler.querySelector('.ion-md-close');
        
        if (navbarMenu.classList.contains('show')) {
          // Menu est ouvert, afficher la croix
          if (menuIcon) menuIcon.style.display = 'none';
          if (closeIcon) closeIcon.style.display = 'inline';
        } else {
          // Menu est fermé, afficher le menu
          if (menuIcon) menuIcon.style.display = 'inline';
          if (closeIcon) closeIcon.style.display = 'none';
        }
      });
      
      // Fermer le menu quand on clique sur un lien
      const navLinks = navbarMenu.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          navbarMenu.classList.remove('show');
          // Réinitialiser les icônes
          const menuIcon = navbarToggler.querySelector('.ion-md-menu');
          const closeIcon = navbarToggler.querySelector('.ion-md-close');
          if (menuIcon) menuIcon.style.display = 'inline';
          if (closeIcon) closeIcon.style.display = 'none';
        });
      });
    }
    
    // Gestion du dropdown "Informations" (uniquement sur desktop)
    if (infoDropdown && infoDropdownMenu) {
      infoDropdown.addEventListener('click', function(e) {
        if (window.innerWidth >= 992) { // Uniquement sur desktop
          e.preventDefault();
          // Basculer la visibilité du dropdown
          if (infoDropdownMenu.style.display === 'block') {
            infoDropdownMenu.style.display = 'none';
          } else {
            infoDropdownMenu.style.display = 'block';
          }
        }
      });
      
      // Fermer le dropdown quand on clique en dehors (uniquement sur desktop)
      if (window.innerWidth >= 992) {
        document.addEventListener('click', function(e) {
          if (!infoDropdown.contains(e.target) && !infoDropdownMenu.contains(e.target)) {
            infoDropdownMenu.style.display = 'none';
          }
        });
      }
    }
    
    // Fermer le menu principal quand on clique en dehors sur mobile
    document.addEventListener('click', function(e) {
      if (navbarMenu.classList.contains('show') && 
          !navbarToggler.contains(e.target) && 
          !navbarMenu.contains(e.target) &&
          window.innerWidth < 992) {
        navbarMenu.classList.remove('show');
        // Réinitialiser les icônes
        const menuIcon = navbarToggler.querySelector('.ion-md-menu');
        const closeIcon = navbarToggler.querySelector('.ion-md-close');
        if (menuIcon) menuIcon.style.display = 'inline';
        if (closeIcon) closeIcon.style.display = 'none';
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

  // Only run if both elements exist
  if (scrollTopBtn && footer) {
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
  }

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  }
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

<script>
  let previousScrollPosition = window.pageYOffset;
  const navbar = document.querySelector('.custom-navbar');
  const threshold = 100;

  window.addEventListener('scroll', () => {
    const currentScrollPosition = window.pageYOffset;

    if (previousScrollPosition > currentScrollPosition) {
      navbar.style.top = "0";
    } else {
      navbar.style.top = "-100px";
    }
    previousScrollPosition = currentScrollPosition;
  });

  window.addEventListener('mousemove', (event) => {
    if (event.clientY <= threshold) {
      navbar.style.top = "0";
    }
  });
</script>

<script>
  const scrollTopBtn = document.getElementById("scrollTopBtn");
  const footer = document.querySelector("footer");

  if (scrollTopBtn && footer) {
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
  }

  if (scrollTopBtn) {
    scrollTopBtn.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  }
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

@endsection
