<?php

foreach ( glob( LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'laurent_elated_title_area_typography_style' ) ) {
	function laurent_elated_title_area_typography_style() {
		
		// title default/small style
		
		$item_styles = laurent_elated_get_typography_styles( 'page_title' );
		
		$item_selector = array(
			'.eltdf-title-holder .eltdf-title-wrapper .eltdf-page-title'
		);
		
		echo laurent_elated_dynamic_css( $item_selector, $item_styles );
		
		// subtitle style
		
		$item_styles = laurent_elated_get_typography_styles( 'page_subtitle' );
		
		$item_selector = array(
			'.eltdf-title-holder .eltdf-title-wrapper .eltdf-page-subtitle'
		);
		
		echo laurent_elated_dynamic_css( $item_selector, $item_styles );

		// decorative shape style

        $color = laurent_elated_options()->getOptionValue('page_title_color');
		$decor_styles = array();
        $decor_selector = array(
            '.eltdf-title-holder.eltdf-centered-type .eltdf-title-inner .eltdf-title-holder-inner .eltdf-title-decor',
        );

        if ( ! empty( $color ) ) {
            $decor_styles['color'] = $color;
        }

        if ( ! empty( $decor_styles ) ) {
            echo laurent_elated_dynamic_css( $decor_selector, $decor_styles );
        }
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_title_area_typography_style' );
}


if ( ! function_exists( 'laurent_elated_page_title_area_mobile_style' ) ) {
	function laurent_elated_page_title_area_mobile_style($style) {

		$current_style = '';
		$page_id       = laurent_elated_get_page_id();
		$class_prefix  = laurent_elated_get_unique_page_class( $page_id );

		$res_start = '@media only screen and (max-width: 1024px) {';
		$res_end   = '}';
		$item_styles   = array();

		$title_responsive_width = get_post_meta( $page_id, 'eltdf_title_area_height_mobile_meta', true );
		
		
		$item_selector = array(
			$class_prefix . ' .eltdf-title-holder',
			$class_prefix . ' .eltdf-title-holder .eltdf-title-wrapper'
		);

		if ( $title_responsive_width !== '' ) {
			$item_styles['height'] = laurent_elated_filter_suffix( $title_responsive_width, 'px') . 'px !important' ;
		}

		if(!empty($item_styles)) {
			$current_style .= $res_start . laurent_elated_dynamic_css( $item_selector, $item_styles ) . $res_end;
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'laurent_elated_filter_add_page_custom_style', 'laurent_elated_page_title_area_mobile_style' );
}