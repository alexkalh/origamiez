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
                        'before' => '<div id="ct_singular_pagination" class="clearfix">',
                        'after' => '</div>',
                        'next_or_number' => 'next',
                        'separator' => ' . ',
                        'nextpagelink' => __('Next', 'origamiez'),
                        'previouspagelink' => __('Previous', 'origamiez'),
                    ));
                    ?>

                </article>

                <?php if (has_category() && '1' == get_theme_mod('is_show_post_category', '1')): ?>  
                    <div id="origamiez-post-category" class="entry-category clearfix">
                        <span class="fa fa-book"></span> <?php the_category(' '); ?> 
                    </div>                  
                <?php endif; ?>

                <?php if (has_tag() && '1' == get_theme_mod('is_show_post_tag', '1')): ?>
                    <div id="origamiez-post-tag" class="entry-tag clearfix">
                        <span class="fa fa-tags"></span> <?php the_tags('', '', ''); ?>
                    </div>
                <?php endif; ?>

                <?php
                if ('1' == get_theme_mod('is_show_post_adjacent', '1')):
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();

                    if ($prev_post || $next_post):
                        ?>
                        <div id="origamiez-post-adjacent">
                            <div class="row clearfix">
                                <?php if ($prev_post): ?>
                                    <div class="col-sm-6 origamiez-post-adjacent-prev">
                                        <p class="direction">
                                            <a href="<?php echo get_the_permalink($prev_post); ?>" title="<?php echo get_the_title($prev_post); ?>">
                                                <?php
                                                $post_adjacent_arrow_left = get_theme_mod('post_adjacent_arrow_left', false);
                                                if(empty($post_adjacent_arrow_left)): 
                                                ?>
                                                    <span class="fa fa-angle-double-left"></span>&nbsp;<?php _e('Previous Post', 'origamiez'); ?>
                                                <?php else: ?>
                                                    <img src="<?php echo esc_url($post_adjacent_arrow_left); ?>" alt="<?php echo get_the_title($prev_post); ?>">
                                                <?php endif;?>
                                            </a>
                                        </p>

                                        <?php if('1' == get_theme_mod('is_show_post_adjacent_title', '1')): ?>
                                            <h4><a href="<?php echo get_the_permalink($prev_post); ?>"><?php echo get_the_title($prev_post); ?></a></h4>
                                        <?php endif;?>

                                        <?php if('1' == get_theme_mod('is_show_post_adjacent_datetime', '1')): ?>
                                            <p class="metadata clearfix">
                                                <time class="updated metadata-date">&horbar; <?php echo get_the_date('', $prev_post); ?></time>                                    
                                            </p>
                                        <?php endif;?>

                                    </div>
                                <?php endif; ?>
                                <?php if ($next_post): ?>
                                    <div class="col-sm-6 origamiez-post-adjacent-next">
                                        <p class="direction">
                                            <a href="<?php echo get_the_permalink($next_post); ?>" title="<?php echo get_the_title($next_post); ?>">
                                                <?php
                                                $post_adjacent_arrow_right = get_theme_mod('post_adjacent_arrow_right', false);
                                                if(empty($post_adjacent_arrow_left)): 
                                                ?>
                                                    <?php _e('Next Post', 'origamiez'); ?>&nbsp;<span class="fa fa-angle-double-right"></span>
                                                <?php else: ?>
                                                    <img src="<?php echo esc_url($post_adjacent_arrow_right); ?>" alt="<?php echo get_the_title($next_post); ?>">
                                                <?php endif;?>                                                    

                                            </a>
                                        </p>

                                        <?php if('1' == get_theme_mod('is_show_post_adjacent_title', '1')): ?>
                                            <h4><a href="<?php echo get_the_permalink($next_post); ?>"><?php echo get_the_title($next_post); ?></a></h4>
                                        <?php endif;?>

                                        <?php if('1' == get_theme_mod('is_show_post_adjacent_datetime', '1')): ?>
                                            <p class="metadata clearfix">
                                                <time class="updated metadata-date">&horbar; <?php echo get_the_date('', $next_post); ?></time>                                    
                                            </p>
                                        <?php endif;?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endif;
                endif;
                ?>

                <?php
                if ('1' == get_theme_mod('is_show_post_author_info', '1')):
                    origamiez_get_author_infor();
                endif;
                ?>

                <?php
                if ('1' == get_theme_mod('is_show_post_related', '1')):
                    origamiez_get_related_posts();
                endif;
                ?>

                <?php comments_template(); ?>

                <?php
            endwhile;
            ?>                        
        </div>
        <?php
    else :
        // If no content, include the "No posts found" template.
        get_template_part('content', 'none');
    endif;
    ?>
</div>
<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php
get_footer();
