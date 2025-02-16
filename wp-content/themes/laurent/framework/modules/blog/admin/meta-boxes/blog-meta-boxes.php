<?php

foreach ( glob( LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'laurent_elated_map_blog_meta' ) ) {
	function laurent_elated_map_blog_meta() {
		$eltdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$eltdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'laurent' ),
				'name'  => 'blog_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'laurent' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'laurent' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'laurent' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'laurent' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'laurent' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'laurent' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'laurent' ),
					'in-grid'    => esc_html__( 'In Grid', 'laurent' ),
					'full-width' => esc_html__( 'Full Width', 'laurent' )
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'laurent' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'laurent' ),
				'parent'      => $blog_meta_box,
				'options'     => laurent_elated_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'laurent' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'laurent' ),
				'options'     => laurent_elated_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'laurent' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'laurent' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'laurent' ),
					'fixed'    => esc_html__( 'Fixed', 'laurent' ),
					'original' => esc_html__( 'Original', 'laurent' )
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'laurent' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'laurent' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'laurent' ),
					'standard'        => esc_html__( 'Standard', 'laurent' ),
					'load-more'       => esc_html__( 'Load More', 'laurent' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'laurent' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'laurent' )
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'eltdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'laurent' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'laurent' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_blog_meta', 30 );
}