<?php

class CT_Widget_Social_Links extends WP_Widget {

    public $icon = 'ti-sharethis';

    function __construct() {
        $widget_ops = array('classname' => 'ct-widget-social-links', 'description' => __('Display your social links. Config on Theme Options >> Social links.', ct_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('ct-widget-social-links', __('CT Social Links', ct_get_domain()), $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);

        $instance = wp_parse_args((array) $instance, $this->get_default());

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        $socials = ot_get_option('social_links', array());

        if (!empty($socials)):
            ?>
            <div class="social-link-inner clearfix">
                <?php
                foreach ($socials as $social):                    
                    $style = '';
                    if ($social['color']) {
                        $style = sprintf('style="color:#FFF; background-color:%1$s; border-color: %1$s;"', $social['color']);
                    }

                    if ('fa fa-rss' == $social['icon'] && empty($social['href'])){
                        $social['href'] = get_bloginfo('rss2_url');
                    }
                    ?>
                    <a href="<?php echo $social['href']; ?>" data-placement="top"  data-toggle="tooltip" title="<?php echo $social['title'];?>" rel="nofollow" target="_blank" class="ct-tooltip social-link social-link-first" <?php echo $style;?>><span class="<?php echo $social['icon']; ?>"></span></a>
                    <?php
                endforeach;
                ?>
            </div>
            <?php
        endif;

        echo $args['after_widget'];
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ct_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['title'])); ?>" />
        </p>   
        <?php
    }

    protected function get_default() {
        return array(
            'title' => __('Social Links', ct_get_domain())
        );
    }

}
