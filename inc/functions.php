<?php

function origamiez_render_title(){
  ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
  <?php
}

function origamiez_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    $title            .= get_bloginfo('name', 'display');
    $site_description = get_bloginfo('description', 'display');
    
    if ($site_description && ( is_home() || is_front_page() )) {
        $title = "$title $sep $site_description";
    }

    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'origamiez'), max($paged, $page));
    }
    return $title;
}

function origamiez_enqueue_scripts() {
    global $post, $wp_styles, $is_IE;
    $dir = get_template_directory_uri();
    $suffix = ('product' === ORIGAMIEZ_MODE) ? '.min' : '';
    
    /*
     * --------------------------------------------------
     * STYLESHEETS    
     * --------------------------------------------------
     */
        
    //LIBS
    wp_enqueue_style(ORIGAMIEZ_PREFIX . 'libs', "{$dir}/assets/origamiez{$suffix}.css", array(), NULL);

    //STYLE        
    wp_enqueue_style(ORIGAMIEZ_PREFIX . 'style', get_stylesheet_uri(), array(), NULL);

    //RESPONSIVE        
    wp_enqueue_style(ORIGAMIEZ_PREFIX . 'responsive', "{$dir}/css/responsive{$suffix}.css", array(), NULL);

    //FONT & COLOR    
    $skin = get_theme_mod('skin', 'default');
    
    if ('custom' != $skin) {            
      wp_enqueue_style(ORIGAMIEZ_PREFIX . 'color', "{$dir}/skin/{$skin}{$suffix}.css", array(), NULL);        
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
          color: %27$s;
        }

        h1, h2, h3, h4, h5, h6 {
          color: %2$s;
        }
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
          color: %3$s;          
        }
        h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
          color: %27$s;
        }        
        #origamiez-header {
          background: %15$s;
          border-bottom: 1px solid %8$s;
        }

        #origamiez-header-bottom {
          border-bottom: 1px solid %8$s;
        }

        #origamiez-header-bar-inner {
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

        #origamiez-body-inner {
          background: %15$s;
        }

        .origamiez-col-right {
          border-left: 1px solid %8$s;
        }

        #origamiez-footer-sidebars {
          /*border-top: 1px solid $line-1-bg-color;*/
          border-top: none;
          background-color: %10$s;
        }

        #origamiez-footer-end {
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
        #origamiez-headline-ticker .origamiez-headline-caption {
          background-color: %15$s;
          color: %4$s;
        }
        #origamiez-headline-ticker .origamiez-headline-caption > span {
          border-right: 1px solid %8$s;
        }
        #origamiez-headline-ticker #origamiez-ticker a time {
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
         * SIDEBAR LEFT
         * --------------------------------------------------
         */
        /*
         * --------------------------------------------------
         * SIDEBAR MAIN TOP
         * --------------------------------------------------
         */
        /*
         * --------------------------------------------------
         * SIDEBAR BOTTOM
         * --------------------------------------------------
         */
        #sidebar-bottom {
          border-top: 1px solid %8$s;
        }
        #sidebar-bottom .widget .widget-title-text {
          border-bottom: none;
        }

        #origamiez-footer-sidebars h2.widget-title {
          color: %12$s;
        }
        #origamiez-footer-sidebars .origamiez-widget-content {
          color: %11$s;
        }
        #origamiez-footer-sidebars .origamiez-widget-content a {
          color: %11$s;
        }
        #origamiez-footer-sidebars .widget.widget_calendar caption {
          border-bottom-color: %7$s;
        }
        #origamiez-footer-sidebars .widget.widget_tag_cloud .origamiez-widget-content a {
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

        .origamiez-mobile-icon {
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

        #origamiez-top-banner .widget-title-text,
        #origamiez-body .widget-title-text {
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
        .widget.origamiez-widget-posts-minimalist .origamiez-widget-content .origamiez-wp-m-post {
          border-top: 1px dashed %7$s;
        }
        .widget.origamiez-widget-posts-minimalist .origamiez-widget-content .origamiez-wp-m-post.origamiez-wp-m-post-first {
          border-top: none;
        }
        .widget.origamiez-widget-posts-minimalist .origamiez-widget-content .origamiez-wp-m-post h5 a {
          color: %11$s;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS TWEETS
         * --------------------------------------------------
         */
        .widget.origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet {
          border-top: 1px solid %7$s;
        }
        .widget.origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet:hover .fa-twitter {
          color: %21$s;
        }
        .widget.origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet.origamiez-wp-m-tweet-first {
          border-top: none;
        }
        .widget.origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet p.origamiez-wp-m-tweet-content a {
          color: %4$s;
        }

        #origamiez-body .widget.origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet {
          border-top-color: %8$s;
        }
        #origamiez-body .widget.origamiez-widget-tweets .origamiez-widget-content .fa-twitter {
          color: %21$s;
        }

        /*
         * --------------------------------------------------
         * WIDGET NEWSLETTER
         * --------------------------------------------------
         */
        .widget.origamiez-widget-newsletter p.newsletter-form input[type=text] {
          border: 1px solid %8$s;
        }
        .widget.origamiez-widget-newsletter p.newsletter-form button[type=submit] {
          border: 1px solid %8$s;
        }
        .widget.origamiez-widget-newsletter p.newsletter-form:hover button[type=submit] {
          border: 1px solid %4$s;
          background-color: %4$s;
          color: %15$s;
        }

        #origamiez-footer .widget.origamiez-widget-newsletter p.newsletter-form input[type=text] {
          background: %10$s;
          border: 1px solid %7$s;
        }
        #origamiez-footer .widget.origamiez-widget-newsletter p.newsletter-form button[type=submit] {
          border: 1px solid %7$s;
          background: %7$s;
          color: %5$s;
        }
        #origamiez-footer .widget.origamiez-widget-newsletter p.newsletter-form:hover input[type=text] {
          border: 1px solid %4$s;
          color: %15$s;
        }
        #origamiez-footer .widget.origamiez-widget-newsletter p.newsletter-form:hover button[type=submit] {
          border: 1px solid %4$s;
          background: %4$s;
          color: %15$s;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS SMALL THUMBNAIL
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-small-thumbnail .origamiez-widget-content .origamiez-wp-mt-post {
          border-top: 1px solid %8$s;
        }
        .widget.origamiez-widget-posts-small-thumbnail .origamiez-widget-content .origamiez-wp-mt-post.origamiez-wp-mt-post-first {
          border-top: none;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS GRID
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-grid .origamiez-widget-content .row.row-first .origamiez-wp-grid-post {
          border-top: none;
        }
        .widget.origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post {
          border-top: 1px solid %8$s;
          border-left: 1px solid %8$s;
          border-right: 1px solid %8$s;
          margin-left: -1px;
        }
        .widget.origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post.origamiez-wp-grid-post-first {
          border-left: none;
        }
        .widget.origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post.origamiez-wp-grid-post-last {
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
        p.metadata i,
        p.metadata .metadata-author a,
        p.metadata .metadata-categories a,
        p.metadata .metadata-comment,
        p.metadata .metadata-date,
        p.metadata .metadata-views,
        p.metadata .metadata-divider {
          color: %25$s;
        }
        p.metadata .metadata-categories a:hover {
          color: %4$s;
        }

        p.metadata-readmore a {
          color: %4$s;
        }

        div.origamiez-article-metadata p.metadata-divider-horizonal {
          border-bottom: 1px dashed %8$s;
          color: %4$s;
        }

        .origamiez-transition-all, .wpcf7-form .wpcf7-form-control.wpcf7-submit {
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
        body.origamiez-layout-blog #origamiez-blogposts {
          list-style-type: none;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li {
          border-top: 1px solid %8$s;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li.origamiez-first-post {
          border-top: none;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li article .entry-thumb a .overlay {
          background: %19$s;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li article .entry-thumb a .overlay-link {
          border: 2px solid %15$s;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li article .entry-thumb a .fa {
          color: %15$s;
        }

        /*
         * --------------------------------------------------
         * BLOG PAGE MASONRY
         * --------------------------------------------------
         */
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts {
          border-bottom: 1px solid %8$s;
        }
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts .item {
          border-bottom: none;
          border-right: none;
          border-left: 1px solid %8$s;
          border-top: 1px solid %8$s;
        }
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts-loadmore {
          background-color: %4$s;
        }
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts-loadmore a {
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

        #origamiez_singular_pagination a {
          color: %4$s;
        }

        /*
         * --------------------------------------------------
         * SINGLE PAGE
         * --------------------------------------------------
         */
        body.origamiez-layout-single #origamiez-post-wrap div.entry-tag {
          border-top: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-category,
        body.origamiez-layout-single #origamiez-post-tag {
          border-top: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-category span,
        body.origamiez-layout-single #origamiez-post-category a,
        body.origamiez-layout-single #origamiez-post-tag span,
        body.origamiez-layout-single #origamiez-post-tag a {
          background-color: %5$s;
        }
        body.origamiez-layout-single #origamiez-post-category span:hover,
        body.origamiez-layout-single #origamiez-post-category a:hover,
        body.origamiez-layout-single #origamiez-post-tag span:hover,
        body.origamiez-layout-single #origamiez-post-tag a:hover {
          background-color: %4$s;
          color: %15$s;
        }
        body.origamiez-layout-single #origamiez-post-category span,
        body.origamiez-layout-single #origamiez-post-tag span {
          color: %4$s;
        }
        body.origamiez-layout-single #origamiez-post-category {
          border-top: none;
        }
        body.origamiez-layout-single #origamiez-post-adjacent {
          border-top: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-adjacent div.origamiez-post-adjacent-prev {
          border-right: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-adjacent div.origamiez-post-adjacent-next {
          border-left: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-author {
          border-top: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-author .origamiez-author-name a {
          color: %4$s;
        }
        body.origamiez-layout-single #origamiez-post-author .origamiez-author-socials a {
          border: 1px solid %8$s;
        }
        body.origamiez-layout-single #origamiez-post-related .origamiez-widget-content figure.post figcaption a {
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
        body.origamiez-boxer #origamiez-header-search-box form#search-form .search-submit {
          border-right: none !important;
        }

        /*
         * --------------------------------------------------
         * REVIEW (RATING) SYSTEM
         * --------------------------------------------------
         */
        #origamiez-admin-rating {
          border: 1px solid %8$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-summary {
          border-bottom: 1px solid %8$s;
        }
        #origamiez-admin-rating .origamiez-rating-total {
          background-color: %4$s;
        }
        #origamiez-admin-rating .origamiez-rating-total span {
          color: %15$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-left {
          font-size: 16px;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-right .circle {
          border: 3px solid %4$s;
          background: %15$s;
          color: %4$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-right .line-front {
          background-color: %4$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-right .line-back {
          background-color: %8$s;
        }

        .origamiez-rating-total-inside-widget {
          background: %4$s;
          color: %15$s;
        }

        /*
         * --------------------------------------------------
         * CONTACT INFORMATION
         * --------------------------------------------------
         */
        .origamiez-contact-information .origamiez-contact-block .fa {
          color: %4$s;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS TWO COLS (1.1.4)
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-two-cols .article-col-right article {
          border-top: 1px solid %8$s;
        }
        .widget.origamiez-widget-posts-two-cols .article-col-right article.origamiez-post-1 {
          border-top: none !important;
        }

        /*
         * --------------------------------------------------
         * WIDGET MEDIA (1.1.6)
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-with-format-icon .origamiez-widget-content .origamiez-w-m-post {
          border-top: 1px solid %8$s;
        }
        .widget.origamiez-widget-posts-with-format-icon .origamiez-widget-content .metadata-circle-icon {
          border: 1px solid %15$s;
        }
        .widget.origamiez-widget-posts-with-format-icon .origamiez-widget-content .metadata-circle-icon .fa {
          color: %15$s;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS ZEBRA (1.1.6)
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post {
          border-bottom: 1px solid %9$s;
        }
        .widget.origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post:last-child {
          border-bottom: none;
        }
        .widget.origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post.even {
          background-color: %15$s;
        }
        .widget.origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post.odd {
          background-color: %5$s;
        }
        .widget.origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post .metadata {
          margin-top: 10px;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS WITH BACKGROUND (1.1.6)
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-with-background .origamiez-widget-content .origamiez-wp-post {
          background-color: %5$s;
        }
        .widget.origamiez-widget-posts-with-background .origamiez-widget-content .origamiez-wp-post .origamiez-wp-post-index {
          border: 1px solid %4$s;
          color: %4$s;
        }

        /*
         * --------------------------------------------------
         * WIDGET POSTS SLIDER (1.1.6)
         * --------------------------------------------------
         */
        .widget.origamiez-widget-posts-slider .origamiez-widget-content .item .caption {
          background-color: %15$s;
        }
        .widget.origamiez-widget-posts-slider .origamiez-widget-content .col-right .owl-pagination {
          background-color: rgba(255, 255, 255, 0.5);
        }

        /*
         * --------------------------------------------------
         * RESPONSIVE (COLOR)
         * --------------------------------------------------
         */
        @media only screen and (max-width: 767px) {
          #origamiez-post-adjacent .origamiez-post-adjacent-next {
            border-top: 1px dashed %8$s;
          }

          .widget.origamiez-widget-posts-grid .origamiez-widget-content {
            padding-bottom: 20px;
          }
          .widget.origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post {
            border-top: 1px solid %8$s;
            border-right: none;
            border-left: none;
          }
          .widget.origamiez-widget-posts-grid .origamiez-widget-content .row.row-first .origamiez-wp-grid-post {
            border-top: 1px solid %8$s;
          }
          .widget.origamiez-widget-posts-grid .origamiez-widget-content .row.row-first .origamiez-wp-grid-post.origamiez-wp-grid-post-first {
            border-top: none;
          }

          .widget.origamiez-widget-posts-playlist .row-first .origamiez-wp-other-post-even .entry-title {
            border-top: 1px solid %7$s !important;
          }

          .widget.origamiez-widget-posts-two-cols .article-col-right {
            border-top: 1px solid %8$s;
          }
        }
        @media only screen and (min-width: 1024px) and (max-width: 1179px) {
          .origamiez-col-right {
            border-right: 1px solid %8$s;
          }
        }
        @media only screen and (min-width: 980px) and (max-width: 1023px) {
          .origamiez-col-right {
            border-right: 1px solid %8$s;
          }
        }
        @media only screen and (min-width: 900px) and (max-width: 979px) {
          .origamiez-col-right {
            border-right: 1px solid %8$s;
          }
        }
        @media only screen and (min-width: 800px) and (max-width: 899px) {
          .origamiez-col-right {
            border-right: 1px solid %8$s;
          }
        }
        @media only screen and (min-width: 768px) and (max-width: 799px) {
          .origamiez-col-right {
            border-right: 1px solid %8$s;
          }
        }
        @media only screen and (max-width: 599px) {
          #main-nav-inner #origamiez-header-search-box {
            border-left: none;
          }
        }
        /*
         * --------------------------------------------------
         * UPDATE :: 2015.03.17
         * --------------------------------------------------
         */
        #sidebar-bottom .widget {
          border-bottom-color: %8$s;
        }

        /*
         * --------------------------------------------------
         * UPDATE :: 2015.06.26
         * --------------------------------------------------
         */
        body.origamiez-page-magazine #sidebar-center .widget-title {
          border: none;
          background: url("%26$s/images/patterns/default.jpg") repeat center center transparent;
        }
        body.origamiez-page-magazine #sidebar-center .widget-title-text {
          border-bottom: none;
          background-color: %15$s;
        }
        body.origamiez-page-magazine #sidebar-center .widget {
          border-top: 0px;
        }
        body.origamiez-layout-single #origamiez-post-wrap .entry-content img,
        body.origamiez-layout-single #origamiez-post-wrap .entry-content .wp-caption .wp-caption-text {
          border: 1px solid %8$s;
          background-color: %5$s; }
        #top-menu li.lang-item.current-lang a {
          color: %4$s;
        }
        #origamiez-blogposts > li.sticky article {
          background-color: %5$s;
          border: 1px solid %8$s;
        }';
        
      $custom_color = sprintf(
        $custom_color, 
        get_theme_mod('body_color', '#666666'), //1
        get_theme_mod('heading_color', '#333333'), //2
        get_theme_mod('link_color', '#333333'), //3
        get_theme_mod('primary_color', '#E74C3C'), //4
        get_theme_mod('secondary_color', '#F9F9F9'), //5
        get_theme_mod('main_menu_color', '#666666'), //6
        get_theme_mod('line_1_color', '#555555'), //7
        get_theme_mod('line_2_color', '#DDDDDD'), //8
        get_theme_mod('line_3_color', '#E5E5E5'), //9
        get_theme_mod('footer_sidebars_bg_color', '#222222'), //10
        get_theme_mod('footer_sidebars_text_color', '#999999'), //1
        get_theme_mod('footer_widget_title_color', '#FFFFFF'), //12
        get_theme_mod('footer_info_bg_color', '#111111'), //13
        get_theme_mod('footer_info_text_color', '#999999'), //14
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
        '#777777', //25 :metadata
        $dir, //26: root directory
        get_theme_mod('link_hover_color', '#E74C3C') //27
      ); 
      
      wp_add_inline_style(ORIGAMIEZ_PREFIX . 'style', $custom_color);

    }

    //GOOGLE FONT        
    wp_enqueue_style(ORIGAMIEZ_PREFIX . 'font-oswald', "//fonts.googleapis.com/css?family=Oswald:400,700", array(), NULL);
    wp_enqueue_style(ORIGAMIEZ_PREFIX . 'font-noto-sans', "//fonts.googleapis.com/css?family=Noto+Sans:400,400italic,700,700italic", array(), NULL);      
    wp_enqueue_style(ORIGAMIEZ_PREFIX . 'typography', "{$dir}/typography/default{$suffix}.css", array(), NULL);         


    /*
     * --------------------------------------------------
     * SCRIPTS    
     * --------------------------------------------------
     */        

    if (is_singular())
        wp_enqueue_script('comment-reply');

    wp_enqueue_script(ORIGAMIEZ_PREFIX . 'libs', "{$dir}/assets/origamiez{$suffix}.js", array('jquery'), NULL, TRUE);

    wp_localize_script(ORIGAMIEZ_PREFIX . 'libs', 'origamiez_vars', apply_filters('get_origamiez_vars', array(
        'info' => array(
            'home_url'     => esc_url(home_url()),
            'template_uri' => get_template_directory_uri(),            
            'suffix'       => $suffix,
        ),        
        'config' => array(
          'is_enable_lightbox' => (int)get_theme_mod('is_enable_lightbox', 1)
        )
    )));

    /*
     * --------------------------------------------------
     * IE FIX
     * --------------------------------------------------
     */
    if ($is_IE) {
        wp_register_style(ORIGAMIEZ_PREFIX . 'ie', $dir . '/css/ie.css', array(), NULL);
        wp_enqueue_style(ORIGAMIEZ_PREFIX . 'ie');
        $wp_styles->add_data(ORIGAMIEZ_PREFIX . 'ie', 'conditional', 'lt IE 9');

        wp_enqueue_script(ORIGAMIEZ_PREFIX . 'html5', "{$dir}/js/html5shiv{$suffix}.js", array(), NULL, TRUE);
        wp_enqueue_script(ORIGAMIEZ_PREFIX . 'respond', "{$dir}/js/respond{$suffix}.js", array(), NULL, TRUE);
        wp_enqueue_script(ORIGAMIEZ_PREFIX . 'pie', "{$dir}/js/pie{$suffix}.js", array(), NULL, TRUE);
    }


    /*
     * --------------------------------------------------
     * CUSTOM FONT
     * --------------------------------------------------
     */
    $rules = array(
      'family'      => 'font-family', 
      'size'        => 'font-size', 
      'style'       => 'font-style', 
      'weight'      => 'font-weight', 
      'line_height' => 'line-height'
    );
    $google_fonts = get_theme_mod('google_font');

    $font_objects = array(
        'font_body'         => 'body',
        'font_menu'         => '#main-menu a',
        'font_widget_title' => 'h2.widget-title',
        'font_h1'           => 'h1',
        'font_h2'           => 'h2',
        'font_h3'           => 'h3',
        'font_h4'           => 'h4',
        'font_h5'           => 'h5',
        'font_h6'           => 'h6'
    );

    foreach ($font_objects as $font_object_slug => $font_object) {
        $is_enable = (int)get_theme_mod("{$font_object_slug}_is_enable", 0);
        
        if($is_enable){
        
          foreach ($rules as $rule_slug => $rule) {            
              $font_data = get_theme_mod("{$font_object_slug}_{$rule_slug}");
              if (!empty($font_data)) {
                  $tmp = sprintf("%s {%s: %s;}", $font_object, $rule, $font_data);
                  wp_add_inline_style(ORIGAMIEZ_PREFIX . 'typography', $tmp);
              }
          }

        }

    }

    $google_fonts_links = array();
    if (!empty($google_fonts_links)) {
        foreach ($google_fonts_links as $slug => $link) {
            wp_enqueue_style(ORIGAMIEZ_PREFIX . $slug, $link, array(), NULL);
        }
    }
}

function origamiez_body_class($classes) {
    if (is_single()) {
        array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single');

        if(1 == (int)get_theme_mod('is_show_border_for_images', 1)){
          array_push($classes, 'origamiez-show-border-for-images');
        }

    } else if (is_page()) {      
        if ('template-page-fullwidth.php' == basename(get_page_template())) {
          array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-full-width');
        }else if('template-page-magazine.php' == basename(get_page_template())){
          array_push($classes, 'origamiez-page-magazine','origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-full-width');
        } else {
            array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-static-page');
        }
    } else if (is_archive() || is_home()) {
        array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-blog');
        switch (get_theme_mod('layout_taxonomy', 'thumbnail-left')) {
            case 'thumbnail-right':
                array_push($classes, 'origamiez-layout-blog-thumbnail-right');
                break;
            case 'thumbnail-full-width':
                array_push($classes, 'origamiez-layout-blog-thumbnail-full-width');
            default:
                array_push($classes, 'origamiez-layout-blog-thumbnail-left');
                break;
        }
    } elseif (is_search()) {
        array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-blog');
    } else if (is_404()) {
        array_push($classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-full-width');
    }

    $bg_image = get_background_image();
    $bg_color = get_background_color();

    if($bg_image || $bg_color){
      array_push($classes, 'origamiez_custom_bg');
    }else{
      array_push($classes, 'without_bg_slides');
    }

    if ('1' != get_theme_mod('use_layout_fullwidth', '0')) {
        array_push($classes, 'origamiez-boxer', 'container');
    } else {
        $classes[] = 'origamiez-fluid';
    }

    if(is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') || is_active_sidebar('footer-5')){
      $classes[] = 'origamiez-show-footer-area';
    }

    $skin = get_theme_mod('skin', 'default');
    if($skin){
      $classes[] = sprintf('origamiez-skin-%s', $skin);
    }

    return $classes;
}

function origamiez_archive_post_class($classes) {
    global $wp_query;

    if (0 == $wp_query->current_post) {
        array_push($classes, 'origamiez-first-post');
    }

    return $classes;
}

function origamiez_log($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

function origamiez_get_format_icon($format) {
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

    return apply_filters('origamiez_get_format_icon', $icon, $format);
}

function origamiez_get_shortcode($content, $shortcodes = array(), $enable_multi = false) {
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
                'type'      => $regex_matches_new[2],
                'content'   => $regex_matches_new[5],
                'atts'      => shortcode_parse_atts($regex_matches_new[3])
            );

            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $data;
}

function origamiez_human_time_diff($from) {
    $periods = array(
        __("second", 'origamiez'),
        __("minute", 'origamiez'),
        __("hour", 'origamiez'),
        __("day", 'origamiez'),
        __("week", 'origamiez'),
        __("month", 'origamiez'),
        __("year", 'origamiez'),
        __("decade", 'origamiez')
    );
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = current_time('timestamp');

    // Determine tense of date
    if ($now > $from) {
        $difference = $now - $from;
        $tense      = __("ago", 'origamiez');
    } else {
        $difference = $from - $now;
        $tense      = __("from now", 'origamiez');
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j].= __("s", 'origamiez');
    }

    return "$difference $periods[$j] {$tense}";
}

function origamiez_get_breadcrumb() {
    global $post, $wp_query;
    $current_class = 'current-page';
    $prefix = '&nbsp;&rsaquo;&nbsp;';
    $breadcrumb_before = '<div class="breadcrumb">';
    $breadcrumb_after = '</div>';

    $breadcrumb_home = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url(home_url()) . '" itemprop="url"><span itemprop="title">' . __('Home', 'origamiez') . '</span></a></span>';

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
            $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Posts created by %1$s', 'origamiez'), get_the_author_meta('display_name', $author_id)));
        }
    } else if (is_search()) {
        $s = get_search_query();
        $c = $wp_query->found_posts;
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf(__('Searched for "%s" return %s results', 'origamiez'), $s, $c));
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
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Page not found', 'origamiez'));
    } else {
        $breadcrumb.= $prefix . sprintf('<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, __('Latest News', 'origamiez'));
    }


    echo htmlspecialchars_decode(esc_html($breadcrumb_before));
    echo apply_filters('origamiez_get_breadcrumb', $breadcrumb, $current_class, $prefix);
    echo htmlspecialchars_decode(esc_html($breadcrumb_after));
}

function origamiez_get_author_infor() {
    global $post;
    $user_id     = $post->post_author;
    $description = get_the_author_meta('description', $user_id);
    $email       = get_the_author_meta('user_email', $user_id);
    $name        = get_the_author_meta('display_name', $user_id);
    $url         = trim(get_the_author_meta('user_url', $user_id));
    $link        = ($url) ? $url : get_author_posts_url($user_id);

    if ($description):
    ?>
      <div id="origamiez-post-author">          
          <div class="origamiez-author-info clearfix">
              <a href="<?php echo esc_url($link); ?>" class="origamiez-author-avatar">
                  <?php echo get_avatar($email, 90); ?>               
              </a>
              <div class="origamiez-author-detail">                              
                  <p class="origamiez-author-name"><?php _e('Author:', 'origamiez'); ?>&nbsp;<a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($name); ?></a></p>

                  <p class="origamiez-author-bio">                   
                      <?php echo  htmlspecialchars_decode(esc_html($description)); ?>
                  </p>                
              </div>
          </div>
      </div>
    <?php
    endif;
}

function origamiez_get_related_posts() {
    global $post;

    $tags = get_the_tags($post->ID);
    if (!empty($tags)) {
        $tag_ids = array();
        foreach ($tags as $tag) {
            $tag_ids[] = $tag->term_id;
        }

        $args = array(
            'post__not_in'   => array($post->ID),
            'posts_per_page' => 10,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'id',
                    'terms'    => $tag_ids
                )
            )
        );

        $posts = new WP_Query($args);
        if ($posts->have_posts()):
            ?>
            <div id="origamiez-post-related" class="widget">
                <h2 class="widget-title clearfix">
                    <span class="widget-title-text pull-left"><?php _e('Related Articles', 'origamiez'); ?></span>  
                    <span class="pull-right owl-custom-pagination fa fa-angle-right origamiez-transition-all"></span>
                    <span class="pull-right owl-custom-pagination fa fa-angle-left origamiez-transition-all"></span>
                </h2>

                <div class="origamiez-widget-content clearfix">
                    <div class="owl-carousel owl-theme">
                        <?php
                        while ($posts->have_posts()):
                            $posts->the_post();
                            ?>
                            <figure class="post">
                                <?php if (has_post_thumbnail()): ?>                        
                                    <?php the_post_thumbnail('origamiez-square-md', array('class'=> 'img-responsive')); ?>                                       
                                <?php else: ?>
                                    <img src="http://placehold.it/374x209" class="img-responsive">
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

function origamiez_list_comments($comment, $args, $depth) {
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

                    <?php edit_comment_link(__('Edit', 'origamiez'), '<span class="metadata-divider">&horbar;</span>&nbsp;', ''); ?>
                </div><!-- .comment-metadata -->
            </footer><!-- .comment-meta -->

            <div class="comment-content">
                <?php comment_text(true); ?>                   
            </div><!-- .comment-content -->     
                             
        </article><!-- .comment-body -->
    </li>
    <?php
}

function origamiez_comment_form($args = array(), $post_id = null) {
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

    $req              = get_option('require_name_email');
    $aria_req         = ( $req ? " aria-required='true'" : '' );
    $html5            = 'html5' === $args['format'];
    $fields           = array();
    
    $fields['author'] = '<div class="comment-form-info row clearfix">';
    $fields['author'] .= '<div class="comment-form-field col-sm-4">';
    $fields['author'] .= '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />';
    $fields['author'] .= '<span class="comment-icon fa fa-user"></span>';
    $fields['author'] .= '</div>';
    
    $fields['email']  = '<div class="comment-form-field col-sm-4">';
    $fields['email']  .= '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />';
    $fields['email']  .= '<span class="comment-icon fa fa-envelope"></span>';
    $fields['email']  .= '</div>';
    
    
    $fields['url']    = '<div class="comment-form-field col-sm-4">';
    $fields['url']    .= '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />';
    $fields['url']    .= '<span class="comment-icon fa fa-link"></span>';
    $fields['url']    .= '</div>';
    $fields['url']    .= '</div>';
    
    $required_text    = '';
    $fields           = apply_filters('comment_form_default_fields', $fields);
    
    $comment_field    = '<p class="comment-form-comment">';
    $comment_field    .= '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
    $comment_field    .= '</p>';
    
    $defaults         = array(
        'fields'               => $fields,
        'comment_field'        => $comment_field,
        'must_log_in'          => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'origamiez'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'logged_in_as'         => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'origamiez'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'id_form'              => 'commentform',
        'id_submit'            => 'submit',
        'title_reply'          => __('Leave a Reply', 'origamiez'),
        'title_reply_to'       => __('Leave a Reply to %s', 'origamiez'),
        'cancel_reply_link'    => __('Cancel reply', 'origamiez'),
        'label_submit'         => __('Post Comment', 'origamiez'),
        'format'               => 'xhtml',
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
                <?php echo  htmlspecialchars_decode(esc_html($args['must_log_in'])); ?>
                <?php
                do_action('comment_form_must_log_in_after');
                ?>
            <?php else : ?>
                <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form origamiez-widget-content clearfix" <?php echo esc_attr($html5 ? ' novalidate' : ''); ?>>
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
                        <?php echo  htmlspecialchars_decode(esc_html($args['comment_notes_before'])); ?>
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
                    <?php echo  htmlspecialchars_decode(esc_html($args['comment_notes_after'])); ?>
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

function origamiez_get_socials() {
    return array(
        'behance' => array(
            'icon'  => 'fa fa-behance',
            'label' => __('Behance', 'origamiez'),
            'color' => ''
        ),
        'bitbucket' => array(
            'icon'  => 'fa fa-bitbucket',
            'label' => __('Bitbucket', 'origamiez'),
            'color' => ''
        ),
        'codepen' => array(
            'icon'  => 'fa fa-codepen',
            'label' => __('Codepen', 'origamiez'),
            'color' => ''
        ),
        'delicious' => array(
            'icon'  => 'fa fa-delicious',
            'label' => __('Delicious', 'origamiez'),
            'color' => ''
        ),
        'deviantart' => array(
            'icon'  => 'fa fa-deviantart',
            'label' => __('Deviantart', 'origamiez'),
            'color' => ''
        ),
        'digg' => array(
            'icon'  => 'fa fa-digg',
            'label' => __('Digg', 'origamiez'),
            'color' => '#1b5891'
        ),
        'dribbble' => array(
            'icon'  => 'fa fa-dribbble',
            'label' => __('Dribbble', 'origamiez'),
            'color' => ''
        ),
        'dropbox' => array(
            'icon'  => 'fa fa-dropbox',
            'label' => __('Dropbox', 'origamiez'),
            'color' => ''
        ),
        'facebook' => array(
            'icon'  => 'fa fa-facebook',
            'label' => __('Facebook', 'origamiez'),
            'color' => '#3B5998'
        ),
        'flickr' => array(
            'icon'  => 'fa fa-flickr',
            'label' => __('Flickr', 'origamiez'),
            'color' => ''
        ),
        'foursquare' => array(
            'icon'  => 'fa fa-foursquare',
            'label' => __('Foursquare', 'origamiez'),
            'color' => ''
        ),
        'git' => array(
            'icon'  => 'fa fa-git',
            'label' => __('Git', 'origamiez'),
            'color' => ''
        ),
        'github' => array(
            'icon'  => 'fa fa-github',
            'label' => __('Github', 'origamiez'),
            'color' => ''
        ),
        'google-plus' => array(
            'icon'  => 'fa fa-google-plus',
            'label' => __('Google plus', 'origamiez'),
            'color' => '#C63D2D'
        ),
        'instagram' => array(
            'icon'  => 'fa fa-instagram',
            'label' => __('Instagram', 'origamiez'),
            'color' => ''
        ),
        'jsfiddle' => array(
            'icon'  => 'fa fa-jsfiddle',
            'label' => __('JsFiddle', 'origamiez'),
            'color' => '#007bb6'
        ),
        'linkedin' => array(
            'icon'  => 'fa fa-linkedin',
            'label' => __('linkedin', 'origamiez'),
            'color' => '#007bb6'
        ),
        'pinterest' => array(
            'icon'  => 'fa fa-pinterest',
            'label' => __('Pinterest', 'origamiez'),
            'color' => '#910101'
        ),
        'reddit' => array(
            'icon'  => 'fa fa-reddit',
            'label' => __('Reddit', 'origamiez'),
            'color' => '#ff1a00'
        ),
        'soundcloud' => array(
            'icon'  => 'fa fa-soundcloud',
            'label' => __('Soundcloud', 'origamiez'),
            'color' => ''
        ),
        'spotify' => array(
            'icon'  => 'fa fa-spotify',
            'label' => __('Spotify', 'origamiez'),
            'color' => ''
        ),
        'stack-exchange' => array(
            'icon'  => 'fa fa-stack-exchange',
            'label' => __('Stack exchange', 'origamiez'),
            'color' => ''
        ),
        'stack-overflow' => array(
            'icon'  => 'fa fa-stack-overflow',
            'label' => __('Stack overflow', 'origamiez'),
            'color' => ''
        ),
        'stumbleupon' => array(
            'icon'  => 'fa fa-stumbleupon',
            'label' => __('Stumbleupon', 'origamiez'),
            'color' => '#EB4823'
        ),
        'tumblr' => array(
            'icon'  => 'fa fa-tumblr',
            'label' => __('Tumblr', 'origamiez'),
            'color' => '#32506d'
        ),
        'twitter' => array(
            'icon'  => 'fa fa-twitter',
            'label' => __('Twitter', 'origamiez'),
            'color' => '#00A0D1'
        ),
        'vimeo' => array(
            'icon'  => 'fa fa-vimeo-square',
            'label' => __('Vimeo', 'origamiez'),
            'color' => ''
        ),
        'youtube' => array(
            'icon'  => 'fa fa-youtube',
            'label' => __('Youtube', 'origamiez'),
            'color' => '#cc181e'
        ),
        'rss' => array(
            'icon'  => 'fa fa-rss',
            'label' => __('Rss', 'origamiez'),
            'color' => '#FA9B39'
        )
    );
}

function origamiez_get_wrap_classes() {
  if ('1' == get_theme_mod('use_layout_fullwidth', '0')){
    echo 'container';
  }       
}

function origamiez_get_str_uglify($string) {
    $string = preg_replace('/\s+/', ' ', $string);
    $string = preg_replace("/[^a-zA-Z0-9\s]/", '', $string);
    return strtolower(str_replace(' ', '_', $string));
}

function origamiez_add_first_and_last_class_for_menuitem($items) {
    $items[1]->classes[] = 'origamiez-menuitem-first';
    $items[count($items)]->classes[] = 'origamiez-menuitem-last';
    return $items;
}

function origamiez_widget_order_class() {
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
          if(isset($wp_registered_widgets[$widget_id]['classname'])){
            $wp_registered_widgets[$widget_id]['classname'] .= ' origamiez-widget-order-' . $i;

            # Add first widget class
            if ( 0 == $i ) {
                $wp_registered_widgets[$widget_id]['classname'] .= ' origamiez-widget-first';
            }

            # Add last widget class
            if ( $number_of_widgets == ( $i + 1 ) ) {
                $wp_registered_widgets[$widget_id]['classname'] .= ' origamiez-widget-last';
            }
          }            
        }
    }
}

function origamiez_set_lightbox_markup($lightbox_markup, $post_id) {
    $format = get_post_format($post_id);

    if (in_array($format, array('video', 'audio'))) {
        $data = origamiez_get_shortcode(get_post_field('post_content', $post_id), array('youtube', 'vimeo', 'soundcloud'));
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

function origamiez_remove_hardcode_image_size($html){
  return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

function origamiez_register_new_image_sizes(){
  add_image_size('origamiez-square-xs', 55, 55, true);  
  add_image_size('origamiez-lightbox-full', 960, null, false);
  add_image_size('origamiez-blog-full', 840, 350, true);  
  add_image_size('origamiez-square-m', 460, 460, true);
  add_image_size('origamiez-square-md', 350, 180, true);
  add_image_size('origamiez-posts-slide-metro', 555, 555, true);  
}

function origamiez_get_image_src($post_id = 0, $size = 'thumbnail') {
    $thumb = get_the_post_thumbnail($post_id, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    }
    return $thumb;
}

function origamiez_excerpt_length_small($length){
  $length = apply_filters('origamiez_excerpt_length_small', 20);
  return $length;
}