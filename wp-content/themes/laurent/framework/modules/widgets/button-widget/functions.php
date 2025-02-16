<?php

if ( ! function_exists( 'laurent_elated_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function laurent_elated_register_button_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_button_widget' );
}