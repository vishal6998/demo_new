<?php

if ( ! function_exists( 'laurent_elated_logo_meta_box_map' ) ) {
	function laurent_elated_logo_meta_box_map() {
		
		$logo_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'laurent_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'laurent' ),
				'name'  => 'logo_meta'
			)
		);

        laurent_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_logo_source_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Logo Source', 'laurent' ),
                'description'   => esc_html__( 'Select logo type', 'laurent' ),
                'options'       => array(
                    ''          => esc_html__( 'Default', 'laurent' ),
                    'image'     => esc_html__( 'Image', 'laurent' ),
                    'svg'       => esc_html__( 'SVG', 'laurent' ),
                ),
                'parent'        => $logo_meta_box
            )
        );

        $image_logo_container = laurent_elated_add_admin_container(
            array(
                'parent'          => $logo_meta_box,
                'name'            => 'image_logo_container',
                'dependency' => array(
                    'show' => array(
                        'eltdf_logo_source_meta'  => 'image'
                    )
                )
            )
        );

            laurent_elated_create_meta_box_field(
                array(
                    'name'        => 'eltdf_logo_image_meta',
                    'type'        => 'image',
                    'label'       => esc_html__( 'Logo Image - Default', 'laurent' ),
                    'description' => esc_html__( 'Choose a default logo image to display ', 'laurent' ),
                    'parent'      => $image_logo_container
                )
            );

            laurent_elated_create_meta_box_field(
                array(
                    'name'        => 'eltdf_logo_image_dark_meta',
                    'type'        => 'image',
                    'label'       => esc_html__( 'Logo Image - Dark', 'laurent' ),
                    'description' => esc_html__( 'Choose a default logo image to display ', 'laurent' ),
                    'parent'      => $image_logo_container
                )
            );

            laurent_elated_create_meta_box_field(
                array(
                    'name'        => 'eltdf_logo_image_light_meta',
                    'type'        => 'image',
                    'label'       => esc_html__( 'Logo Image - Light', 'laurent' ),
                    'description' => esc_html__( 'Choose a default logo image to display ', 'laurent' ),
                    'parent'      => $image_logo_container
                )
            );

            laurent_elated_create_meta_box_field(
                array(
                    'name'        => 'eltdf_logo_image_sticky_meta',
                    'type'        => 'image',
                    'label'       => esc_html__( 'Logo Image - Sticky', 'laurent' ),
                    'description' => esc_html__( 'Choose a default logo image to display ', 'laurent' ),
                    'parent'      => $image_logo_container
                )
            );

            laurent_elated_create_meta_box_field(
                array(
                    'name'        => 'eltdf_logo_image_mobile_meta',
                    'type'        => 'image',
                    'label'       => esc_html__( 'Logo Image - Mobile', 'laurent' ),
                    'description' => esc_html__( 'Choose a default logo image to display ', 'laurent' ),
                    'parent'      => $image_logo_container
                )
            );

        $svg_logo_container = laurent_elated_add_admin_container(
            array(
                'parent'          => $logo_meta_box,
                'name'            => 'svg_logo_container',
                'dependency' => array(
                    'show' => array(
                        'eltdf_logo_source_meta'  => 'svg'
                    )
                )
            )
        );

            laurent_elated_create_meta_box_field(
                array(
                    'name'          => 'eltdf_logo_svg_meta',
                    'type'          => 'textarea',
                    'default_value' => '',
                    'label'         => esc_html__( 'Logo SVG Path', 'laurent' ),
                    'description'   => esc_html__( 'Enter logo SVG path here. Please remove version and ID attributes from SVG path because of HTML validation', 'laurent' ),
                    'dependency' => array(
                        'show' => array(
                            'eltdf_logo_source_meta' => 'svg',
                        )
                    ),
                    'parent'        => $svg_logo_container
                )
            );
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_logo_meta_box_map', 47 );
}