<?php

if ( ! function_exists( 'laurent_elated_map_general_meta' ) ) {
	function laurent_elated_map_general_meta() {
		
		$general_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'laurent_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'laurent' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'laurent' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'laurent' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'laurent' ),
				'parent'        => $general_meta_box
			)
		);
		
		$eltdf_content_padding_group = laurent_elated_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'laurent' ),
				'description' => esc_html__( 'Define styles for Content area', 'laurent' ),
				'parent'      => $general_meta_box
			)
		);
		
			$eltdf_content_padding_row = laurent_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row',
					'parent' => $eltdf_content_padding_group
				)
			);
			
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'laurent' ),
						'parent'      => $eltdf_content_padding_row
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'laurent' ),
						'parent'        => $eltdf_content_padding_row
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'laurent' ),
						'options'       => laurent_elated_get_yes_no_select_array(),
						'parent'        => $eltdf_content_padding_row
					)
				);
		
			$eltdf_content_padding_row_1 = laurent_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row_1',
					'next'   => true,
					'parent' => $eltdf_content_padding_group
				)
			);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'laurent' ),
						'parent' => $eltdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'    => 'eltdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'laurent' ),
						'parent'  => $eltdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'laurent' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'laurent' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'laurent' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'laurent' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'laurent' ),
					'eltdf-grid-1100' => esc_html__( '1100px', 'laurent' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'laurent' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'laurent' )
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'laurent' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'laurent' ),
				'options'     => laurent_elated_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);

        laurent_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_content_grid_lines_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Lines in Page Background', 'laurent'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines to display. The lines will be placed on the page grid.', 'laurent'),
                'parent'        => $general_meta_box,
                'options'       => array(
                    "" => "",
                    "none" => esc_html__("None", 'laurent'),
                    "4" => "3 lines",
                    "5" => "4 lines",
                    "6" => "5 lines"
                ),
            )
        );

        laurent_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_content_grid_lines_color_meta',
                'type'          => 'color',
                'label'         => esc_html__('Grid Lines Color', 'laurent'),
                'parent'        => $general_meta_box
            )
        );

        laurent_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_content_two_grid_lines_meta',
                'type'          => 'select',
                'label'         => esc_html__('Grid Lines on Page Sides', 'laurent'),
                'description'   => esc_html__('If enabled, two lines will be placed near left and right edges of screen.', 'laurent'),
                'parent'        => $general_meta_box,
                'options'       => laurent_elated_get_yes_no_select_array()
            )
        );

        laurent_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_content_two_grid_lines_color_meta',
                'type'          => 'color',
                'label'         => esc_html__('Grid Lines on Page Sides Color', 'laurent'),
                'parent'        => $general_meta_box
            )
        );
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'    => 'eltdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'laurent' ),
				'parent'  => $general_meta_box,
				'options' => laurent_elated_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = laurent_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'laurent' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'laurent' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'laurent' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'laurent' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'laurent' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'laurent' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'laurent' ),
						'description'   => esc_html__( 'Choose background image attachment', 'laurent' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'laurent' ),
							'fixed'  => esc_html__( 'Fixed', 'laurent' ),
							'scroll' => esc_html__( 'Scroll', 'laurent' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'laurent' ),
				'parent'        => $general_meta_box,
				'options'       => laurent_elated_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = laurent_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'eltdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'laurent' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'laurent' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'laurent' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'laurent' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'laurent' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'laurent' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				laurent_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'laurent' ),
						'options'       => laurent_elated_get_yes_no_select_array(),
					)
				);
		
				laurent_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'laurent' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'laurent' ),
						'options'       => laurent_elated_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'laurent' ),
				'parent'        => $general_meta_box,
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = laurent_elated_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				laurent_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'laurent' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'laurent' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => laurent_elated_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = laurent_elated_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'eltdf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					laurent_elated_create_meta_box_field(
						array(
							'name'   => 'eltdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'laurent' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = laurent_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'laurent' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'laurent' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = laurent_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					laurent_elated_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'eltdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'laurent' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'laurent' ),
                                'laurent_spinner'       => esc_html__( 'Laurent Spinner', 'laurent' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'laurent' ),
								'pulse'                 => esc_html__( 'Pulse', 'laurent' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'laurent' ),
								'cube'                  => esc_html__( 'Cube', 'laurent' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'laurent' ),
								'stripes'               => esc_html__( 'Stripes', 'laurent' ),
								'wave'                  => esc_html__( 'Wave', 'laurent' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'laurent' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'laurent' ),
								'atom'                  => esc_html__( 'Atom', 'laurent' ),
								'clock'                 => esc_html__( 'Clock', 'laurent' ),
								'mitosis'               => esc_html__( 'Mitosis', 'laurent' ),
								'lines'                 => esc_html__( 'Lines', 'laurent' ),
								'fussion'               => esc_html__( 'Fussion', 'laurent' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'laurent' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'laurent' )
							)
						)
					);
					
					laurent_elated_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'eltdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'laurent' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					laurent_elated_create_meta_box_field(
						array(
							'name'        => 'eltdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'laurent' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'laurent' ),
							'options'     => laurent_elated_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'laurent' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'laurent' ),
				'parent'      => $general_meta_box,
				'options'     => laurent_elated_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_general_meta', 10 );
}

if ( ! function_exists( 'laurent_elated_container_background_style' ) ) {
	/**
	 * Function that return container style
	 *
	 * @param $style
	 *
	 * @return string
	 */
	function laurent_elated_container_background_style( $style ) {
		$page_id      = laurent_elated_get_page_id();
		$class_prefix = laurent_elated_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .eltdf-content'
		);
		
		$container_class        = array();
		$current_style = '';
		$page_background_color  = get_post_meta( $page_id, 'eltdf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'eltdf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'eltdf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}

		if(! empty( $container_class )) {
			$current_style = laurent_elated_dynamic_css( $container_selector, $container_class );
		}

		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'laurent_elated_filter_add_page_custom_style', 'laurent_elated_container_background_style' );
}