<?php

if ( ! function_exists( 'laurent_core_add_custom_font' ) ) {
	function laurent_core_add_custom_font( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\CustomFont\CustomFont'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_custom_font' );
}

if ( ! function_exists( 'laurent_core_set_custom_font_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for counter shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_custom_font_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-custom-font';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_custom_font_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'laurent_core_register_custom_font_scripts' ) ) {
    /**
     * Function that register scripts for countdown shortcode
     */
    function laurent_core_register_custom_font_scripts( ) {

        wp_register_script(  'typed', LAURENT_CORE_SHORTCODES_URL_PATH . '/custom-font/assets/js/plugins/typed.js', array( 'jquery' ), false, true );

    }

    add_action( 'laurent_elated_action_enqueue_third_party_scripts', 'laurent_core_register_custom_font_scripts' );
}