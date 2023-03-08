<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Royel_Construction
 */

get_header();
$class = is_active_sidebar( 'right-sidebar' ) ? 'col-lg-9 col-md-9' : 'col-lg-12 col-md-12';
?>

<?php royel_the_breadcrumbs(); ?>

    <!-- start blog-single-main-content -->
    <section class="blog-single-main-content section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-sm-12 blog-single-content <?php echo esc_attr($class); ?>">
	                <?php
	                while ( have_posts() ) :
		                the_post();

		                get_template_part( 'template-parts/content', 'single' );


		                // If comments are open or we have at least one comment, load up the comment template.
		                if ( comments_open() || get_comments_number() ) :
			                comments_template();
		                endif;

	                endwhile; // End of the loop.
                    wp_reset_postdata();
	                ?>
                </div> <!-- end blog-single-content -->


	            <?php if (is_active_sidebar( 'right-sidebar' )): ?>
                    <div class="col col-md-3 col-lg-3 col-sm-12 blog-sidebar">
			            <?php get_sidebar(); ?>
                    </div>
	            <?php endif; ?>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end blog-single-main-content -->

<?php

get_footer();

