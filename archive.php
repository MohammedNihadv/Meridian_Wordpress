<?php
/**
 * The template for displaying archive pages
 *
 * @package MeridianTheme
 */

get_header();
?>

<!-- Archive Intro -->
<section class="journal-hero-section section-padding">
    <div class="container">
        <div class="journal-header-flex flex reveal-on-load">
            <h1 class="journal-title display-title">
                <?php the_archive_title(); ?>
            </h1>
            
            <!-- Category Navigation Filter -->
            <div class="journal-category-filter">
                <?php
                $categories = get_categories();
                $current_cat_id = is_category() ? get_queried_object_id() : 0;
                
                // "All" Category link
                echo '<a href="' . esc_url( home_url( '/journal/' ) ) . '" class="category-filter-pill">All</a>';
                
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
    <?php if ( have_posts() ) : ?>
        <!-- Archive Grid -->
        <div class="journal-grid grid">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/card', 'journal' );
            endwhile;
            ?>
        </div>
    <?php else : ?>
        <p class="body-text">No posts found.</p>
    <?php endif; ?>
</div>

<?php
get_footer();
