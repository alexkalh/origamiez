<?php

add_action('admin_init', 'origamiez_modify_social_links');

function origamiez_modify_social_links() {
    // Socials
    add_filter('ot_type_social_links_load_defaults', '__return_true');
    add_filter('ot_type_social_links_defaults', 'origamiez_type_social_links_defaults', 10, 2);
    add_filter('ot_social_links_settings', 'origamiez_social_links_settings');

    // Layouts
    add_filter('ot_radio_images', 'origamiez_get_layouts', 10, 2);

    // Typography
    add_filter('ot_recognized_typography_fields', 'origamiez_recognized_typography_fields', 10, 2);
    add_filter('ot_recognized_font_families', 'origamiez_recognized_font_families', 10, 2);
}

function origamiez_type_social_links_defaults($values, $field_id) {
    if ('social_links' == $field_id) {
        $values = array(array(
                'name' => __('Facebook', 'origamiez'),
                'title' => __('Facebook', 'origamiez'),                
                'href' => '',
                'icon' => 'fa fa-facebook',
                'color' => '#3B5998'
            ),
            array(
                'name' => __('Twitter', 'origamiez'),
                'title' => __('Twitter', 'origamiez'),
                'href' => '',
                'icon' => 'fa fa-twitter',
                'color' => '#00A0D1'
            ),
            array(
                'name' => __('Google Plus', 'origamiez'),
                'title' => __('Google Plus', 'origamiez'),
                'href' => '',
                'icon' => 'fa fa-google-plus',
                'color' => '#C63D2D'
            ),
            array(
                'name' => __('Pinterest', 'origamiez'),
                'title' => __('Pinterest', 'origamiez'),
                'href' => '',
                'icon' => 'fa fa-pinterest',
                'color' => '#910101'
            ),
            array(
                'name' => __('Rss', 'origamiez'),
                'title' => __('Rss', 'origamiez'),
                'href' => get_bloginfo('rss2_url'),
                'icon' => 'fa fa-rss',
                'color' => '#FA9B39'
            )
        );
    }
    return $values;
}

function origamiez_social_links_settings($fields) {

    $fields[] = array(
        'id' => 'icon',
        'label' => 'Social network',
        'desc' => '',
        'type' => 'icon'
    );
    $fields[] = array(
        'id' => 'color',
        'label' => 'Color',
        'desc' => '',
        'type' => 'colorpicker'
    );

    return $fields;
}

function origamiez_get_layouts($layouts, $field_id) {
    if ('layout_taxonomy' == $field_id) {
        $layouts = array(
            array(
                'value' => 'thumbnail-left',
                'label' => __('Thumbnail Left', 'origamiez'),
                'src' => get_template_directory_uri() . '/images/layout/blog-thumbnail-left.png'
            ),
            array(
                'value' => 'thumbnail-right',
                'label' => __('Thumbnail Right', 'origamiez'),
                'src' => get_template_directory_uri() . '/images/layout/blog-thumbnail-right.png'
            ),
        );
    } else if ('skin' == $field_id) {
        $layouts = array(
            array(
                'value' => 'default',
                'label' => __('Default', 'origamiez'),
                'src' => get_template_directory_uri() . '/images/skin/default.png'
            ),      
            array(
                'value' => 'custom',
                'label' => __('Custom', 'origamiez'),
                'src' => get_template_directory_uri() . '/images/skin/custom.png'
            ),
        );
    }

    return $layouts;
}

function origamiez_recognized_typography_fields($options, $field_id) {
    if (in_array($field_id, array('font_heading_1', 'font_heading_2', 'font_heading_3', 'font_heading_4', 'font_heading_5','font_heading_6', 'font_menu', 'font_body', 'font_widget_title'))) {
        $options = array(
            'font-family',
            'font-size',
            'font-style',
            'font-weight',
            'line-height'            
        );
    }

    return $options;
}

function origamiez_recognized_font_families($fonts, $field_id) {
    if (in_array($field_id, array('font_heading_1', 'font_heading_2', 'font_heading_3', 'font_heading_4', 'font_heading_5','font_heading_6', 'font_menu', 'font_body', 'font_widget_title'))) {
        $fonts = array(
            'arial' => 'Arial',
            'georgia' => 'Georgia',
            'helvetica' => 'Helvetica',
            'palatino' => 'Palatino',
            'tahoma' => 'Tahoma',
            'times' => '"Times New Roman", sans-serif',
            'trebuchet' => 'Trebuchet',
            'verdana' => 'Verdana',            
        );
        
        $google_fonts = ot_get_option('google_font', false);
        if(!empty($google_fonts) && is_array($google_fonts)){
            foreach ($google_fonts as $google_font){
                $fonts[$google_font['slug']] = $google_font['title'];
            }
        }
    }
       
    return $fonts;
}
