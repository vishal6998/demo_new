<?php

if ( ! function_exists( 'laurent_elated_get_hide_dep_for_header_vertical_area_meta_boxes' ) ) {
	function laurent_elated_get_hide_dep_for_header_vertical_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'laurent_elated_filter_header_vertical_hide_meta_boxes', $hide_dep_options = array( '' => '' ) );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'laurent_elated_header_vertical_area_meta_options_map' ) ) {
	function laurent_elated_header_vertical_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = laurent_elated_get_hide_dep_for_header_vertical_area_meta_boxes();
		
		$header_vertical_area_meta_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta' => $hide_dep_options
					)
				)
			)
		);
		
		laurent_elated_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name'   => 'vertical_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'laurent' )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_vertical_header_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'laurent' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'laurent' ),
				'parent'      => $header_vertical_area_meta_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'laurent' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'laurent' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Background Image', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will hide background image in Vertical Menu', 'laurent' ),
				'parent'        => $header_vertical_area_meta_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_vertical_header_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Shadow', 'laurent' ),
				'description'   => esc_html__( 'Set shadow on vertical menu', 'laurent' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_vertical_header_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical Area Border', 'laurent' ),
				'description'   => esc_html__( 'Set border on vertical area', 'laurent' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		$vertical_header_border_container = laurent_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'vertical_header_border_container',
				'parent'          => $header_vertical_area_meta_container,
				'dependency' => array(
					'show' => array(
						'eltdf_vertical_header_border_meta'  => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_vertical_header_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'laurent' ),
				'description' => esc_html__( 'Choose color of border', 'laurent' ),
				'parent'      => $vertical_header_border_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_vertical_header_center_content_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Center Content', 'laurent' ),
				'description'   => esc_html__( 'Set content in vertical center', 'laurent' ),
				'parent'        => $header_vertical_area_meta_container,
				'default_value' => '',
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
	}
	
	add_action( 'laurent_elated_action_additional_header_area_meta_boxes_map', 'laurent_elated_header_vertical_area_meta_options_map' );
}