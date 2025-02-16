<?php
namespace LaurentCore\CPT\Shortcodes\VerticalSplitSliderContentItem;

use LaurentCore\Lib;

class VerticalSplitSliderContentItem implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'eltdf_vertical_split_slider_content_item';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'      => esc_html__( 'Slide Content Item', 'laurent-core' ),
                    'base'      => $this->base,
                    'icon'      => 'icon-wpb-vertical-split-slider-content-item extended-custom-icon',
                    'category'  => esc_html__( 'by LAURENT', 'laurent-core' ),
                    'as_parent' => array( 'except' => 'vc_row' ),
                    'as_child'  => array( 'only' => 'eltdf_vertical_split_slider_left_panel, eltdf_vertical_split_slider_right_panel' ),
                    'js_view'   => 'VcColumnView',
                    'params'    => array(
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'background_color',
                            'heading'    => esc_html__( 'Background Color', 'laurent-core' )
                        ),
                        array(
                            'type'       => 'attach_image',
                            'param_name' => 'background_image',
                            'heading'    => esc_html__( 'Background Image', 'laurent-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding',
                            'heading'     => esc_html__( 'Padding', 'laurent-core' ),
                            'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding_laptop',
                            'heading'     => esc_html__( 'Padding for Laptops (1440px and under)', 'laurent-core' ),
                            'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'item_padding', 'not_empty' => true ),
                            'group'       => esc_html__( 'Responsive Padding', 'laurent-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding_tablet',
                            'heading'     => esc_html__( 'Padding for Tablets (1024px and under)', 'laurent-core' ),
                            'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'item_padding', 'not_empty' => true ),
                            'group'       => esc_html__( 'Responsive Padding', 'laurent-core' )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding_phone',
                            'heading'     => esc_html__( 'Padding for Phones (480px and under)', 'laurent-core' ),
                            'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                            'dependency'  => array( 'element' => 'item_padding', 'not_empty' => true ),
                            'group'       => esc_html__( 'Responsive Padding', 'laurent-core' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'alignment',
                            'heading'    => esc_html__( 'Content Alignment', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'Default', 'laurent-core' ) => '',
                                esc_html__( 'Left', 'laurent-core' )    => 'left',
                                esc_html__( 'Right', 'laurent-core' )   => 'right',
                                esc_html__( 'Center', 'laurent-core' )  => 'center'
                            )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'header_style',
                            'heading'    => esc_html__( 'Header/Bullets Style', 'laurent-core' ),
                            'value'      => array(
                                esc_html__( 'Default', 'laurent-core' ) => '',
                                esc_html__( 'Light', 'laurent-core' )   => 'light',
                                esc_html__( 'Dark', 'laurent-core' )    => 'dark'
                            )
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'background_color'    => '',
            'background_image'    => '',
            'item_padding'        => '',
            'item_padding_laptop' => '',
            'item_padding_tablet' => '',
            'item_padding_phone'  => '',
            'alignment'           => 'left',
            'header_style'        => ''
        );
        $params = shortcode_atts( $args, $atts );

        $params['holder_rand_class'] = 'eltdf-vss-' . mt_rand( 1000, 10000 );
        $params['holder_classes']    = $this->getHolderClasses( $params );
        $params['content_data']      = $this->getContentData( $params );
        $params['content_style']     = $this->getContentStyles( $params );
        $params['content']           = $content;

        $html = laurent_core_get_shortcode_module_template_part( 'templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $params );

        return $html;
    }

    private function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';

        return implode( ' ', $holderClasses );
    }

    private function getContentData( $params ) {
        $data = array();
        $data['data-item-class'] = $params['holder_rand_class'];

        if ( ! empty( $params['header_style'] ) ) {
            $data['data-header-style'] = $params['header_style'];
        }

        if ( $params['item_padding_laptop'] !== '' ) {
            $data['data-item-padding-1440'] = $params['item_padding_laptop'];
        }

        if ( $params['item_padding_tablet'] !== '' ) {
            $data['data-item-padding-1024'] = $params['item_padding_tablet'];
        }

        if ( $params['item_padding_phone'] !== '' ) {
            $data['data-item-padding-480'] = $params['item_padding_phone'];
        }

        return $data;
    }

    private function getContentStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['background_color'] ) ) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        if ( ! empty( $params['background_image'] ) ) {
            $url      = wp_get_attachment_url( $params['background_image'] );
            $styles[] = 'background-image: url(' . $url . ')';
        }

        if ( ! empty( $params['item_padding'] ) ) {
            $styles[] = 'padding: ' . $params['item_padding'];
        }

        if ( ! empty( $params['alignment'] ) ) {
            $styles[] = 'text-align: ' . $params['alignment'];
        }

        return implode( ';', $styles );
    }
}