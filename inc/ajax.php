<?php

if (!function_exists('ct_ajax_set_view')) {
    add_action('wp_ajax_ct_set_view', 'ct_ajax_set_view');
    add_action('wp_ajax_nopriv_ct_set_view', 'ct_ajax_set_view');

    function ct_ajax_set_view() {        
        check_ajax_referer('ct_set_view', 'ajax_nonce');

        if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
            $post_id = (int) $_POST['post_id'];
            echo '<i class="fa fa-eye"></i>' . ct_set_view($post_id);
        }
        
        exit();
    }

}