<?php laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/opener', 'woocommerce' ); ?>
<?php if ( is_object( WC()->cart ) ) { ?>
<div class="eltdf-sc-dropdown">
	<div class="eltdf-sc-dropdown-inner">
		<?php if ( ! WC()->cart->is_empty() ) {
			laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/loop', 'woocommerce' );
			
			laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/order-details', 'woocommerce' );
			
			laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/parts/button', 'woocommerce' );
		} else {
			laurent_elated_get_module_template_part( 'widgets/woocommerce-dropdown-cart/templates/posts-not-found', 'woocommerce' );
		} ?>
	</div>
</div>
<?php } ?>