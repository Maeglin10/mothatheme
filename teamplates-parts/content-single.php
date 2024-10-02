<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header>

    <div class="entry-content">
        <?php
        // Afficher le contenu principal de l'article avec Elementor
        the_content();
        ?>

        <!-- Affichage des champs ACF pour les photos -->
        <?php if ( have_rows('photo_gallery') ): ?>
            <div class="photo-gallery">
                <?php while( have_rows('photo_gallery') ): the_row(); ?>
                    <div class="gallery-item">
                        <img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('photo_alt'); ?>">
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Navigation pour la galerie -->
            <div class="gallery-navigation">
                <button class="prev">Précédent</button>
                <button class="next">Suivant</button>
            </div>

            <!-- Bouton Contact avec la référence photo en data attribute -->
            <?php $photo_ref = get_field('référence'); ?>
            <button id="contactButton" data-photo-ref="<?php echo esc_attr($photo_ref); ?>">Contact</button>

        <?php else: ?>
            <p>Aucune photo trouvée.</p>
        <?php endif; ?>
    </div>

    <footer class="entry-footer">
        <?php the_category(', '); ?>
        <?php the_tags( '<span class="tag-links">', ', ', '</span>' ); ?>
    </footer>

    <!-- Modal de contact -->
    <div id="contactModal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Contactez-nous</h2>
            <form id="contactForm">
                <label for="photoRef">Réf. PHOTO :</label>
                <input type="text" id="photoRef" name="photoRef" readonly>
                <!-- Autres champs du formulaire ici -->
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</article>


