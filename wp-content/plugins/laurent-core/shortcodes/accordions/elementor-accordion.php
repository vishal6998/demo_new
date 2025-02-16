<?php
class LaurentCoreElementorAccordion extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_accordion'; 
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-accordions';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

    public function get_script_depends() {
        return array('jquery-ui-accordion');
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
			'style',
			[
				'label'     => esc_html__( 'Style', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'accordion' => esc_html__( 'Accordion', 'laurent-core'), 
					'toggle' => esc_html__( 'Toggle', 'laurent-core')
				),
				'default' => 'accordion'
			]
		);

		$this->add_control(
			'layout',
			[
				'label'     => esc_html__( 'Layout', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'boxed' => esc_html__( 'Boxed', 'laurent-core'), 
					'simple' => esc_html__( 'Simple', 'laurent-core')
				),
				'default' => 'boxed'
			]
		);

		$this->add_control(
			'background_skin',
			[
				'label'     => esc_html__( 'Background Skin', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'white' => esc_html__( 'White', 'laurent-core')
				),
				'default' => '',
				'condition' => [
					'layout' => array( 'boxed' )
				]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter accordion section title', 'laurent-core' )
			]
		);

		$repeater->add_control(
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
				'default' => 'h5'
			]
		);

        $repeater->add_control(
            'text',
            [
                'label'       => esc_html__( 'Text', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

		$this->add_control(
			'accordion_tab',
			[
				'label'     => esc_html__( 'Accordion Tab', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields'     => $repeater->get_controls(),
				'title_field'     => esc_html__( 'Item', 'laurent-core' )
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['holder_classes'] = $this->getHolderClasses( $params );

        ?>

        <div class="eltdf-accordion-holder <?php echo esc_attr( $params['holder_classes'] ); ?> clearfix">
            <?php foreach ( $params['accordion_tab'] as $tab ) {
                $tab['content'] = $tab['text'];
                $tab['title_tag'] = ! empty( $tab['title_tag'] ) ? $tab['title_tag'] : 'h5';
                echo laurent_core_get_shortcode_module_template_part( 'templates/accordion-template', 'accordions', '', $tab );
            } ?>
        </div>
        <?php
	}

	private function getHolderClasses( $params ) {
		$holder_classes = array( 'eltdf-ac-default' );
		
		$holder_classes[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holder_classes[] = $params['style'] == 'toggle' ? 'eltdf-toggle' : 'eltdf-accordion';
		$holder_classes[] = ! empty( $params['layout'] ) ? 'eltdf-ac-' . esc_attr( $params['layout'] ) : '';
		$holder_classes[] = ! empty( $params['background_skin'] ) ? 'eltdf-' . esc_attr( $params['background_skin'] ) . '-skin' : '';
		
		return implode( ' ', $holder_classes );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorAccordion() );