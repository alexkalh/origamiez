<?php

add_action('widgets_init', array('Origamiez_Widget_Posts_List_Grid', 'register'));

class Origamiez_Widget_Posts_List_Grid extends Origamiez_Posts_Widget_Type_C {

    public static function register(){
        register_widget('Origamiez_Widget_Posts_List_Grid');
    }

    function __construct() {
        $widget_ops  = array('classname' => 'origamiez-widget-posts-grid', 'description' => esc_attr__('Display posts grid with small thumbnail.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-post-grid', esc_attr__('Origamiez Posts Grid', 'origamiez'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());

        extract($args);
        extract($instance);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo wp_kses( $before_widget, origamiez_get_allowed_tags() );
        
        if (!empty($title)){
            echo wp_kses( $before_title . $title . $after_title, origamiez_get_allowed_tags() );
        }            

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
                            
                            <?php parent::print_metadata( $is_show_date, $is_show_comments, $is_show_author, 'metadata' ); ?>  

                            <?php parent::print_excerpt( $excerpt_words_limit, 'entry-excerpt clearfix' ); ?>                         

                        </div>                                                
                    </article>

                    <?php                    
                endwhile;
                ?>              
            </div>
            <?php
        endif;
        wp_reset_postdata();
        
        echo wp_kses( $after_widget, origamiez_get_allowed_tags() );
    }

    function update($new_instance, $old_instance) {
        $instance                 = parent::update($new_instance, $old_instance);
        $instance['cols_per_row'] = (int) esc_attr($new_instance['cols_per_row']);
        return $instance;
    }

    function form($instance) {
        parent::form($instance);
        $instance = wp_parse_args((array) $instance, $this->get_default());
        extract($instance);
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cols_per_row')); ?>"><?php esc_html_e('Cols per row:', 'origamiez'); ?></label>
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
        <?php
    }

    protected function get_default() {
        $default                 = parent::get_default();
        $default['cols_per_row'] = 3;        
        return $default;
    }

}
