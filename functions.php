<?php
/**
 * Royel Construction functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Royel_Construction
 */

/**
 * Define Core File
 */
define( 'ROYEL_THEME_DRI', get_template_directory() );
define( 'ROYEL_THEME_URI', get_template_directory_uri() );
define( 'ROYEL_IMG_PATH', ROYEL_THEME_URI . '/assets/img/' );

add_filter('wpcf7_autop_or_not', '__return_false');

require_once ROYEL_THEME_DRI . '/inc/core-function.php';
require_once ROYEL_THEME_DRI . '/inc/cs-framework-functions.php';
require_once ROYEL_THEME_DRI . '/lib/plugin-activation.php';

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', time() );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function royel_construction_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Royel Construction, use a find and replace
		* to change 'royel-construction' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'royel-construction', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'royel-construction' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'royel_construction_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support( 'post-formats', array( 'video', ) );
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'royel_construction_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function royel_construction_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'royel_construction_content_width', 640 );
}

add_image_size( 'blog-page-thumbnail', 360 );
add_image_size( 'footer-recent-post-widget-thumbnail', 65, 80, true );

add_action( 'after_setup_theme', 'royel_construction_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function royel_construction_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Right Sidebar', 'royel-construction' ),
			'id'            => 'right-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'royel-construction' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget', 'royel-construction' ),
			'id'            => 'footer-widget',
			'description'   => esc_html__( 'Add Footer widgets here.', 'royel-construction' ),
			'before_widget' => '<div id="%1$s" class="col col-lg-3 col-sm-6 footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'royel_construction_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function royel_construction_scripts() {
	wp_enqueue_style( 'royel-construction-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'royel-construction-style', 'rtl', 'replace' );

//	Icon fonts
	wp_enqueue_style( 'font-awesome.min-style', get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'flaticon-style', get_template_directory_uri().'/assets/css/flaticon.css', array(), _S_VERSION );
	wp_enqueue_style( 'fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all' );
	wp_enqueue_style( 'fa5-v4-shims', 'https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css', array(), '5.13.0', 'all' );

	wp_enqueue_style( 'oxygen-font', 'https://fonts.googleapis.com/css2?family=Oxygen:wght@400;700&display=swap', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'raleway-font', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700;800&display=swap', array(), _S_VERSION, 'all' );

//	Bootstrap core CSS
	wp_enqueue_style( 'bootstrap.min-style', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), _S_VERSION );

//	Plugins for this template
	wp_enqueue_style( 'animate-style', get_template_directory_uri().'/assets/css/animate.css', array(), _S_VERSION );
	wp_enqueue_style( 'owl.carousel-style', get_template_directory_uri().'/assets/css/owl.carousel.css', array(), _S_VERSION );
	wp_enqueue_style( 'owl.theme-style', get_template_directory_uri().'/assets/css/owl.theme.css', array(), _S_VERSION );
	wp_enqueue_style( 'owl.transitions-style', get_template_directory_uri().'/assets/css/owl.transitions.css', array(), _S_VERSION );
	wp_enqueue_style( 'jquery.fancybox-style', get_template_directory_uri().'/assets/css/jquery.fancybox.css', array(), _S_VERSION );
	wp_enqueue_style( 'magnific-popup-style', get_template_directory_uri().'/assets/css/magnific-popup.css', array(), _S_VERSION );
	wp_enqueue_style( 'slick-style', get_template_directory_uri().'/assets/css/slick.css', array(), _S_VERSION );


//	Custom styles for this template
	wp_enqueue_style( 'royel-construction-custom-style', get_template_directory_uri().'/assets/css/style.css', array(), _S_VERSION );

//	Start adding script
	wp_enqueue_script( 'royel-construction-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jarallax-js', get_template_directory_uri() . '/assets/js/jarallax.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap.min-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'jquery-plugin-collection-js', get_template_directory_uri() . '/assets/js/jquery-plugin-collection.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'royel-construction-custom-script-js', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'royel_construction_scripts' );

function royel_enqueue_custom_admin_style() {
	wp_enqueue_style( 'flaticon-admin-style', get_template_directory_uri().'/assets/css/flaticon.css', array(), _S_VERSION );

}
add_action( 'admin_enqueue_scripts', 'royel_enqueue_custom_admin_style' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function royel_archive_widget_markup_edit($links) {
	$links = str_replace('</a>&nbsp;(', '<span class="badge">', $links);
	$links = str_replace(')', '</span></a>', $links);
	return $links;
}
add_filter('get_archives_link', 'royel_archive_widget_markup_edit');

function royel_category_widget_edit($output){
	//remove ul tags
	$output = str_replace( '<ul>', '', $output );
	$output = str_replace( '</ul>', '', $output );

	//move count inside a tags
	$output = str_replace( '</a> (', '<span class="badge">', $output );
	$output = str_replace( ')', '</span></a>', $output );

	return $output;
}
add_filter('wp_list_categories', 'royel_category_widget_edit',5);



function wpdocs_my_search_form( $form ) {

	$form = '<form role="search" method="get" id="searchform" class="form" action="' . home_url( '/' ) . '">
                <input type="text" class="form-control" placeholder="'. __('Search here..', 'royel-construction') .'" value="' . get_search_query() . '" name="s" id="s" />
            </form>';

	return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );


