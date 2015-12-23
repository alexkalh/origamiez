<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_With_Background', 'register'));

class Origamiez_Widget_Posts_List_With_Background extends Origamiez_Posts_Widget {

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

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

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
                            <span class="origamiez-wp-post-index pull-left"><?php echo $loop_index; ?></span>

                            <h5 class="entry-title clearfix">                            
                                <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
                            </h5>

                            <?php if($is_show_date || $is_show_comments): ?>
                                <p class="metadata">
                                    <?php get_template_part('parts/metadata/author'); ?>

                                    <?php if($is_show_date): ?>
                                        <?php get_template_part('parts/metadata/date'); ?>                                
                                    <?php endif;?>
                                    
                                    <?php if($is_show_date && $is_show_comments): ?>
                                        <?php get_template_part('parts/metadata/divider'); ?>
                                    <?php endif;?>

                                    <?php if($is_show_comments): ?>
                                        <?php get_template_part('parts/metadata/comments'); ?>
                                    <?php endif;?>        
                                </p> 
                            <?php endif;?>
                        </div>

                        
                        <?php
                        if($excerpt_words_limit):
                            ?>
                            <div class="origamiez-wp-post-detail col-xs-12 col-sm-6">
                            <?php
                            add_filter('excerpt_length', "origamiez_return_{$excerpt_words_limit}");                                
                            echo get_the_excerpt();                                
                            remove_filter('excerpt_length', "origamiez_return_{$excerpt_words_limit}");
                            ?>
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

        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance) {
        $instance = parent::update($new_instance, $old_instance);        
        $instance['excerpt_words_limit'] = isset($new_instance['excerpt_words_limit']) ? (int) $new_instance['excerpt_words_limit'] : 0;
        $instance['is_show_date']        = isset($new_instance['is_show_date']) ? 1 : 0;
        $instance['is_show_comments']    = isset($new_instance['is_show_comments']) ? 1 : 0;
        return $instance;
    }

    function form($instance) {
        parent::form($instance);
        $instance = wp_parse_args((array) $instance, $this->get_default());
        extract($instance);
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('excerpt_words_limit')); ?>"><?php esc_html_e('Excerpt words limit:', 'origamiez'); ?></label>            
            <select class="widefat" 
                id="<?php echo esc_attr($this->get_field_id('excerpt_words_limit')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('excerpt_words_limit')); ?>">
                <?php
                $limits = array(0, 10, 15, 20, 30, 60);
                foreach ($limits as $limit) {
                    ?>
                    <option value="<?php echo esc_attr($limit); ?>" <?php selected($instance['excerpt_words_limit'], $limit); ?>><?php echo esc_attr($limit); ?></option>
                    <?php
                }
                ?>
            </select>            
        </p>
        <p>            
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('is_show_date')); ?>" name="<?php echo esc_attr($this->get_field_name('is_show_date')); ?>" type="checkbox" value="1" <?php checked(1, (int)$is_show_date, true); ?> />            
            <label for="<?php echo esc_attr($this->get_field_id('is_show_date')); ?>"><?php esc_html_e('Is show date:', 'origamiez'); ?></label>            
        </p>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('is_show_comments')); ?>" name="<?php echo esc_attr($this->get_field_name('is_show_comments')); ?>" type="checkbox" value="1" <?php checked(1, (int)$is_show_comments, true); ?> />            
            <label for="<?php echo esc_attr($this->get_field_id('is_show_comments')); ?>"><?php esc_html_e('Is show comments:', 'origamiez'); ?></label>                        
        </p>
        <?php
    }

    protected function get_default() {
        $default = parent::get_default();            
        $default['excerpt_words_limit'] = 0;
        $default['is_show_date']        = 1;
        $default['is_show_comments']    = 1;

        return $default;
    }    

}
