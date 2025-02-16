<?php
namespace LaurentCore\CPT\Shortcodes\SectionTitle;

use LaurentCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Section Title', 'laurent-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by LAURENT', 'laurent-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'laurent-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'laurent-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'laurent-core' ),
							'value'       => array(
								esc_html__( 'Default', 'laurent-core' ) => 'center',
								esc_html__( 'Left', 'laurent-core' )    => 'left',
								esc_html__( 'Center', 'laurent-core' )  => 'center',
								esc_html__( 'Right', 'laurent-core' )   => 'right'
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'laurent-core' )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'tagline',
                            'heading'     => esc_html__( 'Tagline', 'laurent-core' ),
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title',
                            'heading'     => esc_html__( 'Title', 'laurent-core' ),
                            'admin_label' => true
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'laurent-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'laurent-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'laurent-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'disable_decoration',
                            'heading'     => esc_html__( 'Disable Decoration Pattern', 'laurent-core' ),
                            'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
                            'save_always' => true,
                            'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
                            'group'       => esc_html__( 'Title Style', 'laurent-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'decoration_animation',
                            'heading'     => esc_html__( 'Enable Decoration Pattern Animation', 'laurent-core' ),
                            'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
                            'save_always' => true,
                            'dependency'  => array( 'element' => 'disable_decoration', 'value' => 'no' ),
                            'group'       => esc_html__( 'Title Style', 'laurent-core' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'title_wrap',
                            'heading'     => esc_html__( 'Enable Title Wrap', 'laurent-core' ),
                            'description' => esc_html__( 'If title has more than 1 word and decoration is too far from it, enable wrapping to move words to new line', 'laurent-core' ),
                            'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
                            'save_always' => true,
                            'dependency'  => array( 'element' => 'disable_decoration', 'value' => 'no' ),
                            'group'       => esc_html__( 'Title Style', 'laurent-core' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'laurent-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'laurent-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'laurent-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'laurent-core' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'laurent-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'laurent-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'laurent-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'laurent-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'laurent-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'laurent-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'laurent-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'laurent-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'laurent-core' ),
							'value'       => array_flip( laurent_elated_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'laurent-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'laurent-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'laurent-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'laurent-core' )
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'button_style',
                            'heading'     => esc_html__( 'Button Style', 'laurent-core' ),
                            'value'       => array(
                                esc_html__( 'Outline', 'laurent-core' )    => 'outline',
                                esc_html__( 'Simple', 'laurent-core' )     => 'simple',
                                esc_html__( 'Solid', 'laurent-core' )      => 'solid',
                            ),
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'laurent-core' ),
							'group'      => esc_html__( 'Button Style', 'laurent-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_target',
							'heading'    => esc_html__( 'Button Link Target', 'laurent-core' ),
							'value'      => array_flip( laurent_elated_get_link_target_array() ),
							'group'      => esc_html__( 'Button Style', 'laurent-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_color',
							'heading'    => esc_html__( 'Button Color', 'laurent-core' ),
							'group'      => esc_html__( 'Button Style', 'laurent-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_color',
							'heading'    => esc_html__( 'Button Hover Color', 'laurent-core' ),
							'group'      => esc_html__( 'Button Style', 'laurent-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px)', 'laurent-core' ),
							'group'      => esc_html__( 'Button Style', 'laurent-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'position'             => '',
			'holder_padding'       => '',
			'tagline'              => '',
			'title'                => '',
			'title_tag'            => 'h2',
			'title_color'          => '',
			'title_break_words'    => '',
			'disable_break_words'  => '',
			'disable_decoration'   => '',
			'decoration_animation' => '',
			'title_wrap'           => '',
			'text'                 => '',
			'text_tag'             => 'p',
			'text_color'           => '',
			'text_font_size'       => '',
			'text_line_height'     => '',
			'text_font_weight'     => '',
			'text_margin'          => '',
			'button_text'          => '',
			'button_style'         => 'outline',
			'button_link'          => '',
			'button_target'        => '_self',
			'button_color'         => '',
			'button_hover_color'   => '',
			'button_top_margin'    => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['title']             = $this->getModifiedTitle( $params );
		$params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']      = $this->getTitleStyles( $params );
		$params['text_tag']          = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']       = $this->getTextStyles( $params );
		$params['button_parameters'] = $this->getButtonParameters( $params );
		
		$html = laurent_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'eltdf-st-disable-title-break' : '';
		$holderClasses[] = $params['title_wrap'] === 'yes' ? 'eltdf-st-title-wrapped' : '';
		$holderClasses[] = $params['decoration_animation'] === 'yes' ? 'eltdf-st-decor-animation' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) ) {
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_break_words ) ) {
				$title_break_words = intval( $title_break_words );
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . laurent_elated_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . laurent_elated_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . laurent_elated_filter_px( $params['text_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonParameters( $params ) {
		$button_params = array();
		
		if ( ! empty( $params['button_text'] ) ) {
			$button_params['text'] = $params['button_text'];
			$button_params['type'] = $params['button_style'];
			$button_params['link'] = ! empty( $params['button_link'] ) ? $params['button_link'] : '#';
			$button_params['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';
			
			if ( ! empty( $params['button_color'] ) ) {
				$button_params['color'] = $params['button_color'];
			}
			
			if ( ! empty( $params['button_hover_color'] ) ) {
				$button_params['hover_color'] = $params['button_hover_color'];
			}
			
			if ( $params['button_top_margin'] !== '' ) {
				$button_params['margin'] = intval( $params['button_top_margin'] ) . 'px 0 0';
			}
		}
		
		return $button_params;
	}
}