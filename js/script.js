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

jQuery(document).ready(function($) {
    // Quand le bouton "Contact" est cliqué
    $('#contactButton').on('click', function() {
        var photoRef = $(this).data('photo-ref');
        $('#photoRef').val(photoRef); // Préremplir le champ avec la référence photo
        $('#contactModal').show(); // Afficher la popup
    });

    // Fermer la popup quand on clique sur la croix
    $('.close').on('click', function() {
        $('#contactModal').hide();
    });

    // Navigation entre les photos
    var currentIndex = 0;
    var items = $('.gallery-item');
    var itemAmt = items.length;

    function cycleItems() {
        var item = $('.gallery-item').eq(currentIndex);
        items.hide();
        item.css('display', 'inline-block');
    }

    $('.next').click(function() {
        currentIndex += 1;
        if (currentIndex > itemAmt - 1) {
            currentIndex = 0;
        }
        cycleItems();
    });

    $('.prev').click(function() {
        currentIndex -= 1;
        if (currentIndex < 0) {
            currentIndex = itemAmt - 1;
        }
        cycleItems();
    });

    cycleItems(); // Initialiser l'affichage
});
