<?php

class Origamiez_Posts_Widget extends WP_Widget {

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title']               = strip_tags($new_instance['title']);
        $instance['posts_per_page']      = (int) strip_tags($new_instance['posts_per_page']);
        $instance['orderby']             = isset($new_instance['orderby']) && in_array($new_instance['orderby'], array('date', 'popular', 'comment_count', 'rand')) ? $new_instance['orderby'] : 'date';
        $instance['category']            = (isset($new_instance['category']) && is_array($new_instance['category'])) ? array_filter($new_instance['category']) : array();
        $instance['post_tag']            = (isset($new_instance['post_tag']) && is_array($new_instance['post_tag'])) ? array_filter($new_instance['post_tag']) : array();
        $instance['post_format']         = (isset($new_instance['post_format']) && is_array($new_instance['post_format'])) ? array_filter($new_instance['post_format']) : array();
        $instance['relation']            = isset($new_instance['relation']) && in_array($new_instance['relation'], array('AND', 'OR')) ? $new_instance['relation'] : 'OR';
        $instance['in']                  = strip_tags($new_instance['in']);
        $instance['is_include_children'] = (int)isset($new_instance['is_include_children']) ? 1 : 0;

        return $instance;
    }

    public function form($instance) {
        $instance = wp_parse_args((array) $instance, $this->get_default());
        extract( $instance );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr(strip_tags($instance['title'])); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>"><?php esc_html_e('Number of posts:', 'origamiez'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('posts_per_page')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_per_page')); ?>" type="text" value="<?php echo esc_attr((int) $instance['posts_per_page']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order by:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
                <?php
                $orderbys = array(
                    'date'          => esc_attr__('Latest news', 'origamiez'),
                    'comment_count' => esc_attr__('Most comments', 'origamiez'),
                    'rand'          => esc_attr__('Random', 'origamiez')
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
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Categories:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>[]" multiple="multiple" size="5">
                <option value=""><?php origamiez_get_metadata_prefix(); ?> <?php esc_html_e('All', 'origamiez'); ?> <?php origamiez_get_metadata_prefix(); ?></option>
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
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('is_include_children')); ?>" name="<?php echo esc_attr($this->get_field_name('is_include_children')); ?>" type="checkbox" value="1" <?php checked(1, (int)$is_include_children, true); ?> />
            <label for="<?php echo esc_attr($this->get_field_id('is_include_children')); ?>"><?php esc_html_e('Is include categories children ?', 'origamiez'); ?></label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('post_tag')); ?>"><?php esc_html_e('Tags:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_tag')); ?>" name="<?php echo esc_attr($this->get_field_name('post_tag')); ?>[]" multiple="multiple" size="5">
                <option value=""><?php origamiez_get_metadata_prefix(); ?> <?php esc_html_e('All', 'origamiez'); ?> <?php origamiez_get_metadata_prefix(); ?></option>
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
            <label for="<?php echo esc_attr($this->get_field_id('post_format')); ?>"><?php esc_html_e('Format:', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('post_format')); ?>" name="<?php echo esc_attr($this->get_field_name('post_format')); ?>[]" multiple="multiple" size="5">
                <option value=""><?php esc_html_e('-- All --', 'origamiez'); ?></option>
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
            <label for="<?php echo esc_attr($this->get_field_id('relation')); ?>"><?php esc_attr_e('Combine condition by Tags, Categories, Format', 'origamiez'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('relation')); ?>" name="<?php echo esc_attr($this->get_field_name('relation')); ?>">
                <?php
                $relations = array(
                    'AND' => esc_attr__('And', 'origamiez'),
                    'OR'  => esc_attr__('Or', 'origamiez'),
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
            <label for="<?php echo esc_attr($this->get_field_id('in')); ?>"><?php echo wp_kses(sprintf('%s <i>%s</i>', esc_attr__('In:', 'origamiez'), esc_attr__('(require Wordpress 3.7+)', 'origamiez')), origamiez_get_allowed_tags()); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('in')); ?>" name="<?php echo esc_attr($this->get_field_name('in')); ?>">
                <?php
                $times = array(
                    ''          => esc_attr__('-- All --', 'origamiez'),
                    '-1 week'   => esc_attr__('1 week', 'origamiez'),
                    '-2 week'   => esc_attr__('2 weeks', 'origamiez'),
                    '-3 week'   => esc_attr__('3 weeks', 'origamiez'),
                    '-1 month'  => esc_attr__('1 months', 'origamiez'),
                    '-2 month'  => esc_attr__('2 months', 'origamiez'),
                    '-3 month'  => esc_attr__('3 months', 'origamiez'),
                    '-4 month'  => esc_attr__('4 months', 'origamiez'),
                    '-5 month'  => esc_attr__('5 months', 'origamiez'),
                    '-6 month'  => esc_attr__('6 months', 'origamiez'),
                    '-7 month'  => esc_attr__('7 months', 'origamiez'),
                    '-8 month'  => esc_attr__('8 months', 'origamiez'),
                    '-9 month'  => esc_attr__('9 months', 'origamiez'),
                    '-10 month' => esc_attr__('10 months', 'origamiez'),
                    '-11 month' => esc_attr__('11 months', 'origamiez'),
                    '-1 year'   => esc_attr__('1 year', 'origamiez'),
                    '-2 year'   => esc_attr__('2 years', 'origamiez'),
                    '-3 year'   => esc_attr__('3 years', 'origamiez'),
                    '-4 year'   => esc_attr__('4 years', 'origamiez'),
                    '-5 year'   => esc_attr__('5 years', 'origamiez')
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
                'taxonomy'         => 'category',
                'field'            => 'id',
                'terms'            => $instance['category'],
                'include_children' => (int)$instance['is_include_children'],
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
            $args['tax_query']['relation'] = $instance['relation'];
        }

        if (isset($instance['orderby'])) {
            switch ($instance['orderby']) {
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
                            'year'  => (int) $y,
                            'month' => (int) $m,
                            'day'   => (int) $d
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
            'title'               => '',
            'posts_per_page'      => 5,
            'orderby'             => 'date',
            'category'            => array(),
            'is_include_children' => 1,
            'post_tag'            => array(),
            'post_format'         => array(),
            'relation'            => 'OR',
            'in'                  => ''
        );
    }
}
