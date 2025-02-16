<?php
if ( ! function_exists( 'laurent_elated_include_blog_shortcodes' ) ) {
	function laurent_elated_include_blog_shortcodes() {
		if( laurent_elated_is_theme_registered() ) {
			foreach ( glob( LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}

	if ( laurent_elated_is_plugin_installed( 'core' ) ) {
		add_action( 'laurent_core_action_include_shortcodes_file', 'laurent_elated_include_blog_shortcodes' );
	}
}

// Load woo elementor widgets
if ( ! function_exists( 'laurent_elated_include_blog_elementor_widgets_files' ) ) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function laurent_elated_include_blog_elementor_widgets_files() {
        if ( laurent_elated_is_plugin_installed('elementor') && laurent_elated_is_theme_registered() ) {
            foreach ( glob( LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/elementor-*.php' ) as $shortcode_load ) {
                include_once $shortcode_load;
            }
        }
    }

    add_action( 'elementor/widgets/widgets_registered', 'laurent_elated_include_blog_elementor_widgets_files' );
}