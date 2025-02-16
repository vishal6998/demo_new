(function ($) {
	'use strict';
	
	var instagramList = {};
	eltdf.modules.instagramList = instagramList;


	instagramList.eltdfOnWindowLoad = eltdfOnWindowLoad;

	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorInstagramList();
	}

    /**
     * Elementor
     */
	function eltdfElementorInstagramList() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_instagram_list.default', function () {
				eltdf.modules.common.eltdfOwlSlider();
			});
		});
	}
	
})(jQuery);