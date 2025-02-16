<?php

if ( ! function_exists( 'laurent_core_get_cpt_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $post_type name of the post type of shortcode
	 * @param string $shortcode name of the shortcode
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param array $additional_params array of additional parameters to pass to template
	 *
	 * @return html
	 */
	function laurent_core_get_cpt_shortcode_module_template_part( $post_type, $shortcode, $template, $slug = '', $params = array(), $additional_params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = LAURENT_CORE_CPT_PATH . '/' . $post_type . '/shortcodes/' . $shortcode . '/templates';
		
		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		if ( is_array( $additional_params ) && count( $additional_params ) ) {
			extract( $additional_params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_core_get_cpt_single_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $cpt_name name of the cpt folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function laurent_core_get_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = LAURENT_CORE_CPT_PATH . '/' . $cpt_name;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( ! empty( $template ) ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		echo laurent_elated_get_module_part($html);
	}
}

if ( ! function_exists( 'laurent_core_return_cpt_single_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $cpt_name name of the cpt folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function laurent_core_return_cpt_single_module_template_part( $template, $cpt_name, $slug = '', $params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = LAURENT_CORE_CPT_PATH . '/' . $cpt_name;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( ! empty( $template ) ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_core_get_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function laurent_core_get_shortcode_module_template_part( $template, $shortcode, $slug = '', $params = array() ) {
		
		//HTML Content from template
		$html          = '';
		$template_path = LAURENT_CORE_SHORTCODES_PATH . '/' . $shortcode;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'laurent_core_get_module_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $module name of the module to load
     * @param string $template name of the template file
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return html
     */
    function laurent_core_get_module_template_part( $module, $template, $slug = '', $params = array() ) {

        //HTML Content from template
        $html          = '';
        $template_path = LAURENT_CORE_ABS_PATH . '/' . $module . '/templates';

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( $template ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}

if ( ! function_exists( 'laurent_core_get_module_shortcode_template_part' ) ) {
    /**
     * Loads module template part.
     *
     * @param string $module name of the module to load
     * @param string $shortcode name of the shortcode to load
     * @param string $template name of the template file
     * @param string $slug
     * @param array $params array of parameters to pass to template
     *
     * @return html
     */
    function laurent_core_get_module_shortcode_template_part( $module, $shortcode, $template, $slug = '', $params = array() ) {

        //HTML Content from template
        $html          = '';
        $template_path = LAURENT_CORE_ABS_PATH . '/' . $module . '/shortcodes/' . $shortcode . '/templates';

        $temp = $template_path . '/' . $template;

        if ( is_array( $params ) && count( $params ) ) {
            extract( $params );
        }

        $template = '';

        if ( ! empty( $temp ) ) {
            if ( ! empty( $slug ) ) {
                $template = "{$temp}-{$slug}.php";

                if ( ! file_exists( $template ) ) {
                    $template = $temp . '.php';
                }
            } else {
                $template = $temp . '.php';
            }
        }

        if ( $template ) {
            ob_start();
            include( $template );
            $html = ob_get_clean();
        }

        return $html;
    }
}

if ( ! function_exists( 'laurent_core_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function laurent_core_ajax_status( $status, $message, $data = null ) {
		$response = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		);
		
		$output = json_encode( $response );
		
		exit( $output );
	}
}

if ( ! function_exists( 'laurent_core_add_user_custom_fields' ) ) {
	/**
	 * Function creates custom social fields for users
	 *
	 * return $user_contact
	 */
	function laurent_core_add_user_custom_fields( $user_contact ) {
		/**
		 * Function that add custom user fields
		 **/
		$user_contact['facebook']   = esc_html__( 'Facebook', 'laurent-core' );
		$user_contact['twitter']    = esc_html__( 'Twitter', 'laurent-core' );
		$user_contact['linkedin']   = esc_html__( 'Linkedin', 'laurent-core' );
		$user_contact['instagram']  = esc_html__( 'Instagram', 'laurent-core' );
		$user_contact['pinterest']  = esc_html__( 'Pinterest', 'laurent-core' );
		$user_contact['tumblr']     = esc_html__( 'Tumbrl', 'laurent-core' );
		
		return $user_contact;
	}
	
	add_filter( 'user_contactmethods', 'laurent_core_add_user_custom_fields' );
}

if ( ! function_exists( 'laurent_core_add_additional_user_meta' ) ) {

    function laurent_core_add_additional_user_meta( $user ) {
        $user_pos = get_the_author_meta( 'position', $user->ID );
        ?>
        <h3><?php esc_html_e( 'Additional User Data', 'laurent-core' ); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="position"><?php esc_html_e( 'Position', 'laurent-core' ); ?></label></th>
                <td>
                    <input id="position" name="position" class="regular-text" type="text" value="<?php echo ( $user_pos ) ? esc_attr( $user_pos ) : ''; ?>"/>
                    <p class="description"><?php esc_html__( 'User Position will be displayed in Author Info Box on single post pages.', 'laurent-core' ); ?></p>
                </td>
            </tr>
        </table>
        <?php
    }

    add_action( 'show_user_profile', 'laurent_core_add_additional_user_meta' );
    add_action( 'edit_user_profile', 'laurent_core_add_additional_user_meta' );
}

if ( ! function_exists( 'laurent_core_save_additional_user_meta' ) ) {

    function laurent_core_save_additional_user_meta( $user_id ) {

        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            return false;
        } else {
            $user_pos = get_the_author_meta( 'position', $user_id );


            if ( isset( $_POST['position'] ) && $_POST['position'] != $user_pos ) {
                update_user_meta( $user_id, 'position', sanitize_text_field( $_POST['position'] ) );
            }
        }
    }

    add_action( 'personal_options_update', 'laurent_core_save_additional_user_meta' );
    add_action( 'edit_user_profile_update', 'laurent_core_save_additional_user_meta' );
}

if ( ! function_exists( 'laurent_core_set_open_graph_meta' ) ) {
	/*
	 * Function that echoes open graph meta tags if enabled
	 */
	function laurent_core_set_open_graph_meta() {
		
		if ( laurent_elated_option_get_value( 'enable_open_graph' ) === 'yes' ) {
			
			// get the id
			$id = get_queried_object_id();
			
			// default type is article, override it with product if page is woo single product
			$type        = 'article';
			$description = '';
			
			// check if page is generic wp page w/o page id
			if ( laurent_elated_is_default_wp_template() ) {
				$id = 0;
			}
			
			// check if page is woocommerce shop page
			if ( laurent_elated_is_plugin_installed( 'woocommerce' ) && ( function_exists( 'is_shop' ) && is_shop() ) ) {
				$shop_page_id = get_option( 'woocommerce_shop_page_id' );
				
				if ( ! empty( $shop_page_id ) ) {
					$id = $shop_page_id;
					// set flag
					$description = 'woocommerce-shop';
				}
			}
			
			if ( function_exists( 'is_product' ) && is_product() ) {
				$type = 'product';
			}
			
			// if id exist use wp template tags
			if ( ! empty( $id ) && !is_front_page()  ) {
				$url   = get_permalink( $id );
				$title = get_the_title( $id );

				// apply bloginfo description to woocommerce shop page instead of first product item description
				if ( $description === 'woocommerce-shop' ) {
					$description = get_bloginfo( 'description' );
				} elseif (get_post_field( 'post_excerpt', $id ) !== '') {
					$description = strip_tags( apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $id ) ) );
				} else {
					$description = get_bloginfo( 'description' );
				}
				
				// has featured image
				if ( get_post_thumbnail_id( $id ) !== '' ) {
					$image = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
				} else {
					$image = laurent_elated_option_get_value( 'open_graph_image' );
				}
			} else {
				global $wp;
				$url         = esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
				$title       = get_bloginfo( 'name' );
				$description = get_bloginfo( 'description' );
				$image       = laurent_elated_option_get_value( 'open_graph_image' );
			}
			?>
			
			<meta property="og:url" content="<?php echo esc_url( $url ); ?>"/>
			<meta property="og:type" content="<?php echo esc_html( $type ); ?>"/>
			<meta property="og:title" content="<?php echo esc_html( $title ); ?>"/>
			<meta property="og:description" content="<?php echo esc_html( $description ); ?>"/>
			<meta property="og:image" content="<?php echo esc_url( $image ); ?>"/>
		
		<?php }
	}
	
	add_action( 'laurent_elated_action_header_meta', 'laurent_core_set_open_graph_meta' );
}

/* Function for adding custom meta boxes hooked to default action */
if ( class_exists( 'WP_Block_Type' ) && defined( 'LAURENT_ELATED_ROOT' ) ) {
	add_action( 'admin_head', 'laurent_elated_meta_box_add' );
} else {
	add_action( 'add_meta_boxes', 'laurent_elated_meta_box_add' );
}

if ( ! function_exists( 'laurent_elated_create_meta_box_handler' ) ) {
	function laurent_elated_create_meta_box_handler( $box, $key, $screen ) {
		add_meta_box(
			'eltdf-meta-box-' . $key,
			$box->title,
			'laurent_elated_render_meta_box',
			$screen,
			'advanced',
			'high',
			array( 'box' => $box )
		);
	}
}

if ( ! function_exists( 'laurent_elated_str_split_unicode' ) ) {
	function laurent_elated_str_split_unicode( $str ) {
		return preg_split( '~~u', $str, - 1, PREG_SPLIT_NO_EMPTY );
	}
}

if ( ! function_exists( 'laurent_elated_get_split_text' ) ) {
	function laurent_elated_get_split_text( $text ) {
		if ( ! empty( $text ) ) {
			$split_text = laurent_elated_str_split_unicode( $text );
			
			foreach ( $split_text as $key => $value ) {
				$split_text[ $key ] = '<span class="edgtf-s-character">' . $value . '</span>';
			}
			
			return implode( ' ', $split_text );
		}
		
		return $text;
	}
}

if ( ! function_exists( 'laurent_elated_print_row_pattern_svg' ) ) {
    function laurent_elated_print_row_pattern_svg($output, $atts) {
        $pattern_svg_path = isset($atts['pattern_svg_path']) ? $atts['pattern_svg_path'] : '';
        $pattern_svg_position = isset($atts['pattern_svg_position']) ? $atts['pattern_svg_position'] : '';
        $pattern_svg_hr_offset = isset($atts['pattern_svg_hr_offset']) ? $atts['pattern_svg_hr_offset'] : '';
        $pattern_svg_vr_offset = isset($atts['pattern_svg_vr_offset']) ? $atts['pattern_svg_vr_offset'] : '';
        $pattern_svg_class = '';
        $pattern_svg_styles = array();

        if ( ! empty ( $pattern_svg_position ) ) {
            $pattern_svg_class = 'eltdf-pattern-position-' . $pattern_svg_position;
        }

        if ( ! empty ( $pattern_svg_hr_offset ) ) {
            if ( $pattern_svg_position === 'left' ) {
                $pattern_svg_styles[] = 'left: ' . $pattern_svg_hr_offset;
            } else {
                $pattern_svg_styles[] = 'right: ' . $pattern_svg_hr_offset;
            }
        }

        if ( ! empty ( $pattern_svg_vr_offset ) ) {
            $pattern_svg_styles[] = 'transform: translateY(' . $pattern_svg_vr_offset . ')';
        }

        $pattern_svg_style = implode( ';', $pattern_svg_styles);

        if ( ! empty( $pattern_svg_path ) ) {
            $output .= '<div class="eltdf-svg-pattern-holder ' . esc_attr( $pattern_svg_class ) . '" ' . laurent_elated_get_inline_style( $pattern_svg_style ) . '>';
            if( isset( $atts['is_elementor'] ) && $atts['is_elementor'] ){
                $output .= laurent_elated_get_module_part( $pattern_svg_path );
            } else {
                $output .= laurent_elated_get_module_part( urldecode( base64_decode( $pattern_svg_path ) ) );
            }
            $output .= '</div>';
        }

        return $output;
    }

    add_filter('laurent_elated_filter_vc_row_svg_pattern', 'laurent_elated_print_row_pattern_svg', 10, 2);
}