<?php

if ( ! function_exists( 'laurent_elated_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function laurent_elated_general_options_map() {
		
		laurent_elated_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'laurent' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = laurent_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'laurent' )
			)
		);

    laurent_elated_add_admin_field(
			array(
				'name'          => 'enable_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Google Fonts', 'laurent' ),
				'parent'        => $panel_design_style
			)
		);

		$google_fonts_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'google_fonts_container',
				'dependency' => array(
					'hide' => array(
						'enable_google_fonts'  => 'no'
					)
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'laurent' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'laurent' ),
				'parent'        => $google_fonts_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'laurent' ),
				'parent'        => $google_fonts_container
			)
		);
		
		$additional_google_fonts_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $google_fonts_container,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'laurent' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'laurent' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'laurent' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'laurent' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'laurent' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'laurent' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'laurent' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'laurent' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'laurent' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'laurent' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'laurent' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'laurent' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'laurent' ),
					'100i' => esc_html__( '100 Thin Italic', 'laurent' ),
					'200'  => esc_html__( '200 Extra-Light', 'laurent' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'laurent' ),
					'300'  => esc_html__( '300 Light', 'laurent' ),
					'300i' => esc_html__( '300 Light Italic', 'laurent' ),
					'400'  => esc_html__( '400 Regular', 'laurent' ),
					'400i' => esc_html__( '400 Regular Italic', 'laurent' ),
					'500'  => esc_html__( '500 Medium', 'laurent' ),
					'500i' => esc_html__( '500 Medium Italic', 'laurent' ),
					'600'  => esc_html__( '600 Semi-Bold', 'laurent' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'laurent' ),
					'700'  => esc_html__( '700 Bold', 'laurent' ),
					'700i' => esc_html__( '700 Bold Italic', 'laurent' ),
					'800'  => esc_html__( '800 Extra-Bold', 'laurent' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'laurent' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'laurent' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'laurent' )
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'laurent' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'laurent' ),
				'parent'        => $google_fonts_container,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'laurent' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'laurent' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'laurent' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'laurent' ),
					'greek'        => esc_html__( 'Greek', 'laurent' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'laurent' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'laurent' )
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'laurent' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'laurent' ),
				'parent'      => $panel_design_style
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'laurent' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'laurent' ),
				'parent'      => $panel_design_style
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'laurent' ),
				'description' => esc_html__( 'Choose the background image for page content', 'laurent' ),
				'parent'      => $panel_design_style
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'laurent' ),
				'parent'        => $panel_design_style
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'laurent' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'laurent' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'laurent' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = laurent_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				laurent_elated_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'laurent' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'laurent' ),
						'parent'      => $boxed_container
					)
				);
				
				laurent_elated_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'laurent' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'laurent' ),
						'parent'      => $boxed_container
					)
				);
				
				laurent_elated_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'laurent' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'laurent' ),
						'parent'      => $boxed_container
					)
				);
				
				laurent_elated_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'laurent' ),
						'description'   => esc_html__( 'Choose background image attachment', 'laurent' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'laurent' ),
							'fixed'  => esc_html__( 'Fixed', 'laurent' ),
							'scroll' => esc_html__( 'Scroll', 'laurent' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'laurent' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = laurent_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				laurent_elated_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'laurent' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'laurent' ),
						'parent'      => $paspartu_container
					)
				);
				
				laurent_elated_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'laurent' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'laurent' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				laurent_elated_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'laurent' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'laurent' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				laurent_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'laurent' )
					)
				);
		
				laurent_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'laurent' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'laurent' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'laurent' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'laurent' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'eltdf-grid-1300' => esc_html__( '1300px - default ', 'laurent' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'laurent' ),
                    'eltdf-grid-1100' => esc_html__( '1100px', 'laurent' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'laurent' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'laurent' )
				)
			)
		);

        laurent_elated_add_admin_field(
            array(
                'name'          => 'content_grid_lines',
                'type'          => 'select',
                'default_value' => 'none',
                'label'         => esc_html__('Grid Lines in Page Background', 'laurent'),
                'description'   => esc_html__('If you would like to enable a set of lines in the page background, choose how many lines to display. The lines will be placed on the page grid.', 'laurent'),
                'parent'        => $panel_design_style,
                'options'       => array(
                    "none" => esc_html__("None", 'laurent'),
                    "4" => "3 lines",
                    "5" => "4 lines",
                    "6" => "5 lines"
                ),
            )
        );

        laurent_elated_add_admin_field(
            array(
                'name'          => 'content_grid_lines_color',
                'type'          => 'color',
                'label'         => esc_html__('Grid Lines Color', 'laurent'),
                'parent'        => $panel_design_style,
            )
        );

        laurent_elated_add_admin_field(
            array(
                'name'          => 'content_two_grid_lines',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Grid Lines on Page Sides', 'laurent'),
                'description'   => esc_html__('If enabled, two lines will be placed near left and right edges of screen.', 'laurent'),
                'parent'        => $panel_design_style,
            )
        );

        laurent_elated_add_admin_field(
            array(
                'name'          => 'content_two_grid_lines_color',
                'type'          => 'color',
                'label'         => esc_html__('Grid Lines on Page Sides Color', 'laurent'),
                'parent'        => $panel_design_style,
            )
        );
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'laurent' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'laurent' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = laurent_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'laurent' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'laurent' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'laurent' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = laurent_elated_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				laurent_elated_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'laurent' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'laurent' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = laurent_elated_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					laurent_elated_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'laurent' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = laurent_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'laurent' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'laurent' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = laurent_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					laurent_elated_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'laurent' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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
					
					laurent_elated_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'laurent' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					laurent_elated_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'laurent' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'laurent' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'laurent' ),
				'parent'        => $panel_settings
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'laurent' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = laurent_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'laurent' )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'laurent' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'laurent' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = laurent_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'laurent' )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'laurent' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'laurent' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'laurent_elated_action_options_map', 'laurent_elated_general_options_map', laurent_elated_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'laurent_elated_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function laurent_elated_page_general_style( $style ) {
		$current_style = '';
		$page_id       = laurent_elated_get_page_id();
		$class_prefix  = laurent_elated_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = laurent_elated_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = laurent_elated_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = laurent_elated_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = laurent_elated_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.eltdf-boxed .eltdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= laurent_elated_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.eltdf-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled .eltdf-sticky-header',
			'.eltdf-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-sticky-header.header-appear',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = laurent_elated_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = laurent_elated_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( laurent_elated_string_ends_with( $paspartu_width, '%' ) || laurent_elated_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = laurent_elated_string_ends_with( $paspartu_width, '%' ) ? laurent_elated_filter_suffix( $paspartu_width, '%' ) : laurent_elated_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = laurent_elated_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.eltdf-paspartu-enabled .eltdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= laurent_elated_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= laurent_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= laurent_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = laurent_elated_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( laurent_elated_string_ends_with( $paspartu_responsive_width, '%' ) || laurent_elated_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = laurent_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? laurent_elated_filter_suffix( $paspartu_responsive_width, '%' ) : laurent_elated_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = laurent_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . laurent_elated_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . laurent_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . laurent_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}

		$grid_lines_style          = array();
        $grid_lines_on_sides_style = array();

        $grid_lines_selector          = array(
            '.eltdf-grid-lines-holder .eltdf-grid-line:not(:first-child)'
        );
        $grid_lines_on_sides_selector = array(
            '.eltdf-double-grid-line-one',
            '.eltdf-double-grid-line-two',
            '.eltdf-header-double-grid-line-one',
            '.eltdf-header-double-grid-line-two'
        );

        $grid_lines_color          = laurent_elated_get_meta_field_intersect( 'content_grid_lines_color', $page_id );
        $grid_lines_on_sides_color = laurent_elated_get_meta_field_intersect( 'content_two_grid_lines_color', $page_id );

        if ( ! empty( $grid_lines_color ) ) {
            $grid_lines_style['border-color'] = $grid_lines_color;
        }
        if ( ! empty( $grid_lines_on_sides_color ) ) {
            $grid_lines_on_sides_style['border-color'] = $grid_lines_on_sides_color;
        }

        if ( ! empty( $grid_lines_style ) ) {
            $current_style .= laurent_elated_dynamic_css( $grid_lines_selector, $grid_lines_style );
        }
        if ( ! empty( $grid_lines_on_sides_style ) ) {
            $current_style .= laurent_elated_dynamic_css( $grid_lines_on_sides_selector, $grid_lines_on_sides_style );
        }

		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'laurent_elated_filter_add_page_custom_style', 'laurent_elated_page_general_style' );
}