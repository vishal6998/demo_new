<?php
class LaurentCoreElementorCountdown extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_countdown'; 
	}

	public function get_title() {
		return esc_html__( 'Countdown', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-countdown';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

    public function get_script_depends() {
        return array(
            'jquery-plugin',
            'countdown'
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
			'skin',
			[
				'label'     => esc_html__( 'Skin', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'eltdf-light-skin' => esc_html__( 'Light', 'laurent-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'year',
			[
				'label'     => esc_html__( 'Year', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'2018' => esc_html__( '2018', 'laurent-core'), 
					'2019' => esc_html__( '2019', 'laurent-core'), 
					'2020' => esc_html__( '2020', 'laurent-core'), 
					'2021' => esc_html__( '2021', 'laurent-core'), 
					'2022' => esc_html__( '2022', 'laurent-core')
				),
				'default' => '2018'
			]
		);

		$this->add_control(
			'month',
			[
				'label'     => esc_html__( 'Month', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( 'January', 'laurent-core'), 
					'2' => esc_html__( 'February', 'laurent-core'), 
					'3' => esc_html__( 'March', 'laurent-core'), 
					'4' => esc_html__( 'April', 'laurent-core'), 
					'5' => esc_html__( 'May', 'laurent-core'), 
					'6' => esc_html__( 'June', 'laurent-core'), 
					'7' => esc_html__( 'July', 'laurent-core'), 
					'8' => esc_html__( 'August', 'laurent-core'), 
					'9' => esc_html__( 'September', 'laurent-core'), 
					'10' => esc_html__( 'October', 'laurent-core'), 
					'11' => esc_html__( 'November', 'laurent-core'), 
					'12' => esc_html__( 'December', 'laurent-core')
				),
				'default' => '1'
			]
		);

		$this->add_control(
			'day',
			[
				'label'     => esc_html__( 'Day', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'1' => esc_html__( '1', 'laurent-core'), 
					'2' => esc_html__( '2', 'laurent-core'), 
					'3' => esc_html__( '3', 'laurent-core'), 
					'4' => esc_html__( '4', 'laurent-core'), 
					'5' => esc_html__( '5', 'laurent-core'), 
					'6' => esc_html__( '6', 'laurent-core'), 
					'7' => esc_html__( '7', 'laurent-core'), 
					'8' => esc_html__( '8', 'laurent-core'), 
					'9' => esc_html__( '9', 'laurent-core'), 
					'10' => esc_html__( '10', 'laurent-core'), 
					'11' => esc_html__( '11', 'laurent-core'), 
					'12' => esc_html__( '12', 'laurent-core'), 
					'13' => esc_html__( '13', 'laurent-core'), 
					'14' => esc_html__( '14', 'laurent-core'), 
					'15' => esc_html__( '15', 'laurent-core'), 
					'16' => esc_html__( '16', 'laurent-core'), 
					'17' => esc_html__( '17', 'laurent-core'), 
					'18' => esc_html__( '18', 'laurent-core'), 
					'19' => esc_html__( '19', 'laurent-core'), 
					'20' => esc_html__( '20', 'laurent-core'), 
					'21' => esc_html__( '21', 'laurent-core'), 
					'22' => esc_html__( '22', 'laurent-core'), 
					'23' => esc_html__( '23', 'laurent-core'), 
					'24' => esc_html__( '24', 'laurent-core'), 
					'25' => esc_html__( '25', 'laurent-core'), 
					'26' => esc_html__( '26', 'laurent-core'), 
					'27' => esc_html__( '27', 'laurent-core'), 
					'28' => esc_html__( '28', 'laurent-core'), 
					'29' => esc_html__( '29', 'laurent-core'), 
					'30' => esc_html__( '30', 'laurent-core'), 
					'31' => esc_html__( '31', 'laurent-core')
				),
				'default' => '1'
			]
		);

		$this->add_control(
			'hour',
			[
				'label'     => esc_html__( 'Hour', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'0' => esc_html__( '0', 'laurent-core'), 
					'1' => esc_html__( '1', 'laurent-core'), 
					'2' => esc_html__( '2', 'laurent-core'), 
					'3' => esc_html__( '3', 'laurent-core'), 
					'4' => esc_html__( '4', 'laurent-core'), 
					'5' => esc_html__( '5', 'laurent-core'), 
					'6' => esc_html__( '6', 'laurent-core'), 
					'7' => esc_html__( '7', 'laurent-core'), 
					'8' => esc_html__( '8', 'laurent-core'), 
					'9' => esc_html__( '9', 'laurent-core'), 
					'10' => esc_html__( '10', 'laurent-core'), 
					'11' => esc_html__( '11', 'laurent-core'), 
					'12' => esc_html__( '12', 'laurent-core'), 
					'13' => esc_html__( '13', 'laurent-core'), 
					'14' => esc_html__( '14', 'laurent-core'), 
					'15' => esc_html__( '15', 'laurent-core'), 
					'16' => esc_html__( '16', 'laurent-core'), 
					'17' => esc_html__( '17', 'laurent-core'), 
					'18' => esc_html__( '18', 'laurent-core'), 
					'19' => esc_html__( '19', 'laurent-core'), 
					'20' => esc_html__( '20', 'laurent-core'), 
					'21' => esc_html__( '21', 'laurent-core'), 
					'22' => esc_html__( '22', 'laurent-core'), 
					'23' => esc_html__( '23', 'laurent-core'), 
					'24' => esc_html__( '24', 'laurent-core')
				),
				'default' => '0'
			]
		);

		$this->add_control(
			'minute',
			[
				'label'     => esc_html__( 'Minute', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'0' => esc_html__( '0', 'laurent-core'), 
					'1' => esc_html__( '1', 'laurent-core'), 
					'2' => esc_html__( '2', 'laurent-core'), 
					'3' => esc_html__( '3', 'laurent-core'), 
					'4' => esc_html__( '4', 'laurent-core'), 
					'5' => esc_html__( '5', 'laurent-core'), 
					'6' => esc_html__( '6', 'laurent-core'), 
					'7' => esc_html__( '7', 'laurent-core'), 
					'8' => esc_html__( '8', 'laurent-core'), 
					'9' => esc_html__( '9', 'laurent-core'), 
					'10' => esc_html__( '10', 'laurent-core'), 
					'11' => esc_html__( '11', 'laurent-core'), 
					'12' => esc_html__( '12', 'laurent-core'), 
					'13' => esc_html__( '13', 'laurent-core'), 
					'14' => esc_html__( '14', 'laurent-core'), 
					'15' => esc_html__( '15', 'laurent-core'), 
					'16' => esc_html__( '16', 'laurent-core'), 
					'17' => esc_html__( '17', 'laurent-core'), 
					'18' => esc_html__( '18', 'laurent-core'), 
					'19' => esc_html__( '19', 'laurent-core'), 
					'20' => esc_html__( '20', 'laurent-core'), 
					'21' => esc_html__( '21', 'laurent-core'), 
					'22' => esc_html__( '22', 'laurent-core'), 
					'23' => esc_html__( '23', 'laurent-core'), 
					'24' => esc_html__( '24', 'laurent-core'), 
					'25' => esc_html__( '25', 'laurent-core'), 
					'26' => esc_html__( '26', 'laurent-core'), 
					'27' => esc_html__( '27', 'laurent-core'), 
					'28' => esc_html__( '28', 'laurent-core'), 
					'29' => esc_html__( '29', 'laurent-core'), 
					'30' => esc_html__( '30', 'laurent-core'), 
					'31' => esc_html__( '31', 'laurent-core'), 
					'32' => esc_html__( '32', 'laurent-core'), 
					'33' => esc_html__( '33', 'laurent-core'), 
					'34' => esc_html__( '34', 'laurent-core'), 
					'35' => esc_html__( '35', 'laurent-core'), 
					'36' => esc_html__( '36', 'laurent-core'), 
					'37' => esc_html__( '37', 'laurent-core'), 
					'38' => esc_html__( '38', 'laurent-core'), 
					'39' => esc_html__( '39', 'laurent-core'), 
					'40' => esc_html__( '40', 'laurent-core'), 
					'41' => esc_html__( '41', 'laurent-core'), 
					'42' => esc_html__( '42', 'laurent-core'), 
					'43' => esc_html__( '43', 'laurent-core'), 
					'44' => esc_html__( '44', 'laurent-core'), 
					'45' => esc_html__( '45', 'laurent-core'), 
					'46' => esc_html__( '46', 'laurent-core'), 
					'47' => esc_html__( '47', 'laurent-core'), 
					'48' => esc_html__( '48', 'laurent-core'), 
					'49' => esc_html__( '49', 'laurent-core'), 
					'50' => esc_html__( '50', 'laurent-core'), 
					'51' => esc_html__( '51', 'laurent-core'), 
					'52' => esc_html__( '52', 'laurent-core'), 
					'53' => esc_html__( '53', 'laurent-core'), 
					'54' => esc_html__( '54', 'laurent-core'), 
					'55' => esc_html__( '55', 'laurent-core'), 
					'56' => esc_html__( '56', 'laurent-core'), 
					'57' => esc_html__( '57', 'laurent-core'), 
					'58' => esc_html__( '58', 'laurent-core'), 
					'59' => esc_html__( '59', 'laurent-core'), 
					'60' => esc_html__( '60', 'laurent-core')
				),
				'default' => '0'
			]
		);

		$this->add_control(
			'month_label',
			[
				'label'     => esc_html__( 'Month Label', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'day_label',
			[
				'label'     => esc_html__( 'Day Label', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'hour_label',
			[
				'label'     => esc_html__( 'Hour Label', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'minute_label',
			[
				'label'     => esc_html__( 'Minute Label', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'second_label',
			[
				'label'     => esc_html__( 'Second Label', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'digit_font_size',
			[
				'label'     => esc_html__( 'Digit Font Size (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'label_font_size',
			[
				'label'     => esc_html__( 'Label Font Size (px)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$params['id']             = mt_rand( 1000, 9999 );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );

        echo laurent_core_get_shortcode_module_template_part( 'templates/countdown', 'countdown', '', $params );

	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getHolderData( $params ) {
		$holderData = array();
		
		$holderData['data-year']         = ! empty( $params['year'] ) ? $params['year'] : '';
		$holderData['data-month']        = ! empty( $params['month'] ) ? $params['month'] : '';
		$holderData['data-day']          = ! empty( $params['day'] ) ? $params['day'] : '';
		$holderData['data-hour']         = $params['hour'] !== '' ? $params['hour'] : '';
		$holderData['data-minute']       = $params['minute'] !== '' ? $params['minute'] : '';
		$holderData['data-month-label']  = ! empty( $params['month_label'] ) ? $params['month_label'] : esc_html__( 'Months', 'laurent-core' );
		$holderData['data-day-label']    = ! empty( $params['day_label'] ) ? $params['day_label'] : esc_html__( 'Days', 'laurent-core' );
		$holderData['data-hour-label']   = ! empty( $params['hour_label'] ) ? $params['hour_label'] : esc_html__( 'Hours', 'laurent-core' );
		$holderData['data-minute-label'] = ! empty( $params['minute_label'] ) ? $params['minute_label'] : esc_html__( 'Minutes', 'laurent-core' );
		$holderData['data-second-label'] = ! empty( $params['second_label'] ) ? $params['second_label'] : esc_html__( 'Seconds', 'laurent-core' );
		$holderData['data-digit-size']   = ! empty( $params['digit_font_size'] ) ? $params['digit_font_size'] : '';
		$holderData['data-label-size']   = ! empty( $params['label_font_size'] ) ? $params['label_font_size'] : '';
		
		return $holderData;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorCountdown() );