</div>
</div>
<?php get_sidebar( 'right' ); ?>
<div class="clearfix"></div>
<?php get_sidebar( 'bottom' ); ?>
<div class="clearfix"></div>
</div> <!-- end #origamiez-body > container > #origamiez-boby-inner -->
</div> <!-- end #origamiez-body-->
<footer id="origamiez-footer" class="clearfix">
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-5' ) ) : ?>
        <div id="origamiez-footer-sidebars" class="clearfix">
            <div id="origamiez-footer-sidebars-inner" class="<?php origamiez_get_wrap_classes(); ?> clearfix">
                <div class="row clearfix">
                    <div id="origamiez-footer-right" class="col-md-8 col-sm-12 col-xs-12 widget-area"
                         role="complementary">
                        <div class="row clearfix">
							<?php get_sidebar( 'footer-1' ); ?>
							<?php get_sidebar( 'footer-2' ); ?>
							<?php get_sidebar( 'footer-3' ); ?>
							<?php get_sidebar( 'footer-4' ); ?>
                        </div>
                    </div>
					<?php get_sidebar( 'footer-5' ); ?>
                </div>
            </div>
        </div>
	<?php endif; ?>
    <div id="origamiez-footer-end" class="clearfix">
        <div class="<?php origamiez_get_wrap_classes(); ?> clearfix">
			<?php get_template_part( 'parts/menu', 'bottom' ); ?>
			<?php get_template_part( 'parts/copyright' ); ?>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>
<?php do_action( 'origamiez_before_body_close' ); ?>
</body>
</html>
