<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'footer-3', 'footer-3');

if (is_active_sidebar($sidebar)):    
?>
	<div id="origamiez-footer-3" class="col-xs-12 col-sm-6 col-md-3 widget-area" role="complementary">    
	    <?php dynamic_sidebar($sidebar); ?>    
	</div>
<?php
endif;