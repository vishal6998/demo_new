<?php

if ( ! function_exists( 'laurent_elated_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function laurent_elated_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_sticky_sidebar_widget' );
}