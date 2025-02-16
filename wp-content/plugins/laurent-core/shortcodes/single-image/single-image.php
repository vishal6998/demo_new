<?php
namespace LaurentCore\CPT\Shortcodes\SingleImage;

use LaurentCore\Lib;

class SingleImage implements Lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'eltdf_single_image';

		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Single Image', 'laurent-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by LAURENT', 'laurent-core' ),
					'icon'                      => 'icon-wpb-single-image extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__( 'Custom CSS Class', 'laurent-core' ),
                            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'laurent-core' )
                        ),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'laurent-core' ),
							'description' => esc_html__( 'Select image from media library', 'laurent-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'laurent-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'image', 'not_empty' => true )
						),
                        array(
                            'type'        => 'textarea_raw_html',
                            'param_name'  => 'svg_image',
                            'heading'     => esc_html__( 'SVG Image Path', 'laurent-core' ),
                            'description' => esc_html__( 'Add your SVG path to use instead of image. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent-core' ),
                            'save_always' => true
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
							'save_always' => true,
                            'dependency'  => array( 'element' => 'image', 'not_empty' => true )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_ornament',
                            'heading'     => esc_html__( 'Enable Ornamental Background', 'laurent-core' ),
                            'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
                            'dependency'  => array( 'element' => 'image', 'not_empty' => true )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'ornament_shape',
                            'heading'     => esc_html__( 'Ornament Shape', 'laurent-core' ),
                            'value'       => array(
                                esc_html__( 'Rectangle', 'laurent-core' ) => 'rectangle',
                                esc_html__( 'Ellipse', 'laurent-core' ) => 'ellipse',
                                esc_html__( 'Triangle', 'laurent-core' ) => 'triangle',
                                esc_html__( 'Custom', 'laurent-core' ) => 'custom'
                            ),
                            'dependency'  => array( 'element' => 'enable_ornament', 'value' => array( 'yes' ) ),
                        ),
                        array(
                            'type'        => 'textarea_raw_html',
                            'param_name'  => 'ornament_svg_path',
                            'heading'     => esc_html__( 'Ornament SVG Path', 'laurent-core' ),
                            'description' => esc_html__( 'Add your custom SVG path. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent-core' ),
                            'save_always' => true,
                            'dependency'  => array( 'element' => 'ornament_shape', 'value' => array( 'custom' ) ),
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'param_name'  => 'ornament_color',
                            'heading'     => esc_html__( 'Ornament Color', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'enable_ornament', 'value' => array( 'yes' ) ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'ornament_width',
                            'heading'     => esc_html__( 'Ornament Width (%)', 'laurent-core' ),
                            'description' => esc_html__( 'Enter ornament width in relation to image', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'enable_ornament', 'value' => array( 'yes' ) ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'ornament_height',
                            'heading'     => esc_html__( 'Ornament Height (%)', 'laurent-core' ),
                            'description' => esc_html__( 'Enter ornament height in relation to image', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'enable_ornament', 'value' => array( 'yes' ) ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'ornament_top',
                            'heading'     => esc_html__( 'Ornament Top Offset (px or %)', 'laurent-core' ),
                            'description' => esc_html__( 'Enter top offset in relation to image', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'enable_ornament', 'value' => array( 'yes' ) ),
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'ornament_right',
                            'heading'     => esc_html__( 'Ornament Right Offset (px or %)', 'laurent-core' ),
                            'description' => esc_html__( 'Enter right offset in relation to image', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'enable_ornament', 'value' => array( 'yes' ) ),
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_behavior',
							'heading'    => esc_html__( 'Image Behavior', 'laurent-core' ),
							'value'      => array(
								esc_html__( 'None', 'laurent-core' )             => '',
								esc_html__( 'Open Lightbox', 'laurent-core' )    => 'lightbox',
								esc_html__( 'Open Custom Link', 'laurent-core' ) => 'custom-link',
								esc_html__( 'Zoom', 'laurent-core' )             => 'zoom',
								esc_html__( 'Grayscale', 'laurent-core' )        => 'grayscale',
								esc_html__( 'Moving on Hover', 'laurent-core' )  => 'moving'
							),
                            'dependency'  => array( 'element' => 'image', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_link',
							'heading'    => esc_html__( 'Custom Link', 'laurent-core' ),
							'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'laurent-core' ),
							'value'      => array_flip( laurent_elated_get_link_target_array() ),
							'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'appear_effect',
                            'heading'    => esc_html__( 'Appear Effect', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'None', 'laurent-core' ) => 'none',
                                esc_html__( 'From Top', 'laurent-core' ) => 'from-top',
                                esc_html__( 'From Left', 'laurent-core' )  => 'from-left',
                                esc_html__( 'From Right', 'laurent-core' ) => 'from-right',
                            ),
                            'dependency'  => array( 'element' => 'image', 'not_empty' => true )
                        )
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
		    'custom_class'        => '',
			'image'               => '',
			'image_size'          => 'full',
			'svg_image'           => '',
			'enable_image_shadow' => 'no',
            'enable_ornament'     => 'no',
            'ornament_shape'      => 'rectangle',
            'ornament_svg_path'   => '',
            'ornament_color'      => '',
            'ornament_width'      => '',
            'ornament_height'     => '',
            'ornament_top'        => '',
            'ornament_right'      => '',
			'image_behavior'      => '',
			'custom_link'         => '',
			'custom_link_target'  => '_self',
            'appear_effect'       => 'none'
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['holder_styles']      = $this->getHolderStyles( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		$params['ornament']           = $this->getOrnament( $params );
        $params['ornament_styles']    = $this->getOrnamentStyles( $params );

		$html = laurent_core_get_shortcode_module_template_part( 'templates/single-image', 'single-image', '', $params );

		return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty ( $params['svg_image'] ) ? 'eltdf-svg-pattern' : '';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'eltdf-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'eltdf-image-behavior-' . $params['image_behavior'] : '';
        $holderClasses[] = ! empty( $params['appear_effect'] ) ? 'eltdf-image-appear-' . $params['appear_effect'] : '';

		return implode( ' ', $holderClasses );
	}

	private function getHolderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['image'] ) && $params['image_behavior'] === 'moving' ) {
			$image_original = wp_get_attachment_image_src( $params['image'], 'full' );

			$styles[] = 'background-image: url(' . $image_original[0] . ')';
		}

		return implode( ';', $styles );
	}

	private function getImage( $params ) {
		$image = array();

		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = is_array( $image_original ) ? $image_original[0] : $image_original;
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}

		return $image;
	}

	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}

	private function getOrnament( $params ) {
        $ornament_shape  = $params['ornament_shape'];
        $color           = $this->getOrnamentColor( $params );
        $ornament_svg    = $params['ornament_svg_path'];

        switch($ornament_shape) {

            case 'rectangle':
                $ornament = '<svg xmlns="http://www.w3.org/2000/svg" width="368.879" height="368.871">
                                <path fill="none" stroke="rgb(' . esc_attr( $color ) . ')" stroke-width="1.5" stroke-miterlimit="10" d="M.001 257.722l28.289 28.289L.002 314.299M.001 169.386l28.289-28.288L.005 112.813M24.478-.002L0 24.476m17.885 344.397l10.405-10.405L.005 330.182m-.003-88.34l28.288-28.287L.005 185.269M.002 96.93L28.29 68.642.001 40.353M96.935-.002L28.29 68.642l72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.41 10.41m51.642-.004l10.405-10.406-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456L32.103-.002m137.289 0l-68.645 68.644 72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.406 10.405m51.646-.001l10.405-10.404-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456L104.56-.002m137.282.007l-68.638 68.637 72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.404 10.405m51.648 0l10.405-10.405-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456L177.023.005m137.275.001l-68.637 68.636 72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.403 10.403m51.65 0l10.404-10.403-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456-68.65-68.65m119.408 307.719l-50.758 50.757 10.406 10.405m40.354-206.076l-50.76 50.758 50.761 50.76m-.001-246.431l-50.76 50.758 50.758 50.757m0 115.855l-50.758 50.757 50.761 50.761m-.003-246.432l-50.758 50.758 50.754 50.754M321.938.005l46.938 46.938m-141.328 3.584l18.113-18.113m54.344 18.113l18.113-18.113m-90.57 90.57l18.113-18.114m54.344 18.114l18.113-18.114m-90.57 90.571l18.113-18.115m54.344 18.115l18.113-18.115M10.175 14.3L0 4.125M68.327-.006L82.633 14.3m72.457 0L140.789 0m86.757 14.3L213.252.006M300.003 14.3L285.709.006m72.459.002l10.714 10.714M28.29-.005v32.419l18.113 18.113m-36.029 0L28.29 32.414M100.747-.005v32.419l18.113 18.113m-36.029 0l17.916-18.113M173.194-.005v32.419l18.114 18.113M245.661-.015v32.429l18.114 18.113M318.118-.005v32.419l18.114 18.113m-180.954 0l17.916-18.113M28.29 68.642v36.229l18.113 18.114m-36.029-.001L28.29 104.87m72.457-36.228v36.229l18.113 18.114m-36.029-.001l17.916-18.114m72.447-36.228v36.229l18.114 18.114m54.353-54.343v36.229l18.114 18.114m54.343-54.343v36.229l18.114 18.114m-180.954-.001l17.916-18.114M28.29 141.098v36.229l18.113 18.115m-36.029-.001l17.916-18.115m72.457-36.228v36.229l18.113 18.115m-36.029-.001l17.916-18.115m72.447-36.228v36.229l18.114 18.115m54.353-54.344v36.229l18.114 18.115m54.343-54.344v36.229l18.114 18.115m-180.954-.001l17.916-18.115M28.29 213.556v36.229l18.113 18.114m-36.029-.001l17.916-18.114m72.457-36.228v36.229l18.113 18.114m-18.113-18.115l-17.916 18.114m90.363-54.342v36.229l18.114 18.114m54.353-54.343v36.229l18.114 18.114m54.343-54.343v36.229l18.114 18.114m-163.038-18.115l-17.916 18.114M28.29 286.011v36.229l18.113 18.114m-36.029 0L28.29 322.24m72.457-36.229v36.229l18.113 18.114m-36.029 0l17.916-18.114m72.447-36.229v36.229l18.114 18.114m126.81-54.343v36.229l18.114 18.114m-90.571-54.343v36.229l18.114 18.114m-90.581-18.115l-17.916 18.114M46.603 14.3L60.752-.006M119.06 14.3L133.208-.005M191.517 14.3L205.655.006M263.974 14.3L278.112.006M336.431 14.3L350.589-.014M0 76.58l10.175 10.176m54.344-54.342v36.229l18.114 18.113m54.343-54.342v36.229l18.114 18.113m54.343-54.342v36.229l18.113 18.113m54.344-54.342v36.229l18.113 18.113m54.344-54.342v36.229l14.529 14.529M46.603 86.756l17.916-18.113m54.541 18.113l17.916-18.113m54.541 18.113l17.916-18.113m54.541 18.113l17.916-18.113m54.541 18.113l17.916-18.113m-344.172 90.57L0 149.037m64.519-44.167v36.229l18.114 18.114m54.343-54.343v36.229l18.114 18.114m54.343-54.343v36.229l18.113 18.114m126.801-54.343v36.229l14.529 14.53M281.89 104.87v36.229l18.113 18.114m-253.4 0l17.916-18.114m54.541 18.114l17.916-18.114m54.541 18.114l17.916-18.114m126.998 18.114l17.916-18.114m-90.373 18.114l17.916-18.114M10.175 231.67L.002 221.497m64.517-44.171v36.229l18.114 18.115m54.343-54.344v36.229l18.114 18.115m54.343-54.344v36.229l18.113 18.115m54.344-54.344v36.229l18.113 18.115m54.344-54.344v36.229l14.529 14.531M46.603 231.67l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m-126.799 54.333l18.113-18.113m54.344 18.113l18.113-18.113m-90.57 90.579l18.113-18.113m54.344 18.113l18.113-18.113M10.175 304.117L.007 293.947m64.512-44.173v36.228l18.114 18.115m54.343-54.343v36.228l18.114 18.115m54.343-54.343v36.228l18.113 18.115m126.801-54.343v36.228l14.529 14.531m-86.986-50.759v36.228l18.113 18.115m-253.4 0l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m126.998 18.115l17.916-18.115m-90.373 18.115l17.916-18.115M64.519 322.239v36.228l10.406 10.406m62.051-46.634v36.228l10.406 10.406m62.051-46.634v36.228l10.405 10.406m134.509-46.634v36.228l10.405 10.406m-82.862-46.634v36.228l10.403 10.404m-238.064 0l10.29-10.404m62.166 10.404l10.291-10.404m62.165 10.406l10.292-10.406m62.165 10.406l10.292-10.406m62.165 10.406l10.292-10.406M.002 4.499"/>
                            </svg>';
                break;

            case 'ellipse':
                $ornament = '<svg xmlns="http://www.w3.org/2000/svg" width="303.083" height="305.563">
                                <path fill="none" stroke="rgb(' . esc_attr( $color ) . ')" stroke-width="1.5" stroke-miterlimit="10" d="M36.927 251.827L1.428 190.62 72.426 67.954 53.591 35.415M36.927 251.827l35.499-61.207L12.86 87.705m95.065-81.084l35.499 61.333L72.426 190.62l65.733 113.572m-52.431-13.887l57.696-99.685L72.426 67.954l35.47-61.282m68.954-3.631l37.572 64.913-70.998 122.666 60.398 104.352m-55.403 9.683l66.003-114.035-70.998-122.666L180.614 3.7m100.552 71.606L214.422 190.62l41.37 71.478M233.9 279.635l51.521-89.015-70.999-122.666 23.047-39.817m64.554 133.8L285.42 190.62l7.581 13.098M96.143 10.63v16.348M60.644 88.311v-17.44L44.853 43.219M25.145 149.644v-17.439L7.325 101m53.319 109.977v-17.439l-23.712-41.521-23.722 41.577v17.383m82.933 61.333v-17.44l-23.712-41.521-23.722 41.578v10.798m75.021 36.623l-15.8-27.666-11.501 20.158m96.143 3.732l-13.644-23.891-16.852 29.537m5.026-31.908v-17.44l-23.712-41.521-23.722 41.578v17.383m118.471 0v-17.44l-23.712-41.521-23.722 41.578v17.383m97.105-54.786l-2.385-4.176-23.722 41.578v1.114m-130.061-45.063v-17.439l-23.712-41.521-23.722 41.578v17.383m118.432-.001v-17.439l-23.712-41.521-23.722 41.578v17.383m118.432-.001v-17.439l-23.712-41.521-23.722 41.578v17.383M96.143 149.644v-17.439L72.431 90.683l-23.722 41.578v17.383m118.393 0v-17.439L143.39 90.683l-23.722 41.578v17.383m118.471 0v-17.439l-23.712-41.521-23.722 41.578v17.383m105.285-40.463l-10.564-18.499-23.722 41.578v17.383M131.642 88.311v-17.44L107.93 29.35 84.208 70.928v17.383m118.432 0v-17.44L178.928 29.35l-23.722 41.578v17.383m118.432 0v-17.44l-12.967-22.705m-14.027-13.062l-20.439 35.824v17.383m-59.064-61.333V9.538l-4.791-8.391m-38.904 1.896l-3.738 6.552v17.383m72.745-20.445l-1.747 3.062v17.383M84.248 15.75v31.78m-23.643 0V29.963m-11.856 78.9V73.93l-11.82-20.694-11.823 20.723v34.904M13.25 170.196v-34.934L2.607 116.629m46.142 114.9v-34.934L36.93 175.902l-11.823 20.723v34.904M84.248 289.6v-31.671l-11.819-20.693-11.823 20.723v17.433m120.069 26.241l-1.75-3.064-2.172 3.805m-21.507-9.512v-34.934l-11.819-20.693-11.823 20.723v34.904m94.64-8.49v-26.443l-11.819-20.693-11.823 20.723v34.904m-82.855-61.334v-34.934l-11.819-20.693-11.823 20.723v34.904m94.64 0v-34.934l-11.819-20.693-11.823 20.723v34.904m94.64 0v-34.934l-11.819-20.693-11.824 20.723v34.904M84.248 170.196v-34.934l-11.819-20.693-11.823 20.723v34.904m94.601 0v-34.934l-11.819-20.693-11.823 20.723v34.904m94.679 0v-34.934l-11.819-20.693-11.823 20.723v34.904m94.64 0v-34.934l-11.819-20.693-11.823 20.723v34.904m-153.853-61.333V73.93l-11.819-20.693-11.824 20.722v34.904m94.641 0V73.93l-11.819-20.693-11.823 20.723v34.904m94.64-.001V73.93l-11.819-20.693L238.1 73.959v34.904M155.246 47.53V12.597L148.445.69m-10.298.466l-6.544 11.47V47.53m94.641-26.554V47.53m-22.366-37.143l-1.277 2.239V47.53M72.426 22.118v45.836m-35.499 5.158v56.051m-35.499 5.281v56.051m35.499 5.281v56.051m35.499 5.277v26.128m70.998-26.128v47.4m70.998-47.4v33.414m-106.497-94.742v56.051m70.998-56.051v56.051m70.998-56.051v56.051M72.426 134.444v56.051m70.998-56.051v56.051m70.998-56.051v56.051m70.998-56.051v56.051M107.925 73.112v56.051m70.998-56.051v56.051m70.998-56.051v56.051M143.424 11.903v56.051m70.998-53.136v53.136m-76.584 236.208"/>
                            </svg>';
                break;

            case 'triangle':
                $ornament = '<svg xmlns="http://www.w3.org/2000/svg" width="278.438" height="310.916">
                                <path fill="none" stroke="rgb(' . esc_attr( $color ) . ')" stroke-width="1.5" stroke-miterlimit="10" d="M235.245 292.119l43.671-25.276m-.006 13.104l-72.65-42.05-32.438 18.775M50.974 185.779l32.62-18.88 122.666 70.998 72.656-42.053m0 13.109l-72.656-42.054-93.862 54.326M92.613 101.122l113.646 65.777 72.658-42.055m-.001 13.11L206.26 95.901 83.594 166.899l-52.399-30.328m122.843-70.895l52.222 30.226 72.658-42.055m-63.457-23.618l63.46 36.73M226.615 249.68h-17.439l-23.861 13.626m93.603-49.125h-8.408l-41.521 23.711 41.578 23.723h8.353m-.002-118.393h-8.408l-41.521 23.711 41.578 23.723h8.351m0-118.471h-8.408l-41.521 23.712 41.578 23.722h8.353m-.002-118.432h-8.408l-41.521 23.712 41.578 23.722h8.353m-52.305 130.061h-17.439l-41.521 23.712 41.578 23.722h17.383m-.001-118.432h-17.439l-41.521 23.712 41.578 23.722h17.383m-.001-118.432h-17.439l-41.521 23.712 41.578 23.722h17.383m-61.333 130.061h-17.439l-23.952 13.678m41.391-84.637h-17.439l-41.521 23.712 41.578 23.722h17.383m-.001-118.471h-17.439l-41.521 23.712 41.578 23.722h17.383m-61.335 59.063H86.51l-24.043 13.73m41.482-84.728H86.51l-41.521 23.712 41.578 23.722h17.383m-61.333-11.935H25.178L1.043 156.966m246.125 104.609h-34.934l-15.036 8.588m49.97 15.055h-23.883m55.633-59.143h-5.35l-20.693 11.82 20.723 11.822h5.32m-.001-94.64h-5.349l-20.693 11.82 20.723 11.822h5.323m-.004-94.639h-5.349l-20.693 11.819 20.723 11.823h5.32m0-94.64h-5.35l-20.693 11.819 20.723 11.823h5.32m-31.75 153.853h-34.934l-20.693 11.819 20.723 11.823h34.904m0-94.64h-34.934l-20.693 11.819 20.723 11.823h34.904m0-94.64h-34.934L191.541 60.4l20.723 11.823h34.904m-61.332 153.853h-34.934l-14.869 8.491m49.803 15.152h-24.064m24.064-94.602h-34.934l-20.693 11.819 20.723 11.823h34.904m0-94.679h-34.934l-20.693 11.819 20.723 11.823h34.904m-61.334 82.855H89.568L74.35 199.27m50.152 14.95h-24.245m24.245-94.641H89.568l-20.693 11.819 20.723 11.823h34.904M63.17 155.078H28.236l-15.311 8.745m50.245 14.898H38.74m172.676 94.675l56.051-.001m5.277-35.498h6.174m0 47.282h-8.408l-23.771 13.574m32.179-1.68h-5.35l-14.945 8.537m14.121 3.286h6.174m-6.174-141.997h6.176m-6.176-70.998h6.174m-6.174-70.998h6.176m-11.453 177.494l-56.051.001m0-70.998h56.051m-56.051-70.998h56.051M150.084 237.897h56.051m-56.051-70.998h56.051m-56.051-70.998h56.051M88.752 202.398h56.051M88.752 131.4h56.051m-117.26 35.499h56.051m195.322 99.944"/>
                            </svg>';
                break;

            case 'custom':
                $ornament = laurent_elated_get_module_part( urldecode( base64_decode( $ornament_svg ) ) );
                break;

            default:
                $ornament = '<svg xmlns="http://www.w3.org/2000/svg" width="368.879" height="368.871">
                                <path fill="none" stroke="rgb(' . esc_attr( $color ) . ')" stroke-width="1.5" stroke-miterlimit="10" d="M.001 257.722l28.289 28.289L.002 314.299M.001 169.386l28.289-28.288L.005 112.813M24.478-.002L0 24.476m17.885 344.397l10.405-10.405L.005 330.182m-.003-88.34l28.288-28.287L.005 185.269M.002 96.93L28.29 68.642.001 40.353M96.935-.002L28.29 68.642l72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.41 10.41m51.642-.004l10.405-10.406-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456L32.103-.002m137.289 0l-68.645 68.644 72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.406 10.405m51.646-.001l10.405-10.404-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456L104.56-.002m137.282.007l-68.638 68.637 72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.404 10.405m51.648 0l10.405-10.405-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456L177.023.005m137.275.001l-68.637 68.636 72.457 72.456-72.457 72.457 72.457 72.456-72.457 72.457 10.403 10.403m51.65 0l10.404-10.403-72.457-72.457 72.457-72.456-72.457-72.457 72.457-72.456-68.65-68.65m119.408 307.719l-50.758 50.757 10.406 10.405m40.354-206.076l-50.76 50.758 50.761 50.76m-.001-246.431l-50.76 50.758 50.758 50.757m0 115.855l-50.758 50.757 50.761 50.761m-.003-246.432l-50.758 50.758 50.754 50.754M321.938.005l46.938 46.938m-141.328 3.584l18.113-18.113m54.344 18.113l18.113-18.113m-90.57 90.57l18.113-18.114m54.344 18.114l18.113-18.114m-90.57 90.571l18.113-18.115m54.344 18.115l18.113-18.115M10.175 14.3L0 4.125M68.327-.006L82.633 14.3m72.457 0L140.789 0m86.757 14.3L213.252.006M300.003 14.3L285.709.006m72.459.002l10.714 10.714M28.29-.005v32.419l18.113 18.113m-36.029 0L28.29 32.414M100.747-.005v32.419l18.113 18.113m-36.029 0l17.916-18.113M173.194-.005v32.419l18.114 18.113M245.661-.015v32.429l18.114 18.113M318.118-.005v32.419l18.114 18.113m-180.954 0l17.916-18.113M28.29 68.642v36.229l18.113 18.114m-36.029-.001L28.29 104.87m72.457-36.228v36.229l18.113 18.114m-36.029-.001l17.916-18.114m72.447-36.228v36.229l18.114 18.114m54.353-54.343v36.229l18.114 18.114m54.343-54.343v36.229l18.114 18.114m-180.954-.001l17.916-18.114M28.29 141.098v36.229l18.113 18.115m-36.029-.001l17.916-18.115m72.457-36.228v36.229l18.113 18.115m-36.029-.001l17.916-18.115m72.447-36.228v36.229l18.114 18.115m54.353-54.344v36.229l18.114 18.115m54.343-54.344v36.229l18.114 18.115m-180.954-.001l17.916-18.115M28.29 213.556v36.229l18.113 18.114m-36.029-.001l17.916-18.114m72.457-36.228v36.229l18.113 18.114m-18.113-18.115l-17.916 18.114m90.363-54.342v36.229l18.114 18.114m54.353-54.343v36.229l18.114 18.114m54.343-54.343v36.229l18.114 18.114m-163.038-18.115l-17.916 18.114M28.29 286.011v36.229l18.113 18.114m-36.029 0L28.29 322.24m72.457-36.229v36.229l18.113 18.114m-36.029 0l17.916-18.114m72.447-36.229v36.229l18.114 18.114m126.81-54.343v36.229l18.114 18.114m-90.571-54.343v36.229l18.114 18.114m-90.581-18.115l-17.916 18.114M46.603 14.3L60.752-.006M119.06 14.3L133.208-.005M191.517 14.3L205.655.006M263.974 14.3L278.112.006M336.431 14.3L350.589-.014M0 76.58l10.175 10.176m54.344-54.342v36.229l18.114 18.113m54.343-54.342v36.229l18.114 18.113m54.343-54.342v36.229l18.113 18.113m54.344-54.342v36.229l18.113 18.113m54.344-54.342v36.229l14.529 14.529M46.603 86.756l17.916-18.113m54.541 18.113l17.916-18.113m54.541 18.113l17.916-18.113m54.541 18.113l17.916-18.113m54.541 18.113l17.916-18.113m-344.172 90.57L0 149.037m64.519-44.167v36.229l18.114 18.114m54.343-54.343v36.229l18.114 18.114m54.343-54.343v36.229l18.113 18.114m126.801-54.343v36.229l14.529 14.53M281.89 104.87v36.229l18.113 18.114m-253.4 0l17.916-18.114m54.541 18.114l17.916-18.114m54.541 18.114l17.916-18.114m126.998 18.114l17.916-18.114m-90.373 18.114l17.916-18.114M10.175 231.67L.002 221.497m64.517-44.171v36.229l18.114 18.115m54.343-54.344v36.229l18.114 18.115m54.343-54.344v36.229l18.113 18.115m54.344-54.344v36.229l18.113 18.115m54.344-54.344v36.229l14.529 14.531M46.603 231.67l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m-126.799 54.333l18.113-18.113m54.344 18.113l18.113-18.113m-90.57 90.579l18.113-18.113m54.344 18.113l18.113-18.113M10.175 304.117L.007 293.947m64.512-44.173v36.228l18.114 18.115m54.343-54.343v36.228l18.114 18.115m54.343-54.343v36.228l18.113 18.115m126.801-54.343v36.228l14.529 14.531m-86.986-50.759v36.228l18.113 18.115m-253.4 0l17.916-18.115m54.541 18.115l17.916-18.115m54.541 18.115l17.916-18.115m126.998 18.115l17.916-18.115m-90.373 18.115l17.916-18.115M64.519 322.239v36.228l10.406 10.406m62.051-46.634v36.228l10.406 10.406m62.051-46.634v36.228l10.405 10.406m134.509-46.634v36.228l10.405 10.406m-82.862-46.634v36.228l10.403 10.404m-238.064 0l10.29-10.404m62.166 10.404l10.291-10.404m62.165 10.406l10.292-10.406m62.165 10.406l10.292-10.406m62.165 10.406l10.292-10.406M.002 4.499"/>
                            </svg>';
                break;
        }

        return $ornament;
    }

    private function getOrnamentColor( $params ) {

        if ( ! empty( $params['ornament_color'] ) ) {
            $rgb_array = laurent_elated_hex2rgb( $params['ornament_color'] );
            $color = $rgb_array[0] . ',' . $rgb_array[1] . ',' . $rgb_array[2];
        } else {
            $color = '156,124,87';
        }

        return $color;
    }

    private function getOrnamentStyles( $params ) {
        $styles          = array();
        $ornament_width  = $params['ornament_width'];
        $ornament_height = $params['ornament_height'];
        $ornament_top    = $params['ornament_top'];
        $ornament_right  = $params['ornament_right'];

        if ( ! empty( $ornament_width ) ) {
            if (laurent_elated_string_ends_with($ornament_width, '%')) {
                $styles[] = 'width: ' . $ornament_width;
            } else {
                $styles[] = 'width: ' . $ornament_width . '%';
            }
        }

        if ( ! empty( $ornament_height ) ) {
            if (laurent_elated_string_ends_with($ornament_height, '%')) {
                $styles[] = 'height: ' . $ornament_height;
            } else {
                $styles[] = 'height: ' . $ornament_height . '%';
            }
        }

        if ( ! empty( $ornament_top ) ) {
            if (laurent_elated_string_ends_with($ornament_top, 'px') || laurent_elated_string_ends_with($ornament_top, '%') ) {
                $styles[] = 'top: ' . $ornament_top;
            } else {
                $styles[] = 'top: ' . $ornament_top . 'px';
            }
        }

        if ( ! empty( $ornament_right ) ) {
            if (laurent_elated_string_ends_with($ornament_right, 'px') || laurent_elated_string_ends_with($ornament_right, '%') ) {
                $styles[] = 'right: ' . $ornament_right;
            } else {
                $styles[] = 'right: ' . $ornament_right . 'px';
            }
        }

        return implode( ';', $styles );
    }
}