(function ($) {
    'use strict';

    var iconWithText = {};
    eltdf.modules.iconWithText = iconWithText;

    iconWithText.eltdfInitIconWithText = eltdfInitIconWithText;


    iconWithText.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitIconWithText().init();
    }

    /**
    All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfElementorIconWithText();
    }

    /**
     * Elementor
     */
    function eltdfElementorIconWithText(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_icon_with_text.default', function() {
                eltdf.modules.icon.eltdfIcon().init();
                eltdfInitIconWithText().init();
            } );
        });
    }


    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var eltdfInitIconWithText = function () {
        //all buttons on the page
        var icons = $('.eltdf-iwt');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var iwtHoverColor = function (icon) {
            if (typeof icon.data('title-hover-color') !== 'undefined') {
                var iconTitle = icon.find('.eltdf-iwt-title a'),
                    originalColor = icon.data('title-color'),
                    hoverColor = icon.data('title-hover-color');

                iconTitle.on('mouseenter', function(){
                    $(this).css('color', hoverColor);
                });

                iconTitle.on('mouseleave', function(){
                    $(this).css('color', originalColor);
                });
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iwtHoverColor($(this));
                    });
                }
            }
        };
    };

})(jQuery);