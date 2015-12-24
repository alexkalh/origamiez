<?php
$sidebar = apply_filters( 'origamiez_get_current_sidebar', 'bottom', 'bottom' );

if ( is_active_sidebar( $sidebar ) ) :
?>
    <div id="sidebar-bottom" class="widget-area" role="complementary">    
	    <?php dynamic_sidebar( $sidebar ); ?>    
    </div>
<?php
endif;
