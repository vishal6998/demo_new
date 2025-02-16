<?php

if ( class_exists( 'LaurentCoreClassWidget' ) ) {
	class LaurentElatedClassWoocommerceDropdownCart extends LaurentCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_woocommerce_dropdown_cart',
				esc_html__('Laurent Woocommerce Dropdown Cart', 'laurent'),
				array('description' => esc_html__('Display a shop cart icon with a dropdown that shows products that are in the cart', 'laurent'),)
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'        => 'textfield',
					'name'        => 'woocommerce_dropdown_cart_margin',
					'title'       => esc_html__('Icon Margin', 'laurent'),
					'description' => esc_html__('Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'laurent')
				)
			);
		}
		
		public function widget( $args, $instance ) {
			// Prevent widgets from loading on WooCommerce cart page
			if ( is_cart() ) {
				return;
			}

			$icon_styles = array();
			
			if ( $instance['woocommerce_dropdown_cart_margin'] !== '' ) {
				$icon_styles[] = 'margin: ' . $instance['woocommerce_dropdown_cart_margin'];
			}
			?>
			<div class="eltdf-shopping-cart-holder" <?php laurent_elated_inline_style( $icon_styles ) ?>>
				<div class="eltdf-shopping-cart-inner">
					<?php laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/content', 'woocommerce' ); ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'laurent_elated_woocommerce_header_add_to_cart_fragment' ) ) {
	function laurent_elated_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<div class="eltdf-shopping-cart-inner">
			<?php laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/content', 'woocommerce' ); ?>
		</div>
		
		<?php
		$fragments['div.eltdf-shopping-cart-inner'] = ob_get_clean();
		
		return $fragments;
	}
	
	add_filter( 'woocommerce_add_to_cart_fragments', 'laurent_elated_woocommerce_header_add_to_cart_fragment' );
}
?>