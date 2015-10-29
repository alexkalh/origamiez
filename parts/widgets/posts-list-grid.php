<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_Grid', 'register'));

class Origamiez_Widget_Posts_List_Grid extends Origamiez_Posts_Widget {

    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_Grid');
    }

    function __construct() {
        $widget_ops  = array('classname' => 'origamiez-widget-posts-grid', 'description' => __('Display posts grid with small thumbnail.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-grid', __('Origamiez Posts Grid', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());

        extract($args);
        extract($instance);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo  htmlspecialchars_decode(esc_html($before_widget));
        if (!empty($title))
            echo  htmlspecialchars_decode(esc_html($before_title . $title . $after_title));

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):
            ?>
            <div class="row row-first cleardix">
                <?php
                $cols_per_row = (int) $instance['cols_per_row'];
                $post_classes = array('origamiez-wp-grid-post', 'col-xs-12');
                $image_size   = 'origamiez-grid-l';
                switch ($cols_per_row) {
                    case 4:
                        $post_classes[] = 'col-sm-3';
                        break;
                    case 6:
                        $post_classes[] = 'col-sm-2';
                        break;
                    default:
                        $post_classes[] = 'col-sm-4';
                        break;
                }
                                
                $loop_index = 0;
                while ($posts->have_posts()):
                    $posts->the_post();
                    $post_title = get_the_title();
                    $post_url   = get_permalink();
                    $classes    = $post_classes;

                    if ($cols_per_row === $loop_index) {                        
                        $loop_index = 0;
                        echo '</div><div class="row cleardix">';
                    } else {
                        $loop_index++;
                    }

                    if (0 === $loop_index) {                        
                        $classes[] = 'origamiez-wp-grid-post-first';
                    } else if ($cols_per_row === $loop_index) {
                        $classes[] = 'origamiez-wp-grid-post-last';
                    }                    
                    ?>
                    
                    <article <?php post_class($classes); ?>>
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>" class="link-hover-effect origamiez-post-thumb">                    
                                <?php the_post_thumbnail($image_size, array('class' => 'image-effect img-responsive')); ?>                            
                            </a>
                        <?php endif; ?>

                        <div class="origamiez-wp-grid-detail clearfix">
                            <h5>                                                
                                <a class="entry-title" href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>"><?php echo esc_attr($post_title); ?></a>
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

                            <?php
                            if($excerpt_words_limit):
                                add_filter('excerpt_length', "origamiez_return_{$excerpt_words_limit}");
                                ?>
                                <p class="post-except"><?php the_excerpt(); ?></p>
                                <?php
                                remove_filter('excerpt_length', "origamiez_return_{$excerpt_words_limit}");
                                endif;
                            ?>
                        </div>                                                
                    </article>

                    <?php                    
                endwhile;
                ?>              
            </div>
            <?php
        endif;
        wp_reset_postdata();

        echo  htmlspecialchars_decode(esc_html($after_widget));
    }

    function update($new_instance, $old_instance) {
        $instance = parent::update($new_instance, $old_instance);

        $instance['cols_per_row']        = (int) strip_tags($new_instance['cols_per_row']);        
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
            <label for="<?php echo esc_attr($this->get_field_id('cols_per_row')); ?>"><?php _e('Cols per row:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('cols_per_row')); ?>" name="<?php echo esc_attr($this->get_field_name('cols_per_row')); ?>">                
                <?php
                $cols = array(3, 4, 6);
                foreach ($cols as $col) {
                    ?>
                    <option value="<?php echo esc_attr($col); ?>" <?php selected($instance['cols_per_row'], $col); ?>><?php echo esc_attr($col); ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
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

        $default['cols_per_row']        = 3;        
        $default['excerpt_words_limit'] = 0;
        $default['is_show_date']        = 1;
        $default['is_show_comments']    = 1;

        return $default;
    }

}
