<?php

add_action('customize_register', 'origamiez_customize_register');

function origamiez_customize_register($wp_customize){
    $wp_customize->get_setting('blogname')->transport          ='refresh';
    $wp_customize->get_setting('blogdescription')->transport   ='refresh';
    
    $options = origamiez_get_custom_options();

    //Add Panels
    if(isset($options['panels']) && !empty($options['panels'])){
        $panels = $options['panels'];

        foreach($panels as $panel){
            $wp_customize->add_panel($panel['id'], $panel);
        }
    }

    //Add Sections
    if(isset($options['sections']) && !empty($options['sections'])){
        $sections = $options['sections'];

        foreach($sections as $section){
            $wp_customize->add_section($section['id'], $section);
        }
    }

    // Add Settings & Control
    if(isset($options['settings']) && !empty($options['settings'])){
        $settings = $options['settings'];         

        foreach($settings as $setting){

            #Select  a sanitize callback for each setting
            switch ($setting['type']) {
                case 'upload':
                    $sanitize_callback = 'esc_url_raw';
                    break;
                case 'color':
                    $sanitize_callback = 'sanitize_hex_color';
                    break;
                case 'textarea':
                    $sanitize_callback = 'origamiez_sanitize_textarea';
                    break;
                case 'text':                
                case 'checkbox':
                case 'radio':
                case 'select':
                    $sanitize_callback = 'sanitize_text_field';
                    break;
                default:
                    $sanitize_callback = 'sanitize_text_field';
                    break;
            }

            # add setting
            $wp_customize->add_setting($setting['id'], array(
                "default"           => $setting['default'],
                'sanitize_callback' => $sanitize_callback,
                'capability'        => 'edit_theme_options',
                "transport"         => isset($setting['transport']) ? $setting['transport'] : "postMessage",
            ));

            # add control for this setting
            switch ($setting['type']) { 
                case 'upload':
                    unset($setting['type']);
                    $wp_customize->add_control(
                        new WP_Customize_Image_Control(
                        $wp_customize,
                        $setting['id'],
                        $setting));                     
                    break;
                case 'color':
                    unset($setting['type']);
                    $wp_customize->add_control(
                        new WP_Customize_Color_Control(
                        $wp_customize,
                        $setting['id'],
                        $setting));
                    break;                       
                case 'text':
                case 'textarea':
                case 'checkbox':
                case 'radio':
                case 'select':
                    $wp_customize->add_control(
                        new WP_Customize_Control(
                        $wp_customize,
                        $setting['id'],
                        $setting));  
                    break;
            }
        }

    }
}

function origamiez_sanitize_textarea($value){
    if($value){
        $value = htmlspecialchars_decode(esc_html($value));
    }
    return $value;
}

function origamiez_skin_custom_callback($control){
    if ( $control->manager->get_setting('skin')->value() == 'custom' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_body_enable_callback($control){
    if ( $control->manager->get_setting('font_body_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_menu_enable_callback($control){
    if ( $control->manager->get_setting('font_menu_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_widget_title_enable_callback($control){
    if ( $control->manager->get_setting('font_widget_title_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_h1_enable_callback($control){
    if ( $control->manager->get_setting('font_h1_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_h2_enable_callback($control){
    if ( $control->manager->get_setting('font_h2_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_h3_enable_callback($control){
    if ( $control->manager->get_setting('font_h3_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_h4_enable_callback($control){
    if ( $control->manager->get_setting('font_h4_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_h5_enable_callback($control){
    if ( $control->manager->get_setting('font_h5_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_font_h6_enable_callback($control){
    if ( $control->manager->get_setting('font_h6_is_enable')->value() == '1' ) {
        return true;
    } else {
        return false;
    }
}

function origamiez_get_custom_options(){
    $custom_settings = array(
        'panels' => array(
            array(
                'id'    => 'origamiez_general',
                'title' => __('General Setting', 'origamiez')
            ),       
            array(
                'id'    => 'origamiez_typography',
                'title' => __('Typography', 'origamiez'),
            ),
            array(
                'id'    => 'origamiez_social_links',
                'title' => __('Social links', 'origamiez'),
            ),           
        ),
        'sections' => array(
            array(
                'id'    => 'header_and_footer',
                'panel' => 'origamiez_general',
                'title' => __('Header & Footer', 'origamiez')
            ),                     
            array(
                'id'    => 'layout',
                'panel' => 'origamiez_general',
                'title' => __('Layout', 'origamiez'),
            ),
            array(
                'id'    => 'blog_posts',
                'panel' => 'origamiez_general',
                'title' => __('Blog posts', 'origamiez'),
            ),
            array(
                'id'    => 'single_post',
                'panel' => 'origamiez_general',
                'title' => __('Single post', 'origamiez'),
            ),
        ),
        'settings' => array(
            /*
             * ----------------------------------------
             * General setting
             * ---------------------------------------- 
             */
            array(
                'id'          => 'logo',
                'label'       => __('Logo', 'origamiez'),
                'description' => __('Upload or enter your logo', 'origamiez'),
                'default'     => '',
                'type'        => 'upload',
                'section'     => 'header_and_footer',
                'transport'   => 'refresh'
            ),
            /*
             * ----------------------------------------
             * Footer
             * ---------------------------------------- 
             */
            array(
                'id'          => 'footer_information',
                'label'       => __('Footer information', 'origamiez'),
                'description' => __('Enter your information, e.g. copyright, or Google AdSense code, ...', 'origamiez'),
                'default'     => __('Copyright &copy; Your Name', 'origamiez'),
                'type'        => 'textarea',
                'section'     => 'header_and_footer',
                'transport'   => 'refresh'
            ),            
            /*
             * ----------------------------------------
             * Layouts
             * ---------------------------------------- 
             */
            array(
                'id'          => 'use_layout_fullwidth',
                'label'       => __('Layout full width', 'origamiez'),
                'description' => '',
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'layout',
                'transport'   => 'refresh',
            ),
            /*
             * ----------------------------------------
             * Blog posts
             * ---------------------------------------- 
             */
            array(
                'id'          => 'layout_taxonomy',
                'label'       => __('Thumbnail position', 'origamiez'),
                'description' => '',
                'default'     => 'thumbnail-left',
                'type'        => 'radio',
                'choices'     => array(                    
                    'thumbnail-left'       => __('Thumbnail left', 'origamiez'),
                    'thumbnail-right'      => __('Thumbnail right', 'origamiez'),
                    'thumbnail-full-width' => __('Thumbnail full width', 'origamiez'),
                ),
                'section'     => 'blog_posts',
                'transport'   => 'refresh',
            ),          
            array(
                'id'          => 'is_show_taxonomy_datetime',
                'label'       => __('Show datetime', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'blog_posts',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_taxonomy_comments',
                'label'       => __('Show number of comments', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'blog_posts',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_taxonomy_category',
                'label'       => __('Show categories', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'blog_posts',
                'transport'   => 'refresh',
            ),      
            array(
                'id'          => 'is_show_taxonomy_author',
                'label'       => __('Show author', 'origamiez'),
                'description' => '',
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'blog_posts',
                'transport'   => 'refresh',
            ), 
            array(
                'id'          => 'is_enable_lightbox',
                'label'       => __('Enable lightbox', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'blog_posts',
                'transport'   => 'refresh',
            ), 
            /*
             * ----------------------------------------
             * Single Post
             * ---------------------------------------- 
             */
            array(
                'id'          => 'is_show_post_datetime',
                'label'       => __('Show datetime', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_post_comments',
                'label'       => __('Show number of comments', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),            
            array(
                'id'          => 'is_show_post_category',
                'label'       => __('Show category', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_post_tag',
                'label'       => __('Show tag', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_post_adjacent',
                'label'       => __('Show next & prev posts', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_post_author_info',
                'label'       => __('Show author information', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),
            array(
                'id'          => 'is_show_post_related',
                'label'       => __('Show related posts', 'origamiez'),
                'description' => '',
                'default'     => 1,
                'type'        => 'checkbox',
                'section'     => 'single_post',
                'transport'   => 'refresh',
            ),
            /*
             * ----------------------------------------
             * Custom Color
             * ---------------------------------------- 
             */
            array(
                'id'          => 'skin',
                'label'       => __('Color Scheme', 'origamiez'),
                'description' => '',
                'default'     => 'default',
                'type'        => 'radio',
                'section'     => 'colors',
                'transport'   => 'refresh',
                'choices'     => array(
                    'default' => __('Default', 'origamiez'),
                    'custom'  => __('Custom', 'origamiez'),
                )
            ),
            array(
                'id'              => 'primary_color',
                'type'            => 'color',
                'label'           => __('Primary color', 'origamiez'),
                'description'     => '',
                'default'         => '#E74C3C',
                'section'         => 'colors',
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'secondary_color',
                'type'            => 'color',
                'label'           => __('Secondary color', 'origamiez'),
                'description'     => '',
                'default'         => '#F9F9F9',
                'section'         => 'colors',
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'body_color',
                'type'            => 'color',
                'label'           => __('Body text color', 'origamiez'),
                'description'     => '',
                'default'         => '#555555',
                'section'         => 'colors',
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'heading_color',
                'type'            => 'color',
                'label'           => __('Heading color', 'origamiez'),
                'description'     => '',
                'default'         => '#444444',
                'section'         => 'colors',
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'link_color',
                'type'            => 'color',
                'label'           => __('Link color', 'origamiez'),
                'description'     => '',
                'default'         => '#444444',
                'section'         => 'colors',
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'main_menu_color',
                'type'            => 'color',
                'label'           => __('Main menu text color', 'origamiez'),
                'description'     => '',
                'default'         => '#666666',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'line_1_color',
                'type'            => 'color',
                'label'           => __('Line 1 color', 'origamiez'),
                'description'     => '',
                'default'         => '#555555',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'line_2_color',
                'type'            => 'color',
                'label'           => __('Line 2 color', 'origamiez'),
                'description'     => '',
                'default'         => '#D8D8D8',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',                
            ),
            array(
                'id'              => 'line_3_color',
                'type'            => 'color',
                'label'           => __('Line 3 color', 'origamiez'),
                'description'     => '',
                'default'         => '#E5E5E5',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',                
            ),
            array(
                'id'              => 'footer_sidebars_bg_color',
                'type'            => 'color',
                'label'           => __('Footer sidebar background color', 'origamiez'),
                'description'     => '',
                'default'         => '#222222',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback', 
                'transport'       => 'refresh',               
            ),
            array(
                'id'              => 'footer_sidebars_text_color',
                'type'            => 'color',
                'label'           => __('Footer sidebar text color', 'origamiez'),
                'description'     => '',
                'default'         => '#999999',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',   
                'transport'       => 'refresh',             
            ),
            array(
                'id'              => 'footer_widget_title_color',
                'type'            => 'color',
                'label'           => __('Footer widget title color', 'origamiez'),
                'description'     => '',
                'default'         => '#FFFFFF',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',                
            ),
            array(
                'id'              => 'footer_info_bg_color',
                'type'            => 'color',
                'label'           => __('Footer info background color', 'origamiez'),
                'description'     => '',
                'default'         => '#111111',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback',
                'transport'       => 'refresh',
            ),
            array(
                'id'              => 'footer_info_text_color',
                'type'            => 'color',
                'label'           => __('Footer info text color', 'origamiez'),
                'description'     => '',
                'default'         => '#999999',
                'section'         => 'colors',                
                'active_callback' => 'origamiez_skin_custom_callback', 
                'transport'       => 'refresh',               
            ),
        )
    );


    $social_objects = origamiez_get_socials();
    foreach($social_objects as $social_slug => $social){
        $custom_settings['sections'][] = array(
            'id'    => "social_{$social_slug}",
            'panel' => 'origamiez_social_links',
            'title' => $social['label']
        );
        $custom_settings['settings'][] = array(
            'id'              => "{$social_slug}_url",
            'label'           => __('URL', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'text',            
            'section'         => "social_{$social_slug}",  
            'transport'       => 'refresh'            
        );
        $custom_settings['settings'][] = array(
            'id'              => "{$social_slug}_color",
            'label'           => __('Color', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'color',            
            'section'         => "social_{$social_slug}",  
            'transport'       => 'refresh'            
        );
    }

    $font_objects = array(
        'font_body'         => __('Body', 'origamiez'),
        'font_menu'         => __('Menu', 'origamiez'),
        'font_widget_title' => __('Widget title', 'origamiez'),
        'font_h1'           => __('Heading 1', 'origamiez'),
        'font_h2'           => __('Heading 2', 'origamiez'),
        'font_h3'           => __('Heading 3', 'origamiez'),
        'font_h4'           => __('Heading 4', 'origamiez'),
        'font_h5'           => __('Heading 5', 'origamiez'),
        'font_h6'           => __('Heading 6', 'origamiez'));

    foreach($font_objects as $font_slug => $font_title){
        $custom_settings['sections'][] = array(
            'id'    => "custom_{$font_slug}",
            'panel' => 'origamiez_typography',
            'title' => $font_title
        );

        $custom_settings['settings'][] = array(
            'id'          => "{$font_slug}_is_enable",
            'label'       => __('Check to enable', 'origamiez'),
            'description' => '',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => "custom_{$font_slug}",                
            'transport'   => 'refresh',   
        );
        
        $custom_settings['settings'][] = array(
            'id'              => "{$font_slug}_family",
            'label'           => __('Font Family', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'select',
            'choices'         => origamiez_get_font_families(),
            'section'         => "custom_{$font_slug}",  
            'transport'       => 'refresh',   
            'active_callback' => "origamiez_{$font_slug}_enable_callback",
        );

        $custom_settings['settings'][] = array(
            'id'              => "{$font_slug}_size",
            'label'           => __('Font Size', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'select',
            'choices'         => origamiez_get_font_sizes(),
            'section'         => "custom_{$font_slug}",        
            'transport'       => 'refresh',   
            'active_callback' => "origamiez_{$font_slug}_enable_callback",
        );

        $custom_settings['settings'][] = array(
            'id'              => "{$font_slug}_style",
            'label'           => __('Font Style', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'select',
            'choices'         => origamiez_get_font_styles(),
            'section'         => "custom_{$font_slug}",           
            'transport'       => 'refresh',   
            'active_callback' => "origamiez_{$font_slug}_enable_callback",
        );

        $custom_settings['settings'][] = array(
            'id'              => "{$font_slug}_weight",
            'label'           => __('Font Weight', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'select',
            'choices'         => origamiez_get_font_weights(),
            'section'         => "custom_{$font_slug}",               
            'transport'       => 'refresh',   
            'active_callback' => "origamiez_{$font_slug}_enable_callback",
        );
        $custom_settings['settings'][] = array(
            'id'              => "{$font_slug}_line_height",
            'label'           => __('Line height', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'select',
            'choices'         => origamiez_get_font_line_heighs(),
            'section'         => "custom_{$font_slug}",                
            'transport'       => 'refresh',   
            'active_callback' => "origamiez_{$font_slug}_enable_callback",
        );
        /*
         * ----------------------------------------
         * Banner
         * ---------------------------------------- 
         */
        $custom_settings['settings'][] = array(
            'id'              => "top_banner_url",
            'label'           => __('Link to', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'text',            
            'section'         => 'header_image',  
            'transport'       => 'refresh'            
        );
        $custom_settings['settings'][] = array(
            'id'              => "top_banner_title",
            'label'           => __('Title of banner', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'text',            
            'section'         => 'header_image',  
            'transport'       => 'refresh'            
        );
        $custom_settings['settings'][] = array(
            'id'              => "top_banner_custom",
            'label'           => __('Custom HTML', 'origamiez'),
            'description'     => '',
            'default'         => '',
            'type'            => 'textarea',            
            'section'         => 'header_image',  
            'transport'       => 'refresh'            
        );        
    }

    return $custom_settings;
}

function origamiez_get_font_families(){
    $font_families = array(
        ""                            => __('-- Default --', 'origamiez'),
        "Arial"                       => "Arial",
        "Georgia"                     => "Georgia",
        "Helvetica"                   => "Helvetica",
        "Palatino"                    => "Palatino",
        "Tahoma"                      => "Tahoma",
        "Times New Roman, sans-serif" => "Times New Roman, sans-serif",
        "Trebuchet"                   => "Trebuchet",
        "Verdana"                     => "Verdana"
    );

    return apply_filters('origamiez_get_font_families', $font_families);
}

function origamiez_get_font_line_heighs(){
    $line_heights = array("" => __('-- Default --', 'origamiez'));
    
    for($i=0; $i<=150; $i++){
        $tmp = "{$i}px";
        $line_heights[$tmp] = $tmp;
    }    

    return apply_filters('origamiez_get_font_line_heighs', $line_heights);
}

function origamiez_get_font_sizes(){
    $font_sizes = array("" => __('-- Default --', 'origamiez'));
    
    for($i=0; $i<=150; $i++){
        $tmp = "{$i}px";
        $font_sizes[$tmp] = $tmp;
    }    

    return apply_filters('origamiez_get_font_sizes', $font_sizes);
}

function origamiez_get_font_styles(){
    $font_styles = array(
        ""        => __('-- Default --', 'origamiez'),
        "normal"  => "Normal",
        "italic"  => "Italic",
        "oblique" => "Oblique",
        "inherit" => "Inherit"
    );

    return apply_filters('origamiez_get_font_families', $font_styles);
}

function origamiez_get_font_weights(){
    $font_weights = array(
        ""        => __('-- Default --', 'origamiez'),
        "normal"  => __('Normal', 'origamiez'),
        "bold"    => __('Bold', 'origamiez'),
        "bolder"  => __('Bolder', 'origamiez'),
        "lighter" => __('Lighter', 'origamiez'),
        100       => 100,
        200       => 200,
        300       => 300,
        400       => 400,
        500       => 500,
        600       => 600,
        700       => 700,
        800       => 800,
        900       => 900,
        "inherit" => __('Inherit', 'origamiez'),
    );

    return apply_filters('origamiez_get_font_weights', $font_weights);   
}