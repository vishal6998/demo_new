<?php
class LaurentCoreElementorPortfolioProjectInfo extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_portfolio_project_info'; 
	}

	public function get_title() {
		return esc_html__( 'Portfolio Project Info', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-portfolio-project-info';
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
			'project_id',
			[
				'label'     => esc_html__( 'Selected Project', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'laurent-core' )
			]
		);

		$this->add_control(
			'project_info_type',
			[
				'label'     => esc_html__( 'Project Info Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'title' => esc_html__( 'Title', 'laurent-core'), 
					'category' => esc_html__( 'Category', 'laurent-core'), 
					'tag' => esc_html__( 'Tag', 'laurent-core'), 
					'author' => esc_html__( 'Author', 'laurent-core'), 
					'date' => esc_html__( 'Date', 'laurent-core'), 
					'image' => esc_html__( 'Featured Image', 'laurent-core')
				),
				'default' => 'title'
			]
		);

		$this->add_control(
			'project_info_title_type_tag',
			[
				'label'     => esc_html__( 'Project Title Tag', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set title tag for project title element', 'laurent-core' ),
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
				'default' => 'h4',
				'condition' => [
					'project_info_type' => array( 'title' )
				]
			]
		);

		$this->add_control(
			'project_info_title',
			[
				'label'     => esc_html__( 'Project Info Label', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Add project info label before project info element/s', 'laurent-core' )
			]
		);

		$this->add_control(
			'project_info_title_tag',
			[
				'label'     => esc_html__( 'Project Info Label Tag', 'laurent-core' ),
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
				'default' => 'h4',
				'condition' => [
					'project_info_title!' => ''
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();


		
		$project_info_type                     = ! empty( $params['project_info_type'] ) ? $params['project_info_type'] : 'title';
		$params['project_id']                  = ! empty( $params['project_id'] ) ? $params['project_id'] : get_the_ID();
		$params['project_info_title_type_tag'] = ! empty( $params['project_info_title_type_tag'] ) ? $params['project_info_title_type_tag'] : 'h4';
		$project_info_title_tag                = ! empty( $params['project_info_title_tag'] ) ? $params['project_info_title_tag'] : 'h4';
		
		$html = '<div class="eltdf-portfolio-project-info">';
		
		if ( ! empty( $project_info_title ) ) {
			$html .= '<' . esc_attr( $project_info_title_tag ) . ' class="eltdf-ppi-label">' . esc_html( $project_info_title ) . '</' . esc_attr( $project_info_title_tag ) . '>';
		}
		
		switch ( $project_info_type ) {
			case 'title':
				$html .= $this->getItemTitleHtml( $params );
				break;
			case 'category':
				$html .= $this->getItemCategoryHtml( $params );
				break;
			case 'tag':
				$html .= $this->getItemTagHtml( $params );
				break;
			case 'author':
				$html .= $this->getItemAuthorHtml( $params );
				break;
			case 'date':
				$html .= $this->getItemDateHtml( $params );
				break;
			case 'image':
				$html .= $this->getItemImageHtml( $params );
				break;
			default:
				$html .= $this->getItemTitleHtml( $params );
				break;
		}
		
		$html .= '</div>';
		
		echo laurent_elated_get_module_part($html);
	}

	public function getItemTitleHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$title      = get_the_title( $project_id );
		$title_tag  = $params['project_info_title_type_tag'];
		
		if ( ! empty( $title ) ) {
			$html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="eltdf-ppi-title entry-title">';
				$html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . esc_html( $title ) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
		}
		
		return $html;
	}

	public function getItemCategoryHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$categories = wp_get_post_terms( $project_id, 'portfolio-category' );
		
		if ( ! empty( $categories ) ) {
			$html = '<div class="eltdf-ppi-category">';
			foreach ( $categories as $cat ) {
				$html .= '<a itemprop="url" class="eltdf-ppi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}

	public function getItemTagHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$tags       = wp_get_post_terms( $project_id, 'portfolio-tag' );
		
		if ( ! empty( $tags ) ) {
			$html = '<div class="eltdf-ppi-tag">';
			foreach ( $tags as $tag ) {
				$html .= '<a itemprop="url" class="eltdf-ppi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
			}
			$html .= '</div>';
		}
		
		return $html;
	}

	public function getItemAuthorHtml( $params ) {
		$html         = '';
		$project_id   = $params['project_id'];
		$project_post = get_post( $project_id );
		$autor_id     = $project_post->post_author;
		$author       = get_the_author_meta( 'display_name', $autor_id );
		
		if ( ! empty( $author ) ) {
			$html = '<div class="eltdf-ppi-author">' . esc_html( $author ) . '</div>';
		}
		
		return $html;
	}

	public function getItemDateHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$date       = get_the_time( get_option( 'date_format' ), $project_id );
		
		if ( ! empty( $date ) ) {
			$html = '<div class="eltdf-ppi-date">' . esc_html( $date ) . '</div>';
		}
		
		return $html;
	}

	public function getItemImageHtml( $params ) {
		$html       = '';
		$project_id = $params['project_id'];
		$image      = get_the_post_thumbnail( $project_id, 'full' );
		
		if ( ! empty( $image ) ) {
			$html = '<a itemprop="url" class="eltdf-ppi-image" href="' . esc_url( get_the_permalink( $project_id ) ) . '">' . $image . '</a>';
		}
		
		return $html;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorPortfolioProjectInfo() );