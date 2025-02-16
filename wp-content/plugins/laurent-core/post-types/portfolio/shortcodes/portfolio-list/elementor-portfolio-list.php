<?php
class LaurentCoreElementorPortfolioList extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_portfolio_list'; 
	}

	public function get_title() {
		return esc_html__( 'Portfolio List', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-portfolio-list';
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
				'label'     => esc_html__( 'Portfolio List Template', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'gallery' => esc_html__( 'Gallery', 'laurent-core'), 
					'masonry' => esc_html__( 'Masonry', 'laurent-core')
				),
				'default' => 'gallery'
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
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Default value is Three', 'laurent-core' ),
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'one' => esc_html__( 'One', 'laurent-core'), 
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
				'label'     => esc_html__( 'Number of Portfolios Per Page', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'laurent-core' )
			]
		);

		$this->add_control(
			'image_proportions',
			[
				'label'     => esc_html__( 'Image Proportions', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set image proportions for your portfolio list.', 'laurent-core' ),
				'options' => array(
					'full' => esc_html__( 'Original', 'laurent-core'), 
					'square' => esc_html__( 'Square', 'laurent-core'), 
					'landscape' => esc_html__( 'Landscape', 'laurent-core'), 
					'portrait' => esc_html__( 'Portrait', 'laurent-core'), 
					'medium' => esc_html__( 'Medium', 'laurent-core'), 
					'large' => esc_html__( 'Large', 'laurent-core'), 
					'custom' => esc_html__( 'Custom', 'laurent-core')
				),
				'default' => 'full',
				'condition' => [
					'type' => array( 'gallery' )
				]
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
			'enable_fixed_proportions',
			[
				'label'     => esc_html__( 'Enable Fixed Image Proportions', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set predefined image proportions for your masonry portfolio list. This option will apply image proportions you set in Portfolio Single page - dimensions for masonry option.', 'laurent-core' ),
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no',
				'condition' => [
					'type' => array( 'masonry' )
				]
			]
		);

		$this->add_control(
			'enable_image_shadow',
			[
				'label'     => esc_html__( 'Enable Image Shadow', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
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
				'default' => 'h5',
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
					'type' => array( 'gallery' )
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
			'additional_features',
			[
				'label' => esc_html__( 'Additional Features', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'pagination_type',
			[
				'label'     => esc_html__( 'Pagination Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no-pagination' => esc_html__( 'None', 'laurent-core'), 
					'standard' => esc_html__( 'Standard', 'laurent-core'), 
					'load-more' => esc_html__( 'Load More', 'laurent-core'), 
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'laurent-core')
				),
				'default' => 'no-pagination'
			]
		);

		$this->add_control(
			'load_more_top_margin',
			[
				'label'     => esc_html__( 'Load More Top Margin (px or %)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'pagination_type' => array( 'load-more' )
				]
			]
		);

		$this->add_control(
			'filter',
			[
				'label'     => esc_html__( 'Enable Category Filter', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$this->add_control(
			'filter_order_by',
			[
				'label'     => esc_html__( 'Filter Order By', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'name' => esc_html__( 'Name', 'laurent-core'), 
					'count' => esc_html__( 'Count', 'laurent-core'), 
					'id' => esc_html__( 'Id', 'laurent-core'), 
					'slug' => esc_html__( 'Slug', 'laurent-core')
				),
				'default' => 'name',
				'condition' => [
					'filter' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'filter_text_transform',
			[
				'label'     => esc_html__( 'Filter Text Transform', 'laurent-core' ),
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
					'filter' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'filter_bottom_margin',
			[
				'label'     => esc_html__( 'Filter Bottom Margin (px or %)', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'filter' => array( 'yes' )
				]
			]
		);

		$this->add_control(
			'enable_article_animation',
			[
				'label'     => esc_html__( 'Enable Article Animation', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Enabling this option you will enable appears animation for your portfolio list items', 'laurent-core' ),
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
        $args   = array(
            'type'                     => 'gallery',
            'item_type'                => '',
            'number_of_columns'        => 'three',
            'space_between_items'      => 'normal',
            'number_of_items'          => '-1',
            'image_proportions'        => 'full',
            'custom_image_width'       => '',
            'custom_image_height'      => '',
            'enable_fixed_proportions' => 'no',
            'enable_image_shadow'      => 'no',
            'category'                 => '',
            'selected_projects'        => '',
            'tag'                      => '',
            'orderby'                  => 'date',
            'order'                    => 'ASC',
            'item_style'               => 'standard-overlay',
            'content_top_margin'       => '',
            'content_bottom_margin'    => '',
            'enable_title'             => 'yes',
            'title_tag'                => 'h5',
            'title_text_transform'     => '',
            'enable_category'          => 'yes',
            'enable_count_images'      => 'yes',
            'enable_excerpt'           => 'no',
            'excerpt_length'           => '20',
            'pagination_type'          => 'no-pagination',
            'load_more_top_margin'     => '',
            'filter'                   => 'no',
            'filter_order_by'          => 'name',
            'filter_text_transform'    => '',
            'filter_bottom_margin'     => '',
            'enable_article_animation' => 'no',
            'portfolio_slider_on'      => 'no',
            'enable_auto_width'		   => '',
            'enable_mouse_scroll'	   => '',
            'enable_loop'              => 'yes',
            'enable_autoplay'          => 'yes',
            'slider_speed'             => '5000',
            'slider_speed_animation'   => '600',
            'enable_navigation'        => 'yes',
            'navigation_skin'          => '',
            'enable_pagination'        => 'yes',
            'pagination_skin'          => '',
            'pagination_position'      => ''
        );
        $params = shortcode_atts( $args, $this->get_settings_for_display() );

		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params =  array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;
		
		$additional_params['holder_data']          = laurent_elated_get_holder_data_for_cpt( $params, $additional_params );
		$additional_params['holder_classes']       = $this->getHolderClasses( $params, $args );
		$additional_params['holder_inner_classes'] = $this->getHolderInnerClasses( $params );
		
		$params['this_object'] = $this;

        echo laurent_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'portfolio-holder', $params['type'], $params, $additional_params );

	}

	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
            $query_array['orderby'] = 'post__in';
			$query_array['post__in'] = $project_ids;
		}
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['portfolio-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}

	public function getHolderClasses( $params, $args ) {
		$classes = array();

        if ($params['item_style'] === 'standard-float') {
            $classes[] = 'eltdf-portfolio-info-float';
        }
		
		$classes[] = ! empty( $params['type'] ) ? 'eltdf-pl-' . $params['type'] : 'eltdf-pl-' . $args['type'];
		$classes[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';
		$classes[] = ! in_array( $params['pagination_type'], array( 'standard-shortcodes', 'load-more' ) ) ? 'eltdf-disable-bottom-space' : '';
		$classes[] = ! empty( $params['item_style'] ) ? 'eltdf-pl-' . $params['item_style'] : '';
		$classes[] = $params['enable_fixed_proportions'] === 'yes' ? 'eltdf-fixed-masonry-items' : '';
		$classes[] = $params['enable_image_shadow'] === 'yes' ? 'eltdf-pl-has-shadow' : '';
		$classes[] = $params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no' ? 'eltdf-pl-no-content' : '';
		$classes[] = ! empty( $params['pagination_type'] ) ? 'eltdf-pl-pag-' . $params['pagination_type'] : '';
		$classes[] = $params['filter'] === 'yes' ? 'eltdf-pl-has-filter' : '';
		$classes[] = $params['enable_article_animation'] === 'yes' ? 'eltdf-pl-has-animation' : '';
		$classes[] = ! empty( $params['navigation_skin'] ) ? 'eltdf-nav-' . $params['navigation_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_skin'] ) ? 'eltdf-pag-' . $params['pagination_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_position'] ) ? 'eltdf-pag-' . $params['pagination_position'] : '';
        $classes[] = $params['portfolio_slider_on'] === 'yes' ? 'swiper-container' : '';
        $classes[] = $params['enable_auto_width'] === 'yes' ? 'eltdf-auto-width' : '';
		
		return implode( ' ', $classes );
	}

	public function getHolderInnerClasses( $params ) {
		$classes = array();
		
		$classes[] = $params['portfolio_slider_on'] === 'yes' ? 'swiper-wrapper' : '';
		
		return implode( ' ', $classes );
	}

	public function getArticleClasses( $params ) {
		$classes = array();
		
		$type       = $params['type'];
		$item_style = $params['item_style'];
		
		if ( get_post_meta( get_the_ID(), "eltdf_portfolio_featured_image_meta", true ) !== "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'eltdf-pl-has-switch-image';
		} elseif ( get_post_meta( get_the_ID(), "eltdf_portfolio_featured_image_meta", true ) === "" && $item_style === 'standard-switch-images' ) {
			$classes[] = 'eltdf-pl-no-switch-image';
		}
		
		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
		$masonry_size     = get_post_meta( get_the_ID(), 'eltdf_portfolio_masonry_' . $image_proportion . '_dimensions_meta', true );
		
		$classes[] = ! empty( $masonry_size ) && $type === 'masonry' ? 'eltdf-masonry-size-' . esc_attr( $masonry_size ) : '';

        $classes[] = $params['portfolio_slider_on'] === 'yes' ? 'swiper-slide' : '';
		
		$article_classes = get_post_class( $classes );
		
		return implode( ' ', $article_classes );
	}

	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) && $params['type'] == 'gallery' ) {
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
		
		if ( $params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes' ) {
			$fixed_image_size = get_post_meta( get_the_ID(), 'eltdf_portfolio_masonry_fixed_dimensions_meta', true );
			
			switch ( $fixed_image_size ) {
				case 'small' :
					$thumb_size = 'laurent_elated_image_square';
					break;
				case 'large-width':
					$thumb_size = 'laurent_elated_image_landscape';
					break;
				case 'large-height':
					$thumb_size = 'laurent_elated_image_portrait';
					break;
				case 'large-width-height':
					$thumb_size = 'laurent_elated_image_huge';
					break;
				default :
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}

	public function getStandardContentStyles( $params ) {
		$styles = array();
		
		$margin_top    = isset( $params['content_top_margin'] ) ? $params['content_top_margin'] : '';
		$margin_bottom = isset( $params['content_bottom_margin'] ) ? $params['content_bottom_margin'] : '';
		
		if ( ! empty( $margin_top ) ) {
			if ( laurent_elated_string_ends_with( $margin_top, '%' ) || laurent_elated_string_ends_with( $margin_top, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin_top;
			} else {
				$styles[] = 'margin-top: ' . laurent_elated_filter_px( $margin_top ) . 'px';
			}
		}
		
		if ( ! empty( $margin_bottom ) ) {
			if ( laurent_elated_string_ends_with( $margin_bottom, '%' ) || laurent_elated_string_ends_with( $margin_bottom, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin_bottom;
			} else {
				$styles[] = 'margin-bottom: ' . laurent_elated_filter_px( $margin_bottom ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}

	public function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}
		
		return implode( ';', $styles );
	}

	public function getSwitchFeaturedImage() {
		$featured_image_meta = get_post_meta( get_the_ID(), 'eltdf_portfolio_featured_image_meta', true );
		
		$featured_image = ! empty( $featured_image_meta ) ? esc_url( $featured_image_meta ) : '';
		
		return $featured_image;
	}

	public function getLoadMoreStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['load_more_top_margin'] ) ) {
			$margin = $params['load_more_top_margin'];
			
			if ( laurent_elated_string_ends_with( $margin, '%' ) || laurent_elated_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-top: ' . $margin;
			} else {
				$styles[] = 'margin-top: ' . laurent_elated_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}

	public function getFilterCategories( $params ) {
		$cat_id = 0;
		
		if ( ! empty( $params['category'] ) ) {
			$top_category = get_term_by( 'slug', $params['category'], 'portfolio-category' );
			
			if ( isset( $top_category->term_id ) ) {
				$cat_id = $top_category->term_id;
			}
		}
		
		$order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';
		
		$args = array(
			'taxonomy' => 'portfolio-category',
			'child_of' => $cat_id,
			'orderby'  => $params['filter_order_by'],
			'order'    => $order
		);
		
		$filter_categories = get_terms( $args );
		
		return $filter_categories;
	}

	public function getFilterHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_bottom_margin'] ) ) {
			$margin = $params['filter_bottom_margin'];
			
			if ( laurent_elated_string_ends_with( $margin, '%' ) || laurent_elated_string_ends_with( $margin, 'px' ) ) {
				$styles[] = 'margin-bottom: ' . $margin;
			} else {
				$styles[] = 'margin-bottom: ' . laurent_elated_filter_px( $margin ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}

	public function getFilterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['filter_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['filter_text_transform'];
		}
		
		return implode( ';', $styles );
	}

	public function getItemLink() {
		$portfolio_link_meta = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( get_the_ID() );
		
		return apply_filters( 'laurent_elated_filter_portfolio_external_link', $portfolio_link );
	}

	public function getItemLinkTarget() {
		$portfolio_link_meta   = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link_target = ! empty( $portfolio_link_meta ) ? '_blank' : '_self';
		
		return apply_filters( 'laurent_elated_filter_portfolio_external_link_target', $portfolio_link_target );
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorPortfolioList() );