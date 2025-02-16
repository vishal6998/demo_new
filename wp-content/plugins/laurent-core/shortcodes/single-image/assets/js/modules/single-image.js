(function($) {
    'use strict';

    var singleImage = {};
    eltdf.modules.singleImage = singleImage;

    singleImage.eltdfInitSingleImage = eltdfInitSingleImage;


    singleImage.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitSingleImage();
    }
    /**
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorSingleImage();
    }

    /**
     * Elementor
     */
    function eltdfElementorSingleImage(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_single_image.default', function() {
                eltdfInitSingleImage();
            } );
        });
    }

    /**
     * Single Image Shortcode
     */
    function eltdfInitSingleImage() {
        var imageHolder = $('.eltdf-single-image-holder');

        if (imageHolder.length) {
            imageHolder.each(function() {
                var thisImageHolder = $(this);

                if ( thisImageHolder.hasClass('eltdf-image-appear-from-top') || thisImageHolder.hasClass('eltdf-image-appear-from-left') || thisImageHolder.hasClass('eltdf-image-appear-from-right') ) {
                    var ornament = thisImageHolder.find('.eltdf-si-ornament');

                    if ( ornament.length ) {
                        thisImageHolder.appear(function () {
                            ornament.addClass('eltdf-appear');
                            setTimeout( function() {
                                thisImageHolder.addClass('eltdf-appear');
                            }, 500);
                        }, {accX: 0, accY: -150});
                    } else {
                        thisImageHolder.appear(function () {
                            thisImageHolder.addClass('eltdf-appear');
                        }, {accX: 0, accY: 0});
                    }
                }
            });
        }
    }

})(jQuery);