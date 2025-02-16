(function($) {
    "use strict";

    var headerBottom = {};
    eltdf.modules.headerBottom = headerBottom;

    headerBottom.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfBottomMenuPosition();
    }

    function eltdfBottomMenuPosition() {
        var bottomHeader = $('.eltdf-header-bottom');
        
        if(bottomHeader.length && eltdf.windowWidth > 1024) {
            var slider = $('.eltdf-slider'),
                sliderHeightUsed = slider.length && slider.outerHeight() + eltdfGlobalVars.vars.eltdfMenuAreaHeight < eltdf.windowHeight,
                initialHeight = sliderHeightUsed ? slider.outerHeight() : eltdf.windowHeight - eltdfGlobalVars.vars.eltdfMenuAreaHeight,
                contentHolder = $('.eltdf-content'),
                footer = $('footer'),
                footerHeight = footer.outerHeight(),
                uncoveringFooter = footer.hasClass('eltdf-footer-uncover');
            
            if(slider.length > 0) {
                slider.addClass('eltdf-slider-fixed');
                contentHolder.css("padding-top", initialHeight);
            }
            
            $(window).scroll(function() {
                if(eltdf.windowWidth > 1024) {
                    calculatePosition(initialHeight, uncoveringFooter, footerHeight);
                }
            });
        }

        function calculatePosition(initialHeight, uncoveringFooter, footerHeight) {
            if(uncoveringFooter) {
                if(eltdf.window.scrollTop() > initialHeight) {
                    slider.css('margin-top', '-' + footerHeight + 'px');
                } else {
                    slider.css('margin-top', 0);
                }
            }
        }
    }

})(jQuery);