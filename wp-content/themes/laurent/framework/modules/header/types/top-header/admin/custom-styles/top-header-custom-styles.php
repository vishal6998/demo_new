<?php

if ( ! function_exists( 'laurent_elated_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function laurent_elated_header_top_bar_styles() {
		$top_header_height = laurent_elated_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo laurent_elated_dynamic_css( '.eltdf-top-bar', array( 'height' => laurent_elated_filter_px( $top_header_height ) . 'px' ) );
			echo laurent_elated_dynamic_css( '.eltdf-top-bar .eltdf-logo-wrapper a', array( 'max-height' => laurent_elated_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo laurent_elated_dynamic_css( '.eltdf-header-box .eltdf-top-bar-background', array( 'height' => laurent_elated_get_top_bar_background_height() . 'px' ) );
		
		$top_bar_container_selector = '.eltdf-top-bar > .eltdf-vertical-align-containers';
		$top_bar_container_styles   = array();
		$container_side_padding     = laurent_elated_options()->getOptionValue( 'top_bar_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( laurent_elated_string_ends_with( $container_side_padding, 'px' ) || laurent_elated_string_ends_with( $container_side_padding, '%' ) ) {
				$top_bar_container_styles['padding-left'] = $container_side_padding;
				$top_bar_container_styles['padding-right'] = $container_side_padding;
			} else {
				$top_bar_container_styles['padding-left'] = laurent_elated_filter_px( $container_side_padding ) . 'px';
				$top_bar_container_styles['padding-right'] = laurent_elated_filter_px( $container_side_padding ) . 'px';
			}
			
			echo laurent_elated_dynamic_css( $top_bar_container_selector, $top_bar_container_styles );
		}
		
		if ( laurent_elated_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.eltdf-top-bar .eltdf-grid .eltdf-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = laurent_elated_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = laurent_elated_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = laurent_elated_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo laurent_elated_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = laurent_elated_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = laurent_elated_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( laurent_elated_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = laurent_elated_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = laurent_elated_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo laurent_elated_dynamic_css( '.eltdf-header-box .eltdf-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( laurent_elated_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo laurent_elated_dynamic_css( '.eltdf-top-bar', $top_bar_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_header_top_bar_styles' );
}