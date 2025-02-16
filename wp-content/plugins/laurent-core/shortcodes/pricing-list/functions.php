<?php

if ( ! function_exists( 'laurent_core_add_pricing_list_shortcodes' ) ) {
	function laurent_core_add_pricing_list_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\PricingList\PricingList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_pricing_list_shortcodes' );
}

if ( ! function_exists( 'laurent_core_set_pricing_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for pricing list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_pricing_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-pricing-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_pricing_list_icon_class_name_for_vc_shortcodes' );
}