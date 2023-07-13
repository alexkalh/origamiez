<?php get_header(); ?>
<?php
$taxonomy_layout = get_theme_mod('taxonomy_layout', 'two-cols');
get_template_part('parts/archive/archive', $taxonomy_layout);
?>
    <div class="clearfix"></div>
<?php get_sidebar('bottom'); ?>
    <div class="clearfix"></div>
<?php
$footer_number_of_cols = (int)get_theme_mod('footer_number_of_cols', 5);
get_footer($footer_number_of_cols);
