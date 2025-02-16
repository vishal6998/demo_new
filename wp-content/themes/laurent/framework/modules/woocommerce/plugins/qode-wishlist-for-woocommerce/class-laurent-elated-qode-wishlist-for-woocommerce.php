<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'Laurent_Elated_Qode_Wishlist_For_WooCommerce' ) ) {
	class Laurent_Elated_Qode_Wishlist_For_WooCommerce {
		private static $instance;

		public function __construct() {

			add_filter( 'qode_wishlist_for_woocommerce_filter_add_to_wishlist_behavior_default_value', array( $this, 'set_default_add_to_wishlist_behavior' ) );

			add_filter( 'qode_wishlist_for_woocommerce_filter_button_loop_position_default_value', array( $this, 'set_default_button_loop_position' ) );

			add_filter( 'qode_wishlist_for_woocommerce_filter_add_to_wishlist_loop_type_default_value', array( $this, 'set_default_add_to_wishlist_loop_type' ) );

			add_filter( 'qode_wishlist_for_woocommerce_filter_add_to_wishlist_holder_classes', array( $this, 'add_wishlist_button_class' ) );

			add_action( 'init', array( $this, 'set_button_loop_position' ), 15 );

			add_filter( 'qode_wishlist_for_woocommerce_filter_show_table_title_default_value', array( $this, 'disable_wishlist_page_title' ) );

			add_action( 'qode_wishlist_for_woocommerce_action_before_social_share_opener_icon', array( $this, 'add_social_share_title' ) );
		}

		/**
		 * @return Laurent_Elated_Qode_Wishlist_For_WooCommerce
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function set_default_add_to_wishlist_behavior() {
			return 'view';
		}

		public function set_default_button_loop_position() {
			return 'shortcode';
		}

		public function set_default_add_to_wishlist_loop_type() {
			return 'icon-with-text';
		}

		public function add_wishlist_button_class( $classes ) {
			if ( ! is_product() ) {
				$classes[] = 'button';
			}

			return $classes;
		}

		public function set_button_loop_position() {
			$button_loop_position = qode_wishlist_for_woocommerce_get_option_value( 'admin', 'qode_wishlist_for_woocommerce_button_loop_position' ) ?? '';

			// Add qode wishlist button shop archive pages.
			if ( 'shortcode' === $button_loop_position ) {
				add_action( 'laurent_elated_action_before_pl_inner_text_additional_tag_close', array( $this, 'render_button' ) );
			}

			// Add qode wishlist button product list shortcode.
			add_action( 'laurent_elated_action_product_list_shortcode', array( $this, 'render_button' ), 4 );
		}

		public function render_button() {
			if ( class_exists( 'Qode_Wishlist_For_WooCommerce_Add_To_Wishlist_Shortcode' ) ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo Qode_Wishlist_For_WooCommerce_Add_To_Wishlist_Shortcode::call_shortcode();
			}
		}

		public function disable_wishlist_page_title() {
			return 'no';
		}

		public function add_social_share_title() {
			echo '<span class="eltdf-wishlist-social-share-title">' . esc_html__( 'Share', 'laurent' ) . '</span>';
		}
	}

	Laurent_Elated_Qode_Wishlist_For_WooCommerce::get_instance();
}
