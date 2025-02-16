(function($) {
    'use strict';

    var portfolioSlider = {};
    eltdf.modules.portfolioSlider = portfolioSlider;

	portfolioSlider.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);


    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
		eltdfElementorPortfolioSlider();
    }

	/**
	 * Elementor
	 */
	function eltdfElementorPortfolioSlider(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_portfolio_slider.default', function() {
				eltdf.modules.common.eltdfOwlSlider();
				eltdf.modules.common.eltdfPrettyPhoto();
			} );
		});
	}

})(jQuery);