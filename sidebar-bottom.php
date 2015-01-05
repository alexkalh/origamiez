<?php
$sidebar = apply_filters('ct_get_current_sidebar', 'bottom', 'bottom');

if (!is_active_sidebar($sidebar)) {
    return;
}
?>
<div id="sidebar-bottom" class="widget-area" role="complementary">    
    <?php dynamic_sidebar($sidebar); ?>    
</div>