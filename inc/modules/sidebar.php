<?php

$origamiez_sidebars = array(
    'right' => array(
        'title' => __('Right', 'origamiez'),
        'description' => ''
    ),
    'bottom' => array(
        'title' => __('Bottom', 'origamiez'),
        'description' => ''
    ),
    'footer-1' => array(
        'title' => __('Footer 1', 'origamiez'),
        'description' => ''
    ),
    'footer-2' => array(
        'title' => __('Footer 2', 'origamiez'),
        'description' => ''
    ),
    'footer-3' => array(
        'title' => __('Footer 3', 'origamiez'),
        'description' => ''
    ),
    'footer-4' => array(
        'title' => __('Footer 4', 'origamiez'),
        'description' => ''
    ),
    'footer-5' => array(
        'title' => __('Footer 5', 'origamiez'),
        'description' => ''
    ),
);

foreach ($origamiez_sidebars as $id => $sidebar) {
    $name = $sidebar['title'];
    $slug = $id;

    register_sidebar(array(
        'id' => $slug,
        'name' => $name,
        'description' => $sidebar['description'],
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h2 class="widget-title clearfix"><span class="widget-title-text pull-left">',
        'after_title' => '</span></h2><div class="origamiez-widget-content clearfix">'
    ));
}