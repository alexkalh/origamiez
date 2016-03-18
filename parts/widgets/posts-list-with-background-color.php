<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_With_Background', 'register'));

class Origamiez_Widget_Posts_List_With_Background extends Origamiez_Posts_Widget_Type_C {

    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_With_Background');
    }

    function __construct() {
        $widget_ops = array('classname' => 'origamiez-widget-posts-with-background', 'description' => esc_attr__('Display posts list with background color.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-posts-with-background', esc_attr__('Origamiez Posts List With Background Color', 'origamiez'), $widget_ops, $control_ops);
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
            $loop_index = 1;
            
            $col_left_classes = $excerpt_words_limit ? 'col-sm-6' : 'col-sm-12';

            while ($posts->have_posts()):
                $posts->the_post();
                $post_title = get_the_title();
                $post_url   = get_permalink();

                $post_classes = array('origamiez-wp-post', 'clearfix');
                if (1 == $loop_index) {
                    $post_classes[] = 'origamiez-wp-post-first';
                }
                ?>
                <article <?php post_class($post_classes); ?>>
                    <div class="row">
                        <div class="origamiez-wp-post-title col-xs-12 <?php echo esc_attr($col_left_classes); ?>">
                            <span class="origamiez-wp-post-index pull-left"><?php echo esc_attr( $loop_index ); ?></span>

                            <h5 class="entry-title clearfix">                            
                                <a href="<?php echo esc_url( $post_url ); ?>" title="<?php echo esc_attr( $post_title ); ?>"><?php echo esc_attr( $post_title ); ?></a>
                            </h5>


                            <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata' ); ?>  
                     
                        </div>

                        
                        <?php
                        if($excerpt_words_limit):
                            ?>
                            <div class="origamiez-wp-post-detail col-xs-12 col-sm-6">
                            <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>
                            </div>
                            <?php
                            endif;
                        ?>                                                
                    </div>
                </article>
                <?php
                $loop_index++;
            endwhile;

        endif;
        wp_reset_postdata();

        echo wp_kses( $args['after_widget'], origamiez_get_allowed_tags() );
    }

}
