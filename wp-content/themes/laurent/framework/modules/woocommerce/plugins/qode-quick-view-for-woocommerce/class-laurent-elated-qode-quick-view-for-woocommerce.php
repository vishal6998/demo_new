<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'Laurent_Elated_Qode_Quick_View_For_WooCommerce' ) ) {
	class Laurent_Elated_Qode_Quick_View_For_WooCommerce {
		private static $instance;

		public function __construct() {
			add_action( 'init', array( $this, 'init' ), 21 );
		}

		/**
		 * @return Laurent_Elated_Qode_Quick_View_For_WooCommerce
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function init() {
			// Unset default templates modules.
			$this->unset_templates_modules();
			// Change default templates position.
			$this->change_templates_position();
		}

		public function unset_templates_modules() {
			// Override product title.
			add_filter( 'qode_quick_view_for_woocommerce_filter_is_product_title_enabled', '__return_false' );
			add_action( 'qode_quick_view_for_woocommerce_action_product_summary', array( $this, 'quick_view_template_single_title'  ), 5 );

			// Remove product meta.
			add_filter( 'qode_quick_view_for_woocommerce_filter_is_product_meta_enabled', '__return_false', 30 );
		}

		public function change_templates_position() {
			// Remove qode quick view button button on shop page.
			add_filter( 'qode_quick_view_for_woocommerce_filter_quick_view_button_loop_position', array( $this, 'set_default_button_loop_position' ), 15 );

			if ( class_exists( 'Qode_Quick_View_For_WooCommerce_Module' ) ) {
				$quick_view_object = Qode_Quick_View_For_WooCommerce_Module::get_instance();
				// Add qode quick view button shop archive pages
				add_action( 'laurent_elated_action_product_list_shortcode', array(
					$quick_view_object,
					'add_button'
				), 14 );
				add_action( 'laurent_elated_action_before_pl_inner_text_additional_tag_close', array(
					$quick_view_object,
					'add_button'
				), 3 );
			}

			add_filter( 'qode_quick_view_for_woocommerce_filter_quick_view_button_wrapper_classes', array( $this, 'set_quick_view_button_theme_class' ) );
			add_filter( 'qode_quick_view_for_woocommerce_filter_set_quick_view_classes', array( $this, 'set_quick_view_popup_theme_class' ) );
		}

		public function quick_view_template_single_title() {
			the_title( '<h4  itemprop="name" class="eltdf-qode-quick-view-product-title entry-title">', '</h4>' );
		}

		public function set_default_button_loop_position() {
			return 'shortcode'; // or empty, in order to remove default quick view button
		}

		public function set_quick_view_button_theme_class( $classes ) {
			$classes[] = 'eltdf-laurent-theme';

			return $classes;
		}

		public function set_quick_view_popup_theme_class( $classes ) {
			$classes[] = 'qqvfw eltdf-laurent-theme';

			return $classes;
		}
	}
}

if ( ! function_exists( 'laurent_elated_init_quick_view_module' ) ) {
	/**
	 * Init main quick view module instance.
	 */
	function laurent_elated_init_quick_view_module() {
		Laurent_Elated_Qode_Quick_View_For_WooCommerce::get_instance();
	}

	add_action( 'init', 'laurent_elated_init_quick_view_module', 15 );
}