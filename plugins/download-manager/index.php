<?php

add_action('after_setup_theme', 'origamiez_download_manager_theme_setup', 20);

function origamiez_download_manager_theme_setup() {	
	if(defined('WPDM_Version')){		
		if (!is_admin()) {
			add_action('wp_enqueue_scripts', 'origamiez_download_manager_enqueue_scripts', 20);
		}

	}
}

function origamiez_download_manager_enqueue_scripts(){
	global $post, $wp_styles, $is_IE;
	$dir    = get_template_directory_uri();
	$suffix = ('product' === ORIGAMIEZ_MODE) ? '.min' : '';

	wp_enqueue_style(ORIGAMIEZ_PREFIX . 'download-manager-style', "{$dir}/plugins/download-manager/css/style{$suffix}.css", array(), NULL);	
}