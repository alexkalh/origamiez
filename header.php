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
                    'container' => false,
                    'menu_id' => 'mobile-menu',
                    'menu_class' => 'clearfix'
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
                    <div class="<?php echo origamiez_get_wrap_classes(); ?> clearfix">                        
                        <?php
                        $logo = ot_get_option('logo', false);                        
                            ?>
                            <div id="origamiez-logo" class="pull-left">
                                <a id="site-home-link" href="<?php echo home_url(); ?>" title="<?php bloginfo('title'); ?>">
                                    <?php if ($logo):?>
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('title'); ?>">
                                <?php else: ?>
                                    <h1 id="site-title"><?php bloginfo('name');?></h1>
                                    <p id="site-desc"><?php bloginfo('description'); ?></p>
                                <?php endif; ?>
                                </a>
                            </div> <!-- end: logo -->                        
                        <?php
                        $top_banner_image = ot_get_option('top_banner_image', false);
                        $top_banner_html = ot_get_option('top_banner_html', false);

                        if ($top_banner_image || $top_banner_html):
                            $top_banner_target = ('on' == ot_get_option('top_banner_target', 'on')) ? '_blank' : '';
                            ?>
                            <div id="origamiez-top-banner" class="pull-right">
                                <a href="<?php echo ot_get_option('top_banner_url', false); ?>" 
                                   rel="nofollow" 
                                   title="<?php echo ot_get_option('top_banner_title', false); ?>"
                                   target="<?php echo esc_attr($top_banner_target); ?>">
                                    <img src="<?php echo esc_url($top_banner_image); ?>" alt="<?php echo ot_get_option('top_banner_title', false); ?>">
                                </a>
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
                                
                            <div id="main-nav-inner" class="<?php echo origamiez_get_wrap_classes(); ?>">                            
                                <?php                                
                                wp_nav_menu(
                                        array(
                                            'theme_location' => 'main-nav',
                                            'container' => false,
                                            'menu_id' => 'main-menu',
                                            'menu_class' => 'clearfix'
                                        )
                                );
                                ?>  
                            </div>
                        </nav><!-- end: main-nav-->                
                    </div> <!-- end: header-bottom -->
                <?php endif; ?>
            </header>

            <div id="origamiez-body" class="<?php echo origamiez_get_wrap_classes(); ?> clearfix">
                <div id="origamiez-body-inner" class="clearfix">      
