(function ($) {
    'use strict';

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
    function eltdfOnDocumentReady() {
    }

    /*
    All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfElementorCallToAction();
    }

    /**
     * Elementor
     */
    function eltdfElementorCallToAction(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_call_to_action.default', function() {
                eltdf.modules.button.eltdfButton().init();
            } );
        });
    }

})(jQuery);