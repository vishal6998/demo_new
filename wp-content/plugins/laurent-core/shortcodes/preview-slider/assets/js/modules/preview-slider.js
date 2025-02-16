(function($) {
	'use strict';
	
	var previewSlider = {};
	eltdf.modules.previewSlider = previewSlider;
	
	previewSlider.eltdfInitPreviewSlider = eltdfInitPreviewSlider;
	
	previewSlider.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
    $(window).on('load', eltdfOnWindowLoad);
    
    /* 
        All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfInitPreviewSlider();
        eltdfElementorPreviewSlider();
    }

    /**
     * Elementor
     */
    function eltdfElementorPreviewSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_preview_slider.default', function() {
                eltdfInitPreviewSlider();
            } );
        });
    }

    /*
     **	Init Preview Slider - Start
     */

    function eltdfInitPreviewSlider() {

        var sliders = $('.eltdf-preview-slider');
            sliders.each(function() {
    
                var slider = $(this);
    
                var autoplay = false,
                    autoPlaySpeed = 2000;
    
                if(typeof slider.data('autoplay') !== 'undefined' && slider.data('autoplay') === 'yes'){
                    autoplay = true;
                }
    
                if(typeof slider.data('autoplay-speed') !== 'undefined' && slider.data('autoplay-speed') !== ''){
                    autoPlaySpeed = slider.data('autoplay-speed');
                }

                var slickImages = {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    speed: 1000,
                    autoplay: autoplay,
                    autoplaySpeed: autoPlaySpeed,
                    arrows: false,
                    vertical: true,
                    useCSS: false,
                    easing: 'easeInOutCubic',
                    draggable: false,
                    infinite: true,
                    pauseOnHover: false
                };

                if($('#eltdf-main-rev-holder').length) {
                    setTimeout(function() {
                        var tabletSlider = slider.find('.eltdf-ps-tablet-images').slick(slickImages);
                        slider.find('.eltdf-ps-tablet-holder').css({'opacity': 1, 'transform': 'translateY(0)'});
                        setTimeout(function() {
                            var laptopSlider = slider.find('.eltdf-ps-laptop-images').slick(slickImages);
                            slider.find('.eltdf-ps-laptop-holder').css({'opacity': 1, 'transform': 'translateY(0)'});
                        }, 100);
                        setTimeout(function() {
                            var mobileSlider = slider.find('.eltdf-ps-mobile-images').slick(slickImages);
                            slider.find('.eltdf-ps-mobile-holder').css({'opacity': 1, 'transform': 'translateY(0)'});
                        }, 250);
                    }, 3800);
                } else {
                    var tabletSlider = slider.find('.eltdf-ps-tablet-images').slick(slickImages);
                    slider.find('.eltdf-ps-tablet-holder').css({'opacity': 1, 'transform': 'translateY(0)'});
                    setTimeout(function() {
                        var laptopSlider = slider.find('.eltdf-ps-laptop-images').slick(slickImages);
                        slider.find('.eltdf-ps-laptop-holder').css({'opacity': 1, 'transform': 'translateY(0)'});
                    }, 100);
                    setTimeout(function() {
                        var mobileSlider = slider.find('.eltdf-ps-mobile-images').slick(slickImages);
                        slider.find('.eltdf-ps-mobile-holder').css({'opacity': 1, 'transform': 'translateY(0)'});
                    }, 250);
                }            
                slider.addClass('eltdf-preview-slider-loaded');
            });
    }
	
})(jQuery);