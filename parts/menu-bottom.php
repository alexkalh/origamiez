<?php
#FOOTER MENU
if (has_nav_menu('footer-nav')) {
    $is_enable_convert_flat_menus = (int)get_theme_mod('is_enable_convert_flat_menus', 1);
    $menu_class = $is_enable_convert_flat_menus ? 'hide-only-screen-and-max-width-639 clearfix' : 'clearfix';
    
    wp_nav_menu(
            array(
                'theme_location'  => 'footer-nav',
                'container'       => 'nav',
                'container_id'    => 'bottom-nav',
                'container_class' => 'pull-right',
                'menu_id'         => 'bottom-menu',
                'menu_class'      => $menu_class
            )
    );
}