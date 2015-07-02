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
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">                  
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>             
        <?php do_action('origamiez_after_body_open'); ?>

        <?php
        #MAIN MENU
        if (has_nav_menu('main-nav')) {
            ?>
            <div class="sb-slidebar sb-left sb-width-custom" data-sb-width="260px">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'main-nav',
                    'container'      => false,
                    'menu_id'        => 'mobile-menu',
                    'menu_class'     => 'clearfix'
                )
            );
            ?>
            </div>
            <?php
        }
        ?>                                        

        <div id="sb-site" >                 

            <header id="origamiez-header">     
                <?php get_template_part('blocks/top-bar'); ?>
                                      
                <div id="origamiez-header-top">                    

                    <div class="<?php echo esc_attr(origamiez_get_wrap_classes()); ?> clearfix">                        
                        <?php
                        $logo = get_theme_mod('logo', false);                        
                        ?>
                        <div id="origamiez-logo" class="pull-left">
                            <a id="site-home-link" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('title')); ?>">
                                <?php if ($logo):?>
                                <img id="site-logo" class="img-responsive" src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('title')); ?>">
                            <?php else: ?>
                                <?php if(is_front_page() || is_home()): ?>
                                    <h1 id="site-title"><?php echo esc_attr(get_bloginfo('name'));?></h1>
                                <?php else: ?>
                                    <p id="site-title"><?php echo esc_attr(get_bloginfo('name'));?></p>
                                <?php endif;?>
                                
                                <p id="site-desc">
                                    <?php echo esc_textarea(get_bloginfo('description')); ?>
                                </p>
                            <?php endif; ?>
                            </a>
                        </div> <!-- end: logo -->                        
                    
                        <?php
                        $top_banner_image = get_header_image();
                        $top_banner_custom = get_theme_mod('top_banner_custom', false);

                        if ($top_banner_image || $top_banner_custom):                            
                            ?>
                            <div id="origamiez-top-banner" class="pull-right">   
                            <?php
                            if($top_banner_custom):
                                echo htmlspecialchars_decode(esc_html($top_banner_custom));
                            else:
                                ?>
                                <a href="<?php echo esc_url(get_theme_mod('top_banner_url', false)); ?>"                                    
                                   title="<?php echo esc_attr(get_theme_mod('top_banner_title', false)); ?>"
                                   target="_blank" rel="nofollow">
                                    <img width="<?php echo esc_attr(get_custom_header()->width);?>"
                                        height="<?php echo esc_attr(get_custom_header()->height);?>"
                                        src="<?php echo esc_url($top_banner_image); ?>" 
                                        alt="<?php echo esc_attr(get_theme_mod('top_banner_title', false)); ?>">
                                </a>                                
                                <?php endif; ?>
                            </div> <!-- end: top-banner -->
                        <?php endif; ?>

                    </div>
                </div> <!-- end: header-top -->

                <?php if (has_nav_menu('main-nav')): ?>
                    <div id="origamiez-header-bottom" class="clearfix">                                                            
                        <nav id="main-nav">
                            <div id="origamiez-mobile-wrap" class="clearfix">                            
                                <span id="origamiez-mobile-menu-icon" class="origamiez-mobile-icon sb-toggle-left"><span class="fa fa-bars"></span><span><?php _e('Menu', 'origamiez'); ?></span></span>                            
                            </div>
                                
                            <div id="main-nav-inner" class="<?php echo esc_attr(origamiez_get_wrap_classes()); ?>">
                                <?php                                
                                wp_nav_menu(
                                        array(
                                            'theme_location' => 'main-nav',
                                            'container'      => false,
                                            'menu_id'        => 'main-menu',
                                            'menu_class'     => 'clearfix'
                                        )
                                );
                                ?>  
                            </div>
                        </nav><!-- end: main-nav-->                
                    </div> <!-- end: header-bottom -->
                <?php endif; ?>
            </header>

            <div id="origamiez-body" 
                class="<?php echo esc_attr(origamiez_get_wrap_classes()); ?> clearfix">
                
                <div id="origamiez-body-inner" class="clearfix">      

                <div id="sidebar-center" class="pull-left">

                    <?php get_template_part('blocks/breadcrumb', 'woocommerce'); ?>

                    <div class="clearfix"></div>

                    <div id="sidebar-center-bottom" class="row clearfix">                        
