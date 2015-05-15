<?php

class Origamiez_Widget_Post_Grid extends CT_Post_Widget {

    public $icon = 'ti-layout-grid2';

    function __construct() {
        $widget_ops  = array('classname' => 'origamiez-widget-posts-grid', 'description' => __('Display posts grid with small thumbnail.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-grid', __('Origamiez Posts Grid', 'origamiez'), $widget_ops, $control_ops);
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
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('excerpt_words_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('excerpt_words_limit')); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['excerpt_words_limit'])); ?>" />            
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

    function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());

        extract($args);
        extract($instance);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo wp_kses_post($before_widget);
        if (!empty($title))
            echo wp_kses_post($before_title . $title . $after_title);

        $query = $this->get_query($instance);
        $posts = new WP_Query($query);

        if ($posts->have_posts()):
            ?>
            <?php
            $cols_per_row = (int) $instance['cols_per_row'];
            $post_classes = array('origamiez-wp-grid-post', 'col-xs-12');
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

            $global_index = 0;
            $loop_index = 1;
            while ($posts->have_posts()):
                $posts->the_post();
                $post_title = get_the_title();
                $post_url = get_permalink();

                $classes = $post_classes;

                if (1 === $loop_index) {
                    echo (0 == $global_index) ? '<div class="row row-first cleardix">' : '<div class="row cleardix">';
                    $classes[] = 'origamiez-wp-grid-post-first';
                } else if ($cols_per_row === $loop_index) {
                    $classes[] = 'origamiez-wp-grid-post-last';
                }
                ?>
                <article <?php post_class($classes); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>" class="link-hover-effect origamiez-post-thumb">                    
                            <?php the_post_thumbnail('square-vertical-m', array('class' => 'image-effect img-responsive')); ?>                            
                        </a>
                    <?php endif; ?>

                    <div class="origamiez-wp-grid-detail clearfix">
                        <h5>                                                
                            <a class="entry-title" href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>"><?php echo esc_attr($post_title); ?></a>
                        </h5>
                        
                        <?php if($is_show_date || $is_show_comments): ?>
                            <p class="metadata">
                                <span class="vcard author hidden"><span class="fn"><?php the_author();?></span></span>
                                <?php if($is_show_date): ?>
                                    <time class="updated metadata-date" datetime="<?php echo get_post_field('post_date_gmt', get_the_ID()); ?>">&horbar; <?php echo get_the_date(); ?></time>                                
                                <?php endif;?>
                                
                                <?php if($is_show_date && $is_show_comments): ?>
                                    <span class="metadata-divider">&nbsp;&nbsp;&nbsp;</span>
                                <?php endif;?>

                                <?php if($is_show_comments): ?>
                                    <?php comments_popup_link(__('No Comment', 'origamiez'), __('1 Comment', 'origamiez'), __('% Comments', 'origamiez'), 'metadata-comment', __('Comment Closed', 'origamiez')); ?>                                    
                                <?php endif;?>        
                            </p> 
                        <?php endif;?>

                        <?php
                        $content = strip_shortcodes(strip_tags(get_the_content()));
                        if (!empty($content)) {
                            if( (int)$excerpt_words_limit > 0){
                                printf('<p class="post-except">%s</p>', wp_trim_words($content, $excerpt_words_limit, false));
                            }                            
                        }
                        ?>
                    </div>                                                
                </article>
                <?php
                if ($cols_per_row === $loop_index) {
                    echo '</div>';
                    $loop_index = 1;
                } else {
                    $loop_index++;
                }
                $global_index ++;
            endwhile;
            ?>                

            <?php
        endif;
        wp_reset_postdata();

        echo wp_kses_post($after_widget);
    }

}
