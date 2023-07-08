<?php
$sidebar = apply_filters( 'origamiez_get_current_sidebar', 'left', 'left' );
if ( is_active_sidebar( $sidebar ) ) :
	?>
    <div id="sidebar-middle-clone" class="origamiez-size-02 pull-left hidden" role="complementary">
		<?php dynamic_sidebar( $sidebar ); ?>
    </div>
<?php
endif;
