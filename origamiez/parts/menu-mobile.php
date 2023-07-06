<?php
$menu_slug = has_nav_menu('mobile-nav') ? 'mobile-nav' :  (has_nav_menu('main-nav') ? 'main-nav' : false);

if ($menu_slug):
    ?>
    <div class="sb-slidebar sb-left sb-width-custom" off-canvas="left reveal">
    <?php
    wp_nav_menu(
        array(
            'theme_location' => $menu_slug,
            'container'      => false,
            'menu_id'        => 'mobile-menu',
            'menu_class'     => 'clearfix'
        )
    );
    ?>
    </div>
    <?php
endif;