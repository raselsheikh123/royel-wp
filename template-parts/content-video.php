<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Royel_Construction
 */
$video_link = get_post_meta(get_the_ID(), 'post_format_video_metabox', true);

$post_page_id = get_option( 'page_for_posts' );
$post_template_meta = get_post_meta($post_page_id, 'royel_blog_page_meta', true);
$post_template = $post_template_meta['blog_page_templates'];
if (('blog_grid' == $post_template)){
	$class = 'col col-lg-4 col-xs-6';
}else{
	$class = 'col-md-6 col-xs-6';
}
?>

<div class="<?php echo esc_attr($class); ?>">
    <div class="blog-single-item">
        <div class="grid">
            <div class="entry-media video-media">
                <img src="<?php the_post_thumbnail_url('blog-page-thumbnail');  ?>" alt class="img img-responsive">
                <?php if (!empty($video_link['video-link']['url'])): ?>
                <a href="<?php echo esc_url($video_link['video-link']['url']); ?>" data-type="iframe" class="video-play"><i class="fa fa-play"></i></a>
                <?php endif; ?>
            </div>
            <div class="entry-body">
                <div class="entry-meta">
					<?php
					$categories = get_the_category();
					foreach ($categories as $category){
						echo '<a href="'.get_category_link($category).'">'.$category->name.'</a>';
					}
					?>

                </div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo wp_kses(wp_trim_words( get_the_content(), 10, '...' ), true); ?></p>
                <a href="<?php the_permalink(); ?>" class="read-more"><?php _e('Read more..','royel-construction'); ?></a>
            </div>
        </div>
    </div>
</div>
