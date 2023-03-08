<!-- start site-footer-->
<?php
$footer_bg_image = cs_get_option('footer_background_image');
if (!empty($footer_bg_image['url'])){
    $footer_bg_image_link = $footer_bg_image['url'];
}else{
	$footer_bg_image_link = '';
}
?>

<footer class="site-footer" style="background: url('<?php echo esc_url($footer_bg_image_link); ?>') no-repeat center center / cover">
	<div class="container">
		<div class="row upper-footer">

            <?php if (is_active_sidebar('footer-widget')){
	            dynamic_sidebar('footer-widget');
            } ?>

		</div> <!-- end upperfooter -->

		<div class="row copyright-area">
			<div class="col col-md-6 copyright-text">
				<p><?php echo wp_kses(cs_get_option('royel_copywrite_text'), true); ?></p>
			</div>

			<div class="col col-md-6 copyright-nav">
				<?php wp_nav_menu(array(
					'menu_id' => cs_get_option('copyright_nav_menu'),
				));
				?>
			</div>
		</div>
	</div> <!-- end container -->
</footer>
<!-- end site-footer-->