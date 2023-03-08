<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Royel_Construction
 */

get_header();

$class = is_active_sidebar( 'right-sidebar' ) ? 'col-lg-8 col-md-8' : 'col-lg-12 col-md-12';
?>


<?php royel_the_breadcrumbs(); ?>

    <!-- start blog-with-sidebar-section -->
    <section class="blog-with-sidebar-section section-padding">
        <div class="container">
            <div class="row blog-with-sidebar">
                <div class="blog-content col <?php echo esc_attr($class); ?>">
                    <div class="row blog-grids">
						<?php
						if (have_posts()):
							while (have_posts()):
								the_post();
								get_template_part( 'template-parts/content', get_post_format() );
							endwhile;
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>

                    </div> <!-- end row -->

                    <div class="pagination-wrapper">
						<?php
						global $wp_query;

						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages,
							'prev_text' => '<i class="fa fa-angle-double-left"></i>',
							'next_text' => '<i class="fa fa-angle-double-right"></i>',
							'type' => 'list'
						) );
						?>
                    </div>
                </div> <!-- end blog-content -->

				<?php if (is_active_sidebar( 'right-sidebar' )): ?>
                    <div class="blog-sidebar col col-lg-3 col-lg-offset-1 col-md-4 col-sm-5">
						<?php get_sidebar(); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- end blog-with-sidebar-section -->

<?php
get_footer();
