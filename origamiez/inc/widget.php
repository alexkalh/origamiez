<?php
get_template_part( 'parts/widgets/posts-list', 'grid' );
get_template_part( 'parts/widgets/posts-list', 'slider' );
get_template_part( 'parts/widgets/posts-list', 'small' );
get_template_part( 'parts/widgets/posts-list', 'zebra' );
get_template_part( 'parts/widgets/posts-list', 'two-cols' );
get_template_part( 'parts/widgets/posts-list', 'with-background-color' );
get_template_part( 'parts/widgets/posts-list', 'with-format-icon' );
get_template_part( 'parts/widgets/social', 'links' );
function origamiez_dynamic_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$widget_id  = $params[0]['widget_id'];
	$widget_obj = $wp_registered_widgets[ $widget_id ];
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	$widget_num = $widget_obj['params'][0]['number'];
	if ( ! isset( $widget_opt[ $widget_num ]['title'] ) || ( isset( $widget_opt[ $widget_num ]['title'] ) && empty( $widget_opt[ $widget_num ]['title'] ) ) ) {
		$params[0]['before_widget'] .= '<div class="origamiez-widget-content clearfix">';
		$params[0]['before_title']  = '<h2 class="widget-title clearfix"><span class="widget-title-text pull-left">';
		$params[0]['after_title']   = '</span></h2>';
	}

	return $params;
}