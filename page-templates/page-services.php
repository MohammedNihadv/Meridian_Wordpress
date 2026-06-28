<?php
/**
 * Template Name: Services Template
 *
 * @package MeridianTheme
 */

get_header();
?>

<!-- Services Intro -->
<section class="services-hero-section section-padding">
    <div class="container">
        <div class="services-hero-content reveal-on-load">
            <span class="services-eyebrow eyebrow-label">WHAT WE DO</span>
            <h1 class="services-title display-title">Four ways we help brands grow</h1>
        </div>
    </div>
</section>

<!-- Services Detail List -->
<section class="services-detail-section section-padding-bottom">
    <div class="container">
        <div class="services-detail-list">
            
            <!-- Service 1 -->
            <div class="service-detail-row grid reveal">
                <div class="service-detail-left">
                    <span class="service-num eyebrow-label">01</span>
                    <h2 class="service-title display-title">Brand Strategy</h2>
                </div>
                <div class="service-detail-center">
                    <p class="service-desc body-text">
                        Positioning, naming, messaging and the story that holds it together. We define the core foundations of your business to give you a clear direction.
                    </p>
                </div>
                <div class="service-detail-right">
                    <div class="service-image-box">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/service-strategy.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Brand Strategy Mockup" class="service-row-image" />
                    </div>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="service-detail-row grid reveal">
                <div class="service-detail-left">
                    <span class="service-num eyebrow-label">02</span>
                    <h2 class="service-title display-title">Identity Design</h2>
                </div>
                <div class="service-detail-center">
                    <p class="service-desc body-text">
                        Logo systems, typography, color palettes and guidelines that make sure your brand looks consistent across all mediums.
                    </p>
                </div>
                <div class="service-detail-right">
                    <div class="service-image-box">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/service-identity.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Identity Design Assets" class="service-row-image" />
                    </div>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="service-detail-row grid reveal">
                <div class="service-detail-left">
                    <span class="service-num eyebrow-label">03</span>
                    <h2 class="service-title display-title">Web Design &amp; Build</h2>
                </div>
                <div class="service-detail-center">
                    <p class="service-desc body-text">
                        High-performance websites that load fast, read clearly and convert visitors. Hand-crafted code developed locally to ensure the best possible SEO.
                    </p>
                </div>
                <div class="service-detail-right">
                    <div class="service-image-box">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/service-web.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Web Development Workspace" class="service-row-image" />
                    </div>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="service-detail-row grid reveal">
                <div class="service-detail-left">
                    <span class="service-num eyebrow-label">04</span>
                    <h2 class="service-title display-title">Content &amp; Motion</h2>
                </div>
                <div class="service-detail-center">
                    <p class="service-desc body-text">
                        Art direction, high-quality photography, and custom motion graphics that give your brand a vibrant, engaging, and professional digital pulse.
                    </p>
                </div>
                <div class="service-detail-right">
                    <div class="service-image-box">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/service-motion.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Content & Motion Studio" class="service-row-image" />
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Bottom Services Callout Band -->
<section class="services-callout-section bg-dark text-light reveal">
    <div class="container services-callout-container flex">
        <h2 class="callout-heading display-title">Not sure where to start?</h2>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-accent">Book a call &rarr;</a>
    </div>
</section>

<?php
get_footer();
