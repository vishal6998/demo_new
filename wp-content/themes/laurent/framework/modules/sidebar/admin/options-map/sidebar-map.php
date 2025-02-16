<?php

if ( ! function_exists( 'laurent_elated_sidebar_options_map' ) ) {
	function laurent_elated_sidebar_options_map() {
		
		laurent_elated_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'laurent' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = laurent_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'laurent' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		laurent_elated_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'laurent' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'laurent' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => laurent_elated_get_custom_sidebars_options()
		) );
		
		$laurent_custom_sidebars = laurent_elated_get_custom_sidebars();
		if ( count( $laurent_custom_sidebars ) > 0 ) {
			laurent_elated_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'laurent' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'laurent' ),
				'parent'      => $sidebar_panel,
				'options'     => $laurent_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'laurent_elated_action_options_map', 'laurent_elated_sidebar_options_map', laurent_elated_set_options_map_position( 'sidebar' ) );
}