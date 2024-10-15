<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();

if (have_posts()) :
    while (have_posts()) : 
        the_post();
        ?>
        <main class="main-content-post">
            <!-- Conteneur principal -->
            <div id="content">
                <div class="photo-single-container">
                    <div class="left-half">
                        <h1><?php the_title(); ?></h1>
                        <p><?php echo esc_html(get_field('reference')); ?></p>
                        <p><?php echo esc_html(get_field('format')); ?></p>
                        <p><?php echo esc_html(get_field('type')); ?></p>
                        <p><?php echo esc_html(get_field('annee')); ?></p>
                    </div>
                    <div class="right-half">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                </div>
            </div>

            <!-- Conteneur secondaire -->
            <div class="secondary-container">
                <p>Cette photo vous intéresse ?</p>
                <button class="contact-button">CONTACT</button>
                <div class="miniature-photo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/miniature.png" alt="Miniature" width="81" height="71">
                    <div class="navigation-arrows">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="Flèche gauche">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="Flèche droite">
                    </div>
                </div>
            </div>

            <!-- Conteneur des photos similaires -->
            <div class="related-photos">
                <h3>Vous aimerez aussi</h3>
                <?php
                $related_photos = new WP_Query(array(
                    'post_type' => 'photo',
                    'posts_per_page' => 2,
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categorie',
                            'field' => 'term_id',
                            'terms' => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'ids')),
                        ),
                    ),
                ));

                if ($related_photos->have_posts()) :
                    while ($related_photos->have_posts()) : $related_photos->the_post(); ?>
                        <div class="related-photo-item">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </main>
    <?php
    endwhile;
endif;

get_footer();
?>