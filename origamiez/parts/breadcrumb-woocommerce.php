<?php
if ( 1 === (int) get_theme_mod( 'is_display_breadcrumb', 1 ) ) {
	$args = array(
		'delimiter'   => '&nbsp;&rsaquo;&nbsp;',
		'wrap_before' => '<div class="breadcrumb">',
		'wrap_after'  => '</div>'
	);
	woocommerce_breadcrumb( $args );
}