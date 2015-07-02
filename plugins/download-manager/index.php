<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(is_plugin_active( 'download-manager/download-manager.php' )){

	add_action('after_setup_theme', 'origamiez_download_manager_theme_setup', 20);

	function origamiez_download_manager_theme_setup() {			
			if (!is_admin()) {
				add_action('wp_enqueue_scripts', 'origamiez_download_manager_enqueue_scripts', 20);
			}
	}

	function origamiez_download_manager_enqueue_scripts(){
		global $post, $wp_styles, $is_IE;
		$dir   = get_template_directory_uri();
		$affix = ('product' === ORIGAMIEZ_MODE) ? '.min' : '';

		wp_enqueue_style(ORIGAMIEZ_PREFIX . 'download-manager-style', "{$dir}/plugins/download-manager/css/style{$affix}.css", array(), NULL);	
	}

}