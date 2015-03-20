<?php

function ct_wp_head() {
    $favicon = ot_get_option('favicon', false);
    if ($favicon) {
        printf('<link rel="shortcut icon" type="image/png" href="%s">', $favicon);
    }    
    
    $apple_icon = ot_get_option('apple_icon', false);
    if ($apple_icon){
      foreach (array(60, 76, 120, 152) as $size) {          
          printf('<link rel="apple-touch-icon" sizes="%1$sx%1$s" href="%2$s">', $size, $apple_icon);
      }
    }
}

function ct_wp_footer() {
    if (is_single()) {
        wp_nonce_field('ct_set_view', 'ajax_nonce_ct_set_view');
    }
}

function ct_render_title(){
?>
  <title><?php wp_title('|', true, 'right'); ?></title>
<?php
}

function ct_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    $title .= get_bloginfo('name', 'display');

    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }

    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', ct_get_domain()), max($paged, $page));
    }
    return $title;
}

function ct_enqueue_scripts() {
    global $post, $wp_styles, $is_IE;
    $dir = get_template_directory_uri();
    $suffix = ('product' === CT_MODE) ? '.min' : '';
    
    /*
     * --------------------------------------------------
     * STYLESHEETS    
     * --------------------------------------------------
     */
    
    //BOOTSTRAP
    wp_enqueue_style(CT_PREFIX . 'bootstrap', "{$dir}/css/bootstrap{$suffix}.css", array(), NULL);
    wp_enqueue_style(CT_PREFIX . 'bootstrap-theme', "{$dir}/css/bootstrap-theme{$suffix}.css", array(), NULL);

    //FONT AWESOME
    wp_enqueue_style(CT_PREFIX . 'font-awesome', "{$dir}/css/font-awesome{$suffix}.css", array(), NULL);

    //SUPERFISH
    wp_enqueue_style(CT_PREFIX . 'superfish', "{$dir}/css/superfish{$suffix}.css", array(), NULL);

    //OWL CAROUSEL
    wp_enqueue_style(CT_PREFIX . 'owl-transitions', "{$dir}/css/owl.transitions{$suffix}.css", array(), NULL);
    wp_enqueue_style(CT_PREFIX . 'owl-carousel', "{$dir}/css/owl.carousel{$suffix}.css", array(), NULL);
    wp_enqueue_style(CT_PREFIX . 'owl-theme', "{$dir}/css/owl.theme{$suffix}.css", array(), NULL);

    //BACKGROUND SLIDESHOW
    wp_enqueue_style(CT_PREFIX . 'jquery-vegas', "{$dir}/css/jquery.vegas{$suffix}.css", array(), NULL);

    //POPTROX POPUP
    wp_enqueue_style(CT_PREFIX . 'jquery-poptrox', "{$dir}/css/jquery.poptrox{$suffix}.css", array(), NULL);

    //MOBILE MENU
    wp_enqueue_style(CT_PREFIX . 'slidebars', "{$dir}/css/slidebars{$suffix}.css", array(), NULL);

    //STYLE        
    wp_enqueue_style(CT_PREFIX . 'style', get_stylesheet_uri(), array(), NULL);

    //RESPONSIVE        
    wp_enqueue_style(CT_PREFIX . 'responsive', "{$dir}/css/responsive{$suffix}.css", array(), NULL);

    //FONT & COLOR    
    $skin = ot_get_option('skin', 'default');
    wp_enqueue_style(CT_PREFIX . 'typography', "{$dir}/typography/default{$suffix}.css", array(), NULL);
    if ('custom' != $skin) {      
      wp_enqueue_style(CT_PREFIX . 'color', "{$dir}/skin/{$skin}{$suffix}.css", array(), NULL);        
    } else{
      $custom_color = '
          /*
           * --------------------------------------------------
           * SKELETON
           * --------------------------------------------------
           */
          body {
            color: %1$s;
          }

          a {
            color: %3$s;
          }
          a:hover {
            color: %4$s;
          }

          h1, h2, h3, h4, h5, h6 {
            color: %2$s;
          }
          h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
            color: %2$s;
          }

          #ct-header {
            background: %15$s;
            border-bottom: 1px solid %8$s;
          }

          #ct-header-bottom {
            border-bottom: 1px solid %8$s;
          }

          #ct-header-bar-inner {
            border-bottom: 1px solid %8$s;
          }

          #main-nav {
            background: %15$s;
            border-top: 1px solid %8$s;
          }
          #main-nav.stuckMenu.isStuck {
            background-color: %15$s;
            border-bottom: 1px solid %8$s;
          }
          #main-nav.stuckMenu.isStuck .main-menu {
            border-bottom: 1px solid %8$s;
          }

          #main-menu a {
            color: %6$s;
          }
          #main-menu > li.current-menu-item > a {
            color: %4$s;
          }
          #main-menu > li:hover > a {
            color: %4$s;
          }
          #main-menu li ul {
            border-top: 3px solid %4$s;
            border-left: 1px solid %8$s;
            border-right: 1px solid %8$s;
            border-bottom: 1px solid %8$s;
            background: %15$s;
          }
          #main-menu li ul li {
            border-bottom: 1px solid %8$s;
          }
          #main-menu li ul li a {
            color: %1$s;
          }
          #main-menu li ul li:hover > a {
            color: %4$s;
          }

          #ct-body-inner {
            background: %15$s;
          }

          .ct-col-right {
            border-left: 1px solid %8$s;
          }

          #ct-footer-sidebars {
            /*border-top: 1px solid $line-1-bg-color;*/
            border-top: none;
            background-color: %10$s;
          }

          #ct-footer-end {
            background-color: %13$s;
            color: %14$s;
          }

          #bottom-menu li a {
            color: %14$s;
            border-left: 1px solid %14$s;
          }
          #bottom-menu li a:hover {
            color: %4$s;
          }
          #bottom-menu li:first-child a {
            border-left: none;
          }

          /*
           * --------------------------------------------------
           * HEADLINE
           * --------------------------------------------------
           */
          #ct-headline-ticker .ct-headline-caption {
            background-color: %15$s;
            color: %4$s;
          }
          #ct-headline-ticker .ct-headline-caption > span {
            border-right: 1px solid %8$s;
          }
          #ct-headline-ticker #ct-ticker a time {
            color: %4$s;
          }

          /*
           * --------------------------------------------------
           * SIDEBAR RIGHT
           * --------------------------------------------------
           */
          /*
           * --------------------------------------------------
           * SIDEBAR CENTER
           * --------------------------------------------------
           */
          #sidebar-center {
            border-right: 1px solid %8$s;
            background-color: %15$s;
          }
          #sidebar-center .widget {
            margin-top: -1px;
            border-top: 1px solid %8$s;
          }

          /*
           * --------------------------------------------------
           * SIDEBAR BOTTOM
           * --------------------------------------------------
           */
          #sidebar-bottom {
            border-top: 1px solid %8$s;
          }

          #ct-footer-sidebars h2.widget-title {
            color: %12$s;
          }
          #ct-footer-sidebars .ct-widget-content {
            color: %11$s;
          }
          #ct-footer-sidebars .ct-widget-content a {
            color: %11$s;
          }
          #ct-footer-sidebars .widget.widget_calendar caption {
            border-bottom-color: %7$s;
          }
          #ct-footer-sidebars .widget.widget_tag_cloud .ct-widget-content a {
            color: %15$s;
            background-color: %7$s;
          }

          /*
           * --------------------------------------------------
           * SEARCH FORM
           * --------------------------------------------------
           */
          form.search-form .search-text {
            border: 1px solid %8$s;
          }
          form.search-form .search-submit {
            background-color: %15$s;
            color: %17$s;
          }

          /*
           * --------------------------------------------------
           * MOBILE MENU
           * --------------------------------------------------
           */
          body.without_bg_slides {
            background: %15$s;
          }
          body.without_bg_slides #sb-site,
          body.without_bg_slides .sb-site-container {
            background: %15$s;
          }

          .ct-mobile-icon {
            background-color: %4$s;
            color: %15$s;
          }

          .sb-slidebar {
            background-color: %10$s;
          }

          #mobile-menu a {
            color: %11$s;
          }
          #mobile-menu li {
            border-top: 1px solid %7$s;
          }
          #mobile-menu > li:first-child {
            border-top: none;
          }

          /*
           * --------------------------------------------------
           * MOBILE SEARCH
           * --------------------------------------------------
           */
          .sb-slidebar.sb-right {
            color: %11$s;
          }
          .sb-slidebar.sb-right a {
            color: %11$s;
          }
          .sb-slidebar.sb-right .widget-title {
            border-color: %7$s;
            color: %4$s;
          }
          .sb-slidebar.sb-right form.search-form .search-text {
            border-color: %7$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET
           * --------------------------------------------------
           */
          h2.widget-title {
            border-bottom: 1px solid %8$s;
          }

          #ct-body .widget-title-text {
            border-bottom: 1px solid %4$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET CATEGORIES | ARCHIVES (WP DEFAULT)
           * --------------------------------------------------
           */
          .widget.widget_archive select,
          .widget.widget_categories select {
            border: 1px solid %8$s;
          }

          .widget.widget_rss ul li:before {
            color: %24$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET POSTS MINIMALIST
           * --------------------------------------------------
           */
          .widget.ct-widget-posts-minimalist .ct-widget-content .ct-wp-m-post {
            border-top: 1px dashed %7$s;
          }
          .widget.ct-widget-posts-minimalist .ct-widget-content .ct-wp-m-post.ct-wp-m-post-first {
            border-top: none;
          }
          .widget.ct-widget-posts-minimalist .ct-widget-content .ct-wp-m-post h5 a {
            color: %11$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET POSTS TWEETS
           * --------------------------------------------------
           */
          .widget.ct-widget-tweets .ct-widget-content .ct-wp-m-tweet {
            border-top: 1px solid %7$s;
          }
          .widget.ct-widget-tweets .ct-widget-content .ct-wp-m-tweet:hover .fa-twitter {
            color: %21$s;
          }
          .widget.ct-widget-tweets .ct-widget-content .ct-wp-m-tweet.ct-wp-m-tweet-first {
            border-top: none;
          }
          .widget.ct-widget-tweets .ct-widget-content .ct-wp-m-tweet p.ct-wp-m-tweet-content a {
            color: %4$s;
          }

          #ct-body .widget.ct-widget-tweets .ct-widget-content .ct-wp-m-tweet {
            border-top-color: %8$s;
          }
          #ct-body .widget.ct-widget-tweets .ct-widget-content .fa-twitter {
            color: %21$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET NEWSLETTER
           * --------------------------------------------------
           */
          .widget.ct-widget-newsletter p.newsletter-form input[type=text] {
            background: %10$s;
            border: 1px solid %7$s;
          }
          .widget.ct-widget-newsletter p.newsletter-form button[type=submit] {
            border: 1px solid %7$s;
            background: %7$s;
            color: %5$s;
          }
          .widget.ct-widget-newsletter p.newsletter-form:hover input[type=text] {
            border: 1px solid %4$s;
            color: %15$s;
          }
          .widget.ct-widget-newsletter p.newsletter-form:hover button[type=submit] {
            border: 1px solid %4$s;
            background: %4$s;
            color: %15$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET POSTS SMALL THUMBNAIL
           * --------------------------------------------------
           */
          .widget.ct-widget-posts-small-thumbnail .ct-widget-content .ct-wp-mt-post {
            border-top: 1px solid %8$s;
          }
          .widget.ct-widget-posts-small-thumbnail .ct-widget-content .ct-wp-mt-post.ct-wp-mt-post-first {
            border-top: none;
          }

          /*
           * --------------------------------------------------
           * WIDGET POSTS GRID
           * --------------------------------------------------
           */
          .widget.ct-widget-posts-grid .ct-widget-content .row.row-first .ct-wp-grid-post {
            border-top: none;
          }
          .widget.ct-widget-posts-grid .ct-widget-content .row .ct-wp-grid-post {
            border-top: 1px solid %8$s;
            border-left: 1px solid %8$s;
            border-right: 1px solid %8$s;
            margin-left: -1px;
          }
          .widget.ct-widget-posts-grid .ct-widget-content .row .ct-wp-grid-post.ct-wp-grid-post-first {
            border-left: none;
          }
          .widget.ct-widget-posts-grid .ct-widget-content .row .ct-wp-grid-post.ct-wp-grid-post-last {
            border-right: none;
          }

          /*
           * --------------------------------------------------
           * WIDGET TAGS (WP DEFAULT)
           * --------------------------------------------------
           */
          .widget.widget_tag_cloud .tagcloud a {
            background-color: %5$s;
          }
          .widget.widget_tag_cloud .tagcloud a:hover {
            background-color: %4$s;
            color: %15$s;
          }

          /*
           * --------------------------------------------------
           * WIDGET CALENDAR (WP DEFAULT)
           * --------------------------------------------------
           */
          .widget_calendar caption {
            border-bottom: 1px solid %8$s;
          }
          .widget_calendar tr {
            line-height: 20px;
            height: 20px;
          }

          /*
           * --------------------------------------------------
           * ICON
           * --------------------------------------------------
           */
          a.social-link {
            color: %7$s;
            border: 1px solid %7$s;
          }
          a.social-link.social-link-facebook {
            color: %20$s;
            border: 1px solid %20$s;
          }
          a.social-link.social-link-twitter {
            color: %21$s;
            border: 1px solid %21$s;
          }
          a.social-link.social-link-pinterest {
            color: %23$s;
            border: 1px solid %23$s;
          }
          a.social-link.social-link-google-plus {
            color: %22$s;
            border: 1px solid %22$s;
          }
          a.social-link.social-link-rss {
            color: %24$s;
            border: 1px solid %24$s;
          }

          /*
           * --------------------------------------------------
           * MOBILE MENU
           * --------------------------------------------------
           */
          /*
           * --------------------------------------------------
           * OWL CUSTOM PAGINATION
           * --------------------------------------------------
           */
          .widget-title .owl-custom-pagination {
            border: 1px solid %8$s;
            color: %8$s;
          }
          .widget-title .owl-custom-pagination:hover {
            border-color: %4$s;
            color: %4$s;
          }

          /*
           * --------------------------------------------------
           * ICON
           * --------------------------------------------------
           */
          .metadata-circle-icon .fa {
            color: %4$s;
          }

          /*
           * --------------------------------------------------
           * METADATA
           * --------------------------------------------------
           */
          div.comment-metadata .metadata-divider,
          div.comment-metadata time,
          div.comment-metadata .comment-reply-link,
          div.comment-metadata a {
            color: %1$s;
          }

          p.metadata .metadata-post-format {
            background: %4$s;
            color: %15$s;
          }
          p.metadata .metadata-comment,
          p.metadata .metadata-date,
          p.metadata .metadata-views,
          p.metadata .metadata-divider {
            color: %25$s;
          }

          p.metadata-readmore a {
            color: %4$s;
          }

          div.ct-article-metadata p.metadata-divider-horizonal {
            border-bottom: 1px dashed %8$s;
            color: %4$s;
          }

          .ct-transition-all, .wpcf7-form .wpcf7-form-control.wpcf7-submit {
            -o-transition: all .5s;
            -ms-transition: all .5s;
            -moz-transition: all .5s;
            -webkit-transition: all .5s;
          }

          /*
           * --------------------------------------------------
           * BREADCRUMB
           * --------------------------------------------------
           */
          .breadcrumb {
            background-color: transparent;
            border-bottom: 1px solid %8$s;
          }
          .breadcrumb a {
            text-decoration: none;
          }
          .breadcrumb a.current-page {
            color: %4$s;
          }

          /*
           * --------------------------------------------------
           * BLOG PAGE
           * --------------------------------------------------
           */
          body.ct-layout-blog #ct-blogposts {
            list-style-type: none;
          }
          body.ct-layout-blog #ct-blogposts > li {
            border-top: 1px solid %8$s;
          }
          body.ct-layout-blog #ct-blogposts > li.ct-first-post {
            border-top: none;
          }
          body.ct-layout-blog #ct-blogposts > li article .entry-thumb a .overlay {
            background: %19$s;
          }
          body.ct-layout-blog #ct-blogposts > li article .entry-thumb a .overlay-link {
            border: 2px solid %15$s;
          }
          body.ct-layout-blog #ct-blogposts > li article .entry-thumb a .fa {
            color: %15$s;
          }

          /*
           * --------------------------------------------------
           * BLOG PAGE MASONRY
           * --------------------------------------------------
           */
          body.ct-layout-blog.ct-layout-blog-masonry #ct-blogposts {
            border-bottom: 1px solid %8$s;
          }
          body.ct-layout-blog.ct-layout-blog-masonry #ct-blogposts .item {
            border-bottom: none;
            border-right: none;
            border-left: 1px solid %8$s;
            border-top: 1px solid %8$s;
          }
          body.ct-layout-blog.ct-layout-blog-masonry #ct-blogposts-loadmore {
            background-color: %4$s;
          }
          body.ct-layout-blog.ct-layout-blog-masonry #ct-blogposts-loadmore a {
            color: %15$s;
          }

          /*
           * --------------------------------------------------
           * PAGINATION
           * --------------------------------------------------
           */
          ul.page-numbers {
            border-top: 1px solid %8$s;
          }
          ul.page-numbers li a, ul.page-numbers li span {
            border: 1px solid %8$s;
            text-decoration: none;
          }
          ul.page-numbers li span.dots {
            border-color: transparent;
          }
          ul.page-numbers li a:hover, ul.page-numbers li span.current {
            color: %4$s;
            border-color: %4$s;
          }

          #ct_singular_pagination a {
            color: %4$s;
          }

          /*
           * --------------------------------------------------
           * SINGLE PAGE
           * --------------------------------------------------
           */
          body.ct-layout-single #ct-post-wrap div.entry-tag {
            border-top: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-category,
          body.ct-layout-single #ct-post-tag {
            border-top: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-category span,
          body.ct-layout-single #ct-post-category a,
          body.ct-layout-single #ct-post-tag span,
          body.ct-layout-single #ct-post-tag a {
            background-color: %5$s;
          }
          body.ct-layout-single #ct-post-category span:hover,
          body.ct-layout-single #ct-post-category a:hover,
          body.ct-layout-single #ct-post-tag span:hover,
          body.ct-layout-single #ct-post-tag a:hover {
            background-color: %4$s;
            color: %15$s;
          }
          body.ct-layout-single #ct-post-category span,
          body.ct-layout-single #ct-post-tag span {
            color: %4$s;
          }
          body.ct-layout-single #ct-post-category {
            border-top: none;
          }
          body.ct-layout-single #ct-post-adjacent {
            border-top: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-adjacent div.ct-post-adjacent-prev {
            border-right: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-adjacent div.ct-post-adjacent-next {
            border-left: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-author {
            border-top: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-author .ct-author-name a {
            color: %4$s;
          }
          body.ct-layout-single #ct-post-author .ct-author-socials a {
            border: 1px solid %8$s;
          }
          body.ct-layout-single #ct-post-related .ct-widget-content figure.post figcaption a {
            color: %15$s;
            background-color: %19$s;
          }

          /*
           * --------------------------------------------------
           * COMMENTS
           * --------------------------------------------------
           */
          #comments {
            border-top: none !important;
          }
          #comments > .widget-title.comments-title {
            border-top: 1px dashed %8$s;
          }
          #comments #comment-nav-below {
            border-top: 1px dashed %8$s;
          }
          #comments .comment-list > li:first-child {
            border-top: none;
          }
          #comments .pingback,
          #comments .comment {
            border-top: 1px solid %8$s;
          }
          #comments .pingback .comment-meta .comment-author .fn a,
          #comments .comment .comment-meta .comment-author .fn a {
            color: %4$s;
          }
          #comments #respond {
            border-top: 1px solid %8$s;
          }
          #comments #respond .comment-form-info input {
            border: 1px solid %8$s;
          }
          #comments #respond .comment-form-comment textarea {
            border: 1px solid %8$s;
          }
          #comments #respond .form-submit input {
            color: %15$s;
            border: none;
            background-color: %4$s;
          }

          /*
           * --------------------------------------------------
           * DIVIDER
           * --------------------------------------------------
           */
          .separator {
            border-bottom-width: 1px;
            border-bottom-color: %8$s;
          }

          .separator-solid {
            border-bottom-style: solid;
          }

          .separator-dotted {
            border-bottom-style: dotted;
          }

          .separator-double {
            border-bottom-style: double;
            border-bottom-width: 3px;
            height: 3px;
          }

          .separator-dashed {
            border-bottom-style: dashed;
          }

          /*
           * --------------------------------------------------
           * PLUGIN (CONTACT FORM 7)
           * --------------------------------------------------
           */
          .wpcf7-form .wpcf7-form-control-wrap > input[type=text], .wpcf7-form .wpcf7-form-control-wrap > input[type=email], .wpcf7-form .wpcf7-form-control-wrap > input[type=number], .wpcf7-form .wpcf7-form-control-wrap > input[type=phone], .wpcf7-form .wpcf7-form-control-wrap > textarea {
            border: 1px solid %8$s;
          }
          .wpcf7-form .wpcf7-form-control.wpcf7-submit {
            background-color: %4$s;
            border: 1px solid %4$s;
            color: %15$s;
          }
          .wpcf7-form .wpcf7-form-control.wpcf7-submit:hover {
            color: %4$s;
            background-color: %15$s;
          }

          /*
           * --------------------------------------------------
           * BOXER
           * --------------------------------------------------
           */
          body.ct-boxer #ct-header-search-box form#search-form .search-submit {
            border-right: none !important;
          }

          /*
           * --------------------------------------------------
           * CONTACT INFORMATION
           * --------------------------------------------------
           */
          .ct-contact-information .ct-contact-block .fa {
            color: %4$s;
          }

          /*
           * --------------------------------------------------
           * RESPONSIVE (COLOR)
           * --------------------------------------------------
           */
          @media only screen and (max-width: 767px) {
            #ct-post-adjacent .ct-post-adjacent-next {
              border-top: 1px dashed %8$s;
            }

            .widget.ct-widget-posts-grid .ct-widget-content {
              padding-bottom: 20px;
            }
            .widget.ct-widget-posts-grid .ct-widget-content .row .ct-wp-grid-post {
              border-top: 1px solid %8$s;
              border-right: none;
              border-left: none;
            }
            .widget.ct-widget-posts-grid .ct-widget-content .row.row-first .ct-wp-grid-post {
              border-top: 1px solid %8$s;
            }
            .widget.ct-widget-posts-grid .ct-widget-content .row.row-first .ct-wp-grid-post.ct-wp-grid-post-first {
              border-top: none;
            }

            .widget.ct-widget-posts-playlist .row-first .ct-wp-other-post-even .entry-title {
              border-top: 1px solid %7$s !important;
            }
          }
          @media only screen and (min-width: 1024px) and (max-width: 1179px) {
            .ct-col-right {
              border-right: 1px solid %8$s;
            }
          }
          @media only screen and (min-width: 980px) and (max-width: 1023px) {
            .ct-col-right {
              border-right: 1px solid %8$s;
            }
          }
          @media only screen and (min-width: 900px) and (max-width: 979px) {
            .ct-col-right {
              border-right: 1px solid %8$s;
            }
          }
          @media only screen and (min-width: 800px) and (max-width: 899px) {
            .ct-col-right {
              border-right: 1px solid %8$s;
            }
          }
          @media only screen and (min-width: 768px) and (max-width: 799px) {
            .ct-col-right {
              border-right: 1px solid %8$s;
            }
          }
          @media only screen and (max-width: 599px) {
            #main-nav-inner #ct-header-search-box {
              border-left: none;
            }
          }';
        
      $custom_color = sprintf(
        $custom_color, 
        ot_get_option('body_color'), //1
        ot_get_option('heading_color'), //2
        ot_get_option('link_color'), //3
        ot_get_option('primary_color'), //4
        ot_get_option('secondary_color'), //5
        ot_get_option('main_menu_color'), //6
        ot_get_option('line_1_color'), //7
        ot_get_option('line_2_color'), //8
        ot_get_option('line_3_color'), //9
        ot_get_option('footer_sidebars_bg_color'), //10
        ot_get_option('footer_sidebars_text_color'), //1
        ot_get_option('footer_widget_title_color'), //12
        ot_get_option('footer_info_bg_color'), //13
        ot_get_option('footer_info_text_color'), //14
        '#FFFFFF', //15 :white;
        '#000000', //16 :black;
        '#222222', //17 :black-light;         
        'rgba(255, 255, 255, 0.5)', //18 :overlay_white;
        'rgba(0, 0, 0, 0.5)', //19 :overlay_black;
        '#3B5998', //20 :facebook-color;
        '#00A0D1', //21 :twitter-color;
        '#C63D2D', //22 :google-plus-color;
        '#910101', //23 :pinterest-color;
        '#FA9B39', //24 :rss-color;
        '#777777' //25 :metadata
      ); 
      
      wp_add_inline_style(CT_PREFIX . 'style', $custom_color);

    }

    //GOOGLE FONT        
    wp_enqueue_style(CT_PREFIX . 'font-oswald', "http://fonts.googleapis.com/css?family=Oswald:300,400,700", array(), NULL);
    wp_enqueue_style(CT_PREFIX . 'font-noto-sans', "http://fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700,700italic", array(), NULL);


    /*
     * --------------------------------------------------
     * SCRIPTS    
     * --------------------------------------------------
     */        

    wp_enqueue_script('jquery');    
    wp_enqueue_script('jquery-form');

    if (is_singular())
        wp_enqueue_script('comment-reply');

    wp_enqueue_script(CT_PREFIX . 'bootstrap',  "{$dir}/js/bootstrap{$suffix}.js", array('jquery'), NULL, TRUE);    
    wp_enqueue_script(CT_PREFIX . 'require', "{$dir}/js/require{$suffix}.js", array('jquery'), NULL, TRUE);
    wp_enqueue_script(CT_PREFIX . 'modernizr', "{$dir}/js/modernizr{$suffix}.js", array('jquery'), NULL, TRUE);
    wp_enqueue_script(CT_PREFIX . 'origamier', "{$dir}/js/origamiez.init{$suffix}.js", array('jquery'), NULL, TRUE);

    $bg_type = ot_get_option('background_type', 'none');
    $bg_slides_arr = array();
    $bg_css = array();

    if('slideshow' == $bg_type){
      $bg_slides = ot_get_option('background_slideshow', false);
      if ($bg_slides) {
          $bg_slides = explode(',', $bg_slides);
          foreach ($bg_slides as $bg_slide) {
              $image = wp_get_attachment_image_src($bg_slide, 'full');

              array_push($bg_slides_arr, array(
                  'src' => esc_url($image[0]),
                  'fade' => 1000
              ));
          }
      }
    }else if('simple' == $bg_type){
        $bg_opts = ot_get_option('background_simple', array());
        foreach ($bg_opts as $key => $value) {
          if(!empty($value)){
            $str = '%s : %s;';
            if('background-image' == $key){
              $str = '%s : url(%s);';
            }

            $bg_css[$key] = sprintf($str, $key, $value);
          }
        }
        $bg_css = "html {".implode(' ', $bg_css) .'}'; 
        wp_add_inline_style(CT_PREFIX . 'style', $bg_css);      
    }

    wp_localize_script(CT_PREFIX . 'origamier', 'colours_vars', apply_filters('get_colours_vars', array(
        'info' => array(
            'home_url'     => home_url(),
            'template_uri' => get_template_directory_uri(),            
            'suffix'       => $suffix,
        ),
        'i18n' => array(
            'MORE_ARTICLES' => __('More Articles', ct_get_domain()),
            'LOADING' => __('Loading...', ct_get_domain()),
        ),
        'config' => array(            
            'background' => array(
                'isSlideshow' => empty($bg_slides_arr) ? false : true,
                'slides' => $bg_slides_arr
            )
        ),
        'ajax' => array(
            'url' => admin_url('admin-ajax.php'),
            'object_id' => get_queried_object_id()
        )
    )));

    /*
     * --------------------------------------------------
     * IE FIX
     * --------------------------------------------------
     */
    if ($is_IE) {
        wp_register_style(CT_PREFIX . 'ie', $dir . '/css/ie.css', array(), NULL);
        wp_enqueue_style(CT_PREFIX . 'ie');
        $wp_styles->add_data(CT_PREFIX . 'ie', 'conditional', 'lt IE 9');

        wp_enqueue_script(CT_PREFIX . 'html5', "{$dir}/js/html5shiv{$suffix}.js", array(), NULL, TRUE);
        wp_enqueue_script(CT_PREFIX . 'respond', "{$dir}/js/respond{$suffix}.js", array(), NULL, TRUE);
        wp_enqueue_script(CT_PREFIX . 'pie', "{$dir}/js/pie{$suffix}.js", array(), NULL, TRUE);
    }


    /*
     * --------------------------------------------------
     * CUSTOM FONT
     * --------------------------------------------------
     */
    $rules = array('font-family', 'font-size', 'font-style', 'font-weight', 'line-height');
    $google_fonts = ot_get_option('google_font');
    $google_fonts_links = array();
    $font_objects = array(
        'font_body' => 'body',
        'font_menu' => '#main-menu a',
        'font_widget_title' => 'h2.widget-title',
        'font_heading_1' => 'h1',
        'font_heading_2' => 'h2',
        'font_heading_3' => 'h3',
        'font_heading_4' => 'h4',
        'font_heading_5' => 'h5',
        'font_heading_6' => 'h6'
    );

    foreach ($font_objects as $option_key => $font_object) {
        $font_data = ot_get_option($option_key);

        foreach ($rules as $rule) {
            if (!empty($font_data[$rule])) {
                if ('font-family' == $rule) {
                    if ($google_fonts) {
                        foreach ($google_fonts as $google_font) {
                            if ($font_data[$rule] == $google_font['slug']) {
                                $font_data[$rule] = $google_font['title'];
                                $google_fonts_links[$google_font['slug']] = $google_font['link'];
                            }
                        }
                    }
                }

                $tmp = sprintf("%s {%s: %s;}", $font_object, $rule, $font_data[$rule]);

                wp_add_inline_style(CT_PREFIX . 'typography', $tmp);
            }
        }
    }

    if (!empty($google_fonts_links)) {
        foreach ($google_fonts_links as $slug => $link) {
            wp_enqueue_style(CT_PREFIX . $slug, $link, array(), NULL);
        }
    }
}

function ct_body_class($classes) {
    if (is_single()) {
        array_push($classes, 'ct-layout-right-sidebar', 'ct-layout-single');
    } else if (is_page()) {      
        if ('template-page-fullwidth.php' == basename(get_page_template())) {
            array_push($classes, 'ct-layout-right-sidebar', 'ct-layout-single', 'ct-layout-full-width');
        } else {
            array_push($classes, 'ct-layout-right-sidebar', 'ct-layout-single', 'ct-layout-static-page');
        }
    } else if (is_archive() || is_home()) {
        array_push($classes, 'ct-layout-right-sidebar', 'ct-layout-blog');
        switch (ot_get_option('layout_taxonomy', 'thumbnail-left')) {
            case 'thumbnail-right':
                array_push($classes, 'ct-layout-blog-thumbnail-right');
                break;
            default:
                array_push($classes, 'ct-layout-blog-thumbnail-left');
                break;
        }
    } elseif (is_search()) {
        array_push($classes, 'ct-layout-right-sidebar', 'ct-layout-blog');
    } else if (is_404()) {
        array_push($classes, 'ct-layout-right-sidebar', 'ct-layout-single', 'ct-layout-full-width');
    }

    if ('none' == ot_get_option('background_type', 'none')) {
      array_push($classes, 'without_bg_slides');
    }else{
      array_push($classes, 'ct_custom_bg');
    }

    if ('on' != ot_get_option('use_layout_fullwidth', 'on')) {
        array_push($classes, 'ct-boxer', 'container');
    } else {
        $classes[] = 'ct-fluid';
    }

    if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5')){
      $classes[] = 'ct-show-footer-area';
    }

    $skin = ot_get_option('skin', 'default');
    if($skin){
      $classes[] = sprintf('ct-skin-%s', $skin);
    }

    return $classes;
}

function ct_archive_post_class($classes) {
    global $wp_query;

    if (0 == $wp_query->current_post) {
        array_push($classes, 'ct-first-post');
    }

    return $classes;
}

function ct_log($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

function ct_get_format_icon($format) {
    $icon = '';

    switch ($format) {
        case 'video':
            $icon = 'fa fa-play';
            break;
        case 'audio':
            $icon = 'fa fa-headphones';
            break;
        case 'image':
            $icon = 'fa fa-camera';
            break;
        case 'gallery':
            $icon = 'fa fa-picture-o';
            break;
        default:
            $icon = 'fa fa-pencil';
            break;
    }

    return $icon;
}

function ct_get_shortcode($content, $shortcodes = array(), $enable_multi = false) {
    $data = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);

    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $shortcodes)) :
            $data[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'content' => $regex_matches_new[5],
                'atts' => shortcode_parse_atts($regex_matches_new[3])
            );

            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $data;
}

function ct_human_time_diff($from) {
    $periods = array(
        __("second", ct_get_domain()),
        __("minute", ct_get_domain()),
        __("hour", ct_get_domain()),
        __("day", ct_get_domain()),
        __("week", ct_get_domain()),
        __("month", ct_get_domain()),
        __("year", ct_get_domain()),
        __("decade", ct_get_domain())
    );
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = current_time('timestamp');

    // Determine tense of date
    if ($now > $from) {
        $difference = $now - $from;
        $tense = __("ago", ct_get_domain());
    } else {
        $difference = $from - $now;
        $tense = __("from now", ct_get_domain());
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j].= __("s", ct_get_domain());
    }

    return "$difference $periods[$j] {$tense}";
}

function ct_widget_enqueue($hook) {
    if (in_array($hook, array('widgets.php', 'post-new.php', 'post.php'))) {
        $dir = get_template_directory_uri();
        
        wp_enqueue_style('thickbox');
        wp_enqueue_style('wp-color-picker');
        
        wp_enqueue_media();
        wp_enqueue_script('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('wp-color-picker');
        
        wp_enqueue_style(CT_PREFIX . 'widget', "{$dir}/inc/assets/css/widget.css", array(), NULL);
        wp_enqueue_script(CT_PREFIX . 'widget', "{$dir}/inc/assets/js/widget.js", array('jquery'), NULL, TRUE);
    }
}

function ct_get_breadcrumb() {
    global $post, $wp_query;
    $current_class = 'current-page';
    $prefix = '&nbsp;&rsaquo;&nbsp;';
    $breadcrumb_before = '<div class="breadcrumb">';
    $breadcrumb_after = '</div>';

    $breadcrumb_home = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url() . '" itemprop="url"><span itemprop="title">' . __('Home', ct_get_domain()) . '</span></a></span>';

    $breadcrumb = $breadcrumb_home;

    if (is_archive()) {
        if (is_tag()) {
            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $term->name);
        } else if (is_category()) {
            $terms_link = explode($prefix, substr(get_category_parents(get_queried_object_id(), TRUE, $prefix), 0, (strlen($prefix) * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, get_the_category_by_ID(get_queried_object_id()));
        } else if (is_year() || is_month() || is_day()) {

            $m = get_query_var('m');
            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);
            if (strlen($m) >= 4)
                $date['y'] = substr($m, 0, 4);
            if (strlen($m) >= 6)
                $date['m'] = substr($m, 4, 2);
            if (strlen($m) >= 8)
                $date['d'] = substr($m, 6, 2);
            if ($date['y'])
                if (is_year())
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['y']);
                else
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_year_link($date['y']), $date['y']);
            if ($date['m'])
                if (is_month())
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
                else
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
            if ($date['d'])
                if (is_day())
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['d']);
                else
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_day_link($date['y'], $date['m'], $date['d']), $date['d']);
        }else if (is_author()) {

            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Posts created by %1$s', ct_get_domain()), get_the_author_meta('display_name', $author_id)));
        }
    } else if (is_search()) {
        $s = get_search_query();
        $c = $wp_query->found_posts;
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Searched for "%s" return %s results', ct_get_domain()), $s, $c));
    } else if (is_singular()) {
        if (is_page()) {
            $post_ancestors = get_post_ancestors($post);
            if ($post_ancestors) {
                $post_ancestors = array_reverse($post_ancestors);
                foreach ($post_ancestors as $crumb)
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_permalink($crumb), esc_html(get_the_title($crumb)));
            }
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink(get_queried_object_id()), esc_html(get_the_title(get_queried_object_id())));
        } else if (is_single()) {
            $categories = get_the_category(get_queried_object_id());
            if ($categories) {
                foreach ($categories as $category) {
                    $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_category_link($category->term_id), $category->name);
                }
            }
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink(get_queried_object_id()), esc_html(get_the_title(get_queried_object_id())));
        }
    } else if (is_404()) {
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Page not found', ct_get_domain()));
    } else {
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Latest News', ct_get_domain()));
    }


    echo $breadcrumb_before;
    echo apply_filters('ct_get_breadcrumb', $breadcrumb, $current_class, $prefix);
    echo $breadcrumb_after;
}

function ct_get_author_infor() {
    global $post;
    $user_id = $post->post_author;
    $description = get_the_author_meta('description', $user_id);
    $email = get_the_author_meta('user_email', $user_id);
    $name = get_the_author_meta('display_name', $user_id);
    $url = trim(get_the_author_meta('user_url', $user_id));
    $link = ($url) ? $url : get_author_posts_url($user_id);
    ?>
    <div id="ct-post-author">
        <p class="ct-author-name clearfix"><?php _e('Author:', ct_get_domain()); ?>&nbsp;<a href="<?php echo $link; ?>"><?php echo $name; ?></a></p>                           
        <div class="ct-author-info clearfix">
            <a href="<?php echo $link; ?>" class="ct-author-avatar">
                <?php echo get_avatar($email, 90); ?>               
            </a>
            <div class="ct-author-detail">
                <p class="ct-author-socials">
                    <?php
                    $socials = ct_get_socials();
                    foreach ($socials as $slug => $social):
                        $social_url = get_the_author_meta($slug, $user_id);
                        if ($social_url):
                            ?>
                            <a href="<?php echo $social_url; ?>" title="<?php echo $social['label'] ?>" rel="nofollow"><span class="<?php echo $social['value'] ?>"></span></a>
                            <?php
                        endif;
                    endforeach;
                    ?>                                                                 
                </p>                  

                <?php if ($description): ?>
                    <p class="ct-author-bio">                   
                        <?php echo $description; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

function ct_get_related_posts() {
    global $post;

    $tags = get_the_tags($post->ID);
    if (!empty($tags)) {
        $tag_ids = array();
        foreach ($tags as $tag) {
            $tag_ids[] = $tag->term_id;
        }

        $args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => 10,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'id',
                    'terms' => $tag_ids
                )
            )
        );

        $posts = new WP_Query($args);
        if ($posts->have_posts()):
            ?>
            <div id="ct-post-related" class="widget">
                <h2 class="widget-title clearfix">
                    <span class="widget-title-text pull-left"><?php _e('Related Articles', ct_get_domain()); ?></span>  
                    <span class="pull-right owl-custom-pagination fa fa-angle-right ct-transition-all"></span>
                    <span class="pull-right owl-custom-pagination fa fa-angle-left ct-transition-all"></span>
                </h2>

                <div class="ct-widget-content clearfix">
                    <div class="owl-carousel owl-theme">
                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            ?>
                            <figure class="post">
                                <?php if (has_post_thumbnail()): ?>                        
                                    <?php the_post_thumbnail('blog-m', array('class' => 'img-responsive')); ?>                                          
                                <?php endif; ?>                                
                                <figcaption><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></figcaption>
                            </figure>
                            <?php
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>
            <?php
        endif;
        wp_reset_postdata();
    }
}

function ct_list_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <article class="comment-body clearfix" id="div-comment-23">
            <span class="comment-avatar pull-left">
                <?php echo get_avatar($comment->comment_author_email, $args['avatar_size']); ?>
            </span>						            
            <footer class="comment-meta">
                <div class="comment-author vcard">                                                    
                    <span class="fn">
                        <?php comment_author_link(); ?>
                    </span>                                                     
                </div><!-- .comment-author -->
                <div class="comment-metadata">
                    <span class="metadata-divider">&horbar;</span>
                    <a href="#">
                        <?php comment_time(get_option('date_format') . ' - ' . get_option('time_format')); ?>
                    </a>

                    <?php comment_reply_link(array_merge($args, array('before' => '<span class="metadata-divider">&horbar;</span>&nbsp;', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

                    <?php edit_comment_link(__('Edit', ct_get_domain()), '<span class="metadata-divider">&horbar;</span>&nbsp;', ''); ?>
                </div><!-- .comment-metadata -->
            </footer><!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(true); ?>                   
            </div><!-- .comment-content -->     
                             
        </article><!-- .comment-body -->
    </li>
    <?php
}

function ct_comment_form($args = array(), $post_id = null) {
    if (null === $post_id)
        $post_id = get_the_ID();
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args($args);
    if (!isset($args['format']))
        $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5 = 'html5' === $args['format'];
    $fields = array();

    $fields['author'] = '<div class="comment-form-info row clearfix">';
    $fields['author'].= '<div class="comment-form-field col-sm-4">';
    $fields['author'].= '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />';
    $fields['author'].= '<span class="comment-icon fa fa-user"></span>';
    $fields['author'].= '</div>';

    $fields['email'] = '<div class="comment-form-field col-sm-4">';
    $fields['email'].= '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />';
    $fields['email'].= '<span class="comment-icon fa fa-envelope"></span>';
    $fields['email'].= '</div>';


    $fields['url'] = '<div class="comment-form-field col-sm-4">';
    $fields['url'].= '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />';
    $fields['url'].= '<span class="comment-icon fa fa-link"></span>';
    $fields['url'].= '</div>';
    $fields['url'].= '</div>';

    $required_text = '';
    $fields = apply_filters('comment_form_default_fields', $fields);

    $comment_field = '<p class="comment-form-comment">';
    $comment_field.= '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
    $comment_field.= '</p>';

    $defaults = array(
        'fields' => $fields,
        'comment_field' => $comment_field,
        'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', ct_get_domain()), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', ct_get_domain()), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'id_form' => 'commentform',
        'id_submit' => 'submit',
        'title_reply' => __('Leave a Reply', ct_get_domain()),
        'title_reply_to' => __('Leave a Reply to %s', ct_get_domain()),
        'cancel_reply_link' => __('Cancel reply', ct_get_domain()),
        'label_submit' => __('Post Comment', ct_get_domain()),
        'format' => 'xhtml',
    );



    $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
    ?>
    <?php if (comments_open($post_id)) : ?>
        <?php
        do_action('comment_form_before');
        ?>
        <div class="comment-respond" id="respond">
            <h2 id="reply-title" class="comment-reply-title widget-title clearfix"><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?> <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h2>

            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <?php echo $args['must_log_in']; ?>
                <?php
                do_action('comment_form_must_log_in_after');
                ?>
            <?php else : ?>
                <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form ct-widget-content clearfix" <?php echo $html5 ? ' novalidate' : ''; ?>>
                    <?php
                    do_action('comment_form_top');
                    ?>
                    <?php if (is_user_logged_in()) : ?>
                        <?php
                        echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity);
                        ?>
                        <?php
                        do_action('comment_form_logged_in_after', $commenter, $user_identity);
                        ?>
                    <?php else : ?>
                        <?php echo $args['comment_notes_before']; ?>
                        <?php
                        do_action('comment_form_before_fields');
                        foreach ((array) $args['fields'] as $name => $field) {
                            echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                        }
                        do_action('comment_form_after_fields');
                        ?>
                    <?php endif; ?>
                    <?php
                    echo apply_filters('comment_form_field_comment', $args['comment_field']);
                    ?>
                    <?php echo $args['comment_notes_after']; ?>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />
                        <?php comment_id_fields($post_id); ?>
                    </p>
                    <?php
                    do_action('comment_form', $post_id);
                    ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond -->
        <?php
        do_action('comment_form_after');
    else :
        do_action('comment_form_comments_closed');
    endif;
}

function ct_get_socials() {
    return array(
        'behance' => array(
            'value' => 'fa fa-behance',
            'label' => __('Behance', ct_get_domain())
        ),
        'bitbucket' => array(
            'value' => 'fa fa-bitbucket',
            'label' => __('Bitbucket', ct_get_domain())
        ),
        'codepen' => array(
            'value' => 'fa fa-codepen',
            'label' => __('Codepen', ct_get_domain())
        ),
        'delicious' => array(
            'value' => 'fa fa-delicious',
            'label' => __('Delicious', ct_get_domain())
        ),
        'deviantart' => array(
            'value' => 'fa fa-deviantart',
            'label' => __('Deviantart', ct_get_domain())
        ),
        'digg' => array(
            'value' => 'fa fa-digg',
            'label' => __('Digg', ct_get_domain())
        ),
        'dribbble' => array(
            'value' => 'fa fa-dribbble',
            'label' => __('Dribbble', ct_get_domain())
        ),
        'dropbox' => array(
            'value' => 'fa fa-dropbox',
            'label' => __('Dropbox', ct_get_domain())
        ),
        'facebook' => array(
            'value' => 'fa fa-facebook',
            'label' => __('Facebook', ct_get_domain())
        ),
        'flickr' => array(
            'value' => 'fa fa-flickr',
            'label' => __('Flickr', ct_get_domain())
        ),
        'foursquare' => array(
            'value' => 'fa fa-foursquare',
            'label' => __('Foursquare', ct_get_domain())
        ),
        'git' => array(
            'value' => 'fa fa-git',
            'label' => __('Git', ct_get_domain())
        ),
        'github' => array(
            'value' => 'fa fa-github',
            'label' => __('Github', ct_get_domain())
        ),
        'google-plus' => array(
            'value' => 'fa fa-google-plus',
            'label' => __('Google plus', ct_get_domain())
        ),
        'instagram' => array(
            'value' => 'fa fa-instagram',
            'label' => __('Instagram', ct_get_domain())
        ),
        'jsfiddle' => array(
            'value' => 'fa fa-jsfiddle',
            'label' => __('JsFiddle', ct_get_domain())
        ),
        'linkedin' => array(
            'value' => 'fa fa-linkedin',
            'label' => __('linkedin', ct_get_domain())
        ),
        'pinterest' => array(
            'value' => 'fa fa-pinterest',
            'label' => __('Pinterest', ct_get_domain())
        ),
        'reddit' => array(
            'value' => 'fa fa-reddit',
            'label' => __('Reddit', ct_get_domain())
        ),
        'soundcloud' => array(
            'value' => 'fa fa-soundcloud',
            'label' => __('Soundcloud', ct_get_domain())
        ),
        'spotify' => array(
            'value' => 'fa fa-spotify',
            'label' => __('Spotify', ct_get_domain())
        ),
        'stack-exchange' => array(
            'value' => 'fa fa-stack-exchange',
            'label' => __('Stack exchange', ct_get_domain())
        ),
        'stack-overflow' => array(
            'value' => 'fa fa-stack-overflow',
            'label' => __('Stack overflow', ct_get_domain())
        ),
        'stumbleupon' => array(
            'value' => 'fa fa-stumbleupon',
            'label' => __('Stumbleupon', ct_get_domain())
        ),
        'tumblr' => array(
            'value' => 'fa fa-tumblr',
            'label' => __('Tumblr', ct_get_domain())
        ),
        'twitter' => array(
            'value' => 'fa fa-twitter',
            'label' => __('Twitter', ct_get_domain())
        ),
        'vimeo' => array(
            'value' => 'fa fa-vimeo-square',
            'label' => __('Vimeo', ct_get_domain())
        ),
        'youtube' => array(
            'value' => 'fa fa-youtube',
            'label' => __('Youtube', ct_get_domain())
        )
    );
}

function ct_user_contactmethods($methods) {
    $socials = ct_get_socials();
    foreach ($socials as $slug => $social) {
        $methods[$slug] = $social['label'];
    }

    return $methods;
}

function ct_set_view($post_id, $include_text = true) {
    $new_value = 0;
    $meta_key = CT_PREFIX . 'views';

    $current_value = (int) get_post_meta($post_id, $meta_key, true);

    if ($current_value) {
        $new_value = $current_value + 1;
        update_post_meta($post_id, $meta_key, $new_value);
    } else {
        $new_value = 1;
        add_post_meta($post_id, $meta_key, $new_value);
    }

    if ($include_text) {
        $new_value .= '&nbsp;' . _n('view', 'views', $new_value, ct_get_domain());
    }

    return $new_value;
}

function ct_get_view($post_id, $include_text = true) {
    $meta_key = CT_PREFIX . 'views';
    $count = (int) get_post_meta($post_id, $meta_key, true);

    if ($include_text) {
        if (0 == $count)
            $count .= '&nbsp;' . __('view', ct_get_domain());
        else
            $count .= '&nbsp;' . _n('view', 'views', $count, ct_get_domain());
    }

    return $count;
}

function ct_get_wrap_classes() {
  if ('on' == ot_get_option('use_layout_fullwidth', 'on')){
    echo 'container';
  }       
}

function ct_get_str_uglify($string) {
    $string = preg_replace('/\s+/', ' ', $string);
    $string = preg_replace("/[^a-zA-Z0-9\s]/", '', $string);
    return strtolower(str_replace(' ', '_', $string));
}

function ct_shortcode_atts_gallery($out, $pairs, $atts) {
    if (!isset($atts['size']) || empty($atts['size'])) {
        $atts['size'] = 'blog-m';
        $out['size'] = 'blog-m';
    }

    return $out;
}

function ct_append_custom_sidebars($sidebars) {

    if (!empty($custom_sidebars)) {
        $sidebars = array_merge($sidebars, $custom_sidebars);
    }

    return $sidebars;
}

function ct_add_first_and_last_class_for_menuitem($items) {
    $items[1]->classes[] = 'ct-menuitem-first';
    $items[count($items)]->classes[] = 'ct-menuitem-last';
    return $items;
}

function ct_widget_order_class() {
    global $wp_registered_sidebars, $wp_registered_widgets;

    #Grab the widgets
    $sidebars = wp_get_sidebars_widgets();

    if ( empty( $sidebars ) ) {
        return;
    }

    #Loop through each widget and change the class names
    foreach ( $sidebars as $sidebar_id => $widgets ) {
        if ( empty( $widgets ) ) {
            continue;
        }

        $number_of_widgets = count( $widgets );
        
        foreach ( $widgets as $i => $widget_id ) {
            $wp_registered_widgets[$widget_id]['classname'] .= ' ct-widget-order-' . $i;

            # Add first widget class
            if ( 0 == $i ) {
                $wp_registered_widgets[$widget_id]['classname'] .= ' ct-widget-first';
            }

            # Add last widget class
            if ( $number_of_widgets == ( $i + 1 ) ) {
                $wp_registered_widgets[$widget_id]['classname'] .= ' ct-widget-last';
            }
        }
    }
}

function ct_set_lightbox_markup($lightbox_markup, $post_id) {
    $format = get_post_format($post_id);

    if (in_array($format, array('video', 'audio'))) {
        $data = ct_get_shortcode(get_post_field('post_content', $post_id), array('youtube', 'vimeo', 'soundcloud'));
        if (!empty($data)) {
            $lightbox_markup['before'] = '<span class="poptrox_lightbox">';
            $lightbox_markup['after'] = '</span>';

            $shortcode = $data[0];
            if ('youtube' == $shortcode['type']) {
                $lightbox_markup['url'] = "http://youtu.be/{$shortcode['atts']['id']}";
                $lightbox_markup['atts'][] = 'data-poptrox="youtube,800x480"';
            } else if ('vimeo' == $shortcode['type']) {
                $lightbox_markup['url'] = "http://vimeo.com/{$shortcode['atts']['id']}";
                $lightbox_markup['atts'][] = 'data-poptrox="vimeo,800x480"';
            } else if ('soundcloud' == $shortcode['type']) {
                $lightbox_markup['url'] = $shortcode['atts']['url'];
                $lightbox_markup['atts'][] = 'data-poptrox="soundcloud"';
            }
        }
    }


    return $lightbox_markup;
}