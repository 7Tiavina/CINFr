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

  document.getElementById('prev-btn').style.display = step === 1 ? 'none' : 'inline-block';
  document.getElementById('next-btn').textContent = step === totalSteps ? 'Terminer' : 'Suivant';

  currentStep = step;
  sessionStorage.setItem('currentStep', currentStep);
}

function validateCurrentStep() {
  const currentFormPart = document.querySelector(`#step-${currentStep}`);
  if (!currentFormPart) return false;
  
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
// fonctions pour afficher et cacher l’alerte automatiquement
function showAlert(msg) {
  const alertBox = document.getElementById('custom-alert');
  document.getElementById('custom-alert-msg').textContent = msg;
  alertBox.classList.add('show');
  // se ferme automatiquement après 3 secondes
  setTimeout(() => {
    alertBox.classList.remove('show');
  }, 3000);
}

function hideAlert() {
  document.getElementById('custom-alert').classList.remove('show');
}
// clic sur la croix pour fermer
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('custom-alert-close')
    .addEventListener('click', hideAlert);
});

function nextStep() {
  const totalSteps = document.querySelectorAll('.form-part').length;
  if (validateCurrentStep()) {
    if (currentStep < totalSteps) {
      showFormPart(currentStep + 1);
    } else {
      showAlert('✅ Formulaire complété avec succès !');
    }
  } else {
    showAlert('❌ Veuillez remplir tous les champs obligatoires avant de continuer.');
  }
}

function prevStep() {
  if (currentStep > 1) {
    showFormPart(currentStep - 1);
  }
}

function processPayment() {
  showAlert('🔄 Paiement en cours…');
}

window.onload = function () {
  // Restaure l’étape sauvegardée
  const savedStep = parseInt(sessionStorage.getItem('currentStep'));
  if (!isNaN(savedStep)) currentStep = savedStep;
  showFormPart(currentStep);

  // Debug : afficher tout le sessionStorage au chargement
  console.group('🔍 sessionStorage au chargement');
  for (let i = 0; i < sessionStorage.length; i++) {
    const key = sessionStorage.key(i);
    console.log(key, sessionStorage.getItem(key));
  }
  console.groupEnd();

  // Restaure/écoute tous les inputs, selects, textarea
  document.querySelectorAll('input, select, textarea').forEach(input => {
    const key = input.name || input.id;
    const saved = sessionStorage.getItem(key);
    if (saved !== null) {
      if (input.type === 'radio' || input.type === 'checkbox') {
        input.checked = saved === 'true';
      } else {
        input.value = saved;
      }
    }

    // À chaque saisie, on stocke et on loggue dans sessionStorage
    input.addEventListener('input', () => {
      const valueToStore = (input.type === 'radio' || input.type === 'checkbox')
        ? input.checked
        : input.value;
      sessionStorage.setItem(key, valueToStore);
      console.log('🔄 sauvegarde', key, '→', valueToStore);
    });

    // Pour les radios : mise à jour de tout le groupe et log
    if (input.type === 'radio') {
      input.addEventListener('change', () => {
        document.querySelectorAll(`input[name="${input.name}"]`)
          .forEach(radio => {
            sessionStorage.setItem(radio.name, radio.checked);
            console.log('🔄 sauvegarde radio', radio.name, '→', radio.checked);
          });
      });
    }
  });
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
