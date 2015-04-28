<?php

class CT_Post_Widget extends WP_Widget {

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts_per_page'] = (int) strip_tags($new_instance['posts_per_page']);
        $instance['orderby'] = isset($new_instance['orderby']) && in_array($new_instance['orderby'], array('date', 'popular', 'comment_count', 'rand')) ? $new_instance['orderby'] : 'date';
        $instance['category'] = (isset($new_instance['category']) && is_array($new_instance['category'])) ? array_filter($new_instance['category']) : array();
        $instance['post_tag'] = (isset($new_instance['post_tag']) && is_array($new_instance['post_tag'])) ? array_filter($new_instance['post_tag']) : array();
        $instance['post_format'] = (isset($new_instance['post_format']) && is_array($new_instance['post_format'])) ? array_filter($new_instance['post_format']) : array();
        $instance['relation'] = isset($new_instance['relation']) && in_array($new_instance['relation'], array('AND', 'OR')) ? $new_instance['relation'] : 'OR';
        $instance['in'] = strip_tags($new_instance['in']);

        return $instance;
    }

    public function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());        
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['title'])); ?>" />
        </p>  

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>"><?php _e('Number of posts:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" type="text" value="<?php echo esc_attr((int) $instance['posts_per_page']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php _e('Order by:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">                
                <?php
                $orderbys = array(
                    'date' => __('Latest news', 'origamiez'),
                    'popular' => __('Popular by view count', 'origamiez'),
                    'comment_count' => __('Most comments', 'origamiez'),
                    'rand' => __('Random', 'origamiez')
                );
                foreach ($orderbys as $value => $title) {
                    ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($instance['orderby'], $value); ?>><?php echo esc_attr($title); ?></option>
                    <?php
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _e('Categories:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>[]" multiple="multiple" size="5">
                <option value="">&horbar; <?php _e('All', 'origamiez'); ?> &horbar;</option>
                <?php
                $terms = get_terms('category');
                if ($terms) {
                    foreach ($terms as $term) {
                        $selected = in_array($term->term_id, $instance['category']) ? 'selected="selected"' : '';
                        ?>
                        <option value="<?php echo esc_attr($term->term_id); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($term->name); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_tag')); ?>"><?php _e('Tags:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_tag')); ?>" name="<?php echo esc_attr($this->get_field_name('post_tag')); ?>[]" multiple="multiple" size="5">
                <option value="">&horbar; <?php _e('All', 'origamiez'); ?> &horbar;</option>
                <?php
                $terms = get_terms('post_tag');
                if ($terms) {
                    foreach ($terms as $term) {
                        $selected = in_array($term->term_id, $instance['post_tag']) ? 'selected="selected"' : '';
                        ?>
                        <option value="<?php echo esc_attr($term->term_id); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($term->name); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_format')); ?>"><?php _e('Format:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_format')); ?>" name="<?php echo esc_attr($this->get_field_name('post_format')); ?>[]" multiple="multiple" size="5">
                <option value=""><?php _e('-- All --', 'origamiez'); ?></option>
                <?php
                $terms = get_terms('post_format');
                if ($terms) {
                    foreach ($terms as $term) {
                        $selected = in_array($term->term_id, $instance['post_format']) ? 'selected="selected"' : '';
                        ?>
                        <option value="<?php echo esc_attr($term->term_id); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_attr($term->name); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('relation')); ?>"><?php _e('Combine condition by <i>Tags</i>, <i>Categories</i>, <i>Format</i>', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('relation')); ?>" name="<?php echo esc_attr($this->get_field_name('relation')); ?>">                
                <?php
                $relations = array(
                    'AND' => __('And', 'origamiez'),
                    'OR' => __('Or', 'origamiez'),
                );
                foreach ($relations as $value => $title) {
                    ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($instance['relation'], $value); ?>><?php echo esc_attr($title); ?></option>
                    <?php
                }
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('in')); ?>"><?php printf('%s <i>%s</i>', __('In:', 'origamiez'), __('(require Wordpress 3.7+)', 'origamiez')); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('in')); ?>" name="<?php echo esc_attr($this->get_field_name('in')); ?>">                
                <?php
                $times = array(
                    ''          => __('-- All --', 'origamiez'),
                    '-1 week'   => __('1 week', 'origamiez'),
                    '-2 week'   => __('2 weeks', 'origamiez'),
                    '-3 week'   => __('3 weeks', 'origamiez'),
                    '-1 month'  => __('1 months', 'origamiez'),
                    '-2 month'  => __('2 months', 'origamiez'),
                    '-3 month'  => __('3 months', 'origamiez'),
                    '-4 month'  => __('4 months', 'origamiez'),
                    '-5 month'  => __('5 months', 'origamiez'),
                    '-6 month'  => __('6 months', 'origamiez'),
                    '-7 month'  => __('7 months', 'origamiez'),
                    '-8 month'  => __('8 months', 'origamiez'),
                    '-9 month'  => __('9 months', 'origamiez'),
                    '-10 month' => __('10 months', 'origamiez'),
                    '-11 month' => __('11 months', 'origamiez'),
                    '-1 year'   => __('1 year', 'origamiez'),
                    '-2 year'   => __('2 years', 'origamiez'),
                    '-3 year'   => __('3 years', 'origamiez'),
                    '-4 year'   => __('4 years', 'origamiez'),
                    '-5 year'   => __('5 years', 'origamiez')
                );
                foreach ($times as $value => $title) {
                    ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($instance['in'], $value); ?>><?php echo esc_attr($title); ?></option>
                    <?php
                }
                ?>
            </select>
        </p>

        <?php
    }

    public function get_query($instance, $args_extra = array()) {
        global $wp_version;

        $args = array(
            'post_type'           => array('post'),
            'posts_per_page'      => (int) $instance['posts_per_page'],
            'post_status'         => array('publish'),
            'ignore_sticky_posts' => true
        );

        if (!empty($instance['category'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $instance['category']
            );
        }

        if (!empty($instance['post_tag'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'post_tag',
                'field'    => 'id',
                'terms'    => $instance['post_tag']
            );
        }

        if (!empty($instance['post_format'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'post_format',
                'field'    => 'id',
                'terms'    => $instance['post_format']
            );
        }

        if (isset($args['tax_query']) && (count($args['tax_query']) >= 2)) {
            $args['tax_query']['relation'] = ('true' == $instance['relation']) ? 'AND' : 'OR';
        }

        if (isset($instance['orderby'])) {
            switch ($instance['orderby']) {
                case 'popular':
                    $args['meta_key'] = ORIGAMIEZ_PREFIX . 'views';
                    $args['orderby'] = 'meta_value_num';
                    break;
                case 'comment_count':
                    $args['orderby'] = 'comment_count';
                    break;
                case 'rand':
                    $args['orderby'] = 'rand';
                    break;
                default:
                    $args['orderby'] = 'date';
                    break;
            }
        } else {
            $args['orderby'] = 'date';
        }

        if (version_compare($wp_version, '3.7', '>=')) {
            if (isset($instance['in']) && !empty($instance['in'])) {
                $in = $instance['in'];
                $y = date('Y', strtotime($in));
                $m = date('m', strtotime($in));
                $d = date('d', strtotime($in));

                $args['date_query'] = array(
                    array(
                        'after' => array(
                            'year' => (int) $y,
                            'month' => (int) $m,
                            'day' => (int) $d
                        )
                    )
                );
            }
        }

        if (!empty($args_extra)) {
            return array_merge($args, $args_extra);
        } else {
            return $args;
        }
    }

    protected function get_default() {
        return array(
            'title' => '',
            'posts_per_page' => 5,
            'orderby' => 'date',
            'category' => array(),
            'post_tag' => array(),
            'post_format' => array(),
            'relation' => 'OR',
            'in' => ''
        );
    }

}
