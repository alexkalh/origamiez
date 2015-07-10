<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if( is_plugin_active( 'bbpress/bbpress.php' )){

  register_sidebar(array(
      'id'            => 'bbpress_right_sidebar',
      'name'          => __('Right (bbPress)', 'origamiez'),
      'description'   => '',
      'before_widget' => '<div id="%1$s" class="widget origamiez-bbpress-widget %2$s">',
      'after_widget'  => '</div></div>',
      'before_title'  => '<h2 class="widget-title clearfix"><span class="widget-title-text pull-left">',
      'after_title'   => '</span></h2><div class="origamiez-widget-content clearfix">'
  ));

  add_action('after_setup_theme', 'origamiez_bbpress_theme_setup', 5);

  function origamiez_bbpress_theme_setup() {
  	if (!is_admin()) {
  		add_action('wp_enqueue_scripts', 'origamiez_bbpress_enqueue_scripts', 20);
  		add_filter('origamiez_get_current_sidebar', 'origamiez_bbpress_set_sidebar', 20, 2);
  		add_filter('body_class', 'origamiez_bbpress_body_class');

      add_filter('bbp_get_reply_content', 'origamiez_bbpress_shortcodes', 10, 2);
      add_filter('bbp_get_topic_content', 'origamiez_bbpress_shortcodes', 10, 2);
  	}
  }

  function origamiez_bbpress_shortcodes( $content, $reply_id ) { 
    $reply_author = bbp_get_reply_author_id( $reply_id );
    
    if(user_can( $reply_author, 'publish_forums')){
      $content = do_shortcode( $content );
    }
      
    return $content;
  }

  function origamiez_bbpress_enqueue_scripts(){
  	global $post, $wp_styles, $is_IE;
      $dir = get_template_directory_uri();
      $affix = ('product' === ORIGAMIEZ_MODE) ? '.min' : '';


       wp_enqueue_style(ORIGAMIEZ_PREFIX . 'bbpress-style', "{$dir}/plugins/bbpress/css/style{$affix}.css", array(), NULL);       
       wp_enqueue_style(ORIGAMIEZ_PREFIX . 'bbpress-typography', "{$dir}/plugins/bbpress/css/typography{$affix}.css", array(), NULL);


       if ('custom' == get_theme_mod('skin', 'default')) {      
       	$custom_color = '
          #bbpress-forums ul.bbp-forums,
          #bbpress-forums ul.bbp-topics,
          #bbpress-forums ul.bbp-replies,
          #bbpress-forums ul.bbp-search-results {
            border: none; }
          #bbpress-forums .bbp-forum-info .bbp-forum-title {
            color: %1$s; }
          #bbpress-forums li.bbp-header {
            background-color: %3$s;
            border-top: 2px solid %1$s;
            border-bottom: none; }
          #bbpress-forums li.bbp-footer {
            border-bottom: 1px solid %2$s; }
          #bbpress-forums #subscription-toggle a {
            color: %1$s !important; }
          #bbpress-forums .bbp-topic-title .bbp-topic-permalink {
            color: %1$s !important; }
          #bbpress-forums .bbp-reply-form fieldset.bbp-form,
          #bbpress-forums .bbp-topic-form fieldset.bbp-form {
            border: none; }
            #bbpress-forums .bbp-reply-form fieldset.bbp-form legend,
            #bbpress-forums .bbp-topic-form fieldset.bbp-form legend {
              border-bottom: none; }
            #bbpress-forums .bbp-reply-form fieldset.bbp-form #bbp_topic_status_select,
            #bbpress-forums .bbp-reply-form fieldset.bbp-form #bbp_stick_topic_select,
            #bbpress-forums .bbp-reply-form fieldset.bbp-form #bbp_topic_tags,
            #bbpress-forums .bbp-reply-form fieldset.bbp-form #bbp_topic_title,
            #bbpress-forums .bbp-reply-form fieldset.bbp-form .wp-editor-container,
            #bbpress-forums .bbp-topic-form fieldset.bbp-form #bbp_topic_status_select,
            #bbpress-forums .bbp-topic-form fieldset.bbp-form #bbp_stick_topic_select,
            #bbpress-forums .bbp-topic-form fieldset.bbp-form #bbp_topic_tags,
            #bbpress-forums .bbp-topic-form fieldset.bbp-form #bbp_topic_title,
            #bbpress-forums .bbp-topic-form fieldset.bbp-form .wp-editor-container {
              border: 1px solid %2$s; }
          #bbpress-forums .bbp-submit-wrapper .button.submit {
            background-color: %1$s;
            color: %3$s;
            border: 1px solid %1$s; }
            #bbpress-forums .bbp-submit-wrapper .button.submit:hover {
              background-color: %3$s;
              color: %1$s; }
          #bbpress-forums div.bbp-forum-header,
          #bbpress-forums div.bbp-topic-header,
          #bbpress-forums div.bbp-reply-header {
            border-top: 1px solid %2$s; }
          #bbpress-forums div.bbp-forum-author img.avatar,
          #bbpress-forums div.bbp-topic-author img.avatar,
          #bbpress-forums div.bbp-reply-author img.avatar {
            padding: 1px;
            border: 1px solid %2$s; }

          #bbp-search-form #bbp_search {
            border: 1px solid %2$s; }
          #bbp-search-form #bbp_search_submit {
            border: 1px solid %1$s;
            background: %1$s;
            color: %3$s; }
            #bbp-search-form #bbp_search_submit:hover {
              background: %3$s;
              color: %1$s; }

          .widget.bbp_widget_login .bbp-login-form input[type=text],
          .widget.bbp_widget_login .bbp-login-form input[type=password] {
            border: 1px solid %2$s; }
          .widget.bbp_widget_login .bbp-login-form #user-submit {
            border: 1px solid %1$s;
            background-color: %1$s;
            color: %3$s; }
            .widget.bbp_widget_login .bbp-login-form #user-submit:hover {
              background-color: %3$s;
              color: %1$s; }

          .widget.widget_display_stats dd {
            color: %1$s; }';     	

        $custom_color = sprintf($custom_color, 
    			get_theme_mod('primary_color', '#E74C3C'), //1
    			get_theme_mod('line_2_color', '#DDDDDD'), //2
    			'#FFFFFF' //3 :white;
    		);

    		wp_add_inline_style(ORIGAMIEZ_PREFIX . 'bbpress-style', $custom_color);
      }else{
        wp_enqueue_style(ORIGAMIEZ_PREFIX . 'bbpress-color', "{$dir}/plugins/bbpress/css/color{$affix}.css", array(), NULL);
      }

      $font_body = get_theme_mod('font_body');
      if(isset($font_body['font-size']) && !empty($font_body['font-size'])){
      	$custom_font = '
          body.bbpress #sidebar-center > .breadcrumb {
            display: none; }
          body.bbpress div.bbp-breadcrumb,
          body.bbpress div.bbp-topic-tags,
          body.bbpress .bbp-reply-content {
            font-size: %1$s; }
          body.bbpress div.bbp-breadcrumb{
            text-transform: uppercase;
          }  
          #bbpress-forums {
            font-size: %1$s; }
            #bbpress-forums .bbp-forum-info .bbp-forum-title,
            #bbpress-forums .bbp-forum-info .bbp-forum-content {
              font-size: %1$s; }
            #bbpress-forums .bbp-forum-info .bbp-forum-title {
              text-transform: uppercase; }
            #bbpress-forums .bbp-topic-title .bbp-topic-permalink {
              font-size: %1$s; }
            #bbpress-forums .bbp-topic-title .bbp-topic-meta {
              font-size: %2$s; }
            #bbpress-forums li.bbp-header,
            #bbpress-forums li.bbp-footer {
              font-size: %2$s;
              text-transform: uppercase;
              font-weight: normal; }
            #bbpress-forums li.bbp-header .bbp-reply-content {
              text-transform: uppercase;
              font-size: %2$s;
              font-weight: normal; }
              #bbpress-forums li.bbp-header .bbp-reply-content #subscription-toggle,
              #bbpress-forums li.bbp-header .bbp-reply-content #favorite-toggle {
                font-size: %2$s; }
            #bbpress-forums .bbp-reply-form #bbp_topic_title,
            #bbpress-forums .bbp-topic-form #bbp_topic_title {
              line-height: 30px; }
            #bbpress-forums .bbp-submit-wrapper .button.submit {
              line-height: 45px; }

          .widget.widget_display_stats dt {
            font-weight: normal; }
          .widget.widget_display_stats dd {
            font-style: italic; }
          ';

    	$custom_font = sprintf($custom_font, $font_body['font-size'], (int)$font_body['font-size'] - 1 . 'px');	
    	wp_add_inline_style(ORIGAMIEZ_PREFIX . 'bbpress-typography', $custom_font);
      }		
  }

  function origamiez_bbpress_set_sidebar($sidebar, $position){
  	if('right' == $position){
  		global $post;					
  		$tax = get_queried_object();	
  		
  		if(is_singular('topic') || 
  		is_singular('forum') || 
  		is_post_type_archive('forum') || 
  		is_post_type_archive('topic') || 
  		(isset($tax->taxonomy) && in_array($tax->taxonomy, array('topic-tag'))) ||
  		bbp_is_search()
  		){
  			$sidebar = 'bbpress_right_sidebar';			
  		}		
  	}	

  	return $sidebar;
  }

  function origamiez_bbpress_body_class($classes){
  	global $post;					

  	$tax = get_queried_object();	
  	$query_action =  isset($_REQUEST['action']) ? $_REQUEST['action'] : NULL;

  	if(is_singular('topic') || 
  		is_singular('forum') || 
  		is_post_type_archive('forum') || 
  		is_post_type_archive('topic') || 
  		(isset($tax->taxonomy) && in_array($tax->taxonomy, array('topic-tag'))) ||
  		bbp_is_search()
  		){
  		array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single');
  	}

  	return $classes;
  }

}