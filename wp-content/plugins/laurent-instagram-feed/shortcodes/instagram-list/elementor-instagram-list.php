<?php

class LaurentInstagramFeedElementorInstagramList extends \Elementor\Widget_Base {

    public function get_name() {
        return 'eltdf_instagram_list';
    }

    public function get_title() {
        return esc_html__( 'Instagram List', 'laurent-instagram-feed' );
    }

    public function get_icon() {
        return 'laurent-elementor-custom-icon laurent-elementor-instagram-list';
    }

    public function get_categories() {
        return [ 'elated' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'laurent-instagram-feed' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_columns',
            [
                'label'       => esc_html__( 'Number of Columns', 'laurent-instagram-feed' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => laurent_elated_get_number_of_columns_array(false, array('one', 'six')),
                'description' => esc_html__( 'Default value is Three', 'laurent-instagram-feed' ),
                'default'     => '3'
            ]
        );

        $this->add_control(
            'type',
            [
                'label'   => esc_html__( 'Type', 'laurent-instagram-feed' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'gallery' => esc_html__( 'Gallery', 'laurent-instagram-feed' ),
                    'carousel' => esc_html__( 'Carousel', 'laurent-instagram-feed' ),
                ],
                'default' => 'gallery'
            ]
        );



        $this->add_control(
            'space_between_columns',
            [
                'label'   => esc_html__( 'Space Between Items', 'laurent-instagram-feed' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
				'options'     => laurent_elated_get_space_between_items_array(),
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'number_of_photos',
            [
                'label'       => esc_html__( 'Number of Photos', 'laurent-instagram-feed' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '-1'
            ]
        );

		$this->add_control(
			'transient_time',
			[
				'label'       => esc_html__( 'Images Cache Time', 'laurent-instagram-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '10800'
			]
		);

		$this->add_control(
			'show_instagram_icon',
			[
				'label'   => esc_html__( 'Show Instagram Icon', 'laurent-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => laurent_elated_get_yes_no_select_array(false),
				'default' => 'normal'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'laurent-instagram-feed' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slider_loop',
			[
				'label'     => esc_html__( 'Enable Slider Loop', 'laurent-instagram-feed' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => laurent_elated_get_yes_no_select_array( false, false ),
				'default'   => 'yes'
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'   => esc_html__( 'Enable Slider Autoplay', 'laurent-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => laurent_elated_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'       => esc_html__( 'Slide Duration', 'laurent-instagram-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default value is 5000 (ms)', 'laurent-instagram-feed' ),
				'default'     => '5000'
			]
		);

		$this->add_control(
			'slider_speed_animation',
			[
				'label'       => esc_html__( 'Slide Animation Duration', 'laurent-instagram-feed' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'laurent-instagram-feed' ),
				'default'     => '600'
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label'   => esc_html__( 'Enable Slider Navigation Arrows', 'laurent-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => laurent_elated_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label'   => esc_html__( 'Enable Slider Pagination', 'laurent-instagram-feed' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => laurent_elated_get_yes_no_select_array( false, true ),
				'default' => 'no'
			]
		);



        $this->end_controls_section();
    }

    public function render() {

		$params = $this->get_settings_for_display();

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['carousel_classes'] = $this->getCarouselClasses($params);

        $instagram_api = new \LaurentInstagramApi();
        $params['instagram_api'] = $instagram_api;

        $images_array = $instagram_api->getImages($params['number_of_photos'], array(
            'use_transients' => true,
            'transient_name' => '_laurent_instagram_api_transient_name',
            'transient_time' => $params['transient_time']
        ));

        $params['images_array'] = $images_array;
        $params['data_attr'] = $this->getSliderData($params);

		//Get HTML from template based on type of team
		echo laurent_instagram_get_shortcode_module_template_part('templates/holder', 'instagram-list', '', $params);
    }

    public function getHolderClasses($params)
    {
        $holderClasses = array();

        $holderClasses[] = 'eltdf-grid-list';
	    $holderClasses[] = 'eltdf-' . $params['number_of_columns'] . '-columns';
        $holderClasses[] = !empty($params['space_between_columns']) ? 'eltdf-' . $params['space_between_columns'] . '-space' : 'eltdf-il-normal-space';

        return implode(' ', $holderClasses);
    }


    public function getCarouselClasses($params)
    {
        $carouselClasses = array();

        if ($params['type'] === 'carousel') {
            $carouselClasses = 'eltdf-instagram-carousel eltdf-owl-slider eltdf-list-is-slider';

        } else if ($params['type'] == 'gallery') {
            $carouselClasses = 'eltdf-instagram-gallery';
        }

        return $carouselClasses;
    }

    private function getSliderData($params)
    {
        if( $params['type'] === 'gallery' ) {
            return;
        }

        $slider_data = array();

        $slider_data['data-number-of-columns'] = $params['number_of_columns'];
        $slider_data['data-number-of-items'] = $params['number_of_photos'];
        $slider_data['data-enable-loop'] = !empty($params['slider_loop']) ? $params['slider_loop'] : '';
        $slider_data['data-enable-autoplay'] = !empty($params['slider_autoplay']) ? $params['slider_autoplay'] : '';
        $slider_data['data-slider-speed'] = !empty($params['slider_speed']) ? $params['slider_speed'] : '5000';
        $slider_data['data-slider-speed-animation'] = !empty($params['slider_speed_animation']) ? $params['slider_speed_animation'] : '600';
        $slider_data['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $slider_data['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $slider_data;
    }

}

\Elementor\Plugin::instance()->widgets_manager->register( new LaurentInstagramFeedElementorInstagramList() );