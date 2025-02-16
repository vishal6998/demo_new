<?php
/*
Plugin Name: Laurent Core
Plugin URI: https://qodeinteractive.com
Description: Plugin that adds all post types needed by our theme
Author: Elated Themes
Author URI: https://qodeinteractive.com
Version: 2.4.3
*/

require_once 'load.php';

add_action( 'after_setup_theme', array( LaurentCore\CPT\PostTypesRegister::getInstance(), 'register' ) );

if ( ! function_exists( 'laurent_core_activation' ) ) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines laurent_elated_action_core_on_activate action
	 */
	function laurent_core_activation() {
		do_action( 'laurent_elated_action_core_on_activate' );
		
		LaurentCore\CPT\PostTypesRegister::getInstance()->register();
		flush_rewrite_rules();
	}
	
	register_activation_hook( __FILE__, 'laurent_core_activation' );
}

if ( ! function_exists( 'laurent_core_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function laurent_core_text_domain() {
		load_plugin_textdomain( 'laurent-core', false, LAURENT_CORE_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'laurent_core_text_domain' );
}

if ( ! function_exists( 'laurent_core_version_class' ) ) {
	/**
	 * Adds plugins version class to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function laurent_core_version_class( $classes ) {
		$classes[] = 'laurent-core-' . LAURENT_CORE_VERSION;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'laurent_core_version_class' );
}

if ( ! function_exists( 'laurent_core_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function laurent_core_theme_installed() {
		return defined( 'LAURENT_ELATED_ROOT' );
	}
}

if ( ! function_exists( 'laurent_core_visual_composer_installed' ) ) {
	/**
	 * Function that checks if Visual Composer plugin installed
	 *
	 * @return bool
	 */
	function laurent_core_visual_composer_installed() {
		return class_exists( 'WPBakeryVisualComposerAbstract' );
	}
}

if ( ! function_exists( 'laurent_core_is_woocommerce_installed' ) ) {
	/**
	 * Function that checks if woocommerce is installed
	 *
	 * @return bool
	 */
	function laurent_core_is_woocommerce_installed() {
		return function_exists( 'is_woocommerce' );
	}
}

if ( ! function_exists( 'laurent_core_is_woocommerce_integration_installed' ) ) {
	//is Elated Woocommerce Integration installed?
	function laurent_core_is_woocommerce_integration_installed() {
		return defined( 'LAURENT_CHECKOUT_INTEGRATION' );
	}
}

if ( ! function_exists( 'laurent_core_is_instagram_plugin_installed' ) ) {
	//is Elated Instagram installed?
	function laurent_core_is_instagram_plugin_installed() {
		return defined( 'LAURENT_INSTAGRAM_FEED_VERSION' );
	}
}

if ( ! function_exists( 'laurent_core_is_revolution_slider_installed' ) ) {
	function laurent_core_is_revolution_slider_installed() {
		return class_exists( 'RevSliderFront' );
	}
}

if ( ! function_exists( 'laurent_core_is_wpml_installed' ) ) {
	/**
	 * Function that checks if WPML plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function laurent_core_is_wpml_installed() {
		return defined( 'ICL_SITEPRESS_VERSION' );
	}
}

if ( ! function_exists( 'laurent_core_theme_menu' ) ) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function laurent_core_theme_menu() {
		if ( laurent_core_theme_installed() && laurent_core_is_theme_registered() ) {
			
			global $laurent_elated_global_Framework;
			laurent_elated_init_theme_options();
			
			$page_hook_suffix = add_menu_page(
				esc_html__( 'Laurent Options', 'laurent-core' ),                                             // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Laurent Options', 'laurent-core' ),                                             // The text of the menu in the administrator's sidebar
				'administrator',                                                                               // What roles are able to access the menu
				LAURENT_ELATED_OPTIONS_SLUG,                                                                             // The ID used to bind submenu items to this menu
				array( $laurent_elated_global_Framework->getSkin(), 'renderOptions' ),                         // The callback function used to render this menu
				$laurent_elated_global_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
				4                                                                                            // Position
			);
			
			foreach ( $laurent_elated_global_Framework->eltdOptions->adminPages as $key => $value ) {
				$slug = ! empty( $value->slug ) ? '_tab' . $value->slug : '';
				
				$subpage_hook_suffix = add_submenu_page(
					LAURENT_ELATED_OPTIONS_SLUG,
					esc_html__( 'Laurent Options - ', 'laurent-core' ) . $value->title, // The value used to populate the browser's title bar when the menu page is active
					$value->title,                                                        // The text of the menu in the administrator's sidebar
					'administrator',                                                      // What roles are able to access the menu
					LAURENT_ELATED_OPTIONS_SLUG . $slug,                                            // The ID used to bind submenu items to this menu
					array( $laurent_elated_global_Framework->getSkin(), 'renderOptions' )
				);
				
				add_action( 'admin_print_scripts-' . $subpage_hook_suffix, 'laurent_elated_enqueue_admin_scripts' );
				add_action( 'admin_print_styles-' . $subpage_hook_suffix, 'laurent_elated_enqueue_admin_styles' );
			};
			
			add_action( 'admin_print_scripts-' . $page_hook_suffix, 'laurent_elated_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $page_hook_suffix, 'laurent_elated_enqueue_admin_styles' );
		}
	}
	
	add_action( 'admin_menu', 'laurent_core_theme_menu' );
}

if ( ! function_exists( 'laurent_core_theme_menu_backup_options' ) ) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function laurent_core_theme_menu_backup_options() {
		if ( laurent_core_theme_installed() ) {
			global $laurent_elated_global_Framework;
			
			$slug             = "_backup_options";
			$page_hook_suffix = add_submenu_page(
				LAURENT_ELATED_OPTIONS_SLUG,
				esc_html__( 'Laurent Options - Backup Options', 'laurent-core' ), // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Backup Options', 'laurent-core' ),                // The text of the menu in the administrator's sidebar
				'administrator',                                             // What roles are able to access the menu
				LAURENT_ELATED_OPTIONS_SLUG . $slug,                     // The ID used to bind submenu items to this menu
				array( $laurent_elated_global_Framework->getSkin(), 'renderBackupOptions' )
			);
			
			add_action( 'admin_print_scripts-' . $page_hook_suffix, 'laurent_elated_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $page_hook_suffix, 'laurent_elated_enqueue_admin_styles' );
		}
	}
	
	add_action( 'admin_menu', 'laurent_core_theme_menu_backup_options' );
}

if ( ! function_exists( 'laurent_core_theme_admin_bar_menu_options' ) ) {
	/**
	 * Add a link to the WP Toolbar
	 */
	function laurent_core_theme_admin_bar_menu_options( $wp_admin_bar ) {
		if ( laurent_core_theme_installed() && current_user_can( 'edit_theme_options' ) && laurent_core_is_theme_registered() ) {
			global $laurent_elated_global_Framework;
			
			$args = array(
				'id'    => 'laurent-admin-bar-options',
				'title' => sprintf( '<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html__( 'Laurent Options', 'laurent-core' ) ),
				'href'  => esc_url( admin_url( 'admin.php?page=' . LAURENT_ELATED_OPTIONS_SLUG ) )
			);
			
			$wp_admin_bar->add_node( $args );
			
			foreach ( $laurent_elated_global_Framework->eltdOptions->adminPages as $key => $value ) {
				$suffix = ! empty( $value->slug ) ? '_tab' . $value->slug : '';
				
				$args = array(
					'id'     => 'laurent-admin-bar-options-' . $suffix,
					'title'  => $value->title,
					'parent' => 'laurent-admin-bar-options',
					'href'   => esc_url( admin_url( 'admin.php?page=' . LAURENT_ELATED_OPTIONS_SLUG . $suffix ) )
				);
				
				$wp_admin_bar->add_node( $args );
			};
		}
	}
	
	add_action( 'admin_bar_menu', 'laurent_core_theme_admin_bar_menu_options', 999 );
}

if ( ! function_exists( 'laurent_core_enqueue_our_prettyphoto_scripts_for_theme' ) ) {
	/**
	 * Function that includes our prettyphoto script
	 */
	function laurent_core_enqueue_our_prettyphoto_scripts_for_theme() {
		
		if ( laurent_core_theme_installed() && laurent_core_visual_composer_installed() ) {
			wp_deregister_script( 'prettyphoto' );
			wp_enqueue_script( 'prettyphoto', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		}
	}
	
	add_action( 'laurent_elated_action_enqueue_third_party_scripts', 'laurent_core_enqueue_our_prettyphoto_scripts_for_theme' );
}

if( ! function_exists( 'laurent_core_is_theme_registered' ) ) {
	function laurent_core_is_theme_registered() {
		return class_exists('LaurentCoreDashboard') ? LaurentCoreDashboard::get_instance()->is_theme_registered() : true;
	}
}