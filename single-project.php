<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Royel_Construction
 */

get_header();
$breadcrumb_meta_content = get_post_meta(get_the_ID(), 'royel_page_meta' , true);
?>
<?php
if ( ! is_front_page() ) {
    if (isset($breadcrumb_meta_content['is_active_breadcrumb'])){
	    if ( true == $breadcrumb_meta_content['is_active_breadcrumb']){
		    royel_the_breadcrumbs();
	    }
    }

}
?>

    <main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/single', 'project' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    </main><!-- #main -->

<?php
get_footer();
