<!-- Start header -->
<header class="site-header header-style2">
    <div class="container">
        <div class="row">
            <div class="col col-md-2 logo-wrapper">
                <div class="logo">
	                <?php royel_logo(); ?>
                </div>
            </div>

            <div class="col col-md-10">
                <div class="topbar">
                    <div class="contact-info">
                        <ul>
	                        <?php
	                        $header_contact_info = cs_get_option( 'contact_info_v2' );
	                        if ( is_array( $header_contact_info ) ) {
		                        foreach ( $header_contact_info as $info ):
			                        ?>
                                    <li><i class="<?php echo esc_attr( $info['contact_icon_v2'] ); ?>"></i> <?php echo wp_kses( $info['contact_details_v2'], true ); ?></li>
		                        <?php endforeach;
	                        }
	                        ?>
                        </ul>
                    </div>

                    <div class="important-links-social-links">
                        <div>
                            <ul class="links">
	                            <?php
	                            $header_top_nav = cs_get_option('top_nav_items_v2');
	                            if (is_array($header_top_nav)):
	                            foreach ($header_top_nav as $top_nav):
	                            $nav_info = $top_nav['top_nav_link_v2'];
	                            ?>
                                <li><a href="<?php echo esc_url($nav_info['url']); ?>"><?php echo esc_html($nav_info['text']); ?></a></li>
	                            <?php
	                            endforeach;
	                            endif;
	                            ?>
                            </ul>
                            <ul class="social-links">
	                            <?php
	                            $header_social_icon = cs_get_option('header_social_icon_v2');
	                            if (is_array($header_social_icon)):
		                            foreach ($header_social_icon as $social_info):
			                            ?>
                                        <li><a href="<?php echo esc_url($social_info['social_link_v2']['url']); ?>"><i class="<?php echo esc_attr($social_info['social_icon_v2']); ?>"></i></a></li>
		                            <?php
		                            endforeach;
	                            endif;
	                            ?>
                            </ul>
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
	                    <?php if (!empty(cs_get_option('mobile_nav_brand_text_v2'))): ?>
                            <a class="navbar-brand" href="<?php echo home_url('/'); ?>"><?php echo esc_html(cs_get_option('mobile_nav_brand_text_v2')); ?></a>
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

                    <div class="side-menu-search-area">
	                    <?php if (true == cs_get_option('search_icon_switcher_v2')): ?>
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

	                    <?php if (true == cs_get_option('sidebar_info_switcher_v2')): ?>
                        <div class="side-menu">
                            <button class="btn side-menu-open-btn"><i class="fa fa-bars"></i></button>
                            <div class="side-menu-inner">
                                <button class="btn side-menu-close-btn"><i class="fa fa-times"></i></button>
                                <div class="logo">
                                    <img src="<?php echo esc_url(cs_get_option('sidebar_logo_v2')['url']); ?>" alt>
                                    <span><?php echo esc_html(cs_get_option('sidebar_brand_title_v2')); ?></span>
                                </div>
                                <div class="text">

                                    <p><?php echo esc_html(cs_get_option('sidebar_text_v2')); ?></p>
                                    <ul class="info">
	                                    <?php
	                                    $header_contact_info = cs_get_option( 'contact_info_v2' );
	                                    if ( is_array( $header_contact_info ) ) {
		                                    foreach ( $header_contact_info as $info ):
			                                    ?>
                                                <li><i class="<?php echo esc_attr( $info['contact_icon_v2'] ); ?>"></i> <?php echo wp_kses( $info['contact_details_v2'], true ); ?></li>
		                                    <?php endforeach;
	                                    }
	                                    ?>
                                    </ul>
                                    <ul class="social-links"><?php
	                                    $header_social_icon = cs_get_option('header_social_icon_v2');
	                                    if (is_array($header_social_icon)):
		                                    foreach ($header_social_icon as $social_info):
			                                    ?>
                                                <li><a href="<?php echo esc_url($social_info['social_link_v2']['url']); ?>"><i class="<?php echo esc_attr($social_info['social_icon_v2']); ?>"></i></a></li>
		                                    <?php
		                                    endforeach;
	                                    endif;
	                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>  <!-- end side menu -->
                        <?php endif; ?>
                    </div> <!-- side-menu-search-area -->
                </nav> <!-- end nav -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</header>
<!-- end of header -->