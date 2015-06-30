<?php

add_action('after_setup_theme', 'origamiez_dw_question_and_answer_theme_setup', 20);

function origamiez_dw_question_and_answer_theme_setup() {
	if(defined('DWQA_DIR')){
		if (!is_admin()) {
			add_action('wp_enqueue_scripts', 'origamiez_dw_question_and_answer_enqueue_scripts', 20);
		}

	}
}

function origamiez_dw_question_and_answer_enqueue_scripts(){
	global $post, $wp_styles, $is_IE;
	$dir    = get_template_directory_uri();
	$suffix = ('product' === ORIGAMIEZ_MODE) ? '.min' : '';

	wp_enqueue_style(ORIGAMIEZ_PREFIX . 'dw_question_and_answer-style', "{$dir}/plugins/dw-question-and-anwser/css/style{$suffix}.css", array(), NULL);	
}