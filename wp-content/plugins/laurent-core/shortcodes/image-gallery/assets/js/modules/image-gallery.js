(function ($) {
	'use strict';
	
	var imageGallery = {};
	eltdf.modules.imageGallery = imageGallery;


	imageGallery.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorImageGallery();
	}

    /**
     * Elementor
     */
	function eltdfElementorImageGallery() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_image_gallery.default', function () {
				eltdf.modules.common.eltdfOwlSlider();
				eltdf.modules.common.eltdfInitGridMasonryListLayout();
			});
		});
	}
	
})(jQuery);