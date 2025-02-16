<?php

if ( ! function_exists( 'laurent_elated_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function laurent_elated_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_sidearea_opener_widget' );
}