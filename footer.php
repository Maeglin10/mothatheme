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
        <button class="lightbox__prev">Précédent</button>
        <button class="lightbox__next">Suivant</button>
        <button class="lightbox__close">Fermer</button>
    </div>
    <div class="lightbox__info">
        <span class="lightbox__reference"></span>
        <span class="lightbox__category"></span>
    </div>
</div>


<?php wp_footer(); ?>
</body>

</html>