<?php

if ( ! function_exists( 'laurent_elated_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function laurent_elated_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_recent_posts_widget' );
}