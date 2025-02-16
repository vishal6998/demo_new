<?php

if ( ! function_exists( 'laurent_core_map_portfolio_settings_meta' ) ) {
	function laurent_core_map_portfolio_settings_meta() {
		$meta_box = laurent_elated_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'laurent-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		laurent_elated_create_meta_box_field( array(
			'name'        => 'eltdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'laurent-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'laurent-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'laurent-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'laurent-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'laurent-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'laurent-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'laurent-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'laurent-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'laurent-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'laurent-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'laurent-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'laurent-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'laurent-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'laurent-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'laurent-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'laurent-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => laurent_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'laurent-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'laurent-core' ),
				'default_value' => '',
				'options'       => laurent_elated_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'laurent-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'laurent-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => laurent_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'laurent-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'laurent-core' ),
				'default_value' => '',
				'options'       => laurent_elated_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'laurent-core' ),
				'parent'        => $meta_box,
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'laurent-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'laurent-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'laurent-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'laurent-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'laurent-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'laurent-core' ),
				'parent'      => $meta_box
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'laurent-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'laurent-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'laurent-core' ),
					'small'              => esc_html__( 'Small', 'laurent-core' ),
					'large-width'        => esc_html__( 'Large Width', 'laurent-core' ),
					'large-height'       => esc_html__( 'Large Height', 'laurent-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'laurent-core' )
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'laurent-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'laurent-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'laurent-core' ),
					'large-width' => esc_html__( 'Large Width', 'laurent-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'laurent-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'laurent-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_core_map_portfolio_settings_meta', 41 );
}