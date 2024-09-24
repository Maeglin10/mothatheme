document.addEventListener('DOMContentLoaded', function() {
    // Sélection des éléments
    const modal = document.getElementById('contactModal');
    const openModalBtn = document.querySelector('a[data-toggle="modal"]');
    const closeModalBtn = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');

    // Fonction pour ouvrir la modale
    openModalBtn.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = 'block';
    });

    // Fonction pour fermer la modale
    closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Fermer la modale quand on clique en dehors
    modalOverlay.addEventListener('click', function() {
        modal.style.display = 'none';
    });
});

openModalBtn.addEventListener('click', function(event) {
    event.preventDefault();
    modal.classList.add('show');
});

closeModalBtn.addEventListener('click', function() {
    modal.classList.remove('show');
});
