<?php
class LaurentCoreElementorVerticalSplitSlider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_vertical_split_slider'; 
	}

	public function get_title() {
		return esc_html__( 'Vertical Split Slider', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-vertical-split-slider';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

    public function get_script_depends() {
        return array(
            'multiscroll'
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
			'enable_scrolling_animation',
			[
				'label'     => esc_html__( 'Enable Scrolling Animation', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);


		$this->end_controls_section();

        $this->start_controls_section(
            'left_sliding_panel',
            [
                'label' => esc_html__( 'Left Sliding Panel', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater1->add_control(
            'background_image',
            [
                'label' => esc_html__( 'Background Image', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater1->add_control(
            'item_padding',
            [
                'label'       => esc_html__( 'Padding', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' )
            ]
        );

        $repeater1->add_control(
            'item_padding_laptop',
            [
                'label'       => esc_html__( 'Padding for Laptops (1440px and under)', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                'condition' => [
                    'item_padding!' => ''
                ]
            ]
        );

        $repeater1->add_control(
            'item_padding_tablet',
            [
                'label'       => esc_html__( 'Padding for Tablets (1024px and under)', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                'condition' => [
                    'item_padding!' => ''
                ]
            ]
        );

        $repeater1->add_control(
            'item_padding_phone',
            [
                'label'       => esc_html__( 'Padding for Phones (480px and under)', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                'condition' => [
                    'item_padding!' => ''
                ]
            ]
        );

        $repeater1->add_control(
            'alignment',
            [
                'label'       => esc_html__( 'Content Alignment', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__( 'Default', 'laurent-core' ),
                    'left'   => esc_html__( 'Left', 'laurent-core' ),
                    'right'  => esc_html__( 'Right', 'laurent-core' ),
                    'center' => esc_html__( 'Center', 'laurent-core' ),
                ],
            ]
        );

        $repeater1->add_control(
            'header_style',
            [
                'label'       => esc_html__( 'Header/Bullets Style', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''      => esc_html__( 'Default', 'laurent-core' ),
                    'light' => esc_html__( 'Light', 'laurent-core' ),
                    'dark'  => esc_html__( 'Dark', 'laurent-core' )
                ],
            ]
        );

        laurent_core_generate_elementor_templates_control( $repeater1 );

        $this->add_control(
            'left_slide_content_item',
            [
                'label'       => esc_html__( 'Left Slide Content Items', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater1->get_controls(),
                'title_field' => esc_html__( 'Left Slide Content Item' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'right_sliding_panel',
            [
                'label' => esc_html__( 'Right Sliding Panel', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater2 = new \Elementor\Repeater();

        $repeater2->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::COLOR,
            ]
        );

        $repeater2->add_control(
            'background_image',
            [
                'label' => esc_html__( 'Background Image', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater2->add_control(
            'item_padding',
            [
                'label'       => esc_html__( 'Padding', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' )
            ]
        );

        $repeater2->add_control(
            'item_padding_laptop',
            [
                'label'       => esc_html__( 'Padding for Laptops (1440px and under)', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                'condition' => [
                    'item_padding!' => ''
                ]
            ]
        );

        $repeater2->add_control(
            'item_padding_tablet',
            [
                'label'       => esc_html__( 'Padding for Tablets (1024px and under)', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                'condition' => [
                    'item_padding!' => ''
                ]
            ]
        );

        $repeater2->add_control(
            'item_padding_phone',
            [
                'label'       => esc_html__( 'Padding for Phones (480px and under)', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'description' => esc_html__( 'Insert padding in format: Top Right Bottom Left (e.g. 0px 0px 1px 0px)', 'laurent-core' ),
                'condition' => [
                    'item_padding!' => ''
                ]
            ]
        );

        $repeater2->add_control(
            'alignment',
            [
                'label'       => esc_html__( 'Content Alignment', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''       => esc_html__( 'Default', 'laurent-core' ),
                    'left'   => esc_html__( 'Left', 'laurent-core' ),
                    'right'  => esc_html__( 'Right', 'laurent-core' ),
                    'center' => esc_html__( 'Center', 'laurent-core' ),
                ],
            ]
        );

        $repeater2->add_control(
            'header_style',
            [
                'label'       => esc_html__( 'Header/Bullets Style', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''      => esc_html__( 'Default', 'laurent-core' ),
                    'light' => esc_html__( 'Light', 'laurent-core' ),
                    'dark'  => esc_html__( 'Dark', 'laurent-core' )
                ],
            ]
        );

        laurent_core_generate_elementor_templates_control( $repeater2 );

        $this->add_control(
            'right_slide_content_item',
            [
                'label'       => esc_html__( 'Right Slide Content Items', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'title_field' => esc_html__( 'Right Slide Content Item' ),
            ]
        );

        $this->end_controls_section();
	}
    public function render() {

        $params = $this->get_settings_for_display();
        $holder_classes = $this->getHolderClasses( $params );
        ?>
        <div class="eltdf-vertical-split-slider <?php echo esc_attr( $holder_classes ); ?>">
            <div class="eltdf-vss-ms-left">
                <?php foreach ( $params['left_slide_content_item'] as $left ) {
					$left['holder_rand_class'] = 'eltdf-vss-' . mt_rand( 1000, 10000 );
					$left['holder_classes']    = $this->getItemHolderClasses( $left );
					$left['content_data']      = $this->getItemContentData( $left );
					$left['content_style']     = $this->getItemContentStyles( $left );

                    $left['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($left['template_id']);

                    echo laurent_core_get_shortcode_module_template_part( 'templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $left );
                } ?>
            </div>

            <div class="eltdf-vss-ms-right">
                <?php foreach ( $params['right_slide_content_item'] as $right ) {
					$right['holder_rand_class'] = 'eltdf-vss-' . mt_rand( 1000, 10000 );
					$right['holder_classes']    = $this->getItemHolderClasses( $right );
					$right['content_data']      = $this->getItemContentData( $right );
					$right['content_style']     = $this->getItemContentStyles( $right );

                    $right['content'] = Elementor\Plugin::instance()->frontend->get_builder_content_for_display($right['template_id']);

                    echo laurent_core_get_shortcode_module_template_part( 'templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $right );
                } ?>
            </div>
            <div class="eltdf-vss-horizontal-mask"></div>
            <div class="eltdf-vss-vertical-mask"></div>
        </div>
    <?php }

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_scrolling_animation'] === 'yes' ? 'eltdf-vss-scrolling-animation' : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getItemHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';

		return implode( ' ', $holderClasses );
	}

	private function getItemContentData( $params ) {
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

	private function getItemContentStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}

		if ( ! empty( $params['background_image'] ) ) {
			$url      = wp_get_attachment_url( $params['background_image']['id'] );
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
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorVerticalSplitSlider() );