<?php
class LaurentCoreElementorCounter extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_counter'; 
	}

	public function get_title() {
		return esc_html__( 'Counter', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-counter';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

    public function get_script_depends() {
        return array(
            'counter',
            'absoluteCounter'
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
			'custom_class',
			[
				'label'     => esc_html__( 'Custom CSS Class', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'laurent-core' )
			]
		);

		$this->add_control(
			'type',
			[
				'label'     => esc_html__( 'Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'eltdf-zero-counter' => esc_html__( 'Zero Counter', 'laurent-core'), 
					'eltdf-random-counter' => esc_html__( 'Random Counter', 'laurent-core')
				),
				'default' => 'eltdf-zero-counter'
			]
		);

		$this->add_control(
			'digit',
			[
				'label'     => esc_html__( 'Digit', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'digit_font_size',
			[
				'label'     => esc_html__( 'Digit Font Size (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'digit!' => ''
				]
			]
		);

		$this->add_control(
			'digit_color',
			[
				'label'     => esc_html__( 'Digit Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'digit!' => ''
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'h1' => esc_html__( 'h1', 'laurent-core'), 
					'h2' => esc_html__( 'h2', 'laurent-core'), 
					'h3' => esc_html__( 'h3', 'laurent-core'), 
					'h4' => esc_html__( 'h4', 'laurent-core'), 
					'h5' => esc_html__( 'h5', 'laurent-core'), 
					'h6' => esc_html__( 'h6', 'laurent-core'), 
					'span' => esc_html__( 'span', 'laurent-core')
				),
				'default' => 'span',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_font_weight',
			[
				'label'     => esc_html__( 'Title Font Weight', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'100' => esc_html__( '100 Thin', 'laurent-core'), 
					'200' => esc_html__( '200 Thin-Light', 'laurent-core'), 
					'300' => esc_html__( '300 Light', 'laurent-core'), 
					'400' => esc_html__( '400 Normal', 'laurent-core'), 
					'500' => esc_html__( '500 Medium', 'laurent-core'), 
					'600' => esc_html__( '600 Semi-Bold', 'laurent-core'), 
					'700' => esc_html__( '700 Bold', 'laurent-core'), 
					'800' => esc_html__( '800 Extra-Bold', 'laurent-core'), 
					'900' => esc_html__( '900 Ultra-Bold', 'laurent-core')
				),
				'default' => '',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'text',
			[
				'label'     => esc_html__( 'Text', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'text!' => ''
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['counter_styles']       = $this->getCounterStyles( $params );
		$params['counter_title_styles'] = $this->getCounterTitleStyles( $params );
		$params['counter_text_styles']  = $this->getCounterTextStyles( $params );
        $params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'span';

        echo laurent_core_get_shortcode_module_template_part( 'templates/counter', 'counter', '', $params );

	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getCounterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['digit_font_size'] ) ) {
			$styles[] = 'font-size: ' . laurent_elated_filter_px( $params['digit_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['digit_color'] ) ) {
			$styles[] = 'color: ' . $params['digit_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getCounterTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( ! empty( $params['title_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['title_font_weight'];
		}
		
		return implode( ';', $styles );
	}

	private function getCounterTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		return implode( ';', $styles );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorCounter() );