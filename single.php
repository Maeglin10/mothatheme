<?php
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
                        <p>Référence : <?php echo esc_html(get_field('reference')); ?></p>
                        <p>Type : <?php echo esc_html(get_field('type')); ?></p>
                        <p>Catégorie : <?php echo esc_html(get_the_terms(get_the_ID(), 'categorie')[0]->name); ?></p>
                        <p>Année : <?php echo esc_html(get_field('annee')); ?></p>
                    </div>
                    <div class="right-half">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                </div>
            </div>

            <!-- Conteneur secondaire -->
            <div class="secondary-container">
                <p>Cette photo vous intéresse ?</p>
                <button id="contactModal" class="contact-button">CONTACT</button>
                <div class="miniature-photo">
                    <?php
                    // Affichage d'une photo aléatoire en taille 'small'
                    $random_photo = new WP_Query(array(
                        'post_type' => 'photo',
                        'posts_per_page' => 1,
                        'orderby' => 'rand',
                    ));
                    if ($random_photo->have_posts()) :
                        while ($random_photo->have_posts()) : $random_photo->the_post(); 
                            the_post_thumbnail('small');
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                    <div class="navigation-arrows">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="Flèche gauche">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="Flèche droite">
                    </div>
                </div>
            </div>

            <!-- Conteneur des photos similaires -->
            <h3 style=>Vous aimerez aussi</h3>
            <div class="related-photos">               
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
                            <?php the_post_thumbnail('large'); ?>
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
