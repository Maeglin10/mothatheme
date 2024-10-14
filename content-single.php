<?php
/**
 * Modèle de page : Photo unique.
 * Description : Modèle de page pour une photo unique.
 */

// Inclure l'en-tête de la page.
get_header();
?>
<!-- Section | Lightbox Photo -->
<div class="modal-container">
    <span class="btn-close">X</span>
    <div class="left-arrow"></div>
    <div>
        <img src="" class="middle-image" />
        <div class="info-photo">
            <span id="modal-reference"></span>
            <span id="modal-category"></span>
        </div>
    </div>
    <div class="right-arrow"></div>
</div>

<!-- Main - Single Photo -->
<main id="main" class="content-area">
    <div class="zone-contenu mobile-first">
        <!-- Section | Information de la Photo -->
        <div class="left-container">
            <div class="left-contenu">
                <h1><?php the_title(); ?></h1>
                <?php
                // Affichage des métadonnées de la photo
                $reference_photo = get_field('reference_photo');
                $type_de_photo = get_field('type_de_photo');
                $date_capture = get_the_date('Y');
                $categories = get_the_terms(get_the_ID(), 'categorie');
                $formats = get_the_terms(get_the_ID(), 'format');

                if ($reference_photo) {
                    echo '<p>Référence : <span id="ph-reference">' . esc_html($reference_photo) . '</span></p>';
                }

                if ($categories) {
                    echo '<p>Catégorie : <span id="ph-category">' . implode(', ', wp_list_pluck($categories, 'name')) . '</span></p>';
                }

                if ($formats) {
                    echo '<p>Format : ' . implode(', ', wp_list_pluck($formats, 'name')) . '</p>';
                }

                if ($type_de_photo) {
                    echo '<p>Type : ' . esc_html($type_de_photo) . '</p>';
                }

                if ($date_capture) {
                    echo '<p>Année : ' . esc_html($date_capture) . '</p>';
                }
                ?>
            </div>
        </div>
        <!-- Section | Photo [data-lightbox="image-gallery"]-->
        <div class="right-container">
            <?php if (has_post_thumbnail()) : ?>
                <a data-href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" class="photo">
                    <?php the_post_thumbnail(); ?>
                </a>
                <i class="fas fa-expand-arrows-alt fullscreen-icon"></i><!-- Fullscreen icon -->
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Section | Contact & Navigation Photos -->
    <div class="zone-contact">
        <!-- Section | Contact - Bouton Modal avec reference -->
        <div class="left-contact">
            <div class="texte-contact">
                <p>Cette photo vous intéresse ?</p>
            </div>
            <div class="bouton-contact">
                <?php include get_template_directory() . '/template-parts/contact-modal-photo.php'; ?>

                <script type="text/javascript">
                    var acfReferencePhoto = "<?php echo esc_js($reference_photo); ?>";
                </script>
            </div>
        </div>
        <!-- Section | Navigation des photos -->
        <div class="right-contact">
            <?php
            // Navigation entre les photos (précédente et suivante)
            $all_photos = get_posts(array('post_type' => 'photo', 'posts_per_page' => -1));
            $current_post_index = array_search(get_the_ID(), array_column($all_photos, 'ID'));
            $prev_photo = $all_photos[$current_post_index - 1] ?? end($all_photos);
            $next_photo = $all_photos[$current_post_index + 1] ?? reset($all_photos);

            $prev_permalink = get_permalink($prev_photo);
            $next_permalink = get_permalink($next_photo);
            ?>

            <!-- Navigation miniatures -->
            <div class="thumbnail-container">
                <a href="<?php echo esc_url($prev_permalink); ?>" class="arrow-link">
                    <img src="<?php echo get_the_post_thumbnail_url($prev_photo, 'thumbnail'); ?>" alt="Précédent" class="arrow-img-gauche" />
                </a>
                <a href="<?php echo esc_url($next_permalink); ?>" class="arrow-link">
                    <img src="<?php echo get_the_post_thumbnail_url($next_photo, 'thumbnail'); ?>" alt="Suivant" class="arrow-img-droite" />
                </a>
            </div>
        </div>
    </div>

    <!-- Section Photos Apparentées -->
    <div class="related-images">
        <h3>Vous aimerez aussi</h3>
        <div class="image-container">
            <?php
            $related_photos = new WP_Query(array(
                'post_type' => 'photo',
                'posts_per_page' => 2,
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'slug',
                        'terms' => wp_list_pluck($categories, 'slug'),
                    ),
                ),
            ));

            while ($related_photos->have_posts()) : $related_photos->the_post(); ?>
                <div class="related-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                        <div class="thumbnail-overlay-single">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Icône œil">
                            <div class="photo-info">
                                <div class="photo-info-left"><?php echo esc_html(get_field('reference_photo')); ?></div>
                                <div class="photo-info-right"><?php echo implode(', ', wp_list_pluck(get_the_terms(get_the_ID(), 'categorie'), 'name')); ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="home-button">
            <a href="<?php echo home_url(); ?>" class="button">Toutes les photos</a>
        </div>
    </div>
</main>

<script src="<?php echo get_template_directory_uri(); ?>/js/modal-scripts-photo.js"></script>

<?php get_footer(); ?>
