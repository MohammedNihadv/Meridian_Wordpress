<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.ico' ); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-32x32.png' ); ?>" sizes="32x32" type="image/png">
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.png' ); ?>" sizes="512x512" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/apple-touch-icon.png' ); ?>">
    <?php
    // Dynamic SEO Meta Description
    $meta_description = '';
    if ( is_singular() ) {
        $post_obj = get_post();
        if ( $post_obj ) {
            $meta_description = has_excerpt( $post_obj->ID ) ? get_the_excerpt( $post_obj->ID ) : wp_trim_words( strip_shortcodes( $post_obj->post_content ), 25 );
        }
    }
    
    if ( empty( $meta_description ) ) {
        $meta_description = get_bloginfo( 'description', 'display' );
    }
    
    // Fallback if description is default or empty
    if ( empty( $meta_description ) || strpos( strtolower( $meta_description ), 'just another wordpress' ) !== false ) {
        $meta_description = 'Meridian Studio is a brand & digital design studio based in Bristol, specializing in strategy, visual identity, and high-performance websites.';
    }
    
    $meta_description = esc_attr( wp_strip_all_tags( $meta_description ) );
    ?>
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta property="og:description" content="<?php echo $meta_description; ?>">
    <meta name="twitter:description" content="<?php echo $meta_description; ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="site-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
            <span class="logo-dot"></span>Meridian
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'meridian-theme' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => false,
                ) );
            } else {
                // Fallback hardcoded menu if no WP menu is configured
                echo '<ul class="nav-menu">';
                echo '<li><a href="' . esc_url( home_url( '/#work' ) ) . '">Work</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/services/' ) ) . '">Services</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">Studio</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/journal/' ) ) . '">Journal</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Contact</a></li>';
                echo '</ul>';
            }
            ?>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary btn-start-project">Start a project</a>
            
            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-toggle" class="mobile-menu-toggle" aria-expanded="false" aria-controls="mobile-overlay-menu" aria-label="Toggle menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Overlay -->
<div id="mobile-overlay-menu" class="mobile-overlay-menu" aria-hidden="true">
    <div class="mobile-menu-inner">
        <nav class="mobile-navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'meridian-theme' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'mobile-nav-menu',
                    'fallback_cb'    => false,
                ) );
            } else {
                echo '<ul class="mobile-nav-menu">';
                echo '<li><a href="' . esc_url( home_url( '/#work' ) ) . '">Work</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/services/' ) ) . '">Services</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/about/' ) ) . '">Studio</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/journal/' ) ) . '">Journal</a></li>';
                echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">Contact</a></li>';
                echo '</ul>';
            }
            ?>
        </nav>
        <div class="mobile-menu-footer">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary btn-mobile-cta">Start a project</a>
        </div>
    </div>
</div>

<main id="primary" class="site-main">
