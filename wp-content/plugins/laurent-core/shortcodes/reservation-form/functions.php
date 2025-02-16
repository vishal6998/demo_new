<?php

if ( ! function_exists( 'laurent_core_enqueue_scripts_for_reservation_form_shortcodes' ) ) {
    /**
     * Function that includes all necessary 3rd party scripts for this shortcode
     */
    function laurent_core_enqueue_scripts_for_reservation_form_shortcodes() {
        wp_enqueue_script( 'jquery-ui-datepicker' );
    }

    add_action( 'laurent_elated_action_enqueue_third_party_scripts', 'laurent_core_enqueue_scripts_for_reservation_form_shortcodes' );
}

if ( ! function_exists( 'laurent_core_add_reservation_form_shortcodes' ) ) {
	function laurent_core_add_reservation_form_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\ReservationForm\ReservationForm'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}

    add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_reservation_form_shortcodes' );
}

if ( ! function_exists( 'laurent_core_set_reservation_form_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for reservation form shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function laurent_core_set_reservation_form_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-reservation-form';
		
		return $shortcodes_icon_class_array;
	}

    add_filter( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', 'laurent_core_set_reservation_form_icon_class_name_for_vc_shortcodes' );
}
if ( ! function_exists( 'laurent_core_register_reservation_form_scripts' ) ) {
	/**
	 * Function that register scripts for reservation form shortcode
	 */
	function laurent_core_register_reservation_form_scripts( ) {

		wp_register_script( 'select2', LAURENT_CORE_SHORTCODES_URL_PATH . '/reservation-form/assets/js/plugins/select2.min.js', array( 'jquery' ), false, true );

	}

	add_action( 'laurent_elated_action_enqueue_third_party_scripts', 'laurent_core_register_reservation_form_scripts' );
}