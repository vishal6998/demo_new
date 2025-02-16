<?php

if ( ! function_exists( 'laurent_elated_map_content_bottom_meta' ) ) {
	function laurent_elated_map_content_bottom_meta() {
		
		$content_bottom_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'laurent_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_bottom_meta' ),
				'title' => esc_html__( 'Content Bottom', 'laurent' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'laurent' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'laurent' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		$show_content_bottom_meta_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'eltdf_show_content_bottom_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_content_bottom_area_meta' => 'yes'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'laurent' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'laurent' ),
				'options'       => laurent_elated_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'laurent' ),
				'options'       => laurent_elated_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'eltdf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'laurent' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'laurent' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_content_bottom_meta', 71 );
}