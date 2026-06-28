<?php
/**
 * Customize admin columns for the Inquiries CPT.
 *
 * @package MeridianTheme
 */

/**
 * Set custom columns for the Inquiries admin list table.
 */
function meridian_set_inquiry_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Client Name', 'meridian-theme'),
        'inquiry_email' => __('Email Address', 'meridian-theme'),
        'inquiry_company' => __('Company', 'meridian-theme'),
        'inquiry_budget' => __('Budget', 'meridian-theme'),
        'date' => $columns['date']
    );
    return $new_columns;
}
add_filter('manage_meridian_inquiry_posts_columns', 'meridian_set_inquiry_columns');

/**
 * Render custom column content for the Inquiries admin list.
 */
function meridian_custom_inquiry_columns($column, $post_id) {
    switch ($column) {
        case 'inquiry_email':
            $email = get_post_meta($post_id, 'inquiry_email', true);
            echo $email ? '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>' : '&mdash;';
            break;
        case 'inquiry_company':
            $company = get_post_meta($post_id, 'inquiry_company', true);
            echo $company ? esc_html($company) : '&mdash;';
            break;
        case 'inquiry_budget':
            $budget = get_post_meta($post_id, 'inquiry_budget', true);
            switch ($budget) {
                case 'under-10k':
                case 'under-1l': $budget_text = 'Under ₹1,00,000'; break;
                case '10k-25k':
                case '1l-5l': $budget_text = '₹1,00,000 – ₹5,00,000'; break;
                case '25k-50k':
                case '5l-10l': $budget_text = '₹5,00,000 – ₹10,00,000'; break;
                case 'above-50k':
                case 'above-10l': $budget_text = '₹10,00,000 +'; break;
                default: $budget_text = $budget; break;
            }
            echo $budget ? esc_html($budget_text) : '&mdash;';
            break;
    }
}
add_action('manage_meridian_inquiry_posts_custom_column', 'meridian_custom_inquiry_columns', 10, 2);
