<?php

if ( ! function_exists( 'laurent_elated_map_post_video_meta' ) ) {
	function laurent_elated_map_post_video_meta() {
		$video_post_format_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'laurent' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'laurent' ),
				'description'   => esc_html__( 'Choose video type', 'laurent' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'laurent' ),
					'self'            => esc_html__( 'Self Hosted', 'laurent' )
				)
			)
		);
		
		$eltdf_video_embedded_container = laurent_elated_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'eltdf_video_embedded_container'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'laurent' ),
				'description' => esc_html__( 'Enter Video URL', 'laurent' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'laurent' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'laurent' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'laurent' ),
				'description' => esc_html__( 'Enter video image', 'laurent' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_post_video_meta', 22 );
}