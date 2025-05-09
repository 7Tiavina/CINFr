	//Gestion contenu du Formulaire-----------------------------------------------------------------------------------


let currentStep = 1;

function showFormPart(step) {
  const steps = document.querySelectorAll('.form-part');
  const totalSteps = steps.length;

  steps.forEach((part, index) => {
    part.style.display = index + 1 === step ? 'block' : 'none';
  });

  const progressBar = document.getElementById('progress-bar');
  if (progressBar) {
    progressBar.style.width = `${(step / totalSteps) * 100}%`;
  }

  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');
  
  prevBtn.style.display = step === 1 ? 'none' : 'inline-block';

  if (step === totalSteps) {
    nextBtn.style.display = 'none'; // Cache le bouton "Suivant / Terminer"
    document.getElementById('pay-btn').style.display = 'inline-block'; // Affiche le bouton Payer
  } else {
    nextBtn.style.display = 'inline-block';
    nextBtn.textContent = 'Suivant';
    document.getElementById('pay-btn').style.display = 'none'; // Cache le bouton Payer
  }

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



	//Gestion du Navbar-----------------------------------------------------------------------------

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




    //Boutons de scroll-------------------------------------------------------------------------------
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
