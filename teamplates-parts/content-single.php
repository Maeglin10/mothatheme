<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        // Afficher le titre de l'article
        the_title( '<h1 class="entry-title">', '</h1>' );

        // Afficher la date et les métadonnées
        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                echo '<span class="posted-on">' . get_the_date() . '</span>';
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        // Afficher le contenu de l'article
        the_content();

        // Pagination pour les longs articles
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'ton-theme' ),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        // Afficher les catégories et les tags
        the_category(', ');
        the_tags( '<span class="tag-links">' . __( 'Tags:', 'ton-theme' ) . ' ', ', ', '</span>' );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
