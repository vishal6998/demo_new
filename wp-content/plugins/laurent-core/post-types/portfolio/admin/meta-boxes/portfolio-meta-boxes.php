<?php

if ( ! function_exists( 'laurent_core_map_portfolio_meta' ) ) {
	function laurent_core_map_portfolio_meta() {
		global $laurent_elated_global_Framework;
		
		$laurent_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$laurent_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$laurent_portfolio_images = new LaurentElatedClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'laurent-core' ), '', '', 'portfolio_images' );
		$laurent_elated_global_Framework->eltdMetaBoxes->addMetaBox( 'portfolio_images', $laurent_portfolio_images );
		
		$laurent_portfolio_image_gallery = new LaurentElatedClassMultipleImages( 'eltdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'laurent-core' ), esc_html__( 'Choose your portfolio images', 'laurent-core' ) );
		$laurent_portfolio_images->addChild( 'eltdf-portfolio-image-gallery', $laurent_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$laurent_portfolio_images_videos = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'laurent-core' ),
				'name'  => 'eltdf_portfolio_images_videos'
			)
		);
		laurent_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_single_upload',
				'parent'      => $laurent_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'laurent-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'laurent-core' ),
						'options' => array(
							'image' => esc_html__('Image','laurent-core'),
							'video' => esc_html__('Video','laurent-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'laurent-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'laurent-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'laurent-core'),
							'vimeo' => esc_html__('Vimeo', 'laurent-core'),
							'self' => esc_html__('Self Hosted', 'laurent-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'laurent-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'laurent-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'laurent-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$laurent_additional_sidebar_items = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'laurent-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		laurent_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_properties',
				'parent'      => $laurent_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'laurent-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'laurent-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'laurent-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'laurent-core' )
					)
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_core_map_portfolio_meta', 40 );
}