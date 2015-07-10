<?php get_header(); ?>

<div id="sidebar-center" class="pull-left">

    <?php get_template_part('blocks/breadcrumb'); ?>

    <?php if (have_posts()) : ?>
        <div class="clearfix"></div>

        <div id="sidebar-center-bottom" class="row clearfix">                        
            <?php
            while (have_posts()) : the_post();
                ?>
                <article id="origamiez-post-wrap" <?php post_class(array('clearfix')); ?>>
                    
                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <p class="metadata clearfix">
                        <span class="author hidden"><?php the_author();?></span>
                        
                        <?php if ('1' == get_theme_mod('is_show_post_datetime', '1')): ?>
                            <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">
                            <i class="fa fa-calendar-o"></i>
                            <?php echo get_the_date(); ?>
                            </time>
                            <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span> 
                        <?php endif; ?>

                        <?php if ('1' == get_theme_mod('is_show_post_comments', '1')): ?>
                            <?php comments_popup_link(
                                __('<i class="fa fa-comments-o"></i> No Comment', 'origamiez'), 
                                __('<i class="fa fa-comments-o"></i> 1 Comment', 'origamiez'), 
                                __('<i class="fa fa-comments-o"></i> % Comments', 'origamiez'), 
                                'metadata-comment', 
                                __('<i class="fa fa-comments-o"></i> Comment Closed', 'origamiez')); ?>                                    
                            <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>                            
                        <?php endif; ?>
                            
                    </p>
                    
                    <?php do_action('origamiez_before_single_post_content'); ?>

                    <div class="entry-content clearfix">
                        <?php the_content(); ?>
                    </div>

                    <?php do_action('origamiez_after_single_post_content'); ?>

                    <?php
                    wp_link_pages(array(
                        'before'           => '<div id="ct_singular_pagination" class="clearfix">',
                        'after'            => '</div>',
                        'next_or_number'   => 'next',
                        'separator'        => ' . ',
                        'nextpagelink'     => __('Next', 'origamiez'),
                        'previouspagelink' => __('Previous', 'origamiez'),
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
<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php
get_footer();
