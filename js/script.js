document.addEventListener('DOMContentLoaded', function() {
    // Sélection des éléments
    const modal = document.getElementById('contactModal');
    const openModalBtn = document.querySelector('a[data-toggle="modal"]');
    const closeModalBtn = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');

    // Fonction pour ouvrir la modale
    openModalBtn.addEventListener('click', function(event) {
        event.preventDefault();
        modal.classList.add('show'); // Utilisation de classes pour la gestion de la modale
    });

    // Fonction pour fermer la modale
    closeModalBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', closeModal);

    function closeModal() {
        modal.classList.remove('show');
    }

    // Navigation entre les photos
    let currentIndex = 0;
    const items = $('.gallery-item');
    const itemAmt = items.length;

    function cycleItems() {
        items.hide();
        items.eq(currentIndex).css('display', 'inline-block');
    }

    $('.next').click(function() {
        currentIndex = (currentIndex + 1) % itemAmt;
        cycleItems();
    });

    $('.prev').click(function() {
        currentIndex = (currentIndex - 1 + itemAmt) % itemAmt;
        cycleItems();
    });

    cycleItems(); // Initialiser l'affichage

    // Chargement de plus de photos via AJAX
    let page = 1; // Commence à la page 1

    $('#load-more-photos').on('click', function() {
        page++; // Incrémente la page à chaque clic

        // Envoie la requête AJAX pour charger plus de photos
        $.ajax({
            url: myAjax.ajax_url, // URL définie dans le localize_script de WordPress
            type: 'POST',
            data: {
                action: 'load_more_photos', // Nom de l'action
                page: page // Page actuelle
            },
            success: function(response) {
                if (response) {
                    $('.thumbnail-container').append(response); // Ajoute les nouvelles images
                } else {
                    $('#load-more-photos').hide(); // Cache le bouton si aucune photo supplémentaire n'est disponible
                }
            },
            error: function() {
                alert('Une erreur s\'est produite lors du chargement des photos.');
            }
        });
    });
});
