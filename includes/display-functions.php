<?php

/**
 * Retrieves the follow / unfollow links
 *
 * @access      public
 * @since       1.0
 * @param 	    int $user_id - the ID of the user to display follow / unfollow links for
 * @return      string
 */
function wuf_get_follow_unfollow_links($follow_id = null) {

  global $user_ID;

  if (empty($follow_id))
    return;

  if (!is_user_logged_in())
    return;

  if ($follow_id == $user_ID)
    return;
  
  $User = new WUP_User();

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
    <img src="<?php echo WUF_FOLLOW_URL; ?>/assets/images/loading.gif" class="uf-ajax" style="display:none;"/>
  </div>
  <?php
  return ob_get_clean();
}
