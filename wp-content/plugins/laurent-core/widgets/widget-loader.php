<?php

if ( ! function_exists( 'laurent_core_register_widgets' ) ) {
	function laurent_core_register_widgets() {
		$widgets = apply_filters( 'laurent_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'laurent_core_register_widgets' );
}