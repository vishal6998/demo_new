<?php
class LaurentElatedElementorBlogList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_blog_list'; 
	}

	public function get_title() {
		return esc_html__( 'Blog List', 'laurent' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-blog-list';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'type',
			[
				'label'     => esc_html__( 'Type', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'standard' => esc_html__( 'Standard', 'laurent'),
					'boxed' => esc_html__( 'Boxed', 'laurent'),
					'simple' => esc_html__( 'Simple', 'laurent'),
					'minimal' => esc_html__( 'Minimal', 'laurent')
				),
				'default' => 'standard'
			]
		);

		$this->add_control(
			'number_of_posts',
			[
				'label'     => esc_html__( 'Number of Posts', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$this->add_control(
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'one' => esc_html__( 'One', 'laurent'),
					'two' => esc_html__( 'Two', 'laurent'),
					'three' => esc_html__( 'Three', 'laurent'),
					'four' => esc_html__( 'Four', 'laurent'),
					'five' => esc_html__( 'Five', 'laurent'),
					'six' => esc_html__( 'Six', 'laurent')
				),
				'default' => 'four',
				'condition' => [
					'type' => array( 'standard', 'boxed' )
				]
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'     => esc_html__( 'Space Between Items', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'huge' => esc_html__( 'Huge (40)', 'laurent'),
					'large' => esc_html__( 'Large (25)', 'laurent'),
					'medium' => esc_html__( 'Medium (20)', 'laurent'),
					'normal' => esc_html__( 'Normal (15)', 'laurent'),
					'small' => esc_html__( 'Small (10)', 'laurent'),
					'tiny' => esc_html__( 'Tiny (5)', 'laurent'),
					'no' => esc_html__( 'No (0)', 'laurent')
				),
				'default' => 'normal',
				'condition' => [
					'type' => array( 'standard', 'boxed' )
				]
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'     => esc_html__( 'Order By', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'date' => esc_html__( 'Date', 'laurent'),
					'ID' => esc_html__( 'ID', 'laurent'),
					'menu_order' => esc_html__( 'Menu Order', 'laurent'),
					'name' => esc_html__( 'Post Name', 'laurent'),
					'rand' => esc_html__( 'Random', 'laurent'),
					'title' => esc_html__( 'Title', 'laurent')
				),
				'default' => 'title'
			]
		);

		$this->add_control(
			'order',
			[
				'label'     => esc_html__( 'Order', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC' => esc_html__( 'ASC', 'laurent'),
					'DESC' => esc_html__( 'DESC', 'laurent')
				),
				'default' => 'ASC'
			]
		);

		$this->add_control(
			'category',
			[
				'label'     => esc_html__( 'Category', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'laurent' )
			]
		);

		$this->add_control(
			'image_size',
			[
				'label'     => esc_html__( 'Image Size', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'full' => esc_html__( 'Original', 'laurent'),
					'laurent_elated_image_square' => esc_html__( 'Square', 'laurent'),
					'laurent_elated_image_landscape' => esc_html__( 'Landscape', 'laurent'),
					'laurent_elated_image_portrait' => esc_html__( 'Portrait', 'laurent'),
					'thumbnail' => esc_html__( 'Thumbnail', 'laurent'),
					'medium' => esc_html__( 'Medium', 'laurent'),
					'large' => esc_html__( 'Large', 'laurent'),
					'custom' => esc_html__( 'Custom', 'laurent')
				),
				'default' => 'full',
				'condition' => [
					'type' => array( 'standard', 'boxed' )
				]
			]
		);

		$this->add_control(
			'custom_image_width',
			[
				'label'     => esc_html__( 'Custom Image Width', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image width in px', 'laurent' ),
				'condition' => [
					'image_size' => array( 'custom' )
				]
			]
		);

		$this->add_control(
			'custom_image_height',
			[
				'label'     => esc_html__( 'Custom Image Height', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter image height in px', 'laurent' ),
				'condition' => [
					'image_size' => array( 'custom' )
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'post_info',
			[
				'label' => esc_html__( 'Post Info', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'h1' => esc_html__( 'h1', 'laurent'),
					'h2' => esc_html__( 'h2', 'laurent'),
					'h3' => esc_html__( 'h3', 'laurent'),
					'h4' => esc_html__( 'h4', 'laurent'),
					'h5' => esc_html__( 'h5', 'laurent'),
					'h6' => esc_html__( 'h6', 'laurent')
				),
				'default' => 'h5'
			]
		);

		$this->add_control(
			'title_transform',
			[
				'label'     => esc_html__( 'Title Text Transform', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'none' => esc_html__( 'None', 'laurent'),
					'capitalize' => esc_html__( 'Capitalize', 'laurent'),
					'uppercase' => esc_html__( 'Uppercase', 'laurent'),
					'lowercase' => esc_html__( 'Lowercase', 'laurent'),
					'initial' => esc_html__( 'Initial', 'laurent'),
					'inherit' => esc_html__( 'Inherit', 'laurent')
				),
				'default' => ''
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Text Length', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of words', 'laurent' ),
				'condition' => [
					'type' => array( 'standard', 'boxed', 'simple' )
				]
			]
		);

		$this->add_control(
			'post_info_image',
			[
				'label'     => esc_html__( 'Enable Post Info Image', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes',
				'condition' => [
					'type' => array( 'standard', 'boxed' )
				]
			]
		);

		$this->add_control(
			'post_info_section',
			[
				'label'     => esc_html__( 'Enable Post Info Section', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes',
				'condition' => [
					'type' => array( 'standard', 'boxed' )
				]
			]
		);

		$this->add_control(
			'post_info_author',
			[
				'label'     => esc_html__( 'Enable Post Info Author', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes',
				'condition' => [
					'post_info_section' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'post_info_date',
			[
				'label'     => esc_html__( 'Enable Post Info Date', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes',
				'condition' => [
					'post_info_section' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'post_info_category',
			[
				'label'     => esc_html__( 'Enable Post Info Category', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'yes' => esc_html__( 'Yes', 'laurent'),
					'no' => esc_html__( 'No', 'laurent')
				),
				'default' => 'yes',
				'condition' => [
					'post_info_section' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'post_info_comments',
			[
				'label'     => esc_html__( 'Enable Post Info Comments', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent'),
					'yes' => esc_html__( 'Yes', 'laurent')
				),
				'default' => 'no',
				'condition' => [
					'post_info_section' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'post_info_share',
			[
				'label'     => esc_html__( 'Enable Post Info Share', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent'),
					'yes' => esc_html__( 'Yes', 'laurent')
				),
				'default' => 'no',
				'condition' => [
					'post_info_section' => array( 'yes' )
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_features',
			[
				'label' => esc_html__( 'Additional Features', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'pagination_type',
			[
				'label'     => esc_html__( 'Pagination Type', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no-pagination' => esc_html__( 'None', 'laurent'),
					'standard-shortcodes' => esc_html__( 'Standard', 'laurent'),
					'load-more' => esc_html__( 'Load More', 'laurent'),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'laurent')
				),
				'default' => 'no-pagination'
			]
		);


		$this->end_controls_section();
	}
	public function render() {

        $default_atts = array(
            'type'                  => 'standard',
            'number_of_posts'       => '-1',
            'number_of_columns'     => 'four',
            'space_between_items'   => 'normal',
            'category'              => '',
            'orderby'               => 'title',
            'order'                 => 'ASC',
            'image_size'            => 'full',
            'custom_image_width'    => '',
            'custom_image_height'   => '',
            'title_tag'             => 'h5',
            'title_transform'       => '',
            'excerpt_length'        => '40',
            'post_info_section'     => 'yes',
            'post_info_image'       => 'yes',
            'post_info_author'      => 'yes',
            'post_info_date'        => 'yes',
            'post_info_category'    => 'yes',
            'post_info_comments'    => 'no',
            'post_info_like'        => 'no',
            'post_info_share'       => 'no',
            'pagination_type'       => 'no-pagination'
        );
        $params       = shortcode_atts( $default_atts, $this->get_settings_for_display() );

		
		$queryArray             = $this->generateQueryArray( $params );
		$query_result           = new \WP_Query( $queryArray );
		$params['query_result'] = $query_result;
		
		$params['holder_data']    = $this->getHolderData( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params, $default_atts );
		$params['module']         = 'list';
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		$params['paged']         = isset( $query_result->query['paged'] ) ? $query_result->query['paged'] : 1;
		
		$params['this_object'] = $this;
		
		ob_start();
		
		laurent_elated_get_module_template_part( 'shortcodes/blog-list/holder', 'blog', $params['type'], $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		echo laurent_elated_get_module_part($html);
	}

	public function getHolderClasses( $params, $default_atts ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'eltdf-bl-' . $params['type'] : 'eltdf-bl-' . $default_atts['type'];
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $default_atts['number_of_columns'] . '-columns';
		$holderClasses[] = ! in_array( $params['pagination_type'], array( 'standard-shortcodes', 'load-more' ) ) ? 'eltdf-disable-bottom-space' : '';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $default_atts['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['pagination_type'] ) ? 'eltdf-bl-pag-' . $params['pagination_type'] : 'eltdf-bl-pag-' . $default_atts['pagination_type'];
		
		return implode( ' ', $holderClasses );
	}

	public function getHolderData( $params ) {
		$dataString = '';
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_result = $params['query_result'];
		
		$params['max_num_pages'] = $query_result->max_num_pages;
		
		if ( ! empty( $paged ) ) {
			$params['next-page'] = $paged + 1;
		}
		
		foreach ( $params as $key => $value ) {
			if ( $key !== 'query_result' && $value !== '' ) {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-' . $new_key . '=' . esc_attr( str_replace( ' ', '', $value ) );
			}
		}
		
		return $dataString;
	}

	public function generateQueryArray( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'orderby'        => $params['orderby'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number_of_posts'],
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['category_name'] = $params['category'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $queryArray;
	}

	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_transform'];
		}
		
		return implode( ';', $styles );
	}



}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentElatedElementorBlogList() );