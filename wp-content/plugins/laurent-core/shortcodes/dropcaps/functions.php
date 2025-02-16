<?php

if ( ! function_exists( 'laurent_core_add_dropcaps_shortcodes' ) ) {
	function laurent_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'LaurentCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'laurent_core_filter_add_vc_shortcode', 'laurent_core_add_dropcaps_shortcodes' );
}