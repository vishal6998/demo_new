<?php

if ( ! function_exists( 'laurent_elated_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function laurent_elated_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( laurent_elated_check_is_header_type_enabled( 'header-vertical', laurent_elated_get_page_id() ) ) {
		add_filter( 'laurent_elated_filter_allow_sticky_header_behavior', 'laurent_elated_disable_behaviors_for_header_vertical' );
		add_filter( 'laurent_elated_filter_allow_content_boxed_layout', 'laurent_elated_disable_behaviors_for_header_vertical' );
	}
}