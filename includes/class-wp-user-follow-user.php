<?php

class WP_User_Follow_User {

  public function add(array $users, $user) {
    if (is_array($user))
      return false;

    return array_merge($users, array($user));
  }

  public function remove(array $users, $user) {
    if (is_array($user))
      return false;

    $remove = false;
    foreach ($users as $key => $follow) {
      if ($follow == $user) {
        unset($users[$key]);
        $remove = true;
      }
    }

    if ($remove)
      return array_filter($users, 'strlen');

    return false;
  }

}
