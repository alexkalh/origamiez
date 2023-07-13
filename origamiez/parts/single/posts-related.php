<?php
if ( ( 1 === (int) get_theme_mod( 'is_show_post_related', 1 ) ) && is_single() ) {
	$single_post_related_layout = get_theme_mod( 'single_post_related_layout', 'flat-list' );
	if ( $single_post_related_layout ) {
		get_template_part( 'parts/single/related/related', $single_post_related_layout );
	}
}