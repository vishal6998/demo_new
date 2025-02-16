(function($) {
    "use strict";

    var productList = {};
    eltdf.modules.productList = productList;

    productList.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorProductList();
    }

    /**
     * Elementor Product List
     */
    function eltdfElementorProductList() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_product_list.default', function () {
                eltdf.modules.common.eltdfInitGridMasonryListLayout();
            });
        });
    }

})(jQuery);