<?php

if ( ! function_exists( 'laurent_elated_get_button_html' ) ) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function laurent_elated_get_button_html( $params ) {
		$button_html = laurent_elated_execute_shortcode( 'eltdf_button', $params );
		$button_html = str_replace( "\n", '', $button_html );
		
		return $button_html;
	}
}

if ( ! function_exists( 'laurent_core_add_button_shortcodes' ) ) {
	function laurent_core_add_button_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\Button\Button'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_button_shortcodes' );
}

if ( ! function_exists( 'laurent_core_set_button_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for button shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_button_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-button';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_button_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'laurent_core_return_special_button_svg' ) ) {

    function laurent_core_return_special_button_svg($class) {

        $html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="' . $class . '" x="0px" y="0px" viewBox="0 0 37.813 43.125" enable-background="new 0 0 37.813 43.125" xml:space="preserve">
                    <polyline fill="none" stroke="#C6A270" stroke-miterlimit="10" points="0.713,0.363 18.911,21.607 0.795,42.766 "/>
                    <polyline fill="none" stroke="#C6A270" stroke-miterlimit="10" points="18.911,0.363 0.714,21.607 18.829,42.766 "/>
                    <polyline fill="none" stroke="#C6A270" stroke-miterlimit="10" points="18.911,0.363 37.108,21.607 18.993,42.766 "/>
                    <polyline fill="none" stroke="#C6A270" stroke-miterlimit="10" points="37.108,0.363 18.911,21.607 37.026,42.766 "/>
                </svg>';

        return $html;
    }
}