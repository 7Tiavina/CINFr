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

      .model-letter {
        background: #fff;
        border: 1px solid #e5e5e5;
        padding: 25px;
        border-radius: 6px;
        margin-top: 20px;
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

    <title>CINFr - Politique de remboursement & rétractation</title>
  </head>

  <body>

    @include('layouts.navbar')

    <section id="banner">
      <div class="container text-center">
        <h1 class="mt-3">Politique de remboursement & Droit de rétractation</h1>
      </div>
    </section>

    <div class="container">

      <section>
        <h2>1. Politique de remboursement</h2>
        <p>
          Conformément à l’article L.221-28 du Code de la consommation, le droit de rétractation ne s’applique pas
          aux prestations de services pleinement exécutées avant la fin du délai légal et dont l’exécution a débuté
          avec l’accord préalable exprès du Client.
        </p>
        <p>
          En validant sa commande sur le site <strong>CINFr</strong>, le Client reconnaît expressément que le traitement
          de sa demande peut commencer immédiatement après le paiement, ce qui implique la renonciation à son droit
          de rétractation une fois l’exécution entamée.
        </p>
        <p>
          Toute demande d’annulation ou de remboursement ne sera donc recevable que si le dossier n’a fait l’objet
          d’aucune intervention ou traitement administratif par nos services. Dans ce cas, la demande doit être adressée
          par e-mail à <a href="mailto:contact@settis-llc.com">contact@settis-llc.com</a>, en précisant la
          <strong>référence de transaction</strong> et/ou l’adresse e-mail utilisée lors de la commande.
        </p>
        <p>
          Les demandes seront étudiées individuellement, sans garantie d’acceptation automatique. Aucun remboursement
          ne pourra être effectué pour les prestations déjà entamées, partiellement exécutées ou terminées.
        </p>
      </section>



      <section>
        <h2>2. Modalités de remboursement</h2>
        <p>
          Le montant remboursé correspondra à celui de la commande, déduction faite des services dont l’exécution a déjà débuté
          (par exemple : vérification de dossier, assistance prioritaire ou dépôt administratif effectué).
        </p>
        <p>
          Le remboursement est effectué dans un délai maximum de <strong>10 jours ouvrés</strong> à compter de la validation de la demande, 
          par virement automatique sur le compte associé à la carte bancaire utilisée lors du paiement initial.
        </p>
        <p>
          En cas d’impossibilité technique, un remboursement par autre moyen (virement SEPA, crédit Stripe, etc.) pourra être proposé.
        </p>
      </section>

      <section>
        <h2>3. Retard ou non-livraison</h2>
        <p>
          Si le dossier n’a pas pu être traité dans un délai de 10 jours ouvrés pour des raisons indépendantes de la volonté du Client, 
          celui-ci peut demander un <strong>remboursement intégral</strong> auprès du support à l’adresse suivante : 
          <a href="mailto:contact@settis-llc.com">contact@settis-llc.com</a>.
        </p>
      </section>

      <section>
        <h2>4. Exceptions au remboursement</h2>
        <ul>
          <li>Les services exécutés entièrement avant la demande de rétractation ne donnent lieu à aucun remboursement.</li>
          <li>Les achats de timbres fiscaux ou frais administratifs transférés aux autorités sont non remboursables.</li>
          <li>Les services d’assistance personnalisée express ou prioritaire ne peuvent faire l’objet d’un remboursement une fois commencés.</li>
        </ul>
      </section>

      <section>
        <h2>5. Exercice du droit de rétractation</h2>
        <p>
          Conformément à l’article L.221-18 du Code de la consommation, le Client dispose de 14 jours pour exercer son droit de rétractation.
          Ce droit s’applique uniquement si la prestation n’a pas encore débuté ou si le Client n’a pas expressément demandé son exécution immédiate.
        </p>
      </section>

      <section>
        <h2>6. Procédure de demande</h2>
        <p>
          Toute demande de remboursement ou de rétractation doit être transmise par e-mail à :
          <a href="mailto:contact@settis-llc.com">contact@settis-llc.com</a> 
          avec les informations suivantes :
        </p>
        <ul>
          <li>Nom et prénom du demandeur</li>
          <li>Adresse e-mail utilisée lors de la commande</li>
          <li>Numéro ou référence de transaction</li>
          <li>Date de la commande</li>
        </ul>
      </section>

      <section>
        <h2>7. Modèle de lettre de rétractation</h2>
        <div class="model-letter">
          <p><strong>À adresser par mail à :</strong> <a href="mailto:contact@settis-llc.com">contact@settis-llc.com</a></p>
          <p><strong>Objet :</strong> Rétractation d’une pré-demande de service CINFr</p>

          <p>Madame, Monsieur,</p>

          <p>
            Le … (indiquer la date de la commande), j’ai souscrit à une prestation d’assistance administrative sur votre site <strong>www.cinfr.com</strong>.
            Conformément à l’article L.221-18 du Code de la consommation, j’exerce par la présente mon droit de rétractation.
          </p>

          <p>
            Je vous prie de bien vouloir procéder au remboursement de la somme de … euros versée lors de ma commande,
            au plus tard dans un délai de 14 jours suivant la réception de la présente demande.
          </p>

          <p>
            Référence de transaction : …<br>
            Adresse e-mail utilisée : …<br>
            Nom et prénom : …
          </p>

          <p>
            Je vous prie d’agréer, Madame, Monsieur, l’expression de mes salutations distinguées.
          </p>

          <p><em>Signature</em></p>
        </div>
      </section>

      <section>
        <h2>8. Contact & service client</h2>
        <p>
          Pour toute question relative à une demande de remboursement, veuillez contacter notre service client à : 
          <a href="mailto:contact@settis-llc.com">contact@settis-llc.com</a> ou via le formulaire disponible sur 
          <a href="https://www.cinfr.com/contact">www.cinfr.com/contact</a>.
        </p>
      </section>
    </div>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

  </body>
</html>
