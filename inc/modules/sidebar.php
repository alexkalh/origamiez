<?php

$ct_sidebars = array(
    'right' => array(
        'title' => __('Right', ct_get_domain()),
        'description' => ''
    ),
    'bottom' => array(
        'title' => __('Bottom', ct_get_domain()),
        'description' => ''
    ),
    'footer-1' => array(
        'title' => __('Footer 1', ct_get_domain()),
        'description' => ''
    ),
    'footer-2' => array(
        'title' => __('Footer 2', ct_get_domain()),
        'description' => ''
    ),
    'footer-3' => array(
        'title' => __('Footer 3', ct_get_domain()),
        'description' => ''
    ),
    'footer-4' => array(
        'title' => __('Footer 4', ct_get_domain()),
        'description' => ''
    ),
    'footer-5' => array(
        'title' => __('Footer 5', ct_get_domain()),
        'description' => ''
    ),
);

foreach ($ct_sidebars as $id => $sidebar) {
    $name = $sidebar['title'];
    $slug = $id;

    register_sidebar(array(
        'id' => $slug,
        'name' => $name,
        'description' => $sidebar['description'],
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h2 class="widget-title clearfix"><span class="widget-title-text pull-left">',
        'after_title' => '</span></h2><div class="ct-widget-content clearfix">'
    ));
}