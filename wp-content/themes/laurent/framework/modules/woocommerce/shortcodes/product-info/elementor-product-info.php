<?php
class LaurentElatedElementorProductInfo extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_product_info'; 
	}

	public function get_title() {
		return esc_html__( 'Product Info', 'laurent' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-product-info';
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
			'product_id',
			[
				'label'     => esc_html__( 'Selected Product', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'If you left this field empty then product ID will be of the current page', 'laurent' )
			]
		);

		$this->add_control(
			'product_info_type',
			[
				'label'     => esc_html__( 'Product Info Type', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'title' => esc_html__( 'Title', 'laurent'),
					'featured_image' => esc_html__( 'Featured Image', 'laurent'),
					'category' => esc_html__( 'Category', 'laurent'),
					'excerpt' => esc_html__( 'Excerpt', 'laurent'),
					'price' => esc_html__( 'Price', 'laurent'),
					'rating' => esc_html__( 'Rating', 'laurent'),
					'add_to_cart' => esc_html__( 'Add To Cart', 'laurent'),
					'tag' => esc_html__( 'Tag', 'laurent'),
					'author' => esc_html__( 'Author', 'laurent'),
					'date' => esc_html__( 'Date', 'laurent')
				),
				'default' => 'title'
			]
		);

		$this->add_control(
			'featured_image_size',
			[
				'label'     => esc_html__( 'Featured Image Proportions', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'full' => esc_html__( 'Original', 'laurent'),
					'laurent_elated_image_square' => esc_html__( 'Square', 'laurent'),
					'laurent_elated_image_landscape' => esc_html__( 'Landscape', 'laurent'),
					'laurent_elated_image_portrait' => esc_html__( 'Portrait', 'laurent'),
					'medium' => esc_html__( 'Medium', 'laurent'),
					'large' => esc_html__( 'Large', 'laurent'),
					'woocommerce_single' => esc_html__( 'Shop Single', 'laurent'),
					'woocommerce_thumbnail' => esc_html__( 'Shop Thumbnail', 'laurent')
				),
				'default' => 'full',
				'condition' => [
					'product_info_type' => array( 'featured_image' )
				]
			]
		);

		$this->add_control(
			'add_to_cart_skin',
			[
				'label'     => esc_html__( 'Add To Cart Skin', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'white' => esc_html__( 'White', 'laurent'),
					'dark' => esc_html__( 'Dark', 'laurent')
				),
				'default' => '',
				'condition' => [
					'product_info_type' => array( 'add_to_cart' )
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'product_info_style',
			[
				'label' => esc_html__( 'Product Info Style', 'laurent' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'product_info_color',
			[
				'label'     => esc_html__( 'Product Info Color', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'product_info_type' => array( 'title', 'category', 'excerpt', 'price', 'rating', 'tag', 'author', 'date' )
				]
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'     => esc_html__( 'Title Tag', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set title tag for product title element', 'laurent' ),
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'h1' => esc_html__( 'h1', 'laurent'),
					'h2' => esc_html__( 'h2', 'laurent'),
					'h3' => esc_html__( 'h3', 'laurent'),
					'h4' => esc_html__( 'h4', 'laurent'),
					'h5' => esc_html__( 'h5', 'laurent'),
					'h6' => esc_html__( 'h6', 'laurent'),
					'p' => esc_html__( 'p', 'laurent')
				),
				'default' => 'h2',
				'condition' => [
					'product_info_type' => array( 'title' )
				]
			]
		);

		$this->add_control(
			'category_tag',
			[
				'label'     => esc_html__( 'Category Tag', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Set category tag for product category element', 'laurent' ),
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'h1' => esc_html__( 'h1', 'laurent'),
					'h2' => esc_html__( 'h2', 'laurent'),
					'h3' => esc_html__( 'h3', 'laurent'),
					'h4' => esc_html__( 'h4', 'laurent'),
					'h5' => esc_html__( 'h5', 'laurent'),
					'h6' => esc_html__( 'h6', 'laurent')
				),
				'default' => '',
				'condition' => [
					'product_info_type' => array( 'category' )
				]
			]
		);

		$this->add_control(
			'add_to_cart_size',
			[
				'label'     => esc_html__( 'Add To Cart Size', 'laurent' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent'),
					'small' => esc_html__( 'Small', 'laurent'),
					'medium' => esc_html__( 'Medium', 'laurent'),
					'large' => esc_html__( 'Large', 'laurent')
				),
				'default' => '',
				'condition' => [
					'product_info_type' => array( 'add_to_cart' )
				]
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
	    $params['product_id'] = !empty($params['product_id']) ? $params['product_id'] : get_the_ID();
	    $params['product_info_style'] = $this->getProductInfoStyle($params);
		    
		$html = '';
			$html .= '<div class="eltdf-product-info">';

	            switch ($params['product_info_type']) {
		            case 'title':
			            $html .= $this->getItemTitleHtml($params);
			            break;
		            case 'featured_image':
			            $html .= $this->getItemFeaturedImageHtml($params);
			            break;
		            case 'category':
			            $html .= $this->getItemCategoryHtml($params);
			            break;
		            case 'excerpt':
			            $html .= $this->getItemExcerptHtml($params);
			            break;
		            case 'price':
			            $html .= $this->getItemPriceHtml($params);
			            break;
		            case 'rating':
			            $html .= $this->getItemRatingHtml($params);
			            break;
		            case 'add_to_cart':
			            $html .= $this->getItemAddToCartHtml($params);
			            break;
		            case 'tag':
			            $html .= $this->getItemTagHtml($params);
			            break;
		            case 'author':
			            $html .= $this->getItemAuthorHtml($params);
			            break;
		            case 'date':
			            $html .= $this->getItemDateHtml($params);
			            break;
		            default:
			            $html .= $this->getItemTitleHtml($params);
			            break;
	            }

			$html .= '</div>';

        echo laurent_elated_get_module_part($html);
	}

	private function getProductInfoStyle( $params ) {
		$styles = array();
		
		if ( ! empty( $params['product_info_color'] ) ) {
			$styles[] = 'color: ' . $params['product_info_color'];
		}
		
		return $styles;
	}

	public function getItemTitleHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$title              = get_the_title( $product_id );
		$title_tag          = $params['title_tag'];
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $title ) ) {
			$html = '<' . esc_attr( $title_tag ) . ' itemprop="name" class="eltdf-pi-title entry-title" ' . laurent_elated_get_inline_style( $product_info_style ) . '>';
				$html .= '<a itemprop="url" href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . esc_html( $title ) . '</a>';
			$html .= '</' . esc_attr( $title_tag ) . '>';
		}
		
		return $html;
	}

	public function getItemFeaturedImageHtml( $params ) {
		$html                = '';
		$product_id          = $params['product_id'];
		$featured_image_size = ! empty( $params['featured_image_size'] ) ? $params['featured_image_size'] : 'full';
		$featured_image      = get_the_post_thumbnail( $product_id, $featured_image_size );
		
		if ( ! empty( $featured_image ) ) {
			$html = '<a itemprop="url" class="eltdf-pi-image" href="' . esc_url( get_the_permalink( $product_id ) ) . '">' . $featured_image . '</a>';
		}
		
		return $html;
	}

	public function getItemCategoryHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$categories         = wp_get_post_terms( $product_id, 'product_cat' );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $categories ) ) {
			$html .= '<div class="eltdf-pi-category">';
				foreach ( $categories as $cat ) {
					if ( ! empty( $params['category_tag'] ) ) {
						$html .= '<' . esc_attr( $params['category_tag'] ) . ' ' . laurent_elated_get_inline_style( $product_info_style ) . '>';
						$html .= '<a itemprop="url" class="eltdf-pi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
						$html .= '</' . esc_attr( $params['category_tag'] ) . '>';
					} else {
						$html .= '<a itemprop="url" class="eltdf-pi-category-item" href="' . esc_url( get_term_link( $cat->term_id ) ) . '" ' . laurent_elated_get_inline_style( $product_info_style ) . '>' . esc_html( $cat->name ) . '</a>';
					}
				}
			$html .= '</div>';
		}
		
		return $html;
	}

	public function getItemExcerptHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$excerpt            = get_the_excerpt( $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $excerpt ) ) {
			$html = '<div class="eltdf-pi-excerpt"><p itemprop="description" class="eltdf-pi-excerpt-item" ' . laurent_elated_get_inline_style( $product_info_style ) . '>' . esc_html( $excerpt ) . '</p></div>';
		}
		
		return $html;
	}

	public function getItemPriceHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product            = wc_get_product( $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( $price_html = $product->get_price_html() ) {
			$html = '<div class="eltdf-pi-price" ' . laurent_elated_get_inline_style( $product_info_style ) . '>' . $price_html . '</div>';
		}
		
		return $html;
	}

	public function getItemRatingHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product            = wc_get_product( $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
			$average = $product->get_average_rating();
			
			$html = '<div class="eltdf-pi-rating" title="' . sprintf( esc_attr__( "Rated %s out of 5", "laurent" ), $average ) . '" ' . laurent_elated_get_inline_style( $product_info_style ) . '><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"></span></div>';
		}
		
		return $html;
	}

	public function getItemAddToCartHtml( $params ) {
		$product_id = $params['product_id'];
		$product    = wc_get_product( $product_id );
		
		$button_classes = 'button add_to_cart_button ajax_add_to_cart eltdf-btn eltdf-btn-solid';
		
		if ( ! $product->is_in_stock() ) {
			$button_classes = 'button ajax_add_to_cart eltdf-btn eltdf-btn-solid eltdf-out-of-stock';
		} else if ( $product->get_type() === 'variable' ) {
			$button_classes = 'button product_type_variable add_to_cart_button eltdf-btn eltdf-btn-solid';
		} else if ( $product->get_type() === 'external' ) {
			$button_classes = 'button product_type_external eltdf-btn eltdf-btn-solid';
		}
		
		if ( ! empty( $params['add_to_cart_skin'] ) ) {
			$button_classes .= ' eltdf-' . $params['add_to_cart_skin'] . '-skin eltdf-btn-custom-hover-color eltdf-btn-custom-hover-bg eltdf-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['add_to_cart_size'] ) ) {
			$button_classes .= ' eltdf-btn-' . $params['add_to_cart_size'];
		}
		
		$html = '<div class="eltdf-pi-add-to-cart">';
		$html .= apply_filters( 'laurent_elated_filter_product_info_add_to_cart_link',
			sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product_id ),
				esc_attr( $product->get_sku() ),
				esc_attr( $button_classes ),
				esc_html( $product->add_to_cart_text() )
			),
			$product );
		$html .= '</div>';
		
		return $html;
	}

	public function getItemTagHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$tags               = wp_get_post_terms( $product_id, 'product_tag' );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $tags ) ) {
			$html = '<div class="eltdf-pi-tag">';
				foreach ( $tags as $tag ) {
					$html .= '<a itemprop="url" class="eltdf-pi-tag-item" href="' . esc_url( get_term_link( $tag->term_id ) ) . '" ' . laurent_elated_get_inline_style( $product_info_style ) . '>' . esc_html( $tag->name ) . '</a>';
				}
			$html .= '</div>';
		}
		
		return $html;
	}

	public function getItemAuthorHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$product_post       = get_post( $product_id );
		$autor_id           = $product_post->post_author;
		$author             = get_the_author_meta( 'display_name', $autor_id );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $author ) ) {
			$html = '<div class="eltdf-pi-author" ' . laurent_elated_get_inline_style( $product_info_style ) . '>' . esc_html( $author ) . '</div>';
		}
		
		return $html;
	}

	public function getItemDateHtml( $params ) {
		$html               = '';
		$product_id         = $params['product_id'];
		$date               = get_the_time( get_option( 'date_format' ), $product_id );
		$product_info_style = $params['product_info_style'];
		
		if ( ! empty( $date ) ) {
			$html = '<div class="eltdf-pi-date" ' . laurent_elated_get_inline_style( $product_info_style ) . '>' . esc_html( $date ) . '</div>';
		}
		
		return $html;
	}

	public function productIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$product_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'product' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'laurent' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'laurent' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;

	}

	public function productIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			
			$product = get_post( (int) $query );
			if ( ! is_wp_error( $product ) ) {
				
				$product_id = $product->ID;
				$product_title = $product->post_title;
				
				$product_title_display = '';
				if ( ! empty( $product_title ) ) {
					$product_title_display = ' - ' . esc_html__( 'Title', 'laurent' ) . ': ' . $product_title;
				}
				
				$product_id_display = esc_html__( 'Id', 'laurent' ) . ': ' . $product_id;

				$data          = array();
				$data['value'] = $product_id;
				$data['label'] = $product_id_display . $product_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentElatedElementorProductInfo() );