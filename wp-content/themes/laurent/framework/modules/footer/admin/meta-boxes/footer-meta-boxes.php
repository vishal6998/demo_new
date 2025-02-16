<?php

if ( ! function_exists( 'laurent_elated_map_footer_meta' ) ) {
	function laurent_elated_map_footer_meta() {
		
		$footer_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'laurent_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'laurent' ),
				'name'  => 'footer_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer For This Page', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'laurent' ),
				'options'       => laurent_elated_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = laurent_elated_add_admin_container(
			array(
				'name'       => 'eltdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			laurent_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'laurent' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'laurent' ),
					'options'       => laurent_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			laurent_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'laurent' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'laurent' ),
					'options'       => laurent_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			laurent_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'laurent' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'laurent' ),
					'options'       => laurent_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_top_styles_group = laurent_elated_add_admin_group(
				array(
					'name'        => 'footer_top_styles_group',
					'title'       => esc_html__( 'Footer Top Styles', 'laurent' ),
					'description' => esc_html__( 'Define style for footer top area', 'laurent' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'eltdf_show_footer_top_meta' => 'no'
						)
					)
				)
			);
			
			$footer_top_styles_row_1 = laurent_elated_add_admin_row(
				array(
					'name'   => 'footer_top_styles_row_1',
					'parent' => $footer_top_styles_group
				)
			);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_top_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'laurent' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_top_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'laurent' ),
						'parent' => $footer_top_styles_row_1
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_top_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'laurent' ),
						'parent' => $footer_top_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
			
			laurent_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'laurent' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'laurent' ),
					'options'       => laurent_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			$footer_bottom_styles_group = laurent_elated_add_admin_group(
				array(
					'name'        => 'footer_bottom_styles_group',
					'title'       => esc_html__( 'Footer Bottom Styles', 'laurent' ),
					'description' => esc_html__( 'Define style for footer bottom area', 'laurent' ),
					'parent'      => $show_footer_meta_container,
					'dependency'  => array(
						'hide' => array(
							'eltdf_show_footer_bottom_meta' => 'no'
						)
					)
				)
			);
			
			$footer_bottom_styles_row_1 = laurent_elated_add_admin_row(
				array(
					'name'   => 'footer_bottom_styles_row_1',
					'parent' => $footer_bottom_styles_group
				)
			);
			
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_bottom_background_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Background Color', 'laurent' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_bottom_border_color_meta',
						'type'   => 'colorsimple',
						'label'  => esc_html__( 'Border Color', 'laurent' ),
						'parent' => $footer_bottom_styles_row_1
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_footer_bottom_border_width_meta',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Border Width', 'laurent' ),
						'parent' => $footer_bottom_styles_row_1,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_footer_meta', 70 );
}