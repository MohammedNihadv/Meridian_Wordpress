<?php
/**
 * Register Custom Post Types.
 *
 * @package MeridianTheme
 */

/**
 * Register Custom Post Type: Selected Work / Projects
 */
function meridian_register_project_cpt() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name', 'meridian-theme' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'meridian-theme' ),
        'menu_name'          => _x( 'Projects', 'admin menu', 'meridian-theme' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'meridian-theme' ),
        'add_new'            => _x( 'Add New', 'project', 'meridian-theme' ),
        'add_new_item'       => __( 'Add New Project', 'meridian-theme' ),
        'new_item'           => __( 'New Project', 'meridian-theme' ),
        'edit_item'          => __( 'Edit Project', 'meridian-theme' ),
        'view_item'          => __( 'View Project', 'meridian-theme' ),
        'all_items'          => __( 'All Projects', 'meridian-theme' ),
        'search_items'       => __( 'Search Projects', 'meridian-theme' ),
        'not_found'          => __( 'No projects found.', 'meridian-theme' ),
        'not_found_in_trash' => __( 'No projects found in Trash.', 'meridian-theme' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
    );

    register_post_type( 'meridian_project', $args );
}
add_action( 'init', 'meridian_register_project_cpt' );

/**
 * Register Custom Post Type: Inquiries (Contact Form Submissions)
 */
function meridian_register_inquiry_cpt() {
    $labels = array(
        'name'               => _x( 'Inquiries', 'post type general name', 'meridian-theme' ),
        'singular_name'      => _x( 'Inquiry', 'post type singular name', 'meridian-theme' ),
        'menu_name'          => _x( 'Inquiries', 'admin menu', 'meridian-theme' ),
        'name_admin_bar'     => _x( 'Inquiry', 'add new on admin bar', 'meridian-theme' ),
        'add_new'            => _x( 'Add New', 'inquiry', 'meridian-theme' ),
        'add_new_item'       => __( 'Add New Inquiry', 'meridian-theme' ),
        'new_item'           => __( 'New Inquiry', 'meridian-theme' ),
        'edit_item'          => __( 'Edit Inquiry', 'meridian-theme' ),
        'view_item'          => __( 'View Inquiry', 'meridian-theme' ),
        'all_items'          => __( 'All Inquiries', 'meridian-theme' ),
        'search_items'       => __( 'Search Inquiries', 'meridian-theme' ),
        'not_found'          => __( 'No inquiries found.', 'meridian-theme' ),
        'not_found_in_trash' => __( 'No inquiries found in Trash.', 'meridian-theme' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false, // Private CPT, not accessible on frontend
        'show_ui'            => true,  // Show in dashboard
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-email',
        'supports'           => array( 'title', 'editor' ),
    );

    register_post_type( 'meridian_inquiry', $args );
}
add_action( 'init', 'meridian_register_inquiry_cpt' );
