<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * laurent_elated_action_header_meta hook
	 *
	 * @see laurent_elated_header_meta() - hooked with 10
	 * @see laurent_elated_user_scalable_meta - hooked with 10
	 * @see laurent_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'laurent_elated_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
    <?php
        // Hook to include default WordPress hook after body tag open
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        }
    ?>
	<?php do_action( 'laurent_elated_action_after_opening_body_tag' ); ?>
    <div class="eltdf-wrapper">
        <div class="eltdf-wrapper-inner">
            <?php
            /**
             * laurent_elated_action_after_wrapper_inner hook
             *
             * @see laurent_elated_get_header() - hooked with 10
             * @see laurent_elated_get_mobile_header() - hooked with 20
             * @see laurent_elated_back_to_top_button() - hooked with 30
             * @see laurent_elated_get_header_minimal_full_screen_menu() - hooked with 40
             * @see laurent_elated_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'laurent_elated_action_after_wrapper_inner' ); ?>
	        
            <div class="eltdf-content" <?php laurent_elated_content_elem_style_attr(); ?>>
                <div class="eltdf-content-inner">