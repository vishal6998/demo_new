(function($) {
	'use strict';
	
	var stackedImages = {};
	eltdf.modules.stackedImages = stackedImages;

	stackedImages.eltdfInitItemShowcase = eltdfInitStackedImages;


	stackedImages.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitStackedImages();
	}

    /**
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorStackedImages();
    }

    /**
     * Elementor
     */
    function eltdfElementorStackedImages(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_stacked_images.default', function() {
                eltdfInitStackedImages();
            } );
        });
    }

	/**
	 * Init item showcase shortcode
	 */
	function eltdfInitStackedImages() {
		var stackedImages = $('.eltdf-stacked-images-holder');

		if (stackedImages.length) {
			stackedImages.each(function(){
				var thisStackedImages = $(this),
					backgroundImage = thisStackedImages.find('.eltdf-si-first-image'),
                    middleImage = thisStackedImages.find('.eltdf-si-second-image'),
                    foregroundImage = thisStackedImages.find('.eltdf-si-third-image');

				if ( thisStackedImages.hasClass('eltdf-background-appear-from-top') || thisStackedImages.hasClass('eltdf-background-appear-from-left') || thisStackedImages.hasClass('eltdf-background-appear-from-right') || thisStackedImages.hasClass('eltdf-background-svg') ) {
                    backgroundImage.appear(function () {
                        backgroundImage.addClass('eltdf-appear');
                    }, {accX: 0, accY: 0});
                }

                if ( (thisStackedImages.hasClass('eltdf-middle-appear-from-top') || thisStackedImages.hasClass('eltdf-middle-appear-from-left') || thisStackedImages.hasClass('eltdf-middle-appear-from-right')) &&
                     (thisStackedImages.hasClass('eltdf-background-appear-from-top') || thisStackedImages.hasClass('eltdf-background-appear-from-left') || thisStackedImages.hasClass('eltdf-background-appear-from-right') || thisStackedImages.hasClass('eltdf-background-svg')) ) {
                    middleImage.appear(function () {
                        setTimeout( function() {
                            middleImage.addClass('eltdf-appear');
                        }, 500);
                    }, {accX: 0, accY: 0});
                } else {
                    middleImage.appear(function () {
                        middleImage.addClass('eltdf-appear');
                    }, {accX: 0, accY: 0});
                }

                if ( (thisStackedImages.hasClass('eltdf-foreground-appear-from-top') || thisStackedImages.hasClass('eltdf-foreground-appear-from-left') || thisStackedImages.hasClass('eltdf-foreground-appear-from-right')) &&
                     (thisStackedImages.hasClass('eltdf-middle-appear-from-top') || thisStackedImages.hasClass('eltdf-middle-appear-from-left') || thisStackedImages.hasClass('eltdf-middle-appear-from-right')) &&
                     (thisStackedImages.hasClass('eltdf-background-appear-from-top') || thisStackedImages.hasClass('eltdf-background-appear-from-left') || thisStackedImages.hasClass('eltdf-background-appear-from-right') || thisStackedImages.hasClass('eltdf-background-svg')) ) {
                    foregroundImage.appear(function () {
                        setTimeout( function() {
                            foregroundImage.addClass('eltdf-appear');
                        }, 1000);
                    }, {accX: 0, accY: 0});
                } else if ( (thisStackedImages.hasClass('eltdf-foreground-appear-from-top') || thisStackedImages.hasClass('eltdf-foreground-appear-from-left') || thisStackedImages.hasClass('eltdf-foreground-appear-from-right')) &&
                            (thisStackedImages.hasClass('eltdf-middle-appear-from-top') || thisStackedImages.hasClass('eltdf-middle-appear-from-left') || thisStackedImages.hasClass('eltdf-middle-appear-from-right')) ) {
                    foregroundImage.appear(function () {
                        setTimeout(function () {
                            foregroundImage.addClass('eltdf-appear');
                        }, 500);
                    }, {accX: 0, accY: 0});
                } else if ( (thisStackedImages.hasClass('eltdf-foreground-appear-from-top') || thisStackedImages.hasClass('eltdf-foreground-appear-from-left') || thisStackedImages.hasClass('eltdf-foreground-appear-from-right')) &&
                            (thisStackedImages.hasClass('eltdf-background-appear-from-top') || thisStackedImages.hasClass('eltdf-background-appear-from-left') || thisStackedImages.hasClass('eltdf-background-appear-from-right') || thisStackedImages.hasClass('eltdf-background-svg')) ) {
                    foregroundImage.appear(function () {
                        setTimeout( function() {
                            foregroundImage.addClass('eltdf-appear');
                        }, 500);
                    }, {accX: 0, accY: 0});
                } else {
                    foregroundImage.appear(function () {
                        foregroundImage.addClass('eltdf-appear');
                    }, {accX: 0, accY: 0});
                }
			});
		}
	}
	
})(jQuery);