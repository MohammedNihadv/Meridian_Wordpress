<?php
/**
 * The front-page.php template file
 *
 * @package MeridianTheme
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-container container grid">
        <!-- Hero Text content -->
        <div class="hero-content reveal-on-load">
            <span class="hero-eyebrow eyebrow-label">BRAND &amp; DIGITAL STUDIO &mdash; EST. 2018</span>
            <h1 class="hero-title display-title">We build brands that <span class="accent-text italic">move.</span></h1>
            <p class="hero-description subhead-text">
                Strategy, identity and websites for companies with momentum &mdash; designed and built under one roof.
            </p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Start a project</a>
                <a href="#work" class="btn btn-secondary">View work</a>
            </div>
            
            <div class="hero-client-list">
                <span class="client-name italic">Northwind</span>
                <span class="client-name italic">Atlas</span>
                <span class="client-name italic">Lumen</span>
                <span class="client-name italic">Field Notes</span>
            </div>
        </div>

        <!-- Hero Image content -->
        <div class="hero-image-container reveal-on-load">
            <div class="hero-image-wrapper">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Meridian Studio Creative Workspace" class="hero-main-image" width="1440" height="980" />
                <div class="hero-stats-card">
                    <span class="stats-number display-title">120+</span>
                    <span class="stats-label">brands shaped since 2018</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What We Do / Selected Work Section -->
<section id="work" class="services-work-section section-padding border-top">
    <div class="container">
        <!-- Section Header -->
        <div class="services-header-grid grid">
            <h2 class="section-title display-title reveal">What we do</h2>
            <div class="services-eyebrow-container reveal">
                <span class="eyebrow-label">04 SERVICES</span>
            </div>
        </div>
        
        <!-- Services Grid -->
        <div class="services-columns-grid grid reveal">
            <div class="service-col">
                <span class="service-num eyebrow-label">01</span>
                <h3 class="service-col-title">Brand Strategy</h3>
                <p class="service-col-desc body-text">Positioning, naming, messaging and the story that holds it together.</p>
            </div>
            <div class="service-col">
                <span class="service-num eyebrow-label">02</span>
                <h3 class="service-col-title">Identity Design</h3>
                <p class="service-col-desc body-text">Logo systems, type, colour and the rules that keep them consistent.</p>
            </div>
            <div class="service-col">
                <span class="service-num eyebrow-label">03</span>
                <h3 class="service-col-title">Web Design &amp; Build</h3>
                <p class="service-col-desc body-text">Sites that load fast, read clearly and convert &mdash; designed and built in-house.</p>
            </div>
            <div class="service-col">
                <span class="service-num eyebrow-label">04</span>
                <h3 class="service-col-title">Content &amp; Motion</h3>
                <p class="service-col-desc body-text">Art direction, photography and motion that gives the brand a pulse.</p>
            </div>
        </div>

        <!-- Selected Work Cards Grid -->
        <div class="work-grid grid section-margin-top">
            <?php
            $args = array(
                'post_type'      => 'meridian_project',
                'posts_per_page' => 3,
            );
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post();
                    get_template_part( 'template-parts/card', 'project' );
                endwhile;
                wp_reset_postdata();
            else :
                // Fallback static mock cards if no projects exist in database
                ?>
                <article class="project-card reveal">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="project-card-link">
                        <div class="project-card-image-wrapper">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/project-northwind.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Northwind Project" class="project-card-image" loading="lazy" width="640" height="440" />
                        </div>
                        <div class="project-card-content">
                            <h3 class="project-card-title">Northwind</h3>
                            <span class="project-card-meta">Identity &middot; Web</span>
                        </div>
                    </a>
                </article>

                <article class="project-card reveal">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="project-card-link">
                        <div class="project-card-image-wrapper">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/project-atlas.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Atlas Coffee Project" class="project-card-image" loading="lazy" width="640" height="440" />
                        </div>
                        <div class="project-card-content">
                            <h3 class="project-card-title">Atlas Coffee</h3>
                            <span class="project-card-meta">Brand &middot; Packaging</span>
                        </div>
                    </a>
                </article>

                <article class="project-card reveal">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="project-card-link">
                        <div class="project-card-image-wrapper">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/project-lumen.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Lumen Health Project" class="project-card-image" loading="lazy" width="640" height="440" />
                        </div>
                        <div class="project-card-content">
                            <h3 class="project-card-title">Lumen Health</h3>
                            <span class="project-card-meta">Strategy &middot; Web</span>
                        </div>
                    </a>
                </article>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Testimonial Band -->
<section class="testimonial-section section-padding border-top bg-light">
    <div class="container">
        <div class="testimonial-container reveal">
            <span class="testimonial-quote-icon display-title">&ldquo;</span>
            <p class="testimonial-quote display-title">
                Meridian helped us find our voice and build a platform that matches the ambition of our product.
            </p>
            <div class="testimonial-author-meta">
                <span class="author-name">Sarah Chen</span>
                <span class="author-title eyebrow-label">CEO, Northwind</span>
            </div>
        </div>
    </div>
</section>

<!-- CTA Band -->
<section class="cta-band-section bg-accent text-light reveal">
    <div class="container cta-container flex">
        <h2 class="cta-heading display-title">Have a project in mind?</h2>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-secondary btn-light">Start a project &rarr;</a>
    </div>
</section>

<?php
get_footer();
