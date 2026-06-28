<?php
/**
 * Meridian Studio Theme — functions and definitions.
 *
 * This file acts as the central loader for all theme functionality.
 * Each concern is separated into its own file under the inc/ directory.
 *
 * @package MeridianTheme
 * @since   1.0.0
 */

// Define theme version (used for cache-busting assets).
define( 'MERIDIAN_THEME_VERSION', '1.1.0' );

/**
 * Theme Setup — registers theme supports, menus, and features.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Enqueue Scripts & Styles — loads CSS, JS, and Google Fonts.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom Post Types — registers Projects and Inquiries CPTs.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Admin Columns — customizes the Inquiries admin list table.
 */
require get_template_directory() . '/inc/admin-columns.php';

/**
 * AJAX Handlers — processes the contact form submission.
 */
require get_template_directory() . '/inc/ajax-handlers.php';

/**
 * Theme Setup Pages — auto-creates default pages on activation.
 */
require get_template_directory() . '/inc/theme-setup-pages.php';
