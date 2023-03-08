<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function royel_preloader(){
	$preloader_enable = cs_get_option('preloader_enable');
	if($preloader_enable == true):
		?>
		<div class="preloader">
			<div class="lds-ellipsis">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	<?php
	endif;
}

/**
 * Royel Menu Register
 *
 * @return void
 */
function royel_menu_register(){
	if(get_post_meta(get_the_ID(), 'royel_page_meta', true)) {
		$page_meta = get_post_meta(get_the_ID(), 'royel_page_meta', true);
	} else {
		$page_meta = array();
	}

	if( array_key_exists( 'ap_custom_menu', $page_meta )) {
		$ap_custom_menu = $page_meta['ap_custom_menu'];
	} else {
		$ap_custom_menu = false;
	}

	echo str_replace(['sub-menu'], ['submenu'], wp_nav_menu( array(
		'echo'           => false,
		'theme_location' => $ap_custom_menu != true ? 'main_menu': 'onepage_menu',
		'menu_id'        =>'royel-primary-menu',
		'fallback_cb'    => 'Royel_Bootstrap_Navwalker::fallback',
	)) );
}

/**
 * Royel Menu Register
 *
 * @return void
 */
function royel_mobile_menu_register(){
	echo str_replace(['menu-item-has-children'], ['dropdown'], wp_nav_menu( array(
		'echo'           => false,
		'theme_location' => 'main_menu',
		'menu_id'        =>'mobile-menu-active',
		'link_before' => '<span>',
		'link_after'=>'</span>',
		'fallback_cb'    => 'Royel_Bootstrap_Navwalker::fallback',
	)) );
}

/**
 * Royel Header Option
 *
 * @return void
 */
function royel_header_option(){
	if('header-style-one' === royel_site_header()){
		get_template_part('template-parts/header/header', 'one');
	}elseif('header-style-two' === royel_site_header()){
		get_template_part('template-parts/header/header', 'two');
	}elseif('header-style-three' === royel_site_header()){
		get_template_part('template-parts/header/header', 'three');
	}else{
		get_template_part('template-parts/header/header', 'three');
	}
}


/**
 * Royel Footer Option
 *
 * @return void
 */
function royel_footer_option(){
	if('footer-style-one' === royel_site_footer()){
		get_template_part('template-parts/footer/footer', 'one');
	}else{
		get_template_part('template-parts/footer/footer', 'one');
	}
}

/**
 * Royel Post Loop
 *
 * @return void
 */
function royel_post_loop(){ ?>
	<?php
	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			get_template_part( 'template-parts/post-formats/content', get_post_format() );

		endwhile; ?>
		<div class="pagination_wrap pt-50">
			<?php royel_pagination();?>
		</div>


	<?php else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
	<?php
}

/**
 * Royel Single Post Loop
 *
 * @return void
 */
function royel_singel_post_loop(){ ?>
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'single' );

		royel_single_post_pagination();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
	<?php
}

/**
 * Royel Search Pages
 *
 * @return void
 */
function royel_search_page(){ ?>
	<?php if ( have_posts() ) : ?>

		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );

		endwhile;?>

		<div class="pagination_wrap pt-50">
			<?php royel_pagination();?>
		</div>

	<?php else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
	<?php
}

/**
 * Royel Page Loop
 *
 * @return void
 */
function royel_page_loop(){ ?>
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
	<?php
}

/**
 * Archive Loop
 *
 * @return void
 */
function royel_archive_loop(){ ?>
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post-formats/content', get_post_format() );

			endwhile; ?>

			<div class="pagination_wrap pt-50">
				<?php royel_pagination();?>
			</div>

		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
	<?php
}

/**
 * Footer Content
 *
 * @return void
 */
function royel_footer_content(){
	$footer_link = cs_get_option('footer_link');
	$footer_about = cs_get_option('footer_about');
	$footer_social = cs_get_option('footer_social');
	$app_text = cs_get_option('app_text');
	$app_title = cs_get_option('app_title');
	$app_1 = cs_get_option('app_1');
	$app_1_link = cs_get_option('app_1_link');
	$app_2 = cs_get_option('app_2');
	$app_2_link = cs_get_option('app_2_link');
	$royel_copywrite_text = cs_get_option('royel_copywrite_text');
	$f4_shape_1 = cs_get_option('f4_shape_1');
	$f4_shape_2 = cs_get_option('f4_shape_2');
	$f7_shape_1 = cs_get_option('f7_shape_1');
	$f7_shape_2 = cs_get_option('f7_shape_2');
	$f7_shape_3 = cs_get_option('f7_shape_3');
	?>
	<div class="container">
		<div class="row mt-none-30 pb-55">
			<div class="tx-col mt-30">
				<div class="footer__widget">
					<div class="footer__logo mb-30">
						<?php
						if('footer-style-two' != royel_site_footer()){
							royel_logo();
						}else{
							royel_logo_v2();
						}
						?>
					</div>
					<?php if(!empty($footer_about)):?>
						<p><?php echo wp_kses($footer_about, true);?></p>
					<?php endif;?>
					<?php if(!empty($footer_social)):?>
						<div class="footer__apps-icon ul_li mt-40">
							<?php foreach($footer_social as $item):?>
								<a href="<?php echo esc_url($item['link']);?>"><i class="<?php echo esc_attr($item['icon']);?>"></i></a>
							<?php endforeach;?>
						</div>
					<?php endif;?>
				</div>
			</div>
			<?php
			if(is_active_sidebar('footer-1')){
				dynamic_sidebar('footer-1');
			}
			?>
			<div class="tx-col mt-30">
				<div class="footer__widget">

					<?php if(!empty($app_title)):?>
						<h3><?php echo wp_kses($app_title, true);?></h3>
					<?php endif;?>

					<?php if(!empty($app_text)):?>
						<p><?php echo wp_kses($app_text, true);?></p>
					<?php endif;?>

					<div class="apps-img ul_li">
						<?php if(!empty($app_1['url'])):?>
							<a href="<?php echo esc_url($app_1_link);?>"><img src="<?php echo esc_url($app_1['url']);?>" alt="<?php echo esc_attr($app_1['alt']);?>"></a>
						<?php endif;?>
						<?php if(!empty($app_2['url'])):?>
							<a href="<?php echo esc_url($app_2_link);?>"><img src="<?php echo esc_url($app_2['url']);?>" alt="<?php echo esc_attr($app_2['alt']);?>"></a>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
		<div class="footer__bottom ul_li_between">
			<div class="footer__copyright mt-15">
				<?php
				if(!empty($royel_copywrite_text)){
					echo wp_kses( $royel_copywrite_text, true );
				}else{
					esc_html_e( '&copy; 2022 royel - Themexriver. All Rights Reserved.', 'royel-construction' );
				}
				?>
			</div>
			<?php if(!empty($footer_link)):?>
				<div class="footer__link ul_li mt-15">
					<?php foreach($footer_link as $flink):?>
						<a href="<?php echo esc_url($flink['link']['url']);?>"><?php echo esc_attr($flink['link']['text']);?></a>
					<?php endforeach;?>
				</div>
			<?php endif;?>
		</div>
	</div>
	<?php if('footer-style-four' === royel_site_footer()): if(!empty($f4_shape_1['url']) || !empty($f4_shape_2['url'])):?>
		<div class="footer__shape-da">
			<div class="shape shape--1 slide-up-down">
				<img src="<?php echo esc_url($f4_shape_1['url']);?>" alt="<?php esc_attr_e( 'Shape', 'royel-construction' );?>">
			</div>
			<div class="shape shape--2">
				<img src="<?php echo esc_url($f4_shape_2['url']);?>" alt="<?php esc_attr_e( 'Shape', 'royel-construction' );?>">
			</div>
		</div>
	<?php endif; endif;?>

	<?php if('footer-style-seven' === royel_site_footer()): if(!empty($f7_shape_1['url']) || !empty($f7_shape_2['url']) || !empty($f7_shape_3['url'])):?>
		<div class="footer__shape">
			<img src="<?php echo esc_url($f7_shape_1['url']);?>" alt="<?php esc_attr_e( 'Shape', 'royel-construction' );?>">
			<img src="<?php echo esc_url($f7_shape_2['url']);?>" alt="<?php esc_attr_e( 'Shape', 'royel-construction' );?>">
			<img src="<?php echo esc_url($f7_shape_3['url']);?>" alt="<?php esc_attr_e( 'Shape', 'royel-construction' );?>">
		</div>
	<?php endif; endif;?>
	<?php
}

function royel_sidebar_nav(){
	$about_title = cs_get_option('about_title');
	$about_text = cs_get_option('about_text');
	$contact_info_title = cs_get_option('contact_info_title');
	$button_label = cs_get_option('button_label');
	$contact_info_title = cs_get_option('contact_info_title');
	$contact_info_items = cs_get_option('contact_info_items');
	$social_icons = cs_get_option('social_icons');
	?>
	<aside class="slide-bar">
		<div class="close-mobile-menu">
			<a class="tx-close" href="javascript:void(0);"></a>
		</div>

		<!-- sidebar-info start -->
		<div class="sidebar-info">
			<div class="sidebar-logo mb-30">
				<?php royel_logo();?>
			</div>
			<div class="sidebar-content mb-45">
				<?php if(!empty($about_title)):?>
					<h4 class="s-title"><?php echo wp_kses($about_title, true);?></h4>
				<?php endif;?>
				<?php if(!empty($about_text)):?>
					<p><?php echo wp_kses($about_text, true);?></p>
				<?php endif;?>
				<?php if(!empty($button_label['text'])):?>
					<a class="thm-btn download-btn" href="<?php echo esc_url($button_label['url']);?>">
                <span class="btn-wrap">
                    <span><?php echo wp_kses($button_label['text'], true);?></span>
                    <span><?php echo wp_kses($button_label['text'], true);?></span>
                </span>
					</a>
				<?php endif;?>
			</div>
			<div class="contact_list mb-30">
				<?php if(!empty($contact_info_title)):?>
					<h4 class="s-title"><?php echo wp_kses($contact_info_title, true);?></h4>
				<?php endif;?>
				<?php if(!empty($contact_info_items)):?>
					<ul class="sidebar-info-list">
						<?php foreach($contact_info_items as $item):?>
							<li>
								<span><i class="<?php echo esc_attr($item['icon']);?>"></i></span>
								<p><?php echo wp_kses($item['title'], true)?></p>
							</li>
						<?php endforeach;?>
					</ul>
				<?php endif;?>
			</div>
			<?php if(!empty($social_icons)):?>
				<div class="sidebar-social mt-20">
					<?php foreach($social_icons as $icon):?>
						<a href="<?php echo esc_url($icon['link']);?>"><i class="<?php echo esc_attr($icon['icon']);?>"></i></a>
					<?php endforeach;?>
				</div>
			<?php endif;?>
		</div>
		<!-- sidebar-info end -->

		<!-- side-mobile-menu start -->
		<nav class="side-mobile-menu">
			<div class="header-mobile-search">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" name="s" value="<?php the_search_query();?>" placeholder="<?php esc_attr_e( 'Search Keywords', 'royel-construction' );?>">
					<button type="submit"><i class="ti-search"></i></button>
				</form>
			</div>
			<?php royel_mobile_menu_register();?>
		</nav>
		<!-- side-mobile-menu end -->
	</aside>
	<div class="body-overlay"></div>
	<?php
}

function royel_dark_sidebar_nav(){
	$about_title = cs_get_option('about_title');
	$about_text = cs_get_option('about_text');
	$contact_info_title = cs_get_option('contact_info_title');
	$button_label = cs_get_option('button_label');
	$contact_info_title = cs_get_option('contact_info_title');
	$contact_info_items = cs_get_option('contact_info_items');
	$social_icons = cs_get_option('social_icons');
	?>
	<aside class="slide-bar slide-bar-black">
		<div class="close-mobile-menu">
			<a class="tx-close" href="javascript:void(0);"></a>
		</div>

		<!-- sidebar-info start -->
		<div class="sidebar-info">
			<div class="sidebar-logo mb-30">
				<?php royel_logo();?>
			</div>
			<div class="sidebar-content mb-45">
				<?php if(!empty($about_title)):?>
					<h4 class="s-title"><?php echo wp_kses($about_title, true);?></h4>
				<?php endif;?>
				<?php if(!empty($about_text)):?>
					<p><?php echo wp_kses($about_text, true);?></p>
				<?php endif;?>
				<?php if(!empty($button_label['text'])):?>
					<a class="thm-btn download-btn" href="<?php echo esc_url($button_label['url']);?>">
                <span class="btn-wrap">
                    <span><?php echo wp_kses($button_label['text'], true);?></span>
                    <span><?php echo wp_kses($button_label['text'], true);?></span>
                </span>
					</a>
				<?php endif;?>
			</div>
			<div class="contact_list mb-30">
				<?php if(!empty($contact_info_title)):?>
					<h4 class="s-title"><?php echo wp_kses($contact_info_title, true);?></h4>
				<?php endif;?>
				<?php if(!empty($contact_info_items)):?>
					<ul class="sidebar-info-list">
						<?php foreach($contact_info_items as $item):?>
							<li>
								<span><i class="<?php echo esc_attr($item['icon']);?>"></i></span>
								<p><?php echo wp_kses($item['title'], true)?></p>
							</li>
						<?php endforeach;?>
					</ul>
				<?php endif;?>
			</div>
			<?php if(!empty($social_icons)):?>
				<div class="sidebar-social mt-20">
					<?php foreach($social_icons as $icon):?>
						<a href="<?php echo esc_url($icon['link']);?>"><i class="<?php echo esc_attr($icon['icon']);?>"></i></a>
					<?php endforeach;?>
				</div>
			<?php endif;?>
		</div>
		<!-- sidebar-info end -->

		<!-- side-mobile-menu start -->
		<nav class="side-mobile-menu">
			<div class="header-mobile-search">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" name="s" value="<?php the_search_query();?>" placeholder="<?php esc_attr_e( 'Search Keywords', 'royel-construction' );?>">
					<button type="submit"><i class="ti-search"></i></button>
				</form>
			</div>
			<?php royel_mobile_menu_register();?>
		</nav>
		<!-- side-mobile-menu end -->
	</aside>
	<div class="body-overlay"></div>
	<?php
}

/**
 * Display Login Popup
 *
 * @return void
 */
function royel_login_popup_display(){ ?>
	<div class="modal royel__login_pp fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<?php royel_render_user_popup();?>
				</div>
				<button type="button" class="c-close tx-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
		</div>

	</div>
	<?php
}

/**
 * Global CTA
 *
 * @return void
 */
function global_cta_markup(){
	$cta_sub_title = cs_get_option('cta_sub_title');
	$cta_title = cs_get_option('cta_title');
	$cta_description = cs_get_option('cta_description');
	$cta_btn = cs_get_option('cta_btn');
	$cta_shape1 = cs_get_option('cta_shape1');
	$cta_shape2 = cs_get_option('cta_shape2');
	$cta_join_title = cs_get_option('cta_join_title');
	?>
	<section class="tma-cta tma-cta__bg pt-100 pb-100">
		<div class="container">
			<div class="tx-heading tx-heading--white tx-heading--tma text-center mb-55">
				<span class="subtitle no-bg wow fadeInUp" data-wow-delay="ms"><?php echo wp_kses($cta_sub_title, true)?></span>
				<h3 class="tx-item--title fs-42 mb-15" data-wow-delay="ms">
                    <span class="tx-item--text">
                        <?php
                        echo  preg_replace(
	                        '([&a-zA-Z.,!?0-9]+(?![^<]*>))',
	                        '<span class="tx-text--slide"><span class="wow letter">$0</span></span>', $cta_title
                        );
                        ?>
                    </span>
				</h3>
				<p class="fs-20 text-white"><?php echo wp_kses($cta_description, true)?></p>
			</div>
			<?php if(!empty($cta_btn['text'])):?>
				<div class="tma-cta-btn text-center">
					<a class="thm-btn thm-btn--tma thm-btn--icon" href="<?php echo esc_url($cta_btn['url']);?>">
                    <span class="btn-wrap">
                        <span><?php echo esc_html($cta_btn['text']);?></span>
                        <span><?php echo esc_html($cta_btn['text']);?></span>
                    </span>
						<i class="fal fa-arrow-circle-right"></i>
					</a>
				</div>
			<?php endif;?>
		</div>
		<?php if(!empty($cta_join_title)):?>
			<div class="tma-cta__big-title">
				<span class="wow fadeInDown" data-wow-delay="300ms" data-wow-duration="1000ms"><?php echo esc_html($cta_join_title);?></span>
			</div>
		<?php endif;?>
		<div class="tma-cta__shape">
			<?php if(!empty($cta_shape1['url'])):?>
				<img class="shape shape--1" src="<?php echo esc_url($cta_shape1['url']);?>" alt="<?php echo esc_attr($cta_shape1['alt']);?>">
			<?php endif;?>

			<?php if(!empty($cta_shape2['url'])):?>
				<img class="shape shape--2" src="<?php echo esc_url($cta_shape2['url']);?>" alt="<?php echo esc_attr($cta_shape2['alt']);?>">
			<?php endif;?>

		</div>
	</section>
	<?php
}


function the_breadcrumb() {
	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = '<i class="fa fa-angle-right"></i>'; // delimiter between crumbs
	$home = __('Home', 'royel-construction'); // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	global $post;
	$homeLink = esc_url(home_url());
	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) {
			echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
		}
	} else {
		echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
		if (is_category()) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
			}
			echo wp_kses($before . 'Archive by category "' . single_cat_title('', false) . '"' . $after, true);
		} elseif (is_search()) {
			echo wp_kses($before . 'Search results for "' . get_search_query() . '"' . $after, true);
		} elseif (is_day()) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo wp_kses($before . get_the_time('d') . $after, true);
		} elseif (is_month()) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo wp_kses($before . get_the_time('F') . $after, true);
		} elseif (is_year()) {
			echo wp_kses($before . get_the_time('Y') . $after, true);
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				if ($showCurrent == 1) {
					echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				}
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) {
					$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				}
//				category name before the title
//				echo wp_kses($cats, true);
				if ($showCurrent == 1) {
					echo wp_kses($before . get_the_title() . $after, true);
				}
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			echo wp_kses($before . $post_type->labels->singular_name . $after, true);
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			$cat = $cat[0];
			echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) {
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			}
		} elseif (is_page() && !$post->post_parent) {
			if ($showCurrent == 1) {
				echo wp_kses($before . get_the_title() . $after, true);
			}
		} elseif (is_page() && $post->post_parent) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo wp_kses($breadcrumbs[$i], true);
				if ($i != count($breadcrumbs)-1) {
					echo ' ' . $delimiter . ' ';
				}
			}
			if ($showCurrent == 1) {
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			}
		} elseif (is_tag()) {
			echo wp_kses($before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after, true);
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo wp_kses($before . 'Articles posted by ' . $userdata->display_name . $after, true);
		} elseif (is_404()) {
			echo wp_kses($before . 'Error 404' . $after, true);
		}
		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
				echo ' (';
			}
			echo __('Page', 'royel-construction') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
				echo ')';
			}
		}
		echo '</div>';
	}
} // end the_breadcrumb()

function royel_the_breadcrumbs() {
    ?>
    <!-- start page-title -->
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="breadcrumb">
                        <h1><?php the_title(); ?></h1>
                        <?php the_breadcrumb(); ?>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->
    <?php
}


/**
 * Royel Error
 *
 * @return void
 */
function royel_error_page(){
	$error_title = cs_get_option('error_title');
	$error_code = cs_get_option('error_code');
	$error_info_title = cs_get_option('error_info_title');
	$error_button = cs_get_option('error_button');
	?>
	<!-- Error Section -->
	<div class="error-section">
		<div class="container">
			<div class="content">
				<h1>
					<?php
					if(!empty($error_code)){
						echo esc_html( $error_code );
					}else{
						esc_html_e( '404', 'royel-construction' );
					}
					?>
				</h1>
				<h2>
					<?php
					if(!empty($error_title)){
						echo esc_html( $error_title );
					}else{
						esc_html_e( 'Oops... It looks like you ‘re lost !', 'royel-construction' );
					}
					?>
				</h2>
				<div class="text">
					<?php
					if(!empty($error_info_title)){
						echo esc_html( $error_info_title );
					}else{
						esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'royel-construction' );
					}
					?>
				</div>
				<div class="button-box">
					<a class="thm-btn wow fadeInUp" data-wow-delay="600ms" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="btn-wrap">
                            <span>
                                <?php
                                if(!empty($error_button)){
	                                echo esc_html( $error_button );
                                }else{
	                                esc_html_e( 'Go To Home', 'royel-construction' );
                                }
                                ?>  
                            </span>
                            <span>
                                <?php
                                if(!empty($error_button)){
	                                echo esc_html( $error_button );
                                }else{
	                                esc_html_e( 'Go To Home', 'royel-construction' );
                                }
                                ?>  
                            </span>
                        </span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End Error Section -->
	<?php
}

if ( ! function_exists( 'single_post_tag_list' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function single_post_tag_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<li>', '</li><li>', '</li>' );
			if ( $tags_list ) {?>
                <span><?php esc_html_e( 'Tags:', 'royel-construction' );?></span>
				<?php /* translators: 1: list of tags. */
                echo "<ul class='tag'>";
				printf( '%1$s', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo "</ul>";
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'royel-construction' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}
	}
endif;

function royel_single_post_share() {

	$permalink = get_permalink( get_the_ID() );
	$title     = get_the_title();
	?>
    <ul class="share">
        <li><a class="fb" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>"><i class="fa fa-facebook"></i>Like</a></li>

        <li><a class="tw" onClick="window.open('http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo esc_attr( $title ); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $title ); ?>"><i class="fa fa-twitter"></i>Tweet</a></li>

        <li><a class="ln" onClick="window.open('https://www.linkedin.com/cws/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo esc_attr( $title ); ?>','Linkedin share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>&amp;text=<?php echo str_replace( " ", "%20", $title ); ?>"><i class="fa fa-linkedin"></i>Share</a></li>
    </ul>
	<?php
}

function royel_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;?>

    <li <?php comment_class();?> id="comment-<?php comment_ID()?>">
        <div class="article">
			<?php if ( get_avatar( $comment ) ) {?>
                <div class="author-pic">
					<?php echo get_avatar( $comment, 46 ); ?>
                </div>
			<?php }?>
            <div class="details">
                <div class="author-meta">
                    <div class="name">
                        <h4><?php comment_author(); ?></h4>
                    </div>
                    <div class="date">
                        <span><?php echo date(get_option('date_format')); ?></span>
                    </div>
                    <div class="comment-content">
                        <?php comment_text();?>
                    </div>
                    <div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text'=>wp_kses('Reply', true), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );?>
                    </div>
                </div>

				<?php if ( $comment->comment_approved == '0' ): ?>
                    <p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'royel-construction' );?></em></p>
				<?php endif;?>
            </div>
        </div>
    </li>


	<?php
}

function royel_modify_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );

	$fields['author'] = '<div class="col col-md-4">
                            <input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( "Name", "royel-construction" ) . '" size="22" tabindex="1"' . ( $req ? 'aria-required="true"' : '' ) . ' class="form-control" />
                        </div>';

	$fields['email'] = '<div class="col col-md-4">
                            <input type="email" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( "Email", "royel-construction" ) . '" size="22" tabindex="2"' . ( $req ? 'aria-required="true"' : '' ) . ' class="form-control"  />
                        </div>';

	$fields['url'] = '<div class="col col-md-4">
                        <input type="url" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( "Website", "royel-construction" ) . '" size="22" tabindex="2"' . ( $req ? 'aria-required="false"' : '' ) . ' class="form-control"  />
                    </div>';

	return $fields;
}
add_filter( 'comment_form_default_fields', 'royel_modify_comment_form_fields' );

// comment Move Field
function royel_move_comment_field_to_bottom( $fields ) {
	$fields['comment'] = '<div class="col col-xs-12">
                            <textarea class="form-control" placeholder="write.."></textarea>
                        </div>';
	$comment_field = $fields['comment'];

	unset( $fields['comment'] );
	unset( $fields['cookies'] );
	$fields['comment'] = $comment_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'royel_move_comment_field_to_bottom' );

/**
 * Comment Message Box
 */
function royel_comment_reform( $arg ) {

	$arg['title_reply']   = esc_html__( 'Post your comment', 'royel-construction' );
	$arg['comment_field'] = '<div class="gl-comment-form-input row"><div class="col-lg-12 col-md-12 col-sm-12 field-item"><textarea id="comment" class="form_control" name="comment" cols="77" rows="3" placeholder="' . esc_attr__( "Comment", "royel-construction" ) . '" aria-required="true"></textarea></div></div>';
//	$arg['comment_notes_before'] = '';
	return $arg;

}
add_filter( 'comment_form_defaults', 'royel_comment_reform' );