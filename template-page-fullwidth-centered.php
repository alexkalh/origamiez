<?php
/*
 * Template Name: Page Fullwidth Centered
 */

get_header();
?>

<?php get_template_part('parts/breadcrumb'); ?>

<?php if (have_posts()) : ?>
    <div class="clearfix"></div>

    <div id="sidebar-center-bottom" class="clearfix">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
            <?php
                while (have_posts()) : the_post();
                    ?>
                    <article id="origamiez-post-wrap" <?php post_class('clearfix'); ?>>
                        <h1 class="entry-title"><?php the_title(); ?></h1>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <?php
                        wp_link_pages(array(
                            'before'           => '<div id="origamiez_singular_pagination" class="clearfix">',
                            'after'            => '</div>',
                            'next_or_number'   => 'next',
                            'separator'        => ' . ',
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
        </div>
    </div>
    <?php
else :
    // If no content, include the "No posts found" template.
    get_template_part('content', 'none');
endif;
?>

<div class="clearfix"></div>
<?php
$footer_number_of_cols = (int)get_theme_mod('footer_number_of_cols', 5);
get_footer($footer_number_of_cols);