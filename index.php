<?php get_header(); ?>
<main class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg" alt="Hero Image">
            <div class="hero-title">
                <h1>Votre Titre Ici</h1>
            </div>
        </div>
    </section>

    <!-- Catalogue Section -->
    <section class="catalogue-section">
        <div class="filters">
            <label for="categories">Catégories :</label>
            <select id="categories">
                <!-- Dynamically populate categories -->
            </select>

            <label for="formats">Formats :</label>
            <select id="formats">
                <!-- Dynamically populate formats -->
            </select>

            <label for="sort">Trier par :</label>
            <select id="sort">
                <option value="newest">Plus récentes</option>
                <option value="oldest">Plus anciennes</option>
            </select>
        </div>

        <!-- Photo Grid -->
        <div class="photo-grid">
            <!-- Dynamically load photos -->
        </div>

        <button id="load-more">Charger plus</button>
    </section>
</main>
<?php get_footer(); ?>

