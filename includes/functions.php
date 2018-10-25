<?php


function wuf_ajax_follow() {
  global $WP_User_Follow;
  
  if (isset($_POST['user_id']) && isset($_POST['follow_id'])) {
    if ($WP_User_Follow->follow(absint($_POST['follow_id']))) {
      wp_send_json_success();
    }
    
    wp_send_json_error();
  }
  ;  
}

function wuf_ajax_unfollow() {
  global $WP_User_Follow;
  
  if (isset($_POST['user_id']) && isset($_POST['follow_id'])) {
    if ($WP_User_Follow->unfollow(absint($_POST['follow_id']))) {
      wp_send_json_success();
    }
  }
  
  wp_send_json_error();
}

function wuf_enqueue_scripts() {
  wp_enqueue_script('wuf-follow', WUF_FOLLOW_URL . '/assets/js/follow.js', array('jquery'));
  wp_localize_script('wuf-follow', 'wuf_vars', array(
      'processing_error' => __('There was a problem processing your request.', 'wuf'),
      'login_required'   => __('Oops, you must be logged-in to follow users.', 'wuf'),
      'logged_in'        => is_user_logged_in() ? 'true' : 'false',
      'ajaxurl'          => admin_url('admin-ajax.php'),
      'nonce'            => wp_create_nonce('follow_nonce')
  ));
}