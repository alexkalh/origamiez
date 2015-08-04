<?php

require_once ABSPATH . 'wp-admin/includes/plugin.php';

if( is_plugin_active( 'woocommerce/woocommerce.php' )){

	add_action('after_setup_theme', 'origamiez_woocommerce_setup', 20);

	function origamiez_woocommerce_setup() {
		add_theme_support('woocommerce');		
			 
		if (!is_admin()) {
			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
			add_filter('loop_shop_columns', 'origamiez_woocommerce_loop_shop_columns');
			add_filter('loop_shop_per_page',  'origamiez_woocommerce_loop_shop_per_page');
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

		wp_enqueue_style(ORIGAMIEZ_PREFIX . 'touchspin', "{$dir}/plugins/woocommerce/css/touchspin.css", array(), NULL);	
		wp_enqueue_style(ORIGAMIEZ_PREFIX . 'woocommerce-style', "{$dir}/plugins/woocommerce/css/style.css", array(), NULL);		
		wp_enqueue_style(ORIGAMIEZ_PREFIX . 'woocommerce-typography', "{$dir}/plugins/woocommerce/css/typography.css", array(), NULL);
		wp_enqueue_script(ORIGAMIEZ_PREFIX . 'touchspin', "{$dir}/plugins/woocommerce/js/touchspin.js", array('jquery'), NULL, TRUE);		
		wp_enqueue_script(ORIGAMIEZ_PREFIX . 'woocommerce-init', "{$dir}/plugins/woocommerce/js/woocommerce.js", array('jquery'), NULL, TRUE);		

		if ('custom' == get_theme_mod('skin', 'default')) {
			$custom_color = '
				body.woocommerce-page nav.woocommerce-pagination ul {
				  border: none !important;
				}
				body.woocommerce-page nav.woocommerce-pagination ul > li {
				  border-right: none !important;
				}
				body.woocommerce-page nav.woocommerce-pagination ul > li a:hover,
				body.woocommerce-page nav.woocommerce-pagination ul > li span:hover,
				body.woocommerce-page nav.woocommerce-pagination ul > li span.current {
				  background-color: transparent;
				  color: %1$s;
				}
				body.woocommerce-page ul.products li.product {
				  border: none;
				  background-color: %2$s;
				}
				body.woocommerce-page ul.products li.product > .added_to_cart {
				  background-color: %3$s;
				  color: white;
				}
				body.woocommerce-page ul.products li.product .price {
				  color: %1$s;
				}
				body.woocommerce-page ul.products li.product .price > .amount,
				body.woocommerce-page ul.products li.product .price ins > .amount {
				  color: %1$s;
				}
				body.woocommerce-page ul.products li.product .onsale {
				  background-color: white;
				  color: %3$s;
				  border-right: 3px solid %3$s;
				  transition: background-color 0.5px;
				  -ms-transition: background-color 0.5px;
				  -webkit-transition: background-color 0.5px;
				  -moz-transition: background-color 0.5px;
				}
				body.woocommerce-page ul.products li.product .onsale:hover {
				  background-color: %3$s;
				  color: white;
				}
				body.woocommerce-page form.woocommerce-ordering .orderby {
				  border: 1px solid %4$s;
				}
				body.woocommerce-page table.shop_table.cart td.product-remove {
				  text-align: center;
				}
				body.woocommerce-page table.shop_table.cart td.product-remove .remove {
				  display: inline-block;
				  *display: inline;
				  zoom: 1;
				}
				body.woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout .button {
				  background-color: %3$s;
				  color: white;
				  border: 1px solid %3$s;
				}
				body.woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout .button:hover {
				  background-color: white;
				  color: %3$s;
				}
				body.woocommerce-page .woocommerce-info,
				body.woocommerce-page .woocommerce-message {
				  border-top-color: %3$s;
				}
				body.woocommerce-page .woocommerce-info::before,
				body.woocommerce-page .woocommerce-message::before {
				  color: %3$s;
				}
				body.woocommerce-page .input-group-btn-vertical {
				  border-top: 1px solid %4$s;
				  border-bottom: 1px solid %4$s;
				  border-right: 1px solid %4$s;
				}
				body.woocommerce-page .bootstrap-touchspin-up {
				  border-bottom: 1px solid %4$s;
				}
				body.woocommerce-page .bootstrap-touchspin-up:hover, body.woocommerce-page .bootstrap-touchspin-up:focus, body.woocommerce-page .bootstrap-touchspin-up:active,
				body.woocommerce-page .bootstrap-touchspin-down:hover,
				body.woocommerce-page .bootstrap-touchspin-down:focus,
				body.woocommerce-page .bootstrap-touchspin-down:active {
				  background-color: white !important;
				  color: %1$s;
				}
				body.woocommerce-page form.checkout.woocommerce-checkout input.input-text {
				  border: 1px solid %4$s;
				}
				body.woocommerce-page form.checkout.woocommerce-checkout textarea {
				  border: 1px solid %4$s;
				}
				body.woocommerce-page form.checkout.woocommerce-checkout #place_order {
				  background-color: %3$s;
				  color: white;
				  border: 1px solid %3$s;
				}
				body.woocommerce-page form.checkout.woocommerce-checkout #place_order:hover {
				  background-color: white;
				  color: %3$s;
				}
				body.woocommerce-page .select2-choice {
				  border: 1px solid %4$s;
				}
				body.woocommerce-page .select2-drop-active {
				  border-color: #dddddd !important;
				}
				body.woocommerce-page table.shop_table .button.view {
				  background-color: %1$s;
				  border: 1px solid %1$s;
				  color: white;
				}
				body.woocommerce-page table.shop_table .button.view:hover {
				  background-color: white;
				  color: %1$s;
				}
				body.woocommerce-page.single form.variations_form.cart select {
				  border: 1px solid %4$s;
				}
				body.woocommerce-page .woocommerce-tabs #tab-description,
				body.woocommerce-page .woocommerce-tabs #tab-reviews {
				  border: none !important;
				}
				body.woocommerce-page #review_form_wrapper #submit {
				  background-color: %1$s;
				  border: 1px solid %1$s;
				  color: white;
				}
				body.woocommerce-page #review_form_wrapper #submit:hover {
				  background-color: white;
				  color: %1$s;
				}
				body.woocommerce-page #review_form_wrapper #author,
				body.woocommerce-page #review_form_wrapper #email {
				  border: 1px solid %4$s;
				}
				body.woocommerce-page #review_form_wrapper textarea {
				  border: 1px solid %4$s;
				}

				/*
				WIDGETS
				--------------------
				The styling for dedault woocommerce  widgets.
				--------------------*/
				.widget.woocommerce.widget_shopping_cart ul.cart_list li {
				  border-bottom: 1px solid %4$s;
				}
				.widget.woocommerce.widget_shopping_cart .total {
				  border-top: 1px solid %4$s;
				}
				.widget.woocommerce.widget_shopping_cart .buttons .button.wc-forward {
				  border: 1px solid %4$s;
				}
				.widget.woocommerce.widget_shopping_cart .buttons .button.wc-forward.checkout {
				  background-color: %3$s;
				  color: white;
				  border: 1px solid %3$s;
				  border-color: %3$s;
				}
				.widget.woocommerce.widget_shopping_cart .buttons .button.wc-forward.checkout:hover {
				  background-color: white;
				  color: %3$s;
				}

				.widget.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
				.widget.woocommerce.widget_price_filter .ui-slider .ui-slider-range {
				  background-color: %1$s;
				}
				.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content {
				  background-color: %4$s;
				}
				.widget.woocommerce.widget_price_filter .price_slider_amount .button {
				  border: 1px solid %4$s;
				}

				.widget.woocommerce.widget_product_search .search-field,
				.widget.woocommerce.widget_product_search input[type="submit"] {
				  border: 1px solid %4$s;
				}

				.widget.woocommerce.widget_top_rated_products .product_list_widget li,
				.widget.woocommerce.widget_recently_viewed_products .product_list_widget li,
				.widget.woocommerce.widget_recent_reviews .product_list_widget li {
				  border-bottom: 1px solid %4$s;
				}
				.widget.woocommerce.widget_top_rated_products .product_list_widget .amount,
				.widget.woocommerce.widget_recently_viewed_products .product_list_widget .amount,
				.widget.woocommerce.widget_recent_reviews .product_list_widget .amount {
				  color: %1$s;
				}
				.widget.woocommerce.widget_top_rated_products .product_list_widget del > .amount,
				.widget.woocommerce.widget_recently_viewed_products .product_list_widget del > .amount,
				.widget.woocommerce.widget_recent_reviews .product_list_widget del > .amount {
				  color: black;
				}';
			
			$custom_color = sprintf($custom_color, 
    			get_theme_mod('primary_color', '#E74C3C'),
    			get_theme_mod('secondary_color', '#F9F9F9'),
    			'#4caf50',
    			get_theme_mod('line_2_color', '#DDDDDD')
    		);

    		wp_add_inline_style(ORIGAMIEZ_PREFIX . 'woocommerce-style', $custom_color);
		}else{
			wp_enqueue_style(ORIGAMIEZ_PREFIX . 'woocommerce-color', "{$dir}/plugins/woocommerce/css/color.css", array(), NULL);
		}
	}

	function origamiez_woocommerce_loop_shop_columns(){
		return 3;
	}

	function origamiez_woocommerce_loop_shop_per_page(){
		return 12;
	}
}