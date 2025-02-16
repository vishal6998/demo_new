<?php

if ( ! function_exists( 'laurent_elated_map_woocommerce_meta' ) ) {
	function laurent_elated_map_woocommerce_meta() {
		
		$woocommerce_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'laurent' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'laurent' ),
				'description' => esc_html__( 'Choose image layout when it appears in Elated Product List - Masonry layout shortcode', 'laurent' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'laurent' ),
					'small'              => esc_html__( 'Small', 'laurent' ),
					'large-width'        => esc_html__( 'Large Width', 'laurent' ),
					'large-height'       => esc_html__( 'Large Height', 'laurent' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'laurent' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'laurent' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'laurent' ),
				'options'       => laurent_elated_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'laurent' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_woocommerce_meta', 99 );
}