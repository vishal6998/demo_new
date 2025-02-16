<?php

if ( ! function_exists( 'laurent_elated_map_sidebar_meta' ) ) {
	function laurent_elated_map_sidebar_meta() {
		$eltdf_sidebar_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'laurent_elated_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'laurent' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'laurent' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'laurent' ),
				'parent'      => $eltdf_sidebar_meta_box,
                'options'       => laurent_elated_get_custom_sidebars_options( true )
			)
		);
		
		$eltdf_custom_sidebars = laurent_elated_get_custom_sidebars();
		if ( count( $eltdf_custom_sidebars ) > 0 ) {
			laurent_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'laurent' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'laurent' ),
					'parent'      => $eltdf_sidebar_meta_box,
					'options'     => $eltdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_sidebar_meta', 31 );
}