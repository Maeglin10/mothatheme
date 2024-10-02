<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();

/* Start the Loop 
while ( have_posts() ) :
    the_post();

    // Charger un template spécifique pour le contenu d'un post
    get_template_part( 'template-parts/content', 'single' ); 

    // Affichage de la navigation des articles si besoin
    the_post_navigation(
        array(
            'next_text' => '<p class="meta-nav">' . esc_html__( 'Next post', 'mothatheme' ) . '</p><p class="post-title">%title</p>',
            'prev_text' => '<p class="meta-nav">' . esc_html__( 'Previous post', 'mothatheme' ) . '</p><p class="post-title">%title</p>',
        )
    );

    // Inclure les commentaires si activés
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;

endwhile; // End of the loop.*/
?>

<main class="main-content-post">
    <?php
    if (have_posts()) : // Vérifie s'il y a des articles à afficher.
        while (have_posts()) : // Tant qu'il y a des articles à afficher, boucle.
            the_post(); // Charge l'article actuel.
    ?>
    <div class="post">
    <h1 class="post-title"><?php the_title(); ?></h1>
        <div>
            <?php the_content(); // Affiche le contenu de l'article. ?>
        </div>
    <?php
        endwhile;
    endif; // Fin de la vérification de la présence d'articles.
    ?>
</main>

<?php
get_footer();
?>


