<?php
namespace LaurentCore\CPT\Shortcodes\ReservationForm;

use LaurentCore\Lib;

class ReservationForm implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'eltdf_reservation_form';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                    => esc_html__( 'Reservation Form', 'laurent-core' ),
                    'base'                    => $this->base,
                    'category'                => esc_html__( 'by LAURENT', 'laurent-core' ),
                    'icon'                    => 'icon-wpb-reservation-form extended-custom-icon',
                    'params'                  => array(
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__('OpenTable ID', 'laurent-core'),
                            'param_name'  => 'open_table_id',
                            'admin_label' => true
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Layout', 'laurent-core'),
                            'param_name' => 'open_table_layout',
                            'value'      => array(
                                esc_html__( 'Inline', 'laurent-core' ) => 'inline',
                                esc_html__( 'Block', 'laurent-core' )  => 'block'
                            )
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Form Fields Skin', 'laurent-core'),
                            'param_name' => 'open_table_skin',
                            'value'      => array(
                                esc_html__( 'Default', 'laurent-core' ) => '',
                                esc_html__( 'Light', 'laurent-core' )    => 'light'
                            )
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'open_table_id' => '',
            'open_table_layout' => 'inline',
            'open_table_skin' => ''
        );
        $params = shortcode_atts( $args, $atts );

        $params['holder_classes'] = $this->getHolderClasses( $params );

		wp_enqueue_script( 'countdown' );

        return laurent_core_get_shortcode_module_template_part('templates/reservation-form', 'reservation-form', '', $params);

    }

    private function getHolderClasses( $params ) {
        $holder_classes = array( 'eltdf-rf-holder' );

        $holder_classes[] = ! empty( $params['open_table_layout'] ) ? 'eltdf-rf-' . $params['open_table_layout'] : '';
        $holder_classes[] = ! empty( $params['open_table_skin'] ) ? 'eltdf-rf-holder-light' : '';

        return implode( ' ', $holder_classes );
    }
}
