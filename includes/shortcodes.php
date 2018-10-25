<?php

add_shortcode('follow_links', function($atts, $content = null) {
  $atts = shortcode_atts(array(
      'follow_id' => get_the_author_meta('ID')
      ), $atts, 'follow_links');

  return wuf_get_follow_unfollow_links($atts["follow_id"]);
});

add_shortcode('following_posts', function() {
  global $WP_User_Follow;
  
  if (empty($WP_User_Follow->get_following()))
    return;

  return wuf_get_following_posts($WP_User_Follow->get_following());
});
