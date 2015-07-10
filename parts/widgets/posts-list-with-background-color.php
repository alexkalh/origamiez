<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_With_Background', 'register'));

class Origamiez_Widget_Posts_List_With_Background extends CT_Post_Widget {

    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_With_Background');
    }

    function __construct() {
        $widget_ops = array('classname' => 'origamiez-widget-posts-with-background', 'description' => __('Display posts list with background color.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-posts-with-background', __('Origamiez Posts List With Background Color', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());

        extract($args);
        extract($instance);

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

                $post_classes = array('origamiez-wp-post', 'clearfix');
                if (1 == $loop_index) {
                    $post_classes[] = 'origamiez-wp-post-first';
                }
                ?>
                <article <?php post_class($post_classes); ?>>
                    <div class="row">
                        <div class="origamiez-wp-post-title col-xs-12 col-sm-6">
                            <span class="origamiez-wp-post-index pull-left"><?php echo $loop_index; ?></span>

                            <h5 class="entry-title clearfix">                            
                                <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                            </h5>

                            <p class="metadata">
                                <span class="vcard author hidden"><span class="fn"><?php the_author();?></span></span>
                                <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>"><?php echo get_the_date(); ?></time>
                                <span class="metadata-divider">&nbsp;|&nbsp;</span>
                                <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('0 Comment', 'origamiez')); ?>                                    
                            </p>
                        </div>

                        <div class="origamiez-wp-post-detail col-xs-12 col-sm-6">                        
                            <?php 
                            add_filter( 'excerpt_length', 'origamiez_excerpt_length_small');
                            echo htmlspecialchars_decode(esc_html( get_the_excerpt()));
                            remove_filter( 'excerpt_length', 'origamiez_excerpt_length_small');
                            ?>                            
                        </div>   
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
