<?php
$files = glob(get_template_directory() . '/inc/modules/widgets/*.php');
if ($files) {
    foreach ($files as $file) {
        require_once $file;
    }
}

add_action('widgets_init', 'ct_widgets_init');

function ct_widgets_init() {
    $widgets = array(                        
        'CT_Widget_Post_List_Small',                
        'CT_Widget_Post_Grid',                        
        'CT_Widget_Flickr',
        'CT_Widget_Social_Links',
        'CT_Widget_Newsletter'        
    );

    foreach ($widgets as $widget) {
        register_widget($widget);
    }
}

function ct_dynamic_sidebar_params($params) {
    global $wp_registered_widgets;
    $widget_id  = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];

    if (!isset($widget_opt[$widget_num]['title']) || (isset($widget_opt[$widget_num]['title']) && empty($widget_opt[$widget_num]['title']))) {
        $params[0]['before_widget'] .= '<div class="ct-widget-content clearfix">';
    }

    return $params;
}