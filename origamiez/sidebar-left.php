<?php
$sidebar = apply_filters( 'origamiez_get_current_sidebar', 'left', 'left' );
if ( is_active_sidebar( $sidebar ) ) :
	?>
    <div id="sidebar-left" class="clearfix" role="complementary">
		<?php dynamic_sidebar( $sidebar ); ?>
    </div>
<?php
endif;
