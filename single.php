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
                        <p>Année : <?php echo get_the_date('Y'); ?></p>
                    </div>
                    <div class="right-half">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                </div>
            </div>

            <!-- Conteneur secondaire -->
            <div class="secondary-container">
                <p>Cette photo vous intéresse ?</p>
                <!-- Ajustement de l'ID et des classes pour correspondre à la nouvelle modale -->
                <button class="open-contact-modal-single">CONTACT</button>

                <div class="miniature-photo">
    <!-- Affichage de la miniature de la photo actuelle -->
    <?php the_post_thumbnail('small'); ?>

    <div class="navigation-arrows">
        <!-- Lien pour la photo précédente -->
        <?php 
        $prev_post = get_previous_post(); 
        if (!empty($prev_post)) : ?>
            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="prev-photo-link">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.png" alt="Flèche gauche">
            </a>
        <?php endif; ?>

        <!-- Lien pour la photo suivante -->
        <?php 
        $next_post = get_next_post(); 
        if (!empty($next_post)) : ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>" class="next-photo-link">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.png" alt="Flèche droite">
            </a>
        <?php endif; ?>
    </div>
</div>

            </div>
        </main>
        <?php
    endwhile;
endif;
?>

<!-- Conteneur des photos similaires -->
<h3 class="third-container-title">Vous aimerez aussi</h3>
<div class="related-photos">
    <?php
    // Query pour récupérer les photos similaires
    $related_photos = new WP_Query(array(
        'post_type' => 'photo',
        'posts_per_page' => 2,  // Limite à 2 photos similaires
        'post__not_in' => array(get_the_ID()),  // Exclure la photo actuelle
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'term_id',
                'terms' => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'ids')),  // Utiliser les catégories similaires
            ),
        ),
    ));

    // Vérifier si des posts sont disponibles
    if ($related_photos->have_posts()) :
        while ($related_photos->have_posts()) : $related_photos->the_post(); ?>
        
        <div class="custom-post-thumbnail">
            <!-- Lien vers la page de la photo -->
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                <div class="thumbnail-wrapper">
                    <!-- Afficher la vignette de la photo -->
                    <?php the_post_thumbnail('large'); ?>
                    
                    <!-- Overlay avec les informations de la photo -->
                    <div class="thumbnail-overlay">
                        <div class="overlay-content">
                            <!-- Icône oeil centrée -->
                            <div class="icon-center">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" alt="icone-oeil">
                            </div>
                            <!-- Affichage de la référence de la photo -->
                            <p class="photo-reference"><?php echo esc_html(get_field('reference')); ?></p>
                            
                            <!-- Affichage de la catégorie de la photo -->
                            <p class="photo-category">
                                <?php
                                $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                if ($related_categories) {
                                    $category_names = array_map(function ($category) {
                                        return esc_html($category->name);
                                    }, $related_categories);
                                    echo implode(', ', $category_names);
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </a>

            <!-- Icône fullscreen qui déclenche la lightbox -->
            <div class="icon-fullscreen">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-fullscreen.png" alt="Fullscreen">
            </div>
        </div>
        
    <?php endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>

<?php
get_footer();
?>
