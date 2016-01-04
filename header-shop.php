<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">                  
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>             
        <?php do_action( 'origamiez_after_body_open' ); ?>

        <?php get_template_part( 'parts/menu', 'mobile' ); ?>                                    

        <div id="sb-site" >                 

            <header id="origamiez-header">     
                <?php get_template_part( 'parts/top-bar' ); ?>
                
                <?php
					$header_style = get_theme_mod( 'header_style', 'left-right' );
					get_template_part( 'parts/header/header', $header_style );
				?>
    
                <?php if ( has_nav_menu( 'main-nav' ) ) : ?>
                    <div id="origamiez-header-bottom" class="clearfix">                                                            
                        <nav id="main-nav">
                            <div id="origamiez-mobile-wrap" class="clearfix">                            
                                <span id="origamiez-mobile-menu-icon" class="origamiez-mobile-icon sb-toggle-left"><span class="fa fa-bars"></span><span><?php esc_html_e( 'Menu', 'origamiez' ); ?></span></span>                            
                            </div>
                                
                            <div id="main-nav-inner" class="<?php echo esc_attr( origamiez_get_wrap_classes() ); ?>">
                                <?php
								wp_nav_menu(
									array(
											'theme_location' => 'main-nav',
											'container'      => false,
											'menu_id'        => 'main-menu',
											'menu_class'     => 'clearfix',
										)
								);
								?>  
                            </div>
                        </nav><!-- end: main-nav-->                
                    </div> <!-- end: header-bottom -->
                <?php endif; ?>
            </header>

            <div id="origamiez-body" 
                class="<?php echo esc_attr( origamiez_get_wrap_classes() ); ?> clearfix">
                
                <div id="origamiez-body-inner" class="clearfix">      

                <div id="sidebar-center" class="pull-left">

                    <?php get_template_part( 'parts/breadcrumb', 'woocommerce' ); ?>

                    <div class="clearfix"></div>

                    <div id="sidebar-center-bottom" class="row clearfix">                        
