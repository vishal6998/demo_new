<?php

if ( ! function_exists( 'laurent_elated_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function laurent_elated_register_author_info_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_author_info_widget' );
}