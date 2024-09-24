<footer class="site-footer">
    <div class="container">
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer-menu',
                    'menu_class'     => 'footer-menu',
                )
            );
            ?>
        </nav>
        <p class="copyright">Tous droits réservés &copy; <?php echo date('Y'); ?></p>
    </div>
</footer>




<?php wp_footer(); ?>
</body>
</html>
