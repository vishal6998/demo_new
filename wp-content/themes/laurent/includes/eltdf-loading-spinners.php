<?php

if ( ! function_exists( 'laurent_elated_loading_spinners' ) ) {
	function laurent_elated_loading_spinners() {
		$id           = laurent_elated_get_page_id();
		$spinner_type = laurent_elated_get_meta_field_intersect( 'smooth_pt_spinner_type', $id );
		
		$spinner_html = '';
		if ( ! empty( $spinner_type ) ) {
			switch ( $spinner_type ) {
                case 'laurent_spinner':
                    $spinner_html = laurent_elated_loading_spinner_laurent_spinner();
                    break;
				case 'rotate_circles':
					$spinner_html = laurent_elated_loading_spinner_rotate_circles();
					break;
				case 'pulse':
					$spinner_html = laurent_elated_loading_spinner_pulse();
					break;
				case 'double_pulse':
					$spinner_html = laurent_elated_loading_spinner_double_pulse();
					break;
				case 'cube':
					$spinner_html = laurent_elated_loading_spinner_cube();
					break;
				case 'rotating_cubes':
					$spinner_html = laurent_elated_loading_spinner_rotating_cubes();
					break;
				case 'stripes':
					$spinner_html = laurent_elated_loading_spinner_stripes();
					break;
				case 'wave':
					$spinner_html = laurent_elated_loading_spinner_wave();
					break;
				case 'two_rotating_circles':
					$spinner_html = laurent_elated_loading_spinner_two_rotating_circles();
					break;
				case 'five_rotating_circles':
					$spinner_html = laurent_elated_loading_spinner_five_rotating_circles();
					break;
				case 'atom':
					$spinner_html = laurent_elated_loading_spinner_atom();
					break;
				case 'clock':
					$spinner_html = laurent_elated_loading_spinner_clock();
					break;
				case 'mitosis':
					$spinner_html = laurent_elated_loading_spinner_mitosis();
					break;
				case 'lines':
					$spinner_html = laurent_elated_loading_spinner_lines();
					break;
				case 'fussion':
					$spinner_html = laurent_elated_loading_spinner_fussion();
					break;
				case 'wave_circles':
					$spinner_html = laurent_elated_loading_spinner_wave_circles();
					break;
				case 'pulse_circles':
					$spinner_html = laurent_elated_loading_spinner_pulse_circles();
					break;
				default:
					$spinner_html = laurent_elated_loading_spinner_pulse();
			}
		}
		
		echo wp_kses( $spinner_html, array(
			'div' => array(
				'class' => true,
				'style' => true,
				'id'    => true
			),
            'svg' => array(
                'class'             => true,
                'xmlns'             => true,
                'x'                 => true,
                'y'                 => true,
                'width'             => true,
                'height'            => true,
                'viewBox'           => true,
                'enable-background' => true
            ),
            'polyline' => array(
                'fill'              => true,
                'stroke'            => true,
                'stroke-miterlimit' => true,
                'points'            => true
            )
		) );
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_laurent_spinner') ) {
    function laurent_elated_loading_spinner_laurent_spinner() {
        $html = '';
        $html .= '<div class="eltdf-laurent-spinner-holder">';
        $html .= '<div class="eltdf-laurent-spinner-image">'. laurent_elated_return_preloader_svg() .'</div>';
        $html .= '</div>';

        return $html;
    }
}

if ( ! function_exists( 'laurent_elated_loading_spinner_rotate_circles' ) ) {
	function laurent_elated_loading_spinner_rotate_circles() {
		$html = '';
		$html .= '<div class="eltdf-rotate-circles">';
		$html .= '<div></div>';
		$html .= '<div></div>';
		$html .= '<div></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_pulse' ) ) {
	function laurent_elated_loading_spinner_pulse() {
		$html = '<div class="pulse"></div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_double_pulse' ) ) {
	function laurent_elated_loading_spinner_double_pulse() {
		$html = '';
		$html .= '<div class="double_pulse">';
		$html .= '<div class="double-bounce1"></div>';
		$html .= '<div class="double-bounce2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_cube' ) ) {
	function laurent_elated_loading_spinner_cube() {
		$html = '<div class="cube"></div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_rotating_cubes' ) ) {
	function laurent_elated_loading_spinner_rotating_cubes() {
		$html = '';
		$html .= '<div class="rotating_cubes">';
		$html .= '<div class="cube1"></div>';
		$html .= '<div class="cube2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_stripes' ) ) {
	function laurent_elated_loading_spinner_stripes() {
		$html = '';
		$html .= '<div class="stripes">';
		$html .= '<div class="rect1"></div>';
		$html .= '<div class="rect2"></div>';
		$html .= '<div class="rect3"></div>';
		$html .= '<div class="rect4"></div>';
		$html .= '<div class="rect5"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_wave' ) ) {
	function laurent_elated_loading_spinner_wave() {
		$html = '';
		$html .= '<div class="wave">';
		$html .= '<div class="bounce1"></div>';
		$html .= '<div class="bounce2"></div>';
		$html .= '<div class="bounce3"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_two_rotating_circles' ) ) {
	function laurent_elated_loading_spinner_two_rotating_circles() {
		$html = '';
		$html .= '<div class="two_rotating_circles">';
		$html .= '<div class="dot1"></div>';
		$html .= '<div class="dot2"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_five_rotating_circles' ) ) {
	function laurent_elated_loading_spinner_five_rotating_circles() {
		$html = '';
		$html .= '<div class="five_rotating_circles">';
		$html .= '<div class="spinner-container container1">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container2">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '<div class="spinner-container container3">';
		$html .= '<div class="circle1"></div>';
		$html .= '<div class="circle2"></div>';
		$html .= '<div class="circle3"></div>';
		$html .= '<div class="circle4"></div>';
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_atom' ) ) {
	function laurent_elated_loading_spinner_atom() {
		$html = '';
		$html .= '<div class="atom">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_clock' ) ) {
	function laurent_elated_loading_spinner_clock() {
		$html = '';
		$html .= '<div class="clock">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_mitosis' ) ) {
	function laurent_elated_loading_spinner_mitosis() {
		$html = '';
		$html .= '<div class="mitosis">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_lines' ) ) {
	function laurent_elated_loading_spinner_lines() {
		$html = '';
		$html .= '<div class="lines">';
		$html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_fussion' ) ) {
	function laurent_elated_loading_spinner_fussion() {
		$html = '';
		$html .= '<div class="fussion">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_wave_circles' ) ) {
	function laurent_elated_loading_spinner_wave_circles() {
		$html = '';
		$html .= '<div class="wave_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_loading_spinner_pulse_circles' ) ) {
	function laurent_elated_loading_spinner_pulse_circles() {
		$html = '';
		$html .= '<div class="pulse_circles">';
		$html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
		$html .= '</div>';
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_elated_return_preloader_svg' ) ) {
    function laurent_elated_return_preloader_svg() {
        $html = '<svg class="eltdf-svg-preloader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="81.125px" height="110.208px" viewBox="0 0 81.125 110.208" enable-background="new 0 0 81.125 110.208" xml:space="preserve">
                    <polyline fill="none" stroke="#C9AB81" stroke-miterlimit="10" points="1.792,1.09 1.792,84.649 51.954,84.649 "/>
                    <polyline fill="none" stroke="#C9AB81" stroke-miterlimit="10" points="15.792,13.09 15.792,96.649 65.954,96.649 "/>
                    <polyline fill="none" stroke="#C9AB81" stroke-miterlimit="10" points="29.792,25.09 29.792,108.649 79.954,108.649 "/>
                </svg>';

        return $html;
    }
}
