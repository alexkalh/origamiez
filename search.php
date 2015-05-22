<?php
get_header();
?>

<div id="sidebar-center" class="pull-left">

    <?php origamiez_get_breadcrumb(); ?>

    <div class="clearfix"></div>

    <div id="sidebar-center-bottom" class="row clearfix">                        
        <ul id="origamiez-blogposts">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <li <?php post_class(array('clearfix')); ?>>
                        <article class="entry-item row clearfix">

                            <div class="entry-summary col-sm-12">

                                <h3 class="clearfix">                                                    
                                    <a href="<?php the_permalink(); ?>" class="entry-content"><?php the_title(); ?></a>
                                </h3>

                                <p class="metadata">
                                    <?php if ('1' == get_theme_mod('is_show_taxonomy_datetime', '1')): ?>
                                        <time class="updated tadata-date">&horbar; <?php echo get_the_date(); ?></time>
                                        <span class="metadata-divider">&nbsp;|&nbsp;</span>
                                    <?php endif; ?>

                                    <?php if ('1' == get_theme_mod('is_show_taxonomy_comments', '1')): ?>                    
                                        <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                        
                                    <?php endif; ?>            
                                </p>

                                <div class="entry-content"><?php the_excerpt(); ?></div>            
                            </div>
                        </article>
                    </li>
                    <?php
                endwhile;
            else :
                get_template_part('content', 'none');
            endif;
            ?>
        </ul>
        <?php get_template_part('pagination'); ?>
    </div>       
</div>
<?php get_sidebar('right'); ?>

<div class="clearfix"></div>
<?php
get_footer();
