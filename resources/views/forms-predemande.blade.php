<!doctype html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Custom Css -->
    <link rel="stylesheet" href="forms.css" type="text/css" />
    
    <link rel="icon" href="images/favicon.webp" type="image/webp">

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













<section id="form-background" data-prix_majeur="{{ config('prix.majeur') }}" data-prix_mineur="{{ config('prix.mineur') }}">
  <div id="form-section">
    <!-- Barre de progression -->
    <div class="progress">
        <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <span id="progress-bar-text">0%</span>
        </div>
    </div>

    <!------------------------------------------------- Étape 1 ------------------------------------------------------------------------------>
    <div class="form-part" id="step-1">
      <div class="form-group">
        <h4>La demande concerne un : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
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
        <h4>Situation Familiale<span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="situation_familiale" required class="form-control">
          <option value="">Sélectionnez une situation</option>
          <option value="celibataire">Célibataire</option>
          <option value="marie">Marié</option>
          <option value="divorce">Divorcé</option>
        </select>
      </div>


      <div class="form-group">
        <h4>Raison de la demande <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="raison" style="width: 100%;" required class="form-control">
          <option value="">Sélectionnez une raison</option>
          <option value="premiere_demande">Première demande</option>
          <option value="renouvellement_expiration">Renouvellement pour expiration</option>
          <option value="renouvellement_deterioration">Renouvellement pour détérioration</option>
          <option value="renouvellement_vol">Renouvellement pour vol</option>
          <option value="renouvellement_perte">Renouvellement pour perte</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Dans quel département effectuez-vous votre demande ? <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="departement" style="width: 100%;" required class="form-control">
          <option value="">Sélectionnez un département</option>
          <option value="01_Ain">01 Ain</option>
          <option value="02_Aisne">02 Aisne</option>
          <option value="03_Allier">03 Allier</option>
          <option value="04_Alpes-de-Haute-Provence">04 Alpes-de-Haute-Provence</option>
          <option value="05_Hautes-Alpes">05 Hautes-Alpes</option>
          <option value="06_Alpes-Maritimes">06 Alpes-Maritimes</option>
          <option value="07_Ardèche">07 Ardèche</option>
          <option value="08_Ardennes">08 Ardennes</option>
          <option value="09_Ariège">09 Ariège</option>
          <option value="10_Aube">10 Aube</option>
          <option value="11_Aude">11 Aude</option>
          <option value="12_Aveyron">12 Aveyron</option>
          <option value="13_Bouches-du-Rhône">13 Bouches-du-Rhône</option>
          <option value="14_Calvados">14 Calvados</option>
          <option value="15_Cantal">15 Cantal</option>
          <option value="16_Charente">16 Charente</option>
          <option value="17_Charente-Maritime">17 Charente-Maritime</option>
          <option value="18_Cher">18 Cher</option>
          <option value="19_Corrèze">19 Corrèze</option>
          <option value="20_Corse">20 Corse</option>
          <option value="21_Côte-d'Or">21 Côte-d'Or</option>
          <option value="22_Côtes-d'Armor">22 Côtes d'Armor</option>
          <option value="23_Creuse">23 Creuse</option>
          <option value="24_Dordogne">24 Dordogne</option>
          <option value="25_Doubs">25 Doubs</option>
          <option value="26_Drôme">26 Drôme</option>
          <option value="27_Eure">27 Eure</option>
          <option value="28_Eure-et-Loir">28 Eure-et-Loir</option>
          <option value="29_Finistère">29 Finistère</option>
          <option value="30_Gard">30 Gard</option>
          <option value="31_Haute-Garonne">31 Haute-Garonne</option>
          <option value="32_Gers">32 Gers</option>
          <option value="33_Gironde">33 Gironde</option>
          <option value="34_Hérault">34 Hérault</option>
          <option value="35_Ille-et-Vilaine">35 Ille-et-Vilaine</option>
          <option value="36_Indre">36 Indre</option>
          <option value="37_Indre-et-Loire">37 Indre-et-Loire</option>
          <option value="38_Isère">38 Isère</option>
          <option value="39_Jura">39 Jura</option>
          <option value="40_Landes">40 Landes</option>
          <option value="41_Loir-et-Cher">41 Loir-et-Cher</option>
          <option value="42_Loire">42 Loire</option>
          <option value="43_Haute-Loire">43 Haute-Loire</option>
          <option value="44_Loire-Atlantique">44 Loire-Atlantique</option>
          <option value="45_Loiret">45 Loiret</option>
          <option value="46_Lot">46 Lot</option>
          <option value="47_Lot-et-Garonne">47 Lot-et-Garonne</option>
          <option value="48_Lozère">48 Lozère</option>
          <option value="49_Maine-et-Loire">49 Maine-et-Loire</option>
          <option value="50_Manche">50 Manche</option>
          <option value="51_Marne">51 Marne</option>
          <option value="52_Haute-Marne">52 Haute-Marne</option>
          <option value="53_Mayenne">53 Mayenne</option>
          <option value="54_Meurthe-et-Moselle">54 Meurthe-et-Moselle</option>
          <option value="55_Meuse">55 Meuse</option>
          <option value="56_Morbihan">56 Morbihan</option>
          <option value="57_Moselle">57 Moselle</option>
          <option value="58_Nièvre">58 Nièvre</option>
          <option value="59_Nord">59 Nord</option>
          <option value="60_Oise">60 Oise</option>
          <option value="61_Orne">61 Orne</option>
          <option value="62_Pas-de-Calais">62 Pas-de-Calais</option>
          <option value="63_Puy-de-Dôme">63 Puy-de-Dôme</option>
          <option value="64_Pyrénées-Atlantiques">64 Pyrénées-Atlantiques</option>
          <option value="65_Hautes-Pyrénées">65 Hautes-Pyrénées</option>
          <option value="66_Pyrénées-Orientales">66 Pyrénées-Orientales</option>
          <option value="67_Bas-Rhin">67 Bas-Rhin</option>
          <option value="68_Haut-Rhin">68 Haut-Rhin</option>
          <option value="69_Rhône">69 Rhône</option>
          <option value="70_Haute-Saône">70 Haute-Saône</option>
          <option value="71_Saône-et-Loire">71 Saône-et-Loire</option>
          <option value="72_Sarthe">72 Sarthe</option>
          <option value="73_Savoie">73 Savoie</option>
          <option value="74_Haute-Savoie">74 Haute-Savoie</option>
          <option value="75_Paris">75 Paris</option>
          <option value="76_Seine-Maritime">76 Seine-Maritime</option>
          <option value="77_Seine-et-Marne">77 Seine-et-Marne</option>
          <option value="78_Yvelines">78 Yvelines</option>
          <option value="79_Deux-Sèvres">79 Deux-Sèvres</option>
          <option value="80_Somme">80 Somme</option>
          <option value="81_Tarn">81 Tarn</option>
          <option value="82_Tarn-et-Garonne">82 Tarn-et-Garonne</option>
          <option value="83_Var">83 Var</option>
          <option value="84_Vaucluse">84 Vaucluse</option>
          <option value="85_Vendée">85 Vendée</option>
          <option value="86_Vienne">86 Vienne</option>
          <option value="87_Haute-Vienne">87 Haute-Vienne</option>
          <option value="88_Vosges">88 Vosges</option>
          <option value="89_Yonne">89 Yonne</option>
          <option value="90_Territoire-de-Belfort">90 Territoire de Belfort</option>
          <option value="91_Essonne">91 Essonne</option>
          <option value="92_Hauts-de-Seine">92 Hauts-de-Seine</option>
          <option value="93_Seine-Saint-Denis">93 Seine-Saint-Denis</option>
          <option value="94_Val-de-Marne">94 Val-de-Marne</option>
          <option value="95_Val-d'Oise">95 Val-D'Oise</option>
        </select>
      </div>

    </div>

    <!------------------------------------------------- Étape 2 ------------------------------------------------------------------------------>
    <div class="form-part" id="step-2" style="display: none;">
      <div class="form-group">
        <h4>Sexe : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <div class="radio-options">
          <div class="form-check">
            <input type="radio" id="homme" name="sexe" value="homme" required class="form-check-input">
            <label for="homme" class="form-check-label">Homme</label>
          </div>
          <div class="form-check">
            <input type="radio" id="femme" name="sexe" value="femme" required class="form-check-input">
            <label for="femme" class="form-check-label">Femme</label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <h4>Nom de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="text" name="nom_naissance" placeholder="Nom de naissance" required class="form-control">
      </div>

      <div class="form-group">
        <h4>Deuxième nom</h4>
        <input type="text" name="deuxieme_nom" placeholder="Deuxième nom" class="form-control">
      </div>

      <div class="form-group">
        <h4>Prénoms <span style="color: red;">(Au moins 1)</span></h4>
        <input type="text" name="prenom1" placeholder="1er prénom" required class="form-control">
        <input type="text" name="prenom2" placeholder="2ème prénom" class="form-control">
        <input type="text" name="prenom3" placeholder="3ème prénom" class="form-control">
      </div>

      <div class="form-group">
        <h4>Taille <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="taille" required class="form-control">
          <option value="">Sélectionnez votre taille</option>
          <option value="1.00">1.00 m</option>
          <!-- ... -->
          <option value="3.00">3.00 m</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Couleur des yeux <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="couleur_yeux" required class="form-control">
          <option value="">Sélectionnez la couleur</option>
          <option value="noir">Noir</option>
          <option value="marron">Marron</option>
          <option value="bleu">Bleu</option>
          <option value="vert">Vert</option>
          <option value="gris">Gris</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Nationalité<span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="text" name="nationalite" required class="form-control">
      </div>


      <div class="form-group">
        <h4>Date de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="date" name="date_naissance" required class="form-control">
      </div>

      <div class="form-group">
        <h4>Pays de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="pays_naissance" required class="form-control">
          <option value="">Sélectionnez le pays</option>
          <option value="france">France</option>
          <option value="autre">Autre</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Département ou COM de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="dept_naissance" required class="form-control">
          <option value="">Sélectionnez le département</option>
          <option value="01">01 Ain</option>
          <option value="971">971 Guadeloupe</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Commune de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="text" name="commune_naissance" required class="form-control">
      </div>
    </div>

<!------------------------------------------------- Étape 3 ------------------------------------------------------------------------------>

<div class="form-part" id="step-3" style="display: none;">
  <h1>Père</h1>
  <div class="form-group">
    <h4>Père inconnu <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
    <div class="radio-options">
      <div class="form-check">
        <input type="radio" id="pere-inconnu-oui" name="pere_inconnu" value="oui" required class="form-check-input">
        <label for="pere-inconnu-oui" class="form-check-label">Oui</label>
      </div>
      <div class="form-check">
        <input type="radio" id="pere-inconnu-non" name="pere_inconnu" value="non" required class="form-check-input">
        <label for="pere-inconnu-non" class="form-check-label">Non</label>
      </div>
    </div>
  </div>

  <div id="pere-details" style="display: none;">
    <div class="form-group">
      <h4>Nom de naissance du père <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
      <input type="text" id="pere_nom" name="pere_nom" placeholder="Nom de naissance du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
    </div>

    <div class="form-group">
      <h4>Prénoms du père</h4>
      <input type="text" id="pere_prenom1" name="pere_prenom1" placeholder="1er prénom du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
      <input type="text" id="pere_prenom2" name="pere_prenom2" placeholder="2ème prénom du père" style="width:100%;margin-top:8px;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
      <h4>Date de naissance du père</h4>
      <input type="date" id="pere_naissance_date" name="pere_naissance_date" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
      <h4>Ville de naissance du père</h4>
      <input type="text" id="pere_naissance_ville" name="pere_naissance_ville" placeholder="Ville de naissance du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
      <h4>Nationalité du père</h4>
      <input type="text" id="pere_nationalite" name="pere_nationalite" placeholder="Nationalité du père" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>
  </div>

  <h1>Mère</h1>
  <div class="form-group">
    <h4>Mère inconnue <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
    <div class="radio-options">
      <div class="form-check">
        <input type="radio" id="mere-inconnue-oui" name="mere_inconnue" value="oui" required class="form-check-input">
        <label for="mere-inconnue-oui" class="form-check-label">Oui</label>
      </div>
      <div class="form-check">
        <input type="radio" id="mere-inconnue-non" name="mere_inconnue" value="non" required class="form-check-input">
        <label for="mere-inconnue-non" class="form-check-label">Non</label>
      </div>
    </div>
  </div>

  <div id="mere-details" style="display: none;">
    <div class="form-group">
      <h4>Nom de naissance de la mère <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
      <input type="text" id="mere_nom" name="mere_nom" placeholder="Nom de naissance de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
    </div>

    <div class="form-group">
      <h4>Prénoms de la mère</h4>
      <input type="text" id="mere_prenom1" name="mere_prenom1" placeholder="1er prénom de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
      <input type="text" id="mere_prenom2" name="mere_prenom2" placeholder="2ème prénom de la mère" style="width:100%;margin-top:8px;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
      <h4>Date de naissance de la mère</h4>
      <input type="date" id="mere_naissance_date" name="mere_naissance_date" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
      <h4>Ville de naissance de la mère</h4>
      <input type="text" id="mere_naissance_ville" name="mere_naissance_ville" placeholder="Ville de naissance de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
      <h4>Nationalité de la mère</h4>
      <input type="text" id="mere_nationalite" name="mere_nationalite" placeholder="Nationalité de la mère" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>
  </div>
</div>

<!------------------------------------------------- Étape 4 ------------------------------------------------------------------------------>

<div class="form-part" id="step-4" style="display: none;">
  <h4>Vous êtes Français(e) car : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  <div class="checkbox-options">
    <div class="form-check">
      <input type="checkbox" id="nat_naissance_parent_france" name="nat_naissance_parent_france" value="naissance-parent-france" class="form-check-input">
      <label for="nat_naissance_parent_france" class="form-check-label">Vous êtes né(e) en France et l'un de vos parents est né en France</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_naissance_parent_ancien" name="nat_naissance_parent_ancien" value="naissance-parent-ancien" class="form-check-input">
      <label for="nat_naissance_parent_ancien" class="form-check-label">Vous êtes né(e) en France et l'un de vos parents est né dans un ancien territoire français</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_naissance_parent_francais" name="nat_naissance_parent_francais" value="naissance-parent-francais" class="form-check-input">
      <label for="nat_naissance_parent_francais" class="form-check-label">Vous êtes né(e) en France et l'un de vos parents est français</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_etranger_parent_francais" name="nat_etranger_parent_francais" value="etranger-parent-francais" class="form-check-input">
      <label for="nat_etranger_parent_francais" class="form-check-label">Vous n'êtes pas né(e) en France et l'un de vos parents est français</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_parent_devenu_francais" name="nat_parent_devenu_francais" value="parent-devient-francais" class="form-check-input">
      <label for="nat_parent_devenu_francais" class="form-check-label">Votre parent est devenu français avant votre majorité</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_mariage" name="nat_mariage" value="nationalite-par-mariage" class="form-check-input">
      <label for="nat_mariage" class="form-check-label">Vous êtes français(e) par mariage</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_reintegre" name="nat_reintegre" value="reintegre-francais" class="form-check-input">
      <label for="nat_reintegre" class="form-check-label">Vous avez été réintégré(e) dans la nationalité française</label>
    </div>
    <div class="form-check">
      <input type="checkbox" id="nat_declaration" name="nat_declaration" value="declaration-non-mariage" class="form-check-input">
      <label for="nat_declaration" class="form-check-label">Vous êtes français(e) par déclaration</label>
    </div>
    <div class="form-check" style="display: flex; align-items: center; gap: 10px;">
      <input type="checkbox" id="nat_autre" name="nat_autre" value="autre-motif" class="form-check-input">
      <label for="nat_autre" class="form-check-label">Autre motif</label>
      <input type="text" id="nat_autre_texte" name="nat_autre_texte" placeholder="Précisez" style="flex: 1;" class="form-control">
    </div>

  </div>
</div>



<!------------------------------------------------- Étape 5 ------------------------------------------------------------------------------>

<div class="form-part" id="step-5" style="display: none;">
  <h4>Adresse du demandeur concerné par le titre : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  
  <label for="adresse_demandeur">Adresse du demandeur concerné par le titre</label>
  <input type="text" id="adresse_demandeur" name="adresse" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
  
  <label for="adresse_ville">Ville</label>
  <input type="text" id="adresse_ville" name="ville" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
  
  <label for="adresse_zip">ZIP / Code postal</label>
  <input type="text" id="adresse_zip" name="code_postal" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
  
  <label for="adresse_complement">Complément d'adresse (étage, escalier, appartement…)</label>
  <input type="text" id="adresse_complement" name="adresse_complement" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">

  <h4>Informations de contact : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  
  <label for="telephone">Téléphone portable (Format : 0601020304)</label>
  <input type="tel" id="telephone" name="telephone" pattern="^0[1-9][0-9]{8}$" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">
  
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" required class="form-control">

  <h4>Validation : <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
  <div class="checkbox-options">
    <div class="form-check">
      <input type="radio" id="validation_info" name="validation_info" value="info_correctes" required class="form-check-input">
      <label for="validation_info" class="form-check-label">Je confirme que les informations transmises sont correctes</label>
    </div>
    <div class="form-check">
      <input type="radio" id="validation_politique" name="validation_politique" value="politique_confidentialite" required class="form-check-input">
      <label for="validation_politique" class="form-check-label">Je valide la politique de confidentialité du site</label>
    </div>
    <div class="form-check">
      <input type="radio" id="validation_conditions" name="validation_conditions" value="conditions_generales" required class="form-check-input">
      <label for="validation_conditions" class="form-check-label">Je valide les conditions générales de vente du site</label>
    </div>
  </div>


</div>

<!------------------------------------------------- Étape 6 ------------------------------------------------------------------------------>

<div class="form-part" id="step-6" style="display: none;">
  <div id="recap-container"></div>
  <form id="stripe-form" action="{{ route('test') }}" method="POST">
    @csrf
    <input type="hidden" name="type" id="stripe-form-type">
    <div class="buttons" style="display:flex;justify-content:flex-end;margin-top:30px;">
      <button type="button" class="btn btn-secondary" onclick="prevStep()">Précédent</button>
      <button type="submit" class="btn btn-primary ml-2">Procéder a ma commande</button>
    </div>
  </form>
</div>

</div>




<!------------------------------------------------- Boutons ------------------------------------------------------------------------------>



  <div class="buttons" style="display: flex; justify-content: center; gap: 20px; margin-top: 30px;">
  <button class="btn btn-secondary" id="prev-btn" onclick="prevStep()" style="display:none;">Précédent</button>
  <button class="btn btn-primary" id="next-btn" onclick="nextStep()">Suivant</button>
</div>

</section>






















<!-- T E S T I M O N I A L S -------- 1 ----------->
<section id="crestimonials">
  <div class="container">
    <div class="title-block text-center">
      <h2 class="wrapped-title">Étapes pour la demande de Carte Nationale d'Identité </h2>

      <p>En France, la carte d'identité est un document officiel qui atteste de l'identité d'une personne. Elle permet également aux citoyens français de voyager sans passeport au sein de l'Union européenne et de l'espace Schengen, avec une durée de validité de 15 ans pour les adultes et de 10 ans pour les mineurs.</p>
    </div>
    <div class="row align-items-center mt-5">
      <div class="col-md-6">
        <picture>
          <source srcset="images/Forms-amico.webp" type="image/webp">
          <img src="images/Forms-amico.webp" alt="Simplified Process" class="img-fluid">
        </picture>


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
        <picture>
          <source srcset="images/Reminders-pana.webp" type="image/webp">
          <picture>
            <source srcset="images/Reminders-pana.webp" type="image/webp">
            <img src="images/Reminders-pana.webp" alt="Simplified Process" class="img-fluid">
          </picture>

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
            <picture>
              <source srcset="images/Done-pana.webp" type="image/webp">
              <img src="images/Done-pana.webp" alt="Simplified Process" class="img-fluid">
            </picture>

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