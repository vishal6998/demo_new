<?php

if ( ! function_exists( 'laurent_elated_footer_options_map' ) ) {
	function laurent_elated_footer_options_map() {

		laurent_elated_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'laurent' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = laurent_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'laurent' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		laurent_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'laurent' ),
				'parent'        => $footer_panel
			)
		);

        laurent_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'laurent' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'laurent' ),
                'parent'        => $footer_panel
            )
        );

		laurent_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'laurent' ),
				'parent'        => $footer_panel
			)
		);
		
		$show_footer_top_container = laurent_elated_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		laurent_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '12',
				'label'         => esc_html__( 'Footer Top Columns', 'laurent' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'laurent' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		laurent_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'center',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'laurent' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'laurent' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'laurent' ),
					'left'   => esc_html__( 'Left', 'laurent' ),
					'center' => esc_html__( 'Center', 'laurent' ),
					'right'  => esc_html__( 'Right', 'laurent' )
				),
				'parent'        => $show_footer_top_container
			)
		);
		
		$footer_top_styles_group = laurent_elated_add_admin_group(
			array(
				'name'        => 'footer_top_styles_group',
				'title'       => esc_html__( 'Footer Top Styles', 'laurent' ),
				'description' => esc_html__( 'Define style for footer top area', 'laurent' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		$footer_top_styles_row_1 = laurent_elated_add_admin_row(
			array(
				'name'   => 'footer_top_styles_row_1',
				'parent' => $footer_top_styles_group
			)
		);
		
			laurent_elated_add_admin_field(
				array(
					'name'   => 'footer_top_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'laurent' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			laurent_elated_add_admin_field(
				array(
					'name'   => 'footer_top_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'laurent' ),
					'parent' => $footer_top_styles_row_1
				)
			);
			
			laurent_elated_add_admin_field(
				array(
					'name'   => 'footer_top_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'laurent' ),
					'parent' => $footer_top_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);

		laurent_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Footer Bottom', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'laurent' ),
				'parent'        => $footer_panel
			)
		);

		$show_footer_bottom_container = laurent_elated_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		laurent_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '12',
				'label'         => esc_html__( 'Footer Bottom Columns', 'laurent' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'laurent' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_group = laurent_elated_add_admin_group(
			array(
				'name'        => 'footer_bottom_styles_group',
				'title'       => esc_html__( 'Footer Bottom Styles', 'laurent' ),
				'description' => esc_html__( 'Define style for footer bottom area', 'laurent' ),
				'parent'      => $show_footer_bottom_container
			)
		);
		
		$footer_bottom_styles_row_1 = laurent_elated_add_admin_row(
			array(
				'name'   => 'footer_bottom_styles_row_1',
				'parent' => $footer_bottom_styles_group
			)
		);
		
			laurent_elated_add_admin_field(
				array(
					'name'   => 'footer_bottom_background_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Background Color', 'laurent' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			laurent_elated_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_color',
					'type'   => 'colorsimple',
					'label'  => esc_html__( 'Border Color', 'laurent' ),
					'parent' => $footer_bottom_styles_row_1
				)
			);
			
			laurent_elated_add_admin_field(
				array(
					'name'   => 'footer_bottom_border_width',
					'type'   => 'textsimple',
					'label'  => esc_html__( 'Border Width', 'laurent' ),
					'parent' => $footer_bottom_styles_row_1,
					'args'   => array(
						'suffix' => 'px'
					)
				)
			);
	}

	add_action( 'laurent_elated_action_options_map', 'laurent_elated_footer_options_map', laurent_elated_set_options_map_position( 'footer' ) );
}