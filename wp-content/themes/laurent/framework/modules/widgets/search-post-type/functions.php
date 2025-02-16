<?php

if ( ! function_exists( 'laurent_elated_register_search_post_type_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function laurent_elated_register_search_post_type_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassSearchPostType';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_search_post_type_widget' );
}

if ( ! function_exists( 'laurent_elated_search_post_types' ) ) {
	function laurent_elated_search_post_types() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			laurent_elated_ajax_status( 'error', esc_html__( 'All fields are empty', 'laurent' ) );
		} else {
			check_ajax_referer( 'eltdf_search_post_types_nonce', 'search_post_types_nonce' );
			
			$args = array(
				'post_type'      => sanitize_text_field( $_POST['postType'] ),
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'orderby'        => 'date',
				's'              => sanitize_text_field( $_POST['term'] ),
				'posts_per_page' => 5
			);
			
			$html  = '';
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				$html .= '<ul>';
					while ( $query->have_posts() ) {
						$query->the_post();
						$html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
					}
				$html              .= '</ul>';
				$json_data['html'] = $html;
				laurent_elated_ajax_status( 'success', '', $json_data );
			} else {
				$html              .= '<ul>';
					$html              .= '<li>' . esc_html__( 'No posts found.', 'laurent' ) . '</li>';
				$html              .= '</ul>';
				$json_data['html'] = $html;
				laurent_elated_ajax_status( 'success', '', $json_data );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_laurent_elated_search_post_types', 'laurent_elated_search_post_types' );
    add_action( 'wp_ajax_nopriv_laurent_elated_search_post_types', 'laurent_elated_search_post_types' );
}