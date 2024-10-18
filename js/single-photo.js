document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments
    const modal = document.getElementById('contactModal');
    const openModalButton = document.querySelector('.contact-button'); // Bouton CONTACT sur la page
    const closeModalBtn = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');

    // Ouvrir la modale
    if (openModalButton) {
        console.log('test ouverture modal');
        openModalButton.addEventListener('click', function (event) {
            event.preventDefault();
            modal.classList.add('show'); // Affiche la modale
        });
    }

    // Fermer la modale avec le bouton de fermeture
    if (closeModalBtn) {
        console.log('test fermeture modal');
        closeModalBtn.addEventListener('click', function () {
            modal.classList.remove('show');
        });
    }

    // Fermer la modale en cliquant sur l'overlay
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function () {
            modal.classList.remove('show');
        });
    }
});