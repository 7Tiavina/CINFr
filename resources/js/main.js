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


    lottie.loadAnimation({
        container: document.getElementById('lottie-bg'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: '/lotties/Animation - 1745500384634.json'
    });


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
