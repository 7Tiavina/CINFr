<!doctype html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

              
        <style>
            
            body {
              font-family: Arial, sans-serif;
              background-color: #f8f9fa;
              padding: 0px;
            }

            #form-section {
              max-width: 800px;
              margin: 0 auto;
              padding: 20px;
              background: #fff;
              border-radius: 8px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            #form-background {
              background: #f8f9fa;
              max-width: 100%;
              margin: 0 auto;
              padding: 20px;
              border-radius: 8px;
            }

            #scrollTopBtn{
                position: fixed;
              bottom: 30px;
              right: 30px;
              z-index: 9999;
              background-color: #0444ec;
              color: white;
              border: none;
              border-radius: 50%;
              width: 60px;
              height: 60px;
              font-size: 24px;
              cursor: pointer;
              display: none;
              box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            }

            .form-part {
              display: none;
            }

            .form-part.active {
              display: block;
            }

            .progress-bar {
              background-color: #e0e0e0;
              height: 8px;
              border-radius: 4px;
              overflow: hidden;
              margin-bottom: 20px;
            }

            .progress-bar-inner {
              background-color: #0444ec;
              height: 100%;
              width: 0%;
              transition: width 0.3s ease-in-out;
            }

            .buttons {
              display: flex;
              justify-content: space-between;
            }

            .btn {
              padding: 10px 20px;
              border: none;
              border-radius: 5px;
              cursor: pointer;
              font-size: 1rem;
              transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            }

            .btn-primary {
              background-color: #0444ec;
              color: white;
            }

            .btn-primary:hover {
              background-color: #022b9c;
              transform: translateY(-2px);
              box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            }

            .btn-secondary {
              background-color: #f1f1f1;
              color: #333;
            }

            .btn-secondary:hover {
              background-color: #ddd;
              color: #000;
              transform: translateY(-2px);
              box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            }

            /* Centrage et nouveau style pour le bouton acheter */
            .buttons {
                text-align: center;
            }

            #pay-btn {
                background-color: #007bff; /* Bleu professionnel */
                color: #fff;
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }

            #pay-btn:hover {
                background-color: #0056b3; /* Bleu plus foncé pour le hover */
                box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
            }

            #pay-btn:active {
                background-color: #004494; /* Bleu encore plus foncé pour l'effet de clic */
                transform: scale(0.98); /* Réduction légère pour un effet de clic */
            }


        </style>


     <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css" type="text/css" />

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <title>CINFr Carte d'identité Nationale</title>
  </head>

  <body>

      <!-- N A V B A R -->
@include('layouts.navbar')



<section id="banner">
  <div class="container text-center">
    <div>
      :
    </div>
    <h1 class="mt-3">Pré-demande en ligne de CNI (carte nationale d'identité française)</h1>
  </div>
</section>
<!-- E N D  N A V B A R -->















<section id="form-background">
    <div id="form-section">
  <!-- Barre de progression -->
  <div class="progress-bar">
    <div class="progress-bar-inner" id="progress-bar"></div>
  </div>

 <!------------------------------------------------- Étape 1 ------------------------------------------------------------------------------>
  <div class="form-part" id="step-1">
    <div class="form-group">
      <h4>La demande concerne un : <span style="color: red;">(Nécessaire)</span></h4>
      <div class="radio-options">
        <div>
          <input type="radio" id="majeur" name="type" value="majeur" required>
          <label for="majeur">Majeur</label>
        </div>
        <div>
          <input type="radio" id="mineur" name="type" value="mineur" required>
          <label for="mineur">Mineur</label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <h4>Raison de la demande <span style="color: red;">(Nécessaire)</span></h4>
      <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
        <option value="">Sélectionnez une raison</option>
        <option value="premiere">Première demande</option>
        <option value="renouvellement">Renouvellement</option>
      </select>
    </div>

    <div class="form-group">
      <h4>Dans quel département effectuez-vous votre demande ? <span style="color: red;">(Nécessaire)</span></h4>
      <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
        <option value="">Sélectionnez un département</option>
        <option value="01">1 Ain</option>
        <option value="02">2 Aisne</option>
      </select>
    </div>
  </div>

  <!------------------------------------------------- Étape 2 ------------------------------------------------------------------------------>
  <div class="form-part" id="step-2" style="display: none;">
    <div class="form-group">
        <h4>Sexe : <span style="color: red;">(Nécessaire)</span></h4>
        <div class="radio-options">
            <div>
                <input type="radio" id="homme" name="sexe" value="homme">
                <label for="homme">Homme</label>
            </div>
            <div>
                <input type="radio" id="femme" name="sexe" value="femme">
                <label for="femme">Femme</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <h4>Nom de naissance <span style="color: red;">(Nécessaire)</span></h4>
        <input type="text" placeholder="Nom de naissance" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
    </div>

    <div class="form-group">
        <h4>Deuxième nom</h4>
        <input type="text" placeholder="Deuxième nom" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
    </div>

    <div class="form-group">
        <h4>Prénoms</h4>
        <input type="text" placeholder="1er prénom (Nécessaire)" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
        <input type="text" placeholder="2ème prénom" style="width: 100%; margin-top: 8px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <input type="text" placeholder="3ème prénom" style="width: 100%; margin-top: 8px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
    </div>

    <div class="form-group">
        <h4>Taille <span style="color: red;">(Nécessaire)</span></h4>
        <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">Sélectionnez votre taille</option>
            <option value="1.00">1.00 m</option>
            <option value="1.01">1.01 m</option>
            <option value="1.02">1.02 m</option>
            <!-- Continuer jusqu'à 3 m -->
            <option value="3.00">3.00 m</option>
        </select>
    </div>

    <div class="form-group">
        <h4>Couleur des yeux <span style="color: red;">(Nécessaire)</span></h4>
        <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">Sélectionnez la couleur</option>
            <option value="noir">Noir</option>
            <option value="marron">Marron</option>
            <option value="bleu">Bleu</option>
            <option value="vert">Vert</option>
            <option value="gris">Gris</option>
        </select>
    </div>

    <div class="form-group">
        <h4>Date de naissance <span style="color: red;">(Nécessaire)</span></h4>
        <input type="date" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
    </div>

    <div class="form-group">
        <h4>Pays de naissance <span style="color: red;">(Nécessaire)</span></h4>
        <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">Sélectionnez le pays</option>
            <option value="france">France</option>
            <option value="autre">Autre</option>
        </select>
    </div>

    <div class="form-group">
        <h4>Département ou Collectivité d'outre-mer de naissance <span style="color: red;">(Nécessaire)</span></h4>
        <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">Sélectionnez le département</option>
            <option value="01">01 Ain</option>
            <option value="971">971 Guadeloupe</option>
            <!-- Ajouter plus d'options si nécessaire -->
        </select>
    </div>

    <div class="form-group">
        <h4>Commune de naissance <span style="color: red;">(Nécessaire)</span></h4>
        <input type="text" placeholder="Commune de naissance" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
    </div>
</div>


<!------------------------------------------------- Étape 3 ------------------------------------------------------------------------------>


<div class="form-part" id="step-3" style="display: none;">    <h1>Père</h1>
    <div class="form-group">
        <h4>Père inconnu <span style="color: red;">(Nécessaire)</span></h4>
        <div class="radio-options">
            <div>
                <input type="radio" id="pere-inconnu-oui" name="pere-inconnu" value="oui">
                <label for="pere-inconnu-oui">Oui</label>
            </div>
            <div>
                <input type="radio" id="pere-inconnu-non" name="pere-inconnu" value="non">
                <label for="pere-inconnu-non">Non</label>
            </div>
        </div>
    </div>

    <div id="pere-details" style="display: none;">
        <div class="form-group">
            <h4>Nom de naissance du père <span style="color: red;">(Nécessaire)</span></h4>
            <input type="text" placeholder="Nom de naissance du père" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
        </div>

        <div class="form-group">
            <h4>Prénoms du père</h4>
            <input type="text" placeholder="1er prénom du père (Nécessaire)" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            <input type="text" placeholder="2ème prénom du père" style="width: 100%; margin-top: 8px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div class="form-group">
            <h4>Date de naissance du père</h4>
            <input type="date" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div class="form-group">
            <h4>Ville de naissance du père</h4>
            <input type="text" placeholder="Ville de naissance du père" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div class="form-group">
            <h4>Nationalité du père</h4>
            <input type="text" placeholder="Nationalité du père" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
    </div>

    <h1>Mère</h1>
    <div class="form-group">
        <h4>Mère inconnue <span style="color: red;">(Nécessaire)</span></h4>
        <div class="radio-options">
            <div>
                <input type="radio" id="mere-inconnue-oui" name="mere-inconnue" value="oui">
                <label for="mere-inconnue-oui">Oui</label>
            </div>
            <div>
                <input type="radio" id="mere-inconnue-non" name="mere-inconnue" value="non">
                <label for="mere-inconnue-non">Non</label>
            </div>
        </div>
    </div>

    <div id="mere-details" style="display: none;">
        <div class="form-group">
            <h4>Nom de naissance de la mère <span style="color: red;">(Nécessaire)</span></h4>
            <input type="text" placeholder="Nom de naissance de la mère" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
        </div>

        <div class="form-group">
            <h4>Prénoms de la mère</h4>
            <input type="text" placeholder="1er prénom de la mère (Nécessaire)" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            <input type="text" placeholder="2ème prénom de la mère" style="width: 100%; margin-top: 8px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div class="form-group">
            <h4>Date de naissance de la mère</h4>
            <input type="date" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div class="form-group">
            <h4>Ville de naissance de la mère</h4>
            <input type="text" placeholder="Ville de naissance de la mère" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div class="form-group">
            <h4>Nationalité de la mère</h4>
            <input type="text" placeholder="Nationalité de la mère" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
    </div>
</div>


<!------------------------------------------------- Étape 4 ------------------------------------------------------------------------------>

<div class="form-part" id="step-4" style="display: none;">
    <h4>Vous êtes Français(e) car : <span style="color: red;">(Nécessaire)</span></h4>
    <div class="checkbox-options">
        <div>
            <input type="checkbox" id="france-naissance-parent-france" name="nationalite" value="naissance-parent-france">
            <label for="france-naissance-parent-france">Vous êtes né(e) en France et l'un au moins de vos parents est né en France</label>
        </div>
        <div>
            <input type="checkbox" id="france-naissance-parent-ancien" name="nationalite" value="naissance-parent-ancien">
            <label for="france-naissance-parent-ancien">Vous êtes né(e) en France et l'un au moins de vos parents est né dans un ancien département ou territoire français</label>
        </div>
        <div>
            <input type="checkbox" id="france-naissance-parent-francais" name="nationalite" value="naissance-parent-francais">
            <label for="france-naissance-parent-francais">Vous êtes né(e) en France et l'un au moins de vos parents est français</label>
        </div>
        <div>
            <input type="checkbox" id="etranger-parent-francais" name="nationalite" value="etranger-parent-francais">
            <label for="etranger-parent-francais">Vous n'êtes pas né(e) en France et l'un au moins de vos parents est français</label>
        </div>
        <div>
            <input type="checkbox" id="parent-devient-francais" name="nationalite" value="parent-devient-francais">
            <label for="parent-devient-francais">Votre mère ou votre père est devenu(e) français(e) avant votre majorité</label>
        </div>
        <div>
            <input type="checkbox" id="nationalite-par-mariage" name="nationalite" value="nationalite-par-mariage">
            <label for="nationalite-par-mariage">Vous êtes de nationalité française par mariage</label>
        </div>
        <div>
            <input type="checkbox" id="france-naissance-parent-etranger" name="nationalite" value="naissance-parent-etranger">
            <label for="france-naissance-parent-etranger">Vous êtes né(e) en France et vos parents ne sont pas français</label>
        </div>
        <div>
            <input type="checkbox" id="naturalise-francais" name="nationalite" value="naturalise-francais">
            <label for="naturalise-francais">Vous êtes naturalisé(e) français(e)</label>
        </div>
        <div>
            <input type="checkbox" id="reintegre-francais" name="nationalite" value="reintegre-francais">
            <label for="reintegre-francais">Vous avez été réintégré(e) dans la nationalité française</label>
        </div>
        <div>
            <input type="checkbox" id="declaration-non-mariage" name="nationalite" value="declaration-non-mariage">
            <label for="declaration-non-mariage">Vous êtes français(e) par déclaration (autrement que par mariage)</label>
        </div>
        <div>
            <input type="checkbox" id="autre-motif" name="nationalite" value="autre-motif">
            <label for="autre-motif">Autre motif</label>
        </div>
    </div>
</div>



<!------------------------------------------------- Étape 5 ------------------------------------------------------------------------------>


<div class="form-part" id="step-5" style="display: none;">
    <h4>Adresse du demandeur concerné par le titre : <span style="color: red;">(Nécessaire)</span></h4>
    
    <label for="adresse-du-demandeur">Adresse du demandeur concerné par le titre</label>
    <input type="text" id="adresse-du-demandeur" name="adresse-du-demandeur" required>
    
    <label for="adresse-ville">Adresse postale : Ville</label>
    <input type="text" id="adresse-ville" name="adresse-ville" required>
    
    <label for="adresse-zip">ZIP / Code postal</label>
    <input type="text" id="adresse-zip" name="adresse-zip" required>
    
    <label for="adresse-complement">Complément d'adresse (étage, escalier, appartement, immeuble, bâtiment, résidence, lieu-dit, boîte postale)</label>
    <input type="text" id="adresse-complement" name="adresse-complement">
    
    <h4>Informations de contact : <span style="color: red;">(Nécessaire)</span></h4>
    
    <label for="telephone">Téléphone portable de contact (Format : 0601020304)</label>
    <input type="tel" id="telephone" name="telephone" pattern="^0[1-9][0-9]{8}$" required>
    
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" required>
    
    <h4>Validation : <span style="color: red;">(Nécessaire)</span></h4>
    
    <div class="checkbox-options">
        <div>
            <input type="radio" id="confirmation-info" name="validation-info" value="confirmation-info" required>
            <label for="confirmation-info">Je confirme que les informations transmises sont correctes</label>
        </div>
        <div>
            <input type="radio" id="politique-confidentialite" name="validation-politique" value="politique-confidentialite" required>
            <label for="politique-confidentialite">Je valide la politique de confidentialité du site</label>
        </div>
        <div>
            <input type="radio" id="conditions-generales" name="validation-conditions" value="conditions-generales" required>
            <label for="conditions-generales">Je valide les conditions générales de vente du site</label>
        </div>
    </div>
</div>



<!------------------------------------------------- Étape 6 ------------------------------------------------------------------------------>

<div class="form-part" id="step-6" style="display: none;">
    <h4>Frais de traitement de la pré-demande de CNI</h4>
    <p>Prix: <strong>39,00 €</strong></p>
    
    <h4>Paiement par Carte Bancaire : <span style="color: red;">(Nécessaire)</span></h4>
    
    <label for="carte-bancaire">Carte bancaire</label>
    <input type="text" id="carte-bancaire" name="carte-bancaire" placeholder="Numéro de carte" required>
    
    <label for="expiration">Date d'expiration</label>
    <input type="month" id="expiration" name="expiration" required>
    
    <label for="cvv">CVV</label>
    <input type="text" id="cvv" name="cvv" placeholder="Code de sécurité" pattern="^[0-9]{3}$" required>
    
    <h4>Connexion Link et Formulaire d'entrée de carte bancaire pour procéder au paiement :</h4>
    <p>Veuillez entrer les informations de votre carte bancaire pour compléter votre paiement.</p>
    
    <div class="buttons" style="text-align: center; margin-top: 20px;">
        <button class="btn btn-primary" id="pay-btn" onclick="processPayment()">Payer</button>
    </div>
</div>



<!------------------------------------------------- Boutons ------------------------------------------------------------------------------>



  <div class="buttons">
    <button class="btn btn-secondary" id="prev-btn" onclick="prevStep()" style="display:none;">Précédent</button>
    <button class="btn btn-primary" id="next-btn" onclick="nextStep()">Suivant</button>
  </div>
</section>






















<!-- T E S T I M O N I A L S -------- 1 ----------->
<section id="crestimonials">
  <div class="container">
    <div class="title-block text-center">
      <h2 style="white-space: nowrap;">Étapes pour la demande de Carte Nationale d'Identité </h2>

      <p>En France, la carte d'identité est un document officiel qui atteste de l'identité d'une personne. Elle permet également aux citoyens français de voyager sans passeport au sein de l'Union européenne et de l'espace Schengen, avec une durée de validité de 15 ans pour les adultes et de 10 ans pour les mineurs.</p>
    </div>
    <div class="row align-items-center mt-5">
      <div class="col-md-6">
        <img src="images/cinstyle.png" alt="Simplified Process" class="img-fluid">
      </div>
      <div class="col-md-6">
        <div class="benefits-box">
          <h3 class="text-primary">Pré - demandes</h3>
          <p>Nous réalisons pour vous la pré-demande de votre carte nationale d'identité française via le service en ligne officiel de l'ANTS (Agence Nationale des Titres Sécurisés).</p>
      </div>
      </div>
    </div>
  </div>


  <!-- E N D  T E S T I M O N I A L S     1   -->
<!-- T E S T I M O N I A L S -------- 2 ----------->
  <div class="container">
    <div class="row align-items-center mt-5">
      <div class="col-md-6 order-md-2">
        <img src="images/cinstyle.png" alt="Simplified Process" class="img-fluid">
      </div>
      <div class="col-md-6 order-md-1">
        <div class="benefits-box">
          <h3 class="text-primary">Réception et Prise de Rendez-vous</h3>
          <p>Vous recevrez sous 48 heures un récapitulatif complet de votre pré-demande. Munissez-vous de ce document pour prendre rendez-vous auprès de la mairie de votre choix afin de finaliser la procédure.</p>
        </div>
      </div>
    </div>
  </div>



  <!-- E N D  T E S T I M O N I A L S     2   -->
  <!-- T E S T I M O N I A L S -------- 3 ----------->
    <div class="container">
        <div class="row align-items-center mt-5">
          <div class="col-md-6">
            <img src="images/cinstyle.png" alt="Simplified Process" class="img-fluid">
          </div>
          <div class="col-md-6">
            <div class="benefits-box">
              <h3 class="text-primary">Retrait de votre Carte d'Identité</h3>
              <p>Une fois prête, votre carte nationale d'identité sera disponible au retrait dans un délai dépendant des services de la mairie. La remise s'effectue exclusivement en personne, sur présentation de vos justificatifs.</p>
          </div>
          </div>
        </div>
        
</section>
<!-- E N D  T E S T I M O N I A L S     3   -->    
        <button id="scrollTopBtn">
          ↑
        </button>


  <!--  F O O T E R  -->
  @include('layouts.footer')

  <!--  E N D  F O O T E R  -->
    

    <!-- External JavaScripts -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  




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
let currentStep = 1;

function showFormPart(step) {
  const steps = document.querySelectorAll('.form-part');
  const totalSteps = steps.length;

  steps.forEach((part, index) => {
    part.style.display = index + 1 === step ? 'block' : 'none';
  });

  // Mettre à jour la barre de progression si elle existe
  const progressBar = document.getElementById('progress-bar');
  if (progressBar) {
    progressBar.style.width = `${(step / totalSteps) * 100}%`;
  }

  // Mettre à jour les boutons
  document.getElementById('prev-btn').style.display = step === 1 ? 'none' : 'inline-block';
  document.getElementById('next-btn').textContent = step === totalSteps ? 'Terminer' : 'Suivant';

  currentStep = step;
}

function validateCurrentStep() {
  const currentFormPart = document.querySelector(`#step-${currentStep}`);
  if (!currentFormPart) return false; // Vérifie si l'étape existe
  
  const requiredFields = currentFormPart.querySelectorAll('[required]');
  let isValid = true;

  requiredFields.forEach(field => {
    if (field.type === 'radio') {
      const name = field.name;
      const isChecked = document.querySelector(`input[name="${name}"]:checked`);
      if (!isChecked) {
        isValid = false;
        field.closest('.form-group')?.classList.add('error');
      } else {
        field.closest('.form-group')?.classList.remove('error');
      }
    } else {
      if (!field.value.trim()) {
        isValid = false;
        field.style.border = '1px solid red';
      } else {
        field.style.border = '1px solid #ddd';
      }
    }
  });

  return isValid;
}

function nextStep() {
  const totalSteps = document.querySelectorAll('.form-part').length;

  if (validateCurrentStep()) {
    if (currentStep < totalSteps) {
      showFormPart(currentStep + 1);
    } else {
      alert('Formulaire complété avec succès !');
    }
  } else {
    alert('Veuillez remplir tous les champs obligatoires avant de continuer.');
  }
}

function prevStep() {
  if (currentStep > 1) {
    showFormPart(currentStep - 1);
  }
}

// Exemple de fonction pour le paiement
function processPayment() {
  alert('Paiement en cours...');
}

// Initialisation au chargement
window.onload = function () {
  showFormPart(currentStep);
};



</script>


<script>
  document.getElementById('pere-inconnu-non').addEventListener('change', function () {
    document.getElementById('pere-details').style.display = this.checked ? 'block' : 'none';
});

document.getElementById('pere-inconnu-oui').addEventListener('change', function () {
    document.getElementById('pere-details').style.display = this.checked ? 'none' : 'block';
});

document.getElementById('mere-inconnue-non').addEventListener('change', function () {
    document.getElementById('mere-details').style.display = this.checked ? 'block' : 'none';
});

document.getElementById('mere-inconnue-oui').addEventListener('change', function () {
    document.getElementById('mere-details').style.display = this.checked ? 'none' : 'block';
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



  </body>
</html>