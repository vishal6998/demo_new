<?php

/*** Post Settings ***/

if ( ! function_exists( 'laurent_elated_map_post_meta' ) ) {
	function laurent_elated_map_post_meta() {
		
		$post_meta_box = laurent_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'laurent' ),
				'name'  => 'post-meta'
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'laurent' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'laurent' ),
				'parent'        => $post_meta_box,
				'options'       => laurent_elated_get_yes_no_select_array()
			)
		);
		
		laurent_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'laurent' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'laurent' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => laurent_elated_get_custom_sidebars_options( true )
			)
		);
		
		$laurent_custom_sidebars = laurent_elated_get_custom_sidebars();
		if ( count( $laurent_custom_sidebars ) > 0 ) {
			laurent_elated_create_meta_box_field( array(
				'name'        => 'eltdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'laurent' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'laurent' ),
				'parent'      => $post_meta_box,
				'options'     => laurent_elated_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		laurent_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'laurent' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'laurent' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('laurent_elated_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'laurent_elated_action_meta_boxes_map', 'laurent_elated_map_post_meta', 20 );
}
