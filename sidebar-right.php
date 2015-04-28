<?php
$sidebar = apply_filters('origamiez_get_current_sidebar', 'right', 'right');

if (!is_active_sidebar($sidebar)) {
    return;
}
?>

<div id="sidebar-right" class="pull-right">
    <div class="sidebar-right-inner clearfix widget-area" role="complementary">
        <?php dynamic_sidebar($sidebar); ?>
    </div>
</div>