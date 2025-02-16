<?php

if ( ! function_exists( 'laurent_elated_disable_behaviors_for_header_bottom' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function laurent_elated_disable_behaviors_for_header_bottom( $allow_behavior ) {
		return false;
	}
	
	if ( laurent_elated_check_is_header_type_enabled( 'header-bottom', laurent_elated_get_page_id() ) ) {
		add_filter( 'laurent_elated_filter_allow_sticky_header_behavior', 'laurent_elated_disable_behaviors_for_header_bottom' );
		add_filter( 'laurent_elated_filter_allow_content_boxed_layout', 'laurent_elated_disable_behaviors_for_header_bottom' );

        remove_action('laurent_elated_action_after_wrapper_inner', 'laurent_elated_get_header');
        add_action('laurent_elated_action_before_main_content', 'laurent_elated_get_header');
	}
}