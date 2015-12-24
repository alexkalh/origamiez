<?php

if ( ! is_singular() && current_theme_supports( 'loop-pagination' ) ) {
	global $wp_query, $wp_rewrite;

	$total = $wp_query->max_num_pages;
	if ( $total > 1 ) {
		$current = (intval( get_query_var( 'paged' ) )) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagination_args = array(
			'base'      => add_query_arg( 'paged', '%#%' ),
			'format'    => '',
			'current'   => $current,
			'total'     => $total,
			'end_size'  => 2,
			'mid_size'  => 1,
			'type'      => 'list',
			'prev_next' => true,
			'prev_text' => esc_attr__( 'Previous', 'origamiez' ),
			'next_text' => esc_attr__( 'Next', 'origamiez' ),
		);

		if ( $wp_rewrite->using_permalinks() ) {
			$pagination_args['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ); }

		if ( ! empty( $wp_query->query_vars['s'] ) ) {
			$pagination_args['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) ); }


		echo wp_kses( paginate_links( $pagination_args ), origamiez_get_allowed_tags() );
	}
}
