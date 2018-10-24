<?php

add_action('wp_ajax_follow', function() {
  if (isset($_POST['user_id']) && isset($_POST['follow_id'])) {
    $User = new User();
    if ($User->follow(absint($_POST['follow_id']))) {
      echo 'success';
    } else {
      echo 'failed';
    }
  }
  die();
});

add_action('wp_ajax_unfollow', function() {
  if (isset($_POST['user_id']) && isset($_POST['follow_id'])) {
    $User = new User();
    if ($User->unfollow(absint($_POST['follow_id']))) {
      echo 'success';
    } else {
      echo 'failed';
    }
  }
  die();
});
