<?php
class LaurentCoreElementorPortfolioSlider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_portfolio_slider'; 
	}

	public function get_title() {
		return esc_html__( 'Portfolio Slider', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-portfolio-slider';
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
			'number_of_items',
			[
				'label'     => esc_html__( 'Number of Portfolios Items', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set number of items for your portfolio slider. Enter -1 to show all', 'laurent-core' )
			]
		);

		$this->add_control(
			'item_type',
			[
				'label'     => esc_html__( 'Click Behavior', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Open portfolio single page on click', 'laurent-core'), 
					'gallery' => esc_html__( 'Open gallery in Pretty Photo on click', 'laurent-core')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'enable_auto_width',
			[
				'label'     => esc_html__( 'Column Auto Width', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Column width will match full image width', 'laurent-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Number of portfolios that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'laurent-core' ),
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'one' => esc_html__( 'One', 'laurent-core'), 
					'two' => esc_html__( 'Two', 'laurent-core'), 
					'three' => esc_html__( 'Three', 'laurent-core'), 
					'four' => esc_html__( 'Four', 'laurent-core'), 
					'five' => esc_html__( 'Five', 'laurent-core'), 
					'six' => esc_html__( 'Six', 'laurent-core')
				),
				'default' => 'three',
				'condition' => [
					'enable_auto_width' => array( 'no' )
				]
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'     => esc_html__( 'Space Between Items', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'huge' => esc_html__( 'Huge (40)', 'laurent-core'), 
					'large' => esc_html__( 'Large (25)', 'laurent-core'), 
					'medium' => esc_html__( 'Medium (20)', 'laurent-core'), 
					'normal' => esc_html__( 'Normal (15)', 'laurent-core'), 
					'small' => esc_html__( 'Small (10)', 'laurent-core'), 
					'tiny' => esc_html__( 'Tiny (5)', 'laurent-core'), 
					'no' => esc_html__( 'No (0)', 'laurent-core')
				),
				'default' => 'normal'
			]
		);

		$this->add_control(
			'image_proportions',
			[
				'label'     => esc_html__( 'Image Proportions', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set image proportions for your portfolio slider.', 'laurent-core' ),
				'options' => array(
					'full' => esc_html__( 'Original', 'laurent-core'), 
					'square' => esc_html__( 'Square', 'laurent-core'), 
					'landscape' => esc_html__( 'Landscape', 'laurent-core'), 
					'portrait' => esc_html__( 'Portrait', 'laurent-core'), 
					'medium' => esc_html__( 'Medium', 'laurent-core'), 
					'large' => esc_html__( 'Large', 'laurent-core'), 
					'custom' => esc_html__( 'Custom', 'laurent-core')
				),
				'default' => 'full'
			]
		);

		$this->add_control(
			'custom_image_width',
			[
				'label'     => esc_html__( 'Custom Image Width', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image width in px', 'laurent-core' ),
				'condition' => [
					'image_proportions' => array( 'custom' )
				]
			]
		);

		$this->add_control(
			'custom_image_height',
			[
				'label'     => esc_html__( 'Custom Image Height', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image height in px', 'laurent-core' ),
				'condition' => [
					'image_proportions' => array( 'custom' )
				]
			]
		);

		$this->add_control(
			'category',
			[
				'label'     => esc_html__( 'One-Category Portfolio List', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'laurent-core' )
			]
		);

		$this->add_control(
			'selected_projects',
			[
				'label'     => esc_html__( 'Show Only Projects with Listed IDs', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'laurent-core' )
			]
		);

		$this->add_control(
			'tag',
			[
				'label'     => esc_html__( 'One-Tag Portfolio List', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'laurent-core' )
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order By', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'date' => esc_html__( 'Date', 'laurent-core'), 
					'ID' => esc_html__( 'ID', 'laurent-core'), 
					'menu_order' => esc_html__( 'Menu Order', 'laurent-core'), 
					'name' => esc_html__( 'Post Name', 'laurent-core'), 
					'rand' => esc_html__( 'Random', 'laurent-core'), 
					'title' => esc_html__( 'Title', 'laurent-core')
				),
				'default' => 'date'
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => esc_html__( 'Order', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC' => esc_html__( 'ASC', 'laurent-core'), 
					'DESC' => esc_html__( 'DESC', 'laurent-core')
				),
				'default' => 'ASC'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_layout',
			[
				'label' => esc_html__( 'Content Layout', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'item_style',
			[
				'label'     => esc_html__( 'Item Style', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'standard-overlay' => esc_html__( 'Standard - Overlay', 'laurent-core'), 
					'standard-float' => esc_html__( 'Standard - Floating Title', 'laurent-core'), 
					'standard-switch-images' => esc_html__( 'Standard - Switch Featured Images', 'laurent-core'), 
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'laurent-core'), 
					'gallery-slide-from-image-bottom' => esc_html__( 'Gallery - Slide From Image Bottom', 'laurent-core')
				),
				'default' => 'standard-overlay'
			]
		);

		$this->add_control(
			'content_top_margin',
			[
				'label'     => esc_html__( 'Content Top Margin (px or %)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'item_style' => array( 'standard-overlay', 'standard-switch-images' )
				]
			]
		);

		$this->add_control(
			'content_bottom_margin',
			[
				'label'     => esc_html__( 'Content Bottom Margin (px or %)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'item_style' => array( 'standard-overlay', 'standard-switch-images' )
				]
			]
		);

		$this->add_control(
			'enable_title',
			[
				'label'     => esc_html__( 'Enable Title', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent-core'), 
					'no' => esc_html__( 'No', 'laurent-core')
				),
				'default' => 'yes',
				'condition' => [
					'item_style' => array( 'standard-overlay', 'standard-switch-images', 'gallery-overlay', 'gallery-slide-from-image-bottom' )
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
					'h6' => esc_html__( 'h6', 'laurent-core')
				),
				'default' => 'h4',
				'condition' => [
					'enable_title' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'title_text_transform',
			[
				'label'     => esc_html__( 'Title Text Transform', 'laurent-core' ),
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
				'default' => '',
				'condition' => [
					'enable_title' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'enable_category',
			[
				'label'     => esc_html__( 'Enable Category', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent-core'), 
					'no' => esc_html__( 'No', 'laurent-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'enable_count_images',
			[
				'label'     => esc_html__( 'Enable Number of Images', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent-core'), 
					'no' => esc_html__( 'No', 'laurent-core')
				),
				'default' => 'yes',
				'condition' => [
					'item_type' => array( 'gallery' )
				]
			]
		);

		$this->add_control(
			'enable_excerpt',
			[
				'label'     => esc_html__( 'Enable Excerpt', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of characters', 'laurent-core' ),
				'condition' => [
					'enable_excerpt' => array( 'yes' )
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => esc_html__( 'Slider Settings', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_loop',
			[
				'label'     => esc_html__( 'Enable Slider Loop', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'item_type' => array( '' )
				]
			]
		);

		$this->add_control(
			'enable_autoplay',
			[
				'label'     => esc_html__( 'Enable Slider Autoplay', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent-core'), 
					'no' => esc_html__( 'No', 'laurent-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'slider_speed',
			[
				'label'     => esc_html__( 'Slide Duration', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default value is 5000 (ms)', 'laurent-core' ),
				'default'		=> 5000
			]
		);

		$this->add_control(
			'slider_speed_animation',
			[
				'label'     => esc_html__( 'Slide Animation Duration', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'laurent-core' ),
				'default'	=> 600
			]
		);

		$this->add_control(
			'enable_fullscreen',
			[
				'label'     => esc_html__( 'Enable Fullscreen mode', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'enable_mouse_scroll',
			[
				'label'     => esc_html__( 'Enable Scrolling with mouse', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'enable_fullscreen' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'enable_navigation',
			[
				'label'     => esc_html__( 'Enable Slider Navigation Arrows', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent-core'), 
					'no' => esc_html__( 'No', 'laurent-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'navigation_skin',
			[
				'label'     => esc_html__( 'Navigation Skin', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'light' => esc_html__( 'Light', 'laurent-core'), 
					'dark' => esc_html__( 'Dark', 'laurent-core')
				),
				'default' => '',
				'condition' => [
					'enable_navigation' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'enable_pagination',
			[
				'label'     => esc_html__( 'Enable Slider Pagination', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent-core'), 
					'no' => esc_html__( 'No', 'laurent-core')
				),
				'default' => 'yes'
			]
		);

		$this->add_control(
			'pagination_skin',
			[
				'label'     => esc_html__( 'Pagination Skin', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'light' => esc_html__( 'Light', 'laurent-core'), 
					'dark' => esc_html__( 'Dark', 'laurent-core')
				),
				'default' => '',
				'condition' => [
					'enable_pagination' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'pagination_position',
			[
				'label'     => esc_html__( 'Pagination Position', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'below-slider' => esc_html__( 'Below Slider', 'laurent-core'), 
					'on-slider' => esc_html__( 'On Slider', 'laurent-core')
				),
				'default' => 'below-slider',
				'condition' => [
					'enable_pagination' => array( 'yes' )
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {
        $args = array(
            'number_of_items'        => '9',
            'item_type'              => '',
            'number_of_columns'      => 'three',
            'space_between_items'    => 'normal',
            'image_proportions'      => 'full',
            'custom_image_width'     => '',
            'custom_image_height'    => '',
            'category'               => '',
            'selected_projects'      => '',
            'tag'                    => '',
            'orderby'                => 'date',
            'order'                  => 'ASC',
            'item_style'             => 'standard-overlay',
            'content_top_margin'     => '',
            'content_bottom_margin'  => '',
            'enable_title'           => 'yes',
            'title_tag'              => 'h4',
            'title_text_transform'   => '',
            'enable_category'        => 'yes',
            'enable_count_images'    => 'yes',
            'enable_excerpt'         => 'no',
            'excerpt_length'         => '20',
            'enable_auto_width'		 => '',
            'enable_loop'            => 'no',
            'enable_autoplay'        => 'yes',
            'slider_speed'           => '5000',
            'slider_speed_animation' => '600',
            'enable_fullscreen'      => 'no',
            'enable_mouse_scroll'    => 'no',
            'enable_navigation'      => 'yes',
            'navigation_skin'        => '',
            'enable_pagination'      => 'yes',
            'pagination_skin'        => '',
            'pagination_position'    => 'below-slider'
        );

        $params = shortcode_atts( $args, $this->get_settings_for_display() );
		$params['enable_mouse_scroll']	= !empty($params['enable_mouse_scroll']) ? $params['enable_mouse_scroll'] : $args['enable_mouse_scroll'];
		$params['navigation_skin'] 		= !empty($params['navigation_skin']) ? $params['navigation_skin'] : $args['navigation_skin'];
		$params['pagination_skin'] 		= !empty($params['pagination_skin']) ? $params['pagination_skin'] : $args['pagination_skin'];
		$params['pagination_position'] 		= !empty($params['pagination_position']) ? $params['pagination_position'] : $args['pagination_position'];
		$params['type']                = 'gallery';
		$params['portfolio_slider_on'] = 'yes';

		if($params['item_style'] == 'standard-float'){
			$params['enable_title'] =  'yes';
		}

		$params['holder_classes'] = $this->getHolderClasses($params, $args);
		
		$html = '<div class="eltdf-portfolio-slider-holder '. $params['holder_classes'] .'">';
			$html .= laurent_elated_execute_shortcode( 'eltdf_portfolio_list', $params );
		$html .= '</div>';
		
		echo laurent_elated_get_module_part($html);
	}

    private function getHolderClasses($params, $args) {
        $holderClasses = array();

        if ($params['enable_fullscreen'] == 'yes') {
            $holderClasses[] = 'eltdf-pfs-fullscreen';
        }

        return implode(' ', $holderClasses);
    }

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorPortfolioSlider() );