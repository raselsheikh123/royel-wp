<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Royel_Construction
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area comments">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
        <div class="title">
		    <h3 class="comments-title">
			<?php
			$royel_construction_comment_count = get_comments_number();
			if ( '1' === $royel_construction_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One Comment', 'royel-construction' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Comments', '%1$s Comments', $royel_construction_comment_count, 'comments title', 'royel-construction' ) ),
					number_format_i18n( $royel_construction_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->
        </div>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'callback' => 'royel_comments',
                    'style' => 'ol'
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'royel-construction' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$args = array(
		'comment_notes_before' => '',
        'label_submit' => __('Submit', 'royel-construction'),
        'class_form' => 'clearfix'
	);
	comment_form($args);
	?>

</div><!-- #comments -->
