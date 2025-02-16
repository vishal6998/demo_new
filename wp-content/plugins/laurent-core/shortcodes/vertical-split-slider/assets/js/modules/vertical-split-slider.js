(function($) {
    'use strict';

    var verticalSplitSlider = {};
    eltdf.modules.verticalSplitSlider = verticalSplitSlider;

    verticalSplitSlider.eltdfInitVerticalSplitSlider = eltdfInitVerticalSplitSlider;
    verticalSplitSlider.eltderticalSplitResponsivePadding = eltderticalSplitResponsivePadding;


    verticalSplitSlider.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitVerticalSplitSlider();
        eltderticalSplitResponsivePadding();
    }

    /**
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorVerticalSplitSlider();
    }

    /**
     * Elementor
     */
    function eltdfElementorVerticalSplitSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_vertical_split_slider.default', function() {
                eltdfInitVerticalSplitSlider();
                eltderticalSplitResponsivePadding();
            } );
        });
    }

    /*
     **	Vertical Split Slider
     */
    function eltdfInitVerticalSplitSlider() {

        var slider = $('.eltdf-vertical-split-slider'),
            contentOffset = $('.eltdf-content').offset().top,
            progressBarFlag = true;

        if (slider.length) {
            if (eltdf.body.hasClass('eltdf-vss-initialized')) {
                return;
            }

            slider.height(eltdf.windowHeight).animate({opacity: 1}, 300);
            slider.css('margin-top', -contentOffset + 'px');

            var defaultHeaderStyle = '';
            if (eltdf.body.hasClass('eltdf-light-header')) {
                defaultHeaderStyle = 'light';
            } else if (eltdf.body.hasClass('eltdf-dark-header')) {
                defaultHeaderStyle = 'dark';
            }

            slider.multiscroll({
                scrollingSpeed: 700,
                easing: 'easeInOutQuart',
                navigation: true,
                useAnchorsOnLoad: false,
                sectionSelector: '.eltdf-vss-ms-section',
                leftSelector: '.eltdf-vss-ms-left',
                rightSelector: '.eltdf-vss-ms-right',
                afterRender: function () {
                    eltdfCheckVerticalSplitSectionsForHeaderStyle($('.eltdf-vss-ms-left .eltdf-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
                    eltdf.body.addClass('eltdf-vss-initialized');

                    var contactForm7 = $('div.wpcf7 > form');
                    if (contactForm7.length) {
                        contactForm7.each(function(){
                            var thisForm = $(this);

                            thisForm.find('.wpcf7-submit').off().on('click', function(e){
                                e.preventDefault();

                                wpcf7['submit'](thisForm);
                            });
                        });
                    }

                    //prepare html for smaller screens - start //
                    var verticalSplitSliderResponsive = $('<div class="eltdf-vss-responsive"></div>'),
                        leftSide = slider.find('.eltdf-vss-ms-left > div'),
                        rightSide = slider.find('.eltdf-vss-ms-right > div'),
                        mobileHeaderHeight = $('.eltdf-mobile-header').outerHeight(true);

                    slider.after(verticalSplitSliderResponsive);

                    for (var i = 0; i < leftSide.length; i++) {
                        verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
                        verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
                    }

                    var firstSlide = verticalSplitSliderResponsive.find('.eltdf-vss-ms-section:first-child'),
                        firstSlideInner = firstSlide.find('.ms-tableCell');

                    firstSlide.css('height', '100%').css('height', '-=' + mobileHeaderHeight + 'px');
                    firstSlideInner.css('height', firstSlide.outerHeight(true));

                    //prepare google maps clones
                    var googleMapHolder = $('.eltdf-vss-responsive .eltdf-google-map');
                    if (googleMapHolder.length) {
                        googleMapHolder.each(function () {
                            var map = $(this);
                            map.empty();
                            var num = Math.floor((Math.random() * 100000) + 1);
                            map.attr('id', 'eltdf-map-' + num);
                            map.data('unique-id', num);
                        });
                    }

                    if (typeof eltdf.modules.animationHolder.eltdfInitAnimationHolder === "function") {
                        eltdf.modules.animationHolder.eltdfInitAnimationHolder();
                    }

                    if (typeof eltdf.modules.common.eltdfPrettyPhoto === "function") {
                        eltdf.modules.common.eltdfPrettyPhoto();
                    }

                    if (typeof eltdf.modules.button.eltdfButton === "function") {
                        eltdf.modules.button.eltdfButton().init();
                    }

                    if (typeof eltdf.modules.elementsHolder.eltdfInitElementsHolderResponsiveStyle === "function") {
                        eltdf.modules.elementsHolder.eltdfInitElementsHolderResponsiveStyle();
                    }

                    if (typeof eltdf.modules.googleMap.eltdfShowGoogleMap === "function") {
                        eltdf.modules.googleMap.eltdfShowGoogleMap();
                    }

                    if (typeof eltdf.modules.icon.eltdfIcon === "function") {
                        eltdf.modules.icon.eltdfIcon().init();
                    }

                    if (progressBarFlag && typeof eltdf.modules.progressBar.eltdfInitProgressBars === "function" && ($('.eltdf-vss-ms-left .eltdf-vss-ms-section.active').find('.eltdf-progress-bar').length || $('.eltdf-vss-ms-right .eltdf-vss-ms-section.active').find('.eltdf-progress-bar').length)){
                        eltdf.modules.progressBar.eltdfInitProgressBars();
                        progressBarFlag = false;
                    }
                },
                onLeave: function (index, nextIndex) {
                    if (progressBarFlag && typeof eltdf.modules.progressBar.eltdfInitProgressBars === "function" && ($('.eltdf-vss-ms-left .eltdf-vss-ms-section.active').find('.eltdf-progress-bar').length || $('.eltdf-vss-ms-right .eltdf-vss-ms-section.active').find('.eltdf-progress-bar').length)){
                        setTimeout(function(){
                            eltdf.modules.progressBar.eltdfInitProgressBars();
                        },700); // scrolling speed is 700

                        progressBarFlag = false;
                    }

                    eltdfIntiScrollAnimation(slider, nextIndex);
                    eltdfCheckVerticalSplitSectionsForHeaderStyle($($('.eltdf-vss-ms-left .eltdf-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
                }
            });

            if (eltdf.windowWidth <= 1024) {
                $.fn.multiscroll.destroy();
            } else {
                $.fn.multiscroll.build();
            }

            $(window).resize(function () {
                if (eltdf.windowWidth <= 1024) {
                    $.fn.multiscroll.destroy();
                } else {
                    $.fn.multiscroll.build();
                }
            });
        }
    }

    function eltdfIntiScrollAnimation(slider, nextIndex) {

        if (slider.hasClass('eltdf-vss-scrolling-animation')) {

            if (nextIndex > 1 && !slider.hasClass('eltdf-vss-scrolled')) {
                slider.addClass('eltdf-vss-scrolled');
            } else if (nextIndex === 1 && slider.hasClass('eltdf-vss-scrolled')) {
                slider.removeClass('eltdf-vss-scrolled');
            }
        }
    }

    /*
     **	Check slides on load and slide change for header style changing
     */
    function eltdfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
        if (section_header_style !== undefined && section_header_style !== '') {
            eltdf.body.removeClass('eltdf-light-header eltdf-dark-header').addClass('eltdf-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            eltdf.body.removeClass('eltdf-light-header eltdf-dark-header').addClass('eltdf-' + default_header_style + '-header');
        } else {
            eltdf.body.removeClass('eltdf-light-header eltdf-dark-header');
        }
    }

    /*
     **	Slider responsive padding style
     */
    function eltderticalSplitResponsivePadding() {
        var holder = $('.eltdf-vertical-split-slider');

        if (holder.length) {
            holder.each(function () {
                var thisItem = $(this),
                    slidingPanels = thisItem.find(".eltdf-vss-ms-section");

                if (slidingPanels.length) {

                    slidingPanels.each(function () {
                        var thisItem = $(this),
                            itemClass = '',
                            laptopStyle = '',
                            ipadStyle = '',
                            mobileStyle = '',
                            style = '',
                            responsiveStyle = '';

                        if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                            itemClass = thisItem.data('item-class');
                        }
                        if (typeof thisItem.data('item-padding-1440') !== 'undefined') {
                            laptopStyle += 'padding: ' + thisItem.data('item-padding-1440') + ' !important;';
                        }
                        if (typeof thisItem.data('item-padding-1024') !== 'undefined') {
                            ipadStyle += 'padding: ' + thisItem.data('item-padding-1024') + ' !important;';
                        }
                        if (typeof thisItem.data('item-padding-480') !== 'undefined') {
                            mobileStyle += 'padding: ' + thisItem.data('item-padding-480') + ' !important;';
                        }

                        if (laptopStyle.length || ipadStyle.length || mobileStyle.length) {

                            if (laptopStyle.length) {
                                responsiveStyle += "@media only screen and (max-width: 1440px) {.eltdf-vss-ms-section." + itemClass + " { " + laptopStyle + " } }";
                            }
                            if (ipadStyle.length) {
                                responsiveStyle += "@media only screen and (max-width: 1024px) {.eltdf-vss-ms-section." + itemClass + " { " + ipadStyle + " } }";
                            }
                            if (mobileStyle.length) {
                                responsiveStyle += "@media only screen and (max-width: 480px) {.eltdf-vss-ms-section." + itemClass + " { " + mobileStyle + " } }";
                            }
                        }

                        if (responsiveStyle.length) {
                            style = '<style type="text/css">' + responsiveStyle + '</style>';
                        }

                        if (style.length) {
                            $('head').append(style);
                        }
                    });
                }
            });
        }
    }

})(jQuery);