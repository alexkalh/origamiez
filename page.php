<?php
get_header();
?>

<div id="sidebar-center" class="pull-left">

    <?php get_template_part('parts/breadcrumb'); ?>

    <?php if (have_posts()) : ?>
        <div class="clearfix"></div>

        <div id="sidebar-center-bottom" class="row clearfix">                        
            <?php
            while (have_posts()) : the_post();
                ?>
                <article id="origamiez-post-wrap" <?php post_class('clearfix'); ?>>
                    <h1 class="entry-title" style="display: none;"><?php the_title(); ?></h1>

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
        <?php
    else :        
        get_template_part('content', 'none');
    endif;
    ?>
</div>
<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php
get_footer();
