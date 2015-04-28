<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'footer-1', 'footer-1');

if (!is_active_sidebar($sidebar)) {
    return;
}
?>
<div id="origamiez-footer-1" class="col-xs-12 col-sm-6 col-md-3 widget-area" role="complementary">    
    <?php dynamic_sidebar($sidebar); ?>    
</div>