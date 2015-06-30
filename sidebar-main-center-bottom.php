<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'main-center-bottom', 'main-center-bottom');

if (is_active_sidebar($sidebar)):    
?>
	<div id="sidebar-main-center-bottom" class="clearfix widget-area" role="complementary">
		<?php dynamic_sidebar($sidebar); ?>
	</div>
<?php
endif;