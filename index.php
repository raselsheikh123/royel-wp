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


?>
    <?php royel_the_breadcrumbs(); ?>

<?php
    $post_page_id = get_option( 'page_for_posts' );
    $post_template_meta = get_post_meta($post_page_id, 'royel_blog_page_meta', true);
    $post_template = $post_template_meta['blog_page_templates'];
?>

    <?php

        if ('blog_left_sidebar' == $post_template){
            ?>
            <!-- start blog-with-sidebar-section -->
            <section class="blog-with-sidebar-section section-padding">
                <div class="container">
                    <div class="row blog-with-sidebar">
				        <?php $class = is_active_sidebar( 'right-sidebar' ) ? 'col-lg-8 col-lg-offset-1 col-lg-push-3 col-md-8 col-md-push-4' : 'col-lg-12 col-md-12'; ?>
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
                            <div class="blog-sidebar col col-lg-3 col-lg-pull-9 col-md-4 col-md-pull-8 col-sm-5">
						        <?php get_sidebar(); ?>
                            </div>
				        <?php endif; ?>
                    </div>
                </div> <!-- end container -->
            </section>
            <!-- end blog-with-sidebar-section -->
            <?php
        }
        elseif ('blog_grid' == $post_template){
            ?>
            <!-- start blog-with-sidebar-section -->
            <section class="blog-section-s2 section-padding">
                <div class="container">
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
                </div> <!-- end container -->
            </section>
            <!-- end blog-with-sidebar-section -->
            <?php
        }
        else{  ?>
            <!-- start blog-with-sidebar-section -->
            <section class="blog-with-sidebar-section section-padding">
                <div class="container">
                    <div class="row blog-with-sidebar">
                        <?php $class = is_active_sidebar( 'right-sidebar' ) ? 'col-lg-8 col-md-8' : 'col-lg-12 col-md-12'; ?>
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
        }
    ?>


<?php
get_footer();
