<?php
include_once get_template_directory() . '/theme-includes.php';

if ( ! function_exists( 'laurent_elated_styles' ) ) {
	/**
	 * Function that includes theme's core styles
	 */
	function laurent_elated_styles() {

        $modules_css_deps_array = apply_filters( 'laurent_elated_filter_modules_css_deps', array() );
		
		//include theme's core styles
		wp_enqueue_style( 'laurent-elated-default-style', LAURENT_ELATED_ROOT . '/style.css' );
		wp_enqueue_style( 'swiper', LAURENT_ELATED_ASSETS_ROOT . '/css/swiper.min.css' );
		wp_enqueue_style( 'laurent-elated-modules', LAURENT_ELATED_ASSETS_ROOT . '/css/modules.min.css', $modules_css_deps_array );
		
		laurent_elated_icon_collections()->enqueueStyles();

		wp_enqueue_style( 'wp-mediaelement' );
		
		do_action( 'laurent_elated_action_enqueue_third_party_styles' );
		
		//is woocommerce installed?
		if ( laurent_elated_is_plugin_installed( 'woocommerce' ) && laurent_elated_load_woo_assets() ) {
			//include theme's woocommerce styles
			wp_enqueue_style( 'laurent-elated-woo', LAURENT_ELATED_ASSETS_ROOT . '/css/woocommerce.min.css' );
		}
		
		if ( laurent_elated_dashboard_page() || laurent_elated_has_dashboard_shortcodes() ) {
			wp_enqueue_style( 'laurent-elated-dashboard', LAURENT_ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/eltdf-dashboard.css' );
		}
		
		//define files after which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = apply_filters( 'laurent_elated_filter_style_dynamic_deps', array() );

		if ( file_exists( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic.css' ) && laurent_elated_is_css_folder_writable() && ! is_multisite() ) {
			wp_enqueue_style( 'laurent-elated-style-dynamic', LAURENT_ELATED_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic.css' ) ); //it must be included after woocommerce styles so it can override it
		} else if ( file_exists( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . laurent_elated_get_multisite_blog_id() . '.css' ) && laurent_elated_is_css_folder_writable() && is_multisite() ) {
			wp_enqueue_style( 'laurent-elated-style-dynamic', LAURENT_ELATED_ASSETS_ROOT . '/css/style_dynamic_ms_id_' . laurent_elated_get_multisite_blog_id() . '.css', $style_dynamic_deps_array, filemtime( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . laurent_elated_get_multisite_blog_id() . '.css' ) ); //it must be included after woocommerce styles so it can override it
		}
		
		//is responsive option turned on?
		if ( laurent_elated_is_responsive_on() ) {
			wp_enqueue_style( 'laurent-elated-modules-responsive', LAURENT_ELATED_ASSETS_ROOT . '/css/modules-responsive.min.css' );
			
			//is woocommerce installed?
			if ( laurent_elated_is_plugin_installed( 'woocommerce' ) && laurent_elated_load_woo_assets() ) {
				//include theme's woocommerce responsive styles
				wp_enqueue_style( 'laurent-elated-woo-responsive', LAURENT_ELATED_ASSETS_ROOT . '/css/woocommerce-responsive.min.css' );
			}
			
			//include proper styles
			if ( file_exists( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) && laurent_elated_is_css_folder_writable() && ! is_multisite() ) {
				wp_enqueue_style( 'laurent-elated-style-dynamic-responsive', LAURENT_ELATED_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) );
			} else if ( file_exists( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . laurent_elated_get_multisite_blog_id() . '.css' ) && laurent_elated_is_css_folder_writable() && is_multisite() ) {
				wp_enqueue_style( 'laurent-elated-style-dynamic-responsive', LAURENT_ELATED_ASSETS_ROOT . '/css/style_dynamic_responsive_ms_id_' . laurent_elated_get_multisite_blog_id() . '.css', array(), filemtime( LAURENT_ELATED_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . laurent_elated_get_multisite_blog_id() . '.css' ) );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'laurent_elated_styles' );
}

if ( ! function_exists( 'laurent_elated_google_fonts_styles' ) ) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
	function laurent_elated_google_fonts_styles() {
    $is_enabled = boolval( apply_filters( 'laurent_elated_filter_enable_google_fonts', true ) );

    if ( $is_enabled ) {

      $font_simple_field_array = laurent_elated_options()->getOptionsByType( 'fontsimple' );
      if ( ! ( is_array( $font_simple_field_array ) && count( $font_simple_field_array ) > 0 ) ) {
        $font_simple_field_array = array();
      }
      
      $font_field_array = laurent_elated_options()->getOptionsByType( 'font' );
      if ( ! ( is_array( $font_field_array ) && count( $font_field_array ) > 0 ) ) {
        $font_field_array = array();
      }
      
      $available_font_options = array_merge( $font_simple_field_array, $font_field_array );
      
      $google_font_weight_array = laurent_elated_options()->getOptionValue( 'google_font_weight' );
      if ( ! empty( $google_font_weight_array ) && is_array( $google_font_weight_array ) ) {
        $google_font_weight_array = array_slice( laurent_elated_options()->getOptionValue( 'google_font_weight' ), 1 );
      }
      
      $font_weight_str = '100,300,400,700';
      if ( ! empty( $google_font_weight_array ) && is_array( $google_font_weight_array ) && $google_font_weight_array !== '' ) {
        $font_weight_str = implode( ',', $google_font_weight_array );
      }
      
      $google_font_subset_array = laurent_elated_options()->getOptionValue( 'google_font_subset' );
      if ( ! empty( $google_font_subset_array ) && is_array( $google_font_subset_array ) ) {
        $google_font_subset_array = array_slice( laurent_elated_options()->getOptionValue( 'google_font_subset' ), 1 );
      }
      
      $font_subset_str = 'latin-ext';
      if ( ! empty( $google_font_subset_array ) && is_array( $google_font_subset_array ) && $google_font_subset_array !== '' ) {
        $font_subset_str = implode( ',', $google_font_subset_array );
      }
      
      //default fonts
      $default_font_family = array(
              'Miniver',
              'Josefin Sans',
              'Open Sans Condensed',
              'Mrs Saint Delafield',
              'Limelight'
      );
      
      $modified_default_font_family = array();
      foreach ( $default_font_family as $default_font ) {
        $modified_default_font_family[] = $default_font . ':' . str_replace( ' ', '', $font_weight_str );
      }
      
      $default_font_string = implode( '|', $modified_default_font_family );
      
      //define available font options array
      $fonts_array = array();
      foreach ( $available_font_options as $font_option ) {
        //is font set and not set to default and not empty?
        $font_option_value = laurent_elated_options()->getOptionValue( $font_option );
        
        if ( laurent_elated_is_font_option_valid( $font_option_value ) && ! laurent_elated_is_native_font( $font_option_value ) ) {
          $font_option_string = $font_option_value . ':' . $font_weight_str;
          
          if ( ! in_array( str_replace( '+', ' ', $font_option_value ), $default_font_family ) && ! in_array( $font_option_string, $fonts_array ) ) {
            $fonts_array[] = $font_option_string;
          }
        }
      }
      
      $fonts_array         = array_diff( $fonts_array, array( '-1:' . $font_weight_str ) );
      $google_fonts_string = implode( '|', $fonts_array );
      
      //is google font option checked anywhere in theme?
      if ( count( $fonts_array ) > 0 ) {
        
        //include all checked fonts
        $fonts_full_list      = $default_font_string . '|' . str_replace( '+', ' ', $google_fonts_string );
        $fonts_full_list_args = array(
          'family' => urlencode( $fonts_full_list ),
          'subset' => urlencode( $font_subset_str ),
        );
        
        $laurent_elated_global_fonts = add_query_arg( $fonts_full_list_args, 'https://fonts.googleapis.com/css' );
        wp_enqueue_style( 'laurent-elated-google-fonts', esc_url_raw( $laurent_elated_global_fonts ), array(), '1.0.0' );
        
      } else {
        //include default google font that theme is using
        $default_fonts_args          = array(
          'family' => urlencode( $default_font_string ),
          'subset' => urlencode( $font_subset_str ),
        );
        $laurent_elated_global_fonts = add_query_arg( $default_fonts_args, 'https://fonts.googleapis.com/css' );
        wp_enqueue_style( 'laurent-elated-google-fonts', esc_url_raw( $laurent_elated_global_fonts ), array(), '1.0.0' );
      }
    }
	}
	
	add_action( 'wp_enqueue_scripts', 'laurent_elated_google_fonts_styles' );
}

if ( ! function_exists( 'laurent_elated_scripts' ) ) {
	/**
	 * Function that includes all necessary scripts
	 */
	function laurent_elated_scripts() {
		global $wp_scripts;
		
		//init theme core scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'wp-mediaelement' );
		
		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'appear', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/modernizr.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent' );
		wp_enqueue_script( 'owl-carousel', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fluidvids', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'perfect-scrollbar', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'scroll-to-plugin', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'parallax', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyphoto', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-easing-1.3', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'isotope', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'packery', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'parallax-scroll', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.parallax-scroll.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'swiper', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/swiper.min.js', array( 'jquery' ), false, true );

		do_action( 'laurent_elated_action_enqueue_third_party_scripts' );

		if ( laurent_elated_is_plugin_installed( 'woocommerce' ) ) {
			wp_enqueue_script( 'select2' );
		}

		if ( laurent_elated_is_page_smooth_scroll_enabled() ) {
			wp_enqueue_script( 'tweenLite', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/TweenLite.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'smooth-page-scroll', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/smoothPageScroll.js', array( 'jquery' ), false, true );
		}

		//include google map api script
		$google_maps_api_key          = laurent_elated_options()->getOptionValue( 'google_maps_api_key' );
		$google_maps_extensions       = '';
		$google_maps_extensions_array = apply_filters( 'laurent_elated_filter_google_maps_extensions_array', array('marker') );

		if ( ! empty( $google_maps_extensions_array ) ) {
			$google_maps_extensions .= '&libraries=';
			$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
		}

		if ( ! empty( $google_maps_api_key ) ) {
			wp_enqueue_script( 'laurent-elated-google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . "&loading=async&callback=qodefGoogleMapsCallback" . $google_maps_extensions, array(), false, true );
            if ( ! empty( $google_maps_extensions_array ) && is_array( $google_maps_extensions_array ) ) {
                wp_enqueue_script('geocomplete', LAURENT_ELATED_ASSETS_ROOT . '/js/modules/plugins/jquery.geocomplete.min.js', array('jquery', 'laurent-elated-google-map-api'), false, true);
            }

            //wp_add_inline_script('laurent-elated-google-map-api', 'window.qodefGoogleMapsCallback = function () {};','before');
		}

		wp_enqueue_script( 'laurent-elated-modules', LAURENT_ELATED_ASSETS_ROOT . '/js/modules.min.js', array( 'jquery' ), false, true );
		
		if ( laurent_elated_dashboard_page() || laurent_elated_has_dashboard_shortcodes() ) {
			$dash_array_deps = array(
				'jquery-ui-datepicker',
				'jquery-ui-sortable'
			);
			
			wp_enqueue_script( 'laurent-elated-dashboard', LAURENT_ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT . '/js/eltdf-dashboard.js', $dash_array_deps, false, true );
			
			wp_enqueue_script( 'wp-util' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
			wp_enqueue_script( 'wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1 );
			
			$colorpicker_l10n = array(
				'clear'         => esc_html__( 'Clear', 'laurent' ),
				'defaultString' => esc_html__( 'Default', 'laurent' ),
				'pick'          => esc_html__( 'Select Color', 'laurent' ),
				'current'       => esc_html__( 'Current Color', 'laurent' ),
			);
			
			wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
		}

		//include comment reply script
		$wp_scripts->add_data( 'comment-reply', 'group', 1 );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'laurent_elated_scripts' );
}

if ( ! function_exists( 'laurent_elated_theme_setup' ) ) {
	/**
	 * Function that adds various features to theme. Also defines image sizes that are used in a theme
	 */
	function laurent_elated_theme_setup() {
		//add support for feed links
		add_theme_support( 'automatic-feed-links' );

		//add support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );

		//add theme support for post thumbnails
		add_theme_support( 'post-thumbnails' );

		//add theme support for title tag
		add_theme_support( 'title-tag' );

        //add theme support for editor style
        add_editor_style( 'framework/admin/assets/css/editor-style.css' );

		//defined content width variable
		$GLOBALS['content_width'] = apply_filters( 'laurent_elated_filter_set_content_width', 1100 );

		//define thumbnail sizes
		add_image_size( 'laurent_elated_image_square', 650, 650, true );
		add_image_size( 'laurent_elated_image_landscape', 1300, 650, true );
		add_image_size( 'laurent_elated_image_portrait', 650, 1300, true );
		add_image_size( 'laurent_elated_image_huge', 1300, 1300, true );

		load_theme_textdomain( 'laurent', get_template_directory() . '/languages' );
	}

	add_action( 'after_setup_theme', 'laurent_elated_theme_setup' );
}

if ( ! function_exists( 'laurent_elated_enqueue_editor_customizer_styles' ) ) {
	/**
	 * Enqueue supplemental block editor styles
	 */
	function laurent_elated_enqueue_editor_customizer_styles() {
		wp_enqueue_style( 'themename-style-modules-admin-styles', LAURENT_ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/eltdf-modules-admin.css' );
		wp_enqueue_style( 'laurent-elated-editor-customizer-styles', LAURENT_ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/editor-customizer-style.css' );
	}

	// add google font
	add_action( 'enqueue_block_editor_assets', 'laurent_elated_google_fonts_styles' );
	// add action
	add_action( 'enqueue_block_editor_assets', 'laurent_elated_enqueue_editor_customizer_styles' );
}

if ( ! function_exists( 'laurent_elated_is_responsive_on' ) ) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function laurent_elated_is_responsive_on() {
		return laurent_elated_options()->getOptionValue( 'responsiveness' ) !== 'no';
	}
}

if ( ! function_exists( 'laurent_elated_rgba_color' ) ) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function laurent_elated_rgba_color( $color, $transparency ) {
		if ( $color !== '' && $transparency !== '' ) {
			$rgba_color = '';

			$rgb_color_array = laurent_elated_hex2rgb( $color );
			$rgba_color      .= 'rgba(' . implode( ', ', $rgb_color_array ) . ', ' . $transparency . ')';

			return $rgba_color;
		}
	}
}

if ( ! function_exists( 'laurent_elated_header_meta' ) ) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function laurent_elated_header_meta() { ?>

		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<link rel="profile" href="https://gmpg.org/xfn/11"/>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>

	<?php }

	add_action( 'laurent_elated_action_header_meta', 'laurent_elated_header_meta' );
}

if ( ! function_exists( 'laurent_elated_user_scalable_meta' ) ) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to laurent_elated_action_header_meta action
	 */
	function laurent_elated_user_scalable_meta() {
		//is responsiveness option is chosen?
		if ( laurent_elated_is_responsive_on() ) { ?>
			<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
		<?php } else { ?>
			<meta name="viewport" content="width=1200,user-scalable=yes">
		<?php }
	}

	add_action( 'laurent_elated_action_header_meta', 'laurent_elated_user_scalable_meta' );
}

if ( ! function_exists( 'laurent_elated_smooth_page_transitions' ) ) {
	/**
	 * Function that outputs smooth page transitions html if smooth page transitions functionality is turned on
	 * Hooked to laurent_elated_action_before_closing_body_tag action
	 */
	function laurent_elated_smooth_page_transitions() {
		$id = laurent_elated_get_page_id();

		if ( laurent_elated_get_meta_field_intersect( 'smooth_page_transitions', $id ) === 'yes' && laurent_elated_get_meta_field_intersect( 'page_transition_preloader', $id ) === 'yes' ) { ?>
			<div class="eltdf-smooth-transition-loader eltdf-mimic-ajax">
				<div class="eltdf-st-loader">
					<div class="eltdf-st-loader1">
						<?php laurent_elated_loading_spinners(); ?>
					</div>
				</div>
			</div>
		<?php }
	}

	add_action( 'laurent_elated_action_after_opening_body_tag', 'laurent_elated_smooth_page_transitions', 10 );
}

if ( ! function_exists( 'laurent_elated_back_to_top_button' ) ) {
	/**
	 * Function that outputs back to top button html if back to top functionality is turned on
	 * Hooked to laurent_elated_action_after_wrapper_inner action
	 */
	function laurent_elated_back_to_top_button() {
		if ( laurent_elated_options()->getOptionValue( 'show_back_button' ) == 'yes' ) { ?>
			<a id='eltdf-back-to-top' href='#'>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="43.047px" height="43.031px" viewBox="0 0 43.047 43.031" enable-background="new 0 0 43.047 43.031" xml:space="preserve">
                    <circle fill="none" stroke="#BC9A6B" stroke-miterlimit="10" cx="21.523" cy="21.531" r="20.986"/>
                    <circle fill="none" stroke="#BC9A6B" class="eltdf-popout" stroke-miterlimit="10" cx="21.523" cy="21.531" r="16.049"/>
                    <polyline fill="none" stroke="#BC9A6B" stroke-miterlimit="10" points="15.205,23.875 21.523,18.573 27.842,23.875 "/>
                </svg>
            </a>
		<?php }
	}
	
	add_action( 'laurent_elated_action_after_wrapper_inner', 'laurent_elated_back_to_top_button', 30 );
}

if ( ! function_exists( 'laurent_elated_get_page_id' ) ) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see laurent_elated_is_plugin_installed()
	 * @see laurent_elated_is_woocommerce_shop()
	 */
	function laurent_elated_get_page_id() {
		if ( laurent_elated_is_plugin_installed( 'woocommerce' ) && laurent_elated_is_woocommerce_shop() ) {
			return laurent_elated_get_woo_shop_page_id();
		}

		if ( laurent_elated_is_default_wp_template() ) {
			return - 1;
		}

		return get_queried_object_id();
	}
}

if ( ! function_exists( 'laurent_elated_get_multisite_blog_id' ) ) {
	/**
	 * Check is multisite and return blog id
	 *
	 * @return int
	 */
	function laurent_elated_get_multisite_blog_id() {
		if ( is_multisite() ) {
			return get_blog_details()->blog_id;
		}
	}
}

if ( ! function_exists( 'laurent_elated_is_default_wp_template' ) ) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function laurent_elated_is_default_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'laurent_elated_has_shortcode' ) ) {
	/**
	 * Function that checks whether shortcode exists on current page / post
	 *
	 * @param string shortcode to find
	 * @param string content to check. If isn't passed current post content will be used
	 *
	 * @return bool whether content has shortcode or not
	 */
	function laurent_elated_has_shortcode( $shortcode, $content = '' ) {
		$has_shortcode = false;

		if ( $shortcode ) {
			//if content variable isn't past
			if ( $content == '' ) {
				//take content from current post
				$page_id = laurent_elated_get_page_id();
				if ( ! empty( $page_id ) ) {
					$current_post = get_post( $page_id );

					if ( is_object( $current_post ) && property_exists( $current_post, 'post_content' ) ) {
						$content = $current_post->post_content;
					}
				}
			}

			//does content has shortcode added?
			if( has_shortcode( $content, $shortcode ) ) {
				$has_shortcode = true;
			}
		}

		return $has_shortcode;
	}
}

if ( ! function_exists( 'laurent_elated_get_unique_page_class' ) ) {
	/**
	 * Returns unique page class based on post type and page id
	 *
	 * $params int $id is page id
	 * $params bool $allowSingleProductOption
	 * @return string
	 */
	function laurent_elated_get_unique_page_class( $id, $allowSingleProductOption = false ) {
		$page_class = '';

		if ( laurent_elated_is_plugin_installed( 'woocommerce' ) && $allowSingleProductOption ) {

			if ( is_product() ) {
				$id = get_the_ID();
			}
		}

		if ( is_single() ) {
			$page_class = '.postid-' . $id;
		} elseif ( is_home() ) {
			$page_class .= '.home';
		} elseif ( is_archive() || $id === laurent_elated_get_woo_shop_page_id() ) {
			$page_class .= '.archive';
		} elseif ( is_search() ) {
			$page_class .= '.search';
		} elseif ( is_404() ) {
			$page_class .= '.error404';
		} else {
			$page_class .= '.page-id-' . $id;
		}

		return $page_class;
	}
}

if ( ! function_exists( 'laurent_elated_page_custom_style' ) ) {
	/**
	 * Function that print custom page style
	 */
	function laurent_elated_page_custom_style() {
		$style = apply_filters( 'laurent_elated_filter_add_page_custom_style', $style = '' );

		if ( $style !== '' ) {

			if ( laurent_elated_is_plugin_installed( 'woocommerce' ) && laurent_elated_load_woo_assets() ) {
				wp_add_inline_style( 'laurent-elated-woo', $style );
			} else {
				wp_add_inline_style( 'laurent-elated-modules', $style );
			}
		}
	}

	add_action( 'wp_enqueue_scripts', 'laurent_elated_page_custom_style' );
}

if ( ! function_exists( 'laurent_elated_print_custom_js' ) ) {
	/**
	 * Prints out custom css from theme options
	 */
	function laurent_elated_print_custom_js() {
		$custom_js = laurent_elated_options()->getOptionValue( 'custom_js' );

		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'laurent-elated-modules', $custom_js );
		}
	}

	add_action( 'wp_enqueue_scripts', 'laurent_elated_print_custom_js' );
}

if ( ! function_exists( 'laurent_elated_get_global_variables' ) ) {
	/**
	 * Function that generates global variables and put them in array so they could be used in the theme
	 */
	function laurent_elated_get_global_variables() {
		$global_variables = array();
		
		$global_variables['eltdfAddForAdminBar']      = is_admin_bar_showing() ? 32 : 0;
		$global_variables['eltdfElementAppearAmount'] = -100;
		$global_variables['eltdfAjaxUrl']             = esc_url( admin_url( 'admin-ajax.php' ) );
		$global_variables['sliderNavPrevArrow']       = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25.109px" height="34.906px" viewBox="0 0 25.109 34.906" enable-background="new 0 0 25.109 34.906" xml:space="preserve"><polyline fill="none" stroke="currentColor" stroke-miterlimit="10" points="24.67,34.59 11.653,17.464 24.67,0.338 "/><polyline fill="none" class="eltdf-popout" stroke="currentColor" stroke-miterlimit="10" points="13.688,34.59 0.671,17.464 13.688,0.338 "/></svg>';
		$global_variables['sliderNavNextArrow']       = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25.109px" height="34.906px" viewBox="0 0 25.109 34.906" enable-background="new 0 0 25.109 34.906" xml:space="preserve"><polyline fill="none" stroke="currentColor" stroke-miterlimit="10" points="0.442,34.59 13.459,17.464 0.442,0.338 "/><polyline fill="none" class="eltdf-popout" stroke="currentColor" stroke-miterlimit="10" points="11.425,34.59 24.441,17.464 11.425,0.338 "/></svg>';
		$global_variables['ppExpand']                 = esc_html__( 'Expand the image', 'laurent' );
		$global_variables['ppNext']                   = esc_html__( 'Next', 'laurent' );
		$global_variables['ppPrev']                   = esc_html__( 'Previous', 'laurent' );
		$global_variables['ppClose']                  = esc_html__( 'Close', 'laurent' );
		
		$global_variables = apply_filters( 'laurent_elated_filter_js_global_variables', $global_variables );
		
		wp_localize_script( 'laurent-elated-modules', 'eltdfGlobalVars', array(
			'vars' => $global_variables
		) );
	}

	add_action( 'wp_enqueue_scripts', 'laurent_elated_get_global_variables' );
}

if ( ! function_exists( 'laurent_elated_per_page_js_variables' ) ) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function laurent_elated_per_page_js_variables() {
		$per_page_js_vars = apply_filters( 'laurent_elated_filter_per_page_js_vars', array() );

		wp_localize_script( 'laurent-elated-modules', 'eltdfPerPageVars', array(
			'vars' => $per_page_js_vars
		) );
	}

	add_action( 'wp_enqueue_scripts', 'laurent_elated_per_page_js_variables' );
}

if ( ! function_exists( 'laurent_elated_content_elem_style_attr' ) ) {
	/**
	 * Defines filter for adding custom styles to content HTML element
	 */
	function laurent_elated_content_elem_style_attr() {
		$styles = apply_filters( 'laurent_elated_filter_content_elem_style_attr', array() );

		laurent_elated_inline_style( $styles );
	}
}

if ( ! function_exists( 'laurent_elated_is_plugin_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string
	 *
	 * @return bool
	 */
	function laurent_elated_is_plugin_installed( $plugin ) {
		switch ( $plugin ) {
			case 'core':
				return defined( 'LAURENT_CORE_VERSION' );
				break;
			case 'woocommerce':
				return function_exists( 'is_woocommerce' );
				break;
			case 'visual-composer':
				return class_exists( 'WPBakeryVisualComposerAbstract' );
				break;
			case 'revolution-slider':
				return class_exists( 'RevSliderFront' );
				break;
			case 'contact-form-7':
				return defined( 'WPCF7_VERSION' );
				break;
			case 'wpml':
				return defined( 'ICL_SITEPRESS_VERSION' );
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			case 'gutenberg-plugin':
				return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
				break;
            case 'elementor':
                return defined('ELEMENTOR_VERSION');
                break;
			case 'qi-blocks':
                return defined('QI_BLOCKS_VERSION');
                break;
			default:
				return false;
				break;
		}
	}
}

if ( ! function_exists( 'laurent_elated_get_module_part' ) ) {
	function laurent_elated_get_module_part( $module ) {
		return $module;
	}
}

if ( ! function_exists( 'laurent_elated_max_image_width_srcset' ) ) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function laurent_elated_max_image_width_srcset() {
		return 1920;
	}
	
	add_filter( 'max_srcset_image_width', 'laurent_elated_max_image_width_srcset' );
}


if ( ! function_exists( 'laurent_elated_has_dashboard_shortcodes' ) ) {
	/**
	 * Function that checks if current page has at least one of dashboard shortcodes added
	 * @return bool
	 */
	function laurent_elated_has_dashboard_shortcodes() {
		$dashboard_shortcodes = array();

		$dashboard_shortcodes = apply_filters( 'laurent_elated_filter_dashboard_shortcodes_list', $dashboard_shortcodes );

		foreach ( $dashboard_shortcodes as $dashboard_shortcode ) {
			$has_shortcode = laurent_elated_has_shortcode( $dashboard_shortcode );

			if ( $has_shortcode ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'laurent_elated_add_grid_lines' ) ) {

    function laurent_elated_add_grid_lines() {
        $id              = laurent_elated_get_page_id();
        $number_of_lines = laurent_elated_get_meta_field_intersect( 'content_grid_lines', $id );

        $html = '';
        if ( $number_of_lines !== 'none' ) {
            $html .= '<div class="eltdf-grid-lines-holder eltdf-grid-columns-' . esc_html( $number_of_lines ) . '">';
            for ( $i = 1; $i <= $number_of_lines; $i ++ ) {
                $html .= '<div class="eltdf-grid-line eltdf-grid-column-' . $i . '"></div>';
            }
            $html .= '</div>';
        }

        echo laurent_elated_get_module_part( $html );
    }

    add_action( 'laurent_elated_action_after_container_inner_open', 'laurent_elated_add_grid_lines' );
    add_action( 'laurent_elated_action_after_footer_top_container_inner_open', 'laurent_elated_add_grid_lines' );
    add_action( 'laurent_elated_action_after_footer_bottom_container_inner_open', 'laurent_elated_add_grid_lines' );
}

if ( ! function_exists( 'laurent_elated_add_two_grid_lines' ) ) {

    function laurent_elated_add_two_grid_lines() {
        $id          = laurent_elated_get_page_id();
        $lines       = laurent_elated_get_meta_field_intersect( 'content_two_grid_lines', $id );
        $header_type = laurent_elated_get_meta_field_intersect( 'header_type', $id );

        $html = '';
        if ( $lines == 'yes' && $header_type !== 'header-vertical' ) {
            $html .= '<div class="eltdf-double-grid-line-one"></div>' .
                     '<div class="eltdf-double-grid-line-two"></div>';
        }

        echo laurent_elated_get_module_part( $html );
    }

    add_action( 'laurent_elated_action_before_page_header', 'laurent_elated_add_two_grid_lines' );
}

if ( ! function_exists( 'laurent_elated_add_two_header_grid_lines' ) ) {

    function laurent_elated_add_two_header_grid_lines() {
        $id    = laurent_elated_get_page_id();
        $lines = laurent_elated_get_meta_field_intersect( 'content_two_grid_lines', $id );

        $html = '';
        if ( $lines == 'yes' ) {
            $html .= '<div class="eltdf-header-double-grid-line-one"></div>' .
                '<div class="eltdf-header-double-grid-line-two"></div>';
        }

        echo laurent_elated_get_module_part( $html );
    }

    add_action( 'laurent_elated_action_after_page_header_html_open', 'laurent_elated_add_two_header_grid_lines' );
}

if ( ! function_exists( 'laurent_elated_print_svg_arrow' ) ) {

    function laurent_elated_print_svg($svg, $color = 'currentColor') {

        $html = '';

        switch($svg) {

            case 'left-arrow':
                $html .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                    width="25.109px" height="34.906px" viewBox="0 0 25.109 34.906" enable-background="new 0 0 25.109 34.906" xml:space="preserve">
                    <polyline fill="none" stroke="'. $color .'" stroke-miterlimit="10" points="24.67,34.59 11.653,17.464 24.67,0.338 "/>
                    <polyline fill="none" class="eltdf-popout" stroke="'. $color .'" stroke-miterlimit="10" points="13.688,34.59 0.671,17.464 13.688,0.338 "/>
                </svg>';
                break;

            case 'right-arrow':
                $html .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                    width="25.109px" height="34.906px" viewBox="0 0 25.109 34.906" enable-background="new 0 0 25.109 34.906" xml:space="preserve">
                    <polyline fill="none" stroke="'. $color .'" stroke-miterlimit="10" points="0.442,34.59 13.459,17.464 0.442,0.338 "/>
                    <polyline fill="none" class="eltdf-popout" stroke="'. $color .'" stroke-miterlimit="10" points="11.425,34.59 24.441,17.464 11.425,0.338 "/>
                </svg>';
                break;

            case 'title-decoration':
                $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="41.125" height="9.146">
                            <path fill="none" stroke="#9C7C57" stroke-miterlimit="10" d="M40.881 8.576L20.562.591.244 8.576"/>
                            <path fill="none" stroke="#9C7C57" stroke-miterlimit="10" d="M40.881.591L20.562 8.576.243.591"/>
                        </svg>';
                break;

            case 'dd-arrows':
                $html .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                    width="8.328px" height="8.453px" viewBox="0 0 8.328 8.453" enable-background="new 0 0 8.328 8.453" xml:space="preserve">
                    <polyline fill="none" stroke="'. $color .'" stroke-miterlimit="10" points="0.449,0.36 3.587,4.234 0.449,8.109 "/>
                    <polyline fill="none" stroke="'. $color .'" stroke-miterlimit="10" points="4.514,0.36 7.652,4.234 4.514,8.109 "/>
                </svg>';
                break;

            case 'overlay-plus':
                $html .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="47.994px" height="47.994px" viewBox="0 0 47.994 47.994" enable-background="new 0 0 47.994 47.994" xml:space="preserve">
                    <line fill="none" stroke="#715B3E" stroke-miterlimit="10" x1="21.044" y1="3" x2="21.044" y2="47.994"/>
                    <line fill="none" stroke="#715B3E" stroke-miterlimit="10" x1="27.044" y1="0" x2="27.044" y2="44.994"/>
                    <line fill="none" stroke="#715B3E" stroke-miterlimit="10" x1="44.994" y1="21.484" x2="0" y2="21.484"/>
                    <line fill="none" stroke="#715B3E" stroke-miterlimit="10" x1="47.994" y1="26.5" x2="3" y2="26.5"/>
                </svg>';
                break;

            case 'close':
                $html .= '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                    width="12px" height="12px" viewBox="0 0 18.094 18.078" enable-background="new 0 0 18.094 18.078" xml:space="preserve">
                    <line fill="none" stroke="#C9AB81" stroke-miterlimit="10" x1="0.39" y1="0.391" x2="17.703" y2="17.703"/>
                    <line fill="none" stroke="#C9AB81" stroke-miterlimit="10" x1="0.39" y1="17.703" x2="17.703" y2="0.39"/>
                </svg>';
                break;

            default:
                $html .= '';
                break;
        }

        return $html;
    }
}


if( ! function_exists( 'laurent_elated_is_theme_registered' ) ) {
	function laurent_elated_is_theme_registered() {
		if( function_exists( 'laurent_core_is_theme_registered' ) ){
			return laurent_core_is_theme_registered();
		} else {
			return false;
		}
	}
}
if( ! function_exists( 'laurent_elated_add_registration_admin_notice' ) ) {
	function laurent_elated_add_registration_admin_notice() {
		if( laurent_elated_is_plugin_installed('core' ) &&  ! laurent_elated_is_theme_registered() ) {
			?>
			<div class="error">
				<p>
					<?php
					echo wp_kses_post( sprintf(
						__( 'Your copy of the theme has not been activated. Please navigate to <a href="%s">Laurent Dashboard</a> where you can input your purchase code and activate your copy of the theme so you can have access to all the theme features, elements & options.', 'laurent' ),
						admin_url('admin.php?page=laurent_core_dashboard')
					) );
					?>
				</p>
			</div>
			<?php
		}
	}
	add_action('admin_notices', 'laurent_elated_add_registration_admin_notice');
}