<?php

if ( ! function_exists( 'laurent_core_add_import_sub_page_to_list' ) ) {
	function laurent_core_add_import_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'LaurentCoreImportPage';
		return $sub_pages;
	}
	
	add_filter( 'laurent_core_filter_add_sub_page', 'laurent_core_add_import_sub_page_to_list', 11 );
}

if ( class_exists( 'LaurentCoreSubPage' ) ) {
	class LaurentCoreImportPage extends LaurentCoreSubPage {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_title( esc_html__('Import', 'laurent-core'));
			$this->set_atts( $this->set_atributtes());
		}

		public function set_atributtes(){
			$params = array();

			$iparams = LaurentCoreDashboard::get_instance()->get_import_params();
			if(is_array($iparams) && isset($iparams['submit'])) {
				$params['submit'] = $iparams['submit'];
			}

			return $params;
		}
	}
}