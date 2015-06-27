<?php

class Origamiez_Widget_Post_List_Zebra extends CT_Post_Widget {
    
    function __construct() {
        $widget_ops = array('classname' => 'origamiez-widget-posts-zebra', 'description' => __('Display posts list like a zebra.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-list-zebra', __('Origamiez Posts List Zebra', 'origamiez'), $widget_ops, $control_ops);
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
            $loop_index = 1;
            while ($posts->have_posts()):
                $posts->the_post();
                $post_title = get_the_title();
                $post_url = get_permalink();

                $post_classes = array('origamiez-wp-zebra-post', 'clearfix');
                if (1 == $loop_index) {
                    $post_classes[] = 'origamiez-wp-zebra-post-first';
                }
                $post_classes[] = (0 === $loop_index % 2) ? 'even' : 'odd';
                ?>
                <article <?php post_class($post_classes); ?>>                  
                    <div class="origamiez-wp-mt-post-detail">
                        <h5>                                                
                            <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                        </h5>

                        <p class="metadata">
                            <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">&horbar; <?php echo get_the_date(); ?></time>                            
                        </p>                                                                                    
                    </div>                                                
                </article>
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
