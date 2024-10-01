<?php
// Enqueue Styles and Scripts
function theme_enqueue_styles_scripts() {
    // Enqueue le style principal du thème
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    // Enqueue Google Fonts (ajuste les URLs si nécessaire)
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap');
    wp_enqueue_style('google-fonts-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    // Enqueue les scripts JS (ajuste le chemin si nécessaire)
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
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

function ton_theme_enqueue_scripts() {
    wp_enqueue_script('ton-script', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ton_theme_enqueue_scripts');

function auto_generate_photo_reference( $post_id ) {
    // Vérifier si c'est bien un post de type 'photo' (ou le CPT que tu utilises)
    if( get_post_type( $post_id ) == 'photo' ) {
        $latest_ref = get_latest_reference(); // Fonction qui récupère la dernière référence utilisée (à définir)
        
        // Générer la nouvelle référence en l'incrémentant
        $new_ref = 'bf' . str_pad( $latest_ref + 1, 4, '0', STR_PAD_LEFT );
        
        // Mettre à jour le champ personnalisé ACF avec la nouvelle référence
        update_field( 'reference_photo', $new_ref, $post_id );
    }
}
add_action( 'save_post', 'auto_generate_photo_reference' );
