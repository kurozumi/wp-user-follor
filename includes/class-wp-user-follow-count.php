<?php

class WP_User_Follow_Count {
  
  const FOLLOWED_BY_COUNT_KEY = "_wuf_followed_by_count";
  
  public function get($user_id) {
    return get_user_meta($user_id, self::FOLLOWED_BY_COUNT_KEY, true);
  }  
  
  public function update($user_id, array $users) {    
    return update_user_meta($user_id, self::FOLLOWED_BY_COUNT_KEY, count($users));
  }
}