<?php
namespace LaurentCore\CPT\Shortcodes\StackedImages;

use LaurentCore\Lib;

class StackedImages implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_stacked_images';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Stacked Images', 'laurent-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by LAURENT', 'laurent-core' ),
					'icon'     => 'icon-wpb-stacked-images extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'laurent-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'laurent-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'foreground_image',
							'heading'    => esc_html__( 'Foreground Image', 'laurent-core' )
						),
                        array(
                            'type'       => 'attach_image',
                            'param_name' => 'middle_image',
                            'heading'    => esc_html__( 'Middle Image', 'laurent-core' )
                        ),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__( 'Background Image', 'laurent-core' )
						),
                        array(
                            'type'        => 'textarea_raw_html',
                            'param_name'  => 'background_svg',
                            'heading'     => esc_html__( 'Background SVG Path', 'laurent-core' ),
                            'description' => esc_html__( 'Add your SVG path to use instead of background image. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent-core' ),
                            'save_always' => true
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'stack_image_position',
							'heading'     => esc_html__( 'Stack Image Position', 'laurent-core' ),
							'value'       => array(
								esc_html__( 'Left Offset', 'laurent-core' )  => 'left',
								esc_html__( 'Right Offset', 'laurent-core' ) => 'right'
							),
							'save_always' => true,
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'foreground_image_appear_effect',
                            'heading'    => esc_html__( 'Foreground Image Appear Effect', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'None', 'laurent-core' ) => 'none',
                                esc_html__( 'From Top', 'laurent-core' ) => 'from-top',
                                esc_html__( 'From Left', 'laurent-core' )  => 'from-left',
                                esc_html__( 'From Right', 'laurent-core' ) => 'from-right',
                            ),
                            'dependency' => array( 'element' => 'foreground_image', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'middle_image_appear_effect',
                            'heading'    => esc_html__( 'Middle Image Appear Effect', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'None', 'laurent-core' ) => 'none',
                                esc_html__( 'From Top', 'laurent-core' ) => 'from-top',
                                esc_html__( 'From Left', 'laurent-core' )  => 'from-left',
                                esc_html__( 'From Right', 'laurent-core' ) => 'from-right',
                            ),
                            'dependency' => array( 'element' => 'middle_image', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'background_image_appear_effect',
                            'heading'    => esc_html__( 'Background Image Appear Effect', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'None', 'laurent-core' ) => 'none',
                                esc_html__( 'From Top', 'laurent-core' ) => 'from-top',
                                esc_html__( 'From Left', 'laurent-core' )  => 'from-left',
                                esc_html__( 'From Right', 'laurent-core' ) => 'from-right',
                            ),
                            'dependency' => array( 'element' => 'background_image', 'not_empty' => true )
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                   => '',
			'foreground_image'               => '',
            'middle_image'                   => '',
			'background_image'               => '',
			'background_svg'                 => '',
			'stack_image_position'           => 'left',
            'foreground_image_appear_effect' => 'none',
            'middle_image_appear_effect'     => 'none',
            'background_image_appear_effect' => 'none'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		
		$html = laurent_core_get_shortcode_module_template_part( 'templates/stacked-images', 'stacked-images', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['background_svg'] ) ? 'eltdf-background-svg' : '';
		$holderClasses[] = ! empty( $params['stack_image_position'] ) ? 'eltdf-si-position-' . $params['stack_image_position'] : 'eltdf-si-position-' . $args['stack_image_position'];
        $holderClasses[] = ! empty( $params['foreground_image_appear_effect'] ) ? 'eltdf-foreground-appear-' . $params['foreground_image_appear_effect'] : '';
        $holderClasses[] = ! empty( $params['middle_image_appear_effect'] ) ? 'eltdf-middle-appear-' . $params['middle_image_appear_effect'] : '';
        $holderClasses[] = ! empty( $params['background_image_appear_effect'] ) ? 'eltdf-background-appear-' . $params['background_image_appear_effect'] : '';
		
		return implode( ' ', $holderClasses );
	}
}