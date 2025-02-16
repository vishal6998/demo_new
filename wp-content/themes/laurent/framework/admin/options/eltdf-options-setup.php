<?php

if ( ! function_exists( 'laurent_elated_admin_map_init' ) ) {
	function laurent_elated_admin_map_init() {
		do_action( 'laurent_elated_action_before_options_map' );
		
		foreach ( glob( LAURENT_ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'laurent_elated_action_options_map' );
		
		do_action( 'laurent_elated_action_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'laurent_elated_admin_map_init', 1 );
}