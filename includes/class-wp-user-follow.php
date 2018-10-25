<?php

$WP_User_Follow = new WP_User_Follow();

class WP_User_Follow {

  const FOLLOWING_KEY = "_wuf_following";
  const FOLLOWERS_KEY = "_wuf_followers";
  const FOLLOWED_BY_COUNT_KEY = "_wuf_followed_by_count";
  
  private $User;
  private $Following;
  private $Followers;
  private $Count;
  
  public function __construct() {
    $this->User      = new WP_User_Follow_User();
    $this->Following = new WP_User_Follow_Following();
    $this->Followers = new WP_User_Follow_Followers();
    $this->Count     = new WP_User_Follow_Count();
  }

  public function follow($follow_user) {
    $following = $this->Following->get(get_current_user_id());
    $following = $this->User->add($following, $follow_user);

    $followers = $this->Followers->get($follow_user);
    $followers = $this->User->add($followers, get_current_user_id());

    if ($following && $followers) {
      $this->Following->update(get_current_user_id(), $following);
      $this->Followers->update($follow_user, $followers);
      
      $followers = $this->Followers->get($follow_user);
      $this->Count->update($follow_user, $followers);
      
      return true;
    }

    return false;
  }

  public function unfollow($unfollow_user) {
    $following = $this->Following->get(get_current_user_id());
    $following = $this->User->remove($following, $unfollow_user);

    $followers = $this->Followers->get($unfollow_user);
    $followers = $this->User->remove($followers, get_current_user_id());

    if ($following !== false && $followers !== false) {
      $this->Following->update(get_current_user_id(), $following);
      $this->Followers->update($unfollow_user, $followers);
      
      $followers = $this->Followers->get($unfollow_user);
      $this->Count->update($unfollow_user, $followers);
      
      return true;
    }

    return false;
  }

  public function is_following($followed_user) {
    $following = $this->Following->get(get_current_user_id());

    if (is_array($following) && in_array($followed_user, $following)) {
      return true;
    }

    return false;
  }
}
