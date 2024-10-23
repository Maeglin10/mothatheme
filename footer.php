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
        <!-- Bouton précédent avec flèche et texte -->
        <div class="lightbox__prev">
            <?php $prev_post = get_previous_post(); ?>
            <?php if (!empty($prev_post)): ?>
                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="lightbox__nav-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="Précédent" class="arrow-icon">
                    Précédent
                </a>
            <?php else: ?>
                <!-- Désactiver le lien si pas de post précédent -->
                <span class="lightbox__disabled">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="Précédent" class="arrow-icon">
                    Précédent
                </span>
            <?php endif; ?>
        </div>

        <!-- Bouton suivant avec texte et flèche -->
        <div class="lightbox__next">
            <?php $next_post = get_next_post(); ?>
            <?php if (!empty($next_post)): ?>
                <a href="<?php echo get_permalink($next_post->ID); ?>" class="lightbox__nav-link">
                    Suivant
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="Suivant" class="arrow-icon">
                </a>
            <?php else: ?>
                <!-- Désactiver le lien si pas de post suivant -->
                <span class="lightbox__disabled">
                    Suivant
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="Suivant" class="arrow-icon">
                </span>
            <?php endif; ?>
        </div>

        <!-- Bouton fermer avec croix -->
        <button class="lightbox__close">&times;</button>
    </div>
    
    <!-- Informations sous l'image (référence et catégorie) -->
    <div class="lightbox__info">
        <span class="lightbox__reference">
            <?php echo esc_html(get_field('reference')); ?>
        </span>
        <span class="lightbox__category">
            <?php
            $related_categories = get_the_terms(get_the_ID(), 'categorie');
            if ($related_categories) {
                $category_names = array_map(function ($category) {
                    return esc_html($category->name);
                }, $related_categories);
                echo implode(', ', $category_names);
            }
            ?>
        </span>
    </div>
</div>




<?php wp_footer(); ?>
</body>

</html>