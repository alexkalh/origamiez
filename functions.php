<?php
define('ORIGAMIEZ_PREFIX', 'origamiez_');
$dir = trailingslashit(get_template_directory());
/*
INIT
--------------------
Register Theme Features
--------------------
*/
function origamiez_theme_setup() {

    load_theme_textdomain('origamiez', get_template_directory() . '/languages');

    add_theme_support( 'custom-background', array(
        'default-color'      => '',
        'default-attachment' => 'fixed',
    ));

    add_theme_support( 'custom-header', apply_filters( 'origamiez_custom_header_args', array(
        'header-text' => false,
        'width'       => 468,
        'height'      => 60,
        'flex-height' => true,
        'flex-width'  => true
    )));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array('gallery', 'video', 'audio'));
    add_theme_support('editor_style');
    add_editor_style('editor-style.css');

    origamiez_register_new_image_sizes();

    global $content_width;
    if (!isset($content_width))
        $content_width = 817;

    register_nav_menus(array(
        'main-nav'   => esc_attr__('Main Menu', 'origamiez'),
        'top-nav'    => esc_attr__('Top Menu (do not support sub-menu)', 'origamiez'),
        'footer-nav' => esc_attr__('Footer Menu (do not support sub-menu)', 'origamiez'),
        'mobile-nav' => esc_attr__('Mobile Menu (will be replace by Main Menu - if null).', 'origamiez'),
    ));

    if (!is_admin()) {
        add_action('init', 'origamiez_widget_order_class' );
        add_action('wp_enqueue_scripts', 'origamiez_enqueue_scripts', 15);
        add_filter('body_class', 'origamiez_body_class');
        add_filter('post_class', 'origamiez_archive_post_class');
        add_filter('excerpt_more', '__return_false');
        add_filter('wp_nav_menu_objects', 'origamiez_add_first_and_last_class_for_menuitem');
        add_filter('post_thumbnail_html', 'origamiez_remove_hardcoded_image_size');
        add_filter('dynamic_sidebar_params', 'origamiez_dynamic_sidebar_params');
        add_action('origamiez_after_body_open', 'origamiez_global_wapper_open');
        add_action('origamiez_before_body_close', 'origamiez_global_wapper_close');
        add_action('origamiez_print_breadcrumb', 'origamiez_get_breadcrumb');
        add_action('origamiez_print_button_readmore', 'origamiez_get_button_readmore');

        if (!function_exists('_wp_render_title_tag')){
            add_action('wp_head', 'origamiez_render_title');
            add_filter('wp_title', 'origamiez_wp_title', 10, 2);
        }
    }

    add_action( "updated_option", 'origamiez_save_unyson_options', 10, 3);
}

add_action('after_setup_theme', 'origamiez_theme_setup');


/*
HOOK CALLBACK
--------------------
All callback functions for action hooks & filter hooks.
--------------------
*/
require( $dir . 'inc/functions.php' );

/*
CUSTOMIZATION
--------------------
Apply customization API to build control-panel.
--------------------
*/
require( $dir . 'inc/customizer.php' );

/*
API
--------------------
All classes (abstract & utility).
--------------------
*/
require( $dir . 'inc/classes/abstract-widget.php' );
require( $dir . 'inc/classes/abstract-widget-type-b.php' );
require( $dir . 'inc/classes/abstract-widget-type-c.php' );


/*
MODULE
--------------------
All sidebars & widgets.
--------------------
*/
require( $dir . 'inc/sidebar.php' );
require( $dir . 'inc/widget.php' );

/*
PLUGINS
--------------------
Setup - config for compatible plugins.
--------------------
*/

#1: bbPress
require( $dir . 'plugins/bbpress/index.php');
#2: DW Question & Answer
require( $dir . 'plugins/dw-question-and-answer/index.php');
#3: WooCommerce
require( $dir . 'plugins/woocommerce/index.php');
