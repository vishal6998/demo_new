<?php

if ( ! function_exists( 'laurent_elated_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function laurent_elated_register_separator_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_separator_widget' );
}