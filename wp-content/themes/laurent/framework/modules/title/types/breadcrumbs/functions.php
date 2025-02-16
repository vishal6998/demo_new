<?php

if ( ! function_exists( 'laurent_elated_set_title_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set breadcrumbs title type value for title options map and meta boxes
	 */
	function laurent_elated_set_title_breadcrumbs_type_for_options( $type ) {
		$type['breadcrumbs'] = esc_html__( 'Breadcrumbs', 'laurent' );
		
		return $type;
	}
	
	add_filter( 'laurent_elated_filter_title_type_global_option', 'laurent_elated_set_title_breadcrumbs_type_for_options' );
	add_filter( 'laurent_elated_filter_title_type_meta_boxes', 'laurent_elated_set_title_breadcrumbs_type_for_options' );
}

if ( ! function_exists( 'laurent_elated_custom_breadcrumbs' ) ) {
	/**
	 * Function that renders breadcrumbs
	 */
	function laurent_elated_custom_breadcrumbs() {
		global $post;
		
		$pageid    = laurent_elated_get_page_id();
		$homeLink  = esc_url( home_url( '/' ) );
		$home      = esc_html__( 'Home', 'laurent' );
		$delimiter = '<span class="eltdf-delimiter">' .
                     '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8.3 8.5" class="eltdf-breadcrumb-arrow">' .
                     '<polyline points="0.4 0.4 3.6 4.2 0.4 8.1 " />' .
                     '<polyline points="4.5 0.4 7.7 4.2 4.5 8.1 " />' .
                     '</svg></span>';
		$before    = '<span class="eltdf-current">';
		$after     = '</span>';
		
		$holder_classes = array();
		$holder_styles  = array();
		
		$colorMeta = get_post_meta( $pageid, 'eltdf_breadcrumbs_color_meta', true );
		if ( ! empty( $colorMeta ) ) {
			$holder_classes[] = 'eltdf-has-inline-style';
			$holder_styles[]  = 'color: ' . $colorMeta;
		}
		
		$holder_classes = implode( ' ', $holder_classes );
		
		$output = '<div itemprop="breadcrumb" class="eltdf-breadcrumbs ' . esc_attr( $holder_classes ) . '" ' . laurent_elated_get_inline_attr( $holder_styles, 'style', ';' ) . '>';
		
			if ( is_home() && ! is_front_page() ) {
				$output .= '<a itemprop="url" href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' <a itemprop="url" href="' . $homeLink . '">' . get_the_title( $pageid ) . '</a>';
				
			} elseif ( is_home() ) {
				$output .= $before . $home . $after;
				
			} elseif ( is_front_page() ) {
				$output .= '<a itemprop="url" href="' . $homeLink . '">' . $home . '</a>';
				
			} else {
				$output       .= '<a itemprop="url" href="' . $homeLink . '">' . $home . '</a>' . $delimiter;
				$childContent = '';
				
				if ( is_tag() ) {
					$childContent .= $before . esc_html__( 'Posts tagged ', 'laurent' ) . '"' . single_tag_title( '', false ) . '"' . $after;
					
				} elseif ( is_day() ) {
					$childContent .= '<a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $delimiter;
					$childContent .= '<a itemprop="url" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $delimiter;
					$childContent .= $before . get_the_time( 'd' ) . $after;
					
				} elseif ( is_month() ) {
					$childContent .= '<a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $delimiter;
					$childContent .= $before . get_the_time( 'F' ) . $after;
					
				} elseif ( is_year() ) {
					$childContent .= $before . get_the_time( 'Y' ) . $after;
					
				} elseif ( is_author() ) {
					$author_id = get_query_var( 'author' );
					$childContent    .= $before . esc_html__( 'Articles posted by ', 'laurent' ) . get_the_author_meta( 'display_name', $author_id ) . $after;
					
				} elseif ( is_category() ) {
					$thisCat = get_category( get_query_var( 'cat' ), false );
					if ( isset( $thisCat->parent ) && $thisCat->parent != 0 ) {
						$childContent .= get_category_parents( $thisCat->parent, true, ' ' . $delimiter );
					}
					
					$childContent .= $before . single_cat_title( '', false ) . $after;
					
				} elseif ( is_search() ) {
					$childContent .= $before . esc_html__( 'Search results for ', 'laurent' ) . '"' . get_search_query() . '"' . $after;
					
				} elseif ( is_404() ) {
					$childContent .= $before . esc_html__( 'Error 404', 'laurent' ) . $after;
					
				} elseif ( is_single() && ! is_attachment() ) {
					if ( is_singular( 'post' ) ) {
						$cat  = get_the_category();
						$blog_short_breadcrumb = laurent_elated_options()->getOptionValue( 'blog_breadcrumb_shortener' );
						$cat  = $cat[0];
						$cats = get_category_parents( $cat, true, ' ' . $delimiter );
						
						$childContent .= $cats;

						if(isset($blog_short_breadcrumb) && $blog_short_breadcrumb == 'yes') {
							$childContent .= $before . laurent_elated_trimmed_breadcrumbs_title(get_the_title()) . $after;
						} else {
							$childContent .= $before . get_the_title() . $after;
						}
					} else {
						$childContent .= $before . get_the_title() . $after;
					}
					
				} elseif ( is_attachment() ) {
					if ( $post->post_parent ) {
						$parent = get_post( $post->post_parent );
						$cat    = get_the_category( $parent->ID );
						if ( $cat ) {
							$cat    = $cat[0];
							$childContent .= get_category_parents( $cat, true, ' ' . $delimiter );
						}
						$childContent .= '<a itemprop="url" href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
						
						$childContent .= $delimiter . $before . get_the_title() . $after;
						
					} else {
						$childContent .= $before . get_the_title() . $after;
					}
					
				} elseif ( is_page() ) {
					if ( $post->post_parent ) {
						$parent_ids   = array();
						$parent_ids[] = $post->post_parent;
						
						foreach ( $parent_ids as $parent_id ) {
							$childContent .= '<a itemprop="url" href="' . get_the_permalink( $parent_id ) . '">' . get_the_title( $parent_id ) . '</a>' . $delimiter;
						}
					}
					
					$childContent .= $before . get_the_title() . $after;
					
				}
				
				if ( get_query_var( 'paged' ) ) {
					$childContent .= $before . " (" . esc_html__( 'Page', 'laurent' ) . ' ' . get_query_var( 'paged' ) . ")" . $after;
					
				}
				
				$output .= apply_filters( 'laurent_elated_filter_breadcrumbs_title_child_output', $childContent, $delimiter, $before, $after );
			}
		
		$output .= '</div>';
		
		echo wp_kses( apply_filters( 'laurent_elated_filter_breadcrumbs_title_output', $output ), array(
			'div'  => array(
				'itemprop' => true,
				'id'       => true,
				'class'    => true,
				'style'    => true
			),
			'span' => array(
				'class' => true,
				'id'    => true,
				'style' => true
			),
			'a'    => array(
				'itemprop' => true,
				'id'       => true,
				'class'    => true,
				'href'     => true,
				'style'    => true
			),
            'svg' => array(
                'viewbox' => true,
                'xmlns'   => true,
                'class'   => true,
            ),
            'polyline' => array(
                'points' => true,
            ),
		) );
	}
}

if ( ! function_exists( 'laurent_elated_trimmed_breadcrumbs_title' ) ) {
	/**
	 * Function that trim breadcrumb title
	 */
	function laurent_elated_trimmed_breadcrumbs_title($text)	{

		$word_count = laurent_elated_options()->getOptionValue( 'blog_breadcrumb_number_of_words' );

		//is word count set to something different that 0?
		if ($word_count > 0) {

			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $text !== '' ? $text : strip_tags(get_the_title());

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if ($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode(' ', $clean_excerpt);
				if(count($excerpt_word_array) > $word_count) {
					//cut down that array based on the number of the words option
					$excerpt_word_array = array_slice($excerpt_word_array, 0, $word_count);

					//and finally implode words together
					$excerpt = implode(' ', $excerpt_word_array);

					//is excerpt different than empty string?
					if ($excerpt !== '') {
						return rtrim(wp_kses_post($excerpt)) . esc_html__('...', 'laurent');
					}
				} else {
					return get_the_title();
				}
			}

			return '';
		}
	}
}