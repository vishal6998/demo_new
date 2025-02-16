(function ($) {
    "use strict";

    window.eltdf = {};
    eltdf.modules = {};

    eltdf.scroll = 0;
    eltdf.window = $(window);
    eltdf.document = $(document);
    eltdf.windowWidth = $(window).width();
    eltdf.windowHeight = $(window).height();
    eltdf.body = $('body');
    eltdf.html = $('html, body');
    eltdf.htmlEl = $('html');
    eltdf.menuDropdownHeightSet = false;
    eltdf.defaultHeaderStyle = '';
    eltdf.minVideoWidth = 1500;
    eltdf.videoWidthOriginal = 1280;
    eltdf.videoHeightOriginal = 720;
    eltdf.videoRatio = 1.61;

    eltdf.eltdfOnDocumentReady = eltdfOnDocumentReady;
    eltdf.eltdfOnWindowLoad = eltdfOnWindowLoad;
    eltdf.eltdfOnWindowResize = eltdfOnWindowResize;
    eltdf.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    $(window).scroll(eltdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdf.scroll = $(window).scrollTop();
        eltdfBrowserDetection();

        //set global variable for header style which we will use in various functions
        if (eltdf.body.hasClass('eltdf-dark-header')) {
            eltdf.defaultHeaderStyle = 'eltdf-dark-header';
        }
        if (eltdf.body.hasClass('eltdf-light-header')) {
            eltdf.defaultHeaderStyle = 'eltdf-light-header';
        }
    }

    /* 
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {

    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdfOnWindowResize() {
        eltdf.windowWidth = $(window).width();
        eltdf.windowHeight = $(window).height();
    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
        eltdf.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch (true) {
        case eltdf.body.hasClass('eltdf-grid-1300'):
            eltdf.boxedLayoutWidth = 1350;
            //eltdf.gridWidth = 1300;
            break;
        case eltdf.body.hasClass('eltdf-grid-1200'):
            eltdf.boxedLayoutWidth = 1250;
            //eltdf.gridWidth = 1200;
            break;
        case eltdf.body.hasClass('eltdf-grid-1000'):
            eltdf.boxedLayoutWidth = 1050;
            //eltdf.gridWidth = 1000;
            break;
        case eltdf.body.hasClass('eltdf-grid-800'):
            eltdf.boxedLayoutWidth = 850;
            //eltdf.gridWidth = 800;
            break;
        default:
            eltdf.boxedLayoutWidth = 1150;
            //eltdf.gridWidth = 1100;
            break;
    }

    eltdf.gridWidth = function () {
        var gridWidth = 1100;

        switch (true) {
            case eltdf.body.hasClass('eltdf-grid-1300') && eltdf.windowWidth > 1400:
                gridWidth = 1300;
                break;
            case eltdf.body.hasClass('eltdf-grid-1200') && eltdf.windowWidth > 1300:
                gridWidth = 1200;
                break;
            case eltdf.body.hasClass('eltdf-grid-1000') && eltdf.windowWidth > 1200:
                gridWidth = 1200;
                break;
            case eltdf.body.hasClass('eltdf-grid-800') && eltdf.windowWidth > 1024:
                gridWidth = 800;
                break;
            default:
                break;
        }

        return gridWidth;
    };

    eltdf.transitionEnd = (function () {
        var el = document.createElement('transitionDetector'),
            transEndEventNames = {
                'WebkitTransition': 'webkitTransitionEnd', // Saf 6, Android Browser
                'MozTransition': 'transitionend', // only for FF < 15
                'transition': 'transitionend' // IE10, Opera, Chrome, FF 15+, Saf 7+
            };

        for (var t in transEndEventNames) {
            if (el.style[t] !== undefined) {
                return transEndEventNames[t];
            }
        }
    })();

    eltdf.animationEnd = (function () {
        var el = document.createElement("animationDetector");

        var animations = {
            "animation": "animationend",
            "OAnimation": "oAnimationEnd",
            "MozAnimation": "animationend",
            "WebkitAnimation": "webkitAnimationEnd"
        };

        for (var t in animations) {
            if (el.style[t] !== undefined) {
                return animations[t];
            }
        }
    })();

    window.qodefGoogleMapsCallback = function () {
        $( document ).trigger( 'qodefGoogleMapsCallbackEvent' );
    };

    /*
     * Browser detection
     */
    function eltdfBrowserDetection() {
        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor),
            isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor),
            isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1,
            isIE = window.navigator.userAgent.indexOf("MSIE ");

        if (isChrome) {
            eltdf.body.addClass('eltdf-chrome');
        }
        if (isSafari) {
            eltdf.body.addClass('eltdf-safari');
        }
        if (isFirefox) {
            eltdf.body.addClass('eltdf-firefox');
        }
        if (isIE > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            eltdf.body.addClass('eltdf-ms-explorer');
        }
        if (/Edge\/\d./i.test(navigator.userAgent)) {
            eltdf.body.addClass('eltdf-edge');
        }
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    eltdf.modules.common = common;

    common.eltdfFluidVideo = eltdfFluidVideo;
    common.eltdfEnableScroll = eltdfEnableScroll;
    common.eltdfDisableScroll = eltdfDisableScroll;
	common.eltdfInitGridMasonryListLayout = eltdfInitGridMasonryListLayout;
    common.eltdfInitParallax = eltdfInitParallax;
    common.eltdfInitSelfHostedVideoPlayer = eltdfInitSelfHostedVideoPlayer;
    common.eltdfSelfHostedVideoSize = eltdfSelfHostedVideoSize;
	common.eltdfStickySidebarWidget = eltdfStickySidebarWidget;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
    common.setFixedImageProportionSize = setFixedImageProportionSize;
    common.eltdfInitPerfectScrollbar = eltdfInitPerfectScrollbar;
    common.eltdfOnDocumentReady = eltdfOnDocumentReady;
    common.eltdfOnWindowLoad = eltdfOnWindowLoad;
    common.eltdfOnWindowResize = eltdfOnWindowResize;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);
    $(window).resize(eltdfOnWindowResize);
    
    /*
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfIconWithHover().init();
	    eltdfDisableSmoothScrollForMac();
	    eltdfInitAnchor().init();
	    eltdfInitBackToTop();
	    eltdfBackButtonShowHide();
	    eltdfInitSelfHostedVideoPlayer();
	    eltdfSelfHostedVideoSize();
	    eltdfFluidVideo();
	    eltdfOwlSlider();
	    eltdfPreloadBackgrounds();
	    eltdfPrettyPhoto();
	    eltdfSearchPostTypeWidget();
	    eltdfDashboardForm();
		eltdfInitGridMasonryListLayout();
        eltdfSmoothTransition();
        eltdfAppearOnReady();
    }

    /*
        All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
	    eltdfInitParallax();
	    eltdfStickySidebarWidget().init();
        eltdfNavMenuWidget();
        eltdfPaginationBorder();
		eltdfElementorGlobal();
    }

    /*
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdfOnWindowResize() {
	    eltdfInitGridMasonryListLayout();
    	eltdfSelfHostedVideoSize();
    }


	/**
	 * Elementor Global
	 */
	function eltdfElementorGlobal() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/global', function () {
				eltdfInitParallax();
				eltdfAppearOnReady();
			});
		});
	}

	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function eltdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();
		
		if (os.indexOf('mac') > -1 && eltdf.body.hasClass('eltdf-smooth-scroll')) {
			eltdf.body.removeClass('eltdf-smooth-scroll');
		}
	}
	
	function eltdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('wheel', eltdfWheel, {passive: false});
		}
		
		// window.onmousewheel = document.onmousewheel = eltdfWheel;
		document.onkeydown = eltdfKeydown;
	}
	
	function eltdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('wheel', eltdfWheel, {passive: false});
		}
		
		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}
	
	function eltdfWheel(e) {
		eltdfPreventDefaultValue(e);
	}
	
	function eltdfKeydown(e) {
		var keys = [37, 38, 39, 40];
		
		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				eltdfPreventDefaultValue(e);
				return;
			}
		}
	}
	
	function eltdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}
	
	/*
	 **	Anchor functionality
	 */
	var eltdfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			var headers = $('.eltdf-main-menu, .eltdf-mobile-nav, .eltdf-fullscreen-menu, .eltdf-vertical-menu');
			
			headers.each(function(){
				var currentHeader = $(this);
				
				if (anchor.parents(currentHeader).length) {
					currentHeader.find('.eltdf-active-item').removeClass('eltdf-active-item');
					anchor.parent().addClass('eltdf-active-item');
					
					currentHeader.find('a').removeClass('current');
					anchor.addClass('current');
				}
			});
		};
		
		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			var anchorData = $('[data-eltdf-anchor]'),
				anchorElement,
				siteURL = window.location.href.split('#')[0];
			
			if (siteURL.substr(-1) !== '/') {
				siteURL += '/';
			}
			
			anchorData.waypoint( function(direction) {
				if(direction === 'down') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("eltdf-anchor");
					} else {
						anchorElement = $(this).data("eltdf-anchor");
					}
				
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: '50%' });
			
			anchorData.waypoint( function(direction) {
				if(direction === 'up') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("eltdf-anchor");
					} else {
						anchorElement = $(this).data("eltdf-anchor");
					}
					
					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: function(){
				return -($(this.element).outerHeight() - 150);
			} });
		};
		
		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];
			
			if(hash !== "" && $('[data-eltdf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};
		
		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('.eltdf-main-menu a, .eltdf-mobile-nav a, .eltdf-fullscreen-menu a, .eltdf-vertical-menu a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-eltdf-anchor="' + hash + '"]') : '';
			
			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;
				
				if(anchor.length) {
					anchor.each(function(){
						var thisAnchor = $(this);
						
						if(thisAnchor.attr('href').indexOf(hash) > -1) {
							setActiveState(thisAnchor);
						}
					});
				}
				
				eltdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});
				
				return false;
			}
		};
		
		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {
			
			if (eltdf.modules.stickyHeader.behaviour === 'eltdf-sticky-header-on-scroll-down-up') {
				eltdf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > eltdf.modules.header.stickyAppearAmount);
			}
			
			if (eltdf.modules.stickyHeader.behaviour === 'eltdf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > eltdf.scroll)) {
					eltdf.modules.stickyHeader.isStickyVisible = false;
				}
			}
			
			var headerHeight = eltdf.modules.stickyHeader.isStickyVisible ? eltdfGlobalVars.vars.eltdfStickyHeaderTransparencyHeight : eltdfPerPageVars.vars.eltdfHeaderTransparencyHeight;
			
			if (eltdf.windowWidth < 1025) {
				headerHeight = 0;
			}
			
			return headerHeight;
		};
		
		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			eltdf.document.on("click", ".eltdf-main-menu a, .eltdf-fullscreen-menu a, a.eltdf-btn, .eltdf-anchor, .eltdf-mobile-nav a, .eltdf-vertical-menu a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-eltdf-anchor="' + hash + '"]') : '';
				
				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;
					
					setActiveState(anchor);
					
					eltdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});
					
					return false;
				}
			});
		};
		
		return {
			init: function () {
				if ($('[data-eltdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();

					$(window).on( 'load', function() {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};
	
	function eltdfInitBackToTop() {
		var backToTopButton = $('#eltdf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			eltdf.html.animate({scrollTop: 0}, eltdf.window.scrollTop() / 3, 'easeOutQuart');
		});
	}
	
	function eltdfBackButtonShowHide() {
		eltdf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;
			
			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}
			
			if (d < 1e3) {
				eltdfToTopButton('off');
			} else {
				eltdfToTopButton('on');
			}
		});
	}
	
	function eltdfToTopButton(a) {
		var b = $("#eltdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}
	
	function eltdfInitSelfHostedVideoPlayer() {
		var players = $('.eltdf-self-hosted-video');
		
		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}
	
	function eltdfSelfHostedVideoSize(){
		var selfVideoHolder = $('.eltdf-self-hosted-video-holder .eltdf-video-wrap');
		
		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.eltdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / eltdf.videoRatio;
				
				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}
				
				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);
				
				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}
	
	function eltdfFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}
	
	function eltdfSmoothTransition() {

		if (eltdf.body.hasClass('eltdf-smooth-page-transitions')) {

			//check for preload animation
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-preloader')) {
				var loader = $('body > .eltdf-smooth-transition-loader.eltdf-mimic-ajax'),
					mainRevHolder = $('#eltdf-main-rev-holder'),
                    laurentSpinner = $('.eltdf-laurent-spinner-holder'),
                    laurentInterval,
					isElementorEditMode = false;

				if( typeof elementorFrontend !== 'undefined'){
					isElementorEditMode = Boolean(elementorFrontend.isEditMode());
				};

                if ( laurentSpinner.length ) {
                    var laurentSpinnerImage = laurentSpinner.find('.eltdf-laurent-spinner-image'),
                        laurentSpinnerLine = laurentSpinnerImage.find('polyline');

                    var animateLines = function() {
                        laurentSpinnerLine.each(function() {
                            var thisLine = $(this);

                            thisLine.addClass('eltdf-line-active');

                            setTimeout( function() {
                                thisLine.removeClass('eltdf-line-active');
                            }, 2100);
                        });
                    };

                    var clearAnimation = function() {
                        setTimeout(function() {
                            loader.addClass('eltdf-finished-animation');
                            clearInterval(laurentInterval);
                        }, 4000);
                    };

                    setTimeout(function() {
                        animateLines();
                        laurentInterval = setInterval(function() {
                            animateLines();
                        }, 2200);
                    }, 100);
                }

				/**
				 * Loader Fade Out function
				 *
				 * @param {number} speed - fade out duration
				 * @param {number} delay - fade out delay
				 * @param {string} easing - fade out easing function
				 */
				var fadeOutLoader = function(speed, delay, easing) {
					speed = speed ? speed : 600;
					delay = delay ? delay : 0;
					easing = easing ? easing : 'easeOutSine';

					loader.delay(delay).fadeOut(speed, easing);
					$(window).on('bind', 'pageshow', function (event) {
						if (event.originalEvent.persisted) {
							loader.fadeOut(speed, easing);
						}
					});
				};

                $(window).on('load', function() {
                    if (laurentSpinner.length) {
                        clearAnimation(800, 4000, 'easeInOutSine');

                        if(mainRevHolder.length) {
                            setTimeout(function() {
                                mainRevHolder.find('rs-module').revstart();
                            }, 4000);
                        }
                    } else {
                        fadeOutLoader();
                    }
                });

				if(isElementorEditMode){
					loader.fadeOut(1000, 'easeInOutSine');
				}
			}
			
			//if back button is pressed, than show content to avoid state where content is on display:none
			window.addEventListener( "pageshow", function ( event ) {
				var historyPath = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
				if ( historyPath ) {
					$('.eltdf-wrapper-inner').show();
				}
			});
			
			//check for fade out animation
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');
				
				linkItem.on('click', function (e) {
					var a = $(this);

					if ((a.parents('.eltdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}
					
					if (a.parents('.woocommerce-product-gallery__image').length) {
						return;
					}

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.eltdf-wrapper-inner').fadeOut(600, 'easeOutSine', function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}
	
	/*
	 *	Preload background images for elements that have 'eltdf-preload-background' class
	 */
	function eltdfPreloadBackgrounds(){
		var preloadBackHolder = $('.eltdf-preload-background');
		
		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);
				
				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');
					
					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";
					
					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function(){
							preloadBackground.removeClass('eltdf-preload-background');
						});
					}
				} else {
					$(window).on('load', function(){
						preloadBackground.removeClass('eltdf-preload-background');
					}); //make sure that eltdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}
	
	function eltdfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="'+eltdfGlobalVars.vars.ppExpand+'">'+eltdfGlobalVars.vars.ppExpand+'</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#">\
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" \n' +
								'                    width="25.109px" height="34.906px" viewBox="0 0 25.109 34.906" enable-background="new 0 0 25.109 34.906" xml:space="preserve">\n' +
								'                    <polyline fill="none" stroke="currentColor" stroke-miterlimit="10" points="0.442,34.59 13.459,17.464 0.442,0.338 "/>\n' +
								'                    <polyline fill="none" class="eltdf-popout" stroke="currentColor" stroke-miterlimit="10" points="11.425,34.59 24.441,17.464 11.425,0.338 "/>\n' +
								'               </svg>\
											</a> \
											<a class="pp_previous" href="#">\
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" \n' +
								'                    width="25.109px" height="34.906px" viewBox="0 0 25.109 34.906" enable-background="new 0 0 25.109 34.906" xml:space="preserve">\n' +
								'                    <polyline fill="none" stroke="currentColor" stroke-miterlimit="10" points="24.67,34.59 11.653,17.464 24.67,0.338 "/>\n' +
								'                    <polyline fill="none" class="eltdf-popout" stroke="currentColor" stroke-miterlimit="10" points="13.688,34.59 0.671,17.464 13.688,0.338 "/>\n' +
								'                </svg>\
											</a> \
                                                    </div> \
                                                    <div id="pp_full_res"></div> \
                                                    <div class="pp_details"> \
                                                        <div class="pp_nav"> \
                                                            <a href="#" class="pp_arrow_previous">'+eltdfGlobalVars.vars.ppPrev+'</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">'+eltdfGlobalVars.vars.ppNext+'</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">'+eltdfGlobalVars.vars.ppClose+'</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}
	common.eltdfPrettyPhoto = eltdfPrettyPhoto;

    function eltdfSearchPostTypeWidget() {
        var searchPostTypeHolder = $('.eltdf-search-post-type');

        if (searchPostTypeHolder.length) {
            searchPostTypeHolder.each(function () {
                var thisSearch = $(this),
                    searchField = thisSearch.find('.eltdf-post-type-search-field'),
                    resultsHolder = thisSearch.siblings('.eltdf-post-type-search-results'),
                    searchLoading = thisSearch.find('.eltdf-search-loading'),
                    searchIcon = thisSearch.find('.eltdf-search-icon');

                searchLoading.addClass('eltdf-hidden');

                var postType = thisSearch.data('post-type'),
                    keyPressTimeout;

                searchField.on('keyup paste', function() {
                    var field = $(this);
                    field.attr('autocomplete','off');
                    searchLoading.removeClass('eltdf-hidden');
                    searchIcon.addClass('eltdf-hidden');
                    clearTimeout(keyPressTimeout);

                    keyPressTimeout = setTimeout( function() {
                        var searchTerm = field.val();
                        
                        if(searchTerm.length < 3) {
                            resultsHolder.html('');
                            resultsHolder.fadeOut();
                            searchLoading.addClass('eltdf-hidden');
                            searchIcon.removeClass('eltdf-hidden');
                        } else {
                            var ajaxData = {
                                action: 'laurent_elated_search_post_types',
                                term: searchTerm,
                                postType: postType,
	                            search_post_types_nonce: $('input[name="eltdf_search_post_types_nonce"]').val()
                            };

                            $.ajax({
                                type: 'POST',
                                data: ajaxData,
                                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                                success: function (data) {
                                    var response = JSON.parse(data);
                                    if (response.status === 'success') {
                                        searchLoading.addClass('eltdf-hidden');
                                        searchIcon.removeClass('eltdf-hidden');
                                        resultsHolder.html(response.data.html);
                                        resultsHolder.fadeIn();
                                    }
                                },
                                error: function(XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("Status: " + textStatus);
                                    console.log("Error: " + errorThrown);
                                    searchLoading.addClass('eltdf-hidden');
                                    searchIcon.removeClass('eltdf-hidden');
                                    resultsHolder.fadeOut();
                                }
                            });
                        }
                    }, 500);
                });

                searchField.on('focusout', function () {
                    searchLoading.addClass('eltdf-hidden');
                    searchIcon.removeClass('eltdf-hidden');
                    resultsHolder.fadeOut();
                });
            });
        }
    }
	
	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};
		
		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};
		
		for (var property in container) {
			if (container.hasOwnProperty(property)) {
				
				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}
		
		return returnValue;
	}
	
	/*
	 ** Init Masonry List Layout
	 */
	function eltdfInitGridMasonryListLayout() {
		var holder = $('.eltdf-grid-masonry-list');
		
		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.find('.eltdf-masonry-list-wrapper'),
					size = thisHolder.find('.eltdf-masonry-grid-sizer').width();
				
				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltdf-item-space',
						percentPosition: true,
						masonry: {
							columnWidth: '.eltdf-masonry-grid-sizer',
							gutter: '.eltdf-masonry-grid-gutter'
						}
					});
					
					if (thisHolder.find('.eltdf-fixed-masonry-item').length || thisHolder.hasClass('eltdf-fixed-masonry-items')) {
						setFixedImageProportionSize(masonry, masonry.find('.eltdf-item-space'), size, true);
					}
					
					setTimeout(function () {
						eltdfInitParallax();
					}, 600);
					
					masonry.isotope('layout').css('opacity', 1);
				});
			});
		}
	}


	/**
	 * Initializes size for fixed image proportion - masonry layout
	 */
	function setFixedImageProportionSize(container, item, size, isFixedEnabled) {
		if (container.hasClass('eltdf-masonry-images-fixed') || isFixedEnabled === true) {
			var padding = parseInt(item.css('paddingLeft'), 10),
				newSize = size - 2 * padding,
				defaultMasonryItem = container.find('.eltdf-masonry-size-small'),
				largeWidthMasonryItem = container.find('.eltdf-masonry-size-large-width'),
				largeHeightMasonryItem = container.find('.eltdf-masonry-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.eltdf-masonry-size-large-width-height');

			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));

			if (eltdf.windowWidth > 680) {
				largeWidthMasonryItem.css('height', newSize);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));
			} else {
				largeWidthMasonryItem.css('height', Math.round(newSize / 2));
				largeWidthHeightMasonryItem.css('height', newSize);
			}
		}
	}

	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIconWithHover = function() {
		//get all icons on page
		var icons = $('.eltdf-icon-has-hover');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};
	
	/*
	 ** Init parallax
	 */
	function eltdfInitParallax(){
		var parallaxHolder = $('.eltdf-parallax-row-holder');

		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					helperHolder = parallaxElement.find('.eltdf-parallax-helper-holder'),
					image,
					speed,
					height = 0;

				if( helperHolder.length ){
					image = helperHolder.data('parallax-bg-image'),
						speed = helperHolder.data('parallax-bg-speed') * 0.4;
				} else{
					image = parallaxElement.data('parallax-bg-image'),
						speed = parallaxElement.data('parallax-bg-speed') * 0.4;
				}

				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}

				if (typeof helperHolder.data('parallax-bg-height') !== 'undefined' && helperHolder.data('parallax-bg-height') !== false) {
					height = parseInt(helperHolder.data('parallax-bg-height'));
				}

				parallaxElement.css({'background-image': 'url('+image+')'});

				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}

				parallaxElement.parallax('50%', speed);
			});
		}
	}
	
	/*
	 **  Init sticky sidebar widget
	 */
	function eltdfStickySidebarWidget(){
		var sswHolder = $('.eltdf-widget-sticky-sidebar'),
			headerHolder = $('.eltdf-page-header'),
			headerHeight = headerHolder.length ? headerHolder.outerHeight() : 0,
			widgetTopOffset = 0,
			widgetTopPosition = 0,
			sidebarHeight = 0,
			sidebarWidth = 0,
			objectsCollection = [];
		
		function addObjectItems() {
			if (sswHolder.length) {
				sswHolder.each(function () {
					var thisSswHolder = $(this),
						mainSidebarHolder = thisSswHolder.parents('aside.eltdf-sidebar'),
						widgetiseSidebarHolder = thisSswHolder.parents('.wpb_widgetised_column'),
						sidebarHolder = '',
						sidebarHolderHeight = 0;
					
					widgetTopOffset = thisSswHolder.offset().top;
					widgetTopPosition = thisSswHolder.position().top;
					sidebarHeight = 0;
					sidebarWidth = 0;
					
					if (mainSidebarHolder.length) {
						sidebarHeight = mainSidebarHolder.outerHeight();
						sidebarWidth = mainSidebarHolder.outerWidth();
						sidebarHolder = mainSidebarHolder;
						sidebarHolderHeight = mainSidebarHolder.parent().parent().outerHeight();
						
						var blogHolder = mainSidebarHolder.parent().parent().find('.eltdf-blog-holder');
						if (blogHolder.length) {
							sidebarHolderHeight -= parseInt(blogHolder.css('marginBottom'));
						}
					} else if (widgetiseSidebarHolder.length) {
						sidebarHeight = widgetiseSidebarHolder.outerHeight();
						sidebarWidth = widgetiseSidebarHolder.outerWidth();
						sidebarHolder = widgetiseSidebarHolder;
						sidebarHolderHeight = widgetiseSidebarHolder.parents('.vc_row').outerHeight();
					}
					
					objectsCollection.push({
						'object': thisSswHolder,
						'offset': widgetTopOffset,
						'position': widgetTopPosition,
						'height': sidebarHeight,
						'width': sidebarWidth,
						'sidebarHolder': sidebarHolder,
						'sidebarHolderHeight': sidebarHolderHeight
					});
				});
			}
		}
		
		function initStickySidebarWidget() {
			
			if (objectsCollection.length) {
				$.each(objectsCollection, function (i) {
					var thisSswHolder = objectsCollection[i].object,
						thisWidgetTopOffset = objectsCollection[i].offset,
						thisWidgetTopPosition = objectsCollection[i].position,
						thisSidebarHeight = objectsCollection[i].height,
						thisSidebarWidth = objectsCollection[i].width,
						thisSidebarHolder = objectsCollection[i].sidebarHolder,
						thisSidebarHolderHeight = objectsCollection[i].sidebarHolderHeight;
					
					if (eltdf.body.hasClass('eltdf-fixed-on-scroll')) {
						var fixedHeader = $('.eltdf-fixed-wrapper.fixed');
						
						if (fixedHeader.length) {
							headerHeight = fixedHeader.outerHeight() + eltdfGlobalVars.vars.eltdfAddForAdminBar;
						}
					} else if (eltdf.body.hasClass('eltdf-no-behavior')) {
						headerHeight = eltdfGlobalVars.vars.eltdfAddForAdminBar;
					}
					
					if (eltdf.windowWidth > 1024 && thisSidebarHolder.length) {
						var sidebarPosition = -(thisWidgetTopPosition - headerHeight),
							sidebarHeight = thisSidebarHeight - thisWidgetTopPosition - 40; // 40 is bottom margin of widget holder
						
						//move sidebar up when hits the end of section row
						var rowSectionEndInViewport = thisSidebarHolderHeight + thisWidgetTopOffset - headerHeight - thisWidgetTopPosition - eltdfGlobalVars.vars.eltdfTopBarHeight;
						
						if ((eltdf.scroll >= thisWidgetTopOffset - headerHeight) && thisSidebarHeight < thisSidebarHolderHeight) {
							if (thisSidebarHolder.hasClass('eltdf-sticky-sidebar-appeared')) {
								thisSidebarHolder.css({'top': sidebarPosition + 'px'});
							} else {
								thisSidebarHolder.addClass('eltdf-sticky-sidebar-appeared').css({
									'position': 'fixed',
									'top': sidebarPosition + 'px',
									'width': thisSidebarWidth,
									'margin-top': '-10px'
								}).animate({'margin-top': '0'}, 200);
							}
							
							if (eltdf.scroll + sidebarHeight >= rowSectionEndInViewport) {
								var absBottomPosition = thisSidebarHolderHeight - sidebarHeight + sidebarPosition - headerHeight;
								
								thisSidebarHolder.css({
									'position': 'absolute',
									'top': absBottomPosition + 'px'
								});
							} else {
								if (thisSidebarHolder.hasClass('eltdf-sticky-sidebar-appeared')) {
									thisSidebarHolder.css({
										'position': 'fixed',
										'top': sidebarPosition + 'px'
									});
								}
							}
						} else {
							thisSidebarHolder.removeClass('eltdf-sticky-sidebar-appeared').css({
								'position': 'relative',
								'top': '0',
								'width': 'auto'
							});
						}
					} else {
						thisSidebarHolder.removeClass('eltdf-sticky-sidebar-appeared').css({
							'position': 'relative',
							'top': '0',
							'width': 'auto'
						});
					}
				});
			}
		}
		
		return {
			init: function () {
				addObjectItems();
				initStickySidebarWidget();
				
				$(window).scroll(function () {
					initStickySidebarWidget();
				});
			},
			reInit: initStickySidebarWidget
		};
	}

    /**
     * Init Owl Carousel
     */
    function eltdfOwlSlider() {
        var sliders = $('.eltdf-owl-slider');

        if (sliders.length) {
            sliders.each(function(){
                var slider = $(this),
                    owlSlider = $(this),
	                slideItemsNumber = slider.children().length,
	                numberOfItems = 1,
	                loop = true,
	                autoplay = true,
	                autoplayHoverPause = true,
	                sliderSpeed = 5000,
	                sliderSpeedAnimation = 600,
	                margin = 0,
	                responsiveMargin = 0,
	                responsiveMargin1 = 0,
	                stagePadding = 0,
	                stagePaddingEnabled = false,
	                center = false,
	                autoWidth = false,
	                animateInClass = false, // keyframe css animation
	                animateOutClass = false, // keyframe css animation
	                navigation = true,
	                pagination = false,
	                thumbnail = false,
                    thumbnailSlider,
	                sliderIsCPTList = !!slider.hasClass('eltdf-list-is-slider'),
	                sliderDataHolder = sliderIsCPTList ? slider.parent() : slider;  // this is condition for cpt to set list to be slider
	
	            if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && ! sliderIsCPTList) {
		            numberOfItems = slider.data('number-of-items');
	            }
	            if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsCPTList) {
		            switch (sliderDataHolder.data('number-of-columns')) {
			            case 'one':
				            numberOfItems = 1;
				            break;
			            case 'two':
				            numberOfItems = 2;
				            break;
			            case 'three':
				            numberOfItems = 3;
				            break;
			            case 'four':
				            numberOfItems = 4;
				            break;
			            case 'five':
				            numberOfItems = 5;
				            break;
			            case 'six':
				            numberOfItems = 6;
				            break;
			            default :
				            numberOfItems = 4;
				            break;
		            }
	            }
	            if (sliderDataHolder.data('enable-loop') === 'no') {
		            loop = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay') === 'no') {
		            autoplay = false;
	            }
	            if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
		            autoplayHoverPause = false;
	            }
	            if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
		            sliderSpeed = sliderDataHolder.data('slider-speed');
	            }
	            if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
		            sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
	            }
	            if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
		            if (sliderDataHolder.data('slider-margin') === 'no') {
			            margin = 0;
		            } else {
			            margin = sliderDataHolder.data('slider-margin');
		            }
	            } else {
		            if(slider.parent().hasClass('eltdf-huge-space')) {
			            margin = 60;
		            } else if (slider.parent().hasClass('eltdf-large-space')) {
			            margin = 50;
		            } else if (slider.parent().hasClass('eltdf-medium-space')) {
			            margin = 40;
		            } else if (slider.parent().hasClass('eltdf-normal-space')) {
			            margin = 30;
		            } else if (slider.parent().hasClass('eltdf-small-space')) {
			            margin = 20;
		            } else if (slider.parent().hasClass('eltdf-tiny-space')) {
			            margin = 10;
		            }
	            }
	            if (sliderDataHolder.data('slider-padding') === 'yes') {
		            stagePaddingEnabled = true;
		            stagePadding = parseInt(slider.outerWidth() * 0.28);
		            margin = 50;
	            }
	            if (sliderDataHolder.data('enable-center') === 'yes') {
		            center = true;
	            }
	            if (sliderDataHolder.data('enable-auto-width') === 'yes') {
		            autoWidth = true;
	            }
	            if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
		            animateInClass = sliderDataHolder.data('slider-animate-in');
	            }
	            if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
	            }
	            if (sliderDataHolder.data('enable-navigation') === 'no') {
		            navigation = false;
	            }
	            if (sliderDataHolder.data('enable-pagination') === 'yes') {
		            pagination = true;
	            }

	            if (sliderDataHolder.data('enable-thumbnail') === 'yes') {
                    thumbnail = true;
	            }

	            if(thumbnail && !pagination) {
                    /* page.index works only when pagination is enabled, so we add through html, but hide via css */
	                pagination = true;
                    owlSlider.addClass('eltdf-slider-hide-pagination');
                }

	            if(navigation && pagination) {
		            slider.addClass('eltdf-slider-has-both-nav');
	            }

	            if (slideItemsNumber <= 1) {
		            loop       = false;
		            autoplay   = false;
		            navigation = false;
		            pagination = false;
	            }

	            var responsiveNumberOfItems1 = 1,
		            responsiveNumberOfItems2 = 2,
		            responsiveNumberOfItems3 = 3,
		            responsiveNumberOfItems4 = numberOfItems,
		            responsiveNumberOfItems5 = numberOfItems;

	            if (numberOfItems < 3) {
		            responsiveNumberOfItems2 = numberOfItems;
		            responsiveNumberOfItems3 = numberOfItems;
	            }

	            if (numberOfItems > 4) {
		            responsiveNumberOfItems4 = 4;
	            }
	
	            if (numberOfItems > 5) {
		            responsiveNumberOfItems5 = 5;
	            }

	            if (stagePaddingEnabled || margin > 30) {
		            responsiveMargin = 20;
		            responsiveMargin1 = 30;
	            }

	            if (margin > 0 && margin <= 30) {
		            responsiveMargin = margin;
		            responsiveMargin1 = margin;
	            }

	            slider.waitForImages(function () {
		            owlSlider = slider.owlCarousel({
			            items: numberOfItems,
			            loop: loop,
			            autoplay: autoplay,
			            autoplayHoverPause: autoplayHoverPause,
			            autoplayTimeout: sliderSpeed,
			            smartSpeed: sliderSpeedAnimation,
			            margin: margin,
			            stagePadding: stagePadding,
			            center: center,
			            autoWidth: autoWidth,
			            animateIn: animateInClass,
			            animateOut: animateOutClass,
			            dots: pagination,
			            nav: navigation,
			            navText: [
				            '<span class="eltdf-prev-icon">' + eltdfGlobalVars.vars.sliderNavPrevArrow + '</span>',
				            '<span class="eltdf-next-icon">' + eltdfGlobalVars.vars.sliderNavNextArrow + '</span>'
			            ],
			            responsive: {
				            0: {
					            items: responsiveNumberOfItems1,
					            margin: responsiveMargin,
					            stagePadding: 0,
					            center: false,
					            autoWidth: false
				            },
				            681: {
					            items: responsiveNumberOfItems2,
					            margin: responsiveMargin1
				            },
				            769: {
					            items: responsiveNumberOfItems3,
					            margin: responsiveMargin1
				            },
				            1025: {
					            items: responsiveNumberOfItems4
				            },
				            1281: {
					            items: responsiveNumberOfItems5
				            },
				            1367: {
					            items: numberOfItems
				            }
			            },
			            onInitialize: function () {
				            slider.css('visibility', 'visible');
				            eltdfInitParallax();
				            if (slider.find('iframe').length || slider.find('video').length) {
					            setTimeout(function () {
						            eltdfSelfHostedVideoSize();
						            eltdfFluidVideo();
					            }, 500);
				            }
				            if (thumbnail) {
					            thumbnailSlider.find('.eltdf-slider-thumbnail-item:first-child').addClass('active');
				            }
			            },
			            onRefreshed: function () {
				            if (autoWidth === true) {
					            var oldSize = parseInt(slider.find('.owl-stage').css('width'));
					            slider.find('.owl-stage').css('width', (oldSize + 1) + 'px');
				            }
			            },
			            onTranslate: function (e) {
				            if (thumbnail) {
					            var index = e.page.index + 1;
					            thumbnailSlider.find('.eltdf-slider-thumbnail-item.active').removeClass('active');
					            thumbnailSlider.find('.eltdf-slider-thumbnail-item:nth-child(' + index + ')').addClass('active');
				            }
			            },
			            onDrag: function (e) {
				            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
					            var sliderIsMoving = e.isTrigger > 0;
					
					            if (sliderIsMoving) {
						            slider.addClass('eltdf-slider-is-moving');
					            }
				            }
			            },
			            onDragged: function () {
				            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout') && slider.hasClass('eltdf-slider-is-moving')) {
					
					            setTimeout(function () {
						            slider.removeClass('eltdf-slider-is-moving');
					            }, 500);
				            }
			            }
		            });
	            });
	
	            if (thumbnail) {
		            thumbnailSlider = slider.parent().find('.eltdf-slider-thumbnail');
		
		            var numberOfThumbnails = parseInt(thumbnailSlider.data('thumbnail-count'));
		            var numberOfThumbnailsClass = '';
		
		            switch (numberOfThumbnails % 6) {
			            case 2 :
				            numberOfThumbnailsClass = 'two';
				            break;
			            case 3 :
				            numberOfThumbnailsClass = 'three';
				            break;
			            case 4 :
				            numberOfThumbnailsClass = 'four';
				            break;
			            case 5 :
				            numberOfThumbnailsClass = 'five';
				            break;
			            case 0 :
				            numberOfThumbnailsClass = 'six';
				            break;
			            default :
				            numberOfThumbnailsClass = 'six';
				            break;
		            }
		
		            if (numberOfThumbnailsClass !== '') {
			            thumbnailSlider.addClass('eltdf-slider-columns-' + numberOfThumbnailsClass);
		            }
		
		            thumbnailSlider.find('.eltdf-slider-thumbnail-item').on('click', function () {
			            $(this).siblings('.active').removeClass('active');
			            $(this).addClass('active');
			            owlSlider.trigger('to.owl.carousel', [$(this).index(), sliderSpeedAnimation]);
		            });
	            }
            });
        }
    }
	common.eltdfOwlSlider = eltdfOwlSlider;

	function eltdfDashboardForm() {
		var forms = $('.eltdf-dashboard-form');

		if (forms.length) {
			forms.each(function () {
				var thisForm = $(this),
					btnText = thisForm.find('button.eltdf-dashboard-form-button'),
					updatingBtnText = btnText.data('updating-text'),
					updatedBtnText = btnText.data('updated-text'),
					actionName = thisForm.data('action');

				thisForm.on('submit', function (e) {
					e.preventDefault();
					var prevBtnText = btnText.html(),
						gallery = $(this).find('.eltdf-dashboard-gallery-upload-hidden'),
						namesArray = [];

					btnText.html(updatingBtnText);

					//get data
					var formData = new FormData();

					//get files
					gallery.each(function () {
						var thisGallery = $(this),
							thisName = thisGallery.attr('name'),
							thisRepeaterID = thisGallery.attr('id'),
							thisFiles = thisGallery[0].files,
							newName;

						//this part is needed for repeater with image uploads
						//adding specific names so they can be sorted in regular files and files in repeater
						if (thisName.indexOf("[") > -1) {
							newName = thisName.substring(0, thisName.indexOf("[")) + '_eltdf_regarray_';

							var firstIndex = thisRepeaterID.indexOf('['),
								lastIndex = thisRepeaterID.indexOf(']'),
								index = thisRepeaterID.substring(firstIndex + 1, lastIndex);

							namesArray.push(newName);
							newName = newName + index + '_';
						} else {
							newName = thisName + '_eltdf_reg_';
						}

						//if file not sent, send dummy file - so repeater fields are sent
						if (thisFiles.length === 0) {
							formData.append(newName, new File([""], "eltdf-dummy-file.txt", {
								type: "text/plain"
							}));
						}

						for (var i = 0; i < thisFiles.length; i++) {
							var allowedTypes = ['image/png','image/jpg','image/jpeg','application/pdf'];
							//security purposed - check if there is more than one dot in file name, also check whether the file type is in allowed types
							if (thisFiles[i].name.match(/\./g).length === 1 && $.inArray(thisFiles[i].type, allowedTypes) !== -1) {
								formData.append(newName + i, thisFiles[i]);
							}
						}
					});

					formData.append('action', actionName);

					//get data from form
					var otherData = $(this).serialize();
					formData.append('data', otherData);

					$.ajax({
						type: 'POST',
						data: formData,
						contentType: false,
						processData: false,
						url: eltdfGlobalVars.vars.eltdfAjaxUrl,
						success: function (data) {
							var response;
							response = JSON.parse(data);

							// append ajax response html
							eltdf.modules.socialLogin.eltdfRenderAjaxResponseMessage(response);
							if (response.status === 'success') {
								btnText.html(updatedBtnText);
								window.location = response.redirect;
							} else {
								btnText.html(prevBtnText);
							}
						}
					});

					return false;
				});
			});
		}
	}

    /**
     * Init Perfect Scrollbar
     */
    function eltdfInitPerfectScrollbar() {
	    var defaultParams = {
		    wheelSpeed: 0.6,
		    suppressScrollX: true
	    };
	
	    var eltdfInitScroll = function (holder) {
			if ( holder.length ) {
				var ps = new PerfectScrollbar(
					holder[0],
					defaultParams
				);

				$( window ).resize( function () {
					ps.update();
				} );
			}
	    };
	
	    return {
		    init: function (holder) {
			    if (holder.length) {
				    eltdfInitScroll(holder);
			    }
		    }
	    };
    }

    function eltdfAppearOnReady() {
        var holders = $('.eltdf-st-decor-animation, .eltdf-svg-pattern, .eltdf-svg-pattern-holder, .eltdf-team-appear, .eltdf-bar-home-reveal-image');

        holders.each(function() {
            $(this).appear(function () {
                $(this).addClass('eltdf-appear');
            }, {accX: 0, accY: -300});
        });
    }

    function eltdfNavMenuWidget() {
        var widgetHolder = $('.widget_nav_menu');

        if ( widgetHolder.length ) {
            widgetHolder.each( function() {
                var thisHolder = $(this),
                    menuItem = thisHolder.find('.menu-item');

                if ( menuItem.length ) {
                    menuItem.each( function() {
                        var thisItem = $(this),
                            itemLink = thisItem.find('a');

                        itemLink.append('<span class="eltdf-btn-first-line"></span><span class="eltdf-btn-second-line"></span>');
                    });
                }
            });
        }
    }

    function eltdfPaginationBorder() {
        var paginations = $('.eltdf-blog-pagination, .woocommerce-pagination, .eltdf-pl-standard-pagination');

        if ( paginations.length ) {
            paginations.each( function() {
                var thisPagination = $(this),
                    pagItem = thisPagination.find('li');

                pagItem.append('<svg class="eltdf-svg-border" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="44px" height="44px" viewBox="0 0 44 44" enable-background="new 0 0 44 44" xml:space="preserve">' +
                                    '<circle fill="none" stroke="#C6A270" stroke-miterlimit="10" cx="22" cy="22" r="21.5"/>' +
                                '</svg>');
            })
        }
    }

})(jQuery);
(function($) {
	"use strict";

    var blog = {};
    eltdf.modules.blog = blog;

    blog.eltdfOnDocumentReady = eltdfOnDocumentReady;
    blog.eltdfOnWindowLoad = eltdfOnWindowLoad;
    blog.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);
    $(window).scroll(eltdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitAudioPlayer();
    }

    /* 
        All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
	    eltdfInitBlogPagination().init();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdfOnWindowScroll() {
	    eltdfInitBlogPagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function eltdfInitAudioPlayer() {
	    var players = $('audio.eltdf-blog-audio');
	
	    if (players.length) {
		    players.mediaelementplayer({
			    audioWidth: '100%'
		    });
	    }
    }
	
	/**
	 * Initializes blog pagination functions
	 */
	function eltdfInitBlogPagination(){
		var holder = $('.eltdf-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.eltdf-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.eltdf-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('eltdf-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltdf-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			var nonceHolder = thisHolder.find('input[name*="eltdf_blog_load_more_nonce_"]');
			
			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('eltdf-showing');
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'laurent_elated_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdfGlobalVars.vars.eltdfAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('eltdf-grid-masonry-list')){
								eltdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								eltdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), thisHolderInner.find('.eltdf-masonry-grid-sizer').width());
							} else {
								eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								eltdfInitAudioPlayer();
								eltdf.modules.common.eltdfOwlSlider();
								eltdf.modules.common.eltdfFluidVideo();
                                eltdf.modules.common.eltdfInitSelfHostedVideoPlayer();
                                eltdf.modules.common.eltdfSelfHostedVideoSize();
								
								if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
									eltdf.modules.common.eltdfStickySidebarWidget().reInit();
								}

                                // Trigger event.
                                $( document.body ).trigger( 'blog_list_load_more_trigger' );

							}, 400);
						});
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('eltdf-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.eltdf-blog-pag-load-more').hide();
			}
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('eltdf-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function ($) {
	"use strict";
	
	var footer = {};
    eltdf.modules.footer = footer;
	
	footer.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).on('load') should be in this function
	 */
	 
	function eltdfOnWindowLoad() {
		uncoveringFooter();
	}
	
	function uncoveringFooter() {
		var uncoverFooter = $('body:not(.error404) .eltdf-footer-uncover');

		if (uncoverFooter.length && !eltdf.htmlEl.hasClass('touch')) {

			var footer = $('footer'),
				footerHeight = footer.outerHeight(),
				content = $('.eltdf-content');
			
			var uncoveringCalcs = function () {
				content.css('margin-bottom', footerHeight);
				footer.css('height', footerHeight);
			};


			//set
			uncoveringCalcs();
			
			$(window).resize(function () {
				//recalc
				footerHeight = footer.find('.eltdf-footer-inner').outerHeight();
				uncoveringCalcs();
			});
		}
	}
	
})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	eltdf.modules.header = header;
	
	header.eltdfSetDropDownMenuPosition     = eltdfSetDropDownMenuPosition;
	header.eltdfSetDropDownWideMenuPosition = eltdfSetDropDownWideMenuPosition;
	
	header.eltdfOnDocumentReady = eltdfOnDocumentReady;
	header.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfSetDropDownMenuPosition();
		setTimeout(function(){
			eltdfDropDownMenu();
		}, 100);
	}
	
	/*
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function eltdfSetDropDownMenuPosition() {
		var menuItems = $('.eltdf-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = eltdf.windowWidth - menuItemPosition;
				
				if (eltdf.body.hasClass('eltdf-boxed')) {
					menuItemFromLeft = eltdf.boxedLayoutWidth - (menuItemPosition - (eltdf.windowWidth - eltdf.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined because 'dropDownMenuFromLeft < dropdownMenuWidth' conditional will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function eltdfSetDropDownWideMenuPosition(){
		var menuItems = $(".eltdf-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
                var menuItem = $(this);
				var menuItemSubMenu = menuItem.find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(eltdf.body.hasClass('eltdf-boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.eltdf-boxed .eltdf-wrapper .eltdf-wrapper-inner').outerWidth();
						left_position = left_position - (eltdf.windowWidth - boxedWidth) / 2;
						menuItemSubMenu.css({'left': -left_position, 'width': boxedWidth});

					} else if(eltdf.body.hasClass('eltdf-wide-dropdown-menu-in-grid')) {
                        //wide dropdown in grid case
                        menuItemSubMenu.css({'left': -left_position + (eltdf.windowWidth - eltdf.gridWidth()) / 2, 'width': eltdf.gridWidth()});

                    }
                    else {
                        //wide dropdown full width case
                        menuItemSubMenu.css({'left': -left_position, 'width': eltdf.windowWidth});

					}
				}
			});
		}
	}
	
	function eltdfDropDownMenu() {
		var menu_items = $('.eltdf-drop-down > ul > li');
		
		menu_items.each(function() {
			var thisItem = $(this);
			
			if(thisItem.find('.second').length) {
				thisItem.waitForImages(function(){
					var dropDownHolder = thisItem.find('.second'),
						dropDownHolderHeight = !eltdf.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;
					
					if(thisItem.hasClass('wide')) {
						var tallest = 0,
							dropDownSecondItem = dropDownHolder.find('> .inner > ul > li');
						
						dropDownSecondItem.each(function() {
							var thisHeight = $(this).outerHeight();
							
							if(thisHeight > tallest) {
								tallest = thisHeight;
							}
						});
						
						dropDownSecondItem.css('height', '').height(tallest);
						
						if (!eltdf.menuDropdownHeightSet) {
							dropDownHolderHeight = dropDownHolder.outerHeight();
						}
					}
					
					if (!eltdf.menuDropdownHeightSet) {
						dropDownHolder.height(0);
					}
					
					if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
						thisItem.on("touchstart mouseenter", function() {
							dropDownHolder.css({
								'height': dropDownHolderHeight,
								'overflow': 'visible',
								'visibility': 'visible',
								'opacity': '1'
							});
						}).on("mouseleave", function() {
							dropDownHolder.css({
								'height': '0px',
								'overflow': 'hidden',
								'visibility': 'hidden',
								'opacity': '0'
							});
						});
					} else {
						if (eltdf.body.hasClass('eltdf-dropdown-animate-height')) {
							var animateConfig = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('eltdf-drop-down-start').css({
											'visibility': 'visible',
											'height': '0',
											'opacity': '1'
										});
										dropDownHolder.stop().animate({
											'height': dropDownHolderHeight
										}, 400, 'easeInOutQuint', function () {
											dropDownHolder.css('overflow', 'visible');
										});
									}, 100);
								},
								timeout: 100,
								out: function () {
									dropDownHolder.stop().animate({
										'height': '0',
										'opacity': 0
									}, 100, function () {
										dropDownHolder.css({
											'overflow': 'hidden',
											'visibility': 'hidden'
										});
									});
									
									dropDownHolder.removeClass('eltdf-drop-down-start');
								}
							};
							
							thisItem.hoverIntent(animateConfig);
						} else {
							var config = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('eltdf-drop-down-start').stop().css({'height': dropDownHolderHeight});
									}, 150);
								},
								timeout: 150,
								out: function () {
									dropDownHolder.stop().css({'height': '0'}).removeClass('eltdf-drop-down-start');
								}
							};
							
							thisItem.hoverIntent(config);
						}
					}
				});
			}
		});
		
		$('.eltdf-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which === 1){
				var $this = $(this);
				
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		eltdf.menuDropdownHeightSet = true;
	}
	
})(jQuery);
(function($) {
    "use strict";

    var sidearea = {};
    eltdf.modules.sidearea = sidearea;

    sidearea.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfSideArea();
    }
	
	/**
	 * Show/hide side area
	 */
    function eltdfSideArea() {
		var wrapper = $('.eltdf-wrapper'),
			sideMenu = $('.eltdf-side-menu'),
			sideMenuButtonOpen = $('a.eltdf-side-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (eltdf.body.hasClass('eltdf-side-menu-slide-from-right')) {
			$('.eltdf-cover').remove();
			cssClass = 'eltdf-right-side-menu-opened';
			wrapper.prepend('<div class="eltdf-cover"/>');
			slideFromRight = true;
		} else if (eltdf.body.hasClass('eltdf-side-menu-slide-with-content')) {
			cssClass = 'eltdf-side-menu-open';
			slideWithContent = true;
		} else if (eltdf.body.hasClass('eltdf-side-area-uncovered-from-content')) {
			cssClass = 'eltdf-right-side-menu-opened';
			slideUncovered = true;
		}
		
		$('a.eltdf-side-menu-button-opener, a.eltdf-close-side-menu').on('click', function (e) {
			e.preventDefault();

            wrapper.one('wheel', function () {
                if (sideMenuButtonOpen.hasClass('opened')) {
                    eltdf.modules.common.eltdfEnableScroll();
                    sideMenuButtonOpen.removeClass('opened');
					eltdf.body.removeClass('eltdf-side-menu-open');
                }
            });

	        if (!sideMenuButtonOpen.hasClass('opened')) {
				eltdf.modules.common.eltdfDisableScroll();
		        sideMenuButtonOpen.addClass('opened');
		        eltdf.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.eltdf-wrapper .eltdf-cover').on('click', function () {
						eltdf.modules.common.eltdfEnableScroll();
				        eltdf.body.removeClass('eltdf-right-side-menu-opened');
				        sideMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        sideMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(eltdf.scroll - currentScroll) > 400) {
						eltdf.modules.common.eltdfEnableScroll();
				        eltdf.body.removeClass(cssClass);
				        sideMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideSideMenu = setTimeout(function () {
						        sideMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideSideMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
				eltdf.modules.common.eltdfEnableScroll();
	            sideMenuButtonOpen.removeClass('opened');
	            eltdf.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideSideMenu = setTimeout(function () {
			            sideMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideSideMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
					eltdf.modules.common.eltdfEnableScroll();
			        sideMenuButtonOpen.removeClass('opened');
			        eltdf.body.removeClass('eltdf-side-menu-open');
		        });
	        }
        });

        if(sideMenu.length){
            eltdf.modules.common.eltdfInitPerfectScrollbar().init(sideMenu);
        }
    }

})(jQuery);

(function ($) {
	"use strict";
	
	var subscribePopup = {};
	eltdf.modules.subscribePopup = subscribePopup;
	
	subscribePopup.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfSubscribePopup();
	}
	
	function eltdfSubscribePopup() {
		var popupOpener = $('.eltdf-subscribe-popup-holder'),
			popupClose = $('.eltdf-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.eltdf-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('eltdf-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.eltdf-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('eltdf-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('eltdf-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (eltdf.body.hasClass('eltdf-sp-opened')) {
					eltdf.body.removeClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfEnableScroll();
				} else {
					eltdf.body.addClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					eltdf.body.removeClass('eltdf-sp-opened');
					eltdf.modules.common.eltdfEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						eltdf.body.removeClass('eltdf-sp-opened');
						eltdf.modules.common.eltdfEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var title = {};
    eltdf.modules.title = title;

    title.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    eltdfParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function eltdfParallaxTitle() {
		var parallaxBackground = $('.eltdf-title-holder.eltdf-bg-parallax');
		
		if (parallaxBackground.length > 0 && eltdf.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('eltdf-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(eltdf.scroll * parallaxRate),
				adminBarHeight = eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackground.css({'background-size': imageWidth - eltdf.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(eltdf.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackground.css({'background-size': imageWidth - eltdf.scroll + 'px auto'});
				}
			});
		}
	}

})(jQuery);

(function($) {
    'use strict';

    var woocommerce = {};
    eltdf.modules.woocommerce = woocommerce;

    woocommerce.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfInitQuantityButtons();
        eltdfInitSelect2();
	    eltdfInitSingleProductLightbox();
        eltdfWooButtonsClass();
        eltdfBottomLineFortabs();
    }
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function eltdfInitQuantityButtons() {
		$(document).on('click', '.eltdf-quantity-minus, .eltdf-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.eltdf-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				min = parseFloat(inputField.data('min')),
				minus = false,
				inputValue = typeof Number.isNaN === 'function' && Number.isNaN(parseFloat(inputField.val())) ? min : parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('eltdf-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}

    /*
    ** Init select2 script for select html dropdowns
    */
	function eltdfInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.eltdf-woocommerce-page .eltdf-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
		
		var defaultMonsterWidgets = $('.widget.widget_archive select, .widget.widget_categories select, .widget.widget_text select');
		if (defaultMonsterWidgets.length && typeof defaultMonsterWidgets.select2 === 'function') {
			defaultMonsterWidgets.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function eltdfInitSingleProductLightbox() {
		var item = $('.eltdf-woo-single-page.eltdf-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof eltdf.modules.common.eltdfPrettyPhoto === "function") {
				eltdf.modules.common.eltdfPrettyPhoto();
			}
		}
	}

	function eltdfWooButtonsClass() {
	    var page = $('.woocommerce-page'),
            buttons = page.find('.button');

	    if ( buttons.length ) {
	        buttons.each( function() {
                var button = $(this);

                button.addClass('eltdf-btn-outline');
            })
        }
    }

    function eltdfBottomLineFortabs() {
        var firstLevelMenus = $('.woocommerce-tabs > ul');

        if (firstLevelMenus.length) {
            firstLevelMenus.each(function(){
                var mainMenu = $(this);

                mainMenu.append('<li class="eltdf-product-tabs-line"></li>');

                var menuLine = mainMenu.find('.eltdf-product-tabs-line'),
                    menuItems = mainMenu.find('> li:not(.eltdf-product-tabs-line)'),
                    initialOffset;

                if (menuItems.filter('.active').length) {
                    initialOffset = menuItems.filter('.active').offset().left;
                    menuLine.css('width', menuItems.filter('.active').outerWidth());
                } else {
                    initialOffset = menuItems.first().offset().left;
                    menuLine.css('width', menuItems.first().outerWidth());
                }

                //initial positioning
                menuLine.css('left',  initialOffset - mainMenu.offset().left);
                //menuLine.css('top',  Math.floor(menuItems.first().find('.item_text').offset().top - mainMenu.offset().top + menuItems.first().find('.item_text').height() + lineTopOffset));

                //fx on
                menuItems.mouseenter(function(){
                    var menuItem = $(this),
                        menuItemWidth = menuItem.outerWidth(),
                        mainMenuOffset = mainMenu.offset().left,
                        menuItemOffset = menuItem.offset().left - mainMenuOffset;

                    menuLine.css('width', menuItemWidth);
                    menuLine.css('left', menuItemOffset);
                });

                //fx off
                menuItems.mouseleave(function(){

                    var menuItem = $(this),
                        menuItemWidth = menuItem.outerWidth(),
                        mainMenuOffset = mainMenu.offset().left,
                        menuItemOffset = menuItem.offset().left - mainMenuOffset;

                    if(menuItem.hasClass('active')){
                        menuLine.css('width', menuItemWidth);
                        menuLine.css('left', menuItemOffset);
                    } else{
                        var activeLi = menuItems.filter('.active'),
                            activeWidth = activeLi.outerWidth(),
                            activeLeft = activeLi.offset().left - mainMenuOffset;

                        menuLine.css('width', activeWidth);
                        menuLine.css('left', activeLeft);
                    }
                });

            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var blogListSC = {};
    eltdf.modules.blogListSC = blogListSC;
    
    blogListSC.eltdfOnWindowLoad = eltdfOnWindowLoad;
    blogListSC.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(window).on('load', eltdfOnWindowLoad);
    $(window).scroll(eltdfOnWindowScroll);

    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitBlogListShortcodePagination().init();
        eltdfElementorBlogList();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
        eltdfInitBlogListShortcodePagination().scroll();
    }

    /**
     * Elementor Blog List
     */
    function eltdfElementorBlogList() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_blog_list.default', function () {
                eltdf.modules.common.eltdfInitGridMasonryListLayout();
                eltdfInitBlogListShortcodePagination().init();
            });
        });
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function eltdfInitBlogListShortcodePagination(){
        var holder = $('.eltdf-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.eltdf-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.eltdf-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;

            if(!thisHolder.hasClass('eltdf-bl-pag-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.eltdf-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
                thisHolder.addClass('eltdf-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.eltdf-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;
    
            var nonceHolder = thisHolder.find('input[name*="eltdf_blog_load_more_nonce_"]');
           
            loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
            loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
          
            if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
                    thisHolder.addClass('eltdf-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('eltdf-showing');
                }

                var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'laurent_elated_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                            eltdfInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('eltdf-bl-masonry')){
                                    eltdfInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    eltdfInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                                        eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('eltdf-bl-masonry')){
                                    eltdfInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    eltdfInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                                        eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('eltdf-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.eltdf-blog-pag-load-more').hide();
            }
        };

        var eltdfInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.eltdf-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.eltdf-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.eltdf-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.eltdf-pag-next a');

            standardPagNumericItem.removeClass('eltdf-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('eltdf-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var eltdfInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            var sizerAndGutterHTML = '';
            if(thisHolderInner.children('[class*="-grid-sizer"]').length) {
                sizerAndGutterHTML += thisHolderInner.children('[class*="-grid-sizer"]')[0].outerHTML;
            }
            if(thisHolderInner.children('[class*="-grid-gutter"]').length) {
                sizerAndGutterHTML += thisHolderInner.children('[class*="-grid-gutter"]')[0].outerHTML;
            }
            
            thisHolderInner.html(sizerAndGutterHTML + responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
            thisHolder.removeClass('eltdf-bl-pag-standard-shortcodes-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                    eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var eltdfInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
            thisHolder.removeClass('eltdf-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var eltdfInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('eltdf-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof eltdf.modules.common.eltdfStickySidebarWidget === 'function') {
                    eltdf.modules.common.eltdfStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var eltdfInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltdf-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('eltdf-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('eltdf-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('eltdf-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

})(jQuery);
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
(function($) {
    "use strict";

    var headerMinimal = {};
    eltdf.modules.headerMinimal = headerMinimal;
	
	headerMinimal.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function eltdfFullscreenMenu() {
	    var popupMenuOpener = $( 'a.eltdf-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".eltdf-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.eltdf-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.eltdf-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.eltdf-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.eltdf-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.eltdf-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            eltdf.modules.common.eltdfInitPerfectScrollbar().init(popupMenuHolderOuter);

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(eltdf.windowHeight);
            });

            if (eltdf.body.hasClass('eltdf-fade-push-text-right')) {
                cssClass = 'eltdf-push-nav-right';
                fadeRight = true;
            } else if (eltdf.body.hasClass('eltdf-fade-push-text-top')) {
                cssClass = 'eltdf-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('eltdf-fm-opened')) {
                    popupMenuOpener.addClass('eltdf-fm-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-fade-out').addClass('eltdf-fullscreen-menu-opened eltdf-fullscreen-fade-in');
                    eltdf.body.removeClass(cssClass);
                    eltdf.modules.common.eltdfDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('eltdf-fm-opened');
                            eltdf.body.removeClass('eltdf-fullscreen-menu-opened eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                            eltdf.body.addClass(cssClass);
                            eltdf.modules.common.eltdfEnableScroll();

                            $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('eltdf-fm-opened');
                    eltdf.body.removeClass('eltdf-fullscreen-menu-opened eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                    eltdf.body.addClass(cssClass);
                    eltdf.modules.common.eltdfEnableScroll();

                    $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent(),
					thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint');
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(thisItemParentSiblingsWithDrop.length === 0) {
			                submenu.slideDown(400, 'easeInOutQuint');
		                } else {
							thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('open_sub');
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                submenu.slideDown(400, 'easeInOutQuint');
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which === 1) {
                        popupMenuOpener.removeClass('eltdf-fm-opened');
                        eltdf.body.removeClass('eltdf-fullscreen-menu-opened');
                        eltdf.body.removeClass('eltdf-fullscreen-fade-in').addClass('eltdf-fullscreen-fade-out');
                        eltdf.body.addClass(cssClass);
                        $("nav.eltdf-fullscreen-menu ul.sub_menu").slideUp(200);
                        eltdf.modules.common.eltdfEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVertical = {};
    eltdf.modules.headerVertical = headerVertical;
	
	headerVertical.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
        eltdfVerticalMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var eltdfVerticalMenu = function() {
	    var verticalMenuObject = $('.eltdf-vertical-menu-area');

	    /**
	     * Checks if vertical area is scrollable (if it has eltdf-with-scroll class)
	     *
	     * @returns {bool}
	     */
	    var verticalAreaScrollable = function () {
		    return verticalMenuObject.hasClass('eltdf-with-scroll');
	    };
	
	    /**
	     * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
	     */
	    var initNavigation = function () {
		    var verticalNavObject = verticalMenuObject.find('.eltdf-vertical-menu');

		    if (verticalNavObject.hasClass('eltdf-vertical-dropdown-below')) {
				dropdownClickToggle();
			} else if (verticalNavObject.hasClass('eltdf-vertical-dropdown-side')) {
				dropdownFloat();
			}
		
		    /**
		     * Initializes click toggle navigation type. Works the same for touch and no-touch devices
		     */
		    function dropdownClickToggle() {
			    var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
			
			    menuItems.each(function () {
				    var elementToExpand = $(this).find(' > .second, > ul');
				    var menuItem = this;
				    var dropdownOpener = $(this).find('> a');
				    var slideUpSpeed = 'fast';
				    var slideDownSpeed = 'slow';
				
				    dropdownOpener.on('click tap', function (e) {
					    e.preventDefault();
					    e.stopPropagation();
					
					    if (elementToExpand.is(':visible')) {
						    $(menuItem).removeClass('open');
						    elementToExpand.slideUp(slideUpSpeed);
					    } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('eltdf-vertical-menu')) {
						    $(this).parent().parent().children().removeClass('open');
						    $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    } else {
						
						    if (!$(this).parents('li').hasClass('open')) {
							    menuItems.removeClass('open');
							    menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    if ($(this).parent().parent().children().hasClass('open')) {
							    $(this).parent().parent().children().removeClass('open');
							    $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
						    }
						
						    $(menuItem).addClass('open');
						    elementToExpand.slideDown(slideDownSpeed);
					    }
				    });
			    });
		    }


			/**
			 * Initializes click float navigation type
			 */
			function dropdownFloat() {
				var menuItems = verticalNavObject.find('ul li.menu-item-has-children');
				var allDropdowns = menuItems.find(' > .second > .inner > ul, > ul');

				menuItems.each(function() {
					var elementToExpand = $(this).find(' > .second > .inner > ul, > ul');
					var menuItem = this;

					if(Modernizr.touch) {
						var dropdownOpener = $(this).find('> a');

						dropdownOpener.on('click tap', function(e) {
							e.preventDefault();
							e.stopPropagation();

							if(elementToExpand.hasClass('eltdf-float-open')) {
								elementToExpand.removeClass('eltdf-float-open');
								$(menuItem).removeClass('open');
							} else {
								if(!$(this).parents('li').hasClass('open')) {
									menuItems.removeClass('open');
									allDropdowns.removeClass('eltdf-float-open');
								}

								elementToExpand.addClass('eltdf-float-open');
								$(menuItem).addClass('open');
							}
						});
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$(this).hoverIntent({
							over: function() {
								elementToExpand.addClass('eltdf-float-open');
								$(menuItem).addClass('open');
							},
							out: function() {
								elementToExpand.removeClass('eltdf-float-open');
								$(menuItem).removeClass('open');
							},
							timeout: 50
						});
					}
				});
			}
	    };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                eltdf.modules.common.eltdfInitPerfectScrollbar().init(verticalMenuObject);
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();
                }
            }
        };
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var mobileHeader = {};
	eltdf.modules.mobileHeader = mobileHeader;
	
	mobileHeader.eltdfOnDocumentReady = eltdfOnDocumentReady;
	mobileHeader.eltdfOnWindowResize = eltdfOnWindowResize;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).resize(eltdfOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function eltdfOnDocumentReady() {
		eltdfInitMobileNavigation();
		eltdfInitMobileNavigationScroll();
		eltdfMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function eltdfOnWindowResize() {
		eltdfInitMobileNavigationScroll();
	}
	
	function eltdfInitMobileNavigation() {
		var navigationOpener = $('.eltdf-mobile-header .eltdf-mobile-menu-opener'),
			navigationHolder = $('.eltdf-mobile-header .eltdf-mobile-nav'),
			dropdownOpener = $('.eltdf-mobile-nav .mobile_arrow, .eltdf-mobile-nav h6, .eltdf-mobile-nav a.eltdf-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('eltdf-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('eltdf-mobile-menu-opened');
				}
			});
		}
		
		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this),
					initialNavHeight = navigationHolder.outerHeight();
				
				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');
					
					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');
						
						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('eltdf-opened');
							navigationHolder.stop().animate({'height': initialNavHeight}, 300);
						} else {
							thisItemParent.addClass('eltdf-opened');
							
							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							} else {
								thisItemParent.siblings().removeClass('eltdf-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							}
						}
					}
				});
			});
		}
		
		$('.eltdf-mobile-nav a, .eltdf-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("eltdf-mobile-menu-opened");
			}
		});
	}
	
	function eltdfInitMobileNavigationScroll() {
		if (eltdf.windowWidth <= 1024) {
			var mobileHeader = $('.eltdf-mobile-header'),
				mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
				navigationHolder = mobileHeader.find('.eltdf-mobile-nav'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = eltdf.windowHeight - 100;
			
			//init scrollable menu
			var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;

            // in case if mobile header exists on specific page
            if(navigationHolder.length) {
                navigationHolder.height(scrollHeight);
                eltdf.modules.common.eltdfInitPerfectScrollbar().init(navigationHolder);
            }
		}
	}
	
	function eltdfMobileHeaderBehavior() {
		var mobileHeader = $('.eltdf-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.eltdf-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (eltdf.body.hasClass('eltdf-content-is-behind-header') && mobileHeaderHeight > 0 && eltdf.windowWidth <= 1024) {
			$('.eltdf-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (eltdf.body.hasClass('eltdf-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('eltdf-animate-mobile-header');
				} else {
					mobileHeader.removeClass('eltdf-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('eltdf-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.eltdf-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    eltdf.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdfOnDocumentReady() {
	    if(eltdf.windowWidth > 1024) {
		    eltdfHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdfHeaderBehaviour() {
        var header = $('.eltdf-page-header'),
	        stickyHeader = $('.eltdf-sticky-header'),
            fixedHeaderWrapper = $('.eltdf-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.eltdf-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.eltdf-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - eltdfGlobalVars.vars.eltdfAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case eltdf.body.hasClass('eltdf-sticky-header-on-scroll-up'):
                eltdf.modules.stickyHeader.behaviour = 'eltdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(eltdfGlobalVars.vars.eltdfTopBarHeight) + parseInt(eltdfGlobalVars.vars.eltdfLogoAreaHeight) + parseInt(eltdfGlobalVars.vars.eltdfMenuAreaHeight) + parseInt(eltdfGlobalVars.vars.eltdfStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltdf-main-menu .second').removeClass('eltdf-drop-down-start');
                        eltdf.body.removeClass('eltdf-sticky-header-appear');
                    } else {
                        eltdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    eltdf.body.addClass('eltdf-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case eltdf.body.hasClass('eltdf-sticky-header-on-scroll-down-up'):
                eltdf.modules.stickyHeader.behaviour = 'eltdf-sticky-header-on-scroll-down-up';

                if(eltdfPerPageVars.vars.eltdfStickyScrollAmount !== 0){
                    eltdf.modules.stickyHeader.stickyAppearAmount = parseInt(eltdfPerPageVars.vars.eltdfStickyScrollAmount);
                } else {
                    eltdf.modules.stickyHeader.stickyAppearAmount = parseInt(eltdfGlobalVars.vars.eltdfTopBarHeight) + parseInt(eltdfGlobalVars.vars.eltdfLogoAreaHeight) + parseInt(eltdfGlobalVars.vars.eltdfMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(eltdf.scroll < eltdf.modules.stickyHeader.stickyAppearAmount) {
                        eltdf.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltdf-main-menu .second').removeClass('eltdf-drop-down-start');
	                    eltdf.body.removeClass('eltdf-sticky-header-appear');
                    }else{
                        eltdf.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    eltdf.body.addClass('eltdf-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltdf.body.hasClass('eltdf-fixed-on-scroll'):
                eltdf.modules.stickyHeader.behaviour = 'eltdf-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(eltdf.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                eltdf.body.removeClass('eltdf-fixed-header-appear');
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                eltdf.body.addClass('eltdf-fixed-header-appear');
		                header.css('margin-bottom', fixedMenuAreaHeight + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
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
(function ($) {
	'use strict';

	var dashboard = {};

	dashboard.eltdfOnDocumentReady = eltdfOnDocumentReady;

	$(document).ready(eltdfOnDocumentReady);

	/**
	 *  All functions to be called on $(document).ready() should be in eltdfImport function
	 **/
	function eltdfOnDocumentReady() {
		eltdfThemeRegistration.init();
		eltdfImport.init();
		eltdfThemeSelectDemo();
		eltdfInitSwitch();
	}

	var eltdfImport = {
		importDemo: '',
		importImages: 0,
		counterStep: 0,
		contentCounter: 0,
		totalPercent: 0,
		contentFlag: false,
		allFlag: false,
		contentFinished: false,
		allFinished: false,
		repeatFiles: [],

		init: function () {
			eltdfImport.holder = $('.eltdf-cd-import-form');

			if (eltdfImport.holder.length) {
				eltdfImport.holder.each(function () {
					var eltdfImportBtn = $('#eltdf-import-demo-data'),
						importAction = $('.eltdf-cd-import-option'),
						importDemoElement = $('.eltdf-import-demo'),
						confirmMessage = eltdfImport.holder.data('confirm-message');

					importAction.on('change', function (e) {
						eltdfImport.populateSinglePage(importAction.val(), $('.eltdf-import-demo').val(), false);
					});
					importDemoElement.on('change', function (e) {
						eltdfImport.populateSinglePage(importAction.val(), $('.eltdf-import-demo').val(), true);
					});
					eltdfImportBtn.on('click', function (e) {
						e.preventDefault();
						eltdfImport.reset();
						eltdfImport.importImages = $('.eltdf-cd-import-attachments').is(':checked') ? 1 : 0;
						eltdfImport.importDemo = importDemoElement.val();

						if (confirm(confirmMessage)) {
							$('.eltdf-cd-box-form-section-progress').show();
							$(this).addClass('eltdf-import-demo-data-disabled');
							$(this).attr("disabled", true);
							eltdfImport.initImportType(importAction.val());
						}
					});
				});
			}
		},

		initImportType: function (action) {
			switch (action) {
				case 'widgets':
					eltdfImport.importWidgets();
					break;
				case 'options':
					eltdfImport.importOptions();
					break;
				case 'content':
					eltdfImport.contentFlag = true;
					eltdfImport.importContent();
					break;
				case 'complete':
					eltdfImport.allFlag = true;
					eltdfImport.importAll();
					break;
				case 'single-page':
					eltdfImport.importSinglePage();
					break;
			}
		},

		importWidgets: function () {
			var data = {
				action: 'widgets',
				demo: eltdfImport.importDemo
			};
			eltdfImport.importAjax(data);
		},

		importOptions: function () {
			var data = {
				action: 'options',
				demo: eltdfImport.importDemo
			};
			eltdfImport.importAjax(data);
		},

		importSettingsPages: function () {
			var data = {
				action: 'settings-page',
				demo: eltdfImport.importDemo
			};
			eltdfImport.importAjax(data);
		},

		importMenuSettings: function () {
			var data = {
				action: 'menu-settings',
				demo: eltdfImport.importDemo
			};
			eltdfImport.importAjax(data);
		},

		importRevSlider: function () {
			var data = {
				action: 'rev-slider',
				demo: eltdfImport.importDemo
			};
			eltdfImport.importAjax(data);
		},

		importContent: function () {
			if (eltdfImport.contentCounter == 0) {
				eltdfImport.importTerms();
			}
			if (eltdfImport.contentCounter == 1) {
				eltdfImport.importAttachments();
			}
			if ((eltdfImport.contentCounter > 1 && eltdfImport.contentCounter < 20) && eltdfImport.repeatFiles.length) {
				eltdfImport.importAttachments(true);
			}
			if (eltdfImport.contentCounter == 20) {
				eltdfImport.importPosts();
			}
		},

		importAll: function () {

			if (eltdfImport.contentCounter < 21) {
				eltdfImport.importContent();
			} else {
				eltdfImport.contentFinished = true;
			}

			if (eltdfImport.contentFinished && !eltdfImport.allFinished) {
				eltdfImport.importWidgets();
				eltdfImport.importOptions();
				eltdfImport.importSettingsPages();
				eltdfImport.importMenuSettings();
				eltdfImport.importRevSlider();
				eltdfImport.allFinished = true;
			}

		},
		importTerms: function () {
			var data = {
				action: 'content',
				xml: 'laurent_content_0.xml',
				contentStart: true
			};
			eltdfImport.importAjax(data);
		},
		importPosts: function () {
			var data = {
				action: 'content',
				xml: 'laurent_content_20.xml',
				updateURL: true
			};
			eltdfImport.importAjax(data);
		},

		importSinglePage: function () {
			var postId = $('#import_single_page').val();
			var data = {
				action: 'content',
				xml: 'laurent_content_20.xml',
				post_id: postId
			};
			eltdfImport.importAjax(data);
		},

		importAttachments: function (repeat) {
			if (eltdfImport.repeatFiles.length && repeat) {
				eltdfImport.repeatFiles.forEach(function (index) {
					var data = {
						action: 'content',
						xml: index,
						images: eltdfImport.importImages
					};
					eltdfImport.importAjax(data);
				});
				eltdfImport.repeatFiles = [];

			}

			if (!repeat) {
				for (var i = 1; i < 20; i++) {
					var xml = i < 20 ? 'laurent_content_' + i + '.xml' : 'laurent_content_' + i + '.xml';
					var data = {
						action: 'content',
						xml: xml,
						images: eltdfImport.importImages
					};
					eltdfImport.importAjax(data);
				}
			}
		},

		importAjax: function (options) {
			var defaults = {
				demo: eltdfImport.importDemo,
				nonce: $('#eltdf_cd_import_nonce').val()
			};
			$.extend(defaults, options);
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'import_action',
					options: defaults
				},
				success: function (data) {
					var response = JSON.parse(data);
					eltdfImport.ajaxSuccess(response);
				},
				error: function (data) {
					var response = JSON.parse(data);
					eltdfImport.ajaxError(response, options);
				}
			});
		},

		importProgress: function () {
			if (!eltdfImport.contentFlag && !eltdfImport.allFlag) {
				eltdfImport.totalPercent = 100;
			} else if (eltdfImport.contentFlag) {
				if (eltdfImport.contentCounter < 21) {
					eltdfImport.totalPercent += 4.5;
				} else if (eltdfImport.contentCounter == 21) {
					eltdfImport.totalPercent += 10;
				}
			} else if (eltdfImport.allFlag) {
				if (eltdfImport.contentCounter < 21) {
					eltdfImport.totalPercent += 4;
				} else if (eltdfImport.contentCounter == 21) {
					eltdfImport.totalPercent += 10;
				} else {
					eltdfImport.totalPercent += 2;
				}
			}

			$('#eltdf-progress-bar').val(eltdfImport.totalPercent);
			$('.eltdf-cd-progress-percent').html(Math.round(eltdfImport.totalPercent) + '%');

			if (eltdfImport.totalPercent == 100) {
				$('#eltdf-import-demo-data').remove('.eltdf-import-demo-data-disabled');
				$('.eltdf-cd-import-is-completed').show();

			}
		},

		ajaxSuccess: function (response) {
			if (typeof response.status !== 'undefined' && response.status == 'success') {
				if (eltdfImport.contentFlag) {
					eltdfImport.contentCounter++;
					eltdfImport.importContent();
				}
				if (eltdfImport.allFlag) {
					eltdfImport.contentCounter++;
					eltdfImport.importAll();
				}
				eltdfImport.importProgress();
			} else {
				if (typeof response.data.type !== 'undefined' && response.data.type == 'content') {
					eltdfImport.repeatFiles.push(response.data['xml'])
				} else if (typeof response.data.type !== 'undefined' && response.data.type == 'options') {
					$('#eltdf-import-demo-data').remove('.eltdf-import-demo-data-disabled');
					$('.eltdf-cd-import-went-wrong').show();

				}
			}
		},

		ajaxError: function (response, options) {
			if ("xml" in options) {
				if (eltdfImport.contentFlag) {
					eltdfImport.importContent();
				}
				if (eltdfImport.allFlag) {
					eltdfImport.importAll();
				}
				eltdfImport.repeatFiles.push(options.xml);

			}
		},

		reset: function () {
			eltdfImport.totalPercent = 0;
			$('#eltdf-progress-bar').val(0);
		},

		populateSinglePage: function (value, demo, demoChange) {
			var holder = $('.eltdf-cd-box-form-section-dependency'),
				options = {
					demo: demo,
					nonce: $('#eltdf_cd_import_nonce').val()
				};

			if (value == 'single-page') {
				if (holder.children().length == 0 || demoChange) {

					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: {
							action: 'populate_single_pages',
							options: options
						},
						success: function (data) {
							var response = $.parseJSON(data);
							if (response.status == 'success') {
								$('.eltdf-cd-box-form-section-dependency').html(response.data);
								var singlePageList = $('select.eltdf-cd-import-single-page');
								holder.show();
								singlePageList.select2({
									dropdownCssClass: "eltdf-cd-single-page-selection"
								});
							} else {
								holder.html(response.message);
								holder.show();
							}
						}
					});
				} else {
					holder.show();
				}

			} else {
				holder.hide();
			}
		},
	};

	var eltdfThemeRegistration = {
		init: function () {
			eltdfThemeRegistration.holder = $('#eltdf-register-purchase-form');

			if (eltdfThemeRegistration.holder.length) {
				eltdfThemeRegistration.holder.each(function () {

					var form = $(this);

					var eltdfRegistrationBtn = $(this).find('#eltdf-register-purchase-key'),
						eltdfdeRegistrationBtn = $(this).find('#eltdf-deregister-purchase-key');

					eltdfRegistrationBtn.on('click', function (e) {
						e.preventDefault();
						$(this).addClass('eltdf-cd-button-disabled');
						$(this).attr("disabled", true);
						$(this).siblings('.eltdf-cd-button-wait').show();
						if (eltdfThemeRegistration.validateFields(form)) {
							var post = form.serialize();
							eltdfThemeRegistration.registration(post);
						} else {
							$(this).removeClass('eltdf-cd-button-disabled');
							$(this).attr("disabled", false);
							$(this).siblings('.eltdf-cd-button-wait').hide();
						}

					});

					eltdfdeRegistrationBtn.on('click', function (e) {
						$(this).addClass('eltdf-cd-button-disabled');
						$(this).attr("disabled", true);
						$(this).siblings('.eltdf-cd-button-wait').show();
						e.preventDefault();
						eltdfThemeRegistration.deregistration();
					});
				});
			}
		},

		registration: function (post) {
			var data = {
				action: 'register',
				post: post
			};
			eltdfThemeRegistration.registrationAjax(data);
		},

		deregistration: function () {
			var data = {
				action: 'deregister',
			};
			eltdfThemeRegistration.registrationAjax(data);
		},

		validateFields: function (form) {
			if (eltdfThemeRegistration.validatePurchaseCode(form) && eltdfThemeRegistration.validateEmail(form)) {
				return true
			}
		},

		validateEmail: function (form) {
			var email = form.find("[name='email']");
			var emailVal = email.val();
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if (emailVal !== '' && regex.test(emailVal)) {
				email.removeClass('eltdf-cd-error-field');
				email.parent().find('.eltdf-cd-error-message').remove();
				return true
			} else if (emailVal == '') {
				email.addClass('eltdf-cd-error-field');
				eltdfThemeRegistration.errorMessage(email.parent().data("empty-field"), email.parent());
			} else if (!regex.test(emailVal)) {
				email.addClass('eltdf-cd-error-field');
				eltdfThemeRegistration.errorMessage(email.parent().data("invalid-field"), email.parent());
			}
		},

		validatePurchaseCode: function (form) {
			var purchaseCode = form.find("[name='purchase_code']");
			var purchaseCodeVal = purchaseCode.val();

			if (purchaseCodeVal !== '') {
				purchaseCode.removeClass('eltdf-cd-error-field');
				purchaseCode.parent().find('.eltdf-cd-error-message').remove();
				return true
			} else {
				eltdfThemeRegistration.errorMessage(purchaseCode.parent().data("empty-field"), purchaseCode.parent());
				purchaseCode.addClass('eltdf-cd-error-field');
			}
		},

		errorMessage: function (message, target) {
			target.find('.eltdf-cd-error-message').remove();
			$('<span class="eltdf-cd-error-message"></span>').text(message).appendTo(target);
		},

		registrationAjax: function (options) {
			$.ajax({
				type: 'POST',
				url: eltdfCoreDashboardGlobalVars.vars.restUrl + eltdfCoreDashboardGlobalVars.vars.registrationThemeRoute,
				data: {
					options: options
				},
				beforeSend: function ( request ) {
					request.setRequestHeader(
						'X-WP-Nonce',
						eltdfCoreDashboardGlobalVars.vars.restNonce
					);
				},
				success: function (response) {
					if (response.status == 'success') {
						location.reload();
					} else if (response.status == 'error' && ((typeof response.data['purchase_code'] !== 'undefined' && response.data['purchase_code'] === false) || (typeof response.data['already_used'] !== 'undefined' && response.data['already_used'] === true))) {
						eltdfThemeRegistration.errorMessage(response.message, $("[name='purchase_code']").parent());
						$('#eltdf-register-purchase-key').removeClass('eltdf-cd-button-disabled');
						$('#eltdf-register-purchase-key').attr("disabled", false);
						$('#eltdf-register-purchase-key').siblings('.eltdf-cd-button-wait').hide();
					} else if (response.status == 'error') {
						alert(response.message);
					}

				},
				error: function (response) {
					console.log(response);
				}
			});
		}
	};


	function eltdfThemeSelectStyles(selection) {
		if (!selection.id) {
			return selection.text;
		}

		var thumb = $(selection.element).data('thumb');
		if (!thumb) {
			return selection.text;
		} else {
			var $selection = $(
				'<img src="' + thumb + '" alt="Demo Thumbnail"><span class="img-changer-text">' + $(selection.element).text() + '</span>'
			);
			return $selection;
		}
	}

	function eltdfThemeSelectDemo() {
		var themeList = $('select.eltdf-import-demo');

		if(themeList.length) {
			themeList.select2({
				templateResult: eltdfThemeSelectStyles,
				minimumResultsForSearch: -1,
				dropdownCssClass: "eltdf-cd-selection"
			});
		}

		var optionList = $('select.eltdf-cd-import-option');
		if(optionList.length) {
			optionList.select2({
				minimumResultsForSearch: -1,
				dropdownCssClass: "eltdf-cd-action-selection"
			});
		}
	}

	function eltdfInitSwitch() {
		$(".eltdf-cd-cb-enable").on('click', function () {
			var parent = $(this).parents('.eltdf-cd-switch');
			$('.eltdf-cd-cb-disable', parent).removeClass('selected');
			$(this).addClass('selected');
			$('.eltdf-cd-import-attachments', parent).attr('checked', true);
		});

		$(".eltdf-cd-cb-disable").on('click', function () {
			var parent = $(this).parents('.eltdf-cd-switch');
			$('.eltdf-cd-cb-enable', parent).removeClass('selected');
			$(this).addClass('selected');
			$('.eltdf-cd-import-attachments', parent).attr('checked', false);
		});
	}

})(jQuery);
(function($) {
    'use strict';

    var like = {};
    
    like.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function eltdfOnDocumentReady() {
        eltdfLikes();
    }

    function eltdfLikes() {
        $(document).on('click','.eltdf-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                postID = likeLink.data('post-id'),
                type = '';

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }
    
            var dataToPass = {
                action: 'laurent_core_action_like',
                likes_id: id,
                type: type,
                like_nonce: $('#eltdf_like_nonce_'+postID).val()
            };
        
            var like = $.post(eltdfGlobalVars.vars.eltdfAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function ($) {
	'use strict';
	
	var rating = {};
	eltdf.modules.rating = rating;

    rating.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCommentRating();
	}
	
	function eltdfInitCommentRating() {
		var ratingHolder = $('.eltdf-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

		ratingHolder.each(function() {
		    var thisHolder = $(this),
                ratingInput = thisHolder.find('.eltdf-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.eltdf-star-rating');

                addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.change(function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	eltdf.modules.animationHolder = animationHolder;
	
	animationHolder.eltdfInitAnimationHolder = eltdfInitAnimationHolder;
	
	
	animationHolder.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function eltdfInitAnimationHolder(){
		var elements = $('.eltdf-grow-in, .eltdf-fade-in-down, .eltdf-element-from-fade, .eltdf-element-from-left, .eltdf-element-from-right, .eltdf-element-from-top, .eltdf-element-from-bottom, .eltdf-flip-in, .eltdf-x-rotate, .eltdf-z-rotate, .eltdf-y-translate, .eltdf-fade-in, .eltdf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
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
(function($) {
    'use strict';
	
	var accordions = {};
	eltdf.modules.accordions = accordions;
	
	accordions.eltdfInitAccordions = eltdfInitAccordions;
	
	
	accordions.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitAccordions();
	}

	/**
	 All functions to be called on $(window).on('load') should be in this function
	 */

	function eltdfOnWindowLoad() {
		eltdfElementorAccordions();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorAccordions(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_accordion.default', function() {
				eltdfInitAccordions();
			} );
		});
	}

	/**
	 * Init accordions shortcode
	 */
	function eltdfInitAccordions(){
		var accordion = $('.eltdf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('eltdf-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('eltdf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.eltdf-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('hover', function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
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
(function ($) {
	'use strict';
	
	var clientsCarousel = {};
	eltdf.modules.clientsCarousel = clientsCarousel;


	clientsCarousel.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorClientsCarousel();
	}

    /**
     * Elementor
     */
	function eltdfElementorClientsCarousel() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_clients_carousel.default', function () {
				eltdf.modules.common.eltdfOwlSlider();
			});
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	eltdf.modules.button = button;

	button.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfButton().init();
	}

	function eltdfOnWindowLoad() {
        eltdfInitButtonsAnimation();
		eltdfElementorButton();
    }

	/**
	 * Elementor
	 */
	function eltdfElementorButton(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_button.default', function() {
				eltdfButton().init();
				eltdfInitButtonsAnimation();
			} );
		});
	}

	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var eltdfButton = function() {
		//all buttons on the page
		var buttons = $('.eltdf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};

	function eltdfInitButtonsAnimation() {

	    var buttons = $('.eltdf-btn, .button');

	    if ( buttons.length ) {
	        buttons.each( function() {
	            var button = $(this);

	            if ( button.hasClass('eltdf-btn-simple') ) {
                    button.append('<span class="eltdf-btn-first-line"></span><span class="eltdf-btn-second-line"></span>');
                }

                if ( button.hasClass('eltdf-btn-outline') ) {
                    button.prepend('<span class="eltdf-btn-before-line"></span>');
                    button.append('<span class="eltdf-btn-after-line"></span>');

                    var beforeLine = button.find('.eltdf-btn-before-line'),
                        afterLine = button.find('.eltdf-btn-after-line');

                    beforeLine.height(button.outerHeight());
                    beforeLine.css('left', beforeLine.height() - 3);
                    afterLine.height(button.outerHeight());
                    afterLine.css('left', button.outerWidth() - afterLine.height());
                }

	            if ( button.hasClass('eltdf-btn-special') ) {

                    button.on('mouseenter', function () {
                        if (button.hasClass('eltdf-btn-animation-out')) {
                            button.removeClass('eltdf-btn-animation-out');
                            button.addClass('eltdf-btn-animation-in');
                        } else {
                            button.addClass('eltdf-btn-animation-in');
                        }
                    });

                    button.on('mouseleave', function () {
                        if (button.hasClass('eltdf-btn-animation-in')) {
                            button.removeClass('eltdf-btn-animation-in');
                            button.addClass('eltdf-btn-animation-out');
                        } else {
                            button.addClass('eltdf-btn-animation-out');
                        }
                    });
                }
            });
        }
    }
	button.eltdfButton = eltdfButton;
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	eltdf.modules.countdown = countdown;
	
	countdown.eltdfInitCountdown = eltdfInitCountdown;
	
	
	countdown.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCountdown();
	}

	/**
	 All functions to be called on $(window).on('load') should be in this function
	 */

	function eltdfOnWindowLoad() {
		eltdfElementorCountdown();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorCountdown(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_countdown.default', function() {
				eltdfInitCountdown();
			} );
		});
	}

	/**
	 * Countdown Shortcode
	 */
	function eltdfInitCountdown() {
		var countdowns = $('.eltdf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			currentYear = date.getFullYear(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month || currentYear !== year ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	eltdf.modules.counter = counter;
	
	counter.eltdfInitCounter = eltdfInitCounter;
	
	
	counter.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitCounter();
	}

	/**
	All functions to be called on $(window).on('load') should be in this function
	*/

	function eltdfOnWindowLoad() {
		eltdfElementorCounter();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorCounter(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_counter.default', function() {
				eltdfInitCounter();
			} );
		});
	}
	
	/**
	 * Counter Shortcode
	 */
	function eltdfInitCounter() {
		var counterHolder = $('.eltdf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.eltdf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('eltdf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	eltdf.modules.customFont = customFont;
	
	customFont.eltdfCustomFontResize = eltdfCustomFontResize;
	customFont.eltdfCustomFontTypeOut = eltdfCustomFontTypeOut;
	
	
	customFont.eltdfOnDocumentReady = eltdfOnDocumentReady;
	customFont.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfCustomFontTypeOut();
		eltdfElementorCustomFont();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorCustomFont(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_custom_font.default', function() {
				eltdfCustomFontResize();
				eltdfCustomFontTypeOut();
			} );
		});
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function eltdfCustomFontResize() {
		var holder = $('.eltdf-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.eltdf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.eltdf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.eltdf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.eltdf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
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
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function eltdfCustomFontTypeOut() {
		var eltdfTyped = $('.eltdf-cf-typed');
		
		if (eltdfTyped.length) {
			eltdfTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.eltdf-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.eltdf-custom-font-holder'),
					$strings         = typedWrap.data( 'strings' );

				var options = {
					strings: $strings,
					typeSpeed: 90,
					backDelay: 700,
					loop: true,
					contentType: 'text',
					loopCount: false,
					cursorChar: '_'
				};

				customFontHolder.appear(
					function () {

						if ( ! thisTyped.hasClass( 'qodef--initialized' ) ) {

							var typed = new Typed(
								thisTyped[0],
								options
							);
							thisTyped.addClass( 'qodef--initialized' );
						}

					},
					{ accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount }
				);
				});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';

	var elementsHolder = {};
	eltdf.modules.elementsHolder = elementsHolder;

	elementsHolder.eltdfInitElementsHolderResponsiveStyle = eltdfInitElementsHolderResponsiveStyle;


	elementsHolder.eltdfOnDocumentReady = eltdfOnDocumentReady;

	$(document).ready(eltdfOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitElementsHolderResponsiveStyle();
	}

	/*
	 **	Elements Holder responsive style
	 */
	function eltdfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.eltdf-elements-holder');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.eltdf-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1400-1600') !== 'undefined' && thisItem.data('1400-1600') !== false) {
                        largeLaptop = thisItem.data('1400-1600');
					}
					if (typeof thisItem.data('1025-1399') !== 'undefined' && thisItem.data('1025-1399') !== false) {
						smallLaptop = thisItem.data('1025-1399');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}

					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1400px) and (max-width: 1600px) {.eltdf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1399px) {.eltdf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.eltdf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.eltdf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.eltdf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}

                    if (typeof eltdf.modules.common.eltdfOwlSlider === "function") { // if owl function exist
                        var owl = thisItem.find('.eltdf-owl-slider');
                        if (owl.length) { // if owl is in elements holder
                            setTimeout(function () {
                                owl.trigger('refresh.owl.carousel'); // reinit owl
                            }, 100);
                        }
                    }

				});

				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}

			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	eltdf.modules.icon = icon;
	
	icon.eltdfIcon = eltdfIcon;
	
	
	icon.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfIcon().init();
	}

	/**
	 All functions to be called on $(window).on('load') should be in this function
	*/
	function eltdfOnWindowLoad() {
		eltdfElementorIcon();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorIcon(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_icon.default', function() {
				eltdfIcon().init();
			} );
		});
	}

	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIcon = function() {
		var icons = $('.eltdf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('eltdf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.eltdf-icon-animation-holder').addClass('eltdf-icon-animation-show');
				}, {accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.eltdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	icon.eltdfIcon = eltdfIcon;
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	eltdf.modules.googleMap = googleMap;
	
	googleMap.eltdfShowGoogleMap = eltdfShowGoogleMap;
	
	
	googleMap.eltdfOnDocumentReady = eltdfOnDocumentReady;

	$(document).on(
		'qodefGoogleMapsCallbackEvent',
		function () {
			eltdfOnDocumentReady();
		});
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfShowGoogleMap();
	}

	/*
   All functions to be called on $(window).on('load') should be in this function
   */
	function eltdfOnWindowLoad() {
		eltdfElementorShowGoogleMap();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorShowGoogleMap(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_google_map.default', function() {
				eltdfShowGoogleMap();
			} );
		});
	}
	
	/*
	 **	Show Google Map
	 */
	function eltdfShowGoogleMap(){
		var googleMap = $('.eltdf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.eltdf-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "eltdf-map-"+ uniqueId;
				
				eltdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function eltdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'eltdf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			mapId: "QODE_MAP_ID",
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltdf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('eltdf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			eltdfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function eltdfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		var pinImg = document.createElement( 'img' );
		pinImg.src = pin;
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.marker.AdvancedMarkerElement({
					map: map,
					position: results[0].geometry.location,
					content:  pinImg,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});

				window.addEventListener(
					'resize',
					function () {
						map.setCenter(results[0].geometry.location);
					}
				);
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	eltdf.modules.iconListItem = iconListItem;
	
	iconListItem.eltdfInitIconList = eltdfInitIconList;
	
	
	iconListItem.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitIconList().init();
	}

	/*
All functions to be called on $(window).on('load') should be in this function
*/
	function eltdfOnWindowLoad() {
		eltdfElementorIconList();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorIconList(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_icon_list_item.default', function() {
				eltdfInitIconList().init();
			} );
		});
	}

	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var eltdfInitIconList = function() {
		var iconList = $('.eltdf-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('eltdf-appeared');
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
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
(function ($) {
	'use strict';
	
	var imageGallery = {};
	eltdf.modules.imageGallery = imageGallery;


	imageGallery.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorImageGallery();
	}

    /**
     * Elementor
     */
	function eltdfElementorImageGallery() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_image_gallery.default', function () {
				eltdf.modules.common.eltdfOwlSlider();
				eltdf.modules.common.eltdfInitGridMasonryListLayout();
			});
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	eltdf.modules.pieChart = pieChart;
	
	pieChart.eltdfInitPieChart = eltdfInitPieChart;
	
	
	pieChart.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitPieChart();
	}

	/**
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorPieChart();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorPieChart(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_pie_chart.default', function() {
				eltdfInitPieChart();
			} );
		});
	}

	/**
	 * Init Pie Chart shortcode
	 */
	function eltdfInitPieChart() {
		var pieChartHolder = $('.eltdf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.eltdf-pc-percentage'),
					barColor = '#c9ab81',
					trackColor = '#0f1d22',
					lineWidth = 2,
					size = 200;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: eltdfGlobalVars.vars.eltdfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.eltdf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
    'use strict';

    var scrollingImage = {};
    eltdf.modules.scrollingImage = scrollingImage;

    scrollingImage.eltdfScrollingImage = eltdfScrollingImage;

    scrollingImage.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfScrollingImage();
    }

    /**
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorImageWithText();
    }

    /**
     * Elementor
     */
    function eltdfElementorImageWithText() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_image_with_text.default', function () {
                eltdfScrollingImage();
            });
        });
    }

    /**
     * Init Scrolling Image effect
     */
    function eltdfScrollingImage() {
        var scrollingImageShortcodes = $('.eltdf-image-with-text-holder.eltdf-image-behavior-scrolling-image');

        if (scrollingImageShortcodes.length) {
            scrollingImageShortcodes.each(function(){
                var scrollingImageShortcode = $(this),
                    scrollingImageContentHolder = scrollingImageShortcode.find('.eltdf-iwt-image'),
                    scrollingFrame = scrollingImageShortcode.find('.eltdf-iwt-frame'),
                    scrollingFrameHeight,
                    scrollingFrameWidth,
                    scrollingImage = scrollingImageShortcode.find('.eltdf-iwt-main-image'),
                    scrollingImageHeight,
                    scrollingImageWidth,
                    delta,
                    timing,
                    scrollable = false,
                    horizontal = scrollingImageShortcode.hasClass('eltdf-scrolling-horizontal');

                var sizing = function() {
                    scrollingFrameHeight = scrollingFrame.height();
                    scrollingImageHeight = scrollingImage.height();
                    scrollingFrameWidth  = scrollingFrame.width();
                    scrollingImageWidth  = scrollingImage.width();
                    if (horizontal) {
                        delta = Math.round(scrollingImageWidth - scrollingFrameWidth);
                        timing = Math.round(scrollingImageWidth/scrollingFrameWidth)*2;
                    } else {
                        delta = Math.round(scrollingImageHeight - scrollingFrameHeight);
                        timing = Math.round(scrollingImageHeight/scrollingFrameHeight)*2;
                    }

                    if (horizontal) {
                        if (scrollingImageWidth > scrollingFrameWidth) {
                            scrollable = true;
                        }
                    } else {
                        if (scrollingImageHeight > scrollingFrameHeight) {
                            scrollable = true;
                        }
                    }
                };

                var scrollAnimation = function() {
                    //scroll animation on hover
                    scrollingImageContentHolder.on('mouseenter', function(){
                        scrollingImage.css('transition-duration',timing+'s'); //transition duration set in relation to image height
                        if (horizontal) {
                            scrollingImage.css('transform', 'translate3d(-'+delta+'px, 0px, 0px)');
                        } else {
                            scrollingImage.css('transform', 'translate3d(0px, -'+delta+'px, 0px)');
                        }});

                    //scroll animation reset
                    scrollingImageContentHolder.on('mouseleave', function(){
                        if (scrollable) {
                            scrollingImage.css('transition-duration', Math.min(timing/3, 3) +'s');
                            scrollingImage.css('transform', 'translate3d(0px, 0px, 0px)');
                        }
                    });
                };

                //init
                scrollingImageShortcode.waitForImages(function(){
                    scrollingImageShortcode.css('visibility', 'visible');
                    sizing();
                    scrollAnimation();
                });

                $(window).resize(function(){
                    sizing();
                });
            });
        }
    }

})(jQuery);
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
(function($) {
    'use strict';

    var reservationForm = {};
    eltdf.modules.reservationForm = reservationForm;

    reservationForm.eltdfReservationDatePicker = eltdfReservationDatePicker;
    reservationForm.eltdfInitReservationSelect2 = eltdfInitReservationSelect2;
    reservationForm.eltdfOnDocumentReady = eltdfOnDocumentReady;
    reservationForm.eltdfOnWindowResize = eltdfOnWindowResize;

    $(document).ready(eltdfOnDocumentReady);
    $(window).resize(eltdfOnWindowResize);
    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitReservationSelect2();
        eltdfReservationDatePicker();
        eltdfInitReservationSubmit();
    }

    function eltdfOnWindowResize() {
        eltdfInitReservationSelect2();
    }


    function eltdfOnWindowLoad() {
        eltdfInitReservationSelect2();
        eltdfElementorReservationForm();
        eltdfInitReservationSubmit();
    }

    /**
     * Elementor
     */
    function eltdfElementorReservationForm(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_reservation_form.default', function() {
                eltdfReservationDatePicker();
                eltdfInitReservationSelect2();
                eltdfInitReservationSubmit();
            } );
        });
    }

    function eltdfReservationDatePicker() {
        var datepicker = $('.eltdf-ot-date');

        if(datepicker.length) {
            datepicker.each(function () {

                $( this ).datepicker(
                    {
                        dateFormat: 'mm/dd/yy',
                    }
                );

                $( this ).datepicker().mousedown(function () {
                    var cond = $(this).data('datepicker').dpDiv.is(':visible');
                    $( this ).datepicker(cond ? 'hide' : 'show');
                });

            });
        }
    }

    function eltdfInitReservationSelect2() {
        var reservationSelect = $('.eltdf-ot-people, .eltdf-ot-time');

        if (reservationSelect.length) {
            var select2 = $('select.qodef-select2');

            if (select2.length) {
                reservationSelect.select2();
            }
        }
    }

    function eltdfInitReservationSubmit() {
        var $form = $( '.eltdf-rf' );

        $form.on(
            'submit',
            function ( e ) {
                e.preventDefault();

                var inputValues = $form.serializeArray(),
                    datetime    = '';

                $.each(
                    inputValues,
                    function () {
                        var $input    = $( this )[0],
                            inputName = $input.name;

                        if ( inputName === 'date' || inputName === 'time' ) {
                            datetime += ' ' + $input.value;
                        }
                    }
                );

                if ( datetime.length ) {
                    var date          = new Date( datetime ),
                        hours          = parseInt( date.getHours(), 10 ),
                        formattedHours = hours < 10 ? '0' + hours : hours,
                        formattedDate = date.getFullYear() + '-' + (parseInt( date.getMonth(), 10 ) < 10 ? '0' : '') + (parseInt( date.getMonth(), 10 ) + 1) + '-' + (parseInt( date.getDate(), 10 ) < 10 ? '0' : '') + date.getDate() + 'T' + formattedHours + ':' + date.getMinutes() + (parseInt( date.getMinutes(), 10 ) == 30 ? '' : '0');

                    $form.find( '[name="datetime"]' ).val( formattedDate );
                }

                window.open(
                    $form.attr( 'action' ) + '?' + $form.serialize(),
                    '_blank'
                );
            }
        );
    }

})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	eltdf.modules.progressBar = progressBar;
	
	progressBar.eltdfInitProgressBars = eltdfInitProgressBars;
	
	
	progressBar.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitProgressBars();
	}

	/**
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorProgressBars();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorProgressBars(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_progress_bar.default', function() {
				eltdfInitProgressBars();
			} );
		});
	}

	/*
	 **	Horizontal progress bars shortcode
	 */
	function eltdfInitProgressBars() {
		var progressBar = $('.eltdf-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.eltdf-pb-content'),
					progressBar = thisBar.find('.eltdf-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					eltdfInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('eltdf-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function eltdfInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var tabs = {};
	eltdf.modules.tabs = tabs;
	
	tabs.eltdfInitTabs = eltdfInitTabs;
	
	
	tabs.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);

	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfInitTabs();
	}
	/**
	 All functions to be called on $(window).on('load') should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorInitTabs();
	}

	/**
	 * Elementor
	 */
	function eltdfElementorInitTabs(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_tabs.default', function() {
				eltdfInitTabs();
			} );
		});
	}
	/*
	 **	Init tabs shortcode
	 */
	function eltdfInitTabs(){
		var tabs = $('.eltdf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.eltdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.eltdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.eltdf-tabs a.eltdf-external-link').unbind('click');
			});
		}
	}
	
})(jQuery);
(function($) {
    'use strict';

    var team = {};
    eltdf.modules.team = team;

    team.eltdfTeam = eltdfTeam;

    team.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);

    /*
        All functions to be called on $(window).on('load') should be in this function
    */
    function eltdfOnWindowLoad() {
        eltdfTeam();
        eltdfElementorTeam();
    }

    /**
     * Elementor
     */
    function eltdfElementorTeam(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_stacked_images.default', function() {
                eltdfTeam();
            } );
        });
    }

    function eltdfTeam() {
        var teamHolder = $('.eltdf-team-holder');

        if ( teamHolder.length ) {
            teamHolder.each( function() {
                var thisHolder = $(this),
                    teamIcon = thisHolder.find('.eltdf-team-icon');

                if ( teamIcon.length ) {
                    teamIcon.each( function() {
                        var thisIcon = $(this),
                            iconLink = thisIcon.find('a');

                        iconLink.append('<span class="eltdf-btn-first-line"></span><span class="eltdf-btn-second-line"></span>');
                    });
                }
            });
        }
    }

})(jQuery);
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
(function ($) {
	'use strict';
	
	var videoButton = {};
	eltdf.modules.videoButton = videoButton;


    videoButton.eltdfOnWindowLoad = eltdfOnWindowLoad;
	
	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
        eltdfElementorVideoButton();
	}


    /**
     * Elementor Video Button
     */
    function eltdfElementorVideoButton() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_video_button.default', function () {
                eltdf.modules.common.eltdfPrettyPhoto();
            });
        });
    }
	
})(jQuery);
(function($) {
    'use strict';

    var portfolioSlider = {};
    eltdf.modules.portfolioSlider = portfolioSlider;

	portfolioSlider.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);


    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
		eltdfElementorPortfolioSlider();
    }

	/**
	 * Elementor
	 */
	function eltdfElementorPortfolioSlider(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_portfolio_slider.default', function() {
				eltdf.modules.common.eltdfOwlSlider();
				eltdf.modules.common.eltdfPrettyPhoto();
			} );
		});
	}

})(jQuery);
(function($) {
    'use strict';

    var portfolioVerticalLoop = {};
    eltdf.modules.portfolioVerticalLoop = portfolioVerticalLoop;

    portfolioVerticalLoop.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

    function eltdfOnDocumentReady() {
        eltdfInitPortfolioVerticalLoop();
    }

    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorPortfolioVerticalLoop();
    }

    /**
     * Elementor
     */
    function eltdfElementorPortfolioVerticalLoop(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_portfolio_vertical_loop.default', function() {
                eltdfInitPortfolioVerticalLoop();
            } );
        });
    }

    function eltdfInitPortfolioVerticalLoop(){
        var portfolioVerticalLoopHolder = $('.eltdf-portfolio-vertical-loop-holder');

        if(portfolioVerticalLoopHolder.length) {
            portfolioVerticalLoopHolder.each(function() {
                var thisPortfolioVerticalLoop = $(this),
                    header = $('.eltdf-page-header'),
                    mobileHeader = $('.eltdf-mobile-header'),
                    headerAddition,
                    normalHeaderAddition,
                    headerHeight = header.outerHeight(),
                    paspartuWidth = eltdf.body.hasClass('eltdf-paspartu-enabled') ? parseInt($('.eltdf-paspartu-enabled .eltdf-wrapper').css('padding-left')) : 0;

                if (eltdf.body.hasClass('eltdf-content-is-behind-header')) {
                    normalHeaderAddition = 0;
                } else {
                    normalHeaderAddition = headerHeight;
                }

                var click = true;

                var container = $('.eltdf-pvl-inner');
                $(eltdf.body).on('click', '.eltdf-pvli-content-holder .eltdf-pvli-content-link', function (e) {
                    e.preventDefault();
                    if (click) {
                        click = false;
                        var thisLink = $(this);

                        //check for mobile header
                        if (eltdf.windowWidth < 1000) {
                            headerAddition = mobileHeader.outerHeight();
                        } else {
                            headerAddition = normalHeaderAddition;
                        }

                        var scrollTop = eltdf.window.scrollTop(),
                            elementOffset = thisLink.closest('article').offset().top,
                            distance = (elementOffset - scrollTop) - headerAddition - paspartuWidth;

                        container.find('article:eq(0)').addClass('fade-out');
                        thisLink.closest('article').addClass('move-up').removeClass('next-item').css('transform', 'translateY(-' + distance + 'px)');
                        setTimeout(function () {
                            eltdf.window.scrollTop(0);
                            container.find('article:eq(0)').remove();
                            thisLink.closest('article').removeAttr('style').removeClass('move-up');
                        }, 450);

                        var loadMoreData = eltdf.modules.common.getLoadMoreData(thisPortfolioVerticalLoop);

                        var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreData, 'laurent_core_portfolio_vertical_loop_ajax_load_more');

                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                            success: function (data) {

                                var response = $.parseJSON(data),
                                    responseHtml = response.html,
                                    nextItemId = response.next_item_id;
                                thisPortfolioVerticalLoop.data('next-item-id', nextItemId);

                                var nextItem = $(responseHtml).find('.eltdf-pvl-item-inner').parent().addClass('next-item').fadeIn(400);
                                container.append(nextItem);
                                click = true;
                            }
                        });

                        // load navigation
                        eltdfPortfolioVerticalLoopNavigation(thisPortfolioVerticalLoop);
                    }
                    else {
                        return false;
                    }
                });

                //load next item on page load
                eltdfPortfolioVerticalLoopNextItem(thisPortfolioVerticalLoop, container);

            });
        }
    }

    function eltdfPortfolioVerticalLoopNextItem(portfolioVerticalLoopHolder, container){
        var navHolder = portfolioVerticalLoopHolder.find('.eltdf-pvl-navigation-holder'),
            navigation = navHolder.find('.eltdf-pvl-navigation');

        if (typeof navHolder.data('id') !== 'undefined' && navHolder.data('id') !== false) {
            var navItemId = navHolder.data('id');
        }

        if (typeof navHolder.data('next-item-id') !== 'undefined' && navHolder.data('next-item-id') !== false) {
            var navNextItemId = navHolder.data('next-item-id');
        }


        if (typeof portfolioVerticalLoopHolder.data('id') === 'undefined' || portfolioVerticalLoopHolder.data('id') !== false) {
            portfolioVerticalLoopHolder.data('id', navItemId);
        }

        if (typeof portfolioVerticalLoopHolder.data('next-item-id') === 'undefined' || portfolioVerticalLoopHolder.data('next-item-id') === false) {
            portfolioVerticalLoopHolder.data('next-item-id', navNextItemId);
        }

        var loadMoreInitialData = eltdf.modules.common.getLoadMoreData(portfolioVerticalLoopHolder),
            ajaxInitialData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreInitialData, 'laurent_core_portfolio_vertical_loop_ajax_load_more');

        $.ajax({
            type: 'POST',
            data: ajaxInitialData,
            url: eltdfGlobalVars.vars.eltdfAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data),
                    responseHtml = response.html,
                    nextItemId = response.next_item_id;
                portfolioVerticalLoopHolder.data('next-item-id', nextItemId);

                var nextItem = $(responseHtml).find('.eltdf-pvl-item-inner').parent().addClass('next-item').fadeIn(400);
                container.append(nextItem);
            }
        });
    }

    function eltdfPortfolioVerticalLoopNavigation(portfolioVerticalLoopHolder){
        var navHolder = portfolioVerticalLoopHolder.find('.eltdf-pvl-navigation-holder'),
            navigation = navHolder.find('.eltdf-pvl-navigation'),
            loadMoreNavData = eltdf.modules.common.getLoadMoreData(navHolder);

        var ajaxDataNav = eltdf.modules.common.setLoadMoreAjaxData(loadMoreNavData, 'laurent_core_portfolio_vertical_loop_ajax_load_more_navigation');

        $.ajax({
            type: 'POST',
            data: ajaxDataNav,
            url: eltdfGlobalVars.vars.eltdfAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data),
                    responseHtml = response.html,
                    nextItemId = response.next_item_id;

                navHolder.data('next-item-id', nextItemId);

                navHolder.html(responseHtml);
            }
        });
    }

})(jQuery);
(function($) {
    'use strict';

    var portfolioList = {};
    eltdf.modules.portfolioList = portfolioList;

    portfolioList.eltdfOnWindowLoad = eltdfOnWindowLoad;
    portfolioList.eltdfOnWindowScroll = eltdfOnWindowScroll;

    $(window).on('load', eltdfOnWindowLoad);
    $(window).scroll(eltdfOnWindowScroll);

    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitPortfolioFilter();
        eltdfInitPortfolioListAnimation();
	    eltdfInitPortfolioPagination().init();
		eltdfElementorPortfolioList();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdfOnWindowScroll() {
	    eltdfInitPortfolioPagination().scroll();
    }

	/**
	 * Elementor
	 */
	function eltdfElementorPortfolioList(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_portfolio_list.default', function() {
				eltdf.modules.common.eltdfInitGridMasonryListLayout();
				eltdfInitPortfolioFilter();
				eltdfInitPortfolioListAnimation();
				eltdfInitPortfolioPagination().init();
			} );
		});
	}

    /**
     * Initializes portfolio list article animation
     */
    function eltdfInitPortfolioListAnimation(){
        var portList = $('.eltdf-portfolio-list-holder.eltdf-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.eltdf-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('eltdf-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('eltdf-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function eltdfInitPortfolioFilter(){
        var filterHolder = $('.eltdf-portfolio-list-holder .eltdf-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.eltdf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.eltdf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('eltdf-pl-pag-load-more');

                thisFilterHolder.find('.eltdf-pl-filter:first').addClass('eltdf-pl-current');
	            
	            if(thisPortListHolder.hasClass('eltdf-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.eltdf-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName);

                    thisFilter.parent().children('.eltdf-pl-filter').removeClass('eltdf-pl-current');
                    thisFilter.addClass('eltdf-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                eltdfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.eltdf-pl-inner').isotope({ filter: filterValue });
	                    eltdf.modules.common.eltdfInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function eltdfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.eltdf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'laurent_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.eltdf-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('eltdf-showing eltdf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdfGlobalVars.vars.eltdfAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
	                            eltdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.eltdf-masonry-grid-sizer').width(), true);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('eltdf-showing eltdf-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    eltdfInitPortfolioListAnimation();
	                                eltdf.modules.common.eltdfInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('eltdf-showing eltdf-filter-trigger');
                            eltdfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function eltdfInitPortfolioPagination(){
		var portList = $('.eltdf-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.eltdf-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.eltdf-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - eltdfGlobalVars.vars.eltdfAddForAdminBar;
			
			if(!thisPortList.hasClass('eltdf-pl-infinite-scroll-started') && eltdf.scroll + eltdf.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.eltdf-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
				thisPortList.addClass('eltdf-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = eltdf.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.eltdf-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
					loadingItem.addClass('eltdf-showing eltdf-standard-pag-trigger');
					thisPortList.addClass('eltdf-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('eltdf-showing');
				}
				
				var ajaxData = eltdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'laurent_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdfGlobalVars.vars.eltdfAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('eltdf-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
							eltdfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('eltdf-pl-masonry')){
									eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('eltdf-pl-gallery') && thisPortList.hasClass('eltdf-pl-has-filter')) {
									eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									eltdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('eltdf-pl-masonry')){
								    if(pagedLink === 1) {
                                        eltdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        eltdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('eltdf-pl-gallery') && thisPortList.hasClass('eltdf-pl-has-filter') && pagedLink !== 1) {
									eltdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink === 1) {
                                        eltdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        eltdfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('eltdf-pl-infinite-scroll-started')) {
							thisPortList.removeClass('eltdf-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.eltdf-pl-load-more-holder').hide();
			}
		};
		
		var eltdfInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.eltdf-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltdf-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltdf-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltdf-pag-next a');
			
			standardPagNumericItem.removeClass('eltdf-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('eltdf-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var eltdfInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
			eltdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.eltdf-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisPortList.removeClass('eltdf-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				eltdfInitPortfolioListAnimation();
				eltdf.modules.common.eltdfInitParallax();
				eltdf.modules.common.eltdfPrettyPhoto();
			}, 600);
		};
		
		var eltdfInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing eltdf-standard-pag-trigger');
			thisPortList.removeClass('eltdf-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			eltdfInitPortfolioListAnimation();
			eltdf.modules.common.eltdfInitParallax();
			eltdf.modules.common.eltdfPrettyPhoto();
		};
		
		var eltdfInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
			eltdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.eltdf-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('eltdf-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				eltdfInitPortfolioListAnimation();
				eltdf.modules.common.eltdfInitParallax();
				eltdf.modules.common.eltdfPrettyPhoto();
			}, 600);
		};
		
		var eltdfInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltdf-showing');
			thisPortListInner.append(responseHtml);
			eltdfInitPortfolioListAnimation();
			eltdf.modules.common.eltdfInitParallax();
			eltdf.modules.common.eltdfPrettyPhoto();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('eltdf-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('eltdf-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('eltdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}

})(jQuery);
(function ($) {
    'use strict';

    var testimonialsCarousel = {};
    eltdf.modules.testimonialsCarousel = testimonialsCarousel;

    testimonialsCarousel.eltdfInitTestimonials = eltdfInitTestimonialsCarousel;


    testimonialsCarousel.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfInitTestimonialsCarousel();
        eltdfElementorTestimonialsCarousel();
    }

    /**
     * Elementor
     */
    function eltdfElementorTestimonialsCarousel(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_testimonials.default', function() {
                eltdf.modules.common.eltdfOwlSlider();
                eltdfInitTestimonialsCarousel();
            } );
        });
    }
    
    /**
     * Init testimonials shortcode elegant type
     */
    function eltdfInitTestimonialsCarousel(){
        var testimonial = $('.eltdf-testimonials-holder.eltdf-testimonials-carousel');

        if(testimonial.length){
            testimonial.each(function(){
                var thisTestimonials = $(this),
                    mainTestimonialsSlider = thisTestimonials.find('.eltdf-testimonials-main'),
                    imagePagSlider = thisTestimonials.children('.eltdf-testimonial-image-nav'),
                    loop = true,
                    autoplay = true,
                    sliderSpeed = 5000,
                    sliderSpeedAnimation = 600,
                    mouseDrag = false;

                if (mainTestimonialsSlider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (mainTestimonialsSlider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (typeof mainTestimonialsSlider.data('slider-speed') !== 'undefined' && mainTestimonialsSlider.data('slider-speed') !== false) {
                    sliderSpeed = mainTestimonialsSlider.data('slider-speed');
                }
                if (typeof mainTestimonialsSlider.data('slider-speed-animation') !== 'undefined' && mainTestimonialsSlider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = mainTestimonialsSlider.data('slider-speed-animation');
                }
                if(eltdf.windowWidth < 680){
                    mouseDrag = true;
                }

                if (mainTestimonialsSlider.length && imagePagSlider.length) {
                    var text = mainTestimonialsSlider.owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: mouseDrag,
                        onInitialize: function () {
                            mainTestimonialsSlider.css('visibility', 'visible');
                        }
                    });

                    var image = imagePagSlider.owlCarousel({
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        center: true,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: false,
                        responsive: {
                            1025: {
                                items: 5
                            },
                            0: {
                                items: 3
                            }
                        },
                        onInitialize: function () {
                            imagePagSlider.css('visibility', 'visible');
                            thisTestimonials.css('opacity', '1');
                        }
                    });

                    imagePagSlider.find('.owl-item').on('click touchpress', function (e) {
                        e.preventDefault();

                        var thisItem = $(this),
                            itemIndex = thisItem.index(),
                            numberOfClones = imagePagSlider.find('.owl-item.cloned').length,
                            modifiedItems = itemIndex - numberOfClones / 2 >= 0 ? itemIndex - numberOfClones / 2 : itemIndex;

                        image.trigger('to.owl.carousel', modifiedItems);
                        text.trigger('to.owl.carousel', modifiedItems);
                    });

                }
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var testimonialsImagePagination = {};
    eltdf.modules.testimonialsImagePagination = testimonialsImagePagination;

    testimonialsImagePagination.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);
    $(window).on('load', eltdfOnWindowLoad);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfTestimonialsImagePagination();
    }

    /**
     All functions to be called on $(window).on('load') should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfElementorTestimonialsImagePagination();
    }
    /**
     * Elementor
     */
    function eltdfElementorTestimonialsImagePagination(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/eltdf_testimonials.default', function() {
                eltdfTestimonialsImagePagination();
            } );
        });
    }
    /**
     * Init Owl Carousel
     */
    function eltdfTestimonialsImagePagination() {
        var sliders = $('.eltdf-testimonials-image-pagination-inner');

        if (sliders.length) {
            sliders.each(function() {
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = false,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 500,
                    margin = 0,
                    stagePadding = 0,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOutClass = false, // keyframe css animation
                    navigation = true,
                    pagination = false,
                    drag = true,
                    sliderDataHolder = slider;

                if (sliderDataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
                    sliderSpeed = sliderDataHolder.data('slider-speed');
                }
                if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
                }
                if (sliderDataHolder.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
                }
                if (sliderDataHolder.data('enable-navigation') === 'no') {
                    navigation = false;
                }
                if (sliderDataHolder.data('enable-pagination') === 'yes') {
                    pagination = true;
                }

                if (navigation && pagination) {
                    slider.addClass('eltdf-slider-has-both-nav');
                }

                if (pagination) {
                    var dotsContainer = '#eltdf-testimonial-pagination';
                    $('.eltdf-tsp-item').on('click', function () {
                        slider.trigger('to.owl.carousel', [$(this).index(), 300]);
                    });
                }

                if (slideItemsNumber <= 1) {
                    loop = false;
                    autoplay = false;
                    navigation = false;
                    pagination = false;
                }

                slider.waitForImages(function () {
                    $(this).owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        margin: margin,
                        stagePadding: stagePadding,
                        center: center,
                        autoWidth: autoWidth,
                        animateIn: animateInClass,
                        animateOut: animateOutClass,
                        dots: pagination,
                        dotsContainer: dotsContainer,
                        nav: navigation,
                        drag: drag,
                        callbacks: true,
                        navText: [
                            '<span class="eltdf-prev-icon ion-chevron-left"></span>',
                            '<span class="eltdf-next-icon ion-chevron-right"></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        },
                        onDrag: function (e) {
                            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
                                var sliderIsMoving = e.isTrigger > 0;

                                if (sliderIsMoving) {
                                    slider.addClass('eltdf-slider-is-moving');
                                }
                            }
                        },
                        onDragged: function () {
                            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout') && slider.hasClass('eltdf-slider-is-moving')) {

                                setTimeout(function () {
                                    slider.removeClass('eltdf-slider-is-moving');
                                }, 500);
                            }
                        }
                    });

                });
            });
        }
    }
    
})(jQuery);
(function ($) {
	'use strict';
	
	var instagramList = {};
	eltdf.modules.instagramList = instagramList;


	instagramList.eltdfOnWindowLoad = eltdfOnWindowLoad;

	$(window).on('load', eltdfOnWindowLoad);
	
	/**
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfElementorInstagramList();
	}

    /**
     * Elementor
     */
	function eltdfElementorInstagramList() {
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/eltdf_instagram_list.default', function () {
				eltdf.modules.common.eltdfOwlSlider();
			});
		});
	}
	
})(jQuery);