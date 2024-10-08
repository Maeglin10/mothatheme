<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="content-wrapper">
        <!-- Bloc gauche : Infos sur la photo -->
        <div class="left-content" style="width: 50%;">
            <h1 class="photo-title"><?php the_title(); ?></h1>
            <ul class="photo-info">
                <li>Réf. Photo : <?php the_field('reference'); ?></li>
                <li>Catégorie : <?php the_terms( $post->ID, 'category' ); ?></li>
                <li>Format : <?php the_field('format'); ?></li>
                <li>Date de prise de vue : <?php echo get_the_date(); ?></li>
            </ul>
        </div>

        <!-- Bloc droite : Photo en format natif -->
        <div class="right-content" style="width: 50%;">
            <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>" class="full-photo">
        </div>
    </div>

    <!-- Bloc interactions en dessous -->
    <div class="interactions" style="height: 118px;">
        <!-- Lien de contact -->
        <div class="contact-link" style="float: left;">
            <a href="#" id="contactButton" data-photo-ref="<?php the_field('reference'); ?>">Contact</a>
        </div>

        <!-- Navigation entre les photos -->
        <div class="photo-navigation" style="float: right;">
            <?php previous_post_link('%link', 'Précédent', TRUE); ?>
            <?php next_post_link('%link', 'Suivant', TRUE); ?>
        </div>
    </div>

    <!-- Photos similaires (même catégorie) -->
    <div class="similar-photos">
        <h2>Photos similaires</h2>
        <div class="photo-grid">
            <?php
            $current_post_id = get_the_ID();
            $categories = wp_get_post_terms( $current_post_id, 'category' );
            if ( $categories ) {
                $category_ids = array();
                foreach ( $categories as $category ) {
                    $category_ids[] = $category->term_id;
                }

                $related_photos = new WP_Query( array(
                    'post_type' => 'photo',
                    'posts_per_page' => 2,
                    'post__not_in' => array( $current_post_id ),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $category_ids,
                        ),
                    ),
                ) );

                if ( $related_photos->have_posts() ) :
                    while ( $related_photos->have_posts() ) : $related_photos->the_post(); ?>
                        <div class="gallery-item">
                            <img src="<?php the_field('photo'); ?>" alt="<?php the_title(); ?>">
                            <div class="overlay">
                                <a href="<?php the_permalink(); ?>" class="icon-eye">👁️</a>
                                <a href="<?php the_field('photo'); ?>" class="icon-fullscreen" data-lightbox="gallery">⛶</a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                endif;
            }
            ?>
        </div>
    </div>
</article>



