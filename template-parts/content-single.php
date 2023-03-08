<?php
$author_id = get_the_author_meta('ID');
?>
<div class="post">
	<div class="media">
		<?php the_post_thumbnail('full'); ?>
	</div>
	<div class="post-title-meta">
        <div class="single-post-category-list">
            <?php
            $categories = get_the_category();
            foreach ($categories as $category){
                echo '<button class="btn">'.$category->name.'</button>';
            }
            ?>
        </div>
		<h2><?php the_title(); ?></h2>
		<ul>
			<li><a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo esc_html(get_the_author_meta('display_name')); ?></a></li>
			<li><a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>"><?php echo esc_html(get_the_date('j M, Y')) ?></a></li>
		</ul>
	</div>
	<div class="post-body">
		<?php the_content(); ?>
	</div>
</div> <!-- end post -->

<div class="tag-share">
	<div>
		<?php single_post_tag_list(); ?>
	</div>

	<div>
        <?php royel_single_post_share(); ?>
	</div>
</div>
