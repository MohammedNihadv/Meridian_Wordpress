</main><!-- #primary -->

<footer id="colophon" class="site-footer">
    <div class="footer-container container">
        <div class="footer-top">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                    <span class="logo-dot"></span>Meridian
                </a>
                <p class="footer-tagline">We build brands that move.</p>
            </div>
            
            <!-- Navigation Links -->
            <div class="footer-nav">
                <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'meridian-theme' ); ?>">
                    <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'fallback_cb'    => false,
                        ) );
                    } else {
                        echo '<ul class="footer-menu">';
                        echo '<li><a href="' . esc_url( home_url( '/#work' ) ) . '">Work</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/services/' ) ) . '">Services</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">Studio</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/journal/' ) ) . '">Journal</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Contact</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </nav>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright">&copy; <?php echo esc_html( date( 'Y') ); ?> <p>Meridian Build Agency</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
