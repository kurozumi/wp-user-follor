<?php

class WP_User_Follow_Following {

  const FOLLOWING_KEY = "_wuf_following";
  
  public function get($user_id) {
    return (array) get_user_meta($user_id, self::FOLLOWING_KEY, true);
  }
  
  public function update($user_id, array $users) {
    update_user_meta($user_id, self::FOLLOWING_KEY, $users);
  }
}
