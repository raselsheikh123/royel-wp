<?php

/**
 *
 * Get royel Theme options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_option' ) ) {
    function cs_get_option( $option = '', $default = null ) {
        $options = get_option( 'royel_theme_options' ); // Attention: Set your unique id of the framework
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }
}

/**
 *
 * Get get switcher option
 *  for theme options
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( ! function_exists( 'cs_get_switcher_option' )) {

    function cs_get_switcher_option( $option = '', $default = null ) {
        $options = get_option( 'royel_theme_options' ); // Attention: Set your unique id of the framework
        $return_val =  ( isset( $options[$option] ) ) ? $options[$option] : $default;
        $return_val =  (is_null($return_val) || '1' == $return_val ) ? true : false;;
        return $return_val;
    }
}


if ( ! function_exists( 'cs_switcher_option' )) {

    function cs_switcher_option( $option = '', $default = null ) {
        $options = get_option( 'royel_theme_options' ); // Attention: Set your unique id of the framework
        $return_val =  ( isset( $options[$option] ) ) ? $options[$option] : $default;
        $return_val =  ( '1' == $return_val ) ? true : false;;
        return $return_val;
    }
}


/**
 * Function for get a metaboxes
 *
 * @param $prefix_key Required Meta unique slug
 * @param $meta_key Required Meta slug
 * @param $default Optional Set default value
 * @param $id Optional Set post id
 *
 * @return mixed
 */
function royel_get_meta( $prefix_key, $meta_key, $default = null, $id = '' ) {
    if ( !$id ) {
        $id = get_the_ID();
    }

    $meta_boxes = get_post_meta( $id, $prefix_key, true );
    return ( isset( $meta_boxes[$meta_key] ) ) ? $meta_boxes[$meta_key] : $default;
}

/**
 * Get Header layout
 *
 * @return string
 */
function royel_site_header() {
    $headers_layout = cs_get_option( 'header_glob_style', 'header-style-three' );
    if ( is_page() ) {
        $page_header = royel_get_meta( 'royel_page_meta', 'header_layout', 'default' );

        if ( 'default' !== $page_header ) {
            $headers_layout = $page_header;
        }
    }

    return $headers_layout;
}

/**
 * Get Header layout
 *
 * @return string
 */
function royel_site_footer() {
    $footer_layout = cs_get_option( 'footer_glob_style', 'footer-style-one' );
    if ( is_page() ) {
        $page_footer = royel_get_meta( 'royel_page_meta', 'footer_layout', 'default' );

        if ( 'default' !== $page_footer ) {
            $footer_layout = $page_footer;
        }
    }
    
    return $footer_layout;
}

/**
 * Site Logo Settings
 *
 * @return void
 */
function royel_logo(){ 
    $global_logo = cs_get_option('theme_logo');
    $page_main = royel_get_meta( 'royel_page_meta', 'page_logo', 'default' );
    ?>
    <?php if(!empty($page_main['url'])):?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url($page_main['url']);?>" alt="<?php echo esc_attr(get_bloginfo());?>">
        </a>
    <?php elseif(isset($global_logo['url']) && $global_logo['url']):?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
        <img src="<?php echo esc_url($global_logo['url']);?>" alt="<?php echo esc_attr(get_bloginfo());?>">
        </a>
    <?php else:?>
        <?php 
            if(has_custom_logo()){
                the_custom_logo();
            }else{ ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                <img src="<?php echo esc_url(ROYEL_IMG_PATH ); ?>logo-3.jpg" alt="<?php esc_attr_e('Logo', 'royel-construction'); ?>">
            </a>
        <?php    }
        ?>
    <?php endif;?>
<?php }


/**
 * Site Logo Style Two
 *
 * @return void
 */
function royel_logo_v2(){ 
    $theme_v2_logo = cs_get_option('theme_v2_logo');
    $page_footer = royel_get_meta( 'royel_page_meta', 'page_logo', 'default' );
    ?>
    <?php if(!empty($page_footer['url'])):?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url($page_footer['url']);?>" alt="<?php echo esc_attr(get_bloginfo());?>">
        </a>
    <?php elseif(isset($theme_v2_logo['url']) && $theme_v2_logo['url']):?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
        <img src="<?php echo esc_url($theme_v2_logo['url']);?>" alt="<?php echo esc_attr(get_bloginfo());?>">
        </a>
    <?php else:?>
        <?php 
            if(has_custom_logo()){
                the_custom_logo();
            }else{ ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo-2.svg" alt="<?php esc_attr_e('Logo', 'royel-construction'); ?>">
            </a>
        <?php    }
        ?>
    <?php endif;?>
<?php }