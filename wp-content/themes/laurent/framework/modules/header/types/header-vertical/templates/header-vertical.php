<?php do_action('laurent_elated_action_before_page_header'); ?>

<aside class="eltdf-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
	<div class="eltdf-vertical-menu-area-inner">
		<div class="eltdf-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			laurent_elated_get_logo();
		} ?>
		<?php laurent_elated_get_header_vertical_main_menu(); ?>
		<?php if ( laurent_elated_is_header_widget_area_active( 'one' ) ) { ?>
			<div class="eltdf-vertical-area-widget-holder">
				<?php laurent_elated_get_header_widget_area_one(); ?>
			</div>
		<?php } ?>
	</div>
</aside>

<?php do_action('laurent_elated_action_after_page_header'); ?>