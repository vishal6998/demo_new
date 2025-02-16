<?php

if ( ! function_exists( 'laurent_elated_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function laurent_elated_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'laurent_elated_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'laurent_elated_header_standard_meta_map' ) ) {
	function laurent_elated_header_standard_meta_map( $parent ) {
		$hide_dep_options = laurent_elated_get_hide_dep_for_header_standard_meta_boxes();
		
		laurent_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'eltdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'laurent' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'laurent' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'laurent' ),
					'left'   => esc_html__( 'Left', 'laurent' ),
					'center' => esc_html__( 'Center', 'laurent' )
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_additional_header_area_meta_boxes_map', 'laurent_elated_header_standard_meta_map' );
}