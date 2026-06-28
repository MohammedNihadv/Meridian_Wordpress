<?php
/**
 * Programmatically create default pages for Meridian Studio Theme.
 *
 * @package MeridianTheme
 */

/**
 * Create default pages on theme activation/init and assign page templates.
 */
function meridian_create_default_pages_on_init() {
    if ( get_option( 'meridian_pages_created_v3' ) ) {
        return;
    }
    
    $pages = array(
        'about' => array(
            'title'    => 'Studio',
            'template' => 'page-templates/page-about.php'
        ),
        'services' => array(
            'title'    => 'Services',
            'template' => 'page-templates/page-services.php'
        ),
        'journal' => array(
            'title'    => 'Journal',
            'template' => 'index.php'
        ),
        'contact' => array(
            'title'    => 'Contact',
            'template' => 'page-templates/page-contact.php'
        ),
    );

    foreach ( $pages as $slug => $page_data ) {
        $page_exists = get_page_by_path( $slug );
        if ( ! $page_exists ) {
            $page_id = wp_insert_post( array(
                'post_title'    => $page_data['title'],
                'post_name'     => $slug,
                'post_status'   => 'publish',
                'post_type'     => 'page',
            ) );
            
            if ( $page_id && ! is_wp_error( $page_id ) ) {
                if ( ! empty( $page_data['template'] ) ) {
                    update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
                }
                
                if ( $slug === 'journal' ) {
                    update_option( 'page_for_posts', $page_id );
                }
            }
        } else {
            // Update page template if it exists but is not set
            if ( ! empty( $page_data['template'] ) ) {
                update_post_meta( $page_exists->ID, '_wp_page_template', $page_data['template'] );
            }
            if ( $slug === 'journal' ) {
                update_option( 'page_for_posts', $page_exists->ID );
            }
        }
    }
    
    // Setup Front Page
    $front_page = get_page_by_path( 'home' );
    if ( ! $front_page ) {
        $front_page_id = wp_insert_post( array(
            'post_title'    => 'Home',
            'post_name'     => 'home',
            'post_status'   => 'publish',
            'post_type'     => 'page',
        ) );
        if ( $front_page_id && ! is_wp_error( $front_page_id ) ) {
            update_option( 'page_on_front', $front_page_id );
        }
    } else {
        update_option( 'page_on_front', $front_page->ID );
    }
    
    update_option( 'show_on_front', 'page' );
    update_option( 'meridian_pages_created_v3', true );
}
add_action( 'init', 'meridian_create_default_pages_on_init' );

/**
 * One-time migration: update page template paths from old structure to new.
 *
 * Converts root-level template references (e.g., 'page-about.php')
 * to subdirectory references (e.g., 'page-templates/page-about.php').
 */
function meridian_migrate_page_template_paths() {
    if ( get_option( 'meridian_templates_migrated_v1' ) ) {
        return;
    }

    $old_to_new = array(
        'page-about.php'    => 'page-templates/page-about.php',
        'page-contact.php'  => 'page-templates/page-contact.php',
        'page-services.php' => 'page-templates/page-services.php',
    );

    $pages = get_pages();
    foreach ( $pages as $page ) {
        $current_template = get_post_meta( $page->ID, '_wp_page_template', true );
        if ( isset( $old_to_new[ $current_template ] ) ) {
            update_post_meta( $page->ID, '_wp_page_template', $old_to_new[ $current_template ] );
        }
    }

    update_option( 'meridian_templates_migrated_v1', true );
}
add_action( 'init', 'meridian_migrate_page_template_paths' );
