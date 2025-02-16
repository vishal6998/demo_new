<?php

if ( ! function_exists( 'laurent_elated_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function laurent_elated_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = laurent_elated_options()->getOptionValue( 'footer_top_background_color' );
		$border_color     = laurent_elated_options()->getOptionValue( 'footer_top_border_color' );
		$border_width     = laurent_elated_options()->getOptionValue( 'footer_top_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = laurent_elated_filter_px( $border_width ) . 'px';
		}
		
		echo laurent_elated_dynamic_css( '.eltdf-page-footer .eltdf-footer-top-holder', $item_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_footer_top_general_styles' );
}

if ( ! function_exists( 'laurent_elated_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function laurent_elated_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = laurent_elated_options()->getOptionValue( 'footer_bottom_background_color' );
		$border_color     = laurent_elated_options()->getOptionValue( 'footer_bottom_border_color' );
		$border_width     = laurent_elated_options()->getOptionValue( 'footer_bottom_border_width' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
			
			if ( $border_width === '' ) {
				$item_styles['border-width'] = '1px';
			}
		}
		
		if ( $border_width !== '' ) {
			$item_styles['border-width'] = laurent_elated_filter_px( $border_width ) . 'px';
		}
		
		echo laurent_elated_dynamic_css( '.eltdf-page-footer .eltdf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_footer_bottom_general_styles' );
}