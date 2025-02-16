<?php

if ( ! function_exists( 'laurent_core_add_portfolio_vertical_loop_shortcode' ) ) {
	function laurent_core_add_portfolio_vertical_loop_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\Portfolio\PortfolioVerticalLoop'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_portfolio_vertical_loop_shortcode' );
}

if ( ! function_exists( 'laurent_core_set_portfolio_vertical_loop_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio vertical loop shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_portfolio_vertical_loop_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-vertical-loop';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_portfolio_vertical_loop_icon_class_name_for_vc_shortcodes' );
}