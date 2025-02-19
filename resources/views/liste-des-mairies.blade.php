<!doctype html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
<!-- E N D  N A V B A R -->


<section id="banner">
  <div class="container text-center">
    <div class="icon">
      <i class="bi bi-card-heading"></i>
    </div>
    <h1 class="mt-3">Liste des mairies délivrant des cartes d'identité par département</h1>
  </div>
</section>





  <!-- T A B -->
<section id="departments">
  <div class="container">
    <div class="departments-table">
      <!-- Exemple de départements -->
      <div class="department" data-department="Paris">
        <h3>Paris (75) <span class="toggle-icon">↓</span></h3>
        <ul class="mairies-list" style="display: none;">
          <!-- Les mairies seront ajoutées ici par JavaScript -->
        </ul>
      </div>
      <div class="department" data-department="Bouches-du-Rhône">
        <h3>Bouches-du-Rhône (13) <span class="toggle-icon">↓</span></h3>
        <ul class="mairies-list" style="display: none;">
          <!-- Les mairies seront ajoutées ici par JavaScript -->
        </ul>
      </div>
      <div class="department" data-department="Nord">
        <h3>Nord (59) <span class="toggle-icon">↓</span></h3>
        <ul class="mairies-list" style="display: none;">
          <!-- Les mairies seront ajoutées ici par JavaScript -->
        </ul>
      </div>
      <div class="department" data-department="Rhône">
        <h3>Rhône (69) <span class="toggle-icon">↓</span></h3>
        <ul class="mairies-list" style="display: none;">
          <!-- Les mairies seront ajoutées ici par JavaScript -->
        </ul>
      </div>
    </div>
  </div>
</section>




  <!-- E N D  T A B -->

































  <!--  F O O T E R  -->
  @include('layouts.footer')

  <!--  E N D  F O O T E R  -->
    

    <!-- External JavaScripts -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  


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
  // Exemple de données des mairies
const mairies = {
  Paris: ["Mairie du 1er arrondissement", "Mairie du 2e arrondissement", "Mairie du 3e arrondissement"],
  "Bouches-du-Rhône": ["Mairie de Marseille", "Mairie d'Aix-en-Provence", "Mairie d'Arles"],
  Nord: ["Mairie de Lille", "Mairie de Roubaix", "Mairie de Tourcoing"],
  Rhône: ["Mairie de Lyon", "Mairie de Villeurbanne", "Mairie de Vénissieux"],
};

// Sélection des départements
const departments = document.querySelectorAll(".department");

// Ajout des événements de clic
departments.forEach((department) => {
  department.addEventListener("click", () => {
    const departmentName = department.getAttribute("data-department");
    const mairiesInDepartment = mairies[departmentName] || [];
    const mairiesList = department.querySelector(".mairies-list");

    // Si la liste est déjà visible, on la cache
    if (mairiesList.style.display === "block") {
      mairiesList.style.display = "none";
    } else {
      // Sinon, on l'affiche et on ajoute les mairies
      mairiesList.innerHTML = "";  // Réinitialiser la liste avant de l'afficher
      mairiesInDepartment.forEach((mairie) => {
        const listItem = document.createElement("li");
        listItem.textContent = mairie;
        mairiesList.appendChild(listItem);
      });
      mairiesList.style.display = "block";  // Afficher la liste
    }
  });
});

</script>




  </body>
</html>