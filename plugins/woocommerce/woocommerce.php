<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if( is_plugin_active( 'woocommerce/woocommerce.php' )){

	add_action('after_setup_theme', 'origamiez_woocommerce_setup', 20);

	function origamiez_woocommerce_setup() {
		add_theme_support( 'woocommerce' );		
			 
		if (!is_admin()) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
			add_filter('loop_shop_columns', 'origamiez_woocommerce_loop_shop_columns');
			add_filter('woocommerce_cart_item_quantity', 'origamiez_woocommerce_cart_item_quantity');
			add_action('wp_enqueue_scripts', 'origamiez_woocommerce_enqueue_scripts', 20);
		}	
	}

	function origamiez_woocommerce_cart_item_quantity($product_quantity){		
		$product_quantity = str_replace('number', 'text', $product_quantity);
		return $product_quantity;
	}

	function origamiez_woocommerce_enqueue_scripts(){
		global $wp_styles, $is_IE;
		$dir   = get_template_directory_uri();
		$affix = ('product' === ORIGAMIEZ_MODE) ? '.min' : '';

		wp_enqueue_style(ORIGAMIEZ_PREFIX . 'touchspin', "{$dir}/plugins/woocommerce/css/touchspin{$affix}.css", array(), NULL);	
		wp_enqueue_style(ORIGAMIEZ_PREFIX . 'woocommerce-style', "{$dir}/plugins/woocommerce/css/style{$affix}.css", array(), NULL);	

		wp_enqueue_script(ORIGAMIEZ_PREFIX . 'touchspin', "{$dir}/plugins/woocommerce/js/touchspin{$affix}.js", array('jquery'), NULL, TRUE);		
		wp_enqueue_script(ORIGAMIEZ_PREFIX . 'woocommerce-init', "{$dir}/plugins/woocommerce/js/woocommerce{$affix}.js", array('jquery'), NULL, TRUE);		
	}


	function origamiez_woocommerce_loop_shop_columns(){
		return 3;
	}
}