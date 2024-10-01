<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
 */

get_header();

/* Start the Loop */
while ( have_posts() ) :
    the_post();

    // Afficher le contenu de la page pour permettre la modification avec Elementor
    the_content();

    // Inclure les commentaires si activés
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

endwhile; // End of the loop.

get_footer();

