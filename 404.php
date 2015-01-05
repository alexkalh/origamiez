<?php
get_header();
?>

<?php ct_get_breadcrumb(); ?>

<div id="sidebar-center-bottom" class="row clearfix">     
    <article id="ct-post-wrap" class="error-404 clearfix">
        <div class="row clearfix">
            <div class="col-left col-sm-6">
                <p class="error-code"><?php _e('404', ct_get_domain()); ?></p>
            </div>
            <div class="col-right col-sm-6">

                <h1 class="error-message"><?php _e('Page not found...', ct_get_domain()); ?></h1>

                <p class="error-description"><?php _e('It seems this page you were looking for does not exist.', ct_get_domain()); ?></p>

                <p class="solve-error-options">
                    <a href="javascript: history.go(-1);"><?php _e('+ Go back to previous page', ct_get_domain()); ?></a>
                    <br/>
                    <a href="<?php echo esc_url(home_url()); ?>"><?php _e('+ Go to homepage', ct_get_domain()); ?></a>
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
get_footer();
