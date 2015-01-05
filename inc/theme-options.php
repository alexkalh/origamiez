<?php

/**
 * Initialize the custom Theme Options.
 */
add_action('admin_init', 'custom_theme_options');

function custom_theme_options() {

    /* OptionTree is not loaded yet */
    if (!function_exists('ot_settings_id'))
        return false;

    /**
     * Get a copy of the saved settings array. 
     */
    $saved_settings = get_option(ot_settings_id(), array());

    /**
     * Custom settings array that will eventually be 
     * passes to the OptionTree Settings API Class.
     */
    $custom_settings = array(
        'contextual_help' => array(
            'content' => array(
                array(
                    'id' => 'option_types_help',
                    'title' => __('Option Types', ct_get_domain()),
                    'content' => '<p>' . __('Help content goes here!', ct_get_domain()) . '</p>'
                )
            ),
            'sidebar' => '<p></p>'
        ),
        'sections' => array(
            array(
                'id' => 'general',
                'title' => __('General Setting', ct_get_domain())
            ),
            array(
                'id' => 'top_banner',
                'title' => __('Top banner', ct_get_domain())
            ),            
            array(
                'id' => 'footer',
                'title' => __('Footer', ct_get_domain()),
            ),
            array(
                'id' => 'background',
                'title' => __('Background', ct_get_domain()),
            ),
            array(
                'id' => 'social_links',
                'title' => __('Social links', ct_get_domain())
            ),
            array(
                'id' => 'layout',
                'title' => __('Layout', ct_get_domain()),
            ),
            array(
                'id' => 'blog_posts',
                'title' => __('Blog posts', ct_get_domain()),
            ),
            array(
                'id' => 'single_post',
                'title' => __('Single post', ct_get_domain()),
            ),
            array(
                'id' => 'custom_color',
                'title' => __('Custom color', ct_get_domain()),
            ),
            array(
                'id' => 'custom_font',
                'title' => __('Custom font', ct_get_domain()),
            ),
            array(
                'id' => 'custom_css',
                'title' => __('Custom CSS', ct_get_domain()),
            ),
        ),
        'settings' => array(
            /*
             * ----------------------------------------
             * General setting
             * ---------------------------------------- 
             */
            array(
                'id' => 'logo',
                'label' => __('Logo', ct_get_domain()),
                'desc' => __('Upload or enter your logo', ct_get_domain()),
                'std' => '',
                'type' => 'upload',
                'section' => 'general',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'favicon',
                'label' => __('Favicon', ct_get_domain()),
                'desc' => __('Upload or enter your favicon', ct_get_domain()),
                'std' => '',
                'type' => 'upload',
                'section' => 'general',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'apple_icon',
                'label' => __('Apple icon', ct_get_domain()),
                'desc' => __('Upload your apple icon (152x152).', ct_get_domain()),
                'std' => '',
                'type' => 'upload',
                'section' => 'general',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Top banner
             * ---------------------------------------- 
             */
            array(
                'id' => 'top_banner_image',
                'label' => __('Banner image', ct_get_domain()),
                'desc' => __('Upload or enter your top banner', ct_get_domain()),
                'std' => '',
                'type' => 'upload',
                'section' => 'top_banner',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'top_banner_url',
                'label' => __('Banner URL', ct_get_domain()),
                'desc' => __('Enter your banner url', ct_get_domain()),
                'std' => '',
                'type' => 'text',
                'section' => 'top_banner',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'top_banner_title',
                'label' => __('Banner Title', ct_get_domain()),
                'desc' => __('Enter title banner. This value will be set to ALT of IMG tag, and TITLE of A tag', ct_get_domain()),
                'std' => '',
                'type' => 'text',
                'section' => 'top_banner',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'top_banner_target',
                'label' => __('Open on new tab', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'on-off',
                'section' => 'top_banner',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'top_banner_html',
                'label' => __('Custom HTML', ct_get_domain()),
                'desc' => __('Enter custom HTML, e.g. Google AdSense,..', ct_get_domain()),
                'std' => '',
                'type' => 'textarea-simple',
                'section' => 'top_banner',
                'rows' => '10',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),          
            /*
             * ----------------------------------------
             * Footer
             * ---------------------------------------- 
             */
            array(
                'id' => 'footer_information',
                'label' => __('Footer information', ct_get_domain()),
                'desc' => __('Enter your information, e.g. copyright, or Google AdSense code, ...', ct_get_domain()),
                'std' => '',
                'type' => 'textarea-simple',
                'section' => 'footer',
                'rows' => '10',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Custom CSS
             * ---------------------------------------- 
             */
            array(
                'id' => 'custom_css',
                'label' => __('CSS', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'css',
                'section' => 'custom_css',
                'rows' => '20',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Background
             * ---------------------------------------- 
             */
            array(
                'id'          => 'background_type',
                'label'       => __( 'Select type of background', ct_get_domain()),
                'desc'        => '',
                'std'         => 'none',
                'type'        => 'radio',
                'section'     => 'background',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => '',
                'condition'   => '',
                'operator'    => 'and',
                'choices'     => array( 
                    array(
                    'value'       => 'none',
                    'label'       => __( 'None', ct_get_domain()),
                    'src'         => ''
                    ),
                    array(
                        'value'       => 'simple',
                        'label'       => __( 'Simple', ct_get_domain()),
                        'src'         => ''
                    ),
                      array(
                        'value'       => 'slideshow',
                        'label'       => __( 'Slideshow', ct_get_domain()),
                        'src'         => ''
                    )                 
                )
            ),
            array(
                'id'          => 'background_simple',
                'label'       => __('Background options', ct_get_domain()),
                'desc'        => '',
                'std'         => '',
                'type'        => 'background',
                'section'     => 'background',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'min_max_step'=> '',
                'class'       => '',
                'condition'   => 'background_type:is(simple)',
                'operator'    => 'and'
            ),
            array(
                'id' => 'background_slideshow',
                'label' => __('Background as Slideshow', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'gallery',
                'section' => 'background',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'background_type:is(slideshow)',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Social links
             * ---------------------------------------- 
             */
            array(
                'id' => 'social_links',
                'label' => __('Social Links', ct_get_domain()),
                'desc' => __('Add your custom links.', ct_get_domain()),
                'std' => '',
                'type' => 'social-links',
                'section' => 'social_links',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Layouts
             * ---------------------------------------- 
             */
            array(
                'id' => 'use_layout_fullwidth',
                'label' => __('Layout full width', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'layout',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Blog posts
             * ---------------------------------------- 
             */
            array(
                'id' => 'layout_taxonomy',
                'label' => __('Layout', ct_get_domain()),
                'desc' => '',
                'std' => 'right-sidebar',
                'type' => 'radio-image',
                'section' => 'blog_posts',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'taxonomy_excerpt_words_limit',
                'label' => __('Excerpt words limit', ct_get_domain()),
                'desc' => '',
                'std' => 40,
                'type' => 'numeric-slider',
                'section' => 'blog_posts',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '10,300,10',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_taxonomy_datetime',
                'label' => __('Show datetime', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'blog_posts',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_taxonomy_comments',
                'label' => __('Show number of comments', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'blog_posts',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_taxonomy_view_count',
                'label' => __('Show number of views', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'blog_posts',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Single Post
             * ---------------------------------------- 
             */
            array(
                'id' => 'is_show_post_datetime',
                'label' => __('Show datetime', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_comments',
                'label' => __('Show number of comments', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_view_count',
                'label' => __('Show number of views', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_thumbnail',
                'label' => __('Featured image', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_category',
                'label' => __('Show category', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_tag',
                'label' => __('Show tag', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_adjacent',
                'label' => __('Show next & prev posts', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_author_info',
                'label' => __('Show author information', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'is_show_post_related',
                'label' => __('Show related posts', ct_get_domain()),
                'desc' => '',
                'std' => 'on',
                'type' => 'on-off',
                'section' => 'single_post',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Custom Color
             * ---------------------------------------- 
             */
            array(
                'id' => 'skin',
                'label' => __('Skin', ct_get_domain()),
                'desc' => '',
                'std' => 'default',
                'type' => 'radio-image',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => '',
                'operator' => 'and'
            ),
            array(
                'id' => 'primary_color',
                'type' => 'colorpicker',
                'label' => __('Primary color', ct_get_domain()),
                'desc' => '',
                'std' => '#E74C3C',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'secondary_color',
                'type' => 'colorpicker',
                'label' => __('Secondary color', ct_get_domain()),
                'desc' => '',
                'std' => '#F9F9F9',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'body_color',
                'type' => 'colorpicker',
                'label' => __('Body text color', ct_get_domain()),
                'desc' => '',
                'std' => '#555555',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'heading_color',
                'type' => 'colorpicker',
                'label' => __('Heading color', ct_get_domain()),
                'desc' => '',
                'std' => '#444444',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'link_color',
                'type' => 'colorpicker',
                'label' => __('Link color', ct_get_domain()),
                'desc' => '',
                'std' => '#444444',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'main_menu_color',
                'type' => 'colorpicker',
                'label' => __('Main menu text color', ct_get_domain()),
                'desc' => '',
                'std' => '#666666',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'line_1_color',
                'type' => 'colorpicker',
                'label' => __('Line 1 color', ct_get_domain()),
                'desc' => '',
                'std' => '#555555',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'line_2_color',
                'type' => 'colorpicker',
                'label' => __('Line 2 color', ct_get_domain()),
                'desc' => '',
                'std' => '#D8D8D8',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'line_3_color',
                'type' => 'colorpicker',
                'label' => __('Line 3 color', ct_get_domain()),
                'desc' => '',
                'std' => '#E5E5E5',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'footer_sidebars_bg_color',
                'type' => 'colorpicker',
                'label' => __('Footer sidebar background color', ct_get_domain()),
                'desc' => '',
                'std' => '#222222',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'footer_sidebars_text_color',
                'type' => 'colorpicker',
                'label' => __('Footer sidebar text color', ct_get_domain()),
                'desc' => '',
                'std' => '#999999',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'footer_widget_title_color',
                'type' => 'colorpicker',
                'label' => __('Footer widget title color', ct_get_domain()),
                'desc' => '',
                'std' => '#FFFFFF',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'footer_info_bg_color',
                'type' => 'colorpicker',
                'label' => __('Footer info background color', ct_get_domain()),
                'desc' => '',
                'std' => '#111111',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            array(
                'id' => 'footer_info_text_color',
                'type' => 'colorpicker',
                'label' => __('Footer info text color', ct_get_domain()),
                'desc' => '',
                'std' => '#999999',
                'section' => 'custom_color',
                'rows' => '',
                'post_type' => '',
                'taxonomy' => '',
                'min_max_step' => '',
                'class' => '',
                'condition' => 'skin:is(custom)',
                'operator' => 'and'
            ),
            /*
             * ----------------------------------------
             * Custom Font
             * ---------------------------------------- 
             */
            array(
                'id' => 'font_body',
                'label' => __('Body', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_widget_title',
                'label' => __('Widget title', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_menu',
                'label' => __('Menu', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_heading_1',
                'label' => __('H1', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_heading_2',
                'label' => __('H2', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_heading_3',
                'label' => __('H3', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_heading_4',
                'label' => __('H4', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_heading_5',
                'label' => __('H5', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'font_heading_6',
                'label' => __('H6', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'typography',
                'section' => 'custom_font',
                'condition' => '',
            ),
            array(
                'id' => 'google_font',
                'label' => __('Google font', ct_get_domain()),
                'desc' => '',
                'std' => '',
                'type' => 'list-item',
                'section' => 'custom_font',
                'condition' => '',
                'settings' => array(
                    array(
                        'id' => 'slug',
                        'label' => __('Slug', ct_get_domain()),
                        'desc' => __('Enter unique slug.<br/> Example: open+sans', ct_get_domain()),
                        'std' => '',
                        'type' => 'text',
                    ),
                    array(
                        'id' => 'link',
                        'label' => __('Link', ct_get_domain()),
                        'desc' => sprintf(__('Enter font link.<br/> Example:<br/>%s', ct_get_domain()), esc_url("http://fonts.googleapis.com/css?family=Open+Sans")),
                        'std' => '',
                        'type' => 'text',
                    )
                )
            ),           
        )
    );

    /* allow settings to be filtered before saving */
    $custom_settings = apply_filters(ot_settings_id() . '_args', $custom_settings);

    /* settings are not the same update the DB */
    if ($saved_settings !== $custom_settings) {
        update_option(ot_settings_id(), $custom_settings);
    }

    /* Lets OptionTree know the UI Builder is being overridden */
    global $ot_has_custom_theme_options;
    $ot_has_custom_theme_options = true;
}
