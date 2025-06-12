


document.addEventListener('DOMContentLoaded', function() {
    const openModalElements = document.querySelectorAll('.open-modal');
    const modal = document.getElementById('modalCompte');
    const overlay = document.getElementById('overlay');
    const closeModalBtn = document.getElementById('closeModalBtn');

    console.log('openModalElements:', openModalElements);
    console.log('modal:', modal);
    console.log('overlay:', overlay);
    console.log('closeModalBtn:', closeModalBtn);

    if (!modal || !overlay || !closeModalBtn) {
        console.warn("La modale n'est pas présente sur cette page.");
        return;
    }

    openModalElements.forEach(function(element) {
        element.addEventListener('click', function() {
            console.log("Ouverture de la modale...");
            modal.classList.add('active');
            overlay.classList.add('active');
        });
    });

    closeModalBtn.addEventListener('click', function() {
        console.log("Fermeture de la modale (croix)...");
        modal.classList.remove('active');
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', function() {
        console.log("Fermeture de la modale (overlay)...");
        modal.classList.remove('active');
        overlay.classList.remove('active');
    });
});

//Script pour cacher la description et l'afficher quand on click sur le bouton


document.addEventListener('DOMContentLoaded', function() {
  const toggleButtons = document.querySelectorAll('.toggle-desc');
  toggleButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      // Trouver l'élément description dans le même conteneur produit-info
      const description = button.parentElement.querySelector('.description');
      if (description.style.display === 'none' || description.style.display === '') {
        description.style.display = 'block';
        button.textContent = 'Masquer la description';
      } else {
        description.style.display = 'none';
        button.textContent = 'Voir la description';
      }
    });
  });
});

