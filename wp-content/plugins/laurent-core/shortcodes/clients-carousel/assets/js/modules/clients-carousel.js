(function ($) {
	'use strict';
	
	var clientsCarousel = {};
	eltdf.modules.clientsCarousel = clientsCarousel;


	clientsCarousel.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorClientsCarousel();
	}

    /**
     * Elementor
     */
	function eltdfElementorClientsCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_clients_carousel.default', function () {
				eltdf.modules.common.eltdfOwlSlider();
			});
		});
	}
	
})(jQuery);