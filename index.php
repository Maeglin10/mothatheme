<?php
/**
 * Template Name: Page d'Accueil
 * Description: Modèle pour la page d'accueil du site.
 */

get_header(); // Inclusion de l'en-tête du site
?>

<!-- Section Hero Image -->
<section class="hero-section">
    <?php
    // Configuration d'une requête personnalisée pour afficher une image aléatoire
    $args_random_photo = array(
        'post_type' => 'photo', // Type de contenu personnalisé
        'posts_per_page' => 1,  // Limite à une seule photo
        'orderby' => 'rand',    // Trier de manière aléatoire
    );

    $random_photo_query = new WP_Query($args_random_photo); // Exécution de la requête
    
    if ($random_photo_query->have_posts()):
        while ($random_photo_query->have_posts()):
            $random_photo_query->the_post();
            $photo_link = esc_url(get_permalink()); // Obtenir le lien de la photo
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // URL de l'image à la une
            ?>
            <a href="<?php echo $photo_link; ?>" class="hero-link">
                <div class="hero-background" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '../motatheme/assets/images/Titre-header.png'); ?>"
                        alt="Titre">
                </div>
            </a>
            <?php
        endwhile;
        wp_reset_postdata(); // Réinitialisation après la boucle personnalisée
    endif;
    ?>
</section>

<!-- Section Filtres pour le catalogue de photos -->
<section class="filters-section">
    <form id="filters-form" method="get">
        <!-- Filtre pour la catégorie -->
        <div class="filter-item">

            <select id="filter-category" name="category">
                <option value="all">Catégories</option>
                <?php
                // Récupérer les termes de la taxonomie 'categorie'
                $categories = get_terms(array('taxonomy' => 'categorie', 'hide_empty' => false));
                if (!empty($categories) && !is_wp_error($categories)):
                    foreach ($categories as $cat):
                        ?>
                        <option value="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></option>
                    <?php endforeach; endif; ?>
            </select>
        </div>

        <!-- Filtre pour le format -->
        <div class="filter-item">
            <select id="filter-format" name="format">
                <option value="all">Formats</option>
                <?php
                // Récupérer les termes de la taxonomie 'format'
                $formats = get_terms(array('taxonomy' => 'format', 'hide_empty' => false));
                if (!empty($formats) && !is_wp_error($formats)):
                    foreach ($formats as $format):
                        ?>
                        <option value="<?php echo esc_attr($format->slug); ?>"><?php echo esc_html($format->name); ?></option>
                    <?php endforeach; endif; ?>
            </select>
        </div>

        <!-- Filtre pour trier par date -->
        <div class="filter-item">
            <select id="filter-date" name="date">
                <option value="" disabled selected>Trier par</option>
                <option value="desc">Du plus récent au plus ancien</option>
                <option value="asc">Du plus ancien au plus récent</option>
            </select>
        </div>

    </form>
</section>

<!-- Section Catalogue de photos -->
<section id="photo-catalog">
    <?php
    // Inclusion du template de bloc de photos pour afficher la galerie
    get_template_part('template-parts/photo_block', 'photo');
    ?>
</section>

<?php get_footer(); // Inclusion du pied de page ?>