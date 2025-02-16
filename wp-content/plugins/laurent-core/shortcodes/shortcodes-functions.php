<?php

if ( ! function_exists( 'laurent_core_include_shortcodes_file' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function laurent_core_include_shortcodes_file() {
		if ( laurent_core_theme_installed() && laurent_core_is_theme_registered() ) {
			foreach ( glob( LAURENT_CORE_SHORTCODES_PATH . '/*/load.php' ) as $shortcode ) {
				if ( laurent_elated_is_customizer_item_enabled( $shortcode, 'laurent_performance_disable_shortcode_' ) ) {
					include_once $shortcode;
				}
			}
		}
		
		do_action( 'laurent_core_action_include_shortcodes_file' );
	}
	
	add_action( 'init', 'laurent_core_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'laurent_core_load_shortcodes' ) ) {
	function laurent_core_load_shortcodes() {
		include_once LAURENT_CORE_ABS_PATH . '/lib/shortcode-loader.php';
		
		LaurentCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action( 'init', 'laurent_core_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after laurent_core_include_shortcodes_file hook
}

if ( ! function_exists( 'laurent_core_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function laurent_core_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'laurent-core-vc-shortcodes', LAURENT_CORE_ASSETS_URL_PATH . '/css/admin/laurent-vc-shortcodes.css' );
	}
	
	add_action( 'laurent_elated_action_admin_scripts_init', 'laurent_core_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'laurent_core_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function laurent_core_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'laurent_core_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );

        if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}

		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'laurent-core-vc-shortcodes', $style );
		}
	}
	
	add_action( 'laurent_elated_action_admin_scripts_init', 'laurent_core_add_admin_shortcodes_custom_styles' );
}


if ( ! function_exists( 'laurent_core_load_elementor_shortcodes' ) ) {
    /**
     * Function that loads elementor files inside shortcodes folder
     */
    function laurent_core_load_elementor_shortcodes() {
        if ( laurent_core_theme_installed() && laurent_elated_is_plugin_installed('elementor') && laurent_core_is_theme_registered() ) {
            foreach ( glob( LAURENT_CORE_SHORTCODES_PATH . '/*/elementor-*.php' ) as $shortcode_load ) {
                include_once $shortcode_load;
            }
        }
    }

    add_action( 'elementor/widgets/widgets_registered', 'laurent_core_load_elementor_shortcodes' );
}

if ( ! function_exists( 'laurent_core_add_elementor_widget_categories' ) ) {
    /**
     * Registers category group
     */
    function laurent_core_add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'elated',
            [
                'title' => esc_html__( 'Elated', 'laurent-core' ),
                'icon'  => 'fa fa-plug',
            ]
        );

    }

    add_action( 'elementor/elements/categories_registered', 'laurent_core_add_elementor_widget_categories' );
}

if( ! function_exists( 'laurent_core_remove_widgets_for_elementor') ) {
    function laurent_core_remove_widgets_for_elementor( $black_list ) {
        $black_list[] = 'LaurentElatedClassAuthorInfoWidget';
        $black_list[] = 'LaurentElatedClassBlogListWidget';
        $black_list[] = 'LaurentElatedClassButtonWidget';
        $black_list[] = 'LaurentElatedClassContactForm7Widget';
        $black_list[] = 'LaurentElatedClassCustomFontWidget';
        $black_list[] = 'LaurentElatedClassImageGalleryWidget';
        $black_list[] = 'LaurentElatedClassRecentPosts';
        $black_list[] = 'LaurentElatedClassSearchOpener';
        $black_list[] = 'LaurentElatedClassSearchPostType';
        $black_list[] = 'LaurentElatedClassSeparatorWidget';
        $black_list[] = 'LaurentElatedClassSideAreaOpener';
        $black_list[] = 'LaurentElatedClassSocialIconWidget';
        $black_list[] = 'LaurentElatedClassClassIconsGroupWidget';
        $black_list[] = 'LaurentElatedClassStickySidebar';
        $black_list[] = 'LaurentElatedClassWoocommerceDropdownCart';

        return $black_list;
    }

    add_filter('elementor/widgets/black_list', 'laurent_core_remove_widgets_for_elementor');
}

if ( ! function_exists( 'laurent_core_return_elementor_templates' ) ) {
    /**
     * Function that returns all Elementor saved templates
     */
    function laurent_core_return_elementor_templates() {
        return Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
    }
}

if ( ! function_exists( 'laurent_core_generate_elementor_templates_control' ) ) {
    /**
     * Function that adds Template Elementor Control
     */
    function laurent_core_generate_elementor_templates_control( $object ) {
        $templates = laurent_core_return_elementor_templates();

        if ( ! empty( $templates ) ) {
            $options = [
                '0' => '— ' . esc_html__( 'Select', 'laurent-core' ) . ' —',
            ];

            $types = [];

            foreach ( $templates as $template ) {
                $options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
                $types[ $template['template_id'] ]   = $template['type'];
            }

            $object->add_control(
                'template_id',
                [
                    'label'       => esc_html__( 'Choose Template', 'laurent-core' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => '0',
                    'options'     => $options,
                    'types'       => $types,
                    'label_block' => 'true'
                ]
            );
        };
    }
}

//function that maps "Anchor" option for section
if( ! function_exists('laurent_core_map_section_anchor_option') ){
    function laurent_core_map_section_anchor_option( $section, $args ){
        $section->start_controls_section(
            'section_elated_anchor',
            [
                'label' => esc_html__( 'Laurent Anchor', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'anchor_id',
            [
                'label' => esc_html__( 'Laurent Anchor ID', 'laurent-core' ),
                'type'  => Elementor\Controls_Manager::TEXT,
            ]
        );

        $section->end_controls_section();
    }

    add_action('elementor/element/section/_section_responsive/after_section_end', 'laurent_core_map_section_anchor_option', 10, 2);
}

//function that renders "Anchor" option for section
if( ! function_exists('laurent_core_render_section_anchor_option') ) {
    function laurent_core_render_section_anchor_option( $element )   {
        if( 'section' !== $element->get_name() ) {
            return;
        }

        $params = $element->get_settings_for_display();

        if( ! empty( $params['anchor_id'] ) ){
            $element->add_render_attribute( '_wrapper', 'data-eltdf-anchor', $params['anchor_id'] );
        }
    }

    add_action( 'elementor/frontend/section/before_render', 'laurent_core_render_section_anchor_option');
}

//function that maps "Parallax" option for section
if ( ! function_exists( 'laurent_core_map_section_parallax_option' ) ) {
    function laurent_core_map_section_parallax_option( $section, $args ) {
        $section->start_controls_section(
            'section_elated_parallax',
            [
                'label' => esc_html__( 'Laurent Parallax', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'elated_enable_parallax',
            [
                'label'        => esc_html__( 'Enable Parallax', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'no',
                'options'      => [
                    'no'     => esc_html__( 'No', 'laurent-core' ),
                    'holder' => esc_html__( 'Yes', 'laurent-core' ),
                ],
                'prefix_class' => 'eltdf-parallax-row-'
            ]
        );

        $section->add_control(
            'elated_parallax_image',
            [
                'label'              => esc_html__( 'Parallax Image', 'laurent-core' ),
                'type'               => Elementor\Controls_Manager::MEDIA,
                'condition'          => [
                    'elated_enable_parallax' => 'holder'
                ],
                'frontend_available' => true,
            ]
        );

        $section->add_control(
            'elated_parallax_speed',
            [
                'label'     => esc_html__( 'Parallax Speed', 'laurent-core' ),
                'type'      => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'elated_enable_parallax' => 'holder'
                ],
                'default'   => '0'
            ]
        );

        $section->add_control(
            'elated_parallax_height',
            [
                'label'     => esc_html__( 'Parallax Section Height (px)', 'laurent-core' ),
                'type'      => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'elated_enable_parallax' => 'holder'
                ],
                'default'   => '0'
            ]
        );

        $section->end_controls_section();
    }

    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'laurent_core_map_section_parallax_option', 10, 2 );
}

//frontend function for "Parallax"
if ( ! function_exists( 'laurent_core_render_section_parallax_option' ) ) {
    function laurent_core_render_section_parallax_option( $element ) {
        if ( 'section' !== $element->get_name() ) {
            return;
        }

        $params = $element->get_settings_for_display();

        if ( ! empty( $params['elated_parallax_image']['id'] ) ) {
            $parallax_image_src = $params['elated_parallax_image']['url'];
            $parallax_speed     = ! empty( $params['elated_parallax_speed'] ) ? $params['elated_parallax_speed'] : '1';
            $parallax_height    = ! empty( $params['elated_parallax_height'] ) ? $params['elated_parallax_height'] : 0;

            $element->add_render_attribute( '_wrapper', 'class', 'eltdf-parallax-row-holder' );
            $element->add_render_attribute( '_wrapper', 'data-parallax-bg-speed', $parallax_speed );
            $element->add_render_attribute( '_wrapper', 'data-parallax-bg-image', $parallax_image_src );
            $element->add_render_attribute( '_wrapper', 'data-parallax-bg-height', $parallax_height );
        }
    }

    add_action( 'elementor/frontend/section/before_render', 'laurent_core_render_section_parallax_option' );
}

//function that renders helper hidden input for parallax data attribute section
if ( ! function_exists( 'laurent_core_generate_parallax_helper' ) ) {
    function laurent_core_generate_parallax_helper( $template, $widget ) {
        if ( 'section' === $widget->get_name() ) {
            $template_preceding = "
            <# if( settings.elated_enable_parallax == 'holder' ){
		        let parallaxSpeed = settings.elated_parallax_speed !== '' ? settings.elated_parallax_speed : '0';
	            let parallaxImage = settings.elated_parallax_image.url !== '' ? settings.elated_parallax_image.url : '0'
	        #>
		        <input type='hidden' class='eltdf-parallax-helper-holder' data-parallax-bg-speed='{{ parallaxSpeed }}' data-parallax-bg-image='{{ parallaxImage }}'/>
		    <# } #>";
            $template           = $template_preceding . " " . $template;
        }

        return $template;
    }

    add_action( 'elementor/section/print_template', 'laurent_core_generate_parallax_helper', 10, 2 );
}

//function that maps "Content Alignment" option for section
if ( ! function_exists( 'laurent_core_map_section_content_alignment_option' ) ) {
    function laurent_core_map_section_content_alignment_option( $section, $args ) {
        $section->start_controls_section(
            'elated_section_content_alignment',
            [
                'label' => esc_html__( 'Laurent Content Alignment', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'elated_content_alignment',
            [
                'label'        => esc_html__( 'Content Alignment', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'left',
                'options'      => [
                    'left'   => esc_html__( 'Left', 'laurent-core' ),
                    'center' => esc_html__( 'Center', 'laurent-core' ),
                    'right'  => esc_html__( 'Right', 'laurent-core' )
                ],
                'prefix_class' => 'eltdf-content-aligment-'
            ]
        );

        $section->end_controls_section();
    }

    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'laurent_core_map_section_content_alignment_option', 10, 2 );
}

//function that maps "Grid" option for section
if ( ! function_exists( 'laurent_core_map_section_grid_option' ) ) {
    function laurent_core_map_section_grid_option( $section, $args ) {
        $section->start_controls_section(
            'elated_section_grid_row',
            [
                'label' => esc_html__( 'Laurent Grid', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'elated_enable_grid_row',
            [
                'label'        => esc_html__( 'Make this row "In Grid"', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'no',
                'options'      => [
                    'no'      => esc_html__( 'No', 'laurent-core' ),
                    'section' => esc_html__( 'Yes', 'laurent-core' ),
                ],
                'prefix_class' => 'eltdf-elementor-row-grid-'
            ]
        );

        $section->end_controls_section();
    }

    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'laurent_core_map_section_grid_option', 10, 2 );
}

//function that maps "Background Pattern" option for section
if ( ! function_exists( 'laurent_core_map_section_bg_pattern_option' ) ) {
    function laurent_core_map_section_bg_pattern_option( $section, $args ) {
        $section->start_controls_section(
            'elated_section_grid_bg_pattern',
            [
                'label' => esc_html__( 'Laurent Background Pattern', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'pattern_svg_path',
            [
                'label'        =>  esc_html__( 'Pattern SVG Path', 'laurent-core' ),
                'description' => esc_html__( 'Add your SVG path to appear as pattern on the row. Please remove version and id attributes from your SVG path because of HTML validation', 'laurent' ),
                'type'         => Elementor\Controls_Manager::TEXTAREA
            ]
        );

        $section->add_control(
            'pattern_svg_position',
            [
                'label'        =>  esc_html__( 'Pattern SVG Position', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::SELECT,
                'options'      => [
                    'left' => esc_html__( 'Left', 'laurent-core' ),
                    'right' => esc_html__( 'Right', 'laurent-core' )
                ],
                'default' => 'left',
                'condition' => [
                    'pattern_svg_path!' => ''
                ]
            ]
        );

        $section->add_control(
            'pattern_svg_hr_offset',
            [
                'label'        =>  esc_html__( 'Pattern SVG Horizontal Offset (px or %)', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'pattern_svg_path!' => ''
                ]
            ]
        );

        $section->add_control(
            'pattern_svg_vr_offset',
            [
                'label'        =>  esc_html__( 'Pattern SVG Vertical Offset (px or %)', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'pattern_svg_path!' => ''
                ]
            ]
        );

        $section->end_controls_section();
    }

    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'laurent_core_map_section_bg_pattern_option', 10, 2 );
}

if ( ! function_exists( 'laurent_core_generate_bg_pattern' ) ) {
    function laurent_core_generate_bg_pattern( $template, $widget ) {
        if ( 'section' === $widget->get_name() ) {
            $template_preceding = "
            <#

            if( settings.pattern_svg_path !== '' ){
		        let patternSvg = settings.pattern_svg_path;
	            let patternPosition = settings.pattern_svg_position !== '' ? settings.pattern_svg_position : 'left';
	            let patternHrOffset = settings.pattern_svg_hr_offset !== '' ? settings.pattern_svg_hr_offset : '0';
	            let patternVrOffset = settings.pattern_svg_vr_offset !== '' ? settings.pattern_svg_vr_offset : '0';
	            let pattern_svg_class = 'eltdf-svg-pattern-holder eltdf-pattern-position-' + patternPosition;
	            let pattern_svg_styles = '';
	            
	            if( patternHrOffset !== 0 ){
	                if( patternPosition == 'left' ){
	                    pattern_svg_styles += 'left: ' + patternHrOffset + ';';
	                } else{
	                    pattern_svg_styles += 'right: ' + patternHrOffset + ';';
	                }
	            }
	            
	            if( patternVrOffset !== 0 ){
	                pattern_svg_styles += 'transform: translateY(' + patternVrOffset + ');';
	            }
	           
	        #>
		        <div class='{{ pattern_svg_class }}' style='{{ pattern_svg_styles }}'>
		            {{{patternSvg}}}
		        </div>
		    <# } #>";

            $template = $template_preceding . " " . $template;
        }

        return $template;
    }

    add_action( 'elementor/section/print_template', 'laurent_core_generate_bg_pattern', 10, 2 );
}

if ( ! function_exists( 'laurent_core_render_section_background_before' ) ) {
    function laurent_core_render_section_background_before( $section ) {
        ob_start();
    }
    add_action( 'elementor/frontend/section/before_render', 'laurent_core_render_section_background_before');
}

if ( ! function_exists( 'laurent_core_render_section_after' ) ) {
    function laurent_core_render_section_after( $section ) {

        $content = ob_get_clean();

        $params = $section->get_settings_for_display();
        $params['is_elementor'] = true;
        extract( $params );

        if ( !empty($params['pattern_svg_path']) ) {
            $row_new_content = '<div class="eltdf-elementor-row-with-pattern">';
            $eltdf_row_svg_pattern = apply_filters('laurent_elated_filter_vc_row_svg_pattern', '', $params);
            $row_new_content .= $eltdf_row_svg_pattern;
            $row_new_content .= $content;
            $row_new_content .= '</div>';
            echo laurent_elated_get_module_part( $row_new_content );
        } else{
            echo laurent_elated_get_module_part( $content );
        }
    }
    add_action( 'elementor/frontend/section/after_render', 'laurent_core_render_section_after');
}

//function that adds maps "Disable Background" option for section
if ( ! function_exists( 'laurent_core_map_section_disable_background' ) ) {
    function laurent_core_map_section_disable_background( $section, $args ) {
        $section->start_controls_section(
            'elated_section_disable_background',
            [
                'label' => esc_html__( 'Laurent Disable Background Image', 'laurent-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $section->add_control(
            'elated_disable_background',
            [
                'label'        => esc_html__( 'Disable row background', 'laurent-core' ),
                'type'         => Elementor\Controls_Manager::SELECT,
                'default'      => 'no',
                'options'      => [
                    'no'   => esc_html__( 'Never', 'laurent-core' ),
                    '1280' => esc_html__( 'Below 1280px', 'laurent-core' ),
                    '1024' => esc_html__( 'Below 1024px', 'laurent-core' ),
                    '768'  => esc_html__( 'Below 768px', 'laurent-core' ),
                    '680'  => esc_html__( 'Below 680px', 'laurent-core' ),
                    '480'  => esc_html__( 'Below 480px', 'laurent-core' )
                ],
                'prefix_class' => 'eltdf-disabled-bg-image-bellow-'
            ]
        );

        $section->end_controls_section();
    }

    add_action( 'elementor/element/section/_section_responsive/after_section_end', 'laurent_core_map_section_disable_background', 10, 2 );
}


if( ! function_exists('laurent_core_elementor_icons_style') ){
    function laurent_core_elementor_icons_style(){

        wp_enqueue_style( 'laurent-core-elementor', LAURENT_CORE_ASSETS_URL_PATH . '/css/admin/laurent-elementor.css');

    }

    add_action( 'elementor/editor/before_enqueue_scripts', 'laurent_core_elementor_icons_style' );
}


if ( ! function_exists( 'laurent_core_get_elementor_shortcodes_path' ) ) {
    function laurent_core_get_elementor_shortcodes_path() {
        $shortcodes       = array();
        $shortcodes_paths = array(
            LAURENT_CORE_SHORTCODES_PATH . '/*' => LAURENT_CORE_URL_PATH,
			LAURENT_CORE_ABS_PATH . '/**/shortcodes/*' => LAURENT_CORE_URL_PATH,
            LAURENT_CORE_CPT_PATH . '/**/shortcodes/*' => LAURENT_CORE_URL_PATH,
            LAURENT_ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/**/shortcodes/*' => LAURENT_ELATED_FRAMEWORK_ROOT . '/'
        );
	
	    if( laurent_core_is_instagram_plugin_installed() ) {
		    $shortcodes_paths[LAURENT_INSTAGRAM_SHORTCODES_PATH . '/*'] = LAURENT_INSTAGRAM_URL_PATH;
	    }

        foreach ( $shortcodes_paths as $dir_path => $url_path ) {
            foreach ( glob( $dir_path, GLOB_ONLYDIR ) as $shortcode_dir_path ) {
                $shortcode_name     = basename( $shortcode_dir_path );
                $shortcode_url_path = $url_path . substr( $shortcode_dir_path, strpos( $shortcode_dir_path, basename( $url_path ) ) + strlen( basename( $url_path ) ) + 1 );

                $shortcodes[ $shortcode_name ] = array(
                    'dir_path' => $shortcode_dir_path,
                    'url_path' => $shortcode_url_path
                );
            }
        }

        return $shortcodes;
    }
}
if ( ! function_exists( 'laurent_core_add_elementor_shortcodes_custom_styles' ) ) {
    function laurent_core_add_elementor_shortcodes_custom_styles() {
        $style                  = '';
        $shortcodes_icon_styles = array();

        $shortcodes_icon_class_array = apply_filters( 'laurent_core_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
        sort( $shortcodes_icon_class_array );

        $shortcodes_path = laurent_core_get_elementor_shortcodes_path();
        if ( ! empty( $shortcodes_icon_class_array ) ) {

            foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {

                $shortcode_name = str_replace( '.icon-wpb-', '', esc_attr( $shortcode_icon_class ) );

                if ( key_exists( $shortcode_name, $shortcodes_path ) && file_exists( $shortcodes_path[ $shortcode_name ]['dir_path'] . '/assets/img/dashboard_icon.png' ) ) {
                    $shortcodes_icon_styles[] = '.laurent-elementor-custom-icon.laurent-elementor-' . $shortcode_name . ' {
                        background-image: url( "' . $shortcodes_path[ $shortcode_name ]['url_path'] . '/assets/img/dashboard_icon.png" );
                    }';
                }
            }
        }

        if ( ! empty( $shortcodes_icon_styles ) ) {
            $style = implode( ' ', $shortcodes_icon_styles );
        }
        if ( ! empty( $style ) ) {
            wp_add_inline_style( 'laurent-core-elementor', $style );
        }
    }

    add_action( 'elementor/editor/before_enqueue_scripts', 'laurent_core_add_elementor_shortcodes_custom_styles', 15 );
}