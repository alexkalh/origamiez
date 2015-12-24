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
                        
                        <?php if (1 === (int)get_theme_mod('is_show_post_datetime', 1)): ?>
                            <?php get_template_part('parts/metadata/date', 'blog'); ?>
                            <?php get_template_part('parts/metadata/divider', 'blog'); ?>
                        <?php endif; ?>

                        <?php if (1 === (int)get_theme_mod('is_show_post_comments', 1)): ?>
                            <?php get_template_part('parts/metadata/comments', 'blog'); ?>
                            <?php get_template_part('parts/metadata/divider', 'blog'); ?>                          
                        <?php endif; ?>

                        <?php if (1 === (int)get_theme_mod('is_show_post_category_below_title', 0)): ?>
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
                        'nextpagelink'     => esc_attr__('Next', 'origamiez'),
                        'previouspagelink' => esc_attr__('Previous', 'origamiez'),
                    ));
                    ?>

                </article>

                <?php get_template_part('parts/single/categories'); ?>

                <?php get_template_part('parts/single/tags'); ?>

                <?php get_template_part('parts/single/posts', 'adjacent'); ?>

                <?php get_template_part('parts/single/author', 'info'); ?>

                <?php get_template_part('parts/single/posts', 'related'); ?>

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