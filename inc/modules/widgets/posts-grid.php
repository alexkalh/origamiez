<?php

class CT_Widget_Post_Grid extends CT_Post_Widget {

    public $icon = 'ti-layout-grid2';

    function __construct() {
        $widget_ops = array('classname' => 'ct-widget-posts-grid', 'description' => __('Display posts grid with small thumbnail.', ct_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('ct-widget-post-grid', __('CT Posts Grid', ct_get_domain()), $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = parent::update($new_instance, $old_instance);

        $instance['cols_per_row'] = (int) strip_tags($new_instance['cols_per_row']);        
        $instance['excerpt_words_limit'] = isset($new_instance['excerpt_words_limit']) ? (int) $new_instance['excerpt_words_limit'] : 0;
        $instance['is_show_date'] = isset($new_instance['is_show_date']) ? 1 : 0;
        $instance['is_show_comments'] = isset($new_instance['is_show_comments']) ? 1 : 0;

        return $instance;
    }

    function form($instance) {
        parent::form($instance);
        $instance = wp_parse_args((array) $instance, $this->get_default());
        extract($instance);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('cols_per_row'); ?>"><?php _e('Cols per row:', ct_get_domain()); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('cols_per_row'); ?>" name="<?php echo $this->get_field_name('cols_per_row'); ?>">                
                <?php
                $cols = array(3, 4, 6);
                foreach ($cols as $col) {
                    ?>
                    <option value="<?php echo $col; ?>" <?php selected($instance['cols_per_row'], $col); ?>><?php echo $col; ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('excerpt_words_limit'); ?>"><?php _e('Excerpt words limit:', ct_get_domain()); ?></label>            
            <input class="widefat" id="<?php echo $this->get_field_id('excerpt_words_limit'); ?>" name="<?php echo $this->get_field_name('excerpt_words_limit'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['excerpt_words_limit'])); ?>" />            
        </p>
        <p>            
            <input class="widefat" id="<?php echo $this->get_field_id('is_show_date'); ?>" name="<?php echo $this->get_field_name('is_show_date'); ?>" type="checkbox" value="1" <?php checked(1, (int)$is_show_date, true); ?> />            
            <label for="<?php echo $this->get_field_id('is_show_date'); ?>"><?php _e('Is show date:', ct_get_domain()); ?></label>            
        </p>
        <p>
            <input class="widefat" id="<?php echo $this->get_field_id('is_show_comments'); ?>" name="<?php echo $this->get_field_name('is_show_comments'); ?>" type="checkbox" value="1" <?php checked(1, (int)$is_show_comments, true); ?> />            
            <label for="<?php echo $this->get_field_id('is_show_comments'); ?>"><?php _e('Is show comments:', ct_get_domain()); ?></label>                        
        </p>
        <?php
    }

    protected function get_default() {
        $default = parent::get_default();

        $default['cols_per_row'] = 3;        
        $default['excerpt_words_limit'] = 0;
        $default['is_show_date'] = 1;
        $default['is_show_comments'] = 1;

        return $default;
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
            $cols_per_row = (int) $instance['cols_per_row'];
            $post_classes = array('ct-wp-grid-post', 'col-xs-12');
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
                    $classes[] = 'ct-wp-grid-post-first';
                } else if ($cols_per_row === $loop_index) {
                    $classes[] = 'ct-wp-grid-post-last';
                }
                ?>
                <article <?php post_class($classes); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>" class="link-hover-effect ct-post-thumb">                    
                            <?php the_post_thumbnail('square-vertical-m', array('class' => 'image-effect img-responsive')); ?>                            
                        </a>
                    <?php endif; ?>

                    <div class="ct-wp-grid-detail clearfix">
                        <h5>                                                
                            <a class="entry-title" href="<?php echo $post_url; ?>" title="<?php echo $post_title; ?>"><?php echo $post_title; ?></a>
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
                                    <?php comments_popup_link(__('No Comment', ct_get_domain()), __('1 Comment', ct_get_domain()), __('% Comments', ct_get_domain()), 'metadata-comment', __('0 Comment', ct_get_domain())); ?>                                    
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

        echo $args['after_widget'];
    }

}
