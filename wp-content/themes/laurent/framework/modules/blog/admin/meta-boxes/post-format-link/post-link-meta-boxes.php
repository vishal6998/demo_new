<?php

if ( ! function_exists( 'laurent_elated_map_post_link_meta' ) ) {
	function laurent_elated_map_post_link_meta() {
		$link_post_format_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'laurent' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'laurent' ),
				'description' => esc_html__( 'Enter link', 'laurent' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_post_link_meta', 24 );
}