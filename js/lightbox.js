jQuery(document).ready(function($) {
  // Lorsque l'utilisateur clique sur l'icône fullscreen
  $('.icon-fullscreen img').on('click', function(e) {
      e.preventDefault();
      
      // Trouver la miniature associée à l'icône cliquée
      var postThumbnail = $(this).closest('.custom-post-thumbnail');
      
      // Récupérer l'image du post (source de l'image WordPress)
      var imageSrc = postThumbnail.find('img').attr('src');
      
      // Récupérer la référence et la catégorie
      var reference = postThumbnail.find('.photo-reference').text();
      var category = postThumbnail.find('.photo-category').text();
      
      // Injecter les données dans la lightbox
      $('.lightbox__image').attr('src', imageSrc);
      $('.lightbox__reference').text(reference);
      $('.lightbox__category').text(category);
      
      // Afficher la lightbox
      $('.lightbox').fadeIn();
  });
  
  // Fermer la lightbox
  $('.lightbox__close, .lightbox__overlay').on('click', function() {
      $('.lightbox').fadeOut();
  });
});
