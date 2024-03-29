<?php
get_header();
?>
<?php get_template_part( 'parts/breadcrumb' ); ?>
    <div id="sidebar-center-bottom" class="clearfix">
        <article id="origamiez-post-wrap" class="error-404 clearfix">
            <div class="row clearfix">
                <div class="col-left col-sm-6">
                    <p class="error-code"><?php esc_html_e( '404', 'origamiez' ); ?></p>
                </div>
                <div class="col-right col-sm-6">
                    <h1 class="error-message"><?php esc_html_e( 'Page not found...', 'origamiez' ); ?></h1>
                    <p class="error-description"><?php esc_html_e( 'It seems this page you were looking for does not exist.', 'origamiez' ); ?></p>
                    <p class="solve-error-options">
                        <a href="javascript: history.go(-1);"><?php esc_html_e( '+ Go back to previous page', 'origamiez' ); ?></a>
                        <br/>
                        <a href="<?php echo esc_url( home_url() ); ?>"><?php esc_html_e( '+ Go to homepage', 'origamiez' ); ?></a>
                    </p>
                </div>

                <div class="col-bottom col-sm-6 col-sm-offset-3">
					<?php get_search_form(); ?>
                </div>
            </div>
        </article>
    </div>

    <div class="clearfix"></div>
<?php
$footer_number_of_cols = (int) get_theme_mod( 'footer_number_of_cols', 5 );
get_footer( $footer_number_of_cols );
