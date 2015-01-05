<?php

class CT_Widget_Flickr extends WP_Widget {

    public $icon = 'ti-flickr';

    function __construct() {
        $widget_ops = array('classname' => 'ct-flickrfeed', 'description' => __('Display photos from flickr.com. Maximum is 20 photos.', ct_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('ct-widget-flickr', __('CT Flickr', ct_get_domain()), $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
        $instance['flickr_limit'] = (int) $new_instance['flickr_limit'];

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        ?>        
        <div class="ct-flickrfeed-list row clearfix" data-id="<?php echo esc_attr($instance['flickr_id']); ?>" data-limit="<?php echo (int) $instance['flickr_limit']; ?>"></div>        
        <?php
        echo $args['after_widget'];
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ct_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['title'])); ?>" />
        </p>  

        <p>
            <label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('ID:', ct_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['flickr_id'])); ?>" />            
            <small>(click <a href="http://idgettr.com/" target="_blank">here</a> to find your ID)</small>  
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('flickr_limit'); ?>"><?php _e('Number of photos:', ct_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_limit'); ?>" name="<?php echo $this->get_field_name('flickr_limit'); ?>" type="text" value="<?php echo (int) $instance['flickr_limit']; ?>" />
        </p>  
        <?php
    }

    protected function get_default() {
        return array(
            'title' => __('Photos from Flickr.com', ct_get_domain()),
            'flickr_id' => '64252859@N04',
            'flickr_limit' => 9
        );
    }

}
