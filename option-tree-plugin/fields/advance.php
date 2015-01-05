<?php

if (!function_exists('ot_type_icon')) {

    add_filter('ot_option_types_array', 'ct_add_type_icon');

    function ct_add_type_icon($types) {
        $types['icon'] = __('Social icon', ct_get_domain());
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
        echo $has_desc ? '<div class="description">' . htmlspecialchars_decode($field_desc) . '</div>' : '';

        /* filter choices array */
        $field_choices = apply_filters('ot_type_icon_choices', array(
            array(
                'value' => 'fa fa-behance',
                'label' => __('Behance', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-bitbucket',
                'label' => __('Bitbucket', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-codepen',
                'label' => __('Codepen', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-delicious',
                'label' => __('Delicious', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-deviantart',
                'label' => __('Deviantart', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-digg',
                'label' => __('Digg', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-dribbble',
                'label' => __('Dribbble', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-dropbox',
                'label' => __('Dropbox', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-facebook',
                'label' => __('Facebook', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-flickr',
                'label' => __('Flickr', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-foursquare',
                'label' => __('Foursquare', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-git',
                'label' => __('Git', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-github',
                'label' => __('Github', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-google-plus',
                'label' => __('Google plus', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-instagram',
                'label' => __('Instagram', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-jsfiddle',
                'label' => __('JsFiddle', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-linkedin',
                'label' => __('linkedin', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-pinterest',
                'label' => __('Pinterest', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-reddit',
                'label' => __('Reddit', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-rss',
                'label' => __('Rss', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-soundcloud',
                'label' => __('Soundcloud', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-spotify',
                'label' => __('Spotify', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-stack-exchange',
                'label' => __('Stack exchange', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-stack-overflow',
                'label' => __('Stack overflow', ct_get_domain()),
                'src' => ''
            ), array(
                'value' => 'fa fa-stumbleupon',
                'label' => __('Stumbleupon', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-tumblr',
                'label' => __('Tumblr', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-twitter',
                'label' => __('Twitter', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-vimeo-square',
                'label' => __('Vimeo', ct_get_domain()),
                'src' => ''
            ),
            array(
                'value' => 'fa fa-youtube',
                'label' => __('Youtube', ct_get_domain()),
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