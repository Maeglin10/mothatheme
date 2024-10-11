<?php
// Enqueue Styles and Scripts
function theme_enqueue_styles_scripts() {
    // Enqueue le style principal du thème
    wp_enqueue_style('style.css', get_stylesheet_uri());

    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    wp_enqueue_style('google-fonts-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    // Enqueue jQuery (par défaut dans WordPress)
    wp_enqueue_script('jquery');

    // Enqueue votre script principal
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.1.1', true);

    // Localisation de la variable AJAX
    wp_localize_script('custom-script', 'myAjax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

// Hook pour charger les styles et scripts
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_scripts');

// Enregistrer les emplacements de menu
function register_my_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __('Menu Principal'),
            'footer-menu'  => __('Menu Pied de Page'),
        )
    );
}
add_action('init', 'register_my_menus');

// Auto-générer la référence photo
function auto_generate_photo_reference($post_id) {
    // Vérifier si c'est bien un post de type 'photo'
    if (get_post_type($post_id) == 'photo') {
        $latest_ref = get_latest_reference(); // Fonction qui récupère la dernière référence utilisée (à définir)
        
        // Générer la nouvelle référence
        $new_ref = 'bf' . str_pad($latest_ref + 1, 4, '0', STR_PAD_LEFT);
        
        // Mettre à jour le champ personnalisé ACF
        update_field('reference_photo', $new_ref, $post_id);
    }
}
add_action('save_post', 'auto_generate_photo_reference');

// Charger plus de photos via AJAX
function load_more_photos() {
    $paged = $_POST['page']; // Récupère le numéro de la page

    // Arguments pour la requête des publications personnalisées
    $args_custom_posts = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,  // Nombre de publications à afficher par page
        'paged' => $paged,       // Page actuelle
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $custom_posts_query = new WP_Query($args_custom_posts);

    // Boucle pour afficher les publications
    if ($custom_posts_query->have_posts()) :
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <?php the_post_thumbnail('medium'); ?>
                            <div class="thumbnail-overlay">
                                <div class="overlay-content">
                                    <p class="photo-reference"><?php echo esc_html(get_field('reference_photo')); ?></p>
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
            <?php endwhile;
    else :
        echo ''; // Pas de publications à retourner
    endif;

    wp_reset_postdata(); // Réinitialise la requête
    die(); // Terminer l'exécution
}
add_action('wp_ajax_load_more_photos', 'load_more_photos'); // Pour les utilisateurs connectés
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos'); // Pour les utilisateurs non connectés
