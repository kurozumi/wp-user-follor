<?php

function wuf_get_follow_unfollow_links($follow_id = null) {

  global $user_ID;

  if (empty($follow_id))
    return;

  if (!is_user_logged_in())
    return;

  if ($follow_id == $user_ID)
    return;

  $User = new WUF_User();

  ob_start();
  ?>
  <div class="follow-links">
  <?php if ($User->is_following($follow_id)) { ?>
      <a href="#" class="unfollow followed" data-user-id="<?php echo $user_ID; ?>" data-follow-id="<?php echo $follow_id; ?>">unfollow</a>
      <a href="#" class="follow" style="display:none;" data-user-id="<?php echo $user_ID; ?>" data-follow-id="<?php echo $follow_id; ?>">follow</a>
  <?php } else { ?>
      <a href="#" class="follow" data-user-id="<?php echo $user_ID; ?>" data-follow-id="<?php echo $follow_id; ?>">follow</a>
      <a href="#" class="followed unfollow" style="display:none;" data-user-id="<?php echo $user_ID; ?>" data-follow-id="<?php echo $follow_id; ?>">unfollow</a>
  <?php } ?>
    <img src="<?php echo WUF_FOLLOW_URL; ?>/assets/images/loading.gif" class="wuf-ajax" style="display:none;"/>
  </div>
  <?php
  return ob_get_clean();
}

function wuf_get_following_posts($following) {
  $items = new WP_Query(array(
      'post_type' => 'any',
      'posts_per_page' => 15,
      'author__in' => $following
  ));

  ob_start();
  ?>
      <?php if ($items->have_posts()) : ?>
    <ul>
      <?php while ($items->have_posts()) : $items->the_post(); ?>
        <li class="wuf_following_post"><?php the_title(); ?></li>
    <?php endwhile; ?>
    </ul>
    <?php wp_reset_postdata(); ?>
  <?php else : ?>
    <ul>
      <li class="wuf_following_post wuf_following_no_results"><?php _e('None of the users you follow have posted anything.', 'wuf'); ?></li>
    </ul>
  <?php
  endif;
  return ob_get_clean();
}
