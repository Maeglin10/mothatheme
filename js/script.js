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

    /** Chargement de plus de photos via AJAX */
    jQuery('#load-more-posts').on('click', function () {
        console.log('test-function');
        // Chargement de plus de photos via AJAX
        let inputPage = jQuery('input[name="page"]');
        let page = parseInt(inputPage.val());
        page++; // Incrémente le numéro de page si "load" est vrai, sinon réinitialise à 1.
        const category = jQuery('select[name="filter-category"]').val();
        const format = jQuery('select[name="format-filter"]').val();
        const dateSort = jQuery('select[name="date-sort"]').val();

        // Envoie la requête AJAX pour charger plus de photos
        jQuery.ajax({
            url: myAjax.ajax_url, // URL définie dans le localize_script de WordPress
            type: 'GET',
            data: {
                action: 'load_more_photos', // Nom de l'action
                page,
                category,
                format,
                dateSort
            },
            success: function (response) {
                if (response) {
                    jQuery('.thumbnail-container').append(response); // Ajoute les nouvelles images
                    console.log('test-if');
                } else {
                    jQuery('#load-more-posts').hide(); // Cache le bouton si aucune photo supplémentaire n'est disponible
                    console.log('test-else');
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


jQuery(document).ready(function ($) {
    $('#load-more-posts').on('click', function () {
        console.log('test-function');
        // Chargement de plus de photos via AJAX
        let inputPage = $('input[name="page"]');
        let page = parseInt(inputPage.val());
        page++; // Incrémente le numéro de page si "load" est vrai, sinon réinitialise à 1.
        const category = $('select[name="filter-category"]').val();
        const format = $('select[name="format-filter"]').val();
        const dateSort = $('select[name="date-sort"]').val();

        // Envoie la requête AJAX pour charger plus de photos
        $.ajax({
            url: myAjax.ajax_url, // URL définie dans le localize_script de WordPress
            type: 'GET',
            data: {
                action: 'load_more_photos', // Nom de l'action
                page,
                category,
                format,
                dateSort
            },
            success: function (response) {
                if (response) {
                    $('.thumbnail-container').append(response); // Ajoute les nouvelles images
                    console.log('test-if');
                } else {
                    $('#load-more-posts').hide(); // Cache le bouton si aucune photo supplémentaire n'est disponible
                    console.log('test-else');
                }
            },
            error: function () {
                alert('Une erreur s\'est produite lors du chargement des photos.');
            }
        });
    });
})
