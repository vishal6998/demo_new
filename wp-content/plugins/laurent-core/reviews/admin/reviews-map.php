<?php

if ( ! function_exists( 'laurent_core_reviews_map' ) ) {
	function laurent_core_reviews_map() {
		
		$reviews_panel = laurent_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'laurent-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'laurent-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'laurent-core' ),
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'laurent-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'laurent-core' ),
			)
		);
	}
	
	add_action( 'laurent_elated_action_additional_page_options_map', 'laurent_core_reviews_map', 75 ); //one after elements
}