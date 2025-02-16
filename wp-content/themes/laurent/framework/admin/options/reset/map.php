<?php

if ( ! function_exists( 'laurent_elated_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function laurent_elated_reset_options_map() {
		
		laurent_elated_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'laurent' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = laurent_elated_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'laurent' )
			)
		);
		
		laurent_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'laurent' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'laurent' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'laurent_elated_action_options_map', 'laurent_elated_reset_options_map', laurent_elated_set_options_map_position( 'reset' ) );
}