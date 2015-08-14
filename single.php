<?php 
get_header(); 
?>

<?php
$single_post_layout = get_theme_mod('single-post-layout', 'two-cols');
get_template_part("parts/single/layouts/{$single_post_layout}");
?>

<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php
get_footer();
