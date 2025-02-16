<?php

if ( ! function_exists( 'laurent_elated_get_hide_dep_for_header_standard_options' ) ) {
	function laurent_elated_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'laurent_elated_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'laurent_elated_header_standard_map' ) ) {
	function laurent_elated_header_standard_map( $parent ) {
		$hide_dep_options = laurent_elated_get_hide_dep_for_header_standard_options();
		
		laurent_elated_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'center',
				'label'           => esc_html__( 'Choose Menu Area Position', 'laurent' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'laurent' ),
				'options'         => array(
					'left'   => esc_html__( 'Left', 'laurent' ),
					'center' => esc_html__( 'Center', 'laurent' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_additional_header_menu_area_options_map', 'laurent_elated_header_standard_map' );
}