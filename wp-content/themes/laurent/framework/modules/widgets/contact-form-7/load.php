<?php

if ( laurent_elated_is_plugin_installed( 'contact-form-7' ) ) {
	include_once LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_cf7_widget' );
}

if ( ! function_exists( 'laurent_elated_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function laurent_elated_register_cf7_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassContactForm7Widget';
		
		return $widgets;
	}
}