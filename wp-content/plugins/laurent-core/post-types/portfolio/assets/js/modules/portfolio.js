(function($) {
	'use strict';
	
	var portfolio = {};
	eltdf.modules.portfolio = portfolio;
	
	portfolio.eltdfOnWindowLoad = eltdfOnWindowLoad;
    portfolio.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitPortfolioSlider();
    }
	
	/*
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfPortfolioSingleFollow().init();
        eltdfInitPortfolioGalleryFollowInfo();
        eltdfInitPortfolioSliderHeight();
	}
	
	var eltdfPortfolioSingleFollow = function () {
		var info = $('.eltdf-follow-portfolio-info .eltdf-portfolio-single-holder .eltdf-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.eltdf-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				mediaHolderOffset = mediaHolder.offset().top,
				mediaHolderItemSpace = parseInt(mediaHolder.find('.eltdf-ps-image:last-of-type').css('marginBottom'), 10),
				header = $('.header-appear, .eltdf-fixed-wrapper'),
				headerHeight = header.length ? header.height() : 0;
			
			var stickyHolderPosition = function () {
				if (mediaHolderHeight >= infoHolderHeight) {
					var scrollValue = eltdf.scroll;
					
					//Calculate header height if header appears
					if (scrollValue > 0 && header.length) {
						headerHeight = header.height();
					}
					
					var headerMixin = headerHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar;
					if (scrollValue >= mediaHolderOffset - headerMixin) {
						if (scrollValue + infoHolderHeight >= mediaHolderHeight + mediaHolderOffset - mediaHolderItemSpace - headerMixin) {
							info.stop().animate({
								marginTop: mediaHolderHeight - mediaHolderItemSpace - infoHolderHeight
							});
							//Reset header height
							headerHeight = 0;
						} else {
							info.stop().animate({
								marginTop: scrollValue - mediaHolderOffset + headerMixin
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			};
		}
		
		return {
			init: function () {
				if (info.length) {
					stickyHolderPosition();
					$(window).scroll(function () {
						stickyHolderPosition();
					});
				}
			}
		};
	};

    /**
     * Init Portfolio Slider shortcode
     */
    function eltdfInitPortfolioSlider () {
        var sliders = $('.eltdf-portfolio-slider-holder');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this),
                    dataHolder = slider.find('.eltdf-portfolio-list-holder'),
                    sliderImage = slider.find('.eltdf-pli-image img'),
                    swiperInstance = slider.find('.swiper-container')[0],
                    enableLoop = true,
                    enableAutoplay = true,
                    mousewheel = true,
                    slideSpace = 0,
                    slideDuration = 5000,
                    slideSpeed = 1200,
                    numberOfColumns = 'auto';

                if (dataHolder.data('enable-loop') === 'no') {
                    enableLoop = false;
                }

                if (dataHolder.data('enable-autoplay') === 'no') {
                    enableAutoplay = false;
                }

                if (dataHolder.data('enable-mouse-scroll') === 'no') {
                    mousewheel = false;
                }

                if (dataHolder.data('enable-auto-width') === 'yes') {
                    numberOfColumns = 'auto';
                } else {
                    numberOfColumns = dataHolder.data('number-of-columns');

                    switch (numberOfColumns) {
                        case 'one':
                            numberOfColumns = 1;
                            break;
                        case 'two':
                            numberOfColumns = 2;
                            break;
                        case 'three':
                            numberOfColumns = 3;
                            break;
                        case 'four':
                            numberOfColumns = 4;
                            break;
                        case 'five':
                            numberOfColumns = 5;
                            break;
                        case 'six':
                            numberOfColumns = 6;
                            break;
                        default:
                            numberOfColumns = 3;
                    }

                }

                if (enableAutoplay !== false) {
                    slideDuration = dataHolder.data('slider-speed');

                    enableAutoplay = {
                        delay: slideDuration,
                    }
                }

                if (typeof dataHolder.data('slider-speed-animation') !== 'undefined' && dataHolder.data('slider-speed-animation') !== false) {
                    slideSpeed = dataHolder.data('slider-speed-animation');
                }

                if (typeof dataHolder.data('space-between-items') !== 'undefined' && dataHolder.data('space-between-items') !== false) {
                    slideSpace = dataHolder.data('space-between-items');

                    if(slideSpace === 'huge') {
                        slideSpace = 60
                    } else if(slideSpace === 'large') {
                        slideSpace = 50
                    } else if(slideSpace === 'medium') {
                        slideSpace = 40
                    } else if(slideSpace === 'normal') {
                        slideSpace = 30
                    } else if(slideSpace === 'small') {
                        slideSpace = 20
                    } else if(slideSpace === 'tiny') {
                        slideSpace = 10
                    } else {
                        slideSpace = 0
                    }
                }

                var addParallaxData = function() {
                    sliderImage.attr('data-swiper-parallax', '10%');
                };

                var dragTrigger = function () {
                    var xPosStart = 0,
                        xPos;

                    $(document).on('touchstart', slider, function (e) {
                        xPosStart = e.originalEvent.touches[0].pageX;
                    }).on('touchmove', slider, function (e) {
                        xPos = e.originalEvent.touches[0].pageX;

                        if (xPos > xPosStart) {
                            swiperSlider.slideNext(slideSpeed);
                        } else {
                            swiperSlider.slidePrev(slideSpeed);
                        }
                    }).on('touchend', slider, function () {
                        xPosStart = 0;
                        xPos = 0;
                    });
                };

                var swiperSlider = new Swiper(swiperInstance, {
                    autoplay: enableAutoplay,
                    loop: enableLoop,
                    slidesPerView: numberOfColumns,
                    speed: slideSpeed,
                    parallax: true,
                    init: true,
                    mousewheel: mousewheel,
                    spaceBetween: slideSpace,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        type: 'bullets',
                        clickable: true
                    },
                });

                swiperSlider.on('init', function () {
                    dragTrigger();
                });

                $(window).on('load', function(){
                    slider.addClass('eltdf-initialized');
                    swiperSlider.init();
                    addParallaxData();
                });
            });
        }
    }

    /**
     * Make slider fullscreen
     */
    function eltdfInitPortfolioSliderHeight(){
        var sliders = $('.eltdf-portfolio-slider-holder.eltdf-pfs-fullscreen');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this);
                var listHolder = slider.find('.eltdf-portfolio-list-holder');
                var fromTop = 0;
                var fromBottom = $('.eltdf-page-footer').outerHeight();
                var finalHeight;

                var calcHeight = function () {
                    if( eltdf.windowWidth > 1024 ) {
                        fromTop = $('.eltdf-page-header').outerHeight(true);
                    } else {
                        fromTop = $('.eltdf-mobile-header').outerHeight(true);
                    }

                    if(eltdf.body.hasClass('admin-bar')) {
                        $('html').css('height', 'auto');
                        fromTop =  fromTop + $('#wpadminbar').outerHeight();
                    }

                    var dotsHeight = slider.find('.swiper-pagination').outerHeight(true);

                    if(dotsHeight && listHolder.hasClass('eltdf-pag-below-slider')) {
                        fromBottom = fromBottom + dotsHeight;
                    }

                    finalHeight = eltdf.windowHeight - fromTop - fromBottom;

                    slider.find('article').each(function(){
                        var thisItem = $(this),

                            thisItemsWidth = thisItem.find('img').innerWidth();

                        if(listHolder.hasClass('eltdf-auto-width')) {
                            thisItem.css({
                                'width': thisItemsWidth
                            });
                        }

                        thisItem.css({
                            'height': finalHeight
                        });
                    });

                    slider.find('.swiper-wrapper').css({'height': finalHeight});
                };

                calcHeight();

                $(window).on('resize', function() {
                    calcHeight();
                });
            });
        }
    }

    function eltdfInitPortfolioGalleryFollowInfo() {
        var portList = $('.eltdf-portfolio-info-float');

        if (portList.length) {
            eltdf.body.append('<div class="eltdf-pl-follow-info-holder">' +
                '<div class="eltdf-pl-follow-info-inner">' +
                '<span class="eltdf-pl-follow-info-title">Title</span>' +
                '</div>' +
                '</div>');

            var followInfoHolder = $('.eltdf-pl-follow-info-holder'),
                followInfoCategory = followInfoHolder.find('.eltdf-pl-follow-info-categories'),
                followInfoTitle = followInfoHolder.find('.eltdf-pl-follow-info-title');

            portList.each(function () {
                var thisPortList = $(this);

                var left,
                    right;

                //info element position
                thisPortList.on('mousemove', function (e) {
                    left = e.clientX;
                    right= 'auto';

                    if(e.clientX + followInfoHolder.width() > $(window).width()) {
                        left = 'auto';
                        right = 0;
                    } else {
                        left = e.clientX;
                        right = 'auto';
                    }

                    followInfoHolder.css({
                        top: e.clientY,
                        left: left,
                        right: right
                    });
                });

                //show/hide info element
                thisPortList.find('.eltdf-pl-item').on('mouseenter', function () {
                    var thisArticleItem = $(this),
                        thisArticleItemTitle = thisArticleItem.find('.eltdf-pli-title'),
                        thisArticleItemCategories = thisArticleItem.find('.eltdf-pli-category');

                    if(thisArticleItemCategories.length) {
                        thisArticleItemCategories.each(function(){
                            var thisArticleItemCategory = $(this);
                            followInfoCategory.append('<span class="eltdf-pl-follow-info-category">' + thisArticleItemCategory.text() + '<span class="eltdf-pl-follow-info-category-slash"> / </span></span>');
                        });
                    }

                    if(thisArticleItemTitle.length) {
                        followInfoTitle.text(thisArticleItemTitle.text());
                    }

                    if (!followInfoHolder.hasClass('eltdf-is-active')) {
                        followInfoHolder.addClass('eltdf-is-active');
                    }

                }).on('mouseleave', function () {
                    if (followInfoHolder.hasClass('eltdf-is-active')) {
                        followInfoHolder.removeClass('eltdf-is-active');
                    }
                    $('.eltdf-pl-follow-info-category').remove();
                });

                //check if info element is below or above the targeted portfolio list
                $(window).scroll(function(){
                    if (followInfoHolder.hasClass('eltdf-is-active')) {
                        if (followInfoHolder.offset().top < thisPortList.offset().top || followInfoHolder.offset().top > thisPortList.offset().top + thisPortList.outerHeight()) {
                            followInfoHolder.removeClass('eltdf-is-active');
                        }
                    }
                });
            });
        }
    }
	
})(jQuery);