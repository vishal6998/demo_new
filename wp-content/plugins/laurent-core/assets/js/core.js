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