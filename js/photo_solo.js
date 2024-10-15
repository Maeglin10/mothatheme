document.addEventListener('DOMContentLoaded', function () {
    // Contact button click handler
    const contactBtn = document.querySelector('.contact-btn');
    contactBtn.addEventListener('click', function () {
        // Logic to open a contact modal or navigate to a contact form
        alert('Contactez-nous pour plus d\'informations.');
    });

    // Photo navigation
    const leftArrow = document.querySelector('.arrow-left');
    const rightArrow = document.querySelector('.arrow-right');
    const relatedPhotos = document.querySelectorAll('.related-thumbnail');

    let currentPhotoIndex = 0;

    function showPhoto(index) {
        relatedPhotos.forEach((photo, i) => {
            photo.style.display = (i === index) ? 'block' : 'none';
        });
    }

    showPhoto(currentPhotoIndex); // Initialize

    leftArrow.addEventListener('click', function () {
        currentPhotoIndex = (currentPhotoIndex - 1 + relatedPhotos.length) % relatedPhotos.length;
        showPhoto(currentPhotoIndex);
    });

    rightArrow.addEventListener('click', function () {
        currentPhotoIndex = (currentPhotoIndex + 1) % relatedPhotos.length;
        showPhoto(currentPhotoIndex);
    });
});
