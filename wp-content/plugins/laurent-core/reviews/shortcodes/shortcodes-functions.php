<?php

if ( ! function_exists( 'laurent_core_include_reviews_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function laurent_core_include_reviews_shortcodes_files() {
		if( laurent_core_is_theme_registered() ) {
			foreach ( glob( LAURENT_CORE_ABS_PATH . '/reviews/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action( 'laurent_core_action_include_shortcodes_file', 'laurent_core_include_reviews_shortcodes_files' );
}

if ( ! function_exists( 'laurent_core_include_reviews_elementor_widgets_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function laurent_core_include_reviews_elementor_widgets_files() {
		if ( laurent_core_theme_installed() && laurent_core_is_theme_registered() ) {
			foreach (glob(LAURENT_CORE_ABS_PATH . '/reviews/shortcodes/*/elementor-*.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}

	add_action( 'elementor/widgets/widgets_registered', 'laurent_core_include_reviews_elementor_widgets_files' );
}