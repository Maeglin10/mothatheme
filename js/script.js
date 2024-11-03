document.addEventListener('DOMContentLoaded', function () {
    // Sélection des éléments
    const modal = document.getElementById('contactModal');
    const openModalLinks = document.querySelectorAll('.open-contact-modal');
    const closeModalBtn = document.querySelector('.modal-close');
    const modalOverlay = document.querySelector('.modal-overlay');

    openModalLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            modal.classList.add('show');
        });
    });

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function () {
            modal.classList.remove('show');
        });
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', function () {
            modal.classList.remove('show');
        });
    }
});

// Navigation entre les photos
let currentIndex = 0;
const items = jQuery('.gallery-item');
const itemAmt = items.length;

function cycleItems() {
    items.hide();
    items.eq(currentIndex).css('display', 'inline-block');
}
    
jQuery('.next').click(function () {
    currentIndex = (currentIndex + 1) % itemAmt;
    cycleItems();
});

jQuery('.prev').click(function () {
    currentIndex = (currentIndex - 1 + itemAmt) % itemAmt;
    cycleItems();
});

cycleItems();

// Charger plus de photos avec le nonce
jQuery('#load-more-posts').on('click', function () {
    let inputPage = jQuery('input[name="page"]');
    let page = parseInt(inputPage.val()) + 1;
    let category = jQuery('#filter-category').val();
    let format = jQuery('#filter-format').val();
    let dateOrder = jQuery('#filter-date').val();

    jQuery.ajax({
        url: myAjax.ajax_url,
        type: 'POST',
        data: {
            action: 'load_filtered_photos',
            page: page,
            category: category,
            format: format,
            date: dateOrder,
            nonce: myAjax.nonce // Ajout du nonce
        },
        success: function (response) {
            if (response) {
                jQuery('#thumbnail-container').append(response);
                inputPage.val(page);
            } else {
                console.log('Aucune autre photo disponible');
                jQuery('#load-more-posts').hide();
            }
        },
        error: function () {
            alert('Une erreur s\'est produite lors du chargement des photos.');
        }
    });
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
            date: dateOrder,
            nonce: myAjax.nonce // Ajout du nonce
        },
        success: function (response) {
            if (response) {
                jQuery('#thumbnail-container').html(response);
                inputPage.val(page);
            } else {
                console.log('Aucune photo trouvée');
            }
        },
        error: function () {
            alert('Erreur lors du chargement des photos filtrées.');
        }
    });
}

jQuery('#filters-form select').on('change', function () {
    loadFilteredPhotos();
});
