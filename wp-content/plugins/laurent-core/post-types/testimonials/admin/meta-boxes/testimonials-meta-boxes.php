<?php

if ( ! function_exists( 'laurent_core_map_testimonials_meta' ) ) {
	function laurent_core_map_testimonials_meta() {
		$testimonial_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'laurent-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'laurent-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'laurent-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'laurent-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'laurent-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'laurent-core' ),
				'description' => esc_html__( 'Enter author name', 'laurent-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'laurent-core' ),
				'description' => esc_html__( 'Enter author job position', 'laurent-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_core_map_testimonials_meta', 95 );
}