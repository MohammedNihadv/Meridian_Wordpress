<?php
/**
 * Theme Setup — registers theme supports and menus.
 *
 * @package MeridianTheme
 */

if ( ! function_exists( 'meridian_theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function meridian_theme_setup() {
        // Add support for post thumbnails/featured images
        add_theme_support( 'post-thumbnails' );
        
        // Add support for dynamic document title
        add_theme_support( 'title-tag' );
        
        // Register menus
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'meridian-theme' ),
            'footer'  => __( 'Footer Menu', 'meridian-theme' ),
        ) );
        
        // Add support for clean HTML5 markup
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );
    }
endif;
add_action( 'after_setup_theme', 'meridian_theme_setup' );
