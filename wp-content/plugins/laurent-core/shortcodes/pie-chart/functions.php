<?php

if ( ! function_exists( 'laurent_core_add_pie_chart_shortcodes' ) ) {
	function laurent_core_add_pie_chart_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\PieChart\PieChart'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_pie_chart_shortcodes' );
}

if ( ! function_exists( 'laurent_core_set_pie_chart_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for pie chart shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_pie_chart_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-pie-chart';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_pie_chart_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'laurent_core_register_pie_chart_scripts' ) ) {
    /**
     * Function that register scripts for pie chart shortcode
     */
    function laurent_core_register_pie_chart_scripts( ) {

        wp_register_script( 'counter', LAURENT_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/counter.js', array( 'jquery' ), false, true );
        wp_register_script( 'easypiechart', LAURENT_CORE_SHORTCODES_URL_PATH . '/pie-chart/assets/js/plugins/easypiechart.js', array( 'jquery' ), false, true );

    }

    add_action( 'laurent_elated_action_enqueue_third_party_scripts', 'laurent_core_register_pie_chart_scripts' );
}