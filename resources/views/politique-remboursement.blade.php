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

      p, ul {
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

        p, ul {
          font-size: 14px;
        }
      }
    </style>

    <title>CINFr - Remboursement & Rétractation</title>
  </head>

  <body>

    @include('layouts.navbar')

    <section id="banner">
      <div class="container text-center">
        <div>Conditions Générales</div>
        <h1 class="mt-3">Politique de remboursement & Droit de rétractation</h1>
      </div>
    </section>

    <div class="container">
      <section>
        <h2>1. Droit de rétractation</h2>
        <p>
          Conformément à l’article L.221-18 du Code de la consommation, vous disposez d’un délai de 14 jours à compter de la commande pour exercer votre droit de rétractation, sans motif ni pénalité.
        </p>
      </section>

      <section>
        <h2>2. Modalités d’exercice</h2>
        <p>
          Pour exercer ce droit, envoyez avant expiration du délai :
        </p>
        <ul>
          <li>Le formulaire de rétractation dûment rempli, ou</li>
          <li>Une déclaration claire exprimant votre volonté de vous rétracter</li>
        </ul>
        <p>
          à l’adresse du Service Client. Le cachet de La Poste fait foi.
        </p>
      </section>

      <section>
        <h2>3. Exécution anticipée et renonciation</h2>
        <p>
          Vous pouvez autoriser l’exécution immédiate des services, conformément à l’article L.221-28 1°, et renoncer à votre droit de rétractation pour des prestations urgentes (ex. : traitement express).
        </p>
      </section>

      <section>
        <h2>4. Refus d’exécution immédiate</h2>
        <p>
          En l’absence d’autorisation expresse, les prestations seront différées de 14 jours, conformément au délai légal.
        </p>
      </section>

      <section>
        <h2>5. Cas de non-remboursement</h2>
        <p>
          Aucun remboursement ne sera effectué si le service a débuté avec votre accord avant la fin du délai légal.
        </p>
      </section>

      <section>
        <h2>6. Litiges et justificatifs</h2>
        <p>
          En cas de litige, les échanges électroniques conservés font foi. Une copie des conditions contractuelles est envoyée par e-mail après commande.
        </p>
      </section>

      <section>
        <h2>7. Demandes hors cadre légal</h2>
        <p>
          Toute demande en dehors du cadre légal sera examinée spécifiquement sans garantie d’acceptation.
        </p>
      </section>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

  </body>
</html>
