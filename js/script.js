

document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments
    const modal = document.getElementById('contactModal');
    const openModalBtn = document.querySelector('a[data-toggle="modal"]');
    const closeModalBtn = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');

    /** Fonction pour ouvrir la modale - affiche erreur à corriger !
    openModalBtn.addEventListener('click', function (event) {
        event.preventDefault();
        modal.classList.add('show'); // Utilisation de classes pour la gestion de la modale
    });

    // closeModalBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    // function closeModal() {
        modal.classList.remove('show');
    }
     */

    /**  Navigation entre les photos
    let currentIndex = 0;
    const items = $('.gallery-item');
    const itemAmt = items.length;

    function cycleItems() {
        items.hide();
        items.eq(currentIndex).css('display', 'inline-block');
    }
        

    $('.next').click(function () {
        currentIndex = (currentIndex + 1) % itemAmt;
        cycleItems();
    });

    $('.prev').click(function () {
        currentIndex = (currentIndex - 1 + itemAmt) % itemAmt;
        cycleItems();
    });

    cycleItems(); // Initialiser l'affichage
    */





    /** $('#load-more-posts').on('click', function () {
        console.log('test-function')
        // Chargement de plus de photos via AJAX
        let inputPage = $('input[name="page"]');
        let page = parseInt(inputPage.val());
        page++; // Incrémente le numéro de page si "load" est vrai, sinon réinitialise à 1.
        const category = $('select[name="filter-category"]').val()
       
       
        // Envoie la requête AJAX pour charger plus de photos
        $.ajax({
            url: myAjax.ajax_url, // URL définie dans le localize_script de WordPress
            type: 'GET',
            data: {
                action: 'load_more_photos', // Nom de l'action
                page,
                category
            },
            success: function (response) {
                if (response) {
                    $('.thumbnail-container').append(response); // Ajoute les nouvelles images
                    console.log('test-if')
                } else {
                    $load_more_photos.hide(); // Cache le bouton si aucune photo supplémentaire n'est disponible
                    console.log('test-else')
                }
            },
            error: function () {
                alert('Une erreur s\'est produite lors du chargement des photos.');
            }
        });
    });
    */

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
});
