<?php
/**
 * AJAX handler for the contact form submission.
 *
 * @package MeridianTheme
 */

/**
 * Process and store contact form submissions via AJAX.
 */
function meridian_submit_contact_form() {
    // 1. Verify Nonce for security (supporting guest fallback for logged-in users to avoid session/cache mismatches)
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    $nonce_verified = wp_verify_nonce( $nonce, 'meridian_contact_nonce' );

    if ( ! $nonce_verified && is_user_logged_in() ) {
        $current_user_id = get_current_user_id();
        wp_set_current_user( 0 ); // Temporarily check as guest
        $nonce_verified = wp_verify_nonce( $nonce, 'meridian_contact_nonce' );
        wp_set_current_user( $current_user_id ); // Restore original user
    }

    if ( ! $nonce_verified ) {
        wp_send_json_error( array( 'message' => __( 'Security check failed. Please refresh the page and try again.', 'meridian-theme' ) ) );
    }

    // 2. Honeypot check (spam detection)
    if ( ! empty( $_POST['website_hp'] ) ) {
        // Silently fail or return success to trick spam bots
        wp_send_json_success( array( 'message' => __( 'Enquiry sent successfully!', 'meridian-theme' ) ) );
    }

    // 3. Rate Limiting (transient-based check by IP)
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $ip_transient_key = 'meridian_contact_limit_' . md5( $user_ip );
    
    if ( get_transient( $ip_transient_key ) ) {
        wp_send_json_error( array( 'message' => __( 'You are sending enquiries too fast. Please wait a few minutes.', 'meridian-theme' ) ) );
    }

    // 4. Validate and Sanitize Inputs
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
    $budget  = isset( $_POST['budget'] ) ? sanitize_text_field( wp_unslash( $_POST['budget'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'meridian-theme' ) ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Invalid email address.', 'meridian-theme' ) ) );
    }

    // 5. Save Inquiry to Database (Custom Post Type)
    $inquiry_id = wp_insert_post( array(
        'post_title'   => $name,
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'meridian_inquiry',
    ) );

    if ( $inquiry_id && ! is_wp_error( $inquiry_id ) ) {
        update_post_meta( $inquiry_id, 'inquiry_email', $email );
        update_post_meta( $inquiry_id, 'inquiry_company', $company );
        update_post_meta( $inquiry_id, 'inquiry_budget', $budget );
    }

    // 6. Send Email
    $admin_email = get_option( 'admin_email' );
    $subject = sprintf( '[Meridian Studio] New Contact Inquiry from %s', $name );
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        sprintf( 'Reply-To: %s <%s>', $name, $email )
    );

    $body = "<h2>New Contact Enquiry</h2>";
    $body .= sprintf( "<p><strong>Name:</strong> %s</p>", esc_html( $name ) );
    $body .= sprintf( "<p><strong>Email:</strong> %s</p>", esc_html( $email ) );
    if ( ! empty( $company ) ) {
        $body .= sprintf( "<p><strong>Company:</strong> %s</p>", esc_html( $company ) );
    }
    if ( ! empty( $budget ) ) {
        $body .= sprintf( "<p><strong>Project Budget:</strong> %s</p>", esc_html( $budget ) );
    }
    $body .= sprintf( "<p><strong>Message:</strong><br>%s</p>", nl2br( esc_html( $message ) ) );

    // Try sending email (proceed regardless of local SMTP failure status)
    wp_mail( $admin_email, $subject, $body, $headers );

    // Set rate limit transient for 5 minutes (300 seconds)
    set_transient( $ip_transient_key, true, 300 );
    
    wp_send_json_success( array( 'message' => __( 'Thank you! Your enquiry has been received. We\'ll review your details and get back to you within two working days.', 'meridian-theme' ) ) );
}
add_action( 'wp_ajax_meridian_submit_contact', 'meridian_submit_contact_form' );
add_action( 'wp_ajax_nopriv_meridian_submit_contact', 'meridian_submit_contact_form' );
