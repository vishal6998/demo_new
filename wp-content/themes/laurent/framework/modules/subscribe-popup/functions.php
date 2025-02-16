<?php

if ( ! function_exists( 'laurent_elated_get_subscribe_popup' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function laurent_elated_get_subscribe_popup() {

		if ( laurent_elated_options()->getOptionValue( 'enable_subscribe_popup' ) === 'yes' && ( laurent_elated_options()->getOptionValue( 'subscribe_popup_contact_form' ) !== '' || laurent_elated_options()->getOptionValue( 'subscribe_popup_title' ) !== '' ) ) {
			laurent_elated_load_subscribe_popup_template();
		}
	}

	//Get subscribe popup HTML
	add_action( 'laurent_elated_action_before_page_header', 'laurent_elated_get_subscribe_popup' );
}

if ( ! function_exists( 'laurent_elated_load_subscribe_popup_template' ) ) {
	/**
	 * Loads HTML template with parameters
	 */
	function laurent_elated_load_subscribe_popup_template() {
		$parameters                       = array();
		$parameters['title']              = laurent_elated_options()->getOptionValue( 'subscribe_popup_title' );
		$parameters['subtitle']           = laurent_elated_options()->getOptionValue( 'subscribe_popup_subtitle' );
		$background_image_meta            = laurent_elated_options()->getOptionValue( 'subscribe_popup_background_image' );
		$parameters['background_styles']  = ! empty( $background_image_meta ) ? 'background-image: url(' . esc_url( $background_image_meta ) . ')' : '';
		$parameters['contact_form']       = laurent_elated_options()->getOptionValue( 'subscribe_popup_contact_form' );
		$parameters['contact_form_style'] = laurent_elated_options()->getOptionValue( 'subscribe_popup_contact_form_style' );
		$parameters['enable_prevent']     = laurent_elated_options()->getOptionValue( 'enable_subscribe_popup_prevent' );
		$parameters['prevent_behavior']   = laurent_elated_options()->getOptionValue( 'subscribe_popup_prevent_behavior' );

		$holder_classes   = array();
		$holder_classes[] = $parameters['enable_prevent'] === 'yes' ? 'eltdf-prevent-enable' : 'eltdf-prevent-disable';
		$holder_classes[] = ! empty( $parameters['prevent_behavior'] ) ? 'eltdf-sp-prevent-' . $parameters['prevent_behavior'] : 'eltdf-sp-prevent-session';
		$holder_classes[] = ! empty( $background_image_meta ) ? 'eltdf-sp-has-image' : '';

		$parameters['holder_classes'] = implode( ' ', $holder_classes );

		laurent_elated_get_module_template_part( 'templates/subscribe-popup', 'subscribe-popup', '', $parameters );
	}
}