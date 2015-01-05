<?php
$sidebar = apply_filters('ct_get_current_sidebar', 'footer-2', 'footer-2');

if (!is_active_sidebar($sidebar)) {
    return;
}
?>
<div id="ct-footer-2" class="col-xs-12 col-sm-6 col-md-3 widget-area" role="complementary">    
    <?php dynamic_sidebar($sidebar); ?>    
</div>