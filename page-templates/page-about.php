<?php
/**
 * Template Name: About Template
 *
 * @package MeridianTheme
 */

get_header();
?>

<!-- About Hero Section -->
<section class="about-hero-section section-padding">
    <div class="container">
        <div class="about-hero-content reveal-on-load">
            <span class="about-eyebrow eyebrow-label">THE STUDIO</span>
            <h1 class="about-title display-title">A small studio with a stubborn belief that good design pays for itself.</h1>
        </div>
    </div>
</section>

<!-- Studio Story & Stats Section -->
<section class="studio-story-section section-padding-bottom">
    <div class="container">
        <div class="story-grid grid">
            <!-- Left Side: Image -->
            <div class="story-image-wrapper reveal">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/studio.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Meridian Studio Team Collaboration" class="story-main-image" />
            </div>
            
            <!-- Right Side: Content & Stats -->
            <div class="story-content-wrapper reveal">
                <p class="story-intro subhead-text">
                    We're eight people who care about craft. We work in small teams, ship in weeks not quarters, and stay close to the businesses we build for.
                </p>
                
                <!-- Stats Grid -->
                <div class="about-stats-grid grid">
                    <div class="stat-item">
                        <span class="stat-num display-title">8</span>
                        <span class="stat-label eyebrow-label">people</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num display-title">120+</span>
                        <span class="stat-label eyebrow-label">projects</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-num display-title">2018</span>
                        <span class="stat-label eyebrow-label">founded</span>
                    </div>
                </div>
                
                <div class="story-values-box border-top">
                    <p class="story-values body-text">
                        <strong>Values &mdash;</strong> Clarity over cleverness &middot; Build to last &middot; Ship, then refine.
                    </p>
                    <p>We believe the best solutions are the simplest ones. We partner with founders who are in it for the long haul, creating work that stands the test of time while remaining agile enough to evolve with the market.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- The Team Section -->
<section class="team-section section-padding border-top bg-light">
    <div class="container">
        <span class="team-eyebrow eyebrow-label reveal">THE TEAM</span>
        
        <div class="team-grid grid section-margin-top">
            <div class="team-card reveal">
                <div class="team-avatar-wrapper">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/team-elena.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Elena Marsh" class="team-avatar" />
                </div>
                <div class="team-info">
                    <h3 class="team-name">Elena Marsh</h3>
                    <span class="team-role eyebrow-label">Strategy Lead</span>
                </div>
            </div>
            
            <div class="team-card reveal">
                <div class="team-avatar-wrapper">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/team-marcus.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Marcus Vance" class="team-avatar" />
                </div>
                <div class="team-info">
                    <h3 class="team-name">Marcus Vance</h3>
                    <span class="team-role eyebrow-label">Creative Director</span>
                </div>
            </div>
            
            <div class="team-card reveal">
                <div class="team-avatar-wrapper">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/team-liam.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Liam Foster" class="team-avatar" />
                </div>
                <div class="team-info">
                    <h3 class="team-name">Liam Foster</h3>
                    <span class="team-role eyebrow-label">Tech Lead</span>
                </div>
            </div>
            
            <div class="team-card reveal">
                <div class="team-avatar-wrapper">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/team-sophie.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Sophie Chen" class="team-avatar" />
                </div>
                <div class="team-info">
                    <h3 class="team-name">Sophie Chen</h3>
                    <span class="team-role eyebrow-label">Brand Designer</span>
                </div>
            </div>
            
            <div class="team-card reveal">
                <div class="team-avatar-wrapper">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/team-daniel.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Daniel Kim" class="team-avatar" />
                </div>
                <div class="team-info">
                    <h3 class="team-name">Daniel Kim</h3>
                    <span class="team-role eyebrow-label">Front-end Developer</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
