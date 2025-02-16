<?php
class LaurentCoreElementorPreviewSlider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_preview_slider'; 
	}

	public function get_title() {
		return esc_html__( 'Preview Slider', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-preview-slider';
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
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter autoplay speed interval in milliseconds.', 'laurent-core' )
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ps_laptop_image',
			[
				'label'     => esc_html__( 'Monitor Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'ps_tablet_image',
			[
				'label'     => esc_html__( 'Tablet Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'ps_mobile_image',
			[
				'label'     => esc_html__( 'Phone Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$repeater->add_control(
			'ps_link',
			[
				'label'     => esc_html__( 'Link', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'ps_target',
			[
				'label'     => esc_html__( 'Link Target', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Self', 'laurent-core'), 
					'_blank' => esc_html__( 'Blank', 'laurent-core')
				),
				'default' => '_self'
			]
		);

		$this->add_control(
			'preview_slide',
			[
				'label'     => esc_html__( 'Preview Slide', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields'     => $repeater->get_controls(),
				'title_field'     => esc_html__( 'Item', 'laurent-core' )
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
        $params['autoplay'] = 'yes';
		$params['laptop_images']  = $this->getLaptopImages( $params );
		$params['tablet_images']  = $this->getTabletImages( $params );
		$params['mobile_images']  = $this->getMobileImages( $params );
		$params['slider_data']    = $this->getSliderData( $params );
		$params['slider_links']   = $this->getLinks( $params );
		$params['slider_targets'] = $this->getTargets( $params );


        echo laurent_core_get_shortcode_module_template_part( 'templates/preview-slider-template', 'preview-slider', '', $params );

	}

	private function getLaptopImages( $params ) {

		$laptop_images_array = array();

        foreach ($params['preview_slide'] as $slide) {

            if(!empty($slide['ps_laptop_image'])){
                $laptop_images_array[] = $slide['ps_laptop_image']['id'];
            }
        }

		return $laptop_images_array;
	}

	private function getTabletImages( $params ) {

		$tablet_images_array = array();

        foreach ($params['preview_slide'] as $slide) {

            if(!empty($slide['ps_tablet_image'])){
                $tablet_images_array[] = $slide['ps_tablet_image']['id'];
            }
        }


		return $tablet_images_array;
	}

	private function getMobileImages( $params ) {

		$mobile_images_array = array();

        foreach ($params['preview_slide'] as $slide) {

            if(!empty($slide['ps_mobile_image'])){
                $mobile_images_array[] = $slide['ps_mobile_image']['id'];
            }
        }

		return $mobile_images_array;
	}

	private function getLinks( $params ) {

		$ps_links = array();

		if( isset( $params['ps_link'] ) ) {
			foreach ( $params['ps_link'] as $slide ) {
				
				if ( ! empty( $slide['ps_link'] ) ) {
					$ps_links[] = $slide['ps_link'];
				}
			}
		}

		return $ps_links;
	}

	private function getTargets( $params ) {

		$ps_targets = array();
		
		if( isset( $params['ps_link'] ) ) {
			foreach ( $params['ps_link'] as $slide ) {
				
				if ( ! empty( $slide['ps_target'] ) ) {
					$ps_targets[] = $slide['ps_target'];
				}
			}
		}

		return $ps_targets;
	}

	private function getSliderData( $params ) {

		$data = array();

		if ( $params['autoplay'] != '' ) {
			$data['data-autoplay'] = $params['autoplay'];
		}

		if ( $params['autoplay_speed'] != '' ) {
			$data['data-autoplay-speed'] = $params['autoplay_speed'];
		}

		return $data;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorPreviewSlider() );