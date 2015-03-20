<?php

if(!is_admin() && !class_exists('OT_Loader')){
    die(sprintf('Hi friend!<br>To use our theme, please download and install plugin <a href="%s" target="_blank">Option Tree</a>', 'https://wordpress.org/plugins/option-tree'));
}

define('CT_PREFIX', 'ct_');
define('OT_THEME_VERSION', '1.0.0');
define('CT_MODE','dev');

/**
 * Register Theme Features
 */
function option_tree_theme_setup() {

    load_theme_textdomain(ct_get_domain(), get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('editor_style');

    add_editor_style('editor-style.css');

    global $content_width;
    if (!isset($content_width))
        $content_width = 817;

    register_nav_menus(array(
        'main-nav'   => __('Main Menu', ct_get_domain()),
        'footer-nav' => __('Footer Menu', ct_get_domain()),
    ));

    add_action('init', 'ct_init');

    if (!is_admin()) {
        add_action('init', 'ct_widget_order_class' );
        add_action('wp_head', 'ct_wp_head');
        add_action('wp_footer', 'ct_wp_footer');
        add_action('wp_enqueue_scripts', 'ct_enqueue_scripts');
        add_filter('widget_text', 'do_shortcode');        
        add_filter('body_class', 'ct_body_class');
        add_filter('post_class', 'ct_archive_post_class');
        add_filter('excerpt_more', '__return_false');
        add_filter('shortcode_atts_gallery', 'ct_shortcode_atts_gallery', 10, 3);
        add_filter('wp_nav_menu_objects', 'ct_add_first_and_last_class_for_menuitem');        
        add_filter('ct_get_lightbox_markup', 'ct_set_lightbox_markup', 10, 2);        
        add_filter('dynamic_sidebar_params', 'ct_dynamic_sidebar_params');        

        if (!function_exists('_wp_render_title_tag')){
            add_action('wp_head', 'ct_render_title');
            add_filter('wp_title', 'ct_wp_title', 10, 2);
        }


    } else {        
        add_action('admin_enqueue_scripts', 'ct_widget_enqueue', 10);
        add_filter('user_contactmethods', 'ct_user_contactmethods');        
    }

    add_filter('ct_get_sidebars_list', 'ct_add_custom_sidebars_to_list');

    add_theme_support('post-formats', array(
        'gallery', 'video', 'audio'
    ));
}

function ct_init(){    
    add_filter('post_thumbnail_html', 'ct_post_thumbnail_html', 10, 5);
}

add_action('after_setup_theme', 'option_tree_theme_setup', 2);

function ct_get_domain() {
    return 'colours_theme';
}

/**
 * Filters the Theme Options ID
 */
function filter_origamier_options_id() {
    return CT_PREFIX . 'option_tree';
}

add_filter('ot_options_id', 'filter_origamier_options_id');

/**
 * Filters the Settings ID
 */
function filter_origamier_settings_id() {
    return CT_PREFIX . 'option_tree_settings';
}

add_filter('ot_settings_id', 'filter_origamier_settings_id');

/**
 * Filters the Layouts ID
 */
function filter_origamier_layouts_id() {
    return CT_PREFIX . 'option_tree_layouts';
}

add_filter('ot_layouts_id', 'filter_origamier_layouts_id');

/**
 * Filters the Theme Option header list.
 */
function filter_origamier_header_list() {
    echo '<li id="theme-version"><span>Origamier ' . OT_THEME_VERSION . '</span></li>';
}

add_action('ot_header_list', 'filter_origamier_header_list');

/**
 * Theme Mode
 */
add_filter('ot_theme_mode', '__return_false');

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
 * Meta Boxes
 */
require( trailingslashit(get_template_directory()) . 'inc/meta-boxes.php' );    

/**
 * Origamier Functions
 */
require( trailingslashit(get_template_directory()) . 'inc/functions.php' );
require( trailingslashit(get_template_directory()) . 'inc/ajax.php' );

/**
 * Modify or add advance fields for option tree
 */
require( trailingslashit(get_template_directory()) . 'option-tree-plugin/fields/advance.php' );
require( trailingslashit(get_template_directory()) . 'option-tree-plugin/fields/modify.php' );

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