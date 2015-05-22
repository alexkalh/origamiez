<?php

class Origamiez_Widget_Flickr extends WP_Widget {

    public $icon = 'ti-flickr';

    function __construct() {
        $widget_ops = array('classname' => 'origamiez-flickrfeed', 'description' => __('Display photos from flickr.com. Maximum is 20 photos.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-flickr', __('Origamiez Flickr', 'origamiez'), $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title']        = strip_tags($new_instance['title']);
        $instance['flickr_id']    = strip_tags($new_instance['flickr_id']);
        $instance['flickr_limit'] = (int) $new_instance['flickr_limit'];

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo  htmlspecialchars_decode(esc_html($before_widget));
        
        if (!empty($title))
            echo  htmlspecialchars_decode(esc_html($before_title . $title . $after_title));
        ?>        
        <div class="origamiez-flickrfeed-list row clearfix" 
            data-id="<?php echo esc_attr($instance['flickr_id']); ?>" 
            data-limit="<?php echo (int) esc_attr($instance['flickr_limit']); ?>"></div>        
        <?php

        echo  htmlspecialchars_decode(esc_html($after_widget));
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['title'])); ?>" />
        </p>  

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>"><?php _e('ID:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_id')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_id')); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['flickr_id'])); ?>" />            
            <small>(click <a href="http://idgettr.com/" target="_blank">here</a> to find your ID)</small>  
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('flickr_limit')); ?>"><?php _e('Number of photos:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr_limit')); ?>" type="text" value="<?php echo esc_attr((int) $instance['flickr_limit']); ?>" />
        </p>  
        <?php
    }

    protected function get_default() {
        return array(
            'title'        => __('Photos from Flickr.com', 'origamiez'),
            'flickr_id'    => '64252859@N04',
            'flickr_limit' => 9
        );
    }

}
