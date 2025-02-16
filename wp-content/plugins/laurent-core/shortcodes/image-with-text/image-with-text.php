<?php
namespace LaurentCore\CPT\Shortcodes\ImageWithText;

use LaurentCore\Lib;

class ImageWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_image_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image With Text', 'laurent-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by LAURENT', 'laurent-core' ),
					'icon'                      => 'icon-wpb-image-with-text extended-custom-icon',
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
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'laurent-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_behavior',
							'heading'    => esc_html__( 'Image Behavior', 'laurent-core' ),
							'value'      => array(
								esc_html__( 'None', 'laurent-core' )             => '',
                                esc_html__( 'Scrolling Image', 'laurent-core' )  => 'scrolling-image',
								esc_html__( 'Open Lightbox', 'laurent-core' )    => 'lightbox',
								esc_html__( 'Open Custom Link', 'laurent-core' ) => 'custom-link',
								esc_html__( 'Zoom', 'laurent-core' )             => 'zoom',
								esc_html__( 'Grayscale', 'laurent-core' )        => 'grayscale'
							)
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'scrolling_direction',
                            'heading'    => esc_html__( 'Scrolling Direction', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'Vertical', 'laurent-core' )   => 'vertical',
                                esc_html__( 'Horizontal', 'laurent-core' ) => 'horizontal',
                            ),
                            'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'scrolling-image' ) ),
                            'save_always' => true
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_link',
							'heading'    => esc_html__( 'Custom Link', 'laurent-core' ),
							'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'custom-link', 'scrolling-image' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'laurent-core' ),
							'value'      => array_flip( laurent_elated_get_link_target_array() ),
							'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'custom-link', 'scrolling-image' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'laurent-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_title_tag( true, array( 'span' => 'span' ) )),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'laurent-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'laurent-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'laurent-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'laurent-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'laurent-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'bottom_buttons',
							'heading'     => esc_html__( 'Enable Bottom Double/Triple Custom Link Functionality', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_yes_no_select_array( false, false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_button_one_link',
							'heading'    => esc_html__( 'First Bottom Link', 'laurent-core' ),
							'dependency' => array( 'element' => 'bottom_buttons', 'value' => 'yes' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_button_one_label',
							'heading'    => esc_html__( 'First Bottom Link Label', 'laurent-core' ),
							'dependency' => array( 'element' => 'bottom_buttons', 'value' => 'yes' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_button_two_link',
							'heading'    => esc_html__( 'Second Bottom Link', 'laurent-core' ),
							'dependency' => array( 'element' => 'bottom_buttons', 'value' => 'yes' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_button_two_label',
							'heading'    => esc_html__( 'Second Bottom Link Label', 'laurent-core' ),
							'dependency' => array( 'element' => 'bottom_buttons', 'value' => 'yes' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_button_three_link',
							'heading'    => esc_html__( 'Third Bottom Link', 'laurent-core' ),
							'dependency' => array( 'element' => 'bottom_buttons', 'value' => 'yes' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'bottom_button_three_label',
							'heading'    => esc_html__( 'Third Bottom Link Label', 'laurent-core' ),
							'dependency' => array( 'element' => 'bottom_buttons', 'value' => 'yes' )
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
			'enable_image_shadow' => 'no',
			'image_behavior'      => '',
			'scrolling_direction' => '',
			'custom_link'         => '',
			'custom_link_target'  => '_self',
			'title'               => '',
			'title_tag'           => 'span',
			'title_color'         => '',
			'title_top_margin'    => '',
			'text'                => '',
			'text_color'          => '',
			'text_top_margin'     => '',
			'bottom_buttons'      => 'no',
			'bottom_button_one_link' => '',
			'bottom_button_one_label' => '',
			'bottom_button_two_link' => '',
			'bottom_button_two_label' => '',
			'bottom_button_three_link' => '',
			'bottom_button_three_label' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		$params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['text_styles']        = $this->getTextStyles( $params );

		$html = laurent_core_get_shortcode_module_template_part( 'templates/image-with-text', 'image-with-text', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'eltdf-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'eltdf-image-behavior-' . $params['image_behavior'] : '';
        $holderClasses[] = ! empty( $params['scrolling_direction'] ) ? 'eltdf-scrolling-' . $params['scrolling_direction'] : '';
		$holderClasses[] = $params['bottom_buttons'] === 'yes' ? 'eltdf-has-bottom-buttons' : '';
		$holderClasses[] = ! empty( $params['bottom_button_one_link'] ) && ! empty( $params['bottom_button_two_link'] ) && ! empty( $params['bottom_button_three_link'] ) ? 'eltdf-with-three-bottom-buttons' : '';
		return implode( ' ', $holderClasses );
	}
	
	private function getImage( $params ) {
		$image = array();

		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
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
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . laurent_elated_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . laurent_elated_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}