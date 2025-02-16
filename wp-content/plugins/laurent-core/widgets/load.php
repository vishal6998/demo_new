<?php

if ( ! function_exists( 'laurent_core_load_widget_class' ) ) {
	/**
	 * Loades widget class file.
	 */
	function laurent_core_load_widget_class() {
		include_once 'widget-class.php';
	}
	
	add_action( 'laurent_elated_action_before_options_map', 'laurent_core_load_widget_class' );
}

if ( ! function_exists( 'laurent_core_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to laurent_elated_action_after_options_map action
	 */
	function laurent_core_load_widgets() {
		
		if ( laurent_core_theme_installed() ) {
			foreach ( glob( LAURENT_ELATED_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}
		}
		
		include_once 'widget-loader.php';
	}
	
	add_action( 'laurent_elated_action_before_options_map', 'laurent_core_load_widgets' );
}