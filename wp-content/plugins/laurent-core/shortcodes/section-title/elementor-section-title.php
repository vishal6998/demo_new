<?php
class LaurentCoreElementorSectionTitle extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_section_title'; 
	}

	public function get_title() {
		return esc_html__( 'Section Title', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-section-title';
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
			'position',
			[
				'label'     => esc_html__( 'Horizontal Position', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'center' => esc_html__( 'Center', 'laurent-core'), 
					'left' => esc_html__( 'Left', 'laurent-core'), 
					'right' => esc_html__( 'Right', 'laurent-core'), 
				),
				'default' => 'center'
			]
		);

		$this->add_control(
			'holder_padding',
			[
				'label'     => esc_html__( 'Holder Side Padding (px or %)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'tagline',
			[
				'label'     => esc_html__( 'Tagline', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
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
			'text',
			[
				'label'     => esc_html__( 'Text', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'     => esc_html__( 'Button Text', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'     => esc_html__( 'Button Style', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'outline' => esc_html__( 'Outline', 'laurent-core'), 
					'simple' => esc_html__( 'Simple', 'laurent-core'), 
					'solid' => esc_html__( 'Solid', 'laurent-core')
				),
				'default' => 'outline'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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
					'h6' => esc_html__( 'h6', 'laurent-core')
				),
				'default' => 'h2',
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
			'disable_decoration',
			[
				'label'     => esc_html__( 'Disable Decoration Pattern', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'decoration_animation',
			[
				'label'     => esc_html__( 'Enable Decoration Pattern Animation', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'disable_decoration' => array( 'no' )
				]
			]
		);

		$this->add_control(
			'title_wrap',
			[
				'label'     => esc_html__( 'Enable Title Wrap', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'If title has more than 1 word and decoration is too far from it, enable wrapping to move words to new line', 'laurent-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'disable_decoration' => array( 'no' )
				]
			]
		);

		$this->add_control(
			'title_break_words',
			[
				'label'     => esc_html__( 'Position of Line Break', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter &quot;3&quot;)', 'laurent-core' ),
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'disable_break_words',
			[
				'label'     => esc_html__( 'Disable Line Break for Smaller Screens', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text_style',
			[
				'label' => esc_html__( 'Text Style', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'text_tag',
			[
				'label'     => esc_html__( 'Text Tag', 'laurent-core' ),
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
				'default' => 'p',
				'condition' => [
					'text!' => ''
				]
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

		$this->add_control(
			'text_font_size',
			[
				'label'     => esc_html__( 'Text Font Size (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'text_line_height',
			[
				'label'     => esc_html__( 'Text Line Height (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'text_font_weight',
			[
				'label'     => esc_html__( 'Text Font Weight', 'laurent-core' ),
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
					'text!' => ''
				]
			]
		);

		$this->add_control(
			'text_margin',
			[
				'label'     => esc_html__( 'Text Top Margin (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'text!' => ''
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Button Style', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'button_link',
			[
				'label'     => esc_html__( 'Button Link', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'button_target',
			[
				'label'     => esc_html__( 'Button Link Target', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'laurent-core'), 
					'_blank' => esc_html__( 'New Window', 'laurent-core')
				),
				'default' => '_self'
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Button Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Button Hover Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'button_top_margin',
			[
				'label'     => esc_html__( 'Button Top Margin (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['title']             = $this->getModifiedTitle( $params );
		$params['title_styles']      = $this->getTitleStyles( $params );
        $params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h2';
        $params['text_tag']          = ! empty( $params['text_tag'] ) ? $params['text_tag'] : 'p';
		$params['text_styles']       = $this->getTextStyles( $params );
		$params['button_parameters'] = $this->getButtonParameters( $params );

        echo laurent_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );

	}

	private function getHolderClasses( $params ) {
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
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorSectionTitle() );