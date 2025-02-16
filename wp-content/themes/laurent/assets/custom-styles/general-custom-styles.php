<?php

if ( ! function_exists( 'laurent_elated_design_styles' ) ) {
	/**
	 * Generates general custom styles
	 */
	function laurent_elated_design_styles() {
		$font_family = laurent_elated_options()->getOptionValue( 'google_fonts' );
		if ( ! empty( $font_family ) && laurent_elated_is_font_option_valid( $font_family ) ) {
			$font_family_selector = array(
				'body'
			);
			echo laurent_elated_dynamic_css( $font_family_selector, array( 'font-family' => laurent_elated_get_font_option_val( $font_family ) ) );
		}
		
		$first_main_color = laurent_elated_options()->getOptionValue( 'first_color' );
		if ( ! empty( $first_main_color ) ) {
			$color_selector = $color_important_selector = $background_color_selector = $background_color_important_selector = $border_color_selector = $border_color_important_selector = $fill_color_selector = $fill_color_important_selector = $stroke_color_selector = $stroke_color_important_selector = array();
			
			// Include first main color selectors
			include_once 'parts/first-main-color.php';
			
			if ( laurent_elated_is_plugin_installed( 'woocommerce' ) ) {
				$woo_color_selector = $woo_color_important_selector = $woo_background_color_selector = $woo_background_color_important_selector = $woo_border_color_selector = $woo_border_color_important_selector = $woo_fill_color_selector = $woo_fill_color_important_selector = $woo_stroke_color_selector = $woo_stroke_color_important_selector = array();
				
				// Include first main color WooCommerce selectors
				include_once 'parts/woocommerce-first-main-color.php';
				
				if ( isset( $woo_color_selector ) && ! empty( $woo_color_selector ) ) {
					$color_selector = array_merge( $color_selector, $woo_color_selector );
				}
				
				if ( isset( $woo_color_important_selector ) && ! empty( $woo_color_important_selector ) ) {
					$color_important_selector = array_merge( $color_important_selector, $woo_color_important_selector );
				}
				
				if ( isset( $woo_background_color_selector ) && ! empty( $woo_background_color_selector ) ) {
					$background_color_selector = array_merge( $background_color_selector, $woo_background_color_selector );
				}
				
				if ( isset( $woo_background_color_important_selector ) && ! empty( $woo_background_color_important_selector ) ) {
					$background_color_important_selector = array_merge( $background_color_important_selector, $woo_background_color_important_selector );
				}
				
				if ( isset( $woo_border_color_selector ) && ! empty( $woo_border_color_selector ) ) {
					$border_color_selector = array_merge( $border_color_selector, $woo_border_color_selector );
				}
				
				if ( isset( $woo_border_color_important_selector ) && ! empty( $woo_border_color_important_selector ) ) {
					$border_color_important_selector = array_merge( $border_color_important_selector, $woo_border_color_important_selector );
				}
				
				if ( isset( $woo_fill_color_selector ) && ! empty( $woo_fill_color_selector ) ) {
					$fill_color_selector = array_merge( $fill_color_selector, $woo_fill_color_selector );
				}
				
				if ( isset( $woo_fill_color_important_selector ) && ! empty( $woo_fill_color_important_selector ) ) {
					$fill_color_important_selector = array_merge( $fill_color_important_selector, $woo_fill_color_important_selector );
				}
				
				if ( isset( $woo_stroke_color_selector ) && ! empty( $woo_stroke_color_selector ) ) {
					$stroke_color_selector = array_merge( $stroke_color_selector, $woo_stroke_color_selector );
				}
				
				if ( isset( $woo_stroke_color_important_selector ) && ! empty( $woo_stroke_color_important_selector ) ) {
					$stroke_color_important_selector = array_merge( $stroke_color_important_selector, $woo_stroke_color_important_selector );
				}
			}
			
			if ( isset( $color_selector ) && ! empty( $color_selector ) ) {
				echo laurent_elated_dynamic_css( $color_selector, array( 'color' => $first_main_color ) );
			}
			
			if ( isset( $color_important_selector ) && ! empty( $color_important_selector ) ) {
				echo laurent_elated_dynamic_css( $color_important_selector, array( 'color' => $first_main_color . '!important' ) );
			}
			
			if ( isset( $background_color_selector ) && ! empty( $background_color_selector ) ) {
				echo laurent_elated_dynamic_css( $background_color_selector, array( 'background-color' => $first_main_color ) );
			}
			
			if ( isset( $background_color_important_selector ) && ! empty( $background_color_important_selector ) ) {
				echo laurent_elated_dynamic_css( $background_color_important_selector, array( 'background-color' => $first_main_color . '!important' ) );
			}
			
			if ( isset( $border_color_selector ) && ! empty( $border_color_selector ) ) {
				echo laurent_elated_dynamic_css( $border_color_selector, array( 'border-color' => $first_main_color ) );
			}
			
			if ( isset( $border_color_important_selector ) && ! empty( $border_color_important_selector ) ) {
				echo laurent_elated_dynamic_css( $border_color_important_selector, array( 'border-color' => $first_main_color . '!important' ) );
			}
			
			if ( isset( $fill_color_selector ) && ! empty( $fill_color_selector ) ) {
				echo laurent_elated_dynamic_css( $fill_color_selector, array( 'fill' => $first_main_color ) );
			}
			
			if ( isset( $fill_color_important_selector ) && ! empty( $fill_color_important_selector ) ) {
				echo laurent_elated_dynamic_css( $fill_color_important_selector, array( 'fill' => $first_main_color . '!important' ) );
			}
			
			if ( isset( $stroke_color_selector ) && ! empty( $stroke_color_selector ) ) {
				echo laurent_elated_dynamic_css( $stroke_color_selector, array( 'stroke' => $first_main_color ) );
			}
			
			if ( isset( $stroke_color_important_selector ) && ! empty( $stroke_color_important_selector ) ) {
				echo laurent_elated_dynamic_css( $stroke_color_important_selector, array( 'stroke' => $first_main_color . '!important' ) );
			}
		}
		
		$page_background_color = laurent_elated_options()->getOptionValue( 'page_background_color' );
		if ( ! empty( $page_background_color ) ) {
			$background_color_selector = array(
				'body',
				'.eltdf-content'
			);
			echo laurent_elated_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
		}
		
		$page_background_image  = laurent_elated_options()->getOptionValue( 'page_background_image' );
		$page_background_repeat = laurent_elated_options()->getOptionValue( 'page_background_image_repeat' );
		
		if ( ! empty( $page_background_image ) ) {
			
			if ( $page_background_repeat === 'yes' ) {
				$background_image_style = array(
					'background-image'    => 'url(' . esc_url( $page_background_image ) . ')',
					'background-repeat'   => 'repeat',
					'background-position' => '0 0',
				);
			} else {
				$background_image_style = array(
					'background-image'    => 'url(' . esc_url( $page_background_image ) . ')',
					'background-repeat'   => 'no-repeat',
					'background-position' => 'center 0',
					'background-size'     => 'cover'
				);
			}
			
			echo laurent_elated_dynamic_css( '.eltdf-content', $background_image_style );
		}
		
		$selection_color = laurent_elated_options()->getOptionValue( 'selection_color' );
		if ( ! empty( $selection_color ) ) {
			echo laurent_elated_dynamic_css( '::selection', array( 'background' => $selection_color ) );
			echo laurent_elated_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
		}
		
		$preload_background_styles = array();
		
		if ( laurent_elated_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
			$preload_background_styles['background-image'] = 'url(' . laurent_elated_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
		}
		
		echo laurent_elated_dynamic_css( '.eltdf-preload-background', $preload_background_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_design_styles' );
}

if ( ! function_exists( 'laurent_elated_content_styles' ) ) {
	function laurent_elated_content_styles() {
		$content_style = array();
		
		$padding = laurent_elated_options()->getOptionValue( 'content_padding' );
		if ( $padding !== '' ) {
			$content_style['padding'] = $padding;
		}
		
		$content_selector = array(
			'.eltdf-content .eltdf-content-inner > .eltdf-full-width > .eltdf-full-width-inner',
		);
		
		echo laurent_elated_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_in_grid = laurent_elated_options()->getOptionValue( 'content_padding_in_grid' );
		if ( $padding_in_grid !== '' ) {
			$content_style_in_grid['padding'] = $padding_in_grid;
		}
		
		$content_selector_in_grid = array(
			'.eltdf-content .eltdf-content-inner > .eltdf-container > .eltdf-container-inner',
		);
		
		echo laurent_elated_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_content_styles' );
}

if ( ! function_exists( 'laurent_elated_header_grid_styles' ) ) {
    function laurent_elated_header_grid_styles($style) {

        $current_style           = '';
        $page_id                 = laurent_elated_get_page_id();
        $header_height           = laurent_elated_get_meta_field_intersect( 'menu_area_height', $page_id );
        $top_bar_enabled         = laurent_elated_get_meta_field_intersect( 'top_bar', $page_id );
        $top_bar_height          = laurent_elated_options()->getOptionValue( 'top_bar_height' );
        $top_bar_value           = ! empty($top_bar_height) ? laurent_elated_filter_px( $top_bar_height ) : '46';
        $header_value            = ! empty($header_height) ? laurent_elated_filter_px( $header_height ) : '110';
        $grid_lines_style        = array();
        $header_grid_lines_style = array();

        $grid_lines_selector = array(
            '.eltdf-double-grid-line-one',
            '.eltdf-double-grid-line-two',
        );

        if ( $header_height !== '' ) {
            $grid_lines_style['top'] = laurent_elated_filter_px( $header_height ) . 'px';
        }

        if(!empty($grid_lines_style) ) {
            $current_style .= laurent_elated_dynamic_css( $grid_lines_selector, $grid_lines_style );
        }

        if ( $top_bar_enabled == 'yes' ) {
            $header_grid_lines_style['height'] = ( $header_value + $top_bar_value ) . 'px';
        } else {
            $header_grid_lines_style['height'] = $header_value . 'px';
        }

        $header_grid_lines_selector = array(
            '.eltdf-header-double-grid-line-one',
            '.eltdf-header-double-grid-line-two',
        );

        if(!empty($header_grid_lines_style) ) {
            $current_style .= laurent_elated_dynamic_css( $header_grid_lines_selector, $header_grid_lines_style );
        }

        $current_style = $current_style . $style;

		return $current_style;
    }

    add_filter( 'laurent_elated_filter_add_page_custom_style', 'laurent_elated_header_grid_styles' );
}

if ( ! function_exists( 'laurent_elated_h1_styles' ) ) {
	function laurent_elated_h1_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_h1_styles' );
}

if ( ! function_exists( 'laurent_elated_h2_styles' ) ) {
	function laurent_elated_h2_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_h2_styles' );
}

if ( ! function_exists( 'laurent_elated_h3_styles' ) ) {
	function laurent_elated_h3_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_h3_styles' );
}

if ( ! function_exists( 'laurent_elated_h4_styles' ) ) {
	function laurent_elated_h4_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_h4_styles' );
}

if ( ! function_exists( 'laurent_elated_h5_styles' ) ) {
	function laurent_elated_h5_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_h5_styles' );
}

if ( ! function_exists( 'laurent_elated_h6_styles' ) ) {
	function laurent_elated_h6_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_h6_styles' );
}

if ( ! function_exists( 'laurent_elated_text_styles' ) ) {
	function laurent_elated_text_styles() {
		$margin_top    = laurent_elated_options()->getOptionValue( 'text_margin_top' );
		$margin_bottom = laurent_elated_options()->getOptionValue( 'text_margin_bottom' );
		
		$item_styles = laurent_elated_get_typography_styles( 'text' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = laurent_elated_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = laurent_elated_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_text_styles' );
}

if ( ! function_exists( 'laurent_elated_link_styles' ) ) {
	function laurent_elated_link_styles() {
		$link_styles      = array();
		$link_color       = laurent_elated_options()->getOptionValue( 'link_color' );
		$link_font_style  = laurent_elated_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = laurent_elated_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = laurent_elated_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo laurent_elated_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_link_styles' );
}

if ( ! function_exists( 'laurent_elated_link_hover_styles' ) ) {
	function laurent_elated_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = laurent_elated_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = laurent_elated_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo laurent_elated_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo laurent_elated_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_link_hover_styles' );
}

if ( ! function_exists( 'laurent_elated_smooth_page_transition_styles' ) ) {
	function laurent_elated_smooth_page_transition_styles( $style ) {
		$id            = laurent_elated_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = laurent_elated_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.eltdf-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= laurent_elated_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = laurent_elated_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.eltdf-st-loader .eltdf-rotate-circles > div',
			'.eltdf-st-loader .pulse',
			'.eltdf-st-loader .double_pulse .double-bounce1',
			'.eltdf-st-loader .double_pulse .double-bounce2',
			'.eltdf-st-loader .cube',
			'.eltdf-st-loader .rotating_cubes .cube1',
			'.eltdf-st-loader .rotating_cubes .cube2',
			'.eltdf-st-loader .stripes > div',
			'.eltdf-st-loader .wave > div',
			'.eltdf-st-loader .two_rotating_circles .dot1',
			'.eltdf-st-loader .two_rotating_circles .dot2',
			'.eltdf-st-loader .five_rotating_circles .container1 > div',
			'.eltdf-st-loader .five_rotating_circles .container2 > div',
			'.eltdf-st-loader .five_rotating_circles .container3 > div',
			'.eltdf-st-loader .atom .ball-1:before',
			'.eltdf-st-loader .atom .ball-2:before',
			'.eltdf-st-loader .atom .ball-3:before',
			'.eltdf-st-loader .atom .ball-4:before',
			'.eltdf-st-loader .clock .ball:before',
			'.eltdf-st-loader .mitosis .ball',
			'.eltdf-st-loader .lines .line1',
			'.eltdf-st-loader .lines .line2',
			'.eltdf-st-loader .lines .line3',
			'.eltdf-st-loader .lines .line4',
			'.eltdf-st-loader .fussion .ball',
			'.eltdf-st-loader .fussion .ball-1',
			'.eltdf-st-loader .fussion .ball-2',
			'.eltdf-st-loader .fussion .ball-3',
			'.eltdf-st-loader .fussion .ball-4',
			'.eltdf-st-loader .wave_circles .ball',
			'.eltdf-st-loader .pulse_circles .ball'
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= laurent_elated_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'laurent_elated_filter_add_page_custom_style', 'laurent_elated_smooth_page_transition_styles' );
}