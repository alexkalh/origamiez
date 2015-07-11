<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_Media', 'register'));

class Origamiez_Widget_Posts_List_Media extends CT_Post_Widget {

    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_Media');
    }

    function __construct() {
        $widget_ops  = array('classname' => 'origamiez-widget-posts-with-format-icon', 'description' => __('Display posts list with icon of post-format.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-list-media', __('Origamiez Posts List With Format Icon', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());        
        
        extract($instance);

        $title    = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):            
            $is_true = true;
            while ($posts->have_posts()):
                $posts->the_post();
                $post_id = get_the_ID();
                $post_title = get_the_title();
                $post_url = get_permalink();
                $post_format = get_post_format();

                $classes = array('origamiez-w-m-post', 'clearfix');
                if ($is_true) {
                    $classes[] = 'origamiez-w-m-post-first';
                    $is_true = false;
                }
                ?> 
                <div <?php post_class($classes); ?>>
                    <?php if (has_post_thumbnail()): ?>   
                        <?php
                        $lightbox_markup = apply_filters('origamiez_get_lightbox_markup', array(
                            'before' => '',
                            'after' => '',
                            'url' => $post_url,
                            'atts' => array()
                                ), $post_id);

                        echo $lightbox_markup['before'];
                        ?>

                        <a href="<?php echo $lightbox_markup['url']; ?>" title="<?php echo $post_title; ?>" class="link-hover-effect origamiez-w-m-post-thumb clearfix"  <?php echo implode(' ', $lightbox_markup['atts']); ?>>
                            <?php the_post_thumbnail('origamiez-square-md', array('class'=> 'image-effect img-responsive')); ?>                            
                            <span><span class="metadata-post-format metadata-circle-icon"><span class="<?php echo origamiez_get_format_icon($post_format); ?>"></span></span></span>
                        </a>      
                        <?php echo $lightbox_markup['after']; ?>
                    <?php endif; ?>

                    <h5 class="entry-title"><a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a></h5>

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
               
                    <?php
                    if($excerpt_words_limit):
                        add_filter('excerpt_length', "origamiez_return_{$excerpt_words_limit}");
                        ?>
                        <p class="entry-excerpt clearfix"><?php echo get_the_excerpt(); ?></p>
                        <?php
                        remove_filter('excerpt_length', "origamiez_return_{$excerpt_words_limit}");
                        endif;
                    ?>

                </div>
                <?php
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
            <label for="<?php echo esc_attr($this->get_field_id('excerpt_words_limit')); ?>"><?php _e('Excerpt words limit:', 'origamiez'); ?></label>            
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
            <label for="<?php echo esc_attr($this->get_field_id('is_show_date')); ?>"><?php _e('Is show date:', 'origamiez'); ?></label>            
        </p>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('is_show_comments')); ?>" name="<?php echo esc_attr($this->get_field_name('is_show_comments')); ?>" type="checkbox" value="1" <?php checked(1, (int)$is_show_comments, true); ?> />            
            <label for="<?php echo esc_attr($this->get_field_id('is_show_comments')); ?>"><?php _e('Is show comments:', 'origamiez'); ?></label>                        
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
