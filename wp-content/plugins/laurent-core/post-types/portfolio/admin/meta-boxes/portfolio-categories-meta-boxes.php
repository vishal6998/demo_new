<?php

if ( ! function_exists( 'laurent_elated_portfolio_category_additional_fields' ) ) {
	function laurent_elated_portfolio_category_additional_fields() {
		
		$fields = laurent_elated_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		laurent_elated_add_taxonomy_field(
			array(
				'name'   => 'eltdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'laurent-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'laurent_elated_action_custom_taxonomy_fields', 'laurent_elated_portfolio_category_additional_fields' );
}