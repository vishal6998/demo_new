<?php
class LaurentCoreElementorCustomFont extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_custom_font'; 
	}

	public function get_title() {
		return esc_html__( 'Custom Font', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-custom-font';
	}

	public function get_categories() {
		return [ 'elated' ];
	}
    public function get_script_depends() {
        return array(
            'typed'
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
			'title',
			[
				'label'     => esc_html__( 'Title Text', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'type_out_effect',
			[
				'label'     => esc_html__( 'Enable Type Out Effect', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Adds a type out effect inside custom font content', 'laurent-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'type_out_position',
			[
				'label'     => esc_html__( 'Position of Type Out Effect', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the position of the word after which you would like to display type out effect (e.g. if you would like the type out effect after the 3rd word, you would enter &quot;3&quot;)', 'laurent-core' ),
				'condition' => [
					'type_out_effect' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'typed_color',
			[
				'label'     => esc_html__( 'Typed Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'type_out_effect' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'typed_ending_1',
			[
				'label'     => esc_html__( 'Typed Ending Number 1', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type_out_effect' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'typed_ending_2',
			[
				'label'     => esc_html__( 'Typed Ending Number 2', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'typed_ending_1!' => ''
				]
			]
		);

		$this->add_control(
			'typed_ending_3',
			[
				'label'     => esc_html__( 'Typed Ending Number 3', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'typed_ending_2!' => ''
				]
			]
		);

		$this->add_control(
			'typed_ending_4',
			[
				'label'     => esc_html__( 'Typed Ending Number 4', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'typed_ending_3!' => ''
				]
			]
		);

		$this->add_control(
			'title_break_words',
			[
				'label'     => esc_html__( 'Position of Line Break', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break (e.g. if you would like the line break after the 3rd and 8th words, you would enter &quot;3,8&quot;)', 'laurent-core' ),
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
					'title_break_words!' => ''
				]
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
				'default' => 'h2'
			]
		);

		$this->add_control(
			'font_family',
			[
				'label'     => esc_html__( 'Font Family', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'font_size',
			[
				'label'     => esc_html__( 'Font Size (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'line_height',
			[
				'label'     => esc_html__( 'Line Height (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'font_weight',
			[
				'label'     => esc_html__( 'Font Weight', 'laurent-core' ),
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
				'default' => ''
			]
		);

		$this->add_control(
			'font_style',
			[
				'label'     => esc_html__( 'Font Style', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'normal' => esc_html__( 'Normal', 'laurent-core'), 
					'italic' => esc_html__( 'Italic', 'laurent-core'), 
					'oblique' => esc_html__( 'Oblique', 'laurent-core'), 
					'initial' => esc_html__( 'Initial', 'laurent-core'), 
					'inherit' => esc_html__( 'Inherit', 'laurent-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'letter_spacing',
			[
				'label'     => esc_html__( 'Letter Spacing (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label'     => esc_html__( 'Text Transform', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'none' => esc_html__( 'None', 'laurent-core'), 
					'capitalize' => esc_html__( 'Capitalize', 'laurent-core'), 
					'uppercase' => esc_html__( 'Uppercase', 'laurent-core'), 
					'lowercase' => esc_html__( 'Lowercase', 'laurent-core'), 
					'initial' => esc_html__( 'Initial', 'laurent-core'), 
					'inherit' => esc_html__( 'Inherit', 'laurent-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'text_decoration',
			[
				'label'     => esc_html__( 'Text Decoration', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'none' => esc_html__( 'None', 'laurent-core'), 
					'underline' => esc_html__( 'Underline', 'laurent-core'), 
					'overline' => esc_html__( 'Overline', 'laurent-core'), 
					'line-through' => esc_html__( 'Line-Through', 'laurent-core'), 
					'initial' => esc_html__( 'Initial', 'laurent-core'), 
					'inherit' => esc_html__( 'Inherit', 'laurent-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'color',
			[
				'label'     => esc_html__( 'Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$this->add_control(
			'text_align',
			[
				'label'     => esc_html__( 'Text Align', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'left' => esc_html__( 'Left', 'laurent-core'), 
					'center' => esc_html__( 'Center', 'laurent-core'), 
					'right' => esc_html__( 'Right', 'laurent-core'), 
					'justify' => esc_html__( 'Justify', 'laurent-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'margin',
			[
				'label'     => esc_html__( 'Margin (px or %)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'laurent-core' )
			]
		);

		$this->add_control(
			'rotation',
			[
				'label'     => esc_html__( 'Text Rotation (deg)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Insert text rotation degree', 'laurent-core' )
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'laptops',
			[
				'label' => esc_html__( 'Laptops', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'font_size_1366',
			[
				'label'     => esc_html__( 'Font Size (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'line_height_1366',
			[
				'label'     => esc_html__( 'Line Height (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tablets_landscape',
			[
				'label' => esc_html__( 'Tablets Landscape', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'font_size_1024',
			[
				'label'     => esc_html__( 'Font Size (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'line_height_1024',
			[
				'label'     => esc_html__( 'Line Height (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tablets_portrait',
			[
				'label' => esc_html__( 'Tablets Portrait', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'font_size_768',
			[
				'label'     => esc_html__( 'Font Size (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'line_height_768',
			[
				'label'     => esc_html__( 'Line Height (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mobiles',
			[
				'label' => esc_html__( 'Mobiles', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'font_size_680',
			[
				'label'     => esc_html__( 'Font Size (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'line_height_680',
			[
				'label'     => esc_html__( 'Line Height (px or em)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		$params['holder_rand_class'] = 'eltdf-cf-' . mt_rand( 1000, 10000 );
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$params['title']     = $this->getModifiedTitle( $params );
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : 'h2';


        echo laurent_core_get_shortcode_module_template_part( 'templates/custom-font', 'custom-font', '', $params );

	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';
		$holderClasses[] = $params['type_out_effect'] === 'yes' ? 'eltdf-cf-has-type-out' : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'eltdf-disable-title-break' : '';
		
		return implode( ' ', $holderClasses );
	}

	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( $params['font_family'] !== '' ) {
			$styles[] = 'font-family: ' . $params['font_family'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			if ( laurent_elated_string_ends_with( $params['font_size'], 'px' ) || laurent_elated_string_ends_with( $params['font_size'], 'em' ) ) {
				$styles[] = 'font-size: ' . $params['font_size'];
			} else {
				$styles[] = 'font-size: ' . $params['font_size'] . 'px';
			}
		}
		
		if ( ! empty( $params['line_height'] ) ) {
			if ( laurent_elated_string_ends_with( $params['line_height'], 'px' ) || laurent_elated_string_ends_with( $params['line_height'], 'em' ) ) {
				$styles[] = 'line-height: ' . $params['line_height'];
			} else {
				$styles[] = 'line-height: ' . $params['line_height'] . 'px';
			}
		}
		
		if ( ! empty( $params['font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['font_style'] ) ) {
			$styles[] = 'font-style: ' . $params['font_style'];
		}
		
		if ( ! empty( $params['letter_spacing'] ) || ( $params['letter_spacing'] === '0') ) {
			if ( laurent_elated_string_ends_with( $params['letter_spacing'], 'px' ) || laurent_elated_string_ends_with( $params['letter_spacing'], 'em' ) ) {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'];
			} else {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'] . 'px';
			}
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( ! empty( $params['text_decoration'] ) ) {
			$styles[] = 'text-decoration: ' . $params['text_decoration'];
		}
		
		if ( ! empty( $params['text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['text_align'];
		}
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}

        if ( ! empty( $params['rotation'] ) ) {
            if ( laurent_elated_string_ends_with( $params['rotation'], 'deg' ) ) {
                $styles[] = 'transform: rotate(' . $params['rotation'] . ')';
                $styles[] = '-webkit-transform: rotate(' . $params['rotation'] . ')';
                $styles[] = '-ms-transform: rotate(' . $params['rotation'] . ')';
            } else {
                $styles[] = 'transform: rotate(' . $params['rotation'] . 'deg)';
                $styles[] = '-webkit-transform: rotate(' . $params['rotation'] . 'deg)';
                $styles[] = '-ms-transform: rotate(' . $params['rotation'] . 'deg)';
            }
        }
		
		return implode( ';', $styles );
	}

	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( $params['font_size_1366'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['font_size_1366'], 'px' ) || laurent_elated_string_ends_with( $params['font_size_1366'], 'em' ) ) {
				$data['data-font-size-1366'] = $params['font_size_1366'];
			} else {
				$data['data-font-size-1366'] = $params['font_size_1366'] . 'px';
			}
		}
		
		if ( $params['font_size_1024'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['font_size_1024'], 'px' ) || laurent_elated_string_ends_with( $params['font_size_1024'], 'em' ) ) {
				$data['data-font-size-1024'] = $params['font_size_1024'];
			} else {
				$data['data-font-size-1024'] = $params['font_size_1024'] . 'px';
			}
		}
		
		if ( $params['font_size_768'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['font_size_768'], 'px' ) || laurent_elated_string_ends_with( $params['font_size_768'], 'em' ) ) {
				$data['data-font-size-768'] = $params['font_size_768'];
			} else {
				$data['data-font-size-768'] = $params['font_size_768'] . 'px';
			}
		}
		
		if ( $params['font_size_680'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['font_size_680'], 'px' ) || laurent_elated_string_ends_with( $params['font_size_680'], 'em' ) ) {
				$data['data-font-size-680'] = $params['font_size_680'];
			} else {
				$data['data-font-size-680'] = $params['font_size_680'] . 'px';
			}
		}
		
		if ( $params['line_height_1366'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['line_height_1366'], 'px' ) || laurent_elated_string_ends_with( $params['line_height_1366'], 'em' ) ) {
				$data['data-line-height-1366'] = $params['line_height_1366'];
			} else {
				$data['data-line-height-1366'] = $params['line_height_1366'] . 'px';
			}
		}
		
		if ( $params['line_height_1024'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['line_height_1024'], 'px' ) || laurent_elated_string_ends_with( $params['line_height_1024'], 'em' ) ) {
				$data['data-line-height-1024'] = $params['line_height_1024'];
			} else {
				$data['data-line-height-1024'] = $params['line_height_1024'] . 'px';
			}
		}
		
		if ( $params['line_height_768'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['line_height_768'], 'px' ) || laurent_elated_string_ends_with( $params['line_height_768'], 'em' ) ) {
				$data['data-line-height-768'] = $params['line_height_768'];
			} else {
				$data['data-line-height-768'] = $params['line_height_768'] . 'px';
			}
		}
		
		if ( $params['line_height_680'] !== '' ) {
			if ( laurent_elated_string_ends_with( $params['line_height_680'], 'px' ) || laurent_elated_string_ends_with( $params['line_height_680'], 'em' ) ) {
				$data['data-line-height-680'] = $params['line_height_680'];
			} else {
				$data['data-line-height-680'] = $params['line_height_680'] . 'px';
			}
		}
		
		return $data;
	}

	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$type_out_effect   = isset( $params['type_out_effect'] ) ? $params['type_out_effect'] : '';
		$type_out_position   = isset( $params['type_out_position'] ) ? $params['type_out_position'] : '';
		$title_break_words   = isset( $params['title_break_words'] ) ? $params['title_break_words'] : '';
		$type_out_position = str_replace( ' ', '', $type_out_position );
		$title_break_words = str_replace( ' ', '', $title_break_words );
		
		if ( ! empty( $title ) && ( $type_out_effect === 'yes' || ! empty( $title_break_words ) ) ) {
			$split_title = explode( ' ', $title );

			if ( $type_out_effect === 'yes' && ! empty( $type_out_position ) ) {
				$typed_styles   = $this->getTypedStyles( $params );
				$data = array();
				if ( isset($params['typed_ending_1']) && !empty($params['typed_ending_1'])) {
					$data[] = $params['typed_ending_1'];
				}
				if ( isset($params['typed_ending_2']) && !empty($params['typed_ending_2'])) {
					$data[] = $params['typed_ending_2'];
				}
				if ( isset($params['typed_ending_3']) && !empty($params['typed_ending_3'])) {
					$data[] = $params['typed_ending_3'];
				}

				$typed_html = '<span class="eltdf-cf-typed-wrap" '. laurent_elated_get_inline_attr( json_encode($data), 'data-strings', ' ' ) . laurent_elated_get_inline_style( $typed_styles ) . '><span class="eltdf-cf-typed">';
				$typed_html .= '</span></span>';

				if ( ! empty( $split_title[ $type_out_position - 1 ] ) ) {
					$split_title[ $type_out_position - 1 ] = $split_title[ $type_out_position - 1 ] . ' ' . $typed_html;
				}
			}
			
			if ( ! empty( $title_break_words ) ) {
				$break_words = explode( ',', $title_break_words );
				
				if ( ! empty( $split_title[ (int)$title_break_words - 1 ] ) ) {
					foreach ( $break_words as $value ) {
						$value = intval( $value );
						if ( ! empty( $split_title[ $value - 1 ] ) ) {
							$split_title[ $value - 1 ] = $split_title[ $value - 1 ] . '<br />';
						}
					}
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}

	private function getTypedStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['typed_color'] ) ) {
			$styles[] = 'color: ' . $params['typed_color'];
		}
		
		return implode( ';', $styles );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorCustomFont() );