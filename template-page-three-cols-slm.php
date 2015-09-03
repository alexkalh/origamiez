<?php
/*
 * Template Name: Page Three Column - SLM
 */

get_header();
?>

<?php get_sidebar('middle'); ?>

<div id="sidebar-center" class="origamiez-size-01 pull-left">

    <?php get_template_part('parts/breadcrumb'); ?>

    <?php if (have_posts()) : ?>
        <div class="clearfix"></div>

        <div id="sidebar-center-bottom" class="row clearfix">
            <?php
            while (have_posts()) : the_post();
                ?>
                <article id="origamiez-post-wrap" <?php post_class(array('clearfix')); ?>>
                    
                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <p class="metadata clearfix">
                        <?php get_template_part('parts/metadata/author'); ?>
                        
                        <?php if (1 == (int)get_theme_mod('is_show_post_datetime', 1)): ?>
                            <?php get_template_part('parts/metadata/date', 'blog'); ?>
                            <?php get_template_part('parts/metadata/divider', 'blog'); ?>
                        <?php endif; ?>

                        <?php if (1 == (int)get_theme_mod('is_show_post_comments', 1)): ?>
                            <?php get_template_part('parts/metadata/comments', 'blog'); ?>
                            <?php get_template_part('parts/metadata/divider', 'blog'); ?>                          
                        <?php endif; ?>

                        <?php if (1 == (int)get_theme_mod('is_show_post_category_below_title', 0)): ?>
                            <?php get_template_part('parts/metadata/category', 'blog'); ?>
                        <?php endif;?>

                    </p>
                    
                    <?php do_action('origamiez_before_single_post_content'); ?>

                    <div class="entry-content clearfix">
                        <?php the_content(); ?>
                    </div>

                    <?php do_action('origamiez_after_single_post_content'); ?>

                    <?php
                    wp_link_pages(array(
                        'before'           => '<div id="origamiez_singular_pagination" class="clearfix">',
                        'after'            => '</div>',
                        'next_or_number'   => 'next',
                        'separator'        => '',
                        'nextpagelink'     => __('Next', 'origamiez'),
                        'previouspagelink' => __('Previous', 'origamiez'),
                    ));
                    ?>

                </article>

                <?php comments_template(); ?>

                <?php
            endwhile;
            ?>                        
        </div>
        <?php
    else :        
        get_template_part('content', 'none');
    endif;
    ?>

</div>


<?php get_sidebar('middle-clone'); ?>

<?php get_sidebar('right'); ?>

<div class="clearfix"></div>

<?php
$footer_number_of_cols = (int)get_theme_mod('footer_number_of_cols', 5);
get_footer($footer_number_of_cols);