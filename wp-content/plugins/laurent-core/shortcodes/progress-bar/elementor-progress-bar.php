<?php
class LaurentCoreElementorProgressBar extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_progress_bar'; 
	}

	public function get_title() {
		return esc_html__( 'Progress Bar', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-progress-bar';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

    public function get_script_depends() {
        return array(
            'counter'
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
			'percent',
			[
				'label'     => esc_html__( 'Percentage', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'percentage_type',
			[
				'label'     => esc_html__( 'Percentage Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'floating' => esc_html__( 'Floating', 'laurent-core')
				),
				'default' => '',
				'condition' => [
					'percent!' => ''
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
					'p' => esc_html__( 'p', 'laurent-core')
				),
				'default' => 'h6',
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
			'color_active',
			[
				'label'     => esc_html__( 'Active Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'color_inactive',
			[
				'label'     => esc_html__( 'Inactive Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['title_styles']       = $this->getTitleStyles( $params );
        $params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h6';
		$params['active_bar_style']   = $this->getActiveColor( $params );
		$params['inactive_bar_style'] = $this->getInactiveColor( $params );

        echo laurent_core_get_shortcode_module_template_part( 'templates/progress-bar-template', 'progress-bar', '', $params );
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['percentage_type'] ) ? 'eltdf-pb-percent-' . esc_attr( $params['percentage_type'] ) : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return $styles;
	}

	private function getActiveColor( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color_active'] ) ) {
			$styles[] = 'background-color: ' . $params['color_active'];
		}
		
		return $styles;
	}

	private function getInactiveColor( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color_inactive'] ) ) {
			$styles[] = 'background-color: ' . $params['color_inactive'];
		}
		
		return $styles;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorProgressBar() );