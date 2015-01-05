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