(function ($) {
	'use strict';
	
	var videoButton = {};
	eltdf.modules.videoButton = videoButton;


    videoButton.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
        eltdfElementorVideoButton();
	}


    /**
     * Elementor Video Button
     */
    function eltdfElementorVideoButton() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_video_button.default', function () {
                eltdf.modules.common.eltdfPrettyPhoto();
            });
        });
    }
	
})(jQuery);