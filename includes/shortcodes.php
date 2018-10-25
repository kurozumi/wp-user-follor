<?php

add_shortcode('follow_links', function($atts, $content = null){
  extract(shortcode_atts(array(
      'follow_id' => get_the_author_meta('ID')
          ), $atts, 'follow_links')
  );
  
  return wuf_get_follow_unfollow_links($follow_id);
});

add_shortcode('following_posts', function() {

  $User = new WUP_User();
  
  if (empty($User->get_following()))
    return;

  $items = new WP_Query(array(
      'post_type' => 'any',
      'posts_per_page' => 15,
      'author__in' => $User->get_following()
      ));

  ob_start();
  ?>
  <ul>
    <ul><?php if ($items->have_posts()) : ?> <?php while ($items->have_posts()) : $items->the_post(); ?>
          <li class="wuf_following_post"><?php the_title(); ?></li>
        </ul>
      </ul>
    <?php endwhile; ?> <?php wp_reset_postdata(); ?> <?php else : ?>
    <ul>
      <ul>
        <li class="wuf_following_post wuf_following_no_results"><?php _e('None of the users you follow have posted anything.', 'wuf'); ?></li>
      </ul>
    </ul>
  <?php
  endif;
  return ob_get_clean();
});
