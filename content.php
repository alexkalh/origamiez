<li <?php post_class(array('clearfix')); ?>>
    <article class="entry-item row clearfix">
        <?php
        if (has_post_thumbnail()):
            $size = apply_filters('ct_get_blog_featured_image_for_lightbox', 'lightbox-full');
            $image_lightbox = ct_get_image_src(get_the_ID(), $size);
            ?>
            <div class="entry-thumb col-sm-5">
                <a href="<?php echo $image_lightbox; ?>" title="<?php the_title(); ?>" class="image-overlay ct-lighbox">
                    <?php the_post_thumbnail('blog-m', array('class' => 'img-responsive', 'title' => get_the_title())); ?>                  
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

                <?php if ('on' == ot_get_option('is_show_taxonomy_datetime', 'on')): ?>
                    <time class="updated metadata-date">
                    <i class="fa fa-calendar-o"></i>
                    <?php echo get_the_date(); ?>
                    </time>
                    <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                <?php endif; ?>

                <?php if ('on' == ot_get_option('is_show_taxonomy_comments', 'on')): ?>                                        
                    <?php comments_popup_link(__('<i class="fa fa-comments-o"></i> No Comment', ct_get_domain()), __('<i class="fa fa-comments-o"></i> 1 Comment', ct_get_domain()), __('<i class="fa fa-comments-o"></i> % Comments', ct_get_domain()), 'metadata-comment', __('<i class="fa fa-comments-o"></i> 0 Comment', ct_get_domain())); ?>                                    
                    <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                <?php endif; ?>

                <?php if ('on' == ot_get_option('is_show_taxonomy_view_count', 'on')): ?>                    
                    <span class="metadata-views">
                    <i class="fa fa-eye"></i>
                    <?php echo ct_get_view(get_the_ID()); ?>
                    </span>
                <?php endif; ?>                
            </p>

            <div class="entry-content">
                <?php
                $content = strip_shortcodes( get_the_content() );
                if (!empty($content)) {
                    $taxonomy_excerpt_words_limit = (int) ot_get_option('taxonomy_excerpt_words_limit', 50);
                    echo wp_trim_words($content, $taxonomy_excerpt_words_limit, false);
                }
                ?>
            </div>
        </div>
    </article>
</li>