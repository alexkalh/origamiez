<?php

if (!function_exists('origamiez_ajax_set_view')) {
    add_action('wp_ajax_origamiez_set_view', 'origamiez_ajax_set_view');
    add_action('wp_ajax_nopriv_origamiez_set_view', 'origamiez_ajax_set_view');

    function origamiez_ajax_set_view() {        
        check_ajax_referer('origamiez_set_view', 'ajax_nonce');

        if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
            $post_id = (int) $_POST['post_id'];
            echo '<i class="fa fa-eye"></i>' . origamiez_set_view($post_id);
        }
        
        exit();
    }

}