<?php

if ( ! function_exists( 'laurent_elated_map_post_quote_meta' ) ) {
	function laurent_elated_map_post_quote_meta() {
		$quote_post_format_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'laurent' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'laurent' ),
				'description' => esc_html__( 'Enter Quote text', 'laurent' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'laurent' ),
				'description' => esc_html__( 'Enter Quote author', 'laurent' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_post_quote_meta', 25 );
}