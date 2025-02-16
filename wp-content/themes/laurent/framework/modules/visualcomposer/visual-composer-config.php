<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = LAURENT_ELATED_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'laurent_elated_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function laurent_elated_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'laurent_elated_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'laurent_elated_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function laurent_elated_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Elated Row Content Width', 'laurent' ),
				'value'      => array(
					esc_html__( 'Full Width', 'laurent' ) => 'full-width',
					esc_html__( 'In Grid', 'laurent' )    => 'grid'
				),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Elated Anchor ID', 'laurent' ),
				'description' => esc_html__( 'For example "home"', 'laurent' ),
				'group'       => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Elated Background Color', 'laurent' ),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Elated Background Image', 'laurent' ),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Elated Background Position', 'laurent' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'laurent' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Elated Disable Background Image', 'laurent' ),
				'value'       => array(
					esc_html__( 'Never', 'laurent' )        => '',
					esc_html__( 'Below 1280px', 'laurent' ) => '1280',
					esc_html__( 'Below 1024px', 'laurent' ) => '1024',
					esc_html__( 'Below 768px', 'laurent' )  => '768',
					esc_html__( 'Below 680px', 'laurent' )  => '680',
					esc_html__( 'Below 480px', 'laurent' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'laurent' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Elated Parallax Background Image', 'laurent' ),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Elated Parallax Speed', 'laurent' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'laurent' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Elated Parallax Section Height (px)', 'laurent' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);

        vc_add_param( 'vc_row',
            array(
                'type'        => 'textarea_raw_html',
                'param_name'  => 'pattern_svg_path',
                'heading'     => esc_html__( 'Pattern SVG Path', 'laurent' ),
                'description' => esc_html__( 'Add your SVG path to appear as pattern on the row. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent' ),
                'save_always' => true,
                'group'       => esc_html__( 'Elated Settings', 'laurent' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'dropdown',
                'param_name' => 'pattern_svg_position',
                'heading'    => esc_html__( 'Pattern SVG Position', 'laurent' ),
                'value'      => array(
                    esc_html__( 'Left', 'laurent' )  => 'left',
                    esc_html__( 'Right', 'laurent' ) => 'right'
                ),
                'dependency' => array( 'element' => 'pattern_svg_path', 'not_empty' => true ),
                'group'      => esc_html__( 'Elated Settings', 'laurent' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'pattern_svg_hr_offset',
                'heading'    => esc_html__( 'Pattern SVG Horizontal Offset (px or %)', 'laurent' ),
                'dependency' => array( 'element' => 'pattern_svg_path', 'not_empty' => true ),
                'group'      => esc_html__( 'Elated Settings', 'laurent' )
            )
        );

        vc_add_param( 'vc_row',
            array(
                'type'       => 'textfield',
                'param_name' => 'pattern_svg_vr_offset',
                'heading'    => esc_html__( 'Pattern SVG Vertical Offset (px or %)', 'laurent' ),
                'dependency' => array( 'element' => 'pattern_svg_path', 'not_empty' => true ),
                'group'      => esc_html__( 'Elated Settings', 'laurent' )
            )
        );
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Elated Content Aligment', 'laurent' ),
				'value'      => array(
					esc_html__( 'Default', 'laurent' ) => '',
					esc_html__( 'Left', 'laurent' )    => 'left',
					esc_html__( 'Center', 'laurent' )  => 'center',
					esc_html__( 'Right', 'laurent' )   => 'right'
				),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);

		do_action( 'laurent_elated_action_additional_vc_row_params' );
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Elated Row Content Width', 'laurent' ),
				'value'      => array(
					esc_html__( 'Full Width', 'laurent' ) => 'full-width',
					esc_html__( 'In Grid', 'laurent' )    => 'grid'
				),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Elated Background Color', 'laurent' ),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Elated Background Image', 'laurent' ),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Elated Background Position', 'laurent' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'laurent' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Elated Disable Background Image', 'laurent' ),
				'value'       => array(
					esc_html__( 'Never', 'laurent' )        => '',
					esc_html__( 'Below 1280px', 'laurent' ) => '1280',
					esc_html__( 'Below 1024px', 'laurent' ) => '1024',
					esc_html__( 'Below 768px', 'laurent' )  => '768',
					esc_html__( 'Below 680px', 'laurent' )  => '680',
					esc_html__( 'Below 480px', 'laurent' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'laurent' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Elated Content Aligment', 'laurent' ),
				'value'      => array(
					esc_html__( 'Default', 'laurent' ) => '',
					esc_html__( 'Left', 'laurent' )    => 'left',
					esc_html__( 'Center', 'laurent' )  => 'center',
					esc_html__( 'Right', 'laurent' )   => 'right'
				),
				'group'      => esc_html__( 'Elated Settings', 'laurent' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( laurent_elated_is_plugin_installed( 'revolution-slider' ) ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Elated Enable Passepartout', 'laurent' ),
					'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Elated Settings', 'laurent' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Elated Passepartout Size', 'laurent' ),
					'value'       => array(
						esc_html__( 'Tiny', 'laurent' )   => 'tiny',
						esc_html__( 'Small', 'laurent' )  => 'small',
						esc_html__( 'Normal', 'laurent' ) => 'normal',
						esc_html__( 'Large', 'laurent' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Elated Settings', 'laurent' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Elated Disable Side Passepartout', 'laurent' ),
					'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Elated Settings', 'laurent' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Elated Disable Top Passepartout', 'laurent' ),
					'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Elated Settings', 'laurent' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'laurent_elated_vc_row_map' );
}