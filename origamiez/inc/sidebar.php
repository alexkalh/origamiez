<?php
$origamiez_sidebars = array(
	'main-top'           => array(
		'title'       => esc_attr__( 'Main Top', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'main-center-top'    => array(
		'title'       => esc_attr__( 'Main Center Top', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'main-center-left'   => array(
		'title'       => esc_attr__( 'Main Center Left', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'main-center-right'  => array(
		'title'       => esc_attr__( 'Main Center Right', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'main-center-bottom' => array(
		'title'       => esc_attr__( 'Main Center Bottom', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'main-bottom'        => array(
		'title'       => esc_attr__( 'Main Bottom', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'left'               => array(
		'title'       => esc_attr__( 'Left', 'origamiez' ),
		'description' => esc_attr__( 'For only page with template: "Page Magazine".', 'origamiez' )
	),
	'right'              => array(
		'title'       => esc_attr__( 'Right', 'origamiez' ),
		'description' => ''
	),
	'bottom'             => array(
		'title'       => esc_attr__( 'Bottom', 'origamiez' ),
		'description' => ''
	),
	'footer-1'           => array(
		'title'       => esc_attr__( 'Footer 1', 'origamiez' ),
		'description' => ''
	),
	'footer-2'           => array(
		'title'       => esc_attr__( 'Footer 2', 'origamiez' ),
		'description' => ''
	),
	'footer-3'           => array(
		'title'       => esc_attr__( 'Footer 3', 'origamiez' ),
		'description' => ''
	),
	'footer-4'           => array(
		'title'       => esc_attr__( 'Footer 4', 'origamiez' ),
		'description' => ''
	),
	'footer-5'           => array(
		'title'       => esc_attr__( 'Footer 5', 'origamiez' ),
		'description' => ''
	),
);
foreach ( $origamiez_sidebars as $id => $sidebar ) {
	$name = $sidebar['title'];
	$slug = $id;
	register_sidebar( array(
		'id'            => $slug,
		'name'          => $name,
		'description'   => $sidebar['description'],
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="widget-title clearfix"><span class="widget-title-text pull-left">',
		'after_title'   => '</span></h2><div class="origamiez-widget-content clearfix">'
	) );
}