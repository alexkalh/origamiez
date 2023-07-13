<?php
add_action( 'customize_register', 'origamiez_customize_register' );
function origamiez_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
	$options                                                   = origamiez_get_custom_options();
	//Add Panels
	if ( isset( $options['panels'] ) && ! empty( $options['panels'] ) ) {
		$panels = $options['panels'];
		foreach ( $panels as $panel ) {
			$wp_customize->add_panel( $panel['id'], $panel );
		}
	}
	//Add Sections
	if ( isset( $options['sections'] ) && ! empty( $options['sections'] ) ) {
		$sections = $options['sections'];
		foreach ( $sections as $section ) {
			$wp_customize->add_section( $section['id'], $section );
		}
	}
	// Add Settings & Control
	if ( isset( $options['settings'] ) && ! empty( $options['settings'] ) ) {
		$settings = $options['settings'];
		foreach ( $settings as $setting ) {
			#Select  a sanitize callback for each setting
			switch ( $setting['type'] ) {
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
			$wp_customize->add_setting( $setting['id'], array(
				"default"           => $setting['default'],
				'sanitize_callback' => $sanitize_callback,
				'capability'        => 'edit_theme_options',
				"transport"         => isset( $setting['transport'] ) ? $setting['transport'] : "postMessage",
			) );
			# add control for this setting
			switch ( $setting['type'] ) {
				case 'upload':
					unset( $setting['type'] );
					$wp_customize->add_control(
						new WP_Customize_Image_Control(
							$wp_customize,
							$setting['id'],
							$setting ) );
					break;
				case 'color':
					unset( $setting['type'] );
					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							$setting['id'],
							$setting ) );
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
							$setting ) );
					break;
			}
		}
	}
}

function origamiez_sanitize_textarea( $value ) {
	if ( $value ) {
		$value = wp_kses( $value, origamiez_get_allowed_tags() );
	}

	return $value;
}

function origamiez_skin_custom_callback( $control ) {
	if ( 'custom' === $control->manager->get_setting( 'skin' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_body_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_body_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_menu_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_menu_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_site_title_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_site_title_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_site_subtitle_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_site_subtitle_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_widget_title_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_widget_title_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_h1_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_h1_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_h2_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_h2_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_h3_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_h3_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_h4_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_h4_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_h5_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_h5_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_font_h6_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'font_h6_is_enable' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_top_bar_enable_callback( $control ) {
	if ( 1 === (int) $control->manager->get_setting( 'is_display_top_bar' )->value() ) {
		return true;
	} else {
		return false;
	}
}

function origamiez_get_custom_options() {
	$custom_settings               = array(
		'panels'   => array(
			array(
				'id'    => 'origamiez_general',
				'title' => esc_attr__( 'General Setting', 'origamiez' )
			),
			array(
				'id'    => 'origamiez_typography',
				'title' => esc_attr__( 'Typography', 'origamiez' ),
			),
			array(
				'id'    => 'origamiez_social_links',
				'title' => esc_attr__( 'Social links', 'origamiez' ),
			),
			array(
				'id'    => 'origamiez_google_fonts',
				'title' => esc_attr__( 'Google fonts', 'origamiez' ),
			),
		),
		'sections' => array(
			array(
				'id'    => 'header',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Header', 'origamiez' )
			),
			array(
				'id'    => 'footer',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Footer', 'origamiez' )
			),
			array(
				'id'    => 'layout',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Layout', 'origamiez' ),
			),
			array(
				'id'    => 'blog_posts',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Blog posts', 'origamiez' ),
			),
			array(
				'id'    => 'single_post',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Single post', 'origamiez' ),
			),
			array(
				'id'    => 'single_post_adjacent',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Single post - adjacent', 'origamiez' ),
			),
			array(
				'id'    => 'single_post_related',
				'panel' => 'origamiez_general',
				'title' => esc_attr__( 'Single post - related', 'origamiez' ),
			),
			array(
				'id'    => 'custom_css',
				'title' => esc_attr__( 'Custom CSS', 'origamiez' ),
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
				'label'       => esc_attr__( 'Logo', 'origamiez' ),
				'description' => esc_attr__( 'Upload or enter your logo', 'origamiez' ),
				'default'     => '',
				'type'        => 'upload',
				'section'     => 'header',
				'transport'   => 'refresh'
			),
			array(
				'id'          => 'header_style',
				'label'       => esc_attr__( 'Header style', 'origamiez' ),
				'description' => '',
				'default'     => 'left-right',
				'type'        => 'radio',
				'choices'     => array(
					'left-right' => esc_attr__( 'Logo: left, Banner: right', 'origamiez' ),
					'up-down'    => esc_attr__( 'Logo: up, Banner: down', 'origamiez' ),
				),
				'section'     => 'header',
				'transport'   => 'refresh',
			),
			/*
			 * ----------------------------------------
			 * Footer
			 * ----------------------------------------
			 */
			array(
				'id'          => 'footer_information',
				'label'       => esc_attr__( 'Footer information', 'origamiez' ),
				'description' => esc_attr__( 'Enter your information, e.g. copyright, or Google AdSense code, ...', 'origamiez' ),
				'default'     => esc_attr__( 'Copyright &copy; Your Name', 'origamiez' ),
				'type'        => 'textarea',
				'section'     => 'footer',
				'transport'   => 'refresh'
			),
			array(
				'id'          => 'footer_number_of_cols',
				'label'       => esc_attr__( 'Number of columns', 'origamiez' ),
				'description' => '',
				'default'     => 5,
				'type'        => 'radio',
				'choices'     => array(
					5 => esc_attr__( '5 Columns', 'origamiez' ),
					4 => esc_attr__( '4 Columns', 'origamiez' ),
					3 => esc_attr__( '3 Columns', 'origamiez' ),
					2 => esc_attr__( '2 Columns', 'origamiez' ),
					1 => esc_attr__( '1 Column', 'origamiez' ),
				),
				'section'     => 'footer',
				'transport'   => 'refresh',
			),
			/*
			 * ----------------------------------------
			 * Layouts
			 * ----------------------------------------
			 */
			array(
				'id'          => 'use_layout_fullwidth',
				'label'       => esc_attr__( 'Layout full width', 'origamiez' ),
				'description' => '',
				'default'     => 0,
				'type'        => 'checkbox',
				'section'     => 'layout',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_display_top_bar',
				'label'       => esc_attr__( 'Show top bar', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'layout',
				'transport'   => 'refresh',
			),
			array(
				'id'              => 'is_display_top_social_links',
				'label'           => esc_attr__( 'Show top social links', 'origamiez' ),
				'description'     => '',
				'default'         => 1,
				'type'            => 'checkbox',
				'section'         => 'layout',
				'transport'       => 'refresh',
				'active_callback' => 'origamiez_top_bar_enable_callback',
			),
			array(
				'id'          => 'is_display_breadcrumb',
				'label'       => esc_attr__( 'Show breadcrumb', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'layout',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_enable_convert_flat_menus',
				'label'       => esc_attr__( 'Is convert top(bottom) menu to select box on mobile.', 'origamiez' ),
				'description' => '',
				'default'     => 1,
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
				'id'          => 'taxonomy_layout',
				'label'       => esc_attr__( 'Layout', 'origamiez' ),
				'description' => '',
				'default'     => 'two-cols',
				'type'        => 'radio',
				'choices'     => array(
					'two-cols'       => esc_attr__( 'Two column', 'origamiez' ),
					'three-cols'     => esc_attr__( 'Three column - large : small : medium', 'origamiez' ),
					'three-cols-slm' => esc_attr__( 'Three column - small : large : medium', 'origamiez' ),
				),
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'taxonomy_thumbnail_style',
				'label'       => esc_attr__( 'Thumbnail position', 'origamiez' ),
				'description' => '',
				'default'     => 'thumbnail-left',
				'type'        => 'radio',
				'choices'     => array(
					'thumbnail-left'       => esc_attr__( 'Thumbnail left', 'origamiez' ),
					'thumbnail-right'      => esc_attr__( 'Thumbnail right', 'origamiez' ),
					'thumbnail-full-width' => esc_attr__( 'Thumbnail full width', 'origamiez' ),
				),
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'size_of_thumb_col_on_blog_page',
				'label'       => esc_attr__( 'Size of thumbnail column', 'origamiez' ),
				'description' => esc_attr__( 'The value is bootstrap column (1,2, ..,12)', 'origamiez' ),
				'default'     => 2,
				'type'        => 'select',
				'choices'     => array(
					1  => 1,
					2  => 2,
					3  => 3,
					4  => 4,
					5  => 5,
					6  => 6,
					7  => 7,
					8  => 8,
					9  => 9,
					10 => 10,
					11 => 11,
					12 => 12
				),
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_taxonomy_datetime',
				'label'       => esc_attr__( 'Show datetime', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_taxonomy_comments',
				'label'       => esc_attr__( 'Show number of comments', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_taxonomy_category',
				'label'       => esc_attr__( 'Show categories', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_taxonomy_author',
				'label'       => esc_attr__( 'Show author', 'origamiez' ),
				'description' => '',
				'default'     => 0,
				'type'        => 'checkbox',
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_readmore_button',
				'label'       => esc_attr__( 'Show readmore button', 'origamiez' ),
				'description' => '',
				'default'     => 0,
				'type'        => 'checkbox',
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_enable_lightbox',
				'label'       => esc_attr__( 'Enable lightbox', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'blog_posts',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_enable_hover_effect',
				'label'       => esc_attr__( 'Enable hover effect', 'origamiez' ),
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
				'id'          => 'single-post-layout',
				'label'       => esc_attr__( 'Layout', 'origamiez' ),
				'description' => '',
				'default'     => 'two-cols',
				'type'        => 'radio',
				'choices'     => array(
					'two-cols'       => esc_attr__( 'Two column', 'origamiez' ),
					'three-cols'     => esc_attr__( 'Three column - large : small : medium', 'origamiez' ),
					'three-cols-slm' => esc_attr__( 'Three column - small : large : medium', 'origamiez' ),
				),
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_datetime',
				'label'       => esc_attr__( 'Show datetime', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_comments',
				'label'       => esc_attr__( 'Show number of comments', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_category',
				'label'       => esc_attr__( 'Show category', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_category_below_title',
				'label'       => esc_attr__( 'Show category (below title)', 'origamiez' ),
				'description' => '',
				'default'     => 0,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_tag',
				'label'       => esc_attr__( 'Show tag', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_author_info',
				'label'       => esc_attr__( 'Show author information', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_border_for_images',
				'label'       => esc_attr__( 'Show border for image inside post-content', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_use_gallery_popup',
				'label'       => esc_attr__( 'Use gallery popup', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post',
				'transport'   => 'refresh',
			),
			/*
			 * ----------------------------------------
			 * Single Post - Adjacent
			 * ----------------------------------------
			 */
			array(
				'id'          => 'is_show_post_adjacent',
				'label'       => esc_attr__( 'Show next & prev posts', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post_adjacent',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_adjacent_title',
				'label'       => esc_attr__( 'Show title', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post_adjacent',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'is_show_post_adjacent_datetime',
				'label'       => esc_attr__( 'Show datetime', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post_adjacent',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'post_adjacent_arrow_left',
				'label'       => esc_attr__( 'Arrow left', 'origamiez' ),
				'description' => esc_attr__( 'Upload your arrow left', 'origamiez' ),
				'default'     => '',
				'type'        => 'upload',
				'section'     => 'single_post_adjacent',
				'transport'   => 'refresh'
			),
			array(
				'id'          => 'post_adjacent_arrow_right',
				'label'       => esc_attr__( 'Arrow right', 'origamiez' ),
				'description' => esc_attr__( 'Upload your arrow right', 'origamiez' ),
				'default'     => '',
				'type'        => 'upload',
				'section'     => 'single_post_adjacent',
				'transport'   => 'refresh'
			),
			/*
			 * ----------------------------------------
			 * Single Post - Related
			 * ----------------------------------------
			 */
			array(
				'id'          => 'single_post_related_layout',
				'label'       => esc_attr__( 'Layout', 'origamiez' ),
				'description' => '',
				'default'     => 'flat-list',
				'type'        => 'radio',
				'choices'     => array(
					'carousel'  => esc_attr__( 'Carousel thumbnail', 'origamiez' ),
					'flat-list' => esc_attr__( 'Flat list', 'origamiez' ),
				),
				'section'     => 'single_post_related',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'post_related_layout',
				'label'       => esc_attr__( 'Show related posts', 'origamiez' ),
				'description' => '',
				'default'     => 1,
				'type'        => 'checkbox',
				'section'     => 'single_post_related',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'get_related_post_by',
				'label'       => esc_attr__( 'Get by:', 'origamiez' ),
				'description' => '',
				'default'     => 'post_tag',
				'type'        => 'radio',
				'choices'     => array(
					'post_tag' => esc_attr__( 'Tags', 'origamiez' ),
					'category' => esc_attr__( 'Categories', 'origamiez' ),
				),
				'section'     => 'single_post_related',
				'transport'   => 'refresh',
			),
			array(
				'id'          => 'number_of_related_posts',
				'label'       => esc_attr__( 'Number of related posts.', 'origamiez' ),
				'description' => '',
				'default'     => 5,
				'type'        => 'text',
				'section'     => 'single_post_related',
				'transport'   => 'refresh',
			),
			/*
			 * ----------------------------------------
			 * Custom Color
			 * ----------------------------------------
			 */
			array(
				'id'          => 'skin',
				'label'       => esc_attr__( 'Color Scheme', 'origamiez' ),
				'description' => '',
				'default'     => 'default',
				'type'        => 'radio',
				'section'     => 'colors',
				'transport'   => 'refresh',
				'choices'     => array(
					'default' => esc_attr__( 'Default', 'origamiez' ),
					'custom'  => esc_attr__( 'Custom', 'origamiez' ),
				)
			),
			array(
				'id'              => 'primary_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Primary color', 'origamiez' ),
				'description'     => '',
				'default'         => '#E74C3C',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'secondary_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Secondary color', 'origamiez' ),
				'description'     => '',
				'default'         => '#F9F9F9',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'body_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Body text color', 'origamiez' ),
				'description'     => '',
				'default'         => '#666666',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'heading_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Heading color', 'origamiez' ),
				'description'     => '',
				'default'         => '#333333',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'link_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Link color', 'origamiez' ),
				'description'     => '',
				'default'         => '#333333',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'link_hover_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Link color :hover', 'origamiez' ),
				'description'     => '',
				'default'         => '#E74C3C',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'main_menu_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Main menu text color', 'origamiez' ),
				'description'     => '',
				'default'         => '#666666',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'line_1_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Line 1 color', 'origamiez' ),
				'description'     => '',
				'default'         => '#555555',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'line_2_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Line 2 color', 'origamiez' ),
				'description'     => '',
				'default'         => '#D8D8D8',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'line_3_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Line 3 color', 'origamiez' ),
				'description'     => '',
				'default'         => '#E5E5E5',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'footer_sidebars_bg_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Footer sidebar background color', 'origamiez' ),
				'description'     => '',
				'default'         => '#222222',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'footer_sidebars_text_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Footer sidebar text color', 'origamiez' ),
				'description'     => '',
				'default'         => '#999999',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'footer_widget_title_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Footer widget title color', 'origamiez' ),
				'description'     => '',
				'default'         => '#FFFFFF',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'footer_info_bg_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Footer info background color', 'origamiez' ),
				'description'     => '',
				'default'         => '#111111',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
			array(
				'id'              => 'footer_info_text_color',
				'type'            => 'color',
				'label'           => esc_attr__( 'Footer info text color', 'origamiez' ),
				'description'     => '',
				'default'         => '#999999',
				'section'         => 'colors',
				'active_callback' => 'origamiez_skin_custom_callback',
				'transport'       => 'refresh',
			),
		)
	);
	$custom_settings['settings'][] = array(
		'id'          => 'custom_css',
		'label'       => esc_attr__( 'Custom CSS', 'origamiez' ),
		'description' => '',
		'default'     => '',
		'type'        => 'textarea',
		'transport'   => 'refresh',
		'section'     => 'custom_css',
	);
	$social_objects                = origamiez_get_socials();
	foreach ( $social_objects as $social_slug => $social ) {
		$custom_settings['sections'][] = array(
			'id'    => "social_{$social_slug}",
			'panel' => 'origamiez_social_links',
			'title' => esc_attr( $social['label'] )
		);
		$custom_settings['settings'][] = array(
			'id'          => "{$social_slug}_url",
			'label'       => esc_attr__( 'URL', 'origamiez' ),
			'description' => '',
			'default'     => '',
			'type'        => 'text',
			'section'     => "social_{$social_slug}",
			'transport'   => 'refresh'
		);
		$custom_settings['settings'][] = array(
			'id'          => "{$social_slug}_color",
			'label'       => esc_attr__( 'Color', 'origamiez' ),
			'description' => '',
			'default'     => esc_attr( $social['color'] ),
			'type'        => 'color',
			'section'     => "social_{$social_slug}",
			'transport'   => 'refresh'
		);
	}
	$font_objects = array(
		'font_body'          => esc_attr__( 'Body', 'origamiez' ),
		'font_menu'          => esc_attr__( 'Menu', 'origamiez' ),
		'font_site_title'    => esc_attr__( 'Site title', 'origamiez' ),
		'font_site_subtitle' => esc_attr__( 'Site subtitle', 'origamiez' ),
		'font_widget_title'  => esc_attr__( 'Widget title', 'origamiez' ),
		'font_h1'            => esc_attr__( 'Heading 1', 'origamiez' ),
		'font_h2'            => esc_attr__( 'Heading 2', 'origamiez' ),
		'font_h3'            => esc_attr__( 'Heading 3', 'origamiez' ),
		'font_h4'            => esc_attr__( 'Heading 4', 'origamiez' ),
		'font_h5'            => esc_attr__( 'Heading 5', 'origamiez' ),
		'font_h6'            => esc_attr__( 'Heading 6', 'origamiez' )
	);
	foreach ( $font_objects as $font_slug => $font_title ) {
		$custom_settings['sections'][] = array(
			'id'    => "custom_{$font_slug}",
			'panel' => 'origamiez_typography',
			'title' => $font_title
		);
		$custom_settings['settings'][] = array(
			'id'          => "{$font_slug}_is_enable",
			'label'       => esc_attr__( 'Check to enable', 'origamiez' ),
			'description' => '',
			'default'     => 0,
			'type'        => 'checkbox',
			'section'     => "custom_{$font_slug}",
			'transport'   => 'refresh',
		);
		$custom_settings['settings'][] = array(
			'id'              => "{$font_slug}_family",
			'label'           => esc_attr__( 'Font Family', 'origamiez' ),
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
			'label'           => esc_attr__( 'Font Size', 'origamiez' ),
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
			'label'           => esc_attr__( 'Font Style', 'origamiez' ),
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
			'label'           => esc_attr__( 'Font Weight', 'origamiez' ),
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
			'label'           => esc_attr__( 'Line height', 'origamiez' ),
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
			'id'          => "top_banner_url",
			'label'       => esc_attr__( 'Link to', 'origamiez' ),
			'description' => '',
			'default'     => '',
			'type'        => 'text',
			'section'     => 'header_image',
			'transport'   => 'refresh'
		);
		$custom_settings['settings'][] = array(
			'id'          => "top_banner_title",
			'label'       => esc_attr__( 'Title of banner', 'origamiez' ),
			'description' => '',
			'default'     => '',
			'type'        => 'text',
			'section'     => 'header_image',
			'transport'   => 'refresh'
		);
		$custom_settings['settings'][] = array(
			'id'          => 'top_banner_target',
			'label'       => esc_attr__( 'Open link on new tab', 'origamiez' ),
			'description' => '',
			'default'     => 0,
			'type'        => 'checkbox',
			'section'     => 'header_image',
			'transport'   => 'refresh',
		);
		$custom_settings['settings'][] = array(
			'id'          => "top_banner_custom",
			'label'       => esc_attr__( 'Custom HTML', 'origamiez' ),
			'description' => '',
			'default'     => '',
			'type'        => 'textarea',
			'section'     => 'header_image',
			'transport'   => 'refresh'
		);
	}
	/*
	 * ----------------------------------------
	 * Banner
	 * ----------------------------------------
	 */
	$number_of_google_fonts = (int) apply_filters( 'origamiez_get_number_of_google_fonts', 3 );
	if ( $number_of_google_fonts ) {
		for ( $i = 0; $i < $number_of_google_fonts; $i ++ ) {
			$custom_settings['sections'][] = array(
				'id'    => sprintf( 'google_font_%s', $i ),
				'panel' => 'origamiez_google_fonts',
				'title' => esc_attr__( 'Font #:', 'origamiez' ) . ( $i + 1 )
			);
			$custom_settings['settings'][] = array(
				'id'          => sprintf( 'google_font_%s_name', $i ),
				'label'       => esc_attr__( 'Font family (name)', 'origamiez' ),
				'description' => __( 'Please remove "+" by " ". Ex: <code>Open+Sans</code> to <code>Open Sans</code>', 'origamiez' ),
				'default'     => '',
				'type'        => 'text',
				'section'     => sprintf( 'google_font_%s', $i ),
				'transport'   => 'refresh',
			);
			$custom_settings['settings'][] = array(
				'id'          => sprintf( 'google_font_%s_src', $i ),
				'label'       => esc_attr__( 'Path of this font', 'origamiez' ),
				'description' => '',
				'default'     => '',
				'type'        => 'text',
				'section'     => sprintf( 'google_font_%s', $i ),
				'transport'   => 'refresh',
			);
		}
	}

	return $custom_settings;
}

function origamiez_get_font_families() {
	$font_families          = array(
		''                            => esc_attr__( '-- Default --', 'origamiez' ),
		'Arial'                       => 'Arial',
		'Georgia'                     => 'Georgia',
		'Helvetica'                   => 'Helvetica',
		'Palatino'                    => 'Palatino',
		'Tahoma'                      => 'Tahoma',
		'Times New Roman, sans-serif' => 'Times New Roman, sans-serif',
		'Trebuchet'                   => 'Trebuchet',
		'Verdana'                     => 'Verdana'
	);
	$number_of_google_fonts = (int) apply_filters( 'origamiez_get_number_of_google_fonts', 3 );
	if ( $number_of_google_fonts ) {
		for ( $i = 0; $i < $number_of_google_fonts; $i ++ ) {
			$font_family = get_theme_mod( sprintf( 'google_font_%s_name', $i ), false );
			$font_src    = get_theme_mod( sprintf( 'google_font_%s_src', $i ), '' );
			if ( $font_family && $font_src ) {
				$font_families[ $font_family ] = $font_family;
			}
		}
	}

	return apply_filters( 'origamiez_get_font_families', $font_families );
}

function origamiez_get_font_line_heighs() {
	$line_heights = array( "" => esc_attr__( '-- Default --', 'origamiez' ) );
	for ( $i = 0; $i <= 150; $i ++ ) {
		$tmp                  = "{$i}px";
		$line_heights[ $tmp ] = $tmp;
	}

	return apply_filters( 'origamiez_get_font_line_heighs', $line_heights );
}

function origamiez_get_font_sizes() {
	$font_sizes = array( "" => esc_attr__( '-- Default --', 'origamiez' ) );
	for ( $i = 0; $i <= 150; $i ++ ) {
		$tmp                = "{$i}px";
		$font_sizes[ $tmp ] = $tmp;
	}

	return apply_filters( 'origamiez_get_font_sizes', $font_sizes );
}

function origamiez_get_font_styles() {
	$font_styles = array(
		""        => esc_attr__( '-- Default --', 'origamiez' ),
		"normal"  => "Normal",
		"italic"  => "Italic",
		"oblique" => "Oblique",
		"inherit" => "Inherit"
	);

	return apply_filters( 'origamiez_get_font_families', $font_styles );
}

function origamiez_get_font_weights() {
	$font_weights = array(
		""        => esc_attr__( '-- Default --', 'origamiez' ),
		"normal"  => esc_attr__( 'Normal', 'origamiez' ),
		"bold"    => esc_attr__( 'Bold', 'origamiez' ),
		"bolder"  => esc_attr__( 'Bolder', 'origamiez' ),
		"lighter" => esc_attr__( 'Lighter', 'origamiez' ),
		100       => 100,
		200       => 200,
		300       => 300,
		400       => 400,
		500       => 500,
		600       => 600,
		700       => 700,
		800       => 800,
		900       => 900,
		"inherit" => esc_attr__( 'Inherit', 'origamiez' ),
	);

	return apply_filters( 'origamiez_get_font_weights', $font_weights );
}
