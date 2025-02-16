<?php

if ( ! function_exists( 'laurent_core_add_counter_shortcodes' ) ) {
	function laurent_core_add_counter_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\Counter\Counter'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_counter_shortcodes' );
}

if ( ! function_exists( 'laurent_core_set_counter_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for counter shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_counter_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-counter';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_counter_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'laurent_core_register_counter_scripts' ) ) {
    /**
     * Function that register scripts for counter shortcode
     */
    function laurent_core_register_counter_scripts( ) {

        wp_register_script( 'counter', LAURENT_CORE_SHORTCODES_URL_PATH . '/counter/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
        wp_register_script( 'absoluteCounter', LAURENT_CORE_SHORTCODES_URL_PATH . '/counter/assets/js/plugins/absoluteCounter.min.js', array( 'jquery' ), false, true );

    }

    add_action( 'laurent_elated_action_enqueue_third_party_scripts', 'laurent_core_register_counter_scripts' );
}