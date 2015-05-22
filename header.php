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
                <div id="origamiez-header-top">
                    <div class="<?php echo esc_attr(origamiez_get_wrap_classes()); ?> clearfix">                        
                        <?php
                        $logo = get_theme_mod('logo', false);                        
                        ?>
                        <div id="origamiez-logo" class="pull-left">
                            <a id="site-home-link" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('title')); ?>">
                                <?php if ($logo):?>
                                <img id="site-logo" src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('title')); ?>">
                            <?php else: ?>
                                <?php if(is_front_page() || is_home()): ?>
                                    <h1 id="site-title"><?php echo esc_attr(get_bloginfo('name'));?></h1>
                                <?php else: ?>
                                    <p id="site-title"><?php echo esc_attr(get_bloginfo('name'));?></p>
                                <?php endif;?>
                                
                                <p id="site-desc"><?php echo esc_attr(get_bloginfo('description')); ?></p>
                            <?php endif; ?>
                            </a>
                        </div> <!-- end: logo -->                        
                    
                        <?php get_sidebar('top-banner'); ?>
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

            <div id="origamiez-body" class="<?php echo esc_attr(origamiez_get_wrap_classes()); ?> clearfix">
                <div id="origamiez-body-inner" class="clearfix">      
