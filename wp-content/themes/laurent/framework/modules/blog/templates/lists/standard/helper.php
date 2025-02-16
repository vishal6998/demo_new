<?php

if ( ! function_exists( 'laurent_elated_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function laurent_elated_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'eltdf-container';
		$params_list['inner']  = 'eltdf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'laurent_elated_filter_blog_holder_params', 'laurent_elated_get_blog_holder_params' );
}

if ( ! function_exists( 'laurent_elated_blog_part_params' ) ) {
	function laurent_elated_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h3';
		$part_params['link_tag']  = 'h5';
		$part_params['quote_tag'] = 'h5';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'laurent_elated_filter_blog_part_params', 'laurent_elated_blog_part_params' );
}