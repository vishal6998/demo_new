<?php

if ( ! function_exists( 'laurent_core_action_like' ) ) {
	/**
	 * Returns LaurentElatedClassLike instance
	 *
	 * @return LaurentElatedClassLike
	 */
	function laurent_core_action_like() {
		return LaurentElatedClassLike::get_instance();
	}
}

function laurent_core_get_like() {
	
	echo wp_kses( laurent_core_action_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}