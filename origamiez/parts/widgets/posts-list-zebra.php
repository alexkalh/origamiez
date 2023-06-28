<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_Zebra', 'register'));

class Origamiez_Widget_Posts_List_Zebra extends Origamiez_Posts_Widget_Type_C {
    
    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_Zebra');
    }
    
    function __construct() {
        $widget_ops = array('classname' => 'origamiez-widget-posts-zebra', 'description' => esc_attr__('Display posts list like a zebra.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-list-zebra', esc_attr__('Origamiez Posts List Zebra', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        extract($instance);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo wp_kses( $args['before_widget'], origamiez_get_allowed_tags() );

        if (!empty($title))
            echo wp_kses( $args['before_title'] . $title . $args['after_title'], origamiez_get_allowed_tags() );

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
                            <a href="<?php echo esc_url( $post_url ); ?>" title="<?php echo esc_attr( $post_title ); ?>"><?php echo esc_attr( $post_title ); ?></a>
                        </h5>

                        <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata' ); ?>  
                        
                        <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>

                    </div>                                                
                </article>
                <?php
                $loop_index++;
            endwhile;
            ?>                

            <?php
        endif;
        wp_reset_postdata();

        echo wp_kses( $args['after_widget'], origamiez_get_allowed_tags() );
    }

}
