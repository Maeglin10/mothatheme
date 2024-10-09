<section id="photo-catalog">
    <div class="custom-post-thumbnails">
        <div id="thumbnail-container" class="thumbnail-container-accueil">
            <?php
            // Arguments pour la requête des publications personnalisées
            $args_custom_posts = array(
                'post_type' => 'photo',          // Type de publication personnalisée
                'posts_per_page' => 8,           // Nombre de publications à afficher par page
                'orderby' => 'date',             // Trier par date
                'order' => 'DESC',               // Ordre descendant
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
                            <?php the_post_thumbnail('large'); ?>
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
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p>Aucune photo à afficher.</p>
            <?php endif; ?>
        </div>
        <div class="view-all-button">
            <button id="load-more-posts">Charger plus</button>
        </div>
    </div>
</section>
