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