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
        console.log('Chargement de plus de photos déclenché');
        let inputPage = jQuery('input[name="page"]');
        let page = parseInt(inputPage.val()) + 1;
        let category = jQuery('#filter-category').val();
        let format = jQuery('#filter-format').val();
        let dateOrder = jQuery('#filter-date').val();
    
        // Envoie la requête AJAX pour charger plus de photos filtrées
        jQuery.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_filtered_photos',
                page: page,
                category: category,
                format: format,
                date: dateOrder
            },
            success: function (response) {
                if (response) {
                    jQuery('#thumbnail-container').append(response); // Ajoute les nouvelles images
                    inputPage.val(page); // Met à jour la valeur de la page
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

jQuery(document).ready(function () {
    // Gérer le changement de filtre
    jQuery('#filters-form select').on('change', function () {
        loadFilteredPhotos(); // Appel AJAX pour charger les photos avec filtres
    });

    function loadFilteredPhotos() {
        let category = jQuery('#filter-category').val();
        let format = jQuery('#filter-format').val();
        let dateOrder = jQuery('#filter-date').val();
        let inputPage = jQuery('input[name="page"]');
        let page = parseInt(inputPage.val()) || 1;

        jQuery.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'load_filtered_photos',
                page: page,
                category: category,
                format: format,
                date: dateOrder
            },
            success: function (response) {
                if (response) {
                    jQuery('#thumbnail-container').html(response); // Remplace le contenu avec les nouvelles photos filtrées
                    inputPage.val(page); // Met à jour la valeur de la page
                } else {
                    console.log('Aucune photo trouvée');
                }
            },
            error: function () {
                alert('Erreur lors du chargement des photos filtrées.');
            }
        });
    }
});