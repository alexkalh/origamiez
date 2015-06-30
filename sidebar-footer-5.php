<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'footer-5', 'footer-5');

if (is_active_sidebar($sidebar)):    
?>
	<div id="origamiez-footer-5" class="col-md-4 col-xs-12 col-sm-12 widget-area" role="complementary">    
	    <?php dynamic_sidebar($sidebar); ?>    
	</div>
<?php
endif;