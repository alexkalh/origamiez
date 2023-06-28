<?php
$sidebar = apply_filters( 'origamiez_get_current_sidebar', 'left', 'left' );

if ( is_active_sidebar( $sidebar ) ) :
?>
    <div id="sidebar-middle" class="origamiez-size-01 pull-left" role="complementary">    
		<?php dynamic_sidebar( $sidebar ); ?>    
    </div>
<?php
endif;
