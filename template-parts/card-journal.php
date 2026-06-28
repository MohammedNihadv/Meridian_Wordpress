<?php
/**
 * Template part for displaying journal grid cards
 *
 * @package MeridianTheme
 */

// Calculate reading time dynamically
$content = get_post_field( 'post_content', get_the_ID() );
$word_count = str_word_count( strip_tags( $content ) );
$read_time = ceil( $word_count / 200 ); // 200 words per minute
if ( $read_time < 1 ) {
    $read_time = 1;
}

// Get primary category name
$categories = get_the_category();
$category_name = ! empty( $categories ) ? $categories[0]->name : 'Uncategorized';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'journal-card reveal' ); ?>>
    <a href="<?php the_permalink(); ?>" class="journal-card-link">
        <div class="journal-card-image-wrapper">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large', array( 'class' => 'journal-card-image', 'loading' => 'lazy' ) ); ?>
            <?php else :
                // Determine matching image from assets based on post slug
                $slug = get_post_field( 'post_name', get_the_ID() );
                $fallback_image = 'placeholder-journal.jpg';
                if ( false !== strpos( $slug, 'slower-brands' ) ) {
                    $fallback_image = 'journal-slower-brands.jpg';
                } elseif ( false !== strpos( $slug, 'design-systems' ) ) {
                    $fallback_image = 'journal-design-systems.jpg';
                } elseif ( false !== strpos( $slug, 'shipping' ) || false !== strpos( $slug, '40-sites' ) ) {
                    $fallback_image = 'journal-shipping-sites.jpg';
                }
                ?>
                <!-- Fallback placeholder image matching the content -->
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $fallback_image . '?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="<?php the_title_attribute(); ?>" class="journal-card-image" loading="lazy" width="640" height="400" />
            <?php endif; ?>
        </div>
        
        <div class="journal-card-content">
            <div class="journal-card-meta-top">
                <span class="journal-card-category"><?php echo esc_html( $category_name ); ?></span>
            </div>
            
            <h3 class="journal-card-title"><?php the_title(); ?></h3>
            
            <div class="journal-card-meta-bottom">
                <span class="journal-card-date"><?php echo esc_html( get_the_date( 'M Y' ) ); ?></span>
                <span class="journal-card-dot">&middot;</span>
                <span class="journal-card-read-time"><?php echo esc_html( $read_time ); ?> min</span>
            </div>
        </div>
    </a>
</article>
