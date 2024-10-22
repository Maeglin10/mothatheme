document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments pour la deuxième modale
    const modalSingle = document.getElementById('contactModalSingle');
    const openModalLinksSingle = document.querySelectorAll('.open-contact-modal-single'); // Liens pour la deuxième modale
    const closeModalBtnSingle = document.querySelector('.modal-close-single');
    const modalOverlaySingle = document.querySelector('.modal-overlay-single');

    // Ouvrir la deuxième modale
    openModalLinksSingle.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            modalSingle.classList.add('show'); // Affiche la modale
        });
    });

    // Fermer la modale avec le bouton de fermeture
    if (closeModalBtnSingle) {
        closeModalBtnSingle.addEventListener('click', function () {
            modalSingle.classList.remove('show');
        });
    }

    // Fermer la modale en cliquant sur l'overlay
    if (modalOverlaySingle) {
        modalOverlaySingle.addEventListener('click', function () {
            modalSingle.classList.remove('show');
        });
    }
});
