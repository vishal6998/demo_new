<?php

if ( ! function_exists( 'laurent_elated_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function laurent_elated_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'LaurentElatedClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'laurent_core_filter_register_widgets', 'laurent_elated_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'laurent_elated_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function laurent_elated_get_dropdown_cart_icon_class() {
		$classes = array(
			'eltdf-header-cart'
		);
		
		$classes[] = laurent_elated_get_icon_sources_class( 'dropdown_cart', 'eltdf-header-cart' );
		
		return implode( ' ', $classes );
	}
}