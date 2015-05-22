<li <?php post_class(array('clearfix')); ?>>
    <article class="entry-item row clearfix">
        <?php
        if (has_post_thumbnail()):
            $size           = apply_filters('origamiez_get_blog_featured_image_for_lightbox', 'lightbox-full');
            $image_lightbox = origamiez_get_image_src(get_the_ID(), $size);
            ?>
            <div class="entry-thumb col-sm-5">
                <a href="<?php echo esc_url($image_lightbox); ?>" title="<?php the_title(); ?>" class="image-overlay origamiez-lighbox">
                    <?php the_post_thumbnail('thumbnail', array('class'=> 'entry-thumb img-responsive')); ?>
                    <div class="overlay"></div>
                    <span class="overlay-link"></span>
                    <span class="fa fa-plus"></span>
                </a>                                                                        
            </div>
        <?php endif; ?>

        <div class="entry-summary <?php echo (has_post_thumbnail()) ? 'col-sm-7' : 'col-sm-12'; ?>">

            <h3 class="clearfix">                                                    
                <a class="entry-title" href="<?php the_permalink(); ?>" class="entry-content"><?php the_title(); ?></a>
            </h3>

            <p class="metadata">
                <span class="vcard author hidden"><span class="fn"><?php the_author();?></span></span>            

                <?php if ('1' == get_theme_mod('is_show_taxonomy_datetime', '1')): ?>
                    <time class="updated metadata-date">
                    <i class="fa fa-calendar-o"></i>
                    <?php echo get_the_date(); ?>
                    </time>
                    <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                <?php endif; ?>

                <?php if ('1' == get_theme_mod('is_show_taxonomy_comments', '1')): ?>                                        
                    <?php comments_popup_link(__('<i class="fa fa-comments-o"></i> No Comment', 'origamiez'), __('<i class="fa fa-comments-o"></i> 1 Comment', 'origamiez'), __('<i class="fa fa-comments-o"></i> % Comments', 'origamiez'), 'metadata-comment', __('<i class="fa fa-comments-o"></i> Comment Closed', 'origamiez')); ?>                                                        
                <?php endif; ?>          
            </p>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </article>
</li>