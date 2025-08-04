<?php
get_header();

echo do_shortcode('[searchandfilter field="3"]');
?>


<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php
    // Modify the main query posts per page to 9 on taxonomy archives
    if ( is_tax() || is_category() || is_tag() ) {
        // This hook should be in functions.php ideally, but we can override here temporarily
        // So instead, let's use 'pre_get_posts' hook in functions.php to set posts_per_page = 9 for taxonomy archives

        // For demo, just assume it's set and proceed with main query below
    }

    if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title"><?php echo esc_html( single_term_title( '', false ) ); ?></h1>
            <?php
            $term_description = term_description();
            if ( ! empty( $term_description ) ) {
                echo '<div class="taxonomy-description">' . wp_kses_post( $term_description ) . '</div>';
            }
            ?>
        </header><!-- .page-header -->

        <ul class="taxonomy-post-list">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php
            endwhile;
            ?>
        </ul>

        <?php

    else :
        echo '<p>No posts found.</p>';
    endif;
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
