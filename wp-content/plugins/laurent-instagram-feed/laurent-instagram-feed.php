<?php
/*
Plugin Name: Laurent Instagram Feed
Plugin URI: https://qodeinteractive.com
Description: Plugin that adds Instagram feed functionality to our theme
Author: Elated Themes
Author URI: https://qodeinteractive.com
Version: 2.0.3
*/
define('LAURENT_INSTAGRAM_FEED_VERSION', '2.0.3');
define('LAURENT_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('LAURENT_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'LAURENT_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'LAURENT_INSTAGRAM_ASSETS_PATH', LAURENT_INSTAGRAM_ABS_PATH . '/assets' );
define( 'LAURENT_INSTAGRAM_ASSETS_URL_PATH', LAURENT_INSTAGRAM_URL_PATH . 'assets' );
define( 'LAURENT_INSTAGRAM_SHORTCODES_PATH', LAURENT_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'LAURENT_INSTAGRAM_SHORTCODES_URL_PATH', LAURENT_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'laurent_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function laurent_instagram_theme_installed() {
        return defined( 'LAURENT_ELATED_ROOT' );
    }
}

if ( ! function_exists( 'laurent_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function laurent_instagram_feed_text_domain() {
		load_plugin_textdomain( 'laurent-instagram-feed', false, LAURENT_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'laurent_instagram_feed_text_domain' );
}
