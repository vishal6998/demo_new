<?php
class LaurentCoreElementorReservationForm extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_reservation_form'; 
	}

	public function get_title() {
		return esc_html__( 'Reservation Form', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-reservation-form';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

	public function get_script_depends() {
		return array(
			'select2'
		);
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'open_table_id',
			[
				'label'     => esc_html__( 'OpenTable ID', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'open_table_layout',
			[
				'label'     => esc_html__( 'Layout', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'inline' => esc_html__( 'Inline', 'laurent-core'), 
					'block' => esc_html__( 'Block', 'laurent-core')
				),
				'default' => 'inline'
			]
		);

		$this->add_control(
			'open_table_skin',
			[
				'label'     => esc_html__( 'Form Fields Skin', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'light' => esc_html__( 'Light', 'laurent-core')
				),
				'default' => ''
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
        $params['holder_classes'] = $this->getHolderClasses( $params );

        echo laurent_core_get_shortcode_module_template_part('templates/reservation-form', 'reservation-form', '', $params);

	}

    private function getHolderClasses( $params ) {
        $holder_classes = array( 'eltdf-rf-holder' );

        $holder_classes[] = ! empty( $params['open_table_layout'] ) ? 'eltdf-rf-' . $params['open_table_layout'] : '';
        $holder_classes[] = ! empty( $params['open_table_skin'] ) ? 'eltdf-rf-holder-light' : '';

        return implode( ' ', $holder_classes );
    }

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorReservationForm() );