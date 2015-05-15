<?php
require(trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php');

define('ORIGAMIEZ_PREFIX', 'origamiez_');
define('ORIGAMIEZ_THEME_VERSION', '1.0.7');
define('ORIGAMIEZ_MODE', 'product'); //product or dev

/**
 * Register Theme Features
 */
function origamiez_theme_setup() {

    load_theme_textdomain('origamiez', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array('gallery', 'video', 'audio'));
    add_theme_support('editor_style');    
    add_editor_style('editor-style.css');

    global $content_width;
    if (!isset($content_width))
        $content_width = 817;

    register_nav_menus(array(
        'main-nav'   => __('Main Menu', 'origamiez'),
        'footer-nav' => __('Footer Menu', 'origamiez'),
    ));

    add_action('init', 'origamiez_init');

    if (!is_admin()) {
        add_action('init', 'origamiez_widget_order_class' );
        add_action('wp_head', 'origamiez_wp_head');        
        add_action('wp_enqueue_scripts', 'origamiez_enqueue_scripts');        
        add_filter('body_class', 'origamiez_body_class');
        add_filter('post_class', 'origamiez_archive_post_class');
        add_filter('excerpt_more', '__return_false');        
        add_filter('wp_nav_menu_objects', 'origamiez_add_first_and_last_class_for_menuitem');        
        add_filter('origamiez_get_lightbox_markup', 'origamiez_set_lightbox_markup', 10, 2);        
        add_filter('dynamic_sidebar_params', 'origamiez_dynamic_sidebar_params');        

        if (!function_exists('_wp_render_title_tag')){
            add_action('wp_head', 'origamiez_render_title');
            add_filter('wp_title', 'origamiez_wp_title', 10, 2);
        }

    } else {        
        add_action('admin_enqueue_scripts', 'origamiez_widget_enqueue', 10);        
    }

    add_filter('origamiez_get_sidebars_list', 'origamiez_add_custom_sidebars_to_list');    
}

function origamiez_init(){    
    add_filter('post_thumbnail_html', 'origamiez_post_thumbnail_html', 10, 5);
}

add_action('after_setup_theme', 'origamiez_theme_setup', 2);

/**
 * Filters the Theme Options ID
 */
function origamiez_options_id() {
    return 'origamiez';
}

add_filter('ot_options_id', 'origamiez_options_id');

/**
 * Filters the Settings ID
 */
function origamiez_settings_id() {
    return 'origamiez_settings';
}

add_filter('ot_settings_id', 'origamiez_settings_id');

/**
 * Filters the Layouts ID
 */
function origamiez_layouts_id() {
    return 'origamiez_layouts';
}

add_filter('ot_layouts_id', 'origamiez_layouts_id');

/**
 * Filters the Theme Option header list.
 */
function origamiez_header_list() {
    echo '<li id="theme-version"><span>Origamier ' . ORIGAMIEZ_THEME_VERSION . '</span></li>';
}

add_action('ot_header_list', 'origamiez_header_list');

/**
 * Theme Mode
 */
add_filter('ot_theme_mode', '__return_true');

/**
 * Child Theme Mode
 */
add_filter('ot_child_theme_mode', '__return_false');

/**
 * Show Settings Pages
 */
add_filter('ot_show_pages', '__return_false');

/**
 * Show Theme Options UI Builder
 */
add_filter('ot_show_options_ui', '__return_false');

/**
 * Show Settings Import
 */
add_filter('ot_show_settings_import', '__return_true');

/**
 * Show Settings Export
 */
add_filter('ot_show_settings_export', '__return_true');

/**
 * Show New Layout
 */
add_filter('ot_show_new_layout', '__return_false');

/**
 * Show Documentation
 */
add_filter('ot_show_docs', '__return_false');

/**
 * Custom Theme Option page
 */
add_filter('ot_use_theme_options', '__return_true');

/**
 * Meta Boxes
 */
add_filter('ot_meta_boxes', '__return_true');

/**
 * Allow Unfiltered HTML in textareas options
 */
add_filter('ot_allow_unfiltered_html', '__return_false');

/**
 * Loads the meta boxes for post formats
 */
add_filter('ot_post_formats', '__return_false');

/**
* Addon
*/
require( trailingslashit(get_template_directory()) . 'inc/addon/BFIThumb.class.php' );
require( trailingslashit(get_template_directory()) . 'inc/image.php' );


/**
 * Theme Options
 */
require( trailingslashit(get_template_directory()) . 'inc/theme-options.php' );

/**
 * Origamier Functions
 */
require( trailingslashit(get_template_directory()) . 'inc/functions.php' );

/**
 * Modify or add advance fields for option tree
 */
require( trailingslashit(get_template_directory()) . 'option-tree-extra/fields/advance.php' );
require( trailingslashit(get_template_directory()) . 'option-tree-extra/fields/modify.php' );

/**
 * Classes
 */
require( trailingslashit(get_template_directory()) . 'inc/classes/abstract-widget.php' );

/**
 * Modules
 */
require( trailingslashit(get_template_directory()) . 'inc/modules/sidebar.php' );
require( trailingslashit(get_template_directory()) . 'inc/modules/widget.php' );

/**
 * bbPress
 */
require( trailingslashit(get_template_directory()) . 'bbpress/index.php' );