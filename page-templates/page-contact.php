<?php
/**
 * Template Name: Contact Template
 *
 * @package MeridianTheme
 */

get_header();
?>

<section class="contact-section section-padding-large">
    <div class="container grid contact-grid">
        
        <!-- Contact Left Column (Details) -->
        <div class="contact-details reveal-on-load">
            <span class="contact-eyebrow eyebrow-label">GET IN TOUCH</span>
            <h1 class="contact-title display-title">Let's build something <span class="accent-text italic">good.</span></h1>
            <p class="contact-description body-text">
                Tell us a little about your project and we'll be back within two working days.
            </p>
            
            <div class="contact-info-list section-margin-top">
                <div class="contact-info-item">
                    <span class="info-label eyebrow-label">EMAIL</span>
                    <a href="mailto:hello@meridian.studio" class="info-value body-text link-underlined">hello@meridian.studio</a>
                </div>
                
                <div class="contact-info-item">
                    <span class="info-label eyebrow-label">STUDIO</span>
                    <address class="info-value body-text not-italic">
                        14 Calder Lane,<br>
                        Bristol, United Kingdom
                    </address>
                </div>
            </div>
        </div>
        
        <!-- Contact Right Column (Form) -->
        <div class="contact-form-container reveal-on-load">
            <form id="meridian-contact-form" class="contact-form" method="post" novalidate>
                <!-- Honeypot Field for Spam Bots -->
                <div class="hp-wrapper" style="display:none;">
                    <label for="website_hp">Leave this field blank</label>
                    <input type="text" name="website_hp" id="website_hp" tabindex="-1" autocomplete="off" />
                </div>
                
                <!-- Form Group: Name -->
                <div class="form-group">
                    <label for="contact-name" class="form-label eyebrow-label">Name *</label>
                    <input type="text" name="name" id="contact-name" class="form-control" placeholder="Your name" required />
                    <span class="form-error-message" id="error-name" aria-live="polite"></span>
                </div>
                
                <!-- Form Group: Email -->
                <div class="form-group">
                    <label for="contact-email" class="form-label eyebrow-label">Email *</label>
                    <input type="email" name="email" id="contact-email" class="form-control" placeholder="Your email address" required />
                    <span class="form-error-message" id="error-email" aria-live="polite"></span>
                </div>
                
                <!-- Form Group: Company -->
                <div class="form-group">
                    <label for="contact-company" class="form-label eyebrow-label">Company</label>
                    <input type="text" name="company" id="contact-company" class="form-control" placeholder="Your organization" />
                </div>
                
                <!-- Form Group: Project Budget -->
                <div class="form-group">
                    <label for="contact-budget" class="form-label eyebrow-label">Project budget</label>
                    <div class="select-wrapper">
                        <select name="budget" id="contact-budget" class="form-control select-control">
                            <option value="" disabled selected>Select a range</option>
                            <option value="under-1l">Under &#8377;1,00,000</option>
                            <option value="1l-5l">&#8377;1,00,000 &ndash; &#8377;5,00,000</option>
                            <option value="5l-10l">&#8377;5,00,000 &ndash; &#8377;10,00,000</option>
                            <option value="above-10l">&#8377;10,00,000 +</option>
                        </select>
                    </div>
                </div>
                
                <!-- Form Group: Message -->
                <div class="form-group">
                    <label for="contact-message" class="form-label eyebrow-label">Message *</label>
                    <textarea name="message" id="contact-message" class="form-control textarea-control" rows="6" placeholder="Tell us about your project goals" required></textarea>
                    <span class="form-error-message" id="error-message" aria-live="polite"></span>
                </div>
                
                <!-- Submit Section -->
                <div class="form-submit-wrapper">
                    <button type="submit" id="contact-submit-btn" class="btn btn-primary btn-submit">
                        <span class="btn-text">Send enquiry &rarr;</span>
                        <span class="btn-spinner" style="display: none;"></span>
                        <span class="btn-success-icon" style="display: none;">&#10003;</span>
                    </button>
                </div>
                
                <!-- Global Form Alert Message -->
                <div id="contact-form-response" class="form-response-alert" style="display: none;" role="alert"></div>
            </form>

            <!-- Success Card (Fades in dynamically on submission success) -->
            <div id="contact-success-card" class="contact-success-card" style="display: none;">
                <div class="success-icon-wrapper">
                    <svg class="success-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="success-checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="success-checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <h3 class="success-title display-title">Enquiry Sent</h3>
                <p id="contact-success-message" class="success-message body-text">Thank you! Your message has been successfully saved in our database.</p>
            </div>
        </div>
        
    </div>
</section>

<!-- Embedded Map Block Section -->
<section class="map-section border-top">
    <div class="map-container">
        <!-- Renders a premium grayscale map container matching styling -->
        <div id="contact-map" class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d155452.48398858204!2d-2.7307997973801264!3d51.468407421370216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48718a7f432be569%3A0xee41a6b28732f741!2sBristol%2C%20UK!5e0!3m2!1sen!2sin!4v1719280000000!5m2!1sen!2sin" 
                    width="100%" 
                    height="450" 
                    style="border:0; filter: grayscale(1) invert(0.9) contrast(1.2);" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<?php
get_footer();
