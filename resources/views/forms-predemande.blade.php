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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

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
          <option value="Ain">Ain</option>
          <option value="Aisne">Aisne</option>
          <option value="Allier">Allier</option>
          <option value="Alpes-de-Haute-Provence">Alpes-de-Haute-Provence</option>
          <option value="Hautes-Alpes">Hautes-Alpes</option>
          <option value="Alpes-Maritimes">Alpes-Maritimes</option>
          <option value="Ardèche">Ardèche</option>
          <option value="Ardennes">Ardennes</option>
          <option value="Ariège">Ariège</option>
          <option value="Aube">Aube</option>
          <option value="Aude">Aude</option>
          <option value="Aveyron">Aveyron</option>
          <option value="Bouches-du-Rhône">Bouches-du-Rhône</option>
          <option value="Calvados">Calvados</option>
          <option value="Cantal">Cantal</option>
          <option value="Charente">Charente</option>
          <option value="Charente-Maritime">Charente-Maritime</option>
          <option value="Cher">Cher</option>
          <option value="Corrèze">Corrèze</option>
          <option value="Corse">Corse</option>
          <option value="Côte-d'Or">Côte-d'Or</option>
          <option value="Côtes-d'Armor">Côtes d'Armor</option>
          <option value="Creuse">Creuse</option>
          <option value="Dordogne">Dordogne</option>
          <option value="Doubs">Doubs</option>
          <option value="Drôme">Drôme</option>
          <option value="Eure">Eure</option>
          <option value="Eure-et-Loir">Eure-et-Loir</option>
          <option value="Finistère">Finistère</option>
          <option value="Gard">Gard</option>
          <option value="Haute-Garonne">Haute-Garonne</option>
          <option value="Gers">Gers</option>
          <option value="Gironde">Gironde</option>
          <option value="Hérault">Hérault</option>
          <option value="Ille-et-Vilaine">Ille-et-Vilaine</option>
          <option value="Indre">Indre</option>
          <option value="Indre-et-Loire">Indre-et-Loire</option>
          <option value="Isère">Isère</option>
          <option value="Jura">Jura</option>
          <option value="Landes">Landes</option>
          <option value="Loir-et-Cher">Loir-et-Cher</option>
          <option value="Loire">Loire</option>
          <option value="Haute-Loire">Haute-Loire</option>
          <option value="Loire-Atlantique">Loire-Atlantique</option>
          <option value="Loiret">Loiret</option>
          <option value="Lot">Lot</option>
          <option value="Lot-et-Garonne">Lot-et-Garonne</option>
          <option value="Lozère">Lozère</option>
          <option value="Maine-et-Loire">Maine-et-Loire</option>
          <option value="Manche">Manche</option>
          <option value="Marne">Marne</option>
          <option value="Haute-Marne">Haute-Marne</option>
          <option value="Mayenne">Mayenne</option>
          <option value="Meurthe-et-Moselle">Meurthe-et-Moselle</option>
          <option value="Meuse">Meuse</option>
          <option value="Morbihan">Morbihan</option>
          <option value="Moselle">Moselle</option>
          <option value="Nièvre">Nièvre</option>
          <option value="Nord">Nord</option>
          <option value="Oise">Oise</option>
          <option value="Orne">Orne</option>
          <option value="Pas-de-Calais">Pas-de-Calais</option>
          <option value="Puy-de-Dôme">Puy-de-Dôme</option>
          <option value="Pyrénées-Atlantiques">Pyrénées-Atlantiques</option>
          <option value="Hautes-Pyrénées">Hautes-Pyrénées</option>
          <option value="Pyrénées-Orientales">Pyrénées-Orientales</option>
          <option value="Bas-Rhin">Bas-Rhin</option>
          <option value="Haut-Rhin">Haut-Rhin</option>
          <option value="Rhône">Rhône</option>
          <option value="Haute-Saône">Haute-Saône</option>
          <option value="Saône-et-Loire">Saône-et-Loire</option>
          <option value="Sarthe">Sarthe</option>
          <option value="Savoie">Savoie</option>
          <option value="Haute-Savoie">Haute-Savoie</option>
          <option value="Paris">Paris</option>
          <option value="Seine-Maritime">Seine-Maritime</option>
          <option value="Seine-et-Marne">Seine-et-Marne</option>
          <option value="Yvelines">Yvelines</option>
          <option value="Deux-Sèvres">Deux-Sèvres</option>
          <option value="Somme">Somme</option>
          <option value="Tarn">Tarn</option>
          <option value="Tarn-et-Garonne">Tarn-et-Garonne</option>
          <option value="Var">Var</option>
          <option value="Vaucluse">Vaucluse</option>
          <option value="Vendée">Vendée</option>
          <option value="Vienne">Vienne</option>
          <option value="Haute-Vienne">Haute-Vienne</option>
          <option value="Vosges">Vosges</option>
          <option value="Yonne">Yonne</option>
          <option value="Territoire-de-Belfort">Territoire de Belfort</option>
          <option value="Essonne">Essonne</option>
          <option value="Hauts-de-Seine">Hauts-de-Seine</option>
          <option value="Seine-Saint-Denis">Seine-Saint-Denis</option>
          <option value="Val-de-Marne">Val-de-Marne</option>
          <option value="Val-d'Oise">Val-D'Oise</option>
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

      <div id="deuxieme_nom_details" style="display: none;">
        <div class="form-group">
          <h4>Précisez s'il s'agit du nom :</h4>
          <div class="radio-options" style="display: flex; flex-direction: column; gap: 5px;">
            <div class="form-check" style="display: flex; align-items: center;">
              <input type="radio" id="nom_pere" name="deuxieme_nom_origine" value="pere" class="form-check-input" style="margin-right: 5px;">
              <label for="nom_pere" class="form-check-label" style="margin-bottom: 0;">de père</label>
            </div>
            <div class="form-check" style="display: flex; align-items: center;">
              <input type="radio" id="nom_mere" name="deuxieme_nom_origine" value="mere" class="form-check-input" style="margin-right: 5px;">
              <label for="nom_mere" class="form-check-label" style="margin-bottom: 0;">de la mère</label>
            </div>
            <div class="form-check" style="display: flex; align-items: center;">
              <input type="radio" id="nom_epoux" name="deuxieme_nom_origine" value="epoux" class="form-check-input" style="margin-right: 5px;">
              <label for="nom_epoux" class="form-check-label" style="margin-bottom: 0;">époux</label>
            </div>
            <div class="form-check" style="display: flex; align-items: center;">
              <input type="radio" id="nom_epouse" name="deuxieme_nom_origine" value="epouse" class="form-check-input" style="margin-right: 5px;">
              <label for="nom_epouse" class="form-check-label" style="margin-bottom: 0;">épouse</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <h4>Souhaitez-vous faire apparaître un mot devant le deuxième nom ?</h4>
          <div class="radio-options">
            <div class="form-check">
              <input type="radio" id="mot_devant_oui" name="mot_devant" value="oui" class="form-check-input">
              <label for="mot_devant_oui" class="form-check-label">Oui</label>
            </div>
            <div class="form-check">
              <input type="radio" id="mot_devant_non" name="mot_devant" value="non" class="form-check-input">
              <label for="mot_devant_non" class="form-check-label">Non</label>
            </div>
          </div>
        </div>

        <div class="form-group" id="mot_a_afficher_div" style="display: none;">
          <h4>Lequel ?</h4>
          <select name="mot_a_afficher" class="form-control">
            <option value="">Sélectionnez un mot</option>
            <option value="epoux_se">époux/se</option>
            <option value="veuf_ve">veuf/ve</option>
          </select>
        </div>
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
          <option value="50">50 cm</option>
          <option value="51">51 cm</option>
          <option value="52">52 cm</option>
          <option value="53">53 cm</option>
          <option value="54">54 cm</option>
          <option value="55">55 cm</option>
          <option value="56">56 cm</option>
          <option value="57">57 cm</option>
          <option value="58">58 cm</option>
          <option value="59">59 cm</option>
          <option value="60">60 cm</option>
          <option value="61">61 cm</option>
          <option value="62">62 cm</option>
          <option value="63">63 cm</option>
          <option value="64">64 cm</option>
          <option value="65">65 cm</option>
          <option value="66">66 cm</option>
          <option value="67">67 cm</option>
          <option value="68">68 cm</option>
          <option value="69">69 cm</option>
          <option value="70">70 cm</option>
          <option value="71">71 cm</option>
          <option value="72">72 cm</option>
          <option value="73">73 cm</option>
          <option value="74">74 cm</option>
          <option value="75">75 cm</option>
          <option value="76">76 cm</option>
          <option value="77">77 cm</option>
          <option value="78">78 cm</option>
          <option value="79">79 cm</option>
          <option value="80">80 cm</option>
          <option value="81">81 cm</option>
          <option value="82">82 cm</option>
          <option value="83">83 cm</option>
          <option value="84">84 cm</option>
          <option value="85">85 cm</option>
          <option value="86">86 cm</option>
          <option value="87">87 cm</option>
          <option value="88">88 cm</option>
          <option value="89">89 cm</option>
          <option value="90">90 cm</option>
          <option value="91">91 cm</option>
          <option value="92">92 cm</option>
          <option value="93">93 cm</option>
          <option value="94">94 cm</option>
          <option value="95">95 cm</option>
          <option value="96">96 cm</option>
          <option value="97">97 cm</option>
          <option value="98">98 cm</option>
          <option value="99">99 cm</option>
          <option value="100">100 cm</option>
          <option value="101">101 cm</option>
          <option value="102">102 cm</option>
          <option value="103">103 cm</option>
          <option value="104">104 cm</option>
          <option value="105">105 cm</option>
          <option value="106">106 cm</option>
          <option value="107">107 cm</option>
          <option value="108">108 cm</option>
          <option value="109">109 cm</option>
          <option value="110">110 cm</option>
          <option value="111">111 cm</option>
          <option value="112">112 cm</option>
          <option value="113">113 cm</option>
          <option value="114">114 cm</option>
          <option value="115">115 cm</option>
          <option value="116">116 cm</option>
          <option value="117">117 cm</option>
          <option value="118">118 cm</option>
          <option value="119">119 cm</option>
          <option value="120">120 cm</option>
          <option value="121">121 cm</option>
          <option value="122">122 cm</option>
          <option value="123">123 cm</option>
          <option value="124">124 cm</option>
          <option value="125">125 cm</option>
          <option value="126">126 cm</option>
          <option value="127">127 cm</option>
          <option value="128">128 cm</option>
          <option value="129">129 cm</option>
          <option value="130">130 cm</option>
          <option value="131">131 cm</option>
          <option value="132">132 cm</option>
          <option value="133">133 cm</option>
          <option value="134">134 cm</option>
          <option value="135">135 cm</option>
          <option value="136">136 cm</option>
          <option value="137">137 cm</option>
          <option value="138">138 cm</option>
          <option value="139">139 cm</option>
          <option value="140">140 cm</option>
          <option value="141">141 cm</option>
          <option value="142">142 cm</option>
          <option value="143">143 cm</option>
          <option value="144">144 cm</option>
          <option value="145">145 cm</option>
          <option value="146">146 cm</option>
          <option value="147">147 cm</option>
          <option value="148">148 cm</option>
          <option value="149">149 cm</option>
          <option value="150">150 cm</option>
          <option value="151">151 cm</option>
          <option value="152">152 cm</option>
          <option value="153">153 cm</option>
          <option value="154">154 cm</option>
          <option value="155">155 cm</option>
          <option value="156">156 cm</option>
          <option value="157">157 cm</option>
          <option value="158">158 cm</option>
          <option value="159">159 cm</option>
          <option value="160">160 cm</option>
          <option value="161">161 cm</option>
          <option value="162">162 cm</option>
          <option value="163">163 cm</option>
          <option value="164">164 cm</option>
          <option value="165">165 cm</option>
          <option value="166">166 cm</option>
          <option value="167">167 cm</option>
          <option value="168">168 cm</option>
          <option value="169">169 cm</option>
          <option value="170">170 cm</option>
          <option value="171">171 cm</option>
          <option value="172">172 cm</option>
          <option value="173">173 cm</option>
          <option value="174">174 cm</option>
          <option value="175">175 cm</option>
          <option value="176">176 cm</option>
          <option value="177">177 cm</option>
          <option value="178">178 cm</option>
          <option value="179">179 cm</option>
          <option value="180">180 cm</option>
          <option value="181">181 cm</option>
          <option value="182">182 cm</option>
          <option value="183">183 cm</option>
          <option value="184">184 cm</option>
          <option value="185">185 cm</option>
          <option value="186">186 cm</option>
          <option value="187">187 cm</option>
          <option value="188">188 cm</option>
          <option value="189">189 cm</option>
          <option value="190">190 cm</option>
          <option value="191">191 cm</option>
          <option value="192">192 cm</option>
          <option value="193">193 cm</option>
          <option value="194">194 cm</option>
          <option value="195">195 cm</option>
          <option value="196">196 cm</option>
          <option value="197">197 cm</option>
          <option value="198">198 cm</option>
          <option value="199">199 cm</option>
          <option value="200">200 cm</option>
          <option value="201">201 cm</option>
          <option value="202">202 cm</option>
          <option value="203">203 cm</option>
          <option value="204">204 cm</option>
          <option value="205">205 cm</option>
          <option value="206">206 cm</option>
          <option value="207">207 cm</option>
          <option value="208">208 cm</option>
          <option value="209">209 cm</option>
          <option value="210">210 cm</option>
          <option value="211">211 cm</option>
          <option value="212">212 cm</option>
          <option value="213">213 cm</option>
          <option value="214">214 cm</option>
          <option value="215">215 cm</option>
          <option value="216">216 cm</option>
          <option value="217">217 cm</option>
          <option value="218">218 cm</option>
          <option value="219">219 cm</option>
          <option value="220">220 cm</option>
          <option value="221">221 cm</option>
          <option value="222">222 cm</option>
          <option value="223">223 cm</option>
          <option value="224">224 cm</option>
          <option value="225">225 cm</option>
          <option value="226">226 cm</option>
          <option value="227">227 cm</option>
          <option value="228">228 cm</option>
          <option value="229">229 cm</option>
          <option value="230">230 cm</option>
          <option value="231">231 cm</option>
          <option value="232">232 cm</option>
          <option value="233">233 cm</option>
          <option value="234">234 cm</option>
          <option value="235">235 cm</option>
          <option value="236">236 cm</option>
          <option value="237">237 cm</option>
          <option value="238">238 cm</option>
          <option value="239">239 cm</option>
          <option value="240">240 cm</option>
          <option value="241">241 cm</option>
          <option value="242">242 cm</option>
          <option value="243">243 cm</option>
          <option value="244">244 cm</option>
          <option value="245">245 cm</option>
          <option value="246">246 cm</option>
          <option value="247">247 cm</option>
          <option value="248">248 cm</option>
          <option value="249">249 cm</option>
          <option value="250">250 cm</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Couleur des yeux <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="couleur_yeux" required class="form-control">
          <option value="">Sélectionnez la couleur</option>
          <option value="albinos">Albinos</option>
          <option value="bleu_gris">Bleu-gris</option>
          <option value="bleu_vert">Bleu-vert</option>
          <option value="bleue">Bleue</option>
          <option value="grise">Grise</option>
          <option value="marron">Marron</option>
          <option value="marron_vert">Marron-vert</option>
          <option value="noir">Noir</option>
          <option value="noisette">Noisette</option>
          <option value="vairon">Vairon</option>
          <option value="verte">Verte</option>
        </select>
      </div>


      <div class="form-group">
        <h4>Nationalité<span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="nationalite" id="nationalite_select" required class="form-control">
          <option value="">Sélectionnez la nationalité</option>
          <option value="AF">Afghanistan</option>
          <option value="AL">Albania</option>
          <option value="DZ">Algeria</option>
          <option value="AD">Andorra</option>
          <option value="AO">Angola</option>
          <option value="AG">Antigua and Barbuda</option>
          <option value="AR">Argentina</option>
          <option value="AM">Armenia</option>
          <option value="AU">Australia</option>
          <option value="AT">Austria</option>
          <option value="AZ">Azerbaijan</option>
          <option value="BS">Bahamas</option>
          <option value="BH">Bahrain</option>
          <option value="BD">Bangladesh</option>
          <option value="BB">Barbados</option>
          <option value="BY">Belarus</option>
          <option value="BE">Belgium</option>
          <option value="BZ">Belize</option>
          <option value="BJ">Benin</option>
          <option value="BT">Bhutan</option>
          <option value="BO">Bolivia</option>
          <option value="BA">Bosnia and Herzegovina</option>
          <option value="BW">Botswana</option>
          <option value="BR">Brazil</option>
          <option value="BN">Brunei</option>
          <option value="BG">Bulgaria</option>
          <option value="BF">Burkina Faso</option>
          <option value="BI">Burundi</option>
          <option value="CV">Cabo Verde</option>
          <option value="KH">Cambodia</option>
          <option value="CM">Cameroon</option>
          <option value="CA">Canada</option>
          <option value="CF">Central African Republic</option>
          <option value="TD">Chad</option>
          <option value="CL">Chile</option>
          <option value="CN">China</option>
          <option value="CO">Colombia</option>
          <option value="KM">Comoros</option>
          <option value="CD">Congo (Dem. Rep.)</option>
          <option value="CG">Congo (Rep.)</option>
          <option value="CR">Costa Rica</option>
          <option value="CI">Côte d'Ivoire</option>
          <option value="HR">Croatia</option>
          <option value="CU">Cuba</option>
          <option value="CY">Cyprus</option>
          <option value="CZ">Czech Republic</option>
          <option value="DK">Denmark</option>
          <option value="DJ">Djibouti</option>
          <option value="DM">Dominica</option>
          <option value="DO">Dominican Republic</option>
          <option value="EC">Ecuador</option>
          <option value="EG">Egypt</option>
          <option value="SV">El Salvador</option>
          <option value="GQ">Equatorial Guinea</option>
          <option value="ER">Eritrea</option>
          <option value="EE">Estonia</option>
          <option value="SZ">Eswatini</option>
          <option value="ET">Ethiopia</option>
          <option value="FJ">Fiji</option>
          <option value="FI">Finland</option>
          <option value="FR" selected>France</option>
          <option value="GA">Gabon</option>
          <option value="GM">Gambia</option>
          <option value="GE">Georgia</option>
          <option value="DE">Germany</option>
          <option value="GH">Ghana</option>
          <option value="GR">Greece</option>
          <option value="GD">Grenada</option>
          <option value="GT">Guatemala</option>
          <option value="GN">Guinea</option>
          <option value="GW">Guinea-Bissau</option>
          <option value="GY">Guyana</option>
          <option value="HT">Haiti</option>
          <option value="HN">Honduras</option>
          <option value="HU">Hungary</option>
          <option value="IS">Iceland</option>
          <option value="IN">India</option>
          <option value="ID">Indonesia</option>
          <option value="IR">Iran</option>
          <option value="IQ">Iraq</option>
          <option value="IE">Ireland</option>
          <option value="IL">Israel</option>
          <option value="IT">Italy</option>
          <option value="JM">Jamaica</option>
          <option value="JP">Japan</option>
          <option value="JO">Jordan</option>
          <option value="KZ">Kazakhstan</option>
          <option value="KE">Kenya</option>
          <option value="KI">Kiribati</option>
          <option value="KP">Korea (North)</option>
          <option value="KR">Korea (South)</option>
          <option value="KW">Kuwait</option>
          <option value="KG">Kyrgyzstan</option>
          <option value="LA">Laos</option>
          <option value="LV">Latvia</option>
          <option value="LB">Lebanon</option>
          <option value="LS">Lesotho</option>
          <option value="LR">Liberia</option>
          <option value="LY">Libya</option>
          <option value="LI">Liechtenstein</option>
          <option value="LT">Lithuania</option>
          <option value="LU">Luxembourg</option>
          <option value="MG">Madagascar</option>
          <option value="MW">Malawi</option>
          <option value="MY">Malaysia</option>
          <option value="MV">Maldives</option>
          <option value="ML">Mali</option>
          <option value="MT">Malta</option>
          <option value="MH">Marshall Islands</option>
          <option value="MR">Mauritania</option>
          <option value="MU">Mauritius</option>
          <option value="MX">Mexico</option>
          <option value="FM">Micronesia</option>
          <option value="MD">Moldova</option>
          <option value="MC">Monaco</option>
          <option value="MN">Mongolia</option>
          <option value="ME">Montenegro</option>
          <option value="MA">Morocco</option>
          <option value="MZ">Mozambique</option>
          <option value="MM">Myanmar</option>
          <option value="NA">Namibia</option>
          <option value="NR">Nauru</option>
          <option value="NP">Nepal</option>
          <option value="NL">Netherlands</option>
          <option value="NZ">New Zealand</option>
          <option value="NI">Nicaragua</option>
          <option value="NE">Niger</option>
          <option value="NG">Nigeria</option>
          <option value="MK">North Macedonia</option>
          <option value="NO">Norway</option>
          <option value="OM">Oman</option>
          <option value="PK">Pakistan</option>
          <option value="PW">Palau</option>
          <option value="PA">Panama</option>
          <option value="PG">Papua New Guinea</option>
          <option value="PY">Paraguay</option>
          <option value="PE">Peru</option>
          <option value="PH">Philippines</option>
          <option value="PL">Poland</option>
          <option value="PT">Portugal</option>
          <option value="QA">Qatar</option>
          <option value="RO">Romania</option>
          <option value="RU">Russia</option>
          <option value="RW">Rwanda</option>
          <option value="KN">Saint Kitts and Nevis</option>
          <option value="LC">Saint Lucia</option>
          <option value="VC">Saint Vincent and the Grenadines</option>
          <option value="WS">Samoa</option>
          <option value="SM">San Marino</option>
          <option value="ST">Sao Tome and Principe</option>
          <option value="SA">Saudi Arabia</option>
          <option value="SN">Senegal</option>
          <option value="RS">Serbia</option>
          <option value="SC">Seychelles</option>
          <option value="SL">Sierra Leone</option>
          <option value="SG">Singapore</option>
          <option value="SK">Slovakia</option>
          <option value="SI">Slovenia</option>
          <option value="SB">Solomon Islands</option>
          <option value="SO">Somalia</option>
          <option value="ZA">South Africa</option>
          <option value="SS">South Sudan</option>
          <option value="ES">Spain</option>
          <option value="LK">Sri Lanka</option>
          <option value="SD">Sudan</option>
          <option value="SR">Suriname</option>
          <option value="SE">Sweden</option>
          <option value="CH">Switzerland</option>
          <option value="SY">Syria</option>
          <option value="TW">Taiwan</option>
          <option value="TJ">Tajikistan</option>
          <option value="TZ">Tanzania</option>
          <option value="TH">Thailand</option>
          <option value="TL">Timor-Leste</option>
          <option value="TG">Togo</option>
          <option value="TO">Tonga</option>
          <option value="TT">Trinidad and Tobago</option>
          <option value="TN">Tunisia</option>
          <option value="TR">Turkey</option>
          <option value="TM">Turkmenistan</option>
          <option value="TV">Tuvalu</option>
          <option value="UG">Uganda</option>
          <option value="UA">Ukraine</option>
          <option value="AE">United Arab Emirates</option>
          <option value="GB">United Kingdom</option>
          <option value="US">United States</option>
          <option value="UY">Uruguay</option>
          <option value="UZ">Uzbekistan</option>
          <option value="VU">Vanuatu</option>
          <option value="VA">Vatican City</option>
          <option value="VE">Venezuela</option>
          <option value="VN">Vietnam</option>
          <option value="YE">Yemen</option>
          <option value="ZM">Zambia</option>
          <option value="ZW">Zimbabwe</option>
        </select>
      </div>


      <div class="form-group">
        <h4>Date de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <input type="date" name="date_naissance" required class="form-control">
      </div>

      <div class="form-group">
        <h4>Pays de naissance <span class="required-tooltip" title="Champ nécessaire">*</span></h4>
        <select name="pays_naissance" required class="form-control">
          <option value="">Sélectionnez le pays</option>
          <option value="AF">Afghanistan</option>
          <option value="AL">Albania</option>
          <option value="DZ">Algeria</option>
          <option value="AD">Andorra</option>
          <option value="AO">Angola</option>
          <option value="AG">Antigua and Barbuda</option>
          <option value="AR">Argentina</option>
          <option value="AM">Armenia</option>
          <option value="AU">Australia</option>
          <option value="AT">Austria</option>
          <option value="AZ">Azerbaijan</option>
          <option value="BS">Bahamas</option>
          <option value="BH">Bahrain</option>
          <option value="BD">Bangladesh</option>
          <option value="BB">Barbados</option>
          <option value="BY">Belarus</option>
          <option value="BE">Belgium</option>
          <option value="BZ">Belize</option>
          <option value="BJ">Benin</option>
          <option value="BT">Bhutan</option>
          <option value="BO">Bolivia</option>
          <option value="BA">Bosnia and Herzegovina</option>
          <option value="BW">Botswana</option>
          <option value="BR">Brazil</option>
          <option value="BN">Brunei</option>
          <option value="BG">Bulgaria</option>
          <option value="BF">Burkina Faso</option>
          <option value="BI">Burundi</option>
          <option value="CV">Cabo Verde</option>
          <option value="KH">Cambodia</option>
          <option value="CM">Cameroon</option>
          <option value="CA">Canada</option>
          <option value="CF">Central African Republic</option>
          <option value="TD">Chad</option>
          <option value="CL">Chile</option>
          <option value="CN">China</option>
          <option value="CO">Colombia</option>
          <option value="KM">Comoros</option>
          <option value="CD">Congo (Dem. Rep.)</option>
          <option value="CG">Congo (Rep.)</option>
          <option value="CR">Costa Rica</option>
          <option value="CI">Côte d'Ivoire</option>
          <option value="HR">Croatia</option>
          <option value="CU">Cuba</option>
          <option value="CY">Cyprus</option>
          <option value="CZ">Czech Republic</option>
          <option value="DK">Denmark</option>
          <option value="DJ">Djibouti</option>
          <option value="DM">Dominica</option>
          <option value="DO">Dominican Republic</option>
          <option value="EC">Ecuador</option>
          <option value="EG">Egypt</option>
          <option value="SV">El Salvador</option>
          <option value="GQ">Equatorial Guinea</option>
          <option value="ER">Eritrea</option>
          <option value="EE">Estonia</option>
          <option value="SZ">Eswatini</option>
          <option value="ET">Ethiopia</option>
          <option value="FJ">Fiji</option>
          <option value="FI">Finland</option>
          <option value="FR">France</option>
          <option value="GA">Gabon</option>
          <option value="GM">Gambia</option>
          <option value="GE">Georgia</option>
          <option value="DE">Germany</option>
          <option value="GH">Ghana</option>
          <option value="GR">Greece</option>
          <option value="GD">Grenada</option>
          <option value="GT">Guatemala</option>
          <option value="GN">Guinea</option>
          <option value="GW">Guinea-Bissau</option>
          <option value="GY">Guyana</option>
          <option value="HT">Haiti</option>
          <option value="HN">Honduras</option>
          <option value="HU">Hungary</option>
          <option value="IS">Iceland</option>
          <option value="IN">India</option>
          <option value="ID">Indonesia</option>
          <option value="IR">Iran</option>
          <option value="IQ">Iraq</option>
          <option value="IE">Ireland</option>
          <option value="IL">Israel</option>
          <option value="IT">Italy</option>
          <option value="JM">Jamaica</option>
          <option value="JP">Japan</option>
          <option value="JO">Jordan</option>
          <option value="KZ">Kazakhstan</option>
          <option value="KE">Kenya</option>
          <option value="KI">Kiribati</option>
          <option value="KP">Korea (North)</option>
          <option value="KR">Korea (South)</option>
          <option value="KW">Kuwait</option>
          <option value="KG">Kyrgyzstan</option>
          <option value="LA">Laos</option>
          <option value="LV">Latvia</option>
          <option value="LB">Lebanon</option>
          <option value="LS">Lesotho</option>
          <option value="LR">Liberia</option>
          <option value="LY">Libya</option>
          <option value="LI">Liechtenstein</option>
          <option value="LT">Lithuania</option>
          <option value="LU">Luxembourg</option>
          <option value="MG">Madagascar</option>
          <option value="MW">Malawi</option>
          <option value="MY">Malaysia</option>
          <option value="MV">Maldives</option>
          <option value="ML">Mali</option>
          <option value="MT">Malta</option>
          <option value="MH">Marshall Islands</option>
          <option value="MR">Mauritania</option>
          <option value="MU">Mauritius</option>
          <option value="MX">Mexico</option>
          <option value="FM">Micronesia</option>
          <option value="MD">Moldova</option>
          <option value="MC">Monaco</option>
          <option value="MN">Mongolia</option>
          <option value="ME">Montenegro</option>
          <option value="MA">Morocco</option>
          <option value="MZ">Mozambique</option>
          <option value="MM">Myanmar</option>
          <option value="NA">Namibia</option>
          <option value="NR">Nauru</option>
          <option value="NP">Nepal</option>
          <option value="NL">Netherlands</option>
          <option value="NZ">New Zealand</option>
          <option value="NI">Nicaragua</option>
          <option value="NE">Niger</option>
          <option value="NG">Nigeria</option>
          <option value="MK">North Macedonia</option>
          <option value="NO">Norway</option>
          <option value="OM">Oman</option>
          <option value="PK">Pakistan</option>
          <option value="PW">Palau</option>
          <option value="PA">Panama</option>
          <option value="PG">Papua New Guinea</option>
          <option value="PY">Paraguay</option>
          <option value="PE">Peru</option>
          <option value="PH">Philippines</option>
          <option value="PL">Poland</option>
          <option value="PT">Portugal</option>
          <option value="QA">Qatar</option>
          <option value="RO">Romania</option>
          <option value="RU">Russia</option>
          <option value="RW">Rwanda</option>
          <option value="KN">Saint Kitts and Nevis</option>
          <option value="LC">Saint Lucia</option>
          <option value="VC">Saint Vincent and the Grenadines</option>
          <option value="WS">Samoa</option>
          <option value="SM">San Marino</option>
          <option value="ST">Sao Tome and Principe</option>
          <option value="SA">Saudi Arabia</option>
          <option value="SN">Senegal</option>
          <option value="RS">Serbia</option>
          <option value="SC">Seychelles</option>
          <option value="SL">Sierra Leone</option>
          <option value="SG">Singapore</option>
          <option value="SK">Slovakia</option>
          <option value="SI">Slovenia</option>
          <option value="SB">Solomon Islands</option>
          <option value="SO">Somalia</option>
          <option value="ZA">South Africa</option>
          <option value="SS">South Sudan</option>
          <option value="ES">Spain</option>
          <option value="LK">Sri Lanka</option>
          <option value="SD">Sudan</option>
          <option value="SR">Suriname</option>
          <option value="SE">Sweden</option>
          <option value="CH">Switzerland</option>
          <option value="SY">Syria</option>
          <option value="TW">Taiwan</option>
          <option value="TJ">Tajikistan</option>
          <option value="TZ">Tanzania</option>
          <option value="TH">Thailand</option>
          <option value="TL">Timor-Leste</option>
          <option value="TG">Togo</option>
          <option value="TO">Tonga</option>
          <option value="TT">Trinidad and Tobago</option>
          <option value="TN">Tunisia</option>
          <option value="TR">Turkey</option>
          <option value="TM">Turkmenistan</option>
          <option value="TV">Tuvalu</option>
          <option value="UG">Uganda</option>
          <option value="UA">Ukraine</option>
          <option value="AE">United Arab Emirates</option>
          <option value="GB">United Kingdom</option>
          <option value="US">United States</option>
          <option value="UY">Uruguay</option>
          <option value="UZ">Uzbekistan</option>
          <option value="VU">Vanuatu</option>
          <option value="VA">Vatican City</option>
          <option value="VE">Venezuela</option>
          <option value="VN">Vietnam</option>
          <option value="YE">Yemen</option>
          <option value="ZM">Zambia</option>
          <option value="ZW">Zimbabwe</option>
        </select>
      </div>

      <div class="form-group">
        <h4>Département de naissance (France uniquement)</h4>
        <select name="dept_naissance" class="form-control">
          <option value="">Sélectionnez le département</option>
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
      <input type="text" id="pere_prenom3" name="pere_prenom3" placeholder="3ème prénom du père" style="width:100%;margin-top:8px;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
        <h4>Pays de naissance du père</h4>
        <div class="radio-options">
            <div class="form-check">
                <input type="radio" id="pere_pays_france" name="pere_pays_naissance" value="france" class="form-check-input">
                <label for="pere_pays_france" class="form-check-label">France</label>
            </div>
            <div class="form-check">
                <input type="radio" id="pere_pays_etranger" name="pere_pays_naissance" value="etranger" class="form-check-input">
                <label for="pere_pays_etranger" class="form-check-label">à l'étranger</label>
            </div>
        </div>
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
      <input type="text" id="mere_prenom3" name="mere_prenom3" placeholder="3ème prénom de la mère" style="width:100%;margin-top:8px;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
    </div>

    <div class="form-group">
        <h4>Pays de naissance de la mère</h4>
        <div class="radio-options">
            <div class="form-check">
                <input type="radio" id="mere_pays_france" name="mere_pays_naissance" value="france" class="form-check-input">
                <label for="mere_pays_france" class="form-check-label">France</label>
            </div>
            <div class="form-check">
                <input type="radio" id="mere_pays_etranger" name="mere_pays_naissance" value="etranger" class="form-check-input">
                <label for="mere_pays_etranger" class="form-check-label">à l'étranger</label>
            </div>
        </div>
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
  
  <label for="telephone">Téléphone portable</label>
  <input type="tel" id="telephone" name="telephone" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">
  
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:4px;" class="form-control">

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
      <button type="button" class="btn btn-secondary" onclick="prevStep(this)">Précédent</button>
      <button type="submit" class="btn btn-success ml-2">Procéder a ma commande</button>
    </div>
  </form>
</div>

</div>




<!------------------------------------------------- Boutons ------------------------------------------------------------------------------>



  <div class="buttons" style="display: flex; justify-content: center; gap: 20px; margin-top: 30px;">
  <button class="btn btn-secondary" id="prev-btn" onclick="prevStep()" style="display:none;">Précédent</button>
  <button class="btn btn-primary" id="next-btn" onclick="nextStep(this)">Suivant</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
      $(document).ready(function() {
          // Pre-select radio button based on URL parameter
          const urlParams = new URLSearchParams(window.location.search);
          const type = urlParams.get('type');
          if (type === 'majeur' || type === 'mineur') {
            const radio = document.getElementById(type);
            if (radio) {
              radio.checked = true;
              sessionStorage.setItem('type', type); // Explicitly save to sessionStorage
              $(radio).trigger('change'); // Use jQuery to trigger change for compatibility
              markFilled(radio);
            }
          }

          let phoneInputInstance; // Make instance accessible

          function initializeIntlTelInput() {
            const phoneInput = document.querySelector("#telephone");
            if (phoneInput) {
              phoneInputInstance = window.intlTelInput(phoneInput, {
                initialCountry: "fr",
                separateDialCode: true,
                placeholderNumberType: 'MOBILE',
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
              });

              // Listen for changes and update sessionStorage
              phoneInput.addEventListener('keyup', updateSessionStorage);
              phoneInput.addEventListener('countrychange', updateSessionStorage);

              function updateSessionStorage() {
                if (phoneInputInstance) {
                  const fullNumber = phoneInputInstance.getNumber();
                  sessionStorage.setItem('telephone', fullNumber);
                }
              }
            }
          }

          initializeIntlTelInput();

          // Handle form submission to include the full number
          $('#stripe-form').on('submit', function(e) {
            if (phoneInputInstance) {
              const fullNumber = phoneInputInstance.getNumber();
              const phoneInput = document.querySelector("#telephone");
              phoneInput.value = fullNumber; // Update the original input's value
              sessionStorage.setItem('telephone', fullNumber); // Final update just in case
            }
          });

          const departementSelect = $('select[name="departement"]');
          const deptNaissanceSelect = $('select[name="dept_naissance"]');
          const dateNaissanceInput = $('input[name="date_naissance"]');

          // Create a list of departments from the hardcoded options
          const departements = [];
          departementSelect.find('option').each(function() {
              if ($(this).val()) {
                  departements.push({ id: $(this).val(), text: $(this).text() });
              }
          });

          // Populate the "dept_naissance" dropdown
          deptNaissanceSelect.empty().append('<option value="">Sélectionnez le département</option>');
          departements.forEach(function(departement) {
              deptNaissanceSelect.append(new Option(departement.text, departement.id));
          });

          const select2Elements = $('select[name="departement"], select[name="dept_naissance"], select[name="taille"], select[name="pays_naissance"]');

          select2Elements.select2({
              theme: 'bootstrap4'
          }).on('select2:select', function (e) {
              var $el = $(this);
              var $container = $el.next('.select2-container');
              var $selection = $container.find('.select2-selection--single');
              if ($el.val() && $el.val().trim() !== '') {
                  $selection.addClass('filled');
              } else {
                  $selection.removeClass('filled');
              }
          }).on('select2:unselect', function (e) {
                var $el = $(this);
                var $container = $el.next('.select2-container');
                var $selection = $container.find('.select2-selection--single');
                if ($el.val() && $el.val().trim() !== '') {
                    $selection.addClass('filled');
                } else {
                    $selection.removeClass('filled');
                }
          });

        $('input[name="type"]').on('change', function() {
            const today = new Date();
            const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

            if (this.value === 'majeur') {
                dateNaissanceInput.attr('max', eighteenYearsAgo.toISOString().split('T')[0]);
                dateNaissanceInput.attr('min', '');
            } else { // mineur
                dateNaissanceInput.attr('min', eighteenYearsAgo.toISOString().split('T')[0]);
                dateNaissanceInput.attr('max', '');
            }
        });

        dateNaissanceInput.on('change', function() {
            const selectedDate = new Date($(this).val());
            const today = new Date();
            const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
            const type = $('input[name="type"]:checked').val();

            if (type === 'majeur' && selectedDate > eighteenYearsAgo) {
                showAlert('❌ Pour un majeur, la date de naissance ne peut pas être après le ' + eighteenYearsAgo.toLocaleDateString());
                $(this).val('');
            } else if (type === 'mineur' && selectedDate < eighteenYearsAgo) {
                showAlert('❌ Pour un mineur, la date de naissance ne peut pas être avant le ' + eighteenYearsAgo.toLocaleDateString());
                $(this).val('');
            }
        });
      });
    </script>
  
    <!-- JavaScripts Link -->  
    <script src="{{ asset('js/forms.js') }}"></script>


    <script type="text/javascript">
        function markFilled(el) {
            const $el = $(el);
            if ($el.is('select')) {
                const $container = $el.next('.select2-container');
                if ($container.length) {
                    const $selection = $container.find('.select2-selection--single');
                    if ($el.val() && $el.val().trim() !== '') {
                        $selection.addClass('filled');
                    } else {
                        $selection.removeClass('filled');
                    }
                } else {
                    if ($el.val() && $el.val().trim() !== '') {
                        $el.addClass('filled');
                    } else {
                        $el.removeClass('filled');
                    }
                }
            } else {
                if ($el.val() && $el.val().trim() !== '') {
                    $el.addClass('filled');
                }
                else {
                    $el.removeClass('filled');
                }
            }
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