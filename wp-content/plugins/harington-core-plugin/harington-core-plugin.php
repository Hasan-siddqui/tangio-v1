<?php
/*
Plugin Name: Harington Core Plugin
Plugin URI: https://clapat.com/
Description: Shortcodes and Custom Post Types for Harington WordPress Theme
Version: 1.1
Author: ClaPat
Author URI: https://clapat.com/
*/

if( !defined('HARINGTON_SHORTCODES_DIR_URL') ) define('HARINGTON_SHORTCODES_DIR_URL', plugin_dir_url(__FILE__));
if( !defined('HARINGTON_SHORTCODES_DIR') ) define('HARINGTON_SHORTCODES_DIR', plugin_dir_path(__FILE__));

// metaboxes
require_once( HARINGTON_SHORTCODES_DIR . '/metaboxes/init.php' );

// load plugin's text domain
add_action( 'plugins_loaded', 'harington_shortcodes_load_textdomain' );
function harington_shortcodes_load_textdomain() {
	load_plugin_textdomain( 'harington_core_plugin_text_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/include/langs' );
}

// custom post types
require_once( HARINGTON_SHORTCODES_DIR . '/include/custom-post-types-config.php' );

// Harington shortcodes
require_once( HARINGTON_SHORTCODES_DIR . '/include/shortcodes.php' );

?>
