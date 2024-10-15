<?php
// Enqueue Styles and Scripts
function theme_enqueue_styles_scripts() {
    wp_enqueue_style('style.css', get_stylesheet_uri());
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono&display=swap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true);

    wp_localize_script('custom-script', 'myAjax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_scripts');

// Fonction pour charger plus de photos via AJAX
function load_more_photos() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args_custom_posts = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $custom_posts_query = new WP_Query($args_custom_posts);

    if ($custom_posts_query->have_posts()) :
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <?php the_post_thumbnail('large'); ?>
                            <div class="thumbnail-overlay">
                                <div class="overlay-content">
                                    <!-- Icône au centre -->
                                    <div class="icon-center">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eye-icon.png" alt="icone-oeil">
                                    </div>
                                    <!-- Référence de la photo -->
                                    <p class="photo-reference"><?php echo esc_html(get_field('reference')); ?></p>
                                    <!-- Catégorie de la photo -->
                                    <p class="photo-category">
                                        <?php
                                        $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                        if ($related_categories) {
                                            $category_names = array_map(function($category) {
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
            </div>
            <?php
        endwhile;
    else :
        echo ''; // Aucune photo supplémentaire à afficher
    endif;

    wp_reset_postdata();
    die();
}



add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');
add_action('wp_ajax_load_more_photos', 'load_more_photos');
