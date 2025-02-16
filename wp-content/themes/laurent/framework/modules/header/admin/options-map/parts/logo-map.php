<?php

if ( ! function_exists( 'laurent_elated_logo_options_map' ) ) {
	function laurent_elated_logo_options_map() {
		
		laurent_elated_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'laurent' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = laurent_elated_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'laurent' )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'laurent' )
			)
		);
		
		$hide_logo_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);

        laurent_elated_add_admin_field(
            array(
                'type'          => 'select',
                'default_value' => 'image',
                'name'          => 'logo_source',
                'label'         => esc_html__( 'Logo Source', 'laurent' ),
                'description'   => esc_html__( 'Select logo type', 'laurent' ),
                'options'       => array(
                    'image'     => esc_html__( 'Image', 'laurent' ),
                    'svg'       => esc_html__( 'SVG', 'laurent' ),
                ),
                'parent'        => $hide_logo_container
            )
        );
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => LAURENT_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'laurent' ),
                'dependency' => array(
                    'show' => array(
                        'logo_source' => 'image',
                    )
                ),
				'parent'        => $hide_logo_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => LAURENT_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'laurent' ),
                'dependency' => array(
                    'show' => array(
                        'logo_source' => 'image',
                    )
                ),
				'parent'        => $hide_logo_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => LAURENT_ELATED_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'laurent' ),
                'dependency' => array(
                    'show' => array(
                        'logo_source' => 'image',
                    )
                ),
				'parent'        => $hide_logo_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => LAURENT_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'laurent' ),
                'dependency' => array(
                    'show' => array(
                        'logo_source' => 'image',
                    )
                ),
				'parent'        => $hide_logo_container
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => LAURENT_ELATED_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'laurent' ),
                'dependency' => array(
                    'show' => array(
                        'logo_source' => 'image',
                    )
                ),
				'parent'        => $hide_logo_container
			)
		);

        laurent_elated_add_admin_field(
            array(
                'name'          => 'logo_svg',
                'type'          => 'textarea',
                'label'         => esc_html__( 'Logo SVG Path', 'laurent' ),
                'description'   => esc_html__( 'Enter logo SVG path here. Please remove version and ID attributes from SVG path because of HTML validation', 'laurent' ),
                'dependency' => array(
                    'show' => array(
                        'logo_source' => 'svg',
                    )
                ),
                'parent'        => $hide_logo_container
            )
        );
	}
	
	add_action( 'laurent_elated_action_options_map', 'laurent_elated_logo_options_map', laurent_elated_set_options_map_position( 'logo' ) );
}