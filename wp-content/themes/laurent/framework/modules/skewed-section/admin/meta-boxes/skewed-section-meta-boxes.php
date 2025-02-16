<?php

if ( ! function_exists( 'laurent_elated_skewed_section_title_meta' ) ) {
	function laurent_elated_skewed_section_title_meta( $show_title_area_container ) {
		
		laurent_elated_add_admin_section_title(
			array(
				'parent' => $show_title_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'laurent' )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_skewed_section_on_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'laurent' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Title Area', 'laurent' ),
				'options'       => laurent_elated_get_yes_no_select_array(),
				'parent'        => $show_title_area_container
			)
		);
		
		$show_skewed_section_title_area_container = laurent_elated_add_admin_container(
			array(
				'parent'     => $show_title_area_container,
				'name'       => 'show_skewed_section_title_area_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_skewed_section_on_title_area_meta' => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_title_area_skewed_section_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Position', 'laurent' ),
				'description'   => esc_html__( 'Specify skewed section position', 'laurent' ),
				'parent'        => $show_skewed_section_title_area_container,
				'options'       => array(
					''        => esc_html__( 'Default', 'laurent' ),
					'outline' => esc_html__( 'Outline', 'laurent' ),
					'inset'   => esc_html__( 'Inset', 'laurent' )
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'textarea',
				'name'        => 'eltdf_title_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Title Area SVG Path', 'laurent' ),
				'description' => esc_html__( 'Enter your Section On Title Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent' ),
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'color',
				'name'        => 'eltdf_title_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'laurent' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'laurent' ),
			)
		);
	}
	
	add_action( 'laurent_elated_action_additional_title_area_meta_boxes', 'laurent_elated_skewed_section_title_meta', 20 );
}

if ( ! function_exists( 'laurent_elated_skewed_section_header_meta' ) ) {
	function laurent_elated_skewed_section_header_meta( $show_header_area_container ) {
		
		laurent_elated_add_admin_section_title(
			array(
				'parent' => $show_header_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'laurent' )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_skewed_section_on_header_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'laurent' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Header Area', 'laurent' ),
				'options'       => laurent_elated_get_yes_no_select_array(),
				'parent'        => $show_header_area_container
			)
		);
		
		$show_skewed_section_header_area_container = laurent_elated_add_admin_container(
			array(
				'parent'     => $show_header_area_container,
				'name'       => 'show_skewed_section_header_area_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_skewed_section_on_header_area_meta' => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'textarea',
				'name'        => 'eltdf_header_area_skewed_section_svg_path_meta',
				'label'       => esc_html__( 'Skewed Section On Header Area SVG Path', 'laurent' ),
				'description' => esc_html__( 'Enter your Section On Header Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent' ),
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'color',
				'name'        => 'eltdf_header_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'laurent' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'laurent' ),
			)
		);
	}
	
	add_action( 'laurent_elated_action_additional_header_area_meta_boxes', 'laurent_elated_skewed_section_header_meta', 20 );
}