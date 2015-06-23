<?php

class Origamiez_Widget_Post_List_Small extends CT_Post_Widget {

    function __construct() {
        $widget_ops  = array('classname' => 'origamiez-widget-posts-small-thumbnail', 'description' => __('Display posts list with small thumbnail.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-list-small', __('Origamiez Posts List Small', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo  htmlspecialchars_decode(esc_html($before_widget));
        if (!empty($title))
            echo  htmlspecialchars_decode(esc_html($before_title . $title . $after_title));

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):
            ?>

            <?php
            $loop_index = 0;
            while ($posts->have_posts()):
                $posts->the_post();
                $post_title = get_the_title();
                $post_url   = get_permalink();

                $post_classes = array('origamiez-wp-mt-post', 'clearfix');
                if (0 == $loop_index) {
                    $post_classes[] = 'origamiez-wp-mt-post-first';
                }
                ?>
                <div <?php post_class($post_classes); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>" class="link-hover-effect origamiez-post-thumb pull-left">                    
                            <?php the_post_thumbnail('origamiez-square-xs', array('class' => 'image-effect img-responsive')); ?>                        
                        </a>
                    <?php endif; ?>

                    <div class="origamiez-wp-mt-post-detail">
                        <h5>                                                
                            <a class="entry-title" href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>"><?php echo esc_attr($post_title); ?></a>
                        </h5>

                        <p class="metadata">
                            <span class="author hidden"><?php the_author();?></span>
                            <time class="updated metadata-date" datetime="<?php echo esc_attr(get_post_field('post_date_gmt', get_the_ID())); ?>">&horbar; <?php echo get_the_date(); ?></time>
                            <span class="metadata-divider">&nbsp;|&nbsp;</span>
                            <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                    
                        </p>                                                                                    
                    </div>                                                
                </div>
                <?php
                $loop_index++;
            endwhile;
            ?>                

            <?php
        endif;
        wp_reset_postdata();

        echo  htmlspecialchars_decode(esc_html($after_widget));
    }

}
