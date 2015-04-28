<?php

if (!function_exists('ot_type_icon')) {

    add_filter('ot_option_types_array', 'origamiez_add_type_icon');

    function origamiez_add_type_icon($types) {
        $types['icon'] = __('Social icon', 'origamiez');
        return $types;
    }

    function ot_type_icon($args = array()) {
        /* turns arguments array into variables */
        extract($args);

        /* verify a description */
        $has_desc = $field_desc ? true : false;

        /* format setting outer wrapper */
        echo '<div class="format-setting type-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';

        /* description */
        echo $has_desc ? '<div class="description">' . wp_kses_post($field_desc) . '</div>' : '';

        /* filter choices array */
        $field_choices = apply_filters('ot_type_icon_choices', array(
            array(
                'value' => 'fa fa-behance',
                'label' => __('Behance', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-bitbucket',
                'label' => __('Bitbucket', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-codepen',
                'label' => __('Codepen', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-delicious',
                'label' => __('Delicious', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-deviantart',
                'label' => __('Deviantart', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-digg',
                'label' => __('Digg', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-dribbble',
                'label' => __('Dribbble', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-dropbox',
                'label' => __('Dropbox', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-facebook',
                'label' => __('Facebook', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-flickr',
                'label' => __('Flickr', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-foursquare',
                'label' => __('Foursquare', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-git',
                'label' => __('Git', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-github',
                'label' => __('Github', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-google-plus',
                'label' => __('Google plus', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-instagram',
                'label' => __('Instagram', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-jsfiddle',
                'label' => __('JsFiddle', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-linkedin',
                'label' => __('linkedin', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-pinterest',
                'label' => __('Pinterest', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-reddit',
                'label' => __('Reddit', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-rss',
                'label' => __('Rss', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-soundcloud',
                'label' => __('Soundcloud', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-spotify',
                'label' => __('Spotify', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-stack-exchange',
                'label' => __('Stack exchange', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-stack-overflow',
                'label' => __('Stack overflow', 'origamiez'),
                'src' => ''
            ), array(
                'value' => 'fa fa-stumbleupon',
                'label' => __('Stumbleupon', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-tumblr',
                'label' => __('Tumblr', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-twitter',
                'label' => __('Twitter', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-vimeo-square',
                'label' => __('Vimeo', 'origamiez'),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-youtube',
                'label' => __('Youtube', 'origamiez'),
                'src' => ''
            )), $field_id);

        /* format setting inner wrapper */
        echo '<div class="format-setting-inner">';

        /* build select */
        echo '<select name="' . esc_attr($field_name) . '" id="' . esc_attr($field_id) . '" class="option-tree-ui-select ' . esc_attr($field_class) . '">';
        foreach ((array) $field_choices as $choice) {
            if (isset($choice['value']) && isset($choice['label'])) {
                echo '<option value="' . esc_attr($choice['value']) . '"' . selected($field_value, $choice['value'], false) . '>' . esc_attr($choice['label']) . '</option>';
            }
        }

        echo '</select>';

        echo '</div>';

        echo '</div>';
    }

}