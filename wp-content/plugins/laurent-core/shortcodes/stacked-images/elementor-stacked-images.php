<?php
class LaurentCoreElementorStackedImages extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_stacked_images'; 
	}

	public function get_title() {
		return esc_html__( 'Stacked Images', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-stacked-images';
	}

	public function get_categories() {
		return [ 'elated' ];
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
			'foreground_image',
			[
				'label'     => esc_html__( 'Foreground Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'middle_image',
			[
				'label'     => esc_html__( 'Middle Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'background_image',
			[
				'label'     => esc_html__( 'Background Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'background_svg',
			[
				'label'     => esc_html__( 'Background SVG Path', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Add your SVG path to use instead of background image. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent-core' )
			]
		);

		$this->add_control(
			'stack_image_position',
			[
				'label'     => esc_html__( 'Stack Image Position', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'left' => esc_html__( 'Left Offset', 'laurent-core'), 
					'right' => esc_html__( 'Right Offset', 'laurent-core')
				),
				'default' => 'left'
			]
		);

		$this->add_control(
			'foreground_image_appear_effect',
			[
				'label'     => esc_html__( 'Foreground Image Appear Effect', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'none' => esc_html__( 'None', 'laurent-core'), 
					'from-top' => esc_html__( 'From Top', 'laurent-core'), 
					'from-left' => esc_html__( 'From Left', 'laurent-core'), 
					'from-right' => esc_html__( 'From Right', 'laurent-core')
				),
				'default' => 'none'
			]
		);

		$this->add_control(
			'middle_image_appear_effect',
			[
				'label'     => esc_html__( 'Middle Image Appear Effect', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'none' => esc_html__( 'None', 'laurent-core'), 
					'from-top' => esc_html__( 'From Top', 'laurent-core'), 
					'from-left' => esc_html__( 'From Left', 'laurent-core'), 
					'from-right' => esc_html__( 'From Right', 'laurent-core')
				),
				'default' => 'none'
			]
		);

		$this->add_control(
			'background_image_appear_effect',
			[
				'label'     => esc_html__( 'Background Image Appear Effect', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'none' => esc_html__( 'None', 'laurent-core'), 
					'from-top' => esc_html__( 'From Top', 'laurent-core'), 
					'from-left' => esc_html__( 'From Left', 'laurent-core'), 
					'from-right' => esc_html__( 'From Right', 'laurent-core')
				),
				'default' => 'none'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
        $params['foreground_image'] = !empty($params['foreground_image']) ? $params['foreground_image']['id'] : $params['foreground_image'];
        $params['middle_image']     = !empty($params['middle_image']) ? $params['middle_image']['id'] : $params['middle_image'];
        $params['background_image'] = !empty($params['background_image']) ? $params['background_image']['id'] : $params['background_image'];
		$params['holder_classes']   = $this->getHolderClasses( $params );
        $params['background_svg']          = base64_encode( urlencode( $params['background_svg'] ));

        echo laurent_core_get_shortcode_module_template_part( 'templates/stacked-images', 'stacked-images', '', $params );

	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['background_svg'] ) ? 'eltdf-background-svg' : '';
		$holderClasses[] = ! empty( $params['stack_image_position'] ) ? 'eltdf-si-position-' . $params['stack_image_position'] : '';
        $holderClasses[] = ! empty( $params['foreground_image_appear_effect'] ) ? 'eltdf-foreground-appear-' . $params['foreground_image_appear_effect'] : '';
        $holderClasses[] = ! empty( $params['middle_image_appear_effect'] ) ? 'eltdf-middle-appear-' . $params['middle_image_appear_effect'] : '';
        $holderClasses[] = ! empty( $params['background_image_appear_effect'] ) ? 'eltdf-background-appear-' . $params['background_image_appear_effect'] : '';
		
		return implode( ' ', $holderClasses );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorStackedImages() );