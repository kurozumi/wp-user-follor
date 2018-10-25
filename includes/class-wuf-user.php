<?php
class WUF_User {

  const FOLLOWING_KEY = "_wuf_following";
  const FOLLOWERS_KEY = "_wuf_followers";
  const FOLLOWED_BY_COUNT_KEY = "_wuf_followed_by_count";

  public function follow($follow_user) {
    $user_id = get_current_user_id();

    $following = $this->get_following();
    $following = $this->add_user($following, $follow_user);

    $followers = $this->get_followers($follow_user);
    $followers = $this->add_user($followers, $user_id);

    // フォローユーザーのIDを更新
    $followed = update_user_meta($user_id, self::FOLLOWING_KEY, $following);

    // フォローされているユーザーIDを更新
    update_user_meta($follow_user, self::FOLLOWERS_KEY, $followers);

    // increase the followers count
    $this->increase_follower_count($follow_user);

    if ($followed) {
      return true;
    }
    return false;
  }

  public function unfollow($unfollow_user) {
    $user_id = get_current_user_id();

    $following = $this->get_following();

    $modified = $this->remove_user($following, $unfollow_user);

    if ($modified) {
      if (update_user_meta($user_id, self::FOLLOWING_KEY, $following)) {
        $this->decrease_follower_by_count($unfollow_user);
      }
    }

    $followers = $this->get_followers($unfollow_user);

    $modified = $this->remove_user($followers, $user_id);

    if ($modified) {
      update_user_meta($unfollow_user, self::FOLLOWERS_KEY, $followers);
    }

    if ($modified) {
      return true;
    }

    return false;
  }
  
  public function is_following($followed_user) {
    $user_id = get_current_user_id();

    $following = $this->get_following();

    $ret = false; // is not following by default

    if (is_array($following) && in_array($followed_user, $following)) {
      $ret = true; // is following
    }

    return (bool) $ret;
  }

  public function get_following() {
    return (array) get_user_meta(get_current_user_id(), self::FOLLOWING_KEY, true);
  }

  public function get_followers($user_id) {
    return (array) get_user_meta($user_id, self::FOLLOWERS_KEY, true);
  }

  public function add_user($users, $user) {
    return array_merge($users, array($user));
  }

  public function remove_user($users, $user) {
    if (!is_array($users))
      return false;

    foreach ($users as $key => $follow) {
      if ($follow == $user) {
        unset($users[$key]);
        return true;
      }
    }

    return false;
  }

  public function increase_follower_count($user_id) {
    $followed_count = $this->get_follower_count($user_id);

    if ($followed_count !== false) {
      return update_user_meta($user_id, self::FOLLOWED_BY_COUNT_KEY, $followed_count + 1);
    } else {
      return update_user_meta($user_id, self::FOLLOWED_BY_COUNT_KEY, 1);
    }
  }

  public function decrease_follower_by_count($user_id) {
    $followed_count = $this->get_follower_count($user_id);

    if ($followed_count) {
      return update_user_meta($user_id, self::FOLLOWED_BY_COUNT_KEY, ( $followed_count - 1));
    }
    return false;
  }

  public function get_follower_count($user_id) {
    return get_user_meta($user_id, self::FOLLOWED_BY_COUNT_KEY, true);
  }
}
