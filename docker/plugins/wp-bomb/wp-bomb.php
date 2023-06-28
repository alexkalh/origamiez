<?php
/**
 * Plugin Name: WP Bomb
 * Plugin URI: https://github.com/tranthethang/WP-Bomb
 * Description: Tons of utility for WordPress developers.
 * Version: 1.0
 * Author: tranthethang
 * Author URI: https://github.com/tranthethang
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * WP Bomb plugin, Copyright 2014 tranthethang
 * WP Bomb is distributed under the terms of the GNU GPL
 *
 * Requires at least: 4.1
 * Tested up to: 4.5.2
 * Text Domain: wp-bomb
 * Domain Path: /languages/
 *
 * @package WP Bomb 
 */

function bomb_log( $log ) {
	if ( WP_DEBUG === true ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}

function bomb_auto_thumbs( $min=0, $max=0, $items=array(), $types=array('post') ){
	if( $min && $max ){
		$items = array();
		for( $i=$min; $i<=$max; $i++ ){
			$items[] = $i;
		}
	}

	if( empty( $types ) ){
		$types = _bomb_get_types();
	}

	$posts = new WP_Query( 
		array( 
			'post_type'      => $types, 
			'posts_per_page' => -1
		) 
	);

	$index = 0;

	while ($posts->have_posts()):
	    $posts->the_post();

	    set_post_thumbnail(get_the_ID(), (int)$items[$index]);

	    if ($index == count($items) - 1)
	        $index = 0;
	    else
	        $index++;
	endwhile;

	wp_reset_postdata();
}

function bomb_auto_set_term( $types=array('post'), $terms=array(), $taxonomy ){
	if( empty( $types ) ){
		$types = _bomb_get_types();
	}
	
	$posts = new WP_Query( 
		array( 
			'post_type'      => $types, 
			'posts_per_page' => -1
		) 
	);	
	
	while ( $posts->have_posts() ){
	    $posts->the_post();	
		wp_set_post_terms( get_the_ID(), $terms, $taxonomy, true );	
	}

	wp_reset_postdata();	
}

function bomb_clone_post_field( $source_id, $types=array('post'), $field_name ){
	if( empty( $source_id ) ){ return; }

	if( empty( $types ) ){
		$types = _bomb_get_types();
	}

	$content = get_post_field( $field_name, $source_id );
	
	if( $content ){
		$posts = new WP_Query( 
			array( 
				'post_type'      => $types, 
				'posts_per_page' => -1,
				'post__not_in'   => array( $source_id )
			) 
		);

		while ( $posts->have_posts() ){
		    $posts->the_post();
		    
		    $_post = array(
				'ID'        => get_the_ID(),				
				$field_name => $content
		    );

		    wp_update_post( $_post );
		}

		wp_reset_postdata();
	}
}

function bomb_clone_post_meta( $source_id, $types=array('post'), $meta_key, $single=true ){
	if( empty( $source_id ) ){ return; }

	if( empty( $types ) ){
		$types = _bomb_get_types();
	}

	$meta_value = get_post_meta( $source_id, $meta_key, $single );
	
	$posts = new WP_Query( 
		array( 
			'post_type'      => $types, 
			'posts_per_page' => -1,
			'post__not_in'   => array( $source_id )
		) 
	);

	while ( $posts->have_posts() ){
	    $posts->the_post();
	    update_post_meta( get_the_ID(), $meta_key, $meta_value );	   	   
	}

	wp_reset_postdata();
}

function _bomb_get_types(){
	$types   = array();
	$types[] = 'post';
	$types[] = 'portfolio';
	$types[] = 'staff';
	$types[] = 'slide';
	$types[] = 'testimonial';
	$types[] = 'brand';
	$types[] = 'event';
	$types[] = 'service';
	$types[] = 'client';
	$types[] = 'download';
	$types[] = 'faq';
	$types[] = 'music';
	$types[] = 'skill';

	return $types;
}

function bomb_list_hooked( $tag = false ){
	global $wp_filter;

	if ( $tag ) {
		$hook[$tag] = $wp_filter[$tag];
		if ( !is_array( $hook[$tag] ) ) {
			trigger_error( "Nothing found for '$tag' hook", E_USER_WARNING );
			return;
		}
	} else {
		$hook = $wp_filter;
		ksort( $hook );
	}

	echo '<pre>';

	foreach($hook as $tag => $priority){
		echo "<h3><strong>$tag</strong></h3>";
		ksort( $priority );
		foreach( $priority as $priority => $function ){
			echo $priority;
			foreach($function as $name => $properties) {
				echo "$name<br/>"; 
			}
		}
	}

	echo '</pre>';

	return;
}