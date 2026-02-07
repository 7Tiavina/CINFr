//Gestion contenu du Formulaire-----------------------------------------------------------------------------------
let currentStep = 1;

function showFormPart(step) {
  const steps = document.querySelectorAll('.form-part');
  const totalSteps = steps.length;

  steps.forEach((part, index) => {
    part.style.display = index + 1 === step ? 'block' : 'none';
  });

  const progressBar = document.getElementById('progress-bar');
  const progressBarText = document.getElementById('progress-bar-text');
  if (progressBar) {
    const progress = (step / totalSteps) * 100;
    progressBar.style.width = `${progress}%`;
    progressBar.setAttribute('aria-valuenow', progress);
    progressBarText.textContent = `${Math.round(progress)}%`;
  }

  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');

  // Cacher les boutons à l étape 6
  if (step === 6) {
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
    displayRecap();
  } else {
    prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
    nextBtn.textContent = step === totalSteps -1 ? 'Voir le récapitulatif' : 'Suivant';
    nextBtn.style.display = 'inline-block';
  }

  currentStep = step;
  sessionStorage.setItem('currentStep', currentStep);
  window.scrollTo(0, 0);
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
      } else if (field.type === 'email') {
        const emailRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!emailRegex.test(field.value)) {
          isValid = false;
          field.style.border = '1px solid red';
          showAlert('â veuillez donné une adresse mail valide s\'il vous plais'); // Specific alert for email
        } else {
          field.style.border = '1px solid #ddd';
        }
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
  }, 5000);
}

function hideAlert() {
  document.getElementById('custom-alert').classList.remove('show');
}
// clic sur la croix pour fermer
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('custom-alert-close')
    .addEventListener('click', hideAlert);
});

function nextStep(buttonElement) {
  buttonElement.classList.add('loading');

  const totalSteps = document.querySelectorAll('.form-part').length;

  if (currentStep === 3) {
    const type = sessionStorage.getItem('type');
    if (type === 'mineur') {
      const pereInconnuOui = document.getElementById('pere-inconnu-oui').checked;
      const mereInconnueOui = document.getElementById('mere-inconnue-oui').checked;

      if (pereInconnuOui && mereInconnueOui) {
          showAlert('â Vous devez renseigner au moins un des deux parents (père ou mère).');
          buttonElement.classList.remove('loading');
          return;
      }
    }
    
    // Always validate the visible fields
    if (!validateCurrentStep()) {
        showAlert('â Veuillez remplir tous les champs obligatoires avant de continuer.');
        buttonElement.classList.remove('loading');
        return;
    }
  } else if (currentStep === 4) {
    const nationaliteCheckboxes = document.querySelectorAll('#step-4 input[type="checkbox"]');
    let isNationaliteSelected = false;
    nationaliteCheckboxes.forEach(checkbox => {
      if (checkbox.checked) {
        isNationaliteSelected = true;
      }
    });
    if (!isNationaliteSelected) {
      showAlert('â Veuillez choisir au moins un motif pour la nationalité française.');
      buttonElement.classList.remove('loading');
      return;
    }

  } else {
    if (!validateCurrentStep()) {
        showAlert('â Veuillez remplir tous les champs obligatoires avant de continuer.');
        buttonElement.classList.remove('loading');
        return;
    }
  }


  if (currentStep < totalSteps) {
    setTimeout(() => {
        showFormPart(currentStep + 1);
        buttonElement.classList.remove('loading');
    }, 500);
  } else {
    document.getElementById('stripe-form').submit();
  }
}



function prevStep(buttonElement) {
    const btn = buttonElement || document.getElementById('prev-btn');
    btn.classList.add('loading');
    setTimeout(() => {
        if (currentStep > 1) {
            showFormPart(currentStep - 1);
        }
        btn.classList.remove('loading');
    }, 500);
}

function processPayment() {
  showAlert('ð Paiement en cours…');
}

window.onload = function () {
  // Restaure l’étape sauvegardée
  const savedStep = parseInt(sessionStorage.getItem('currentStep'));
  if (!isNaN(savedStep)) currentStep = savedStep;
  showFormPart(currentStep);

  // Debug : afficher tout le sessionStorage au chargement
  console.group('ð sessionStorage au chargement');
  for (let i = 0; i < sessionStorage.length; i++) {
    const key = sessionStorage.key(i);
    console.log(key, sessionStorage.getItem(key));
  }
  console.groupEnd();

  // --- Restauration des valeurs existantes ---
  document.querySelectorAll('input, select, textarea').forEach(el => {
    const key = el.name || el.id;
    const saved = sessionStorage.getItem(key);
    if (saved !== null) {
      if (el.type === 'radio') {
        el.checked = (el.value === saved);
      } else if (el.type === 'checkbox') {
        el.checked = (saved === el.value);
      } else {
        el.value = saved;
      }
    }
  });

  // --- Nouvelle gestion unifiée du stockage de la valeur ---
  function saveField(e) {
    let val;
    if (e.target.type === 'radio') {
      if (!e.target.checked) return;        // n’enregistre que lorsqu’on coche
      val = e.target.value;
    } else if (e.target.type === 'checkbox') {
      val = e.target.checked ? e.target.value : '';
    } else {
      val = e.target.value;
    }
    sessionStorage.setItem(e.target.name, val);
    console.log('ð sauvegarde', e.target.name, '→', val);
  }

  // Attache l’écouteur adéquat selon le type de champ
  document.querySelectorAll('input, select, textarea').forEach(el => {
    const evt = (el.type === 'radio' || el.type === 'checkbox') ? 'change' : 'input';
    el.addEventListener(evt, saveField);
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
                showAlert('â Pour un majeur, la date de naissance ne peut pas être après le ' + eighteenYearsAgo.toLocaleDateString());
                $(this).val('');
            } else if (type === 'mineur' && selectedDate < eighteenYearsAgo) {
                showAlert('â Pour un mineur, la date de naissance ne peut pas être avant le ' + eighteenYearsAgo.toLocaleDateString());
                $(this).val('');
            }
        });
      // Add loading state to the final submit button
  const stripeForm = document.getElementById('stripe-form');
  if (stripeForm) {
    stripeForm.addEventListener('submit', function() {
      const submitButton = this.querySelector('button[type="submit"]');
      if (submitButton) {
        submitButton.classList.add('loading');
      }
    });
  }
};


function toggleRequired(containerId, isRequired) {
  const container = document.getElementById(containerId);
  if (container) {
    const fieldsToToggle = [];
    if (containerId === 'pere-details') {
      fieldsToToggle.push(document.getElementById('pere_nom'));
      fieldsToToggle.push(document.getElementById('pere_prenom1'));
    } else if (containerId === 'mere-details') {
      fieldsToToggle.push(document.getElementById('mere_nom'));
      fieldsToToggle.push(document.getElementById('mere_prenom1'));
    }

    fieldsToToggle.forEach(field => {
      if (field) {
        if (isRequired) {
          field.setAttribute('required', 'required');
        } else {
          field.removeAttribute('required');
        }
      }
    });
  }
}

document.getElementById('pere-inconnu-non').addEventListener('change', function () {
  document.getElementById('pere-details').style.display = this.checked ? 'block' : 'none';
  toggleRequired('pere-details', this.checked);
});

document.getElementById('pere-inconnu-oui').addEventListener('change', function () {
  document.getElementById('pere-details').style.display = this.checked ? 'none' : 'block';
  toggleRequired('pere-details', !this.checked); // Not required if unknown
});

document.getElementById('mere-inconnue-non').addEventListener('change', function () {
  document.getElementById('mere-details').style.display = this.checked ? 'block' : 'none';
  toggleRequired('mere-details', this.checked);
});

document.getElementById('mere-inconnue-oui').addEventListener('change', function () {
  document.getElementById('mere-details').style.display = this.checked ? 'none' : 'block';
  toggleRequired('mere-details', !this.checked); // Not required if unknown
});

document.querySelector('input[name="deuxieme_nom"]').addEventListener('input', function() {
  const detailsDiv = document.getElementById('deuxieme_nom_details');
  if (this.value.trim() !== '') {
    detailsDiv.style.display = 'block';
  } else {
    detailsDiv.style.display = 'none';
  }
});

document.querySelectorAll('input[name="mot_devant"]').forEach(radio => {
  radio.addEventListener('change', function() {
    const motDiv = document.getElementById('mot_a_afficher_div');
    if (this.value === 'oui') {
      motDiv.style.display = 'block';
    } else {
      motDiv.style.display = 'none';
    }
  });
});


  //Gestion du Navbar-----------------------------------------------------------------------------

  let previousScrollPosition = window.pageYOffset;
  const navbar = document.querySelector('.custom-navbar');
  const threshold = 100; // Seuil pour activer l affichage via le pointeur

  // Gérer le défilement
  window.addEventListener('scroll', () => {
    const currentScrollPosition = window.pageYOffset;

    if (previousScrollPosition > currentScrollPosition) {
      // L utilisateur défile vers le haut, afficher la navbar
      navbar.style.top = "0";
    } else {
      // L utilisateur défile vers le bas, cacher la navbar
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


function displayRecap() {
    const recapContainer = document.getElementById('recap-container');
    let html = '<h3>Récapitulatif de vos informations</h3>';

    const fields = [
        { label: 'Type de demande', name: 'type' },
        { label: 'Situation Familiale', name: 'situation_familiale' },
        { label: 'Raison de la demande', name: 'raison' },
        { label: 'Département', name: 'departement' },
        { label: 'Sexe', name: 'sexe' },
        { label: 'Nom de naissance', name: 'nom_naissance' },
        { label: 'Deuxième nom', name: 'deuxieme_nom' },
        { label: 'Prénoms', name: 'prenom1' },
        { label: '', name: 'prenom2' },
        { label: '', name: 'prenom3' },
        { label: 'Taille', name: 'taille' },
        { label: 'Couleur des yeux', name: 'couleur_yeux' },
        { label: 'Nationalité', name: 'nationalite' },
        { label: 'Date de naissance', name: 'date_naissance' },
        { label: 'Pays de naissance', name: 'pays_naissance' },
        { label: 'Département de naissance', name: 'dept_naissance' },
        { label: 'Commune de naissance', name: 'commune_naissance' },
        { label: 'Père inconnu', name: 'pere_inconnu' },
        { label: 'Nom du père', name: 'pere_nom' },
        { label: 'Prénoms du père', name: 'pere_prenom1' },
        { label: '', name: 'pere_prenom2' },
        { label: 'Date de naissance du père', name: 'pere_naissance_date' },
        { label: 'Ville de naissance du père', name: 'pere_naissance_ville' },
        { label: 'Nationalité du père', name: 'pere_nationalite' },
        { label: 'Mère inconnue', name: 'mere_inconnue' },
        { label: 'Nom de la mère', name: 'mere_nom' },
        { label: 'Prénoms de la mère', name: 'mere_prenom1' },
        { label: '', name: 'mere_prenom2' },
        { label: 'Date de naissance de la mère', name: 'mere_naissance_date' },
        { label: 'Ville de naissance de la mère', name: 'mere_naissance_ville' },
        { label: 'Nationalité de la mère', name: 'mere_nationalite' },
        { label: 'Adresse', name: 'adresse' },
        { label: 'Ville', name: 'ville' },
        { label: 'Code postal', name: 'code_postal' },
        { label: "Complément d'adresse", name: 'adresse_complement' },
        { label: 'Téléphone', name: 'telephone' },
        { label: 'Email', name: 'email' },
    ];

    fields.forEach(field => {
        const value = sessionStorage.getItem(field.name);
        if (value) {
            html += `<p><strong>${field.label}:</strong> ${value}</p>`;
        }
    });

    // Add motif_nationalite to recap
    const nationaliteMotifs = [];
    for (let i = 0; i < sessionStorage.length; i++) {
        const key = sessionStorage.key(i);
        if (key.startsWith('nat_')) {
            const value = sessionStorage.getItem(key);
            if (value) {
                // For 'nat_autre_texte', combine it with the 'nat_autre' label
                if (key === 'nat_autre_texte' && value.trim() !== '') {
                    const autreLabel = document.querySelector('label[for="nat_autre"]')?.textContent || 'Autre motif';
                    // To avoid duplicates, we find and replace the simple "Autre motif" if it exists
                    const index = nationaliteMotifs.indexOf(autreLabel);
                    if (index > -1) {
                        nationaliteMotifs[index] = `${autreLabel}: ${value}`;
                    } else {
                        nationaliteMotifs.push(`${autreLabel}: ${value}`);
                    }
                } else if (key === 'nat_autre' && value) {
                    const autreLabel = document.querySelector('label[for="nat_autre"]')?.textContent || 'Autre motif';
                    const autreText = sessionStorage.getItem('nat_autre_texte');
                    if (autreText && autreText.trim() !== '') {
                        // Already handled by the case above
                    } else {
                        nationaliteMotifs.push(autreLabel);
                    }
                } else if (key !== 'nat_autre' && key !== 'nat_autre_texte') {
                    const label = document.querySelector(`label[for="${key}"]`)?.textContent;
                    if (label) {
                        nationaliteMotifs.push(label);
                    }
                }
            }
        }
    }

    if (nationaliteMotifs.length > 0) {
        html += `<p><strong>Vous êtes Français(e) car :</strong><br>${nationaliteMotifs.join('<br>')}</p>`;
    }

    const formSection = document.getElementById('form-background');
    const type = sessionStorage.getItem('type');
    const prixMajeur = formSection.dataset.prix_majeur;
    const prixMineur = formSection.dataset.prix_mineur;
    const price = type === 'majeur' ? prixMajeur : prixMineur;
    const typeText = type === 'majeur' ? 'Majeur' : 'Mineur';

    html += `<hr>`;
    html += `<div class="recap-price">
`;
    html += `  <p>Montant à régler pour une personne <strong>${typeText}</strong></p>
`;
    html += `  <span>${price} €</span>
`;
    html += `</div>`;

    recapContainer.innerHTML = html;

    // Set the value of the hidden input
    document.getElementById('stripe-form-type').value = type;
}