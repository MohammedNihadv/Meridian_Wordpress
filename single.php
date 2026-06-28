<?php
/**
 * The template for displaying all single posts
 *
 * @package MeridianTheme
 */

get_header();

while ( have_posts() ) :
    the_post();
    
    // Calculate dynamic reading time
    $content = get_the_content();
    $word_count = str_word_count( strip_tags( $content ) );
    $read_time = ceil( $word_count / 200 );
    if ( $read_time < 1 ) {
        $read_time = 1;
    }
    
    $categories = get_the_category();
    $primary_cat = ! empty( $categories ) ? $categories[0]->name : 'Strategy';
    
    // Get author metadata or defaults
    $author_name = get_the_author();
    if ( empty( $author_name ) || $author_name === 'admin' ) {
        $author_name = 'Elena Marsh';
    }
    $author_role = get_the_author_meta( 'description' );
    if ( empty( $author_role ) ) {
        $author_role = 'Strategy Lead';
    }
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article-container' ); ?>>
        <!-- Article Header -->
        <header class="entry-header container section-padding-top text-center">
            <div class="article-meta-top reveal-on-load">
                <span class="meta-category eyebrow-label"><?php echo esc_html( strtoupper( $primary_cat ) ); ?></span>
                <span class="meta-dot">&middot;</span>
                <span class="meta-date eyebrow-label"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></span>
                <span class="meta-dot">&middot;</span>
                <span class="meta-read-time eyebrow-label"><?php echo esc_html( $read_time ); ?> MIN READ</span>
            </div>
            
            <h1 class="entry-title display-title article-headline reveal-on-load section-margin-small-top">
                <?php the_title(); ?>
            </h1>
            
            <div class="article-author-info reveal-on-load">
                <span class="author-byline body-text">By <?php echo esc_html( $author_name ); ?> &mdash; <?php echo esc_html( $author_role ); ?></span>
            </div>
        </header>
        
        <!-- Article Hero Image -->
        <div class="article-hero-wrapper container reveal">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'full', array( 'class' => 'article-hero-image', 'loading' => 'eager' ) ); ?>
            <?php else : ?>
                <!-- Fallback premium layout image -->
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/article-hero.jpg?v=' . MERIDIAN_THEME_VERSION ); ?>" alt="<?php the_title_attribute(); ?>" class="article-hero-image" width="1240" height="540" />
            <?php endif; ?>
        </div>

        <!-- Article Content -->
        <div class="entry-content container container-narrow section-padding-bottom reveal">
            <div class="article-rich-body body-text">
                <?php
                if ( ! empty( get_the_content() ) ) {
                    the_content();
                } else {
                    // Fallback visual mock text for evaluation if post is empty
                    ?>
                    <p class="first-paragraph lead-text">
                        Most brand failures aren't loud. They're a slow drift &mdash; a logo tweaked here, a tone shifted there &mdash; until nothing quite fits together. The antidote isn't more activity. It's restraint, and a system you trust enough to leave alone.
                    </p>
                    
                    <blockquote class="wp-block-quote pull-quote">
                        <p>&ldquo;The brands that endure are rarely the ones in the biggest hurry.&rdquo;</p>
                    </blockquote>
                    
                    <p>
                        A slower brand makes fewer, better decisions and lets them compound. It treats consistency as a feature, not a constraint &mdash; and that is exactly what a good design system protects.
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>
    </article>

    <?php
endwhile;

get_footer();
