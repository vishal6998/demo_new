<?php

if ( ! function_exists( 'laurent_core_testimonials_meta_box_functions' ) ) {
	function laurent_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'laurent_elated_filter_meta_box_post_types_save', 'laurent_core_testimonials_meta_box_functions' );
	add_filter( 'laurent_elated_filter_meta_box_post_types_remove', 'laurent_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'laurent_core_register_testimonials_cpt' ) ) {
	function laurent_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'LaurentCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'laurent_core_filter_register_custom_post_types', 'laurent_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if ( ! function_exists( 'laurent_core_include_testimonials_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function laurent_core_include_testimonials_shortcodes_files() {
		if( laurent_core_is_theme_registered() ) {
			foreach ( glob( LAURENT_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action( 'laurent_core_action_include_shortcodes_file', 'laurent_core_include_testimonials_shortcodes_files' );
}

// Load testimonials elementor widgets
if ( ! function_exists( 'laurent_core_include_testimonials_elementor_widgets_files' ) ) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function laurent_core_include_testimonials_elementor_widgets_files() {
        if ( laurent_core_theme_installed() && laurent_elated_is_plugin_installed('elementor') && laurent_core_is_theme_registered() ) {
            foreach (glob(LAURENT_CORE_CPT_PATH . '/testimonials/shortcodes/*/elementor-*.php') as $shortcode_load) {
                include_once $shortcode_load;
            }
        }
    }

    add_action( 'elementor/widgets/widgets_registered', 'laurent_core_include_testimonials_elementor_widgets_files' );
}