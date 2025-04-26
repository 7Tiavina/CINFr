<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <style>
      body {
        font-family: 'Roboto', sans-serif;
        background-color: #f9f9f9;
        color: #333;
      }

      section {
        padding: 40px 0;
        border-bottom: 1px solid #eaeaea;
      }

      h2 {
        font-size: 24px;
        font-weight: 500;
        margin-bottom: 20px;
        color: #1c2c4c;
      }

      p {
        font-size: 16px;
        line-height: 1.7;
        color: #555;
      }

      #banner {
        padding: 60px 0;
        background-color: #1c2c4c;
        color: white;
      }

      #banner h1 {
        font-size: 32px;
        font-weight: 700;
      }

      @media (max-width: 768px) {
        section {
          padding: 30px 15px;
        }

        h2 {
          font-size: 20px;
        }

        p {
          font-size: 14px;
        }
      }
    </style>

    <title>CINFr Carte d'identité Nationale</title>
  </head>

  <body>

    @include('layouts.navbar')

    <section id="banner">
      <div class="container text-center">
        <div>Mentions légales</div>
        <h1 class="mt-3">Mentions légales</h1>
      </div>
    </section>

    <div class="container">
      <section>
        <h2>1. Informations générales</h2>
        <p>
          Nom du site : CINFr<br>
          URL : https://www.cinfr.com<br>
          Propriétaire : République de Madagascar<br>
          Forme juridique : Institution publique<br>
          Capital social : N/A<br>
          Siège social : Antananarivo<br>
          Numéro SIRET / RCS : N/A<br>
          Numéro de TVA : N/A<br>
          Directeur de la publication : Directeur Général de l'État Civil<br>
          E-mail : contact@cinfr.gov.mg<br>
          Téléphone : +261 XX XXX XXXX
        </p>
      </section>

      <section>
        <h2>2. Hébergement</h2>
        <p>
          Hébergeur : NIC-MG<br>
          Adresse : Antananarivo, Madagascar<br>
          Téléphone : +261 XX XXX XXXX<br>
          Site : https://www.nic.mg
        </p>
      </section>

      <section>
        <h2>3. Conception du site</h2>
        <p>
          Développement : Ministère de l'Intérieur<br>
          Adresse : Antananarivo<br>
          E-mail : dev@cinfr.gov.mg
        </p>
      </section>

      <section>
        <h2>4. Propriété intellectuelle</h2>
        <p>
          Tous les contenus du site sont la propriété exclusive de CINFr, sauf mentions contraires. Toute reproduction est interdite sans autorisation.
        </p>
      </section>

      <section>
        <h2>5. Conditions d’utilisation</h2>
        <p>
          L'utilisateur s'engage à ne pas utiliser le site à des fins illicites. L'accès peut être interrompu pour maintenance. Le site peut contenir des liens externes non contrôlés.
        </p>
      </section>

      <section>
        <h2>6. Responsabilité de l’éditeur</h2>
        <p>
          Les informations sont données à titre indicatif. CINFr ne peut être tenu responsable d’éventuelles erreurs.
        </p>
      </section>

      <section>
        <h2>7. Données personnelles</h2>
        <p>
          Conformément au RGPD, vous disposez de droits sur vos données. Durée de conservation : 3 ans. Contact : dpo@cinfr.gov.mg
        </p>
      </section>

      <section>
        <h2>8. Cookies</h2>
        <p>
          Le site utilise des cookies pour améliorer l’expérience utilisateur. Vous pouvez les refuser dans votre navigateur.
        </p>
      </section>

      <section>
        <h2>9. Sécurité</h2>
        <p>
          Ce site utilise HTTPS. Néanmoins, aucune transmission n’est totalement sécurisée sur Internet.
        </p>
      </section>

      <section>
        <h2>10. Liens hypertextes</h2>
        <p>
          Les liens vers des sites externes sont informatifs. CINFr décline toute responsabilité sur leur contenu.
        </p>
      </section>

      <section>
        <h2>11. Droit applicable et juridiction compétente</h2>
        <p>
          Ces mentions sont régies par le droit malgache. En cas de litige, seuls les tribunaux d’Antananarivo sont compétents.
        </p>
      </section>

      <section>
        <h2>12. Modification</h2>
        <p>
          CINFr se réserve le droit de modifier ces mentions à tout moment. Consultez-les régulièrement.
        </p>
      </section>

      <section>
        <h2>13. Contact</h2>
        <p>
          Pour toute demande :<br>
          E-mail : contact@cinfr.gov.mg<br>
          Téléphone : +261 XX XXX XXXX<br>
          Adresse postale : Antananarivo, Madagascar
        </p>
      </section>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

  </body>
</html>