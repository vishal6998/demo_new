(function($) {
    "use strict";

    var productListCarousel = {};
    eltdf.modules.productListCarousel = productListCarousel;

    productListCarousel.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorProductListCarousel();
    }

    /**
     * Elementor Blog List
     */
    function eltdfElementorProductListCarousel() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_product_list_carousel.default', function () {
                eltdf.modules.common.eltdfOwlSlider();
            });
        });
    }

})(jQuery);