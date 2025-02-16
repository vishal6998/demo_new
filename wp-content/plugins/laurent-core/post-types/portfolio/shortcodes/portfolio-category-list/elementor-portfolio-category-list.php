<?php
class LaurentCoreElementorPortfolioCategoryList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_portfolio_category_list'; 
	}

	public function get_title() {
		return esc_html__( 'Portfolio Category List', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-portfolio-category-list';
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
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Default value is Three', 'laurent-core' ),
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'two' => esc_html__( 'Two', 'laurent-core'), 
					'three' => esc_html__( 'Three', 'laurent-core'), 
					'four' => esc_html__( 'Four', 'laurent-core'), 
					'five' => esc_html__( 'Five', 'laurent-core'), 
					'six' => esc_html__( 'Six', 'laurent-core')
				),
				'default' => 'three'
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
			'number_of_items',
			[
				'label'     => esc_html__( 'Number of Items Per Page', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set number of items for your portfolio category list. Default value is 6', 'laurent-core' )
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

		$this->add_control(
			'image_proportions',
			[
				'label'     => esc_html__( 'Image Proportions', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set image proportions for your portfolio category list', 'laurent-core' ),
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
				'default' => 'h3'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$query_array              = $this->getQueryArray( $params );
		$params['query_results']  = get_terms( $query_array );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['image_size']     = $this->getImageSize( $params );

        echo laurent_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'portfolio-category-holder', '', $params );

	}

	public function getQueryArray( $params ) {
		$query_array = array(
			'taxonomy'   => 'portfolio-category',
			'number'     => $params['number_of_items'],
			'orderby'    => $params['orderby'],
			'order'      => $params['order'],
			'hide_empty' => true
		);
		
		return $query_array;
	}

	public function getHolderClasses( $params ) {
		$classes = array();
		
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : '';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : '';
		
		return implode( ' ', $classes );
	}

	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'laurent_elated_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'laurent_elated_image_portrait';
					break;
				case 'square':
					$thumb_size = 'laurent_elated_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
				case 'custom':
					$thumb_size = 'custom';
					break;
			}
		}
		
		return $thumb_size;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorPortfolioCategoryList() );