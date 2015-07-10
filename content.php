<li <?php post_class(array('clearfix')); ?>>
    <article class="entry-item clearfix">
        
        <?php if(is_sticky(get_the_ID())): ?>

        <?php endif; ?>        

        <div class=" row">
            <?php
            $size_of_col_left  = (int) get_theme_mod('size_of_thumb_col_on_blog_page', 2);
            $size_of_col_right = 12 - $size_of_col_left;
            $col_1_class       = "col-sm-{$size_of_col_left}";
            $col_2_class       = "col-sm-{$size_of_col_right}";        
            $thumbnail_size    = 'thumbnail';
            $blog_style        = get_theme_mod('layout_taxonomy', 'thumbnail-left');        
            
            if('thumbnail-full-width' == $blog_style){
                $thumbnail_size = 'origamiez-blog-full';
                $col_1_class    = 'col-xs-12';
                $col_2_class    = 'col-xs-12';
            }

            if (has_post_thumbnail()):
                $is_enable_lightbox  = (int)get_theme_mod('is_enable_lightbox', 1);                        
                ?>
                <div class="entry-thumb <?php echo esc_attr($col_1_class); ?>">
                    <?php 
                    if($is_enable_lightbox):
                        $image_lightbox_size = apply_filters('origamiez_get_blog_featured_image_for_lightbox', 'origamiez-lightbox-full');
                        $image_lightbox      = origamiez_get_image_src(get_the_ID(), $image_lightbox_size);                
                    ?>
                        <a href="<?php echo esc_url($image_lightbox); ?>" title="<?php the_title(); ?>" class="image-overlay origamiez-lighbox">
                    <?php else: ?>
                        <a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="image-overlay">
                    <?php endif;?>
                        <?php the_post_thumbnail($thumbnail_size, array('class'=> 'img-responsive', 'title' => esc_attr(get_the_title()))); ?>
                        <?php if(1 == (int)get_theme_mod('is_enable_hover_effect', 1)): ?>
                            <div class="overlay"></div>
                            <span class="overlay-link"></span>
                            <span class="fa fa-plus"></span>
                        <?php endif;?>                            
                    </a>                                                                        
                </div>
            <?php endif; ?>

            <div class="entry-summary <?php echo (has_post_thumbnail()) ? $col_2_class : 'col-sm-12'; ?>">

                <h3 class="clearfix">                                                    
                    <a class="entry-title" href="<?php the_permalink(); ?>" class="entry-content"><?php the_title(); ?></a>
                </h3>

                <p class="metadata">
                    <?php 
                    $is_show_author = (int)get_theme_mod('is_show_taxonomy_author', '0');
                    if($is_show_author):
                    ?>               
                        <span class="metadata-author vcard author"><i class="fa fa-user"></i><span class="fn"><?php the_author();?></span></span>
                        <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                    <?php else:?>
                        <span class="metadata-author vcard author hidden"><span class="fn"><?php the_author();?></span></span>
                    <?php endif;?>
                    

                    <?php if (1 == (int)get_theme_mod('is_show_taxonomy_datetime', '1')): ?>
                        <time class="updated metadata-date">
                        <i class="fa fa-calendar-o"></i>
                        <?php echo get_the_date(); ?>
                        </time>
                        <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                    <?php endif; ?>

                    <?php if (1 == (int)get_theme_mod('is_show_taxonomy_comments', '1')): ?>
                        <?php comments_popup_link(__('<i class="fa fa-comments-o"></i> No Comment', 'origamiez'), __('<i class="fa fa-comments-o"></i> 1 Comment', 'origamiez'), __('<i class="fa fa-comments-o"></i> % Comments', 'origamiez'), 'metadata-comment', __('<i class="fa fa-comments-o"></i> Comment Closed', 'origamiez')); ?>
                        <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                    <?php endif; ?>

                    <?php if (1 == (int)get_theme_mod('is_show_taxonomy_category', '1') && has_category()): ?>
                        <span class="metadata-categories">
                            <i class="fa fa-book"></i>
                            <?php the_category(', '); ?>
                        </span>
                    <?php endif; ?>
                </p>

                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>

                <p class="origamiez-readmore-block">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="origamiez-readmore-button">
                        <?php _e('Read more &raquo;', 'origamiez'); ?>                        
                    </a>
                </p>
            </div>
        </div>
    </article>
</li>