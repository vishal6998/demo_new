<?php

if ( ! function_exists( 'laurent_elated_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function laurent_elated_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'LaurentElatedNamespace\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'laurent_elated_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function laurent_elated_init_register_header_minimal_type() {
		add_filter( 'laurent_elated_filter_register_header_type_class', 'laurent_elated_register_header_minimal_type' );
	}
	
	add_action( 'laurent_elated_action_before_header_function_init', 'laurent_elated_init_register_header_minimal_type' );
}

if ( ! function_exists( 'laurent_elated_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function laurent_elated_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'laurent' );
		
		return $menus;
	}
	
	if ( laurent_elated_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'laurent_elated_filter_register_headers_menu', 'laurent_elated_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'laurent_elated_get_fullscreen_menu_icon_class' ) ) {
	/**
	 * Loads full screen menu icon class
	 */
	function laurent_elated_get_fullscreen_menu_icon_class() {
		$classes = array(
			'eltdf-fullscreen-menu-opener'
		);
		
		$classes[] = laurent_elated_get_icon_sources_class( 'fullscreen_menu', 'eltdf-fullscreen-menu-opener' );
		
		return $classes;
	}
}