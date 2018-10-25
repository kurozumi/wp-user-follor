<?php

class WP_User_Follow_Followers {

  const FOLLOWERS_KEY = "_wuf_followers";

  public function get($user_id) {
    return (array) get_user_meta($user_id, self::FOLLOWERS_KEY, true);
  }

  public function update($user_id, array $users) {
    update_user_meta($user_id, self::FOLLOWERS_KEY, $users);
  }

}
