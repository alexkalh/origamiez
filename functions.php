<?php
define('ORIGAMIEZ_PREFIX', 'origamiez_');
define('ORIGAMIEZ_THEME_VERSION', '1.1.8');
define('ORIGAMIEZ_MODE', 'product'); //product or dev

/**
 * Register Theme Features
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
        'height'      => 60 
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
        'main-nav'   => __('Main Menu', 'origamiez'),
        'top-nav'    => __('Top Menu (do not support sub-menu)', 'origamiez'),        
        'footer-nav' => __('Footer Menu (do not support sub-menu)', 'origamiez'),
    ));

    if (!is_admin()) {
        add_action('init', 'origamiez_widget_order_class' );
        add_action('wp_enqueue_scripts', 'origamiez_enqueue_scripts', 15);
        add_filter('body_class', 'origamiez_body_class');
        add_filter('post_class', 'origamiez_archive_post_class');
        add_filter('excerpt_more', '__return_false');        
        add_filter('wp_nav_menu_objects', 'origamiez_add_first_and_last_class_for_menuitem');        
        add_filter('origamiez_get_lightbox_markup', 'origamiez_set_lightbox_markup', 10, 2);        
        add_filter('dynamic_sidebar_params', 'origamiez_dynamic_sidebar_params');        
        add_filter('post_thumbnail_html', 'origamiez_remove_hardcode_image_size');
        if (!function_exists('_wp_render_title_tag')){
            add_action('wp_head', 'origamiez_render_title');
            add_filter('wp_title', 'origamiez_wp_title', 10, 2);
        }
    }    
}

add_action('after_setup_theme', 'origamiez_theme_setup');


/*
HOOK CALLBACK
--------------------
All callback functions for action hooks & filter hooks.
--------------------
*/
require( trailingslashit(get_template_directory()) . 'inc/functions.php' );

/*
CUSTOMIZATION
--------------------
Apply customization API to build control-panel.
--------------------
*/
require( trailingslashit(get_template_directory()) . 'inc/customizer.php' );

/*
API
--------------------
All classes (abstract & utility).
--------------------
*/
require( trailingslashit(get_template_directory()) . 'inc/classes/abstract-widget.php' );


/*
MODULE
--------------------
All sidebars & widgets.
--------------------
*/
require( trailingslashit(get_template_directory()) . 'inc/modules/sidebar.php' );
require( trailingslashit(get_template_directory()) . 'inc/modules/widget.php' );

/*
PLUGINS
--------------------
Setup - config for compatiable plugins.
--------------------
*/

#1: bbPress
require( trailingslashit(get_template_directory()) . 'plugins/bbpress/index.php');
#2: DW Question & Answer
require( trailingslashit(get_template_directory()) . 'plugins/dw-question-and-anwser/index.php');
#3: DW Question & Answer
require( trailingslashit(get_template_directory()) . 'plugins/download-manager/index.php');
