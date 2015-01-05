<?php

class CT_Widget_Post_List_Small extends CT_Post_Widget {

    public $icon = 'ti-layout-list-thumb';

    function __construct() {
        $widget_ops = array('classname' => 'ct-widget-posts-small-thumbnail', 'description' => __('Display posts list with small thumbnail.', ct_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('ct-widget-post-list-small', __('CT Posts List Small', ct_get_domain()), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):
            ?>

            <?php
            $loop_index = 0;
            while ($posts->have_posts()):
                $posts->the_post();
                $post_title = get_the_title();
                $post_url = get_permalink();

                $post_classes = array('ct-wp-mt-post', 'clearfix');
                if (0 == $loop_index) {
                    $post_classes[] = 'ct-wp-mt-post-first';
                }
                ?>
                <div <?php post_class($post_classes); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>" class="link-hover-effect ct-post-thumb pull-left">                    
                            <?php the_post_thumbnail('square-xs', array('class' => 'image-effect img-responsive')); ?>                        
                        </a>
                    <?php endif; ?>

                    <div class="ct-wp-mt-post-detail">
                        <h5>                                                
                            <a class="entry-title" href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                        </h5>

                        <p class="metadata">
                            <span class="author hidden"><?php the_author();?></span>
                            <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">&horbar; <?php echo get_the_date(); ?></time>
                            <span class="metadata-divider">&nbsp;|&nbsp;</span>
                            <?php comments_popup_link(__('No Comment', ct_get_domain()), __('1 Comment', ct_get_domain()), __('% Comments', ct_get_domain()), 'metadata-comment', __('0 Comment', ct_get_domain())); ?>                                    
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

        echo $args['after_widget'];
    }

}
