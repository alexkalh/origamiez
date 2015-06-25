<?php

class Origamiez_Widget_Newsletter extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'origamiez-widget-newsletter', 'description' => __('Give your biggest fans another way to keep up with your blog or podcast feed by placing an email subscription form on your site.', 'origamiez'));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('origamiez-widget-newsletter', __('Origamiez Newsletter', 'origamiez'), $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title']          = strip_tags($new_instance['title']);
        $instance['feedburner_uri'] = strip_tags($new_instance['feedburner_uri']);
        $instance['description']    = esc_textarea($new_instance['description']);

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo  htmlspecialchars_decode(esc_html($before_widget));
        if (!empty($title))
            echo  htmlspecialchars_decode(esc_html($before_title . $title . $after_title));

        extract($instance);

        $action = '//feedburner.google.com/fb/a/mailverify';
        $onsubmit_url = "//feedburner.google.com/fb/a/mailverify?uri={$feedburner_uri}";
        ?>        
        <form action="<?php echo esc_url($action); ?>" 
              method="post" 
              target="popupwindow" 
              onsubmit="window.open('<?php echo esc_url($onsubmit_url); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                              return true">                        
            <p class="newsletter-form">
                <input type="text" name="email" placeholder="<?php _e('Your email', 'origamiez'); ?>" class="origamiez-transition-all">     
                <button type="submit" class="origamiez-transition-all"><span class="fa fa-envelope"></span></button>
                <input type="hidden" value="<?php echo esc_attr($feedburner_uri); ?>" name="uri"/>
                <input type="hidden" name="loc" value="en_US"/>                                                            
            </p>  
            <?php if (!empty($instance['description'])): ?>
                <p class="newsletter-description"><?php echo  htmlspecialchars_decode(esc_html($instance['description'])); ?></p>
            <?php endif; ?>
        </form>
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
            <label for="<?php echo esc_attr($this->get_field_id('feedburner_uri')); ?>"><?php _e('Newsletter:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('feedburner_uri')); ?>" name="<?php echo esc_attr($this->get_field_name('feedburner_uri')); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['feedburner_uri'])); ?>" />            
            <small><?php _e(sprintf('click <a href="%s" target="_blank"> here </a> to register newsletter service', esc_url("//feedburner.google.com")), 'origamiez'); ?></small>  
        </p>  

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php _e('Description:', 'origamiez'); ?></label>            
            <textarea class="widefat" rows="7" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>"><?php echo esc_textarea($instance['description']); ?></textarea>                        
        </p> 
        <?php
    }

    protected function get_default() {
        return array(
            'title'          => __('Newsletter', 'origamiez'),
            'feedburner_uri' => 'ColoursTheme',
            'description'    => __('Stay up-to date with the latest news and other stuffs, Sign Up today!', 'origamiez')
        );
    }

}
