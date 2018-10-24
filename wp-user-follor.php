<?php
/**
 * Plugin Name:     Wp User Follor
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     wp-user-follor
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wp_User_Follor
 */

/*
  |--------------------------------------------------------------------------
  | CONSTANTS
  |--------------------------------------------------------------------------
 */

if (!defined('WUF_FOLLOW_DIR'))
  define('WUF_FOLLOW_DIR', dirname(__FILE__));

if (!defined('WUF_FOLLOW_URL'))
  define('WUF_FOLLOW_URL', plugin_dir_url(__FILE__));


/*
  |--------------------------------------------------------------------------
  | INTERNATIONALIZATION
  |--------------------------------------------------------------------------
 */

add_action('init', function(){
  load_plugin_textdomain('wuf', false, dirname(plugin_basename(__FILE__)) . '/languages/');
});


/*
  |--------------------------------------------------------------------------
  | FILE INCLUDES
  |--------------------------------------------------------------------------
 */

include_once( UF_FOLLOW_DIR . '/includes/class-user-follor.php' );
include_once( UF_FOLLOW_DIR . '/includes/actions.php' );
include_once( UF_FOLLOW_DIR . '/includes/scripts.php' );
include_once( UF_FOLLOW_DIR . '/includes/shortcodes.php' );
include_once( UF_FOLLOW_DIR . '/includes/display-functions.php' );
