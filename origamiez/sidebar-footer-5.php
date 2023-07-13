<?php
$sidebar = apply_filters( 'origamiez_get_current_sidebar', 'footer-5', 'footer-5' );
if ( is_active_sidebar( $sidebar ) ) :
	$classes = apply_filters( 'origamiez_get_footer_classes', array(
		'col-xs-12',
		'col-sm-12',
		'col-md-4'
	), 'footer-3' );
	?>
    <div id="origamiez-footer-5" class="widget-area <?php echo esc_attr( implode( ' ', $classes ) ); ?>"
         role="complementary">
		<?php dynamic_sidebar( $sidebar ); ?>
    </div>
<?php
endif;
