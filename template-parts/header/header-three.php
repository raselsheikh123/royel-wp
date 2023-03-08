<!-- Start header -->
<header class="site-header header-style1 header-style3">
    <div class="container">
        <div class="row topbar">
            <div class="col col-md-3">
                <div class="logo"
	                <?php royel_logo(); ?>
                </div>
            </div>
            <div class="col col-md-9 contact-info-wrapper">
                <div class="contact-info">
	                <?php
	                $header_contact_info = cs_get_option( 'contact_info_v3' );
	                if ( is_array( $header_contact_info ) ) {
		                foreach ( $header_contact_info as $info ):
			                ?>
                            <div>
                                <span class="icon"><i class="<?php echo esc_attr( $info['contact_icon_v3'] ); ?>"></i></span>
                                <h6><?php echo wp_kses( $info['contact_text_v3'], true ); ?></h6>
                                <span><?php echo wp_kses( $info['contact_details_v3'], true ); ?></span>
                            </div>
		                <?php endforeach;
	                }
	                ?>
                </div>
            </div>
        </div>

        <nav class="navigation navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="open-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php if (!empty(cs_get_option('mobile_nav_brand_text_v3'))): ?>
                    <a class="navbar-brand" href="<?php echo home_url('/'); ?>"><?php echo esc_html(cs_get_option('mobile_nav_brand_text_v3')); ?></a>
                <?php endif; ?>
            </div>

            <div id="navbar" class="navbar-collapse collapse navigation-menu-holder">
                <button class="close-navbar"><i class="fa fa-close"></i></button>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_class' => 'nav navbar-nav',
                            'container' => ''
                        )
                    );
                ?>

            </div> <!-- end navbar collaps -->

            <div class="social-links-search">
                <ul class="social-links">
                    <?php
                        $header_social_icon = cs_get_option('header_social_icon_v3');
                        if (is_array($header_social_icon)):
                            foreach ($header_social_icon as $social_info):
                    ?>
                    <li><a href="<?php echo esc_url($social_info['social_link_v3']['url']); ?>"><i class="<?php echo esc_attr($social_info['social_icon_v3']); ?>"></i></a></li>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </ul>
                <?php if (true == cs_get_option('search_icon_switcher_v3')): ?>
                <div class="search header-search-area">
                    <a href="#" class="open-btn">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="header-search-form">
                        <form class="form" action="<?php echo home_url( '/' ) ?>">
                            <div>
                                <input type="text" class="form-control" placeholder="<?php _e('Search here', 'royel-construction'); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s">
                            </div>
                            <button type="submit" class="btn"><i class="fi fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </nav> <!-- end nav -->
    </div> <!-- end container -->
</header>
<!-- end of header -->