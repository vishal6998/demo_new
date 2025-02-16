<?php

if ( ! function_exists( 'laurent_elated_get_title_types_meta_boxes' ) ) {
	function laurent_elated_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'laurent_elated_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'laurent' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'laurent_elated_map_title_meta' ) ) {
	function laurent_elated_map_title_meta() {
		$title_type_meta_boxes = laurent_elated_get_title_types_meta_boxes();
		
		$title_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'laurent_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'laurent' ),
				'name'  => 'title_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'laurent' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'laurent' ),
				'parent'        => $title_meta_box,
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = laurent_elated_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'eltdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'eltdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'laurent' ),
						'description'   => esc_html__( 'Choose title type', 'laurent' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'laurent' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'laurent' ),
						'options'       => laurent_elated_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);

                laurent_elated_create_meta_box_field(
                    array(
                        'name'          => 'eltdf_title_area_grid_lines_meta',
                        'type'          => 'select',
                        'default_value' => '',
                        'label'         => esc_html__( 'Disable Grid Lines in Background', 'laurent' ),
                        'description'   => esc_html__( 'Set "Yes" to disable title area grid lines', 'laurent' ),
                        'options'       => laurent_elated_get_yes_no_select_array(),
                        'parent'        => $show_title_area_meta_container
                    )
                );
		
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'laurent' ),
						'description' => esc_html__( 'Set a height for Title Area', 'laurent' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);

				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_height_mobile_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height on Mobile', 'laurent' ),
						'description' => esc_html__( 'Set a height for Title Area on Mobile', 'laurent' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'laurent' ),
						'description' => esc_html__( 'Choose a background color for title area', 'laurent' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'laurent' ),
						'description' => esc_html__( 'Choose an Image for title area', 'laurent' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'laurent' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'laurent' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'laurent' ),
							'hide'                => esc_html__( 'Hide Image', 'laurent' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'laurent' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'laurent' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'laurent' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'laurent' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'laurent' )
						)
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'laurent' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'laurent' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'laurent' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'laurent' ),
							'window-top'    => esc_html__( 'From Window Top', 'laurent' )
						)
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'laurent' ),
						'options'       => laurent_elated_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'laurent' ),
						'description' => esc_html__( 'Choose a color for title text', 'laurent' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'laurent' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'laurent' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'laurent' ),
						'options'       => laurent_elated_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'laurent' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'laurent' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'laurent_elated_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_title_meta', 60 );
}