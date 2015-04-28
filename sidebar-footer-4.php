<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'footer-4', 'footer-4');

if (!is_active_sidebar($sidebar)) {
    return;
}
?>
<div id="origamiez-footer-4" class="col-xs-12 col-sm-6 col-md-3 widget-area" role="complementary">    
    <?php dynamic_sidebar($sidebar); ?>    
</div>