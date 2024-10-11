<?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
    );
    $photo_query = new WP_Query( $args );

    if ( $photo_query->have_posts() ) :
        while ( $photo_query->have_posts() ) : $photo_query->the_post(); 
?>
            <div class="photo-item">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <!-- Ajoutez les icônes d'œil et plein écran -->
                <div class="photo-overlay">
                    <a href="<?php the_permalink(); ?>" class="view-info">👁️</a>
                    <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="view-fullscreen">🔍</a>
                </div>
            </div>
<?php
        endwhile;
        wp_reset_postdata();
    endif;
?>
