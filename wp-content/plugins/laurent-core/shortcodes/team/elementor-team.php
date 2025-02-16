<?php
class LaurentCoreElementorTeam extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_team'; 
	}

	public function get_title() {
		return esc_html__( 'Team', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-team';
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
			'type',
			[
				'label'     => esc_html__( 'Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'info-below-image' => esc_html__( 'Info Below Image', 'laurent-core'), 
					'info-on-image' => esc_html__( 'Info On Image Hover', 'laurent-core')
				),
				'default' => 'info-below-image'
			]
		);

		$this->add_control(
			'team_image',
			[
				'label'     => esc_html__( 'Image', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA
			]
		);

		$this->add_control(
			'team_name',
			[
				'label'     => esc_html__( 'Name', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'team_name_tag',
			[
				'label'     => esc_html__( 'Name Tag', 'laurent-core' ),
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
				'default' => 'h5',
				'condition' => [
					'team_name!' => ''
				]
			]
		);

		$this->add_control(
			'team_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'team_name!' => ''
				]
			]
		);

		$this->add_control(
			'team_position',
			[
				'label'     => esc_html__( 'Position', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'team_position_color',
			[
				'label'     => esc_html__( 'Position Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'team_position!' => ''
				]
			]
		);

		$this->add_control(
			'team_text',
			[
				'label'     => esc_html__( 'Text', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'team_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'team_text!' => ''
				]
			]
		);

		$this->add_control(
			'social_type',
			[
				'label'     => esc_html__( 'Social type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'social-text' => esc_html__( 'Social Text', 'laurent-core'), 
					'social-icon' => esc_html__( 'Social Icon', 'laurent-core')
				),
				'default' => 'social-text'
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'     => esc_html__( 'Link Target', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'laurent-core'), 
					'_blank' => esc_html__( 'New Window', 'laurent-core')
				),
				'default' => '_self',
				'condition' => [
					'social_type' => array( 'social-text' )
				]
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Social Link', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'social_text',
            [
                'label' => esc_html__( 'Social Text', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'social_link!' => ''
                ]
            ]
        );

        $this->add_control(
            'social_text_item',
            [
                'label'       => esc_html__( 'Social Icons', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => esc_html__( 'Social Icon' ),
                'condition' => [
                    'social_type' => 'social-text'
                ]
            ]
        );

        $repeater2 = new \Elementor\Repeater();

        laurent_elated_icon_collections()->getElementorParamsArray( $repeater, '', '' );

        $repeater2->add_control(
            'team_social_icon_link',
            [
                'label' => esc_html__( 'Social Icon Link', 'laurent-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater2->add_control(
            'team_social_icon_target',
            [
                'label'   => esc_html__( 'Social Icon Target', 'laurent-core' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => laurent_elated_get_link_target_array(),
                'default' => '_self'
            ]
        );

        $this->add_control(
            'social_icon_item',
            [
                'label'       => esc_html__( 'Social Icons', 'laurent-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater2->get_controls(),
                'title_field' => esc_html__( 'Social Icon' ),
                'condition' => [
                    'social_type' => 'social-icon'
                ]
            ]
        );

		$this->add_control(
			'appear_effect',
			[
				'label'     => esc_html__( 'Enable Appear Effect', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

        $params['team_image']           = ! empty($params['team_image']) ? $params['team_image']['id'] : $params['team_image'];
		$params['type']                 = ! empty( $params['type'] ) ? $params['type'] : 'info-below-image';
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['team_name_tag']        = ! empty( $params['team_name_tag'] ) ? $params['team_name_tag'] : 'h5';
		$params['team_social_icons']    = $this->getTeamSocialIcons( $params );
        $params['team_social_text']     = $this->getTeamSocialText( $params );
		$params['team_name_styles']     = $this->getTeamNameStyles( $params );
		$params['team_position_styles'] = $this->getTeamPositionStyles( $params );
		$params['team_text_styles']     = $this->getTeamTextStyles( $params );

		//Get HTML from template based on type of team
        echo laurent_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'team', '', $params );

	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'eltdf-team-' . $params['type'] : '';
		$holderClasses[] = $params['appear_effect'] === 'yes' ? 'eltdf-team-appear' : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getTeamSocialIcons( $params ) {
        $team_social_icons = array();

        if ( $params['social_type'] == 'social-icon' && !empty($params['social_icon_item'])) {

            foreach ( $params['social_icon_item'] as $icon ) {

                $iconPackName = laurent_elated_icon_collections()->getIconCollectionParamNameByKey( $icon['icon_pack'] );

                $team_icon_params                  = array();
                $team_icon_params['icon_pack']     = $icon['icon_pack'];
                $team_icon_params[ $iconPackName ] = $icon[ $iconPackName ];
                $team_icon_params['link']          = $icon['team_social_icon_link'];
                $team_icon_params['target']        = $icon['team_social_icon_target'];

                $team_social_icons[] = laurent_elated_execute_shortcode( 'eltdf_icon', $team_icon_params );
            }
        }
		
		return $team_social_icons;
	}

    private function getTeamSocialText( $params ) {
        if ($params['social_type'] == 'social-text' ) {
            $social_icons = array();

                if(!empty($params['social_text_item'])){

                    foreach ( $params['social_text_item'] as $item ) {
                        $social_icons[] ='<a href="'.$item['social_link'].'" target="'.$params['link_target'].'" >'. $item['social_text'] . '</a>';
                    }

                }

            return $social_icons;
        }
    }

	private function getTeamNameStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_name_color'] ) ) {
			$styles[] = 'color: ' . $params['team_name_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getTeamPositionStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_position_color'] ) ) {
			$styles[] = 'color: ' . $params['team_position_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getTeamTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_text_color'] ) ) {
			$styles[] = 'color: ' . $params['team_text_color'];
		}
		
		return implode( ';', $styles );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorTeam() );