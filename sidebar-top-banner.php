<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'top-banner', 'top-banner');
if (is_active_sidebar($sidebar)):
?>
	<div id="origamiez-top-banner" class="pull-right">
	  <?php dynamic_sidebar($sidebar); ?>    
	</div>
<?php 
endif;