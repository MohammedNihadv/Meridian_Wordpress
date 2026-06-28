<?php
/**
 * The main template file (Journal Listing)
 *
 * @package MeridianTheme
 */

get_header();

// Calculate reading time for a post helper
function meridian_get_reading_time( $post_id ) {
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    $read_time = ceil( $word_count / 200 );
    return $read_time < 1 ? 1 : $read_time;
}
?>

<!-- Journal Intro -->
<section class="journal-hero-section section-padding">
    <div class="container">
        <div class="journal-header-flex flex reveal-on-load">
            <h1 class="journal-title display-title">Journal</h1>
            
            <!-- Category Navigation Filter -->
            <div class="journal-category-filter">
                <?php
                $categories = get_categories();
                $current_cat_id = is_category() ? get_queried_object_id() : 0;
                
                // "All" Category link
                $all_class = ( $current_cat_id == 0 ) ? 'active-filter' : '';
                echo '<a href="' . esc_url( home_url( '/journal/' ) ) . '" class="category-filter-pill ' . esc_attr( $all_class ) . '">All</a>';
                
                foreach ( $categories as $cat ) {
                    $active_class = ( $current_cat_id == $cat->term_id ) ? 'active-filter' : '';
                    echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="category-filter-pill ' . esc_attr( $active_class ) . '">' . esc_html( $cat->name ) . '</a>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<div class="container section-padding-bottom">
    <?php
    // If it is the first page of the main list, and we are not filtering by category or search, display a Featured Post
    if ( have_posts() && ! is_paged() && ! is_category() && ! is_search() ) :
        // Fetch the first post to display as Featured
        global $post;
        $featured_id = get_the_ID();
        
        $featured_content = get_the_excerpt();
        if ( empty( $featured_content ) ) {
            $featured_content = wp_trim_words( get_the_content(), 25 );
        }
        
        $featured_categories = get_the_category();
        $featured_cat = ! empty( $featured_categories ) ? $featured_categories[0]->name : 'Uncategorized';
        $featured_read_time = meridian_get_reading_time( $featured_id );
        ?>
        
        <!-- Featured Post Section -->
        <section class="featured-post-section section-padding-bottom reveal">
            <div class="featured-post-grid grid">
                <!-- Left: Featured Image -->
                <div class="featured-post-image-wrapper">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'featured-post-image', 'loading' => 'eager' ) ); ?>
                        <?php else :
                            $slug = get_post_field( 'post_name', get_the_ID() );
                            $fallback_image = 'featured-fallback.jpg';
                            if ( false !== strpos( $slug, 'slower-brands' ) ) {
                                $fallback_image = 'featured-slower-brands.jpg';
                            }
                            ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $fallback_image . '?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="<?php the_title_attribute(); ?>" class="featured-post-image" width="760" height="460" />
                        <?php endif; ?>
                    </a>
                </div>
                
                <!-- Right: Featured Content Details -->
                <div class="featured-post-content">
                    <div class="featured-meta-top">
                        <span class="featured-label eyebrow-label">FEATURED</span>
                        <span class="featured-dot">&middot;</span>
                        <span class="featured-category eyebrow-label"><?php echo esc_html( $featured_cat ); ?></span>
                    </div>
                    
                    <h2 class="featured-post-title display-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <p class="featured-post-excerpt body-text">
                        <?php echo esc_html( $featured_content ); ?>
                    </p>
                    
                    <div class="featured-meta-bottom">
                        <span class="featured-date eyebrow-label"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></span>
                        <span class="featured-dot">&middot;</span>
                        <span class="featured-read-time eyebrow-label"><?php echo esc_html( $featured_read_time ); ?> MIN READ</span>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Grid of standard posts (skipping the first featured one) -->
        <div class="journal-grid grid">
            <?php
            // Skip the first post because it was featured
            $count = 0;
            while ( have_posts() ) : the_post();
                $count++;
                if ( $count === 1 ) {
                    continue;
                }
                get_template_part( 'template-parts/card', 'journal' );
            endwhile;
            ?>
        </div>
        
    <?php elseif ( have_posts() ) : ?>
        
        <!-- Standard Archive Grid if Category/Search or Paged -->
        <div class="journal-grid grid">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/card', 'journal' );
            endwhile;
            ?>
        </div>
        
    <?php else : ?>
        
        <!-- Fallback static mock layout if no posts exist in database -->
        <section class="featured-post-section section-padding-bottom reveal">
            <div class="featured-post-grid grid">
                <div class="featured-post-image-wrapper">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/featured-slower-brands.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Case study slower brands" class="featured-post-image" width="760" height="460" />
                    </a>
                </div>
                <div class="featured-post-content">
                    <div class="featured-meta-top">
                        <span class="featured-label eyebrow-label">FEATURED</span>
                        <span class="featured-dot">&middot;</span>
                        <span class="featured-category eyebrow-label">STRATEGY</span>
                    </div>
                    <h2 class="featured-post-title display-title">
                        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">The case for slower brands</a>
                    </h2>
                    <p class="featured-post-excerpt body-text">
                        Why the brands that endure are rarely the ones in the biggest hurry &mdash; and how to build for the long game.
                    </p>
                    <div class="featured-meta-bottom">
                        <span class="featured-date eyebrow-label">May 2026</span>
                        <span class="featured-dot">&middot;</span>
                        <span class="featured-read-time eyebrow-label">6 MIN READ</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="journal-grid grid">
            <article class="journal-card reveal">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="journal-card-link">
                    <div class="journal-card-image-wrapper">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/journal-slower-brands.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Slower Brands" class="journal-card-image" loading="lazy" width="640" height="400" />
                    </div>
                    <div class="journal-card-content">
                        <div class="journal-card-meta-top">
                            <span class="journal-card-category">Strategy</span>
                        </div>
                        <h3 class="journal-card-title">The case for slower brands</h3>
                        <div class="journal-card-meta-bottom">
                            <span class="journal-card-date">May 2026</span>
                            <span class="journal-card-dot">&middot;</span>
                            <span class="journal-card-read-time">6 min</span>
                        </div>
                    </div>
                </a>
            </article>

            <article class="journal-card reveal">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="journal-card-link">
                    <div class="journal-card-image-wrapper">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/journal-design-systems.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Design Systems" class="journal-card-image" loading="lazy" width="640" height="400" />
                    </div>
                    <div class="journal-card-content">
                        <div class="journal-card-meta-top">
                            <span class="journal-card-category">Process</span>
                        </div>
                        <h3 class="journal-card-title">Design systems that actually scale</h3>
                        <div class="journal-card-meta-bottom">
                            <span class="journal-card-date">Apr 2026</span>
                            <span class="journal-card-dot">&middot;</span>
                            <span class="journal-card-read-time">9 min</span>
                        </div>
                    </div>
                </a>
            </article>

            <article class="journal-card reveal">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="journal-card-link">
                    <div class="journal-card-image-wrapper">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/journal-shipping-sites.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="Shipping 40 Sites" class="journal-card-image" loading="lazy" width="640" height="400" />
                    </div>
                    <div class="journal-card-content">
                        <div class="journal-card-meta-top">
                            <span class="journal-card-category">Build</span>
                        </div>
                        <h3 class="journal-card-title">What we learned shipping 40 sites</h3>
                        <div class="journal-card-meta-bottom">
                            <span class="journal-card-date">Mar 2026</span>
                            <span class="journal-card-dot">&middot;</span>
                            <span class="journal-card-read-time">5 min</span>
                        </div>
                    </div>
                </a>
            </article>
        </div>
        
    <?php endif; ?>
</div>

<?php
get_footer();
