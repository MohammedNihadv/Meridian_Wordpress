<?php
/**
 * Template part for displaying project cards
 *
 * @package MeridianTheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'project-card reveal' ); ?>>
    <a href="<?php the_permalink(); ?>" class="project-card-link">
        <div class="project-card-image-wrapper">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large', array( 'class' => 'project-card-image', 'loading' => 'lazy' ) ); ?>
            <?php else :
                // Determine matching image from assets based on post slug
                $slug = get_post_field( 'post_name', get_the_ID() );
                $fallback_image = 'placeholder-project.jpg';
                if ( false !== strpos( $slug, 'northwind' ) ) {
                    $fallback_image = 'project-northwind.jpg';
                } elseif ( false !== strpos( $slug, 'atlas' ) ) {
                    $fallback_image = 'project-atlas.jpg';
                } elseif ( false !== strpos( $slug, 'lumen' ) ) {
                    $fallback_image = 'project-lumen.jpg';
                }
                ?>
                <!-- Fallback placeholder image matching the content -->
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $fallback_image . '?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="<?php the_title_attribute(); ?>" class="project-card-image" loading="lazy" width="640" height="440" />
            <?php endif; ?>
        </div>
        
        <div class="project-card-content">
            <h3 class="project-card-title"><?php the_title(); ?></h3>
            <span class="project-card-meta">
                <?php
                // Display project tags/services
                $tags = get_the_tags();
                if ( $tags ) {
                    $tag_names = array();
                    foreach ( $tags as $tag ) {
                        $tag_names[] = esc_html( $tag->name );
                    }
                    echo implode( ' &middot; ', $tag_names );
                } else {
                    // Fallback to custom fields or text
                    $services = get_post_meta( get_the_ID(), 'project_services', true );
                    echo $services ? esc_html( $services ) : 'Design &middot; Development';
                }
                ?>
            </span>
        </div>
    </a>
</article>
