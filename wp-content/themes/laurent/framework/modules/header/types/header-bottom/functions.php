<?php

if ( ! function_exists( 'laurent_elated_register_header_bottom_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function laurent_elated_register_header_bottom_type( $header_types ) {
		$header_type = array(
			'header-bottom' => 'LaurentElatedNamespace\Modules\Header\Types\HeaderBottom'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'laurent_elated_init_register_header_bottom_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function laurent_elated_init_register_header_bottom_type() {
		add_filter( 'laurent_elated_filter_register_header_type_class', 'laurent_elated_register_header_bottom_type' );
	}
	
	add_action( 'laurent_elated_action_before_header_function_init', 'laurent_elated_init_register_header_bottom_type' );
}