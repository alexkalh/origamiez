<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'main-bottom', 'main-bottom');

if (is_active_sidebar($sidebar)):
?>
	<div id="sidebar-main-bottom" class="clearfix widget-area" role="complementary">
		<?php dynamic_sidebar($sidebar); ?>
	</div>
<?php
endif;