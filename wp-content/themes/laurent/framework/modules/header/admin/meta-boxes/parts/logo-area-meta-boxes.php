<?php

if ( ! function_exists( 'laurent_elated_get_hide_dep_for_header_logo_area_meta_boxes' ) ) {
	function laurent_elated_get_hide_dep_for_header_logo_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'laurent_elated_filter_header_logo_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}


if ( ! function_exists( 'laurent_elated_header_logo_area_meta_options_map' ) ) {
	function laurent_elated_header_logo_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = laurent_elated_get_hide_dep_for_header_logo_area_meta_boxes();
		
		$logo_area_container = laurent_elated_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
				'parent'          => $header_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
		
		laurent_elated_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_area_style',
				'title'  => esc_html__( 'Logo Area Style', 'laurent' )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_logo_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area In Grid', 'laurent' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'laurent' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_container = laurent_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'eltdf_logo_area_in_grid_meta'  => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'laurent' ),
				'description' => esc_html__( 'Set grid background color for logo area', 'laurent' ),
				'parent'      => $logo_area_in_grid_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'laurent' ),
				'description' => esc_html__( 'Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'laurent' ),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_logo_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'laurent' ),
				'description'   => esc_html__( 'Set border on grid logo area', 'laurent' ),
				'parent'        => $logo_area_in_grid_container,
				'default_value' => '',
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		$logo_area_in_grid_border_container = laurent_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_in_grid_border_container',
				'parent'          => $logo_area_in_grid_container,
				'dependency' => array(
					'show' => array(
						'eltdf_logo_area_in_grid_border_meta'  => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'laurent' ),
				'description' => esc_html__( 'Set border color for grid area', 'laurent' ),
				'parent'      => $logo_area_in_grid_border_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'laurent' ),
				'description' => esc_html__( 'Choose a background color for logo area', 'laurent' ),
				'parent'      => $logo_area_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'laurent' ),
				'description' => esc_html__( 'Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'laurent' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_logo_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Logo Area Border', 'laurent' ),
				'description'   => esc_html__( 'Set border on logo area', 'laurent' ),
				'parent'        => $logo_area_container,
				'default_value' => '',
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		$logo_area_border_bottom_color_container = laurent_elated_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_border_bottom_color_container',
				'parent'          => $logo_area_container,
				'dependency' => array(
					'show' => array(
						'eltdf_logo_area_border_meta'  => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'laurent' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'laurent' ),
				'parent'      => $logo_area_border_bottom_color_container
			)
		);

		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_area_height_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Height', 'laurent' ),
				'description' => esc_html__( 'Enter logo area height (default is 110px)', 'laurent' ),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => esc_html__( 'px', 'laurent' )
				)
			)
		);
		
		do_action( 'laurent_elated_action_header_logo_area_additional_meta_boxes_map', $logo_area_container );
	}
	
	add_action( 'laurent_elated_action_header_logo_area_meta_boxes_map', 'laurent_elated_header_logo_area_meta_options_map', 10, 1 );
}