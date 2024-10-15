document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments
    const modal = document.getElementById('contactModal');
    const openModalLinks = document.querySelectorAll('.open-contact-modal'); // Tous les liens avec cette classe
    const closeModalBtn = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');

    // Ouvrir la modale
    openModalLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            modal.classList.add('show'); // Affiche la modale
        });
    });

    // Fermer la modale avec le bouton de fermeture
    if (closeModalBtn) {
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


    

    /**  Navigation entre les photos */
    let currentIndex = 0;
    const items = jQuery('.gallery-item'); // Utilisez jQuery ici
    const itemAmt = items.length;

    function cycleItems() {
        items.hide();
        items.eq(currentIndex).css('display', 'inline-block');
    }
        
    jQuery('.next').click(function () { // Utilisez jQuery ici
        currentIndex = (currentIndex + 1) % itemAmt;
        cycleItems();
    });

    jQuery('.prev').click(function () { // Utilisez jQuery ici
        currentIndex = (currentIndex - 1 + itemAmt) % itemAmt;
        cycleItems();
    });

    cycleItems(); // Initialiser l'affichage

    jQuery('#load-more-posts').on('click', function () {
        console.log('Chargement de plus de photos déclenché'); // Vérifie si le clic est bien détecté
        let inputPage = jQuery('input[name="page"]');
        let page = parseInt(inputPage.val());
        page++; // Incrémente le numéro de page
        
        // Envoie la requête AJAX pour charger plus de photos
        jQuery.ajax({
            url: myAjax.ajax_url, // URL définie dans le wp_localize_script
            type: 'POST',  // Utilisation de POST
            data: {
                action: 'load_more_photos', // Nom de l'action AJAX
                page: page,  // Page actuelle
            },
            success: function (response) {
                console.log(response); // Affiche la réponse dans la console pour voir ce qui est renvoyé
        
                if (response) {
                    jQuery('#thumbnail-container').append(response); // Ajoute les nouvelles images
                    inputPage.val(page); // Met à jour la valeur de la page
                    console.log('Photos ajoutées');
                } else {
                    console.log('Aucune autre photo disponible');
                    jQuery('#load-more-posts').hide(); // Cache le bouton si plus de photos ne sont disponibles
                }
            },
            error: function () {
                alert('Une erreur s\'est produite lors du chargement des photos.');
            }
        });
    });
    
    



jQuery(document).ready(function($) {
    console.log('jQuery est chargé');
});
