<?php
function origamiez_render_title() {
	?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
}

function origamiez_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) {
		return $title;
	}
	$title            .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_attr__( 'Page %s', 'origamiez' ), max( $paged, $page ) );
	}

	return $title;
}

function origamiez_enqueue_scripts() {
	global $post, $wp_styles, $is_IE;
	$dir = get_template_directory_uri();
	/**
	 * --------------------------------------------------
	 * STYLESHEETS
	 * --------------------------------------------------
	 */
	// LIBS.
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'bootstrap', "{$dir}/css/bootstrap.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'bootstrap-theme', "{$dir}/css/bootstrap-theme.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'font-awesome', "{$dir}/css/font-awesome.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-navgoco', "{$dir}/css/jquery.navgoco.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-poptrox', "{$dir}/css/jquery.poptrox.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-owl-carousel', "{$dir}/css/owl.carousel.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-owl-theme', "{$dir}/css/owl.theme.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-owl-transitions', "{$dir}/css/owl.transitions.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-slidebars', "{$dir}/css/slidebars.css", array(), null );
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'jquery-superfish', "{$dir}/css/superfish.css", array(), null );
	// STYLE.
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'style', get_stylesheet_uri(), array(), null );
	// RESPONSIVE.
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'responsive', "{$dir}/css/responsive.css", array(), null );
	// FONT & COLOR.
	$skin = get_theme_mod( 'skin', 'default' );
	if ( 'custom' !== $skin ) {
		$skin_path = sprintf( '%s/skin/%s.css', get_stylesheet_directory(), $skin );
		$skin_src  = "{$dir}/skin/{$skin}.css";
		if ( file_exists( $skin_path ) ) {
			$skin_src = sprintf( '%s/skin/%s.css', get_stylesheet_directory_uri(), $skin );
		}
		wp_enqueue_style( ORIGAMIEZ_PREFIX . 'color', $skin_src, array(), null );
	} else {
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
          color: %3$s;
        }
        h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
          color: %4$s;
        }
        #origamiez-header {
          background: %16$s;
          border-bottom: 1px solid %9$s;
        }
        #origamiez-header-bottom {
          border-bottom: 1px solid %9$s;
        }
        #origamiez-header-bar-inner {
          border-bottom: 1px solid %9$s;
        }
        #main-nav {
          background: %16$s;
          border-top: 1px solid %9$s;
        }
        #main-nav.stuckMenu.isStuck {
          background-color: %16$s;
          border-bottom: 1px solid %9$s;
        }
        #main-nav.stuckMenu.isStuck .main-menu {
          border-bottom: 1px solid %9$s;
        }
        #main-menu a {
          color: %7$s;
        }
        #main-menu > li.current-menu-item > a {
          color: %5$s;
        }
        #main-menu > li:hover > a {
          color: %5$s;
        }
        #main-menu li ul {
          border-top: 3px solid %5$s;
          border-left: 1px solid %9$s;
          border-right: 1px solid %9$s;
          border-bottom: 1px solid %9$s;
          background: %16$s;
        }
        #main-menu li ul li {
          border-bottom: 1px solid %9$s;
        }
        #main-menu li ul li a {
          color: %1$s;
        }
        #main-menu li ul li:hover > a {
          color: %5$s;
        }
        #origamiez-body-inner {
          background: %16$s;
        }
        .origamiez-col-right {
          border-left: 1px solid %9$s;
        }
        #origamiez-footer-sidebars {
          /*border-top: 1px solid $line-1-bg-color;*/
          border-top: none;
          background-color: %11$s;
        }
        #origamiez-footer-end {
          background-color: %14$s;
          color: %15$s;
        }
        #bottom-menu li a {
          color: %15$s;
          border-left: 1px solid %15$s;
        }
        #bottom-menu li a:hover {
          color: %5$s;
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
          background-color: %16$s;
          color: %5$s;
        }
        #origamiez-headline-ticker .origamiez-headline-caption > span {
          border-right: 1px solid %9$s;
        }
        #origamiez-headline-ticker #origamiez-ticker a time {
          color: %5$s;
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
          border-right: 1px solid %9$s;
          background-color: %16$s;
        }
        #sidebar-center .widget {
          margin-top: -1px;
          border-top: 1px solid %9$s;
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
          border-top: 1px solid %9$s;
        }
        #sidebar-bottom .widget .widget-title-text {
          border-bottom: none;
        }
        #origamiez-footer-sidebars h2.widget-title {
          color: %13$s;
        }
        #origamiez-footer-sidebars .origamiez-widget-content {
          color: %12$s;
        }
        #origamiez-footer-sidebars .origamiez-widget-content a {
          color: %12$s;
        }
        #origamiez-footer-sidebars .widget_calendar caption {
          border-bottom-color: %8$s;
        }
        #origamiez-footer-sidebars .widget_tag_cloud .origamiez-widget-content a {
          color: %16$s;
          background-color: %8$s;
        }
        /*
         * --------------------------------------------------
         * SEARCH FORM
         * --------------------------------------------------
         */
        form.search-form .search-text {
          border: 1px solid %9$s;
        }
        form.search-form .search-submit {
          background-color: %16$s;
          color: %18$s;
        }
        /*
         * --------------------------------------------------
         * MOBILE MENU
         * --------------------------------------------------
         */
        body.without_bg_slides {
          background: %16$s;
        }
        body.without_bg_slides #sb-site,
        body.without_bg_slides .sb-site-container {
          background: %16$s;
        }
        .origamiez-mobile-icon {
          background-color: %5$s;
          color: %16$s;
        }
        .sb-slidebar {
          background-color: %11$s;
        }
        #mobile-menu a {
          color: %12$s;
        }
        #mobile-menu li {
          border-top: 1px solid %8$s;
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
          color: %12$s;
        }
        .sb-slidebar.sb-right a {
          color: %12$s;
        }
        .sb-slidebar.sb-right .widget-title {
          border-color: %8$s;
          color: %5$s;
        }
        .sb-slidebar.sb-right form.search-form .search-text {
          border-color: %8$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET
         * --------------------------------------------------
         */
        h2.widget-title {
          border-bottom: 1px solid %9$s;
        }
        #origamiez-top-banner .widget-title-text,
        #origamiez-body .widget-title-text {
          border-bottom: 1px solid %5$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET CATEGORIES | ARCHIVES (WP DEFAULT)
         * --------------------------------------------------
         */
        .widget_archive select,
        .widget_categories select {
          border: 1px solid %9$s;
        }
        .widget_rss ul li:before {
          color: %25$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS MINIMALIST
         * --------------------------------------------------
         */
        .origamiez-widget-posts-minimalist .origamiez-widget-content .origamiez-wp-m-post {
          border-top: 1px dashed %8$s;
        }
        .origamiez-widget-posts-minimalist .origamiez-widget-content .origamiez-wp-m-post.origamiez-wp-m-post-first {
          border-top: none;
        }
        .origamiez-widget-posts-minimalist .origamiez-widget-content .origamiez-wp-m-post h5 a {
          color: %12$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS TWEETS
         * --------------------------------------------------
         */
        .origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet {
          border-top: 1px solid %8$s;
        }
        .origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet:hover .fa-twitter {
          color: %22$s;
        }
        .origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet.origamiez-wp-m-tweet-first {
          border-top: none;
        }
        .origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet p.origamiez-wp-m-tweet-content a {
          color: %5$s;
        }
        #origamiez-body .origamiez-widget-tweets .origamiez-widget-content .origamiez-wp-m-tweet {
          border-top-color: %9$s;
        }
        #origamiez-body .origamiez-widget-tweets .origamiez-widget-content .fa-twitter {
          color: %22$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET NEWSLETTER
         * --------------------------------------------------
         */
        .origamiez-widget-newsletter p.newsletter-form input[type=text] {
          border: 1px solid %9$s;
        }
        .origamiez-widget-newsletter p.newsletter-form button[type=submit] {
          border: 1px solid %9$s;
        }
        .origamiez-widget-newsletter p.newsletter-form:hover button[type=submit] {
          border: 1px solid %5$s;
          background-color: %5$s;
          color: %16$s;
        }
        #origamiez-footer .origamiez-widget-newsletter p.newsletter-form input[type=text] {
          background: %11$s;
          border: 1px solid %8$s;
        }
        #origamiez-footer .origamiez-widget-newsletter p.newsletter-form button[type=submit] {
          border: 1px solid %8$s;
          background: %8$s;
          color: %6$s;
        }
        #origamiez-footer .origamiez-widget-newsletter p.newsletter-form:hover input[type=text] {
          border: 1px solid %5$s;
          color: %16$s;
        }
        #origamiez-footer .origamiez-widget-newsletter p.newsletter-form:hover button[type=submit] {
          border: 1px solid %5$s;
          background: %5$s;
          color: %16$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS SMALL THUMBNAIL
         * --------------------------------------------------
         */
        .origamiez-widget-posts-small-thumbnail .origamiez-widget-content .origamiez-wp-mt-post {
          border-top: 1px solid %9$s;
        }
        .origamiez-widget-posts-small-thumbnail .origamiez-widget-content .origamiez-wp-mt-post.origamiez-wp-mt-post-first {
          border-top: none;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS GRID
         * --------------------------------------------------
         */
        .origamiez-widget-posts-grid .origamiez-widget-content .row.row-first .origamiez-wp-grid-post {
          border-top: none;
        }
        .origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post {
          border-top: 1px solid %9$s;
          border-left: 1px solid %9$s;
          border-right: 1px solid %9$s;
          margin-left: -1px;
        }
        .origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post.origamiez-wp-grid-post-first {
          border-left: none;
        }
        .origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post.origamiez-wp-grid-post-last {
          border-right: none;
        }
        /*
         * --------------------------------------------------
         * WIDGET TAGS (WP DEFAULT)
         * --------------------------------------------------
         */
        .widget_tag_cloud .tagcloud a {
          background-color: %6$s;
        }
        .widget_tag_cloud .tagcloud a:hover {
          background-color: %5$s;
          color: %16$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET CALENDAR (WP DEFAULT)
         * --------------------------------------------------
         */
        .widget_calendar caption {
          border-bottom: 1px solid %9$s;
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
          color: %8$s;
          border: 1px solid %8$s;
        }
        a.social-link.social-link-facebook {
          color: %21$s;
          border: 1px solid %21$s;
        }
        a.social-link.social-link-twitter {
          color: %22$s;
          border: 1px solid %22$s;
        }
        a.social-link.social-link-pinterest {
          color: %24$s;
          border: 1px solid %24$s;
        }
        a.social-link.social-link-google-plus {
          color: %23$s;
          border: 1px solid %23$s;
        }
        a.social-link.social-link-rss {
          color: %25$s;
          border: 1px solid %25$s;
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
          border: 1px solid %9$s;
          color: %9$s;
        }
        .widget-title .owl-custom-pagination:hover {
          border-color: %5$s;
          color: %5$s;
        }
        /*
         * --------------------------------------------------
         * ICON
         * --------------------------------------------------
         */
        .metadata-circle-icon .fa {
          color: %5$s;
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
          background: %5$s;
          color: %16$s;
        }
        p.metadata i,
        p.metadata .metadata-author a,
        p.metadata .metadata-categories a,
        p.metadata .metadata-comment,
        p.metadata .metadata-date,
        p.metadata .metadata-views,
        p.metadata .metadata-divider {
          color: %26$s;
        }
        p.metadata .metadata-categories a:hover {
          color: %5$s;
        }
        p.metadata-readmore a {
          color: %5$s;
        }
        div.origamiez-article-metadata p.metadata-divider-horizonal {
          border-bottom: 1px dashed %9$s;
          color: %5$s;
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
          border-bottom: 1px solid %9$s;
        }
        .breadcrumb a {
          text-decoration: none;
        }
        .breadcrumb a.current-page {
          color: %5$s;
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
          border-top: 1px solid %9$s;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li.origamiez-first-post {
          border-top: none;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li article .entry-thumb a .overlay {
          background: %20$s;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li article .entry-thumb a .overlay-link {
          border: 2px solid %16$s;
        }
        body.origamiez-layout-blog #origamiez-blogposts > li article .entry-thumb a .fa {
          color: %16$s;
        }
        /*
         * --------------------------------------------------
         * BLOG PAGE MASONRY
         * --------------------------------------------------
         */
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts {
          border-bottom: 1px solid %9$s;
        }
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts .item {
          border-bottom: none;
          border-right: none;
          border-left: 1px solid %9$s;
          border-top: 1px solid %9$s;
        }
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts-loadmore {
          background-color: %5$s;
        }
        body.origamiez-layout-blog.origamiez-layout-blog-masonry #origamiez-blogposts-loadmore a {
          color: %16$s;
        }
        /*
         * --------------------------------------------------
         * PAGINATION
         * --------------------------------------------------
         */
        ul.page-numbers {
          border-top: 1px solid %9$s;
        }
        ul.page-numbers li a, ul.page-numbers li span {
          border: 1px solid %9$s;
          text-decoration: none;
          transition: all 0.5s;
          -ms-transition: all 0.5s;
          -webkit-transition: all 0.5s;
          -moz-transition: all 0.5s;
        }
        ul.page-numbers li span.dots {
          border-color: transparent;
        }
        ul.page-numbers li a:hover, ul.page-numbers li span.current {
          color: %5$s;
          border-color: %5$s;
        }
        #origamiez_singular_pagination a {
          color: %5$s;
        }
        /*
         * --------------------------------------------------
         * SINGLE PAGE
         * --------------------------------------------------
         */
        body.origamiez-layout-single #origamiez-post-wrap div.entry-tag {
          border-top: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-category,
        body.origamiez-layout-single #origamiez-post-tag {
          border-top: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-category span,
        body.origamiez-layout-single #origamiez-post-category a,
        body.origamiez-layout-single #origamiez-post-tag span,
        body.origamiez-layout-single #origamiez-post-tag a {
          background-color: %6$s;
        }
        body.origamiez-layout-single #origamiez-post-category span:hover,
        body.origamiez-layout-single #origamiez-post-category a:hover,
        body.origamiez-layout-single #origamiez-post-tag span:hover,
        body.origamiez-layout-single #origamiez-post-tag a:hover {
          background-color: %5$s;
          color: %16$s;
        }
        body.origamiez-layout-single #origamiez-post-category span,
        body.origamiez-layout-single #origamiez-post-tag span {
          color: %5$s;
        }
        body.origamiez-layout-single #origamiez-post-category {
          border-top: none;
        }
        body.origamiez-layout-single #origamiez-post-adjacent {
          border-top: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-adjacent div.origamiez-post-adjacent-prev {
          border-right: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-adjacent div.origamiez-post-adjacent-next {
          border-left: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-author {
          border-top: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-author .origamiez-author-name a {
          color: %5$s;
        }
        body.origamiez-layout-single #origamiez-post-author .origamiez-author-socials a {
          border: 1px solid %9$s;
        }
        body.origamiez-layout-single #origamiez-post-related .origamiez-widget-content figure.post figcaption a {
          color: %16$s;
          background-color: %20$s;
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
          border-top: 1px dashed %9$s;
        }
        #comments #comment-nav-below {
          border-top: 1px dashed %9$s;
        }
        #comments .comment-list > li:first-child {
          border-top: none;
        }
        #comments .pingback,
        #comments .comment {
          border-top: 1px solid %9$s;
        }
        #comments .pingback .comment-meta .comment-author .fn a,
        #comments .comment .comment-meta .comment-author .fn a {
          color: %5$s;
        }
        #comments #respond {
          border-top: 1px solid %9$s;
        }
        #comments #respond .comment-form-info input {
          border: 1px solid %9$s;
        }
        #comments #respond .comment-form-comment textarea {
          border: 1px solid %9$s;
        }
        #comments #respond .form-submit input {
          color: %16$s;
          border: none;
          background-color: %5$s;
        }
        /*
         * --------------------------------------------------
         * DIVIDER
         * --------------------------------------------------
         */
        .separator {
          border-bottom-width: 1px;
          border-bottom-color: %9$s;
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
          border: 1px solid %9$s;
        }
        .wpcf7-form .wpcf7-form-control.wpcf7-submit {
          background-color: %5$s;
          border: 1px solid %5$s;
          color: %16$s;
        }
        .wpcf7-form .wpcf7-form-control.wpcf7-submit:hover {
          color: %5$s;
          background-color: %16$s;
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
          border: 1px solid %9$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-summary {
          border-bottom: 1px solid %9$s;
        }
        #origamiez-admin-rating .origamiez-rating-total {
          background-color: %5$s;
        }
        #origamiez-admin-rating .origamiez-rating-total span {
          color: %16$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-left {
          font-size: 16px;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-right .circle {
          border: 3px solid %5$s;
          background: %16$s;
          color: %5$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-right .line-front {
          background-color: %5$s;
        }
        #origamiez-admin-rating .origamiez-admin-rating-per-featured .col-right .line-back {
          background-color: %9$s;
        }
        .origamiez-rating-total-inside-widget {
          background: %5$s;
          color: %16$s;
        }
        /*
         * --------------------------------------------------
         * CONTACT INFORMATION
         * --------------------------------------------------
         */
        .origamiez-contact-information .origamiez-contact-block .fa {
          color: %5$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS TWO COLS (1.1.4)
         * --------------------------------------------------
         */
        .origamiez-widget-posts-two-cols .article-col-right article {
          border-top: 1px solid %9$s;
        }
        .origamiez-widget-posts-two-cols .article-col-right article.origamiez-post-1 {
          border-top: none !important;
        }
        /*
         * --------------------------------------------------
         * WIDGET MEDIA (1.1.6)
         * --------------------------------------------------
         */
        .origamiez-widget-posts-with-format-icon .origamiez-widget-content .origamiez-w-m-post {
          border-top: 1px solid %9$s;
        }
        .origamiez-widget-posts-with-format-icon .origamiez-widget-content .metadata-circle-icon {
          border: 1px solid %16$s;
        }
        .origamiez-widget-posts-with-format-icon .origamiez-widget-content .metadata-circle-icon .fa {
          color: %16$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS ZEBRA (1.1.6)
         * --------------------------------------------------
         */
        .origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post {
          border-bottom: 1px solid %10$s;
        }
        .origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post:last-child {
          border-bottom: none;
        }
        .origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post.even {
          background-color: %6$s;
        }
        .origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post.odd {
          background-color: %16$s;
        }
        .origamiez-widget-posts-zebra .origamiez-widget-content .origamiez-wp-zebra-post .metadata {
          margin-top: 10px;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS WITH BACKGROUND (1.1.6)
         * --------------------------------------------------
         */
        .origamiez-widget-posts-with-background .origamiez-widget-content .origamiez-wp-post {
          background-color: %6$s;
        }
        .origamiez-widget-posts-with-background .origamiez-widget-content .origamiez-wp-post .origamiez-wp-post-index {
          border: 1px solid %5$s;
          color: %5$s;
        }
        /*
         * --------------------------------------------------
         * WIDGET POSTS SLIDER (1.1.6)
         * --------------------------------------------------
         */
        .origamiez-widget-posts-slider .origamiez-widget-content .item .caption {
          background-color: %16$s;
        }
        .origamiez-widget-posts-slider .origamiez-widget-content .col-right .owl-pagination {
          background-color: rgba(255, 255, 255, 0.5);
        }
        /*
         * --------------------------------------------------
         * RESPONSIVE (COLOR)
         * --------------------------------------------------
         */
        @media only screen and (max-width: 1023px) {
          #sidebar-right {
            border-top: 1px solid %9$s;
          }
        }
        @media only screen and (max-width: 767px) {
          #origamiez-post-adjacent .origamiez-post-adjacent-next {
            border-top: 1px dashed %9$s;
          }
          .origamiez-widget-posts-grid .origamiez-widget-content {
            padding-bottom: 20px;
          }
          .origamiez-widget-posts-grid .origamiez-widget-content .row .origamiez-wp-grid-post {
            border-top: 1px solid %9$s;
            border-right: none;
            border-left: none;
          }
          .origamiez-widget-posts-grid .origamiez-widget-content .row.row-first .origamiez-wp-grid-post {
            border-top: 1px solid %9$s;
          }
          .origamiez-widget-posts-grid .origamiez-widget-content .row.row-first .origamiez-wp-grid-post.origamiez-wp-grid-post-first {
            border-top: none;
          }
          .origamiez-widget-posts-playlist .row-first .origamiez-wp-other-post-even .entry-title {
            border-top: 1px solid %8$s" !important;
          }
          .origamiez-widget-posts-two-cols .article-col-right {
            border-top: 1px solid %9$s;
          }
        }
        @media only screen and (max-width: 767px) {
          body.origamiez-page-magazine #main-center-outer > .origamiez-left,
          body.origamiez-page-magazine #main-center-inner > .origamiez-left {
            border-right: none !important;
          }
        }
        @media only screen and (min-width: 1024px) and (max-width: 1179px) {
          .origamiez-col-right {
            border-right: 1px solid %9$s;
          }
        }
        @media only screen and (min-width: 980px) and (max-width: 1023px) {
          .origamiez-col-right {
            border-right: 1px solid %9$s;
          }
        }
        @media only screen and (min-width: 900px) and (max-width: 979px) {
          .origamiez-col-right {
            border-right: 1px solid %9$s;
          }
        }
        @media only screen and (min-width: 800px) and (max-width: 899px) {
          .origamiez-col-right {
            border-right: 1px solid %9$s;
          }
        }
        @media only screen and (min-width: 768px) and (max-width: 799px) {
          .origamiez-col-right {
            border-right: 1px solid %9$s;
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
          border-bottom-color: %9$s;
        }
        /*
         * --------------------------------------------------
         * UPDATE :: 2015.06.26
         * --------------------------------------------------
         */
        body.origamiez-page-magazine #sidebar-main-center-top,
        body.origamiez-page-magazine #sidebar-main-top {
          border-bottom: 1px solid %9$s;
        }
        body.origamiez-page-magazine #main-center-outer > .origamiez-left,
        body.origamiez-page-magazine #main-center-inner > .origamiez-left {
          border-right: 1px solid %9$s;
        }
        body.origamiez-layout-single.origamiez-show-border-for-images .wp-caption.aligncenter, body.origamiez-layout-single.origamiez-show-border-for-images .wp-caption.alignleft, body.origamiez-layout-single.origamiez-show-border-for-images .wp-caption.alignright {
          border: 1px solid %9$s;
          background-color: %10$s;
        }
        #origamiez-top-bar {
          border-bottom: 1px solid %9$s;
        }
        #top-menu li.lang-item.current-lang a {
          color: %5$s;
        }
        #origamiez-blogposts > li.sticky article {
          background-color: %6$s;
        }
        /*
         * --------------------------------------------------
         * UPDATE :: 2015.07.07 (1.1.9)
         * --------------------------------------------------
         */
        p.origamiez-readmore-block > a,
        #origamiez-footer-copyright > a {
          color: %5$s;
        }
        p.origamiez-readmore-block > a:hover,
        #origamiez-footer-copyright > a:hover {
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
          filter: alpha(opacity=90);
          -moz-opacity: 0.9;
          -khtml-opacity: 0.9;
          opacity: 0.9;
        }
        .entry-content a {
          color: %5$s;
        }
        .entry-content a:hover {
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";
          filter: alpha(opacity=90);
          -moz-opacity: 0.9;
          -khtml-opacity: 0.9;
          opacity: 0.9;
        }
        .entry-content q,
        .entry-content blockquote {
          border-left: 3px solid %5$s;
        }
        #bottom-mobile-menu {
          background-color: transparent;
          border: 3px solid %11$s;
        }
        #top-mobile-menu {
          border: 3px solid %9$s;
        }
        #bottom-mobile-menu:hover,
        #top-mobile-menu:hover {
          border-color: %5$s;
        }
        /*
         * --------------------------------------------------
         * UPDATE :: 2015.07.22 (1.2.2)
         * --------------------------------------------------
         */
        #origamiez_singular_pagination a {
          border-right: 3px solid %5$s;
        }
        body.page-template-template-page-three-cols #sidebar-middle,
        body.origamiez-taxonomy-three-cols #sidebar-middle,
        body.origamiez-single-post-three-cols #sidebar-middle {
          border-right: 1px solid %9$s;
        }
        body.page-template-template-page-three-cols-slm #sidebar-center,
        body.origamiez-taxonomy-three-cols-slm #sidebar-center,
        body.origamiez-single-post-three-cols-slm #sidebar-center {
          border-left: 1px solid %9$s;
        }';
		$custom_color = sprintf(
			$custom_color, get_theme_mod( 'body_color', '#666666' ), // 1. body_color.
			get_theme_mod( 'heading_color', '#333333' ), // 2.heading_color.
			get_theme_mod( 'link_color', '#333333' ), // 3.link_color.
			get_theme_mod( 'link_hover_color', '#E74C3C' ), // 4.link_hover_color.
			get_theme_mod( 'primary_color', '#E74C3C' ), // 5.primary_color.
			get_theme_mod( 'secondary_color', '#F9F9F9' ), // 6.secondary_color.
			get_theme_mod( 'main_menu_color', '#666666' ), // 7.main_menu_color.
			get_theme_mod( 'line_1_color', '#555555' ), // 8.line_1_color.
			get_theme_mod( 'line_2_color', '#DDDDDD' ), // 9.line_2_color.
			get_theme_mod( 'line_3_color', '#E5E5E5' ), // 10.line_3_color.
			get_theme_mod( 'footer_sidebars_bg_color', '#293535' ), // 11.footer_sidebars_bg_color.
			get_theme_mod( 'footer_sidebars_text_color', '#999999' ), // 12.footer_sidebars_text_color.
			get_theme_mod( 'footer_widget_title_color', '#FFFFFF' ), // 13.footer_widget_title_color.
			get_theme_mod( 'footer_info_bg_color', '#111111' ), // 14.footer_info_bg_color.
			get_theme_mod( 'footer_info_text_color', '#999999' ), // 15.footer_info_text_color.
			'#FFFFFF', // 16 :white.
			'#000000', // 17 :black.
			'#DFDFDF', // 18 :black-light.
			'rgba(255, 255, 255, 0.5)', // 19 :overlay_white.
			'rgba(0, 0, 0, 0.5)', // 20 :overlay_black.
			'#3B5998', // 21 :facebook-color.
			'#00A0D1', // 22 :twitter-color.
			'#C63D2D', // 23 :google-plus-color.
			'#910101', // 24 :pinterest-color.
			'#FA9B39', // 25 :rss-color.
			'#777777' // 26 :metadata.
		);
		wp_add_inline_style( ORIGAMIEZ_PREFIX . 'style', $custom_color );
	}
	// GOOGLE FONT.
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'origamiez' ) ) {
		$google_fonts_url = add_query_arg( 'family', urlencode( 'Oswald:400,700&subset=latin,vietnamese|Noto Sans:400,400italic,700,700italic&subset=latin,vietnamese|Josefin+Slab:400,400italic,700italic,700' ), '//fonts.googleapis.com/css' );
		wp_enqueue_style( ORIGAMIEZ_PREFIX . 'google-fonts', $google_fonts_url, array(), false, 'all' );
	}
	// DYNAMIC FONT.
	$font_groups            = array();
	$number_of_google_fonts = (int) apply_filters( 'origamiez_get_number_of_google_fonts', 3 );
	if ( $number_of_google_fonts ) {
		for ( $i = 0; $i < $number_of_google_fonts; $i ++ ) {
			$font_family = get_theme_mod( sprintf( 'google_font_%s_name', $i ), '' );
			$font_src    = get_theme_mod( sprintf( 'google_font_%s_src', $i ), '' );
			if ( $font_family && $font_src ) {
				$font_family_slug                            = origamiez_get_str_uglify( $font_family );
				$font_groups['dynamic'][ $font_family_slug ] = $font_src;
			}
		}
	}
	foreach ( $font_groups as $font_group ) {
		if ( $font_group ) {
			foreach ( $font_group as $font_slug => $font ) {
				wp_enqueue_style( ORIGAMIEZ_PREFIX . $font_slug, $font, array(), null );
			}
		}
	}
	$typography_path = sprintf( '%s/typography/default.css', get_stylesheet_directory() );
	$typography_src  = "{$dir}/typography/default.css";
	if ( file_exists( $typography_path ) ) {
		$typography_src = sprintf( '%s/typography/default.css', get_stylesheet_directory_uri() );
	}
	wp_enqueue_style( ORIGAMIEZ_PREFIX . 'typography', $typography_src, array(), null );
	/**
	 * --------------------------------------------------
	 * SCRIPTS.
	 * --------------------------------------------------
	 */
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'modernizr', "{$dir}/js/modernizr.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'bootstrap', "{$dir}/js/bootstrap.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'hoverIntent', "{$dir}/js/hoverIntent.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-easing', "{$dir}/js/jquery.easing.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-fitvids', "{$dir}/js/jquery.fitvids.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-navgoco', "{$dir}/js/jquery.navgoco.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-poptrox', "{$dir}/js/jquery.poptrox.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-transit', "{$dir}/js/jquery.transit.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-owl-carousel', "{$dir}/js/owl.carousel.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-slidebars', "{$dir}/js/slidebars.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-superfish', "{$dir}/js/superfish.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'jquery-jquery.match-height', "{$dir}/js/jquery.match-height.js", array( 'jquery' ), null, true );
	wp_enqueue_script( ORIGAMIEZ_PREFIX . 'origamiez-init', "{$dir}/js/origamiez.init.js", array( 'jquery' ), null, true );
	wp_localize_script( ORIGAMIEZ_PREFIX . 'origamiez-init', 'origamiez_vars', apply_filters( 'get_origamiez_vars', array(
		'info'   => array(
			'home_url'     => esc_url( home_url() ),
			'template_uri' => get_template_directory_uri(),
			'affix'        => '',
		),
		'config' => array(
			'is_enable_lightbox'           => (int) get_theme_mod( 'is_enable_lightbox', 1 ),
			'is_enable_convert_flat_menus' => (int) get_theme_mod( 'is_enable_convert_flat_menus', 1 ),
			'is_use_gallery_popup'         => (int) get_theme_mod( 'is_use_gallery_popup', 1 ),
		),
	) ) );
	/**
	 * --------------------------------------------------
	 * IE FIX.
	 * --------------------------------------------------
	 */
	if ( $is_IE ) {
		wp_register_style( ORIGAMIEZ_PREFIX . 'ie', $dir . '/css/ie.css', array(), null );
		wp_enqueue_style( ORIGAMIEZ_PREFIX . 'ie' );
		$wp_styles->add_data( ORIGAMIEZ_PREFIX . 'ie', 'conditional', 'lt IE 9' );
		wp_enqueue_script( ORIGAMIEZ_PREFIX . 'html5', "{$dir}/js/html5shiv.js", array(), null, true );
		wp_enqueue_script( ORIGAMIEZ_PREFIX . 'respond', "{$dir}/js/respond.js", array(), null, true );
		wp_enqueue_script( ORIGAMIEZ_PREFIX . 'pie', "{$dir}/js/pie.js", array(), null, true );
	}
	/*
    * --------------------------------------------------
    * CUSTOM FONT.
    * --------------------------------------------------
    */
	$rules        = array(
		'family'      => 'font-family',
		'size'        => 'font-size',
		'style'       => 'font-style',
		'weight'      => 'font-weight',
		'line_height' => 'line-height',
	);
	$font_objects = array(
		'font_body'          => 'body',
		'font_menu'          => '#main-menu a',
		'font_site_title'    => '#site-home-link #site-title',
		'font_site_subtitle' => '#site-home-link #site-desc',
		'font_widget_title'  => 'h2.widget-title',
		'font_h1'            => 'h1',
		'font_h2'            => 'h2',
		'font_h3'            => 'h3',
		'font_h4'            => 'h4',
		'font_h5'            => 'h5',
		'font_h6'            => 'h6',
	);
	foreach ( $font_objects as $font_object_slug => $font_object ) {
		$is_enable = (int) get_theme_mod( "{$font_object_slug}_is_enable", 0 );
		if ( $is_enable ) {
			foreach ( $rules as $rule_slug => $rule ) {
				$font_data = get_theme_mod( "{$font_object_slug}_{$rule_slug}" );
				if ( ! empty( $font_data ) ) {
					$tmp = sprintf( '%s {%s: %s;}', $font_object, $rule, $font_data );
					wp_add_inline_style( ORIGAMIEZ_PREFIX . 'typography', $tmp );
				}
			}
		}
	}
	$google_fonts_links = array();
	if ( ! empty( $google_fonts_links ) ) {
		foreach ( $google_fonts_links as $slug => $link ) {
			wp_enqueue_style( ORIGAMIEZ_PREFIX . $slug, $link, array(), null );
		}
	}

	/*
    * --------------------------------------------------
    * CUSTOM CSS.
    * --------------------------------------------------
    */
	$css = wp_kses( get_theme_mod( 'custom_css' ), origamiez_get_allowed_tags() );
	if ( ! empty( $css ) ) {
		wp_add_inline_style( ORIGAMIEZ_PREFIX . 'style', $css );
	}
}

function origamiez_body_class( $classes ) {
	if ( is_single() ) {
		array_push( $classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single' );
		if ( 1 === (int) get_theme_mod( 'is_show_border_for_images', 1 ) ) {
			array_push( $classes, 'origamiez-show-border-for-images' );
		}
	} else if ( is_page() ) {
		if ( in_array( basename( get_page_template() ), array(
			'template-page-fullwidth-centered.php',
			'template-page-fullwidth.php'
		), true ) ) {
			array_push( $classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-full-width' );
		} else if ( 'template-page-magazine.php' === basename( get_page_template() ) ) {
			array_push( $classes, 'origamiez-page-magazine', 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-full-width' );
			$sidebar_right = apply_filters( 'origamiez_get_current_sidebar', 'right', 'right' );
			if ( ! is_active_sidebar( $sidebar_right ) ) {
				$classes[] = 'origamiez-missing-sidebar-right';
			}
		} else {
			array_push( $classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-static-page' );
		}
	} else if ( is_archive() || is_home() ) {
		array_push( $classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-blog' );
		switch ( get_theme_mod( 'taxonomy_thumbnail_style', 'thumbnail-left' ) ) {
			case 'thumbnail-right':
				array_push( $classes, 'origamiez-layout-blog-thumbnail-right' );
				break;
			case 'thumbnail-full-width':
				array_push( $classes, 'origamiez-layout-blog-thumbnail-full-width' );
				break;
			default:
				array_push( $classes, 'origamiez-layout-blog-thumbnail-left' );
				break;
		}
		if ( is_home() || is_tag() || is_category() || is_author() || is_day() || is_month() || is_year() ) {
			$taxonomy_layout = get_theme_mod( 'taxonomy_layout', 'two-cols' );
			if ( $taxonomy_layout ) {
				$classes[] = "origamiez-taxonomy-{$taxonomy_layout}";
			}
		}
	} elseif ( is_search() ) {
		array_push( $classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-blog' );
	} else if ( is_404() ) {
		array_push( $classes, 'origamiez-layout-right-sidebar', 'origamiez-layout-single', 'origamiez-layout-full-width' );
	}
	$bg_image = get_background_image();
	$bg_color = get_background_color();
	if ( $bg_image || $bg_color ) {
		array_push( $classes, 'origamiez_custom_bg' );
	} else {
		array_push( $classes, 'without_bg_slides' );
	}
	if ( 1 !== (int) get_theme_mod( 'use_layout_fullwidth', '0' ) ) {
		array_push( $classes, 'origamiez-boxer' );
	} else {
		$classes[] = 'origamiez-fluid';
	}
	if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-5' ) ) {
		$classes[] = 'origamiez-show-footer-area';
	}
	$skin = get_theme_mod( 'skin', 'default' );
	if ( $skin ) {
		$classes[] = sprintf( 'origamiez-skin-%s', $skin );
	}
	$header_style = get_theme_mod( 'header_style', 'left-right' );
	if ( $header_style ) {
		$classes[] = sprintf( 'origamiez-header-style-%s', $header_style );
	}
	if ( is_single() ) {
		$single_post_layout = get_theme_mod( 'single-post-layout', 'two-cols' );
		$classes[]          = "origamiez-single-post-{$single_post_layout}";
	}
	if ( is_home() || is_archive() || is_single() ) {
		$sidebar_right = apply_filters( 'origamiez_get_current_sidebar', 'right', 'right' );
		if ( ! is_active_sidebar( $sidebar_right ) ) {
			$classes[] = 'origamiez-missing-sidebar-right';
		}
		$sidebar_left = apply_filters( 'origamiez_get_current_sidebar', 'left', 'left' );
		if ( ! is_active_sidebar( $sidebar_left ) ) {
			$classes[] = 'origamiez-missing-sidebar-left';
		}
	}

	return $classes;
}

function origamiez_global_wapper_open() {
	if ( 1 !== (int) get_theme_mod( 'use_layout_fullwidth', 0 ) ) {
		echo '<div class="container">';
	}
}

function origamiez_global_wapper_close() {
	if ( 1 !== (int) get_theme_mod( 'use_layout_fullwidth', 0 ) ) {
		echo '<div class="close">';
	}
}

function origamiez_archive_post_class( $classes ) {
	global $wp_query;
	if ( 0 === $wp_query->current_post ) {
		array_push( $classes, 'origamiez-first-post' );
	}

	return $classes;
}

function origamiez_get_format_icon( $format ) {
	switch ( $format ) {
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

	return apply_filters( 'origamiez_get_format_icon', $icon, $format );
}

function origamiez_get_shortcode( $content, $shortcodes = array(), $enable_multi = false ) {
	$data          = array();
	$regex_matches = '';
	$regex_pattern = get_shortcode_regex();
	preg_match_all( '/' . $regex_pattern . '/s', $content, $regex_matches );
	foreach ( $regex_matches[0] as $shortcode ) {
		$regex_matches_new = '';
		preg_match( '/' . $regex_pattern . '/s', $shortcode, $regex_matches_new );
		if ( in_array( $regex_matches_new[2], $shortcodes, true ) ) :
			$data[] = array(
				'shortcode' => $regex_matches_new[0],
				'type'      => $regex_matches_new[2],
				'content'   => $regex_matches_new[5],
				'atts'      => shortcode_parse_atts( $regex_matches_new[3] ),
			);
			if ( false === $enable_multi ) {
				break;
			}
		endif;
	}

	return $data;
}

function origamiez_human_time_diff( $from ) {
	$periods = array(
		esc_attr__( 'second', 'origamiez' ),
		esc_attr__( 'minute', 'origamiez' ),
		esc_attr__( 'hour', 'origamiez' ),
		esc_attr__( 'day', 'origamiez' ),
		esc_attr__( 'week', 'origamiez' ),
		esc_attr__( 'month', 'origamiez' ),
		esc_attr__( 'year', 'origamiez' ),
		esc_attr__( 'decade', 'origamiez' ),
	);
	$lengths = array( '60', '60', '24', '7', '4.35', '12', '10' );
	$now     = current_time( 'timestamp' );
	// Determine tense of date.
	if ( $now > $from ) {
		$difference = $now - $from;
		$tense      = esc_attr__( 'ago', 'origamiez' );
	} else {
		$difference = $from - $now;
		$tense      = esc_attr__( 'from now', 'origamiez' );
	}
	for ( $j = 0; ( $difference >= $lengths[ $j ] && $j < count( $lengths ) - 1 ); $j ++ ) {
		$difference /= $lengths[ $j ];
	}
	$difference = round( $difference );
	if ( 1 !== $difference ) {
		$periods[ $j ] .= esc_attr__( 's', 'origamiez' );
	}

	return "$difference $periods[$j] {$tense}";
}

function origamiez_get_breadcrumb() {
	global $post, $wp_query;
	$current_class     = 'current-page';
	$prefix            = '&nbsp;&rsaquo;&nbsp;';
	$breadcrumb_before = '<div class="breadcrumb">';
	$breadcrumb_after  = '</div>';
	$breadcrumb_home   = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( home_url() ) . '" itemprop="url"><span itemprop="title">' . esc_attr__( 'Home', 'origamiez' ) . '</span></a></span>';
	$breadcrumb        = $breadcrumb_home;
	if ( is_archive() ) {
		if ( is_tag() ) {
			$term       = get_term( get_queried_object_id(), 'post_tag' );
			$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $term->name );
		} else if ( is_category() ) {
			$terms_link = explode( $prefix, substr( get_category_parents( get_queried_object_id(), true, $prefix ), 0, ( strlen( $prefix ) * - 1 ) ) );
			$n          = count( $terms_link );
			if ( $n > 1 ) {
				for ( $i = 0; $i < ( $n - 1 ); $i ++ ) {
					$breadcrumb .= $prefix . $terms_link[ $i ];
				}
			}
			$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, get_the_category_by_ID( get_queried_object_id() ) );
		} else if ( is_year() || is_month() || is_day() ) {
			$m    = get_query_var( 'm' );
			$date = array( 'y' => null, 'm' => null, 'd' => null );
			if ( strlen( $m ) >= 4 ) {
				$date['y'] = substr( $m, 0, 4 );
			}
			if ( strlen( $m ) >= 6 ) {
				$date['m'] = substr( $m, 4, 2 );
			}
			if ( strlen( $m ) >= 8 ) {
				$date['d'] = substr( $m, 6, 2 );
			}
			if ( $date['y'] ) {
				if ( is_year() ) {
					$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['y'] );
				}
			} else {
				$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_year_link( $date['y'] ), $date['y'] );
			}
			if ( $date['m'] ) {
				if ( is_month() ) {
					$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, date( 'F', mktime( 0, 0, 0, $date['m'] ) ) );
				}
			} else {
				$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_month_link( $date['y'], $date['m'] ), date( 'F', mktime( 0, 0, 0, $date['m'] ) ) );
			}
			if ( $date['d'] ) {
				if ( is_day() ) {
					$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, $date['d'] );
				}
			} else {
				$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_day_link( $date['y'], $date['m'], $date['d'] ), $date['d'] );
			}
		} else if ( is_author() ) {
			$author_id  = get_queried_object_id();
			$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf( esc_attr__( 'Posts created by %1$s', 'origamiez' ), get_the_author_meta( 'display_name', $author_id ) ) );
		}
	} else if ( is_search() ) {
		$s          = get_search_query();
		$c          = $wp_query->found_posts;
		$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, sprintf( esc_attr__( 'Searched for "%s" return %s results', 'origamiez' ), $s, $c ) );
	} else if ( is_singular() ) {
		if ( is_page() ) {
			$post_ancestors = get_post_ancestors( $post );
			if ( $post_ancestors ) {
				$post_ancestors = array_reverse( $post_ancestors );
				foreach ( $post_ancestors as $crumb ) {
					$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_permalink( $crumb ), esc_html( get_the_title( $crumb ) ) );
				}
			}
			$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink( get_queried_object_id() ), esc_html( get_the_title( get_queried_object_id() ) ) );
		} else if ( is_single() ) {
			$categories = get_the_category( get_queried_object_id() );
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', get_category_link( $category->term_id ), $category->name );
				}
			}
			$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url" href="%2$s"><span itemprop="title">%3$s</span></a></span>', $current_class, get_permalink( get_queried_object_id() ), esc_html( get_the_title( get_queried_object_id() ) ) );
		}
	} else if ( is_404() ) {
		$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, esc_attr__( 'Page not found', 'origamiez' ) );
	} else {
		$breadcrumb .= $prefix . sprintf( '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="%1$s" itemprop="url"><span itemprop="title">%2$s</span></a></span>', $current_class, esc_attr__( 'Latest News', 'origamiez' ) );
	}
	echo wp_kses( $breadcrumb_before, origamiez_get_allowed_tags() );
	echo wp_kses( apply_filters( 'origamiez_get_breadcrumb', $breadcrumb, $current_class, $prefix ), origamiez_get_allowed_tags() );
	echo wp_kses( $breadcrumb_after, origamiez_get_allowed_tags() );
}

function origamiez_get_author_infor() {
	global $post;
	$user_id     = $post->post_author;
	$description = get_the_author_meta( 'description', $user_id );
	$email       = get_the_author_meta( 'user_email', $user_id );
	$name        = get_the_author_meta( 'display_name', $user_id );
	$url         = trim( get_the_author_meta( 'user_url', $user_id ) );
	$link        = ( $url ) ? $url : get_author_posts_url( $user_id );
	?>
    <div id="origamiez-post-author">
        <div class="origamiez-author-info clearfix">
            <a href="<?php echo esc_url( $link ); ?>" class="origamiez-author-avatar">
				<?php echo wp_kses( get_avatar( $email, 90 ), origamiez_get_allowed_tags() ); ?>
            </a>
            <div class="origamiez-author-detail">
                <p class="origamiez-author-name"><?php esc_html_e( 'Author:', 'origamiez' ); ?>&nbsp;<a
                            href="<?php echo esc_url( $link ); ?>"><?php echo esc_attr( $name ); ?></a></p>
                <p class="origamiez-author-bio"><?php echo wp_kses( $description, origamiez_get_allowed_tags() ); ?></p>
            </div>
        </div>
    </div>
	<?php
}

function origamiez_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <article class="comment-body clearfix" id="div-comment-23">
            <span class="comment-avatar pull-left">
    					<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
            </span>
        <footer class="comment-meta">
            <div class="comment-author vcard">
                    <span class="fn">
    									<?php comment_author_link(); ?>
                    </span>
            </div><!-- .comment-author -->
            <div class="comment-metadata">
                <span class="metadata-divider"><?php origamiez_get_metadata_prefix(); ?></span>
                <a href="#">
					<?php comment_time( get_option( 'date_format' ) . ' - ' . get_option( 'time_format' ) ); ?>
                </a>
				<?php comment_reply_link( array_merge( $args, array(
					'before'    => '<span class="metadata-divider"><?php origamiez_get_metadata_prefix(); ?></span>&nbsp;',
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>
				<?php edit_comment_link( esc_attr__( 'Edit', 'origamiez' ), '<span class="metadata-divider"><?php origamiez_get_metadata_prefix(); ?></span>&nbsp;', '' ); ?>
            </div><!-- .comment-metadata -->
        </footer><!-- .comment-meta -->
        <div class="comment-content">
			<?php comment_text(); ?>
        </div><!-- .comment-content -->
    </article><!-- .comment-body -->
	<?php
}

function origamiez_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$args          = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}
	$req              = get_option( 'require_name_email' );
	$aria_req         = ( $req ? " aria-required='true'" : '' );
	$html5            = 'html5' === $args['format'];
	$fields           = array();
	$fields['author'] = '<div class="comment-form-info row clearfix">';
	$fields['author'] .= '<div class="comment-form-field col-sm-4">';
	$fields['author'] .= '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />';
	$fields['author'] .= '<span class="comment-icon fa fa-user"></span>';
	$fields['author'] .= '</div>';
	$fields['email']  = '<div class="comment-form-field col-sm-4">';
	$fields['email']  .= '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />';
	$fields['email']  .= '<span class="comment-icon fa fa-envelope"></span>';
	$fields['email']  .= '</div>';
	$fields['url']    = '<div class="comment-form-field col-sm-4">';
	$fields['url']    .= '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />';
	$fields['url']    .= '<span class="comment-icon fa fa-link"></span>';
	$fields['url']    .= '</div>';
	$fields['url']    .= '</div>';
	$fields           = apply_filters( 'comment_form_default_fields', $fields );
	$comment_field    = '<p class="comment-form-comment">';
	$comment_field    .= '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
	$comment_field    .= '</p>';
	$defaults         = array(
		'fields'               => $fields,
		'comment_field'        => $comment_field,
		'must_log_in'          => '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.', 'origamiez' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( esc_html__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'origamiez' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => esc_attr__( 'Leave a Reply', 'origamiez' ),
		'title_reply_to'       => esc_attr__( 'Leave a Reply to %s', 'origamiez' ),
		'cancel_reply_link'    => esc_attr__( 'Cancel reply', 'origamiez' ),
		'label_submit'         => esc_attr__( 'Post Comment', 'origamiez' ),
		'format'               => 'xhtml',
	);
	$args             = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
	?>
	<?php if ( comments_open( $post_id ) ) : ?>
		<?php
		do_action( 'comment_form_before' );
		?>
        <div class="comment-respond" id="respond">
            <h2 id="reply-title"
                class="comment-reply-title widget-title clearfix"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?>
                <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2>
			<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
				<?php echo wp_kses( htmlspecialchars_decode( $args['must_log_in'] ), origamiez_get_allowed_tags() ); ?>
				<?php
				do_action( 'comment_form_must_log_in_after' );
				?>
			<?php else : ?>
                <form action="<?php echo esc_url( site_url( '/wp-comments-post.php' ) ); ?>" method="post"
                      id="<?php echo esc_attr( $args['id_form'] ); ?>"
                      class="comment-form origamiez-widget-content clearfix" <?php echo esc_attr( $html5 ? ' novalidate' : '' ); ?>>
					<?php do_action( 'comment_form_top' ); ?>
					<?php if ( is_user_logged_in() ) : ?>
						<?php echo wp_kses( htmlspecialchars_decode( apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ) ), origamiez_get_allowed_tags() ); ?>
						<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
					<?php else : ?>
						<?php echo wp_kses( $args['comment_notes_before'], origamiez_get_allowed_tags() ); ?>
						<?php
						do_action( 'comment_form_before_fields' );
						foreach ( (array) $args['fields'] as $name => $field ) {
							echo wp_kses( apply_filters( "comment_form_field_{$name}", $field ), origamiez_get_allowed_tags() );
						}
						do_action( 'comment_form_after_fields' );
						?>
					<?php endif; ?>
					<?php echo wp_kses( apply_filters( 'comment_form_field_comment', $args['comment_field'] ), origamiez_get_allowed_tags() ); ?>
					<?php echo wp_kses( $args['comment_notes_after'], origamiez_get_allowed_tags() ); ?>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"
                               value="<?php echo esc_attr( $args['label_submit'] ); ?>"/>
						<?php comment_id_fields( $post_id ); ?>
                    </p>
					<?php do_action( 'comment_form', $post_id ); ?>
                </form>
			<?php endif; ?>
        </div><!-- #respond -->
		<?php
		do_action( 'comment_form_after' );
	else :
		do_action( 'comment_form_comments_closed' );
	endif;
}

function origamiez_get_socials() {
	return array(
		'behance'        => array(
			'icon'  => 'fa fa-behance',
			'label' => esc_attr__( 'Behance', 'origamiez' ),
			'color' => '',
		),
		'bitbucket'      => array(
			'icon'  => 'fa fa-bitbucket',
			'label' => esc_attr__( 'Bitbucket', 'origamiez' ),
			'color' => '',
		),
		'codepen'        => array(
			'icon'  => 'fa fa-codepen',
			'label' => esc_attr__( 'Codepen', 'origamiez' ),
			'color' => '',
		),
		'delicious'      => array(
			'icon'  => 'fa fa-delicious',
			'label' => esc_attr__( 'Delicious', 'origamiez' ),
			'color' => '',
		),
		'deviantart'     => array(
			'icon'  => 'fa fa-deviantart',
			'label' => esc_attr__( 'Deviantart', 'origamiez' ),
			'color' => '',
		),
		'digg'           => array(
			'icon'  => 'fa fa-digg',
			'label' => esc_attr__( 'Digg', 'origamiez' ),
			'color' => '#1b5891',
		),
		'dribbble'       => array(
			'icon'  => 'fa fa-dribbble',
			'label' => esc_attr__( 'Dribbble', 'origamiez' ),
			'color' => '',
		),
		'dropbox'        => array(
			'icon'  => 'fa fa-dropbox',
			'label' => esc_attr__( 'Dropbox', 'origamiez' ),
			'color' => '',
		),
		'facebook'       => array(
			'icon'  => 'fa fa-facebook',
			'label' => esc_attr__( 'Facebook', 'origamiez' ),
			'color' => '#3B5998',
		),
		'flickr'         => array(
			'icon'  => 'fa fa-flickr',
			'label' => esc_attr__( 'Flickr', 'origamiez' ),
			'color' => '',
		),
		'foursquare'     => array(
			'icon'  => 'fa fa-foursquare',
			'label' => esc_attr__( 'Foursquare', 'origamiez' ),
			'color' => '',
		),
		'git'            => array(
			'icon'  => 'fa fa-git',
			'label' => esc_attr__( 'Git', 'origamiez' ),
			'color' => '',
		),
		'github'         => array(
			'icon'  => 'fa fa-github',
			'label' => esc_attr__( 'Github', 'origamiez' ),
			'color' => '',
		),
		'google-plus'    => array(
			'icon'  => 'fa fa-google-plus',
			'label' => esc_attr__( 'Google plus', 'origamiez' ),
			'color' => '#C63D2D',
		),
		'instagram'      => array(
			'icon'  => 'fa fa-instagram',
			'label' => esc_attr__( 'Instagram', 'origamiez' ),
			'color' => '',
		),
		'jsfiddle'       => array(
			'icon'  => 'fa fa-jsfiddle',
			'label' => esc_attr__( 'JsFiddle', 'origamiez' ),
			'color' => '#007bb6',
		),
		'linkedin'       => array(
			'icon'  => 'fa fa-linkedin',
			'label' => esc_attr__( 'linkedin', 'origamiez' ),
			'color' => '#007bb6',
		),
		'pinterest'      => array(
			'icon'  => 'fa fa-pinterest',
			'label' => esc_attr__( 'Pinterest', 'origamiez' ),
			'color' => '#910101',
		),
		'reddit'         => array(
			'icon'  => 'fa fa-reddit',
			'label' => esc_attr__( 'Reddit', 'origamiez' ),
			'color' => '#ff1a00',
		),
		'soundcloud'     => array(
			'icon'  => 'fa fa-soundcloud',
			'label' => esc_attr__( 'Soundcloud', 'origamiez' ),
			'color' => '',
		),
		'spotify'        => array(
			'icon'  => 'fa fa-spotify',
			'label' => esc_attr__( 'Spotify', 'origamiez' ),
			'color' => '',
		),
		'stack-exchange' => array(
			'icon'  => 'fa fa-stack-exchange',
			'label' => esc_attr__( 'Stack exchange', 'origamiez' ),
			'color' => '',
		),
		'stack-overflow' => array(
			'icon'  => 'fa fa-stack-overflow',
			'label' => esc_attr__( 'Stack overflow', 'origamiez' ),
			'color' => '',
		),
		'stumbleupon'    => array(
			'icon'  => 'fa fa-stumbleupon',
			'label' => esc_attr__( 'Stumbleupon', 'origamiez' ),
			'color' => '#EB4823',
		),
		'tumblr'         => array(
			'icon'  => 'fa fa-tumblr',
			'label' => esc_attr__( 'Tumblr', 'origamiez' ),
			'color' => '#32506d',
		),
		'twitter'        => array(
			'icon'  => 'fa fa-twitter',
			'label' => esc_attr__( 'Twitter', 'origamiez' ),
			'color' => '#00A0D1',
		),
		'vimeo'          => array(
			'icon'  => 'fa fa-vimeo-square',
			'label' => esc_attr__( 'Vimeo', 'origamiez' ),
			'color' => '',
		),
		'youtube'        => array(
			'icon'  => 'fa fa-youtube',
			'label' => esc_attr__( 'Youtube', 'origamiez' ),
			'color' => '#cc181e',
		),
		'rss'            => array(
			'icon'  => 'fa fa-rss',
			'label' => esc_attr__( 'Rss', 'origamiez' ),
			'color' => '#FA9B39',
		),
	);
}

function origamiez_get_wrap_classes() {
	if ( 1 === (int) get_theme_mod( 'use_layout_fullwidth', 0 ) ) {
		echo 'container';
	}
}

function origamiez_get_str_uglify( $string ) {
	$string = preg_replace( '/\s+/', ' ', $string );
	$string = preg_replace( '/[^a-zA-Z0-9\s]/', '', $string );

	return strtolower( str_replace( ' ', '_', $string ) );
}

function origamiez_add_first_and_last_class_for_menuitem( $items ) {
	$items[1]->classes[]                 = 'origamiez-menuitem-first';
	$items[ count( $items ) ]->classes[] = 'origamiez-menuitem-last';

	return $items;
}

function origamiez_widget_order_class() {
	global $wp_registered_sidebars, $wp_registered_widgets;
	// Grab the widgets.
	$sidebars = wp_get_sidebars_widgets();
	if ( empty( $sidebars ) ) {
		return;
	}
	// Loop through each widget and change the class names.
	foreach ( $sidebars as $sidebar_id => $widgets ) {
		if ( empty( $widgets ) ) {
			continue;
		}
		$number_of_widgets = count( $widgets );
		foreach ( $widgets as $i => $widget_id ) {
			if ( isset( $wp_registered_widgets[ $widget_id ]['classname'] ) ) {
				$wp_registered_widgets[ $widget_id ]['classname'] .= ' origamiez-widget-order-' . $i;
				// Add first widget class.
				if ( 0 === $i ) {
					$wp_registered_widgets[ $widget_id ]['classname'] .= ' origamiez-widget-first';
				}
				// Add last widget class.
				if ( ( $i + 1 ) === $number_of_widgets ) {
					$wp_registered_widgets[ $widget_id ]['classname'] .= ' origamiez-widget-last';
				}
			}
		}
	}
}

function origamiez_remove_hardcoded_image_size( $html ) {
	return preg_replace( '/(width|height)="\d+"\s/', '', $html );
}

function origamiez_register_new_image_sizes() {
	add_image_size( 'origamiez-square-xs', 55, 55, true );
	add_image_size( 'origamiez-lightbox-full', 960, null, false );
	add_image_size( 'origamiez-blog-full', 920, 500, true );
	add_image_size( 'origamiez-square-m', 480, 480, true );
	add_image_size( 'origamiez-square-md', 480, 320, true );
	add_image_size( 'origamiez-posts-slide-metro', 620, 620, true );
	add_image_size( 'origamiez-grid-l', 380, 255, true );
}

function origamiez_get_image_src( $post_id = 0, $size = 'thumbnail' ) {
	$thumb = get_the_post_thumbnail( $post_id, $size );
	if ( ! empty( $thumb ) ) {
		$_thumb = array();
		$regex  = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
		preg_match( $regex, $thumb, $_thumb );
		$thumb = $_thumb[2];
	}

	return $thumb;
}

function origamiez_get_metadata_prefix( $echo = true ) {
	$prefix = apply_filters( 'origamiez_get_metadata_prefix', '&horbar;' );
	if ( $echo ) {
		echo htmlspecialchars_decode( esc_html( $prefix ) );
	} else {
		return $prefix;
	}
}

function origamiez_return_10() {
	return 10;
}

function origamiez_return_15() {
	return 15;
}

function origamiez_return_20() {
	return 20;
}

function origamiez_return_30() {
	return 30;
}

function origamiez_return_60() {
	return 60;
}

function origamiez_set_classes_for_footer_three_cols( $classes ) {
	return array( 'col-xs-12', 'col-sm-4', 'col-md-4' );
}

function origamiez_set_classes_for_footer_two_cols( $classes ) {
	return array( 'col-xs-12', 'col-sm-6', 'col-md-6' );
}

function origamiez_set_classes_for_footer_one_cols( $classes ) {
	return array( 'col-xs-12', 'col-sm-12', 'col-md-12' );
}

function origamiez_get_allowed_tags() {
	$allowed_tag                              = wp_kses_allowed_html( 'post' );
	$allowed_tag['div']['data-place']         = array();
	$allowed_tag['div']['data-latitude']      = array();
	$allowed_tag['div']['data-longitude']     = array();
	$allowed_tag['iframe']['src']             = array();
	$allowed_tag['iframe']['height']          = array();
	$allowed_tag['iframe']['width']           = array();
	$allowed_tag['iframe']['frameborder']     = array();
	$allowed_tag['iframe']['allowfullscreen'] = array();
	$allowed_tag['input']['class']            = array();
	$allowed_tag['input']['id']               = array();
	$allowed_tag['input']['name']             = array();
	$allowed_tag['input']['value']            = array();
	$allowed_tag['input']['type']             = array();
	$allowed_tag['input']['checked']          = array();
	$allowed_tag['select']['class']           = array();
	$allowed_tag['select']['id']              = array();
	$allowed_tag['select']['name']            = array();
	$allowed_tag['select']['value']           = array();
	$allowed_tag['select']['type']            = array();
	$allowed_tag['option']['selected']        = array();
	$allowed_tag['style']['types']            = array();
	$microdata_tags                           = array(
		'div',
		'section',
		'article',
		'a',
		'span',
		'img',
		'time',
		'figure'
	);
	foreach ( $microdata_tags as $tag ) {
		$allowed_tag[ $tag ]['itemscope'] = array();
		$allowed_tag[ $tag ]['itemtype']  = array();
		$allowed_tag[ $tag ]['itemprop']  = array();
	}

	return apply_filters( 'origamiez_get_allowed_tags', $allowed_tag );
}

function origamiez_get_button_readmore() {
	?>
    <p class="origamiez-readmore-block">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="origamiez-readmore-button">
			<?php esc_html_e( 'Read more &raquo;', 'origamiez' ); ?>
        </a>
    </p>
	<?php
}

function origamiez_save_unyson_options( $option_key, $old_value, $new_value ) {
	if ( 'fw_theme_settings_options:origamiez' === $option_key ) {
		if ( is_array( $old_value ) && is_array( $new_value ) ) {
			foreach ( $new_value as $key => $value ) {
				switch ( $key ) {
					case 'logo':
						if ( isset( $value['url'] ) && isset( $value['attachment_id'] ) ) {
							$value = esc_url( $value['url'] );
						}
						break;
				}
				set_theme_mod( $key, $value );
			}
		}
	}
}
