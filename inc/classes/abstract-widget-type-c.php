<?php

class Origamiez_Posts_Widget_Type_C extends Origamiez_Posts_Widget_Type_B {

    public function update($new_instance, $old_instance) {
        $instance           = parent::update( $new_instance, $old_instance );                 
        $instance['offset'] = isset($new_instance['offset']) ? (int)$new_instance['offset'] : 0;
        return $instance;
    }

    public function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());
        extract( $instance );
        parent::form( $instance );
        ?>
        <p>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('offset')); ?>" name="<?php echo esc_attr($this->get_field_name('offset')); ?>" type="number" value="<?php echo esc_attr( $offset ); ?>"/>
            <label for="<?php echo esc_attr($this->get_field_id('offset')); ?>"><?php esc_html_e('Offset. Number of post to displace or pass over.', 'origamiez'); ?></label>
        </p>
        <?php
    }

    protected function get_default() {
        $default           = parent::get_default();
        $default['offset'] = 0;        
        return $default;
    }

    public function get_query( $instance, $args_extra = array()) {
        $instance = wp_parse_args((array) $instance, $this->get_default());
        extract($instance);

        $args = parent::get_query( $instance, $args_extra );

        if( $offset ){
            $args['offset'] = $offset;
        }

        return $args;
    }


}
