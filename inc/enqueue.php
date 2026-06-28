<?php
/**
 * Enqueue scripts and styles.
 *
 * @package MeridianTheme
 */

function meridian_theme_scripts() {
    $theme_version = defined( 'MERIDIAN_THEME_VERSION' ) ? MERIDIAN_THEME_VERSION : '1.0.0';

    // Enqueue Google Fonts (Newsreader, Hanken Grotesk, IBM Plex Mono)
    wp_enqueue_style( 'meridian-fonts', 'https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=IBM+Plex+Mono:ital,wght@0,100..700;1,100..700&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap', array(), null );

    // Enqueue main stylesheet (style.css contains metadata)
    wp_enqueue_style( 'meridian-style', get_stylesheet_uri(), array(), $theme_version );
    
    // Enqueue custom design system CSS
    if ( file_exists( get_template_directory() . '/assets/css/main.css' ) ) {
        wp_enqueue_style( 'meridian-custom-css', get_template_directory_uri() . '/assets/css/main.css', array(), $theme_version );
    }
    
    // Enqueue custom JavaScript behavior
    if ( file_exists( get_template_directory() . '/assets/js/main.js' ) ) {
        wp_enqueue_script( 'meridian-custom-js', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true );
        
        // Pass AJAX URL and Nonce to JavaScript
        wp_localize_script( 'meridian-custom-js', 'meridian_ajax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'meridian_contact_nonce' )
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'meridian_theme_scripts' );

/**
 * Add defer attribute to the theme's custom javascript file.
 */
function meridian_defer_scripts( $tag, $handle, $src ) {
    if ( 'meridian-custom-js' === $handle ) {
        return '<script src="' . esc_url( $src ) . '" defer></script>';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'meridian_defer_scripts', 10, 3 );
