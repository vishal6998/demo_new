<?php

if ( ! function_exists( 'laurent_elated_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function laurent_elated_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'laurent' );
		
		return $type;
	}
	
	add_filter( 'laurent_elated_filter_title_type_global_option', 'laurent_elated_set_title_centered_type_for_options' );
	add_filter( 'laurent_elated_filter_title_type_meta_boxes', 'laurent_elated_set_title_centered_type_for_options' );
}

if ( ! function_exists( 'laurent_elated_set_title_centered_type_as_default_options' ) ) {
    /**
     * This function set default title type value for global title option map
     */
    function laurent_elated_set_title_centered_type_as_default_options( $type ) {
        $type = 'centered';

        return $type;
    }

    add_filter( 'laurent_elated_filter_default_title_type_global_option', 'laurent_elated_set_title_centered_type_as_default_options' );
}