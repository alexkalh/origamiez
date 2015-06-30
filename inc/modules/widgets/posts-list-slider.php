<?php

class Origamiez_Widget_Posts_List_Slider extends CT_Post_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'origamiez-widget-posts-slider', 'description' => __('Display a slider with three block: two static blocks, one dynamic (carousel) block.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-posts-slider', __('Origamiez Posts Slider', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;

        $query = $this->get_query($instance);


        echo '<div class="row clearfix">';

        $posts = new WP_Query(array_merge($query, array('posts_per_page' => 2)));

        if ($posts->have_posts()):
            ?>          

            <div class="col-left col-sm-4 col-xs-4">                
                <?php
                $is_first   = true;
                $loop_index = 1;
                while ($posts->have_posts()):
                    $posts->the_post();
                    $post_title = get_the_title();
                    $post_url   = get_permalink();
                    $post_format= get_post_format();

                    if (has_post_thumbnail()):
                        $classes   = array('item');
                        $classes[] = $is_first ? 'item-top' : 'item-bottom';
                        ?>                        
                        <article <?php post_class($classes); ?>>                            
                            <?php the_post_thumbnail('origamiez-posts-slide-metro', array('class' => 'img-responsive')); ?>                                    

                            <div class="caption">
                                <h5>
                                    <a class="entry-title" href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>">
                                        <?php echo $post_title; ?>        
                                    </a>                                
                                </h5>

                                <p class="metadata clearfix hidden">
                                    <span class="vcard author hidden"><span class="fn"><?php the_author();?></span></span>
                                    <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">&horbar; <?php echo get_the_date(); ?></time>                                        
                                    <span class="metadata-divider">&nbsp;|&nbsp;</span>
                                    <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                    
                                </p>                                

                                <p class="entry-excerpt clearfix hidden">
                                    <?php 
                                    add_filter( 'excerpt_length', 'origamiez_excerpt_length_small');
                                    echo htmlspecialchars_decode(esc_html( get_the_excerpt()));
                                    remove_filter( 'excerpt_length', 'origamiez_excerpt_length_small');
                                    ?>
                                </p>

                            </div>

                        </article>
                        <?php
                        $is_first = false;
                    endif;
                    $loop_index++;
                endwhile;                
                ?>               
            </div>           
            <?php
        endif;
        wp_reset_postdata();

        $posts = new WP_Query(array_merge($query, array('offset' => 2, 'posts_per_page' => (int) $instance['posts_per_page'] - 2)));

        if ($posts->have_posts()):
            ?>          

            <div class="col-right col-sm-8 col-xs-8">
                <div class="owl-carousel owl-theme">
                    <?php
                    while ($posts->have_posts()):
                        $posts->the_post();
                        $post_title = get_the_title();
                        $post_url   = get_permalink();
                        $post_format= get_post_format();
                        if (has_post_thumbnail()):
                            ?>                        
                            <article <?php post_class('item'); ?>>                                
                                <?php the_post_thumbnail('origamiez-posts-slide-metro', array('class' => 'img-responsive')); ?>                                                                    

                                <div class="caption">
                                    <h2>
                                        <a class="entry-title" href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>">
                                            <?php echo $post_title; ?>                                            
                                        </a>
                                    </h2>

                                    <p class="metadata clearfix">
                                       <span class="vcard author hidden"><span class="fn"><?php the_author();?></span></span>
                                        <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">&horbar; <?php echo get_the_date(); ?></time>                                        
                                        <span class="metadata-divider">&nbsp;|&nbsp;</span>
                                        <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                    
                                    </p>

                                    <p class="entry-excerpt clearfix">
                                        <?php 
                                        add_filter( 'excerpt_length', 'origamiez_excerpt_length_small');
                                        echo htmlspecialchars_decode(esc_html( get_the_excerpt()));
                                        remove_filter( 'excerpt_length', 'origamiez_excerpt_length_small');
                                        ?>
                                    </p>

                                </div>                            

                            </article>
                            <?php
                        endif;
                        
                        $loop_index++;

                    endwhile;
                    ?>
                </div>
            </div>           
            <?php
        endif;
        wp_reset_postdata();

        echo '</div>';

        echo $after_widget;
    }

}
