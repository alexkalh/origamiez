<?php

class CT_Widget_Newsletter extends WP_Widget {

    public $icon = 'fa fa-envelope-o';

    function __construct() {
        $widget_ops = array('classname' => 'ct-widget-newsletter', 'description' => __('Give your biggest fans another way to keep up with your blog or podcast feed by placing an email subscription form on your site.', ct_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('ct-widget-newsletter', __('CT Newsletter', ct_get_domain()), $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['feedburner_uri'] = strip_tags($new_instance['feedburner_uri']);
        $instance['description'] = esc_textarea($new_instance['description']);

        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        extract($instance);
        ?>        
        <form action="http://feedburner.google.com/fb/a/mailverify" 
              method="post" 
              target="popupwindow" 
              onsubmit="window.open('<?php printf('http://feedburner.google.com/fb/a/mailverify?uri=%s', esc_js($feedburner_uri)); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');
                              return true">                        
            <p class="newsletter-form">
                <input type="text" name="email" placeholder="<?php _e('Your email', ct_get_domain()); ?>" class="ct-transition-all">     
                <button type="submit" class="ct-transition-all"><span class="fa fa-envelope"></span></button>
                <input type="hidden" value="colourstheme" name="uri"/>
                <input type="hidden" name="loc" value="en_US"/>                                                            
            </p>  
            <?php if (!empty($instance['description'])): ?>
                <p class="newsletter-description"><?php echo $instance['description']; ?></p>
            <?php endif; ?>
        </form>
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
            <label for="<?php echo $this->get_field_id('feedburner_uri'); ?>"><?php _e('Newsletter:', ct_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('feedburner_uri'); ?>" name="<?php echo $this->get_field_name('feedburner_uri'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['feedburner_uri'])); ?>" />            
            <small><?php _e(sprintf('(click %s here %s to register newsletter service)', '<a href="http://feedburner.google.com" target="_blank">', '</a>'), ct_get_domain()); ?></small>  
        </p>  

        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', ct_get_domain()); ?></label>            
            <textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea($instance['description']); ?></textarea>                        
        </p> 
        <?php
    }

    protected function get_default() {
        return array(
            'title' => __('Newsletter', ct_get_domain()),
            'feedburner_uri' => 'colourstheme',
            'description' => __('Stay up-to date with the latest news and other stuffs, Sign Up today!', ct_get_domain())
        );
    }

}
