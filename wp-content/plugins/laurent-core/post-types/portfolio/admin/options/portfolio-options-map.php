<?php

if ( ! function_exists( 'laurent_elated_portfolio_options_map' ) ) {
	function laurent_elated_portfolio_options_map() {
		
		laurent_elated_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'laurent-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = laurent_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'laurent-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'laurent-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'laurent-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'laurent-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'laurent-core' ),
				'parent'        => $panel_archive,
				'options'       => laurent_elated_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'laurent-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'laurent-core' ),
				'default_value' => 'normal',
				'options'       => laurent_elated_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'laurent-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'laurent-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'laurent-core' ),
					'landscape' => esc_html__( 'Landscape', 'laurent-core' ),
					'portrait'  => esc_html__( 'Portrait', 'laurent-core' ),
					'square'    => esc_html__( 'Square', 'laurent-core' )
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'laurent-core' ),
				'default_value' => 'standard-overlay',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'laurent-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-overlay' => esc_html__( 'Standard - Shader', 'laurent-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'laurent-core' )
				)
			)
		);
		
		$panel = laurent_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'laurent-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'laurent-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'laurent-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'laurent-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'laurent-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => laurent_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'laurent-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'laurent-core' ),
				'default_value' => 'normal',
				'options'       => laurent_elated_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = laurent_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'laurent-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'laurent-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => laurent_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'laurent-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'laurent-core' ),
				'default_value' => 'normal',
				'options'       => laurent_elated_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		laurent_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'laurent-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'laurent-core' ),
					'yes' => esc_html__( 'Yes', 'laurent-core' ),
					'no'  => esc_html__( 'No', 'laurent-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'laurent-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = laurent_elated_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'laurent-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'laurent-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'laurent-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'laurent-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_options_map', 'laurent_elated_portfolio_options_map', laurent_elated_set_options_map_position( 'portfolio' ) );
}