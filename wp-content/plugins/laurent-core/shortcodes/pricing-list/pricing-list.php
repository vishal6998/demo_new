<?php
namespace LaurentCore\CPT\Shortcodes\PricingList;

use LaurentCore\Lib;

class PricingList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_pricing_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Pricing List', 'laurent-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by LAURENT', 'laurent-core' ),
					'icon'                      => 'icon-wpb-pricing-list extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'laurent-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'laurent-core' )
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'menu_items',
							'heading'    => esc_html__( 'Menu Items', 'laurent-core' ),
                            'params'     => array(
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'title',
                                    'heading'    => esc_html__( 'Title', 'laurent-core' ),
                                ),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'price',
                                    'heading'    => esc_html__( 'Price', 'laurent-core' ),
                                ),
                                array(
                                    'type'       => 'textarea',
                                    'param_name' => 'description',
                                    'heading'    => esc_html__( 'Description', 'laurent-core' ),
                                ),
                                array(
                                    'type'        => 'attach_image',
                                    'param_name'  => 'image',
                                    'heading'     => esc_html__( 'Image', 'laurent-core' ),
                                    'description' => esc_html__( 'Select image to appear next to title', 'laurent-core' )
                                ),
                            ),
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'title_tag',
                            'heading'     => esc_html__( 'Title Tag', 'laurent-core' ),
                            'value'       => array_flip( laurent_elated_get_title_tag( true ) ),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading'    => esc_html__( 'Title Color', 'laurent-core' ),
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'price_color',
                            'heading'    => esc_html__( 'Price Color', 'laurent-core' ),
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'menu_items'          => '',
            'title_tag'           => 'h6',
            'title_color'         => '',
            'price_color'         => '',
            'image'               => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
        $params['menu_items']        = json_decode( urldecode( $params['menu_items'] ), true );
		$params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']      = $this->getTitleStyles( $params );
        $params['price_styles']      = $this->getPriceStyles( $params );
		
		$html = laurent_core_get_shortcode_module_template_part( 'templates/pricing-list', 'pricing-list', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}

    private function getPriceStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['price_color'] ) ) {
            $styles[] = 'color: ' . $params['price_color'];
        }

        return implode( ';', $styles );
    }
}