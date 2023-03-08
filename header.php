<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Royel_Construction
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (true == cs_get_option('preloader_enable')): ?>
<?php
    if (!empty(cs_get_option('preloader_image')['url'])){
	    $preloader_img = cs_get_option('preloader_image')['url'];
    }else{
	    $preloader_img = ROYEL_THEME_URI.'/assets/img/preloader.GIF';
    }
?>
<!-- start preloader -->
<div class="preloader">
    <div>
        <img src="<?php echo esc_url($preloader_img); ?>" alt=''>
    </div>
</div>
<?php endif; ?>
<!-- end preloader -->
<?php royel_header_option();?>
