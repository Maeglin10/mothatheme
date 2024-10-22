<?php
/**
 * Footer template
 */

?>
<?php echo do_shortcode('[hfe_template id="63"]'); // Footer Elementor ?>

<!-- Inclusion de la modale de contact -->
<?php get_template_part('template-part/contact-modal'); ?>


<!-- Inclusion de la deuxième modale de contact -->
<?php get_template_part('template-part/single-modal'); ?>


<!-- Inclusion de la lightbox -->
<div class="lightbox">
    <div class="lightbox__overlay"></div>
    <img class="lightbox__image" src="" alt="Image agrandie">
    <div class="lightbox__controls">
        <!-- Bouton Précédent avec image et texte -->
        <button class="lightbox__prev">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="Précédent" class="arrow-icon">
            Précédent
        </button>
        
        <!-- Bouton Suivant avec image et texte -->
        <button class="lightbox__next">
            Suivant
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="Suivant" class="arrow-icon">
        </button>

        <!-- Bouton Fermer avec une icône croix -->
        <button class="lightbox__close">&times;</button> <!-- Utilisation de l'entité HTML pour une croix -->
    </div>
    <div class="lightbox__info">
        <span class="lightbox__reference"></span>
        <span class="lightbox__category"></span>
    </div>
</div>



<?php wp_footer(); ?>
</body>

</html>