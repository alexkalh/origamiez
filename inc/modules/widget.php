<?php
$files = glob(get_template_directory() . '/inc/modules/widgets/*.php');
if ($files) {
    foreach ($files as $file) {
        require_once $file;
    }
}

add_action('widgets_init', 'origamiez_widgets_init');

function origamiez_widgets_init() {
    $widgets = array(                        
        'Origamiez_Widget_Post_List_Small',                
        'Origamiez_Widget_Post_Grid',                              
        'Origamiez_Widget_Flickr',
        'Origamiez_Widget_Social_Links',
        'Origamiez_Widget_Newsletter',        
        'Origamiez_Widget_Post_Two_Cols',
    );

    foreach ($widgets as $widget) {
        register_widget($widget);
    }
}

function origamiez_dynamic_sidebar_params($params) {
    global $wp_registered_widgets;

    $widget_id  = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];    

    if (!isset($widget_opt[$widget_num]['title']) || (isset($widget_opt[$widget_num]['title']) && empty($widget_opt[$widget_num]['title']))) {
        $params[0]['before_widget'] .= '<div class="origamiez-widget-content clearfix">';
        $params[0]['before_title']  = '<h2 class="widget-title clearfix"><span class="widget-title-text pull-left">';
        $params[0]['after_title']   = '</span></h2>';    
    }

    return $params;
}