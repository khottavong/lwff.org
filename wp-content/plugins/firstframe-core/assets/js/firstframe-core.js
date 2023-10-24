(function ( $ ) {
	'use strict';

	// This case is important when theme is not active
	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	window.qodefCore                = {};
	qodefCore.shortcodes            = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper: qodef.qodefSwiper,
		qodefPagination: qodef.qodefPagination,
		qodefFilter: qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
		qodefJustifiedGallery: qodef.qodefJustifiedGallery,
		qodefCustomCursor: qodefCore.qodefCustomCursor,
	};

	qodefCore.body         = $( 'body' );
	qodefCore.html         = $( 'html' );
	qodefCore.windowWidth  = $( window ).width();
	qodefCore.windowHeight = $( window ).height();
	qodefCore.scroll       = 0;

	$( document ).ready(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
			qodefInlinePageStyle.init();
			qodefButtonArrow.init();
			qodefStickyColumn.init();
		}
	);

	$( window ).resize(
		function () {
			qodefCore.windowWidth  = $( window ).width();
			qodefCore.windowHeight = $( window ).height();
		}
	);

	$( window ).scroll(
		function () {
			qodefCore.scroll = $( window ).scrollTop();
		}
	);

	$( window ).load(
		function () {
			qodefParallaxItem.init();
			qodefAppear.init();
		}
	);
	var qodefButtonArrow = {
        init: function () {
            var $buttons = $('body').find('#qodef-page-comments-list .qodef-comment-item .qodef-e-links > a');
            if ($buttons.length) {
                $buttons.each(
                    function () {
                        var $border = $(this).find('.qodef-m-button-arrow-holder'),
							$icon = '<span class="qodef-m-button-arrow-holder">' +
								'<svg xmlns="http://www.w3.org/2000/svg" width="21.474" height="21.474" viewBox="0 0 21.474 21.474">' +
								'<g>' +
								'<path d="M1.00098968 7.82392065h12.6487261v12.6487261"/>' +
								'<path d="M13.2565644 8.21707203 1.0540227 20.41961375"/>' +
								'</g>' +
								'<g>' +
								'<path d="M1.00098968 7.82392065h12.6487261v12.6487261"/>' +
								'<path d="M13.2565644 8.21707203 1.0540227 20.41961375"/>' +
								'</g>' +
								'</svg>' +
								'</span>';

						if (!$border.length) {
                            $buttons.append($icon);
                        }
                    }
                );
            }
        }
    };
    qodefCore.qodefButtonArrow = qodefButtonArrow;

	/**
	 * Check element to be in the viewport
	 */
	var qodefIsInViewport = {
		check: function ( $element, callback, onlyOnce ) {
			if ( $element.length ) {
				var offset = typeof $element.data( 'viewport-offset' ) !== 'undefined' ? $element.data( 'viewport-offset' ) : 0.15; // When item is 15% in the viewport

				var observer = new IntersectionObserver(
					function ( entries ) {
						// isIntersecting is true when element and viewport are overlapping
						// isIntersecting is false when element and viewport don't overlap
						if ( entries[0].isIntersecting === true ) {
							callback.call( $element );

							// Stop watching the element when it's initialize
							if ( onlyOnce !== false ) {
								observer.disconnect();
							}
						}
					},
					{ threshold: [offset] }
				);

				observer.observe( $element[0] );
			}
		},
	};

	qodefCore.qodefIsInViewport = qodefIsInViewport;

	var qodefScroll = {
		disable: function () {
			if ( window.addEventListener ) {
				window.addEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable: function () {
			if ( window.removeEventListener ) {
				window.removeEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{ passive: false }
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function ( e ) {
			e = e || window.event;
			if ( e.preventDefault ) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown: function ( e ) {
			var keys = [37, 38, 39, 40];
			for ( var i = keys.length; i--; ) {
				if ( e.keyCode === keys[i] ) {
					qodefScroll.preventDefaultValue( e );
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init: function ( $holder ) {
			if ( $holder.length ) {
				qodefPerfectScrollbar.qodefInitScroll( $holder );
			}
		},
		qodefInitScroll: function ( $holder ) {
			var $defaultParams = {
				wheelSpeed: 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$( window ).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $( '#firstframe-core-page-inline-style' );

			if ( this.holder.length ) {
				var style = this.holder.data( 'style' );

				if ( style.length ) {
					$( 'head' ).append( '<style type="text/css">' + style + '</style>' );
				}
			}
		}
	};

	/**
	 * Init parallax item
	 */
	var qodefParallaxItem = {
		init: function () {
			var $items = $( '.qodef-parallax-item' );

			if ( $items.length ) {
				$items.each(
					function () {
						var $currentItem = $( this ),
							$y           = Math.floor( Math.random() * (-100 - (-25)) + (-25) );

						if ( $currentItem.hasClass( 'qodef-grid-item' ) ) {
							$currentItem.children( '.qodef-e-inner' ).attr(
								'data-parallax',
								'{"y": ' + $y + ', "smoothness": ' + '30' + '}'
							);
						} else {
							$currentItem.attr(
								'data-parallax',
								'{"y": ' + $y + ', "smoothness": ' + '30' + '}'
							);
						}
					}
				);
			}

			qodefParallaxItem.initParallax();
		},
		initParallax: function () {
			var parallaxInstances = $( '[data-parallax]' );

			if ( parallaxInstances.length && ! qodefCore.html.hasClass( 'touchevents' ) && typeof ParallaxScroll === 'object' ) {
				ParallaxScroll.init(); //initialization removed from plugin js file to have it run only on non-touch devices
			}
		},
	};

	qodefCore.qodefParallaxItem = qodefParallaxItem;

	var qodefStickyColumn = {
		init: function () {
			var stickyColumnHolder = $( '.qodef-sticky-column-enable' );

			if ( stickyColumnHolder.length ) {
				stickyColumnHolder.each(
					function () {
						var thisSticky             = $( this );
						var columnInitialOffsetTop = $( this ).offset().top;
						var parentInitialOffsetTop = $( this ).parent().offset().top;

						qodefStickyColumn.setPosition(
							thisSticky,
							columnInitialOffsetTop,
							parentInitialOffsetTop
						);

						$( window ).scroll(
							function () {
								qodefStickyColumn.setPosition(
									thisSticky,
									columnInitialOffsetTop,
									parentInitialOffsetTop
								);
							}
						);

						$( window ).resize(
							function () {
								qodefStickyColumn.setPosition(
									thisSticky,
									columnInitialOffsetTop,
									parentInitialOffsetTop
								);
							}
						);
					}
				);
			}
		},
		setPosition: function ( thisSticky, columnInitialOffsetTop, parentInitialOffsetTop ) {
			var columnHeight = thisSticky.height();
			var parentHeight = thisSticky.parent().height();

			// if same height, then scrolling is doable
			if ( thisSticky.siblings().height() === thisSticky.parent().height() ) {

				var screenMiddle = qodefCore.scroll + (qodefGlobal.vars.adminBarHeight / 2) + (qodefCore.windowHeight / 2);
				var amount       = screenMiddle - columnInitialOffsetTop - (columnHeight / 2);
				var maxAmount    = parentHeight - columnHeight;

				if ( screenMiddle - (columnHeight / 2) >= columnInitialOffsetTop && screenMiddle - (columnHeight / 2) < parentInitialOffsetTop + parentHeight - columnHeight ) {
					thisSticky.css( { 'transform': 'translateY(' + parseInt( amount ) + 'px)' } );
				} else if ( screenMiddle - (columnHeight / 2) < columnInitialOffsetTop ) {
					thisSticky.css( { 'transform': 'translateY(' + 0 + 'px)' } );
				} else if ( screenMiddle - (columnHeight / 2) > parentInitialOffsetTop + parentHeight - columnHeight ) {
					thisSticky.css( { 'transform': 'translateY(' + parseInt( maxAmount ) + 'px)' } );
				}
			} else {
				thisSticky.css( { 'transform': 'translateY(' + 0 + 'px)' } );
			}
		}
	};

	qodefCore.qodefStickyColumn = qodefStickyColumn;

	/**
	 * Init animation on appear
	 */
	var qodefAppear = {
		init: function () {
			this.holder = $( '.qodef--has-appear:not(.qodef--appeared), .qodef--custom-appear:not(.qodef--appeared)' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var holder      = $( this ),
							randomNum   = gsap.utils.random(
								10,
								500,
								100
							),
							appearDelay = $( this ).attr( 'data-appear-delay' );

						appearDelay = appearDelay ? appearDelay : randomNum;

						qodefCore.qodefIsInViewport.check(
							holder,
							() => {
								qodef.qodefWaitForImages.check(
									holder,
									function () {
										setTimeout(
											function () {
												holder.addClass( 'qodef--appeared' );
											},
											appearDelay
										);
									}
								);
							}
						);
					}
				);
			}
		},
	};

	qodefCore.qodefAppear = qodefAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefAgeVerificationModal.init();
		}
	);

	var qodefAgeVerificationModal = {
		init: function () {
			this.holder = $( '#qodef-age-verification-modal' );

			if ( this.holder.length ) {
				var $preventHolder = this.holder.find( '.qodef-m-content-prevent' );

				if ( $preventHolder.length ) {
					var $preventYesButton = $preventHolder.find( '.qodef-prevent--yes' );

					$preventYesButton.on(
						'click',
						function () {
							var cname  = 'disabledAgeVerification';
							var cvalue = 'Yes';
							var exdays = 7;
							var d      = new Date();

							d.setTime( d.getTime() + (exdays * 24 * 60 * 60 * 1000) );
							var expires     = 'expires=' + d.toUTCString();
							document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';

							qodefAgeVerificationModal.handleClassAndScroll( 'remove' );
						}
					);
				}
			}
		},

		handleClassAndScroll: function ( option ) {
			if ( option === 'remove' ) {
				qodefCore.body.removeClass( 'qodef-age-verification--opened' );
				qodefCore.qodefScroll.enable();
			}
			if ( option === 'add' ) {
				qodefCore.body.addClass( 'qodef-age-verification--opened' );
				qodefCore.qodefScroll.disable();
			}
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefBackToTop.init();
		}
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodef.scroll,
				newPos   = qodef.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( newPos === 0 ) {
					return;
				}

				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};

			startAnimation();

			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 == n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll(
				function () {
					var $thisItem = $( this ),
						b         = $thisItem.scrollTop(),
						c         = $thisItem.height(),
						d;

					if ( b > 0 ) {
						d = b + c / 2;
					} else {
						d = 1;
					}

					if ( d < 1e3 ) {
						qodefBackToTop.addClass( 'off' );
					} else {
						qodefBackToTop.addClass( 'on' );
					}
				}
			);
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

(function ($) {
	"use strict";

	$( window ).on(
		'load',
		function () {
			qodefBackgroundText.init();
		}
	);

	$( window ).resize(
		function () {
			qodefBackgroundText.init();
		}
	);

	var qodefBackgroundText = {
		init                    : function () {
			var $holder = $( '.qodef-background-text' );

			if ($holder.length) {
				$holder.each(
					function () {
						qodefBackgroundText.responsiveOutputHandler( $( this ) );
					}
				);
			}
		},
		responsiveOutputHandler : function ($holder) {
			var breakpoints = {
				3840: 1441,
				1440: 1367,
				1366: 1025,
				1024: 1
			};

			$.each(
				breakpoints,
				function (max, min) {
					if (qodef.windowWidth <= max && qodef.windowWidth >= min) {
						qodefBackgroundText.generateResponsiveOutput( $holder, max );
					}
				}
			);
		},
		generateResponsiveOutput: function ($holder, width) {
			var $textHolder = $holder.find( '.qodef-m-background-text' );

			if ($textHolder.length) {
				$textHolder.css(
					{
						'font-size': $textHolder.data( 'size-' + width ) + 'px',
						'top'      : $textHolder.data( 'vertical-offset-' + width ) + 'px',
					}
				);
			}
		},
	};

	window.qodefBackgroundText = qodefBackgroundText;
})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefCustomCursor.init();
		}
	);

	var qodefCustomCursor = {
		currentPoint: {
			x: 0,
			y: 0
		},
		init: function () {
			this.holder = $( '#qodef-custom-cursor-holder' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var cursor          = $( this ),
							cursorTransform = cursor.find( '.qodef-custom-cursor-transform' );

						if ( qodef.html.hasClass( 'no-touchevents' ) && ! qodef.html.hasClass( 'elementor-html' ) ) {
							qodefCustomCursor.moveCursor( cursorTransform );
							qodefCustomCursor.linkCursor( cursor );
							qodefCustomCursor.arrowCursor( cursor );
							qodefCustomCursor.dragCursor( cursor );
							qodefCustomCursor.customText( cursor );
							qodefCustomCursor.blendModeCursor( cursor );
							qodefCustomCursor.maskSection( cursor );
							qodefCustomCursor.showHideCursor( cursor );

							cursor.addClass( 'qodef-custom-cursor-visible' );

							$( document ).on(
								'scroll',
								() => {
									cursor.removeClass( 'qodef-custom-cursor-hovering-link qodef-custom-cursor-hovering-video qodef-custom-cursor-hovering-arrow' );
								}
							);
						}
					}
				);
			}
		},
		moveCursor: function ( $cursor ) {
			let cursorWidth     = $cursor.width(),
				cursorHeight    = $cursor.width();
			var transformCursor = function ( x, y ) {
				$cursor.css(
					{
						'transform': 'translate3d(' + x + 'px, ' + y + 'px, 0)'
					}
				);
			};

			var handleMove = function ( e ) {
				qodefCustomCursor.currentPoint.x = e.clientX,
				qodefCustomCursor.currentPoint.y = e.clientY;

				requestAnimationFrame(
					function () {
						transformCursor(
							qodefCustomCursor.currentPoint.x - cursorWidth / 2,
							qodefCustomCursor.currentPoint.y - cursorHeight / 2,
						);
					}
				);
			};

			document.body.addEventListener(
				'pointermove',
				handleMove
			);
		},
		linkCursor: function ( cursor ) {
			var hoverItems = '.qodef-custom-cursor-link, a, p a, .swiper-button-next, .swiper-button-prev, .swiper-pagination-clickable .swiper-pagination-bullet, button.mfp-arrow, input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="number"], input[type="tel"], input[type="search"], input[type="date"], textarea, input[type="submit"], button[type="submit"], .qodef-theme-button, button.qodef-theme-button, select, body .select2-container--default .select2-selection--single, body .select2-container--default .select2-selection--single .select2-selection__clear, body .select2-container--default .select2-selection--multiple, body .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__clear, body .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice__remove, body .select2-container--default .select2-results__option[aria-selected], .mfp-close, .qodef--rev-anchor,.qodef-accordion-mark';

			var addCSSClass = function () {
				! cursor.hasClass( 'qodef-custom-cursor-hovering-link' ) && cursor.addClass( 'qodef-custom-cursor-hovering-link' );
			};

			var removeCSSClass = function () {
				cursor.hasClass( 'qodef-custom-cursor-hovering-link' ) && cursor.removeClass( 'qodef-custom-cursor-hovering-link' );
			};

			$( document ).on(
				'mousemove',
				hoverItems,
				addCSSClass
			);
			$( document ).on(
				'mouseleave',
				hoverItems,
				removeCSSClass
			);
		},
		dragCursor: function ( cursor ) {
			var hoverItems = '.qodef--drag-cursor';

			var addCSSClass = function () {
				! cursor.hasClass( 'qodef-custom-cursor-hovering-drag' ) && cursor.addClass( 'qodef-custom-cursor-hovering-drag' );
			};

			var removeCSSClass = function () {
				cursor.hasClass( 'qodef-custom-cursor-hovering-drag' ) && cursor.removeClass( 'qodef-custom-cursor-hovering-drag' );
			};

			$( document ).on(
				'mousemove',
				hoverItems,
				addCSSClass
			);
			$( document ).on(
				'mouseleave',
				hoverItems,
				removeCSSClass
			);
		},
		customText: function ( cursor ) {
			let hoverItems = '.qodef-image-with-text.qodef-layout--text-on-hover';

			let numberHolder = cursor.find( '.qodef-m-number' )[0],
				textHolder   = cursor.find( '.qodef-m-text' )[0];

			var addCSSClass = function () {
				! cursor.hasClass( 'qodef-custom-cursor-hovering-custom-text' ) && cursor.addClass( 'qodef-custom-cursor-hovering-custom-text' );
			};

			var removeCSSClass = function () {
				cursor.hasClass( 'qodef-custom-cursor-hovering-custom-text' ) && cursor.removeClass( 'qodef-custom-cursor-hovering-custom-text' );
			};

			var addContent = function ( e ) {
				let number              = $( e.currentTarget ).find( '.qodef-m-number' )[0].innerHTML,
					numberHolderContent = numberHolder.innerHTML,

					text                = $( e.currentTarget ).find( '.qodef-m-title' )[0].textContent,
					textHolderContent   = textHolder.innerHTML;

				if ( number !== numberHolderContent ) {
					numberHolder.append( number );
				}

				if ( text !== textHolderContent ) {
					textHolder.append( text );
				}
			};

			var removeContent = function () {
				let numberHolder = cursor.find( '.qodef-m-number' ),
					textHolder   = cursor.find( '.qodef-m-text' );

				numberHolder.text( '' );
				textHolder.text( '' );
			};

			$( document ).on(
				'mousemove',
				hoverItems,
				addCSSClass
			);
			$( document ).on(
				'mouseleave',
				hoverItems,
				removeCSSClass
			);

			$( document ).on(
				'mouseenter',
				hoverItems,
				addContent
			);

			$( document ).on(
				'mouseleave',
				hoverItems,
				removeContent
			);
		},
		arrowCursor: function ( cursor ) {
			var hoverItems = '.qodef-custom-cursor-arrow, rs-arrow',
				prevArrows = 'rs-arrow.tp-leftarrow';

			var addCSSClass = function ( e ) {
				! cursor.hasClass( 'qodef-custom-cursor-hovering-arrow' ) && cursor.addClass( 'qodef-custom-cursor-hovering-arrow' );
			};

			var removeCSSClass = function () {
				cursor.hasClass( 'qodef-custom-cursor-hovering-arrow' ) && cursor.removeClass( 'qodef-custom-cursor-hovering-arrow' );
			};

			var addPrevCSSClass = function ( e ) {
				! cursor.hasClass( 'qodef--prev' ) && cursor.addClass( 'qodef--prev' );
			};

			var removePrevCSSClass = function () {
				cursor.hasClass( 'qodef--prev' ) && cursor.removeClass( 'qodef--prev' );
			};

			$( document ).on(
				'mousemove',
				hoverItems,
				addCSSClass
			);
			$( document ).on(
				'mouseleave',
				hoverItems,
				removeCSSClass
			);

			$( document ).on(
				'mouseenter',
				prevArrows,
				addPrevCSSClass
			);

			$( document ).on(
				'mouseleave',
				prevArrows,
				removePrevCSSClass
			);
		},
		blendModeCursor: function ( cursor ) {
			var hoverItems = '.qodef-text-marquee span, .qodef-single-image, .qodef-offset-image-holder, .qodef-clients-list, .qodef-woo-product-list .qodef-e-media-inner a, .added_to_cart, .qodef-has-blend-mode-cursor, .qodef-svg--asterix';

			var addCSSClass = function () {
				! cursor.hasClass( 'qodef-custom-cursor-blend-mode' ) && cursor.addClass( 'qodef-custom-cursor-blend-mode' );
			};

			var removeCSSClass = function () {
				cursor.hasClass( 'qodef-custom-cursor-blend-mode' ) && cursor.removeClass( 'qodef-custom-cursor-blend-mode' );
			};

			$( document ).on(
				'mousemove',
				hoverItems,
				addCSSClass
			);
			$( document ).on(
				'mouseleave',
				hoverItems,
				removeCSSClass
			);
		},
		maskSection: function ( cursor ) {
			let $hoverItems = $( '.qodef-masked-section' );

			$hoverItems.each(
				function () {
					var $hoverItem       = $( this );

					$hoverItem.on(
						'mousemove',
						()=>{
							gsap.to(
								$hoverItem,
								{
									'--qode-x': qodefCustomCursor.currentPoint.x,
									'--qode-y': qodefCustomCursor.currentPoint.y - $hoverItem[0].getBoundingClientRect().top,
									duration: .5,
									overwrite: true,
								}
							);
						}
					);
				}
			);
		},
		showHideCursor: function ( cursor ) {
			var hoverItems = 'iframe';

			var addCSSClass = function ( e ) {
				! cursor.hasClass( 'qodef-custom-cursor-hide' ) && cursor.addClass( 'qodef-custom-cursor-hide' );
			};

			var removeCSSClass = function () {
				cursor.hasClass( 'qodef-custom-cursor-hide' ) && cursor.removeClass( 'qodef-custom-cursor-hide' );
			};

			$( document ).on(
				'mouseenter',
				hoverItems,
				addCSSClass
			);
			$( document ).on(
				'mouseleave',
				hoverItems,
				removeCSSClass
			);
		}
		,
	};

	qodefCore.qodefCustomCursor = qodefCustomCursor;

})
( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefUncoverFooter.init();
		}
	);

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $( '#qodef-page-footer.qodef--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverFooter.setHeight( qodefUncoverFooter.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css( 'height', 'auto' );

			var footerHeight = $holder.outerHeight();

			if ( footerHeight > 0 ) {
				$( '#qodef-page-outer' ).css(
					{
						'margin-bottom': footerHeight,
						'background-color': qodefCore.body.css( 'backgroundColor' )
					}
				);

				$holder.css( 'height', footerHeight );
			}
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-footer--uncover' );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	$( window ).on(
		'resize',
		function () {
			qodefFullscreenMenu.handleHeaderWidth( 'resize' );
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' );

			if ( $fullscreenMenuOpener.length ) {
				// prevent header changing width when fullscreen menu is open
				qodefFullscreenMenu.handleHeaderWidth( 'init' );

				// open popup menu
				$fullscreenMenuOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						var $thisOpener = $( this );

						if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
							qodefFullscreenMenu.openFullscreen( $thisOpener );

							$( document ).keyup(
								function ( e ) {
									if ( e.keyCode === 27 ) {
										qodefFullscreenMenu.closeFullscreen( $thisOpener );
									}
								}
							);
						} else {
							qodefFullscreenMenu.closeFullscreen( $thisOpener );
						}
					}
				);

				// open dropdowns
				$menuItems.on(
					'tap click',
					function ( e ) {
						var $thisItem = $( this );

						if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
							e.preventDefault();
							qodefFullscreenMenu.clickItemWithChild( $thisItem );
						} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
							qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
						}
					}
				);
			}
		},
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			qodefCore.qodefScroll.enable();
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		},
		handleHeaderWidth: function ( state ) {
			var $header               = $( '#qodef-page-header' );
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' );

			if ( $header.length && $fullscreenMenuOpener.length ) {
				// if desktop device
				if ( qodefCore.windowWidth > 1024 ) {
					// if page height is greater than window height, scroll bar is visible
					if ( qodefCore.body.height() > qodefCore.windowHeight ) {
						// on resize reset previously set inline width
						if ( 'resize' === state ) {
							$header.css( { 'width': '' } );
						}
						$header.width( $header.width() );
					}
				} else {
					// reset previously set inline width
					$header.css( { 'width': '' } );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefMobileHeaderAppearance.init();
        }
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeaderAppearance = {
		init: function () {
			if ( qodefCore.body.hasClass( 'qodef-mobile-header-appearance--sticky' ) ) {

				var docYScroll1   = qodefCore.scroll,
					displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
					$pageOuter    = $( '#qodef-page-outer' );

				qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );

				$( window ).scroll(
				    function () {
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                        docYScroll1 = qodefCore.scroll;
                    }
				);

				$( window ).resize(
				    function () {
                        $pageOuter.css( 'padding-top', 0 );
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                    }
				);
			}
		},
		showHideMobileHeader: function ( docYScroll1, displayAmount, $pageOuter ) {
			if ( qodefCore.windowWidth <= 1024 ) {
				if ( qodefCore.scroll > displayAmount * 2 ) {
					//set header to be fixed
					qodefCore.body.addClass( 'qodef-mobile-header--sticky' );

					//add transition to it
					setTimeout(
						function () {
							qodefCore.body.addClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//add padding to content so there is no 'jumping'
					$pageOuter.css( 'padding-top', qodefGlobal.vars.mobileHeaderHeight );
				} else {
					//unset fixed header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky' );

					//remove transition
					setTimeout(
						function () {
							qodefCore.body.removeClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//remove padding from content since header is not fixed anymore
					$pageOuter.css( 'padding-top', 0 );
				}

				if ( (qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3) ) {
					//show sticky header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky-display' );
				} else {
					//hide sticky header
					qodefCore.body.addClass( 'qodef-mobile-header--sticky-display' );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefNavMenu.init();
		}
	);

	var qodefNavMenu = {
		init: function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li' );

			$menuItems.each(
				function () {
					var $thisItem = $( this );

					if ( $thisItem.find( '.qodef-drop-down-second' ).length ) {
						qodef.qodefWaitForImages.check(
							$thisItem,
							function () {
								var $dropdownHolder      = $thisItem.find( '.qodef-drop-down-second' ),
									$dropdownMenuItem    = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
									dropDownHolderHeight = $dropdownMenuItem.outerHeight();

								if ( navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) ) {
									$thisItem.on(
										'touchstart mouseenter',
										function () {
											$dropdownHolder.css(
												{
													'height': dropDownHolderHeight,
													'overflow': 'visible',
													'visibility': 'visible',
													'opacity': '1',
												}
											);
										}
									).on(
										'mouseleave',
										function () {
											$dropdownHolder.css(
												{
													'height': '0px',
													'overflow': 'hidden',
													'visibility': 'hidden',
													'opacity': '0',
												}
											);
										}
									);
								} else {
									if ( qodefCore.body.hasClass( 'qodef-drop-down-second--animate-height' ) ) {
										var animateConfig = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).css(
															{
																'visibility': 'visible',
																'height': '0',
																'opacity': '1',
															}
														);
														$dropdownHolder.stop().animate(
															{
																'height': dropDownHolderHeight,
															},
															400,
															'linear',
															function () {
																$dropdownHolder.css( 'overflow', 'visible' );
															}
														);
													},
													100
												);
											},
											timeout: 100,
											out: function () {
												$dropdownHolder.stop().animate(
													{
														'height': '0',
														'opacity': 0,
													},
													100,
													function () {
														$dropdownHolder.css(
															{
																'overflow': 'hidden',
																'visibility': 'hidden',
															}
														);
													}
												);

												$dropdownHolder.removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( animateConfig );
									} else {
										var config = {
											interval: 0,
											over: function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass( 'qodef-drop-down--start' ).stop().css( { 'height': dropDownHolderHeight } );
													},
													150
												);
											},
											timeout: 150,
											out: function () {
												$dropdownHolder.stop().css( { 'height': '0' } ).removeClass( 'qodef-drop-down--start' );
											}
										};

										$thisItem.hoverIntent( config );
									}
								}
							}
						);
					}
				}
			);
		},
		wideDropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--wide' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $menuItem        = $( this );
						var $menuItemSubMenu = $menuItem.find( '.qodef-drop-down-second' );

						if ( $menuItemSubMenu.length ) {
							$menuItemSubMenu.css( 'left', 0 );

							var leftPosition = $menuItemSubMenu.offset().left;

							if ( qodefCore.body.hasClass( 'qodef--boxed' ) ) {
								//boxed layout case
								var boxedWidth = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
								leftPosition   = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': boxedWidth } );

							} else if ( qodefCore.body.hasClass( 'qodef-drop-down-second--full-width' ) ) {
								//wide dropdown full width case
								$menuItemSubMenu.css( { 'left': -leftPosition, 'width': qodefCore.windowWidth } );
							} else {
								//wide dropdown in grid case
								$menuItemSubMenu.css( { 'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2 } );
							}
						}
					}
				);
			}
		},
		dropdownPosition: function () {
			var $menuItems = $( '.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children' );

			if ( $menuItems.length ) {
				$menuItems.each(
					function () {
						var $thisItem         = $( this ),
							menuItemPosition  = $thisItem.offset().left,
							$dropdownHolder   = $thisItem.find( '.qodef-drop-down-second' ),
							$dropdownMenuItem = $dropdownHolder.find( '.qodef-drop-down-second-inner ul' ),
							dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
							menuItemFromLeft  = $( window ).width() - menuItemPosition;

						if ( qodef.body.hasClass( 'qodef--boxed' ) ) {
							//boxed layout case
							var boxedWidth   = $( '.qodef--boxed #qodef-page-wrapper' ).outerWidth();
							menuItemFromLeft = boxedWidth - menuItemPosition;
						}

						var dropDownMenuFromLeft;

						if ( $thisItem.find( 'li.menu-item-has-children' ).length > 0 ) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						$dropdownHolder.removeClass( 'qodef-drop-down--right' );
						$dropdownMenuItem.removeClass( 'qodef-drop-down--right' );
						if ( menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth ) {
							$dropdownHolder.addClass( 'qodef-drop-down--right' );
							$dropdownMenuItem.addClass( 'qodef-drop-down--right' );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefParallaxBackground.init();
		}
	);

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init: function ( settings ) {
			this.$sections = $( '.qodef-parallax' );

			// Allow overriding the default config
			$.extend( this.$sections, settings );

			var isSupported = ! qodefCore.html.hasClass( 'touchevents' ) && ! qodefCore.body.hasClass( 'qodef-browser--edge' ) && ! qodefCore.body.hasClass( 'qodef-browser--ms-explorer' );

			if ( this.$sections.length && isSupported ) {
				this.$sections.each(
					function () {
						qodefParallaxBackground.ready( $( this ) );
					}
				);
			}
		},
		ready: function ( $section ) {
			$section.$imgHolder  = $section.find( '.qodef-parallax-img-holder' );
			$section.$imgWrapper = $section.find( '.qodef-parallax-img-wrapper' );
			$section.$img        = $section.find( 'img.qodef-parallax-img' );

			var h           = $section.height(),
				imgWrapperH = $section.$imgWrapper.height();

			$section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

			$section.buffer       = window.scrollY;
			$section.scrollBuffer = null;


			//calc and init loop
			requestAnimationFrame(
				function () {
					$section.$imgHolder.animate( { opacity: 1 }, 100 );
					qodefParallaxBackground.calc( $section );
					qodefParallaxBackground.loop( $section );
				}
			);

			//recalc
			$( window ).on(
				'resize',
				function () {
					qodefParallaxBackground.calc( $section );
				}
			);
		},
		calc: function ( $section ) {
			var wH = $section.$imgWrapper.height(),
				wW = $section.$imgWrapper.width();

			if ( $section.$img.width() < wW ) {
				$section.$img.css(
					{
						'width': '100%',
						'height': 'auto',
					}
				);
			}

			if ( $section.$img.height() < wH ) {
				$section.$img.css(
					{
						'height': '100%',
						'width': 'auto',
						'max-width': 'unset',
					}
				);
			}
		},
		loop: function ( $section ) {
			if ( $section.scrollBuffer === Math.round( window.scrollY ) ) {
				requestAnimationFrame(
					function () {
						qodefParallaxBackground.loop( $section );
					}
				); //repeat loop

				return false; //same scroll value, do nothing
			} else {
				$section.scrollBuffer = Math.round( window.scrollY );
			}

			var wH   = window.outerHeight,
				sTop = $section.offset().top,
				sH   = $section.height();

			if ( $section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH ) {
				var delta = (Math.abs( $section.scrollBuffer + wH - sTop ) / (wH + sH)).toFixed( 4 ), //coeff between 0 and 1 based on scroll amount
					yVal  = (delta * $section.movement).toFixed( 4 );

				if ( $section.buffer !== delta ) {
					$section.$imgWrapper.css( 'transform', 'translate3d(0,' + yVal + '%, 0)' );
				}

				$section.buffer = delta;
			}

			requestAnimationFrame(
				function () {
					qodefParallaxBackground.loop( $section );
				}
			); //repeat loop
		}
	};

	qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefReview.init();
		}
	);

	var qodefReview = {
		init: function () {
			var ratingHolder = $( '#qodef-page-comments-form .qodef-rating-inner' );

			var addActive = function ( stars, ratingValue ) {
				for ( var i = 0; i < stars.length; i++ ) {
					var star = stars[i];

					if ( i < ratingValue ) {
						$( star ).addClass( 'active' );
					} else {
						$( star ).removeClass( 'active' );
					}
				}
			};

			ratingHolder.each(
				function () {
					var thisHolder  = $( this ),
						ratingInput = thisHolder.find( '.qodef-rating' ),
						ratingValue = ratingInput.val(),
						stars       = thisHolder.find( '.qodef-star-rating' );

					addActive( stars, ratingValue );

					stars.on(
						'click',
						function () {
							ratingInput.val( $( this ).data( 'value' ) ).trigger( 'change' );
						}
					);

					ratingInput.change(
						function () {
							ratingValue = ratingInput.val();

							addActive( stars, ratingValue );
						}
					);
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideArea.init();
		}
	);

	var qodefSideArea = {
		init: function () {
			var $sideAreaOpener = $( 'a.qodef-side-area-opener' ),
				$sideAreaClose  = $( '#qodef-side-area-close' ),
				$sideArea       = $( '#qodef-side-area' );

			qodefSideArea.openerHoverColor( $sideAreaOpener );

			// Open Side Area
			$sideAreaOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					if ( ! qodefCore.body.hasClass( 'qodef-side-area--opened' ) ) {
						qodefSideArea.openSideArea();

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefSideArea.closeSideArea();
								}
							}
						);
					} else {
						qodefSideArea.closeSideArea();
					}
				}
			);

			$sideAreaClose.on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			if ( $sideArea.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $sideArea );
			}
		},
		openSideArea: function () {
			var $wrapper      = $( '#qodef-page-wrapper' );
			var currentScroll = $( window ).scrollTop();

			$( '.qodef-side-area-cover' ).remove();
			$wrapper.prepend( '<div class="qodef-side-area-cover"/>' );
			qodefCore.body.removeClass( 'qodef-side-area-animate--out' ).addClass( 'qodef-side-area--opened qodef-side-area-animate--in' );

			$( '.qodef-side-area-cover' ).on(
				'click',
				function ( e ) {
					e.preventDefault();
					qodefSideArea.closeSideArea();
				}
			);

			$( window ).scroll(
				function () {
					if ( Math.abs( qodefCore.scroll - currentScroll ) > 400 ) {
						qodefSideArea.closeSideArea();
					}
				}
			);
		},
		closeSideArea: function () {
			qodefCore.body.removeClass( 'qodef-side-area--opened qodef-side-area-animate--in' ).addClass( 'qodef-side-area-animate--out' );
		},
		openerHoverColor: function ( $opener ) {
			if ( typeof $opener.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $opener.data( 'hover-color' );
				var originalColor = $opener.css( 'color' );

				$opener.on(
					'mouseenter',
					function () {
						$opener.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$opener.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function() {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefSpinner.windowLoaded = true;

			if (document.visibilityState === 'visible') {
				qodefSpinner.fadeOutLoader();
			} else {
				document.addEventListener("visibilitychange", function() {
					if (document.visibilityState === 'visible') {
						qodefSpinner.fadeOutLoader();
					}
				});
			}
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		holder: '',
		windowLoaded: false,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner:not(.qodef--custom-spinner):not(.qodef-layout--textual)' );

			if ( this.holder.length ) {
				qodefSpinner.animateSpinner( isEditMode );
				qodefSpinner.fadeOutAnimation();
			}
		},
		animateSpinner: function ( isEditMode ) {

			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader();
			}
		},
		fadeOutLoader: function ( speed, delay, easing ) {
			var $holder = qodefSpinner.holder.length ? qodefSpinner.holder : $( '#qodef-page-spinner:not(.qodef--custom-spinner):not(.qodef-layout--textual)' );

			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, then show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

	qodefCore.qodefSpinner = qodefSpinner;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefSubscribeModal.init();
		}
	);

	var qodefSubscribeModal = {
		init: function () {
			this.holder = $( '#qodef-subscribe-popup-modal' );

			if ( this.holder.length ) {
				var $preventHolder = this.holder.find( '.qodef-sp-prevent' ),
					$modalClose    = $( '.qodef-sp-close' ),
					disabledPopup  = 'no';

				if ( $preventHolder.length ) {
					var isLocalStorage = this.holder.hasClass( 'qodef-sp-prevent-cookies' ),
						$preventInput  = $preventHolder.find( '.qodef-sp-prevent-input' ),
						preventValue   = $preventInput.data( 'value' );

					if ( isLocalStorage ) {
						disabledPopup = localStorage.getItem( 'disabledPopup' );
						sessionStorage.removeItem( 'disabledPopup' );
					} else {
						disabledPopup = sessionStorage.getItem( 'disabledPopup' );
						localStorage.removeItem( 'disabledPopup' );
					}

					$preventHolder.children().on(
						'click',
						function () {
							if ( preventValue !== 'yes' ) {
								preventValue = 'yes';
								$preventInput.addClass( 'qodef-sp-prevent-clicked' ).data( 'value', 'yes' );
							} else {
								preventValue = 'no';
								$preventInput.removeClass( 'qodef-sp-prevent-clicked' ).data( 'value', 'no' );
							}

							if ( preventValue === 'yes' ) {
								if ( isLocalStorage ) {
									localStorage.setItem( 'disabledPopup', 'yes' );
								} else {
									sessionStorage.setItem( 'disabledPopup', 'yes' );
								}
							} else {
								if ( isLocalStorage ) {
									localStorage.setItem( 'disabledPopup', 'no' );
								} else {
									sessionStorage.setItem( 'disabledPopup', 'no' );
								}
							}
						}
					);
				}

				if ( disabledPopup !== 'yes' ) {
					if ( qodefCore.body.hasClass( 'qodef-sp-opened' ) ) {
						qodefSubscribeModal.handleClassAndScroll( 'remove' );
					} else {
						qodefSubscribeModal.handleClassAndScroll( 'add' );
					}

					$modalClose.on(
						'click',
						function ( e ) {
							e.preventDefault();

							qodefSubscribeModal.handleClassAndScroll( 'remove' );
						}
					);

					// Close on escape
					$( document ).keyup(
						function ( e ) {
							if ( e.keyCode === 27 ) { // KeyCode for ESC button is 27
								qodefSubscribeModal.handleClassAndScroll( 'remove' );
							}
						}
					);
				}
			}
		},

		handleClassAndScroll: function ( option ) {
			if ( option === 'remove' ) {
				qodefCore.body.removeClass( 'qodef-sp-opened' );
				qodefCore.qodefScroll.enable();
			}

			if ( option === 'add' ) {
				qodefCore.body.addClass( 'qodef-sp-opened' );
				qodefCore.qodefScroll.disable();
			}
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefWishlist.init();
		}
	);

	/**
	 * Function object that represents wishlist area popup.
	 * @returns {{init: Function}}
	 */
	var qodefWishlist = {
		init: function () {
			var $wishlistLink = $( '.qodef-wishlist .qodef-m-link' );

			if ( $wishlistLink.length ) {
				$wishlistLink.each(
					function () {
						var $thisWishlistLink = $( this ),
							wishlistIconHTML  = $thisWishlistLink.html(),
							$responseMessage  = $thisWishlistLink.siblings( '.qodef-m-response' );

						$thisWishlistLink.off().on(
							'click',
							function ( e ) {
								e.preventDefault();

								if ( qodefCore.body.hasClass( 'logged-in' ) ) {
									var itemID = $thisWishlistLink.data( 'id' );

									if ( itemID !== 'undefined' && ! $thisWishlistLink.hasClass( 'qodef--added' ) ) {
										$thisWishlistLink.html( '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span>' );

										var wishlistData = {
											type: 'add',
											itemID: itemID,
										};

										$.ajax(
											{
												type: 'POST',
												url: qodefGlobal.vars.restUrl + qodefGlobal.vars.wishlistRestRoute,
												data: {
													options: wishlistData,
												},
												beforeSend: function ( request ) {
													request.setRequestHeader( 'X-WP-Nonce', qodefGlobal.vars.restNonce );
												},
												success: function ( response ) {

													if ( response.status === 'success' ) {
														$thisWishlistLink.addClass( 'qodef--added' );
														$responseMessage.html( response.message ).addClass( 'qodef--show' ).fadeIn( 200 );

														$( document ).trigger(
															'firstframe_core_wishlist_item_is_added',
															[itemID, response.data.user_id]
														);
													} else {
														$responseMessage.html( response.message ).addClass( 'qodef--show' ).fadeIn( 200 );
													}

													setTimeout(
														function () {
															$thisWishlistLink.html( wishlistIconHTML );

															var $wishlistTitle = $thisWishlistLink.find( '.qodef-m-link-label' );

															if ( $wishlistTitle.length ) {
																$wishlistTitle.text( $wishlistTitle.data( 'added-title' ) );
															}

															$responseMessage.fadeOut( 300 ).removeClass( 'qodef--show' ).empty();
														},
														800
													);
												}
											}
										);
									}
								} else {
									// Trigger event.
									$( document.body ).trigger( 'firstframe_membership_trigger_login_modal' );
								}
							}
						);
					}
				);
			}
		}
	};

	$( document ).on(
		'firstframe_core_wishlist_item_is_removed',
		function ( e, removedItemID ) {
			var $wishlistLink = $( '.qodef-wishlist .qodef-m-link' );

			if ( $wishlistLink.length ) {
				$wishlistLink.each(
					function () {
						var $thisWishlistLink = $( this ),
							$wishlistTitle    = $thisWishlistLink.find( '.qodef-m-link-label' );

						if ( $thisWishlistLink.data( 'id' ) === removedItemID && $thisWishlistLink.hasClass( 'qodef--added' ) ) {
							$thisWishlistLink.removeClass( 'qodef--added' );

							if ( $wishlistTitle.length ) {
								$wishlistTitle.text( $wishlistTitle.data( 'title' ) );
							}
						}
					}
				);
			}
		}
	);

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_accordion = {};

	$( document ).ready(
		function () {
			qodefAccordion.init();
		}
	);

	var qodefAccordion = {
		init: function () {
			var $holder = $( '.qodef-accordion' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						qodefAccordion.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( $currentItem.hasClass( 'qodef-behavior--accordion' ) ) {
				qodefAccordion.initAccordion( $currentItem );
			}

			if ( $currentItem.hasClass( 'qodef-behavior--toggle' ) ) {
				qodefAccordion.initToggle( $currentItem );
			}

			$currentItem.addClass( 'qodef--init' );
		},
		initAccordion: function ( $accordion ) {
			$accordion.accordion(
				{
					animate: 'swing',
					collapsible: true,
					active: 0,
					icons: '',
					heightStyle: 'content',
				}
			);
		},
		initToggle: function ( $toggle ) {
			var $toggleAccordionTitle = $toggle.find( '.qodef-accordion-title' );

			$toggleAccordionTitle.off().on(
				'mouseenter',
				function () {
					$( this ).addClass( 'ui-state-hover' );
				}
			).on(
				'mouseleave',
				function () {
					$( this ).removeClass( 'ui-state-hover' );
				}
			).on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopImmediatePropagation();

					var $thisTitle = $( this );

					if ( $thisTitle.hasClass( 'ui-state-active' ) ) {
						$thisTitle.removeClass( 'ui-state-active' );
						$thisTitle.next().removeClass( 'ui-accordion-content-active' ).slideUp( 300 );
					} else {
						$thisTitle.addClass( 'ui-state-active' );
						$thisTitle.next().addClass( 'ui-accordion-content-active' ).slideDown( 400 );
					}
				}
			);
		}
	};

	qodefCore.shortcodes.firstframe_core_accordion.qodefAccordion = qodefAccordion;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefAuthorListPagination.init();
		}
	);

	$( window ).scroll(
		function () {
			qodefAuthorListPagination.scroll();
		}
	);

	$( document ).on(
		'firstframe_core_trigger_author_load_more',
		function ( e, $holder, nextPage ) {
			qodefAuthorListPagination.triggerLoadMore( $holder, nextPage );
		}
	);

	/*
	 **	Init pagination functionality
	 */
	var qodefAuthorListPagination = {
		init: function ( settings ) {
			this.holder = $( '.qodef-author-pagination--on' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder = $( this );

						qodefAuthorListPagination.initPaginationType( $holder );
					}
				);
			}
		},
		scroll: function ( settings ) {
			this.holder = $( '.qodef-author-pagination--on' );

			// Allow overriding the default config
			$.extend( this.holder, settings );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $holder = $( this );

						if ( $holder.hasClass( 'qodef-pagination-type--infinite-scroll' ) ) {
							qodefAuthorListPagination.initInfiniteScroll( $holder );
						}
					}
				);
			}
		},
		initPaginationType: function ( $holder ) {
			if ( $holder.hasClass( 'qodef-pagination-type--standard' ) ) {
				qodefAuthorListPagination.initStandard( $holder );
			} else if ( $holder.hasClass( 'qodef-pagination-type--load-more' ) ) {
				qodefAuthorListPagination.initLoadMore( $holder );
			} else if ( $holder.hasClass( 'qodef-pagination-type--infinite-scroll' ) ) {
				qodefAuthorListPagination.initInfiniteScroll( $holder );
			}
		},
		initStandard: function ( $holder ) {
			var $paginationItems = $holder.find( '.qodef-m-pagination-items' );

			if ( $paginationItems.length ) {
				var options = $holder.data( 'options' );

				$paginationItems.children().each( function () {
					var $thisItem = $( this ),
						$itemLink = $thisItem.children( 'a' );

					qodefAuthorListPagination.changeStandardState( $holder, options.max_num_pages, 1 );

					$itemLink.on(
						'click',
						function ( e ) {
							e.preventDefault();

							if ( ! $thisItem.hasClass( 'qodef--active' ) ) {
								qodefAuthorListPagination.getNewPosts( $holder, $itemLink.data( 'paged' ) );
							}
						}
					);
				} );
			}
		},
		changeStandardState: function ( $holder, max_num_pages, nextPage ) {
			if ( $holder.hasClass( 'qodef-pagination-type--standard' ) ) {
				var $paginationNav = $holder.find( '.qodef-m-pagination-items' ),
					$numericItem   = $paginationNav.children( '.qodef--number' ),
					$prevItem      = $paginationNav.children( '.qodef--prev' ),
					$nextItem      = $paginationNav.children( '.qodef--next' );

				$numericItem.removeClass( 'qodef--active' ).eq( nextPage - 1 ).addClass( 'qodef--active' );

				$prevItem.children().data( 'paged', nextPage - 1 );

				if ( nextPage > 1 ) {
					$prevItem.show();
				} else {
					$prevItem.hide();
				}

				$nextItem.children().data( 'paged', nextPage + 1 );

				if ( nextPage === max_num_pages ) {
					$nextItem.hide();
				} else {
					$nextItem.show();
				}
			}
		},
		initLoadMore: function ( $holder ) {
			var $loadMoreButton = $holder.find( '.qodef-load-more-button' );

			$loadMoreButton.on(
				'click',
				function ( e ) {
					e.preventDefault();

					qodefAuthorListPagination.getNewPosts( $holder );
				}
			);
		},
		triggerLoadMore: function ( $holder, nextPage ) {
			qodefAuthorListPagination.getNewPosts( $holder, nextPage );
		},
		hideLoadMoreButton: function ( $holder, options ) {
			if ( $holder.hasClass( 'qodef-pagination-type--load-more' ) && options.next_page > options.max_num_pages ) {
				$holder.find( '.qodef-load-more-button' ).hide();
			}
		},
		initInfiniteScroll: function ( $holder ) {
			var holderEndPosition = $holder.outerHeight() + $holder.offset().top,
				scrollPosition    = qodefCore.scroll + qodefCore.windowHeight,
				options           = $holder.data( 'options' );

			if ( ! $holder.hasClass( 'qodef--loading' ) && scrollPosition > holderEndPosition && options.max_num_pages >= options.next_page ) {
				qodefAuthorListPagination.getNewPosts( $holder );
			}
		},
		getNewPosts: function ( $holder, nextPage ) {
			$holder.addClass( 'qodef--loading' );

			var $itemsHolder = $holder.children( '.qodef-grid-inner' );
			var options      = $holder.data( 'options' );

			qodefAuthorListPagination.setNextPageValue( options, nextPage, false );

			$.ajax(
				{
					type: 'GET',
					url: qodefGlobal.vars.restUrl + qodefGlobal.vars.authorPaginationRestRoute,
					data: {
						options: options,
					},
					beforeSend: function ( request ) {
						request.setRequestHeader( 'X-WP-Nonce', qodefGlobal.vars.restNonce );
					},
					success: function ( response ) {

						if ( response.status === 'success' ) {
							qodefAuthorListPagination.setNextPageValue( options, nextPage, true );
							qodefAuthorListPagination.changeStandardState( $holder, options.max_num_pages, nextPage );

							qodef.qodefWaitForImages.check(
								$itemsHolder,
								function () {
									qodefAuthorListPagination.addPosts( $itemsHolder, response.data, nextPage );

									qodefCore.body.trigger(
										'firstframe_core_trigger_get_new_authors',
										[$holder]
									);
								}
							);

							qodefAuthorListPagination.hideLoadMoreButton( $holder, options );
						} else {
							console.log( response.message );
						}
					},
					complete: function () {
						$holder.removeClass( 'qodef--loading' );
					}
				}
			);
		},
		setNextPageValue: function ( options, nextPage, ajaxTrigger ) {
			if ( typeof nextPage !== 'undefined' && nextPage !== '' && ! ajaxTrigger ) {
				options.next_page = nextPage;
			} else if ( ajaxTrigger ) {
				options.next_page = parseInt( options.next_page, 10 ) + 1;
			}
		},
		addPosts: function ( $itemsHolder, newItems, nextPage ) {
			if ( typeof nextPage !== 'undefined' && nextPage !== '' ) {
				$itemsHolder.html( newItems );
			} else {
				$itemsHolder.append( newItems );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_button = {};

	$( document ).ready(
		function () {
			qodefButton.init();
		}
	);

	var qodefButton = {
		init: function () {
			this.buttons = $( '.qodef-button' );

			if ( this.buttons.length ) {
				this.buttons.each(
					function () {
						qodefButton.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefButton.buttonHoverColor( $currentItem );
			qodefButton.buttonHoverBgColor( $currentItem );
			qodefButton.buttonHoverBorderColor( $currentItem );
		},
		buttonHoverColor: function ( $button ) {
			if ( typeof $button.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $button.data( 'hover-color' );
				var originalColor = $button.css( 'color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'color', hoverColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'color', originalColor );
					}
				);
			}
		},
		buttonHoverBgColor: function ( $button ) {
			if ( typeof $button.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $button.data( 'hover-background-color' );
				var originalBackgroundColor = $button.css( 'background-color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'background-color', hoverBackgroundColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'background-color', originalBackgroundColor );
					}
				);
			}
		},
		buttonHoverBorderColor: function ( $button ) {
			if ( typeof $button.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $button.data( 'hover-border-color' );
				var originalBorderColor = $button.css( 'borderTopColor' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'border-color', hoverBorderColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'border-color', originalBorderColor );
					}
				);
			}
		},
		changeColor: function ( $button, cssProperty, color ) {
			$button.css( cssProperty, color );
		}
	};

	qodefCore.shortcodes.firstframe_core_button.qodefButton = qodefButton;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_cards_gallery = {};

	$( document ).ready(
		function () {
			qodefCardsGallery.init();
		}
	);

	var qodefCardsGallery = {
		init: function () {
			this.holder = $( '.qodef-cards-gallery' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefCardsGallery.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefCardsGallery.initCards( $currentItem );
			qodefCardsGallery.initBundle( $currentItem );
		},
		initCards: function ( $holder ) {
			var $cards = $holder.find( '.qodef-m-card' );
			$cards.each(
				function () {
					var $card = $( this );

					$card.on(
						'click',
						function () {
							if ( ! $cards.last().is( $card ) ) {
								$card.addClass( 'qodef-out qodef-animating' ).siblings().addClass( 'qodef-animating-siblings' );
								$card.detach();
								$card.insertAfter( $cards.last() );

								setTimeout(
									function () {
										$card.removeClass( 'qodef-out' );
									},
									200
								);

								setTimeout(
									function () {
										$card.removeClass( 'qodef-animating' ).siblings().removeClass( 'qodef-animating-siblings' );
									},
									1200
								);

								$cards = $holder.find( '.qodef-m-card' );

								return false;
							}
						}
					);
				}
			);
		},
		initBundle: function ( $holder ) {
			if ( $holder.hasClass( 'qodef-animation--bundle' ) && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefCore.qodefIsInViewport.check(
					$holder,
					function () {
						$holder.addClass( 'qodef-appeared' );
						$holder.find( 'img' ).one(
							'animationend webkitAnimationEnd MSAnimationEnd oAnimationEnd',
							function () {
								$( this ).addClass( 'qodef-animation-done' );
							}
						);
					}
				);
			}
		}
	};

	qodefCore.shortcodes.firstframe_core_cards_gallery.qodefCardsGallery = qodefCardsGallery;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_countdown = {};

	$( document ).ready(
		function () {
			qodefCountdown.init();
		}
	);

	var qodefCountdown = {
		init: function () {
			this.countdowns = $( '.qodef-countdown' );

			if ( this.countdowns.length ) {
				this.countdowns.each(
					function () {
						qodefCountdown.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $countdownElement = $currentItem.find( '.qodef-m-date' ),
				dateFormats       = ['week', 'day', 'hour', 'minute', 'second'],
				options           = qodefCountdown.generateOptions( $currentItem, dateFormats );

			qodefCountdown.initCountdown( $countdownElement, options, dateFormats );
		},
		generateOptions: function ( $countdown, dateFormats ) {
			var options = {};

			options.date = typeof $countdown.data( 'date' ) !== 'undefined' ? $countdown.data( 'date' ) : null;

			for ( var i = 0; i < dateFormats.length; i++ ) {
				var label       = dateFormats[i] + 'Label',
					labelPlural = dateFormats[i] + 'LabelPlural';

				options[label]       = typeof $countdown.data( dateFormats[i] + '-label' ) !== 'undefined' ? $countdown.data( dateFormats[i] + '-label' ) : '';
				options[labelPlural] = typeof $countdown.data( dateFormats[i] + '-label-plural' ) !== 'undefined' ? $countdown.data( dateFormats[i] + '-label-plural' ) : '';
			}

			return options;
		},
		initCountdown: function ( $countdownElement, options, dateFormats ) {
			var countDownDate = new Date( options.date ).getTime();

			// Update the count down every 1 second
			var x = setInterval(
				function () {

					// Get today's date and time
					var now = new Date().getTime();

					// Find the distance between now and the count down date
					var distance = countDownDate - now;

					// Time calculations for days, hours, minutes and seconds
					this.weeks   = Math.floor( distance / (1000 * 60 * 60 * 24 * 7) );
					this.days    = Math.floor( (distance % (1000 * 60 * 60 * 24 * 7)) / (1000 * 60 * 60 * 24) );
					this.hours   = Math.floor( (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60) );
					this.minutes = Math.floor( (distance % (1000 * 60 * 60)) / (1000 * 60) );
					this.seconds = Math.floor( (distance % (1000 * 60)) / 1000 );

					for ( var i = 0; i < dateFormats.length; i++ ) {
						var dateName = dateFormats[i] + 's';
						qodefCountdown.initiateDate( $countdownElement, this[dateName], dateFormats[i], options );
					}

					// If the count down is finished, write some text
					if ( distance < 0 ) {
						clearInterval( x );
						qodefCountdown.afterClearInterval( $countdownElement, dateFormats, options );
					}
				},
				1000
			);
		},
		initiateDate: function ( $countdownElement, date, dateFormat, options ) {
			var $holder = $countdownElement.find( '.qodef-' + dateFormat + 's' );

			$holder.find( '.qodef-label' ).html( ( 1 === date ) ? options[dateFormat + 'Label'] : options[dateFormat + 'LabelPlural'] );

			date = (date < 10) ? '0' + date : date;

			$holder.find( '.qodef-digit' ).html( date );
		},
		afterClearInterval: function( $countdownElement, dateFormats, options ) {
			for ( var i = 0; i < dateFormats.length; i++ ) {
				var $holder = $countdownElement.find( '.qodef-' + dateFormats[i] + 's' );

				$holder.find( '.qodef-label' ).html( options[dateFormats[i] + 'LabelPlural'] );
				$holder.find( '.qodef-digit' ).html( '00' );
			}
		}
	};

	qodefCore.shortcodes.firstframe_core_countdown.qodefCountdown = qodefCountdown;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_counter = {};

	$( document ).ready(
		function () {
			qodefCounter.init();
		}
	);

	var qodefCounter = {
		init: function () {
			this.counters = $( '.qodef-counter' );

			if ( this.counters.length ) {
				this.counters.each(
					function () {
						qodefCounter.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $counterElement = $currentItem.find( '.qodef-m-digit' ),
				options         = qodefCounter.generateOptions( $currentItem );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					qodefCounter.counterScript( $counterElement, options );
				},
				false
			);
		},
		generateOptions: function ( $counter ) {
			var options   = {};
			options.start = typeof $counter.data( 'start-digit' ) !== 'undefined' && $counter.data( 'start-digit' ) !== '' ? $counter.data( 'start-digit' ) : 0;
			options.end   = typeof $counter.data( 'end-digit' ) !== 'undefined' && $counter.data( 'end-digit' ) !== '' ? $counter.data( 'end-digit' ) : null;
			options.step  = typeof $counter.data( 'step-digit' ) !== 'undefined' && $counter.data( 'step-digit' ) !== '' ? $counter.data( 'step-digit' ) : 1;
			options.delay = typeof $counter.data( 'step-delay' ) !== 'undefined' && $counter.data( 'step-delay' ) !== '' ? parseInt( $counter.data( 'step-delay' ), 10 ) : 100;
			options.txt   = typeof $counter.data( 'digit-label' ) !== 'undefined' && $counter.data( 'digit-label' ) !== '' ? $counter.data( 'digit-label' ) : '';

			return options;
		},
		counterScript: function ( $counterElement, options ) {
			var defaults = {
				start: 0,
				end: null,
				step: 1,
				delay: 50,
				txt: '',
			};

			var settings = $.extend( defaults, options || {} );
			var nb_start = settings.start;
			var nb_end   = settings.end;

			$counterElement.text( nb_start + settings.txt );

			// Timer
			// Launches every "settings.delay"
			var counterInterval = setInterval(
				function () {
					// Definition of conditions of arrest
					if ( nb_end !== null && nb_start >= nb_end ) {
						return;
					}

					// incrementation
					nb_start = nb_start + settings.step;

					// Check is ended
					if ( nb_start >= nb_end ) {
						nb_start = nb_end;

						clearInterval( counterInterval );
					}

					// display
					$counterElement.text( nb_start + settings.txt );
				},
				settings.delay
			);
		}
	};

	qodefCore.shortcodes.firstframe_core_counter.qodefCounter = qodefCounter;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_frame_slider = {};

	$( document ).ready(
		function () {
			qodefFrameSlider.init();
		}
	);

	var qodefFrameSlider = {
		init: function () {
			this.holder = $( '.qodef-frame-slider-holder' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefFrameSlider.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $holder ) {
			var $swiperHolder = $holder.find( '.qodef-m-swiper' ),
				$sliderHolder = $holder.find( '.qodef-m-items' ),
				$pagination   = $holder.find( '.swiper-pagination' );

			var $swiper = new Swiper(
				$swiperHolder,
				{
					slidesPerView: 'auto',
					centeredSlides: true,
					spaceBetween: 0,
					autoplay: true,
					loop: true,
					speed: 800,
					pagination: {
						el: $pagination,
						type: 'bullets',
						clickable: true,
					},
					on: {
						init: function () {
							setTimeout(
								function () {
									$sliderHolder.addClass( 'qodef-swiper--initialized' );
								},
								1500
							);
						}
					},
				}
			);
		}
	};

	qodefCore.shortcodes.firstframe_core_frame_slider.qodefFrameSlider = qodefFrameSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_horizontal_projects = {};

	$( document ).ready(
		function () {
			qodefHorizontalLayout.init();
		}
	);

	var qodefHorizontalLayout = {
		init: function () {
			this.holder = $( '.qodef-horizontal-projects' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefHorizontalLayout.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $wrapper    = $currentItem.find( '.qodef-hl-items-wrapper' ),
				$items      = $currentItem.find( '.qodef-hl-item' ),
				$scrollArea = $currentItem.find( '#qodef-hl-scroll-area' ),
				$tops       = $currentItem.find( '.qodef-hli-top' ),
				$mids       = $currentItem.find( '.qodef-hli-mid' ),
				$btms       = $currentItem.find( '.qodef-hli-btm' ),
				$cta        = $currentItem.find( '.qodef-hl-cta' ),
				$label      = $currentItem.find( '.qodef-hli-label-second' ),
				numOfItems  = $items.length,
				btmOffset   = 0,
				reverted    = false,
				ctaW,
				speed       = 100; //vh per item

			var c, w, offset, wrapperW,
				sX = 0,
				dX = 0;

			//trigger calculations
			var calc = function () {
				reset();
				setVars();
				setBottom();
				setX();
				setPositions();
			};

			//variables for calculation
			var setVars = function () {
				c        = $( '.qodef-header--vertical-sliding #qodef-page-header' ).length && window.innerWidth > 1024 ? $( '.qodef-header--vertical-sliding #qodef-page-header' ).width() : 0;
				w        = window.innerWidth > 1024 ? 372 : window.innerWidth;
				offset   = window.innerWidth > 1024 ? window.innerWidth / 2 : window.innerWidth;
				ctaW     = $cta.outerWidth();
				wrapperW = (numOfItems - 1) * w + offset + ctaW;
			};

			//position bottom media element below the longest text el.
			var setBottom = function () {
				btmOffset = 0;

				$mids.each( function () {
					if ( $( this ).outerHeight( true ) > btmOffset ) btmOffset = $( this ).outerHeight( true );
				} );

				$btms.height( (1 - (btmOffset + $tops.first().height()) / window.innerHeight) * 100 + 'vh' );
			};

			//calc next x value based on scroll position
			var setX = function () {
				sX = 1 - (qodef.scroll) / (parseFloat( $scrollArea.height() ) - window.innerHeight);
			};

			//position items incrementally to the right
			var setPositions = function () {
				$items.each( function ( i ) {
					$( this ).css(
						'right',
						(numOfItems - i - 1) * w + ctaW
					);
				} );
			};

			//animate rAF
			var animate = function ( $active ) {
				reverted = false;
				var val  = Math.min(
					parseFloat( (1 - ($active.offset().left - c) / (offset - c)).toFixed( 4 ) ),
					1
				); //0-1

				//prev
				$active.prevAll( '.qodef-hl-item' ).css( {
					'transform': 'translate3d(-' + (offset - w) * val + 'px, 0, 0)',
					'width': offset + 'px'
				} );

				$active.prevAll().find( '.qodef-hli-btm-inner' ).height( '100%' );
				$active.prevAll().addClass( 'qodef-hl-item-active' );
				//active


				$active.css( {
					'transform': 'translate3d(0, 0, 0)',
					'width': w + (offset - w) * val + 'px'
				} );
				$active.toggleClass( 'qodef-hl-item-active' );


				$active.find( '.qodef-hli-btm-inner' ).height( Math.min(
					Math.max(
						(55 + val * 65),
						55
					),
					100
				) + '%' );
				//next
				$active.next( '.qodef-hl-item' ).css( {
					'transform': 'translate3d(0, 0, 0)',
					'width': w + 'px'
				} );
				$active.nextAll().removeClass( 'qodef-hl-item-active' );


				$active.nextAll().find( '.qodef-hli-btm-inner' ).height( '55%' );


			};

			//reset values
			var reset = function () {
				reverted = true;

				$items.css(
					'transform',
					'translate3d(0, 0, 0)'
				);

				$items.not( ':first-child' ).width( w );
				$items.not( ':first-child' ).find( '.qodef-hli-btm-inner' ).height( '55%' );

			};

			//set active item if in between 0 and offset values
			var setActive = function () {
				var $active = $items.not( ':first-child' ).filter( function () {
					var $item = $( this );

					return $item.offset().left <= offset && $item.offset().left > 0;
				} );

				$active.length && animate( $active.first() );

			};

			//60fps render
			var render = function () {
				dX = lerp(
					dX,
					sX,
					0.1
				);
				dX = Math.max(
					dX,
					0
				);
				if ( window.innerWidth > 1024 ) dX = parseFloat( dX.toFixed( 4 ) );

				$wrapper.css(
					'transform',
					'translate3d(' + dX * (wrapperW - window.innerWidth + c) + 'px, 0, 0)'
				);

				setActive();
				! reverted && qodef.scroll == 0 && reset();

				requestAnimationFrame( render );
			};

			//linear interpolation
			var lerp = function ( a, b, n ) {
				return (1 - n) * a + n * b;
			};

			var init = function () {
				qodef.body.addClass( 'qodef-with-horizontal-layout' );
				calc();
				$scrollArea.height( numOfItems * speed + 'vh' );
				window.addEventListener(
					'scroll',
					setX
				);

				//resize debounce
				var resizeTimer;
				window.addEventListener(
					'resize',
					function () {
						clearTimeout( resizeTimer );
						resizeTimer = setTimeout(
							function () {
								calc();
							},
							250
						);
					}
				);

				requestAnimationFrame( render );
			};

			init();
		},
	};
})( jQuery );
(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_horizontal_timeline = {};

	$( document ).ready( function () {
		qodefHorizontalTimeline.init();
	} );

	var qodefHorizontalTimeline = {
		init: function () {
			this.holder = $( '.qodef-horizontal-timeline' );

			if ( this.holder.length ) {
				this.holder.each( function () {
					var $timeline           = $( this ),
						$timelineComponents = {};

					var $eventsMinDistance = $timeline.data( 'distance' );

					if ( qodefCore.windowWidth < 600 ) {
						$eventsMinDistance = 140;
					}

					//cache timeline components
					$timelineComponents['timelineNavWrapper']      = $timeline.find( '.qodef-ht-nav-wrapper' );
					$timelineComponents['timelineNavWrapperWidth'] = $timelineComponents['timelineNavWrapper'].width();
					$timelineComponents['timelineNavInner']        = $timelineComponents['timelineNavWrapper'].find( '.qodef-ht-nav-inner' );
					$timelineComponents['fillingLine']             = $timelineComponents['timelineNavInner'].find( '.qodef-ht-nav-filling-line' );
					$timelineComponents['timelineEvents']          = $timelineComponents['timelineNavInner'].find( 'a' );
					$timelineComponents['timelineDates']           = qodefHorizontalTimeline.parseDate( $timelineComponents['timelineEvents'] );
					$timelineComponents['eventsMinLapse']          = qodefHorizontalTimeline.minLapse( $timelineComponents['timelineDates'] );
					$timelineComponents['timelineNavigation']      = $timeline.find( '.qodef-ht-nav-navigation' );
					$timelineComponents['timelineEventContent']    = $timeline.find( '.qodef-ht-content' );

					//select initial event
					$timelineComponents['timelineEvents'].first().addClass( 'qodef-selected' );
					$timelineComponents['timelineEventContent'].find( 'li' ).first().addClass( 'qodef-selected' );

					//assign a left postion to the single events along the timeline
					qodefHorizontalTimeline.setDatePosition(
						$timelineComponents,
						$eventsMinDistance
					);

					//assign a width to the timeline
					var $timelineTotWidth = qodefHorizontalTimeline.setTimelineWidth(
						$timelineComponents,
						$eventsMinDistance
					);

					//the timeline has been initialize - show it
					$timeline.addClass( 'qodef-loaded' );

					//detect click on the next arrow
					$timelineComponents['timelineNavigation'].on(
						'click',
						'.qodef-next',
						function ( e ) {
							e.preventDefault();
							qodefHorizontalTimeline.updateSlide(
								$timelineComponents,
								$timelineTotWidth,
								$eventsMinDistance,
								'next'
							);
						}
					);

					//detect click on the prev arrow
					$timelineComponents['timelineNavigation'].on(
						'click',
						'.qodef-prev',
						function ( e ) {
							e.preventDefault();
							qodefHorizontalTimeline.updateSlide(
								$timelineComponents,
								$timelineTotWidth,
								$eventsMinDistance,
								'prev'
							);
						}
					);

					//detect click on the a single event - show new event content
					$timelineComponents['timelineNavInner'].on(
						'click',
						'a',
						function ( e ) {
							e.preventDefault();

							var thisItem = $( this );

							$timelineComponents['timelineEvents'].removeClass( 'qodef-selected' );
							thisItem.addClass( 'qodef-selected' );

							qodefHorizontalTimeline.updateOlderEvents( thisItem );
							qodefHorizontalTimeline.updateFilling(
								thisItem,
								$timelineComponents['fillingLine'],
								$timelineTotWidth
							);
							qodefHorizontalTimeline.updateVisibleContent(
								thisItem,
								$timelineComponents['timelineEventContent']
							);
						}
					);

					var mq = qodefHorizontalTimeline.checkMQ();

					// Autoplay functionality
					var autoplayEnabled = $timeline.hasClass( 'qodef-autoplay--enabled' );

					if ( autoplayEnabled ) {
						// Autoplay variables
						var autoplaySpeed      = 4000,
							autoplayInterval,
							autoplayTimeout,
							autoplayTimeoutVal = 4000, // time in ms before autoplay resets again after user interruption
							lastNavItem        = $timeline.find( '.qodef-ht-nav-inner ol li:last-child a' );

						// Autoplay logic
						var autoplayStart = function () {
							autoplayInterval = setInterval(
								function () {
									if ( lastNavItem.hasClass( 'qodef-selected' ) ) {
										stopAutoplay();
									} else {
										qodefHorizontalTimeline.showNewContent(
											$timelineComponents,
											$timelineTotWidth,
											'next'
										);
									}
								},
								autoplaySpeed
							);
						};

						// Start autoplay on appear
						$timeline.appear(
							function () {
								qodefHorizontalTimeline.showNewContent(
									$timelineComponents,
									$timelineTotWidth,
									'next'
								);
								autoplayStart();
							},
							{ accX: 0, accY: 0 }
						);

						// Reset autoplay function
						var resetAutoplay = function () {
							clearInterval( autoplayInterval );
							autoplayTimeout = setTimeout(
								function () {
									autoplayStart();
								},
								autoplayTimeoutVal
							);
						};

						var stopAutoplay = function () {
							clearInterval( autoplayInterval );
						};
					}

					// Desktop drag events
					var dragEvent = {
						down: 'mousedown',
						up: 'mouseup',
						target: 'target',
					};

					var isTouchDevice = qodef.html.hasClass( 'touchevents' );

					// Touch drag events
					if ( isTouchDevice ) {
						dragEvent = {
							down: 'touchstart',
							up: 'touchend',
							target: 'srcElement',
						};
					}

					// Check if user is scrolling on touch devices
					var touchScrolling = function ( oldEvent, newEvent ) {
						if ( isTouchDevice ) {
							var oldY = oldEvent.originalEvent.changedTouches[0].clientY,
								newY = newEvent.originalEvent.changedTouches[0].clientY;

							if ( Math.abs( newY - oldY ) > 100 ) { // 100 is drag sensitivity
								return true;
							}
						}
						return false;
					};

					var getXPos = function ( e ) {
						return isTouchDevice ? e.originalEvent.changedTouches[0].clientX : e.clientX;
					};

					// Check if user is tapping on link on touch devices
					var tapOnLink = function ( e ) {
						return (isTouchDevice && $( e[dragEvent.target] ).is( 'a' )) ? true : false;
					};

					// Drag logic for top timeline
					var mouseTopDown = false;
					$timeline.find( '.qodef-ht-nav' ).on(
						dragEvent.down,
						function ( e ) {
							if ( ! mouseTopDown && ! tapOnLink( e ) ) {
								var xPos = getXPos( e );
								! isTouchDevice ? e.preventDefault() : null;
								mouseTopDown = true;

								$timeline.find( '.qodef-ht-nav' ).one(
									dragEvent.up,
									function ( e ) {
										var xPosNew = getXPos( e );
										! isTouchDevice ? e.preventDefault() : null;
										if ( Math.abs( xPos - xPosNew ) > 10 ) { // drag sensitivity
											if ( xPos > xPosNew ) {
												qodefHorizontalTimeline.updateSlide(
													$timelineComponents,
													$timelineTotWidth,
													$eventsMinDistance,
													'next'
												);
											} else {
												qodefHorizontalTimeline.updateSlide(
													$timelineComponents,
													$timelineTotWidth,
													$eventsMinDistance,
													'prev'
												);
											}
										}
										mouseTopDown = false;
									}
								);
							}
						}
					);

					// Drag logic for content items
					var mouseDown = false;
					$timeline.find( '.qodef-ht-content' ).on(
						dragEvent.down,
						function ( e ) {
							if ( ! mouseDown && ! $( e[dragEvent.target] ).is( 'a, span' ) ) {
								var oldEvent = e,
									xPos     = getXPos( e );
								mouseDown    = true;
								if ( autoplayEnabled ) {
									clearTimeout( autoplayTimeout );
									resetAutoplay();
								}

								$timeline.find( '.qodef-ht-content' ).one(
									dragEvent.up,
									function ( e ) {
										var xPosNew = getXPos( e );
										if ( Math.abs( xPos - xPosNew ) > 10 && ! touchScrolling(
											oldEvent,
											e
										) ) {
											if ( xPos > xPosNew ) {
												qodefHorizontalTimeline.showNewContent(
													$timelineComponents,
													$timelineTotWidth,
													'next'
												);
											} else {
												qodefHorizontalTimeline.showNewContent(
													$timelineComponents,
													$timelineTotWidth,
													'prev'
												);
											}
										}
										mouseDown = false;
									}
								);
							}
						}
					);

					//keyboard navigation
					$( document ).keyup( function ( event ) {
						if ( event.which === '37' && qodefHorizontalTimeline.elementInViewport( $timeline.get( 0 ) ) ) {
							qodefHorizontalTimeline.showNewContent(
								$timelineComponents,
								$timelineTotWidth,
								'prev'
							);
						} else if ( event.which === '39' && qodefHorizontalTimeline.elementInViewport( $timeline.get( 0 ) ) ) {
							qodefHorizontalTimeline.showNewContent(
								$timelineComponents,
								$timelineTotWidth,
								'next'
							);
						}
					} );
				} );
			}
		},
		updateSlide: function ( $timelineComponents, timelineTotWidth, $eventsMinDistance, string ) {
			//retrieve translateX value of $timelineComponents['timelineNavInner']
			var translateValue = qodefHorizontalTimeline.getTranslateValue( $timelineComponents['timelineNavInner'] ),
				wrapperWidth   = Number( $timelineComponents['timelineNavWrapper'].css( 'width' ).replace(
					'px',
					''
				) );
			//translate the timeline to the left('next')/right('prev')
			if ( string === 'next' ) {
				qodefHorizontalTimeline.translateTimeline(
					$timelineComponents,
					translateValue - wrapperWidth + $eventsMinDistance,
					wrapperWidth - timelineTotWidth
				);
			} else {
				qodefHorizontalTimeline.translateTimeline(
					$timelineComponents,
					translateValue + wrapperWidth - $eventsMinDistance
				);
			}
		},
		showNewContent: function ( $timelineComponents, timelineTotWidth, string ) {
			//go from one event to the next/previous one
			var visibleContent = $timelineComponents['timelineEventContent'].find( '.qodef-selected' ),
				newContent     = (string === 'next') ? visibleContent.next() : visibleContent.prev();

			if ( newContent.length > 0 ) { //if there's a next/prev event - show it
				var selectedDate = $timelineComponents['timelineNavInner'].find( '.qodef-selected' ),
					newEvent     = (string === 'next') ? selectedDate.parent( 'li' ).next( 'li' ).children( 'a' ) : selectedDate.parent( 'li' ).prev( 'li' ).children( 'a' );

				qodefHorizontalTimeline.updateFilling(
					newEvent,
					$timelineComponents['fillingLine'],
					timelineTotWidth
				);
				qodefHorizontalTimeline.updateVisibleContent(
					newEvent,
					$timelineComponents['timelineEventContent']
				);

				newEvent.addClass( 'qodef-selected' );
				selectedDate.removeClass( 'qodef-selected' );

				qodefHorizontalTimeline.updateOlderEvents( newEvent );
				qodefHorizontalTimeline.updateTimelinePosition(
					string,
					newEvent,
					$timelineComponents
				);
			}
		},
		updateTimelinePosition: function ( string, event, $timelineComponents ) {
			//translate timeline to the left/right according to the position of the qodef-selected event
			var eventStyle        = window.getComputedStyle(
				event.get( 0 ),
				null
				),
				eventLeft         = Number( eventStyle.getPropertyValue( 'left' ).replace(
					'px',
					''
				) ),
				timelineWidth     = Number( $timelineComponents['timelineNavWrapper'].css( 'width' ).replace(
					'px',
					''
				) ),
				timelineTotWidth  = Number( $timelineComponents['timelineNavInner'].css( 'width' ).replace(
					'px',
					''
				) ),
				timelineTranslate = qodefHorizontalTimeline.getTranslateValue( $timelineComponents['timelineNavInner'] );

			if ( (string === 'next' && eventLeft > timelineWidth - timelineTranslate) || (string === 'prev' && eventLeft < -timelineTranslate) ) {
				qodefHorizontalTimeline.translateTimeline(
					$timelineComponents,
					-eventLeft + timelineWidth / 2,
					timelineWidth - timelineTotWidth
				);
			}
		},
		translateTimeline: function ( $timelineComponents, value, totWidth ) {
			var timelineNavInner = $timelineComponents['timelineNavInner'].get( 0 );

			value = (value > 0) ? 0 : value; //only negative translate value
			value = ( ! (typeof totWidth === 'undefined') && value < totWidth) ? totWidth : value; //do not translate more than timeline width

			qodefHorizontalTimeline.setTransformValue(
				timelineNavInner,
				'translateX',
				value + 'px'
			);

			//update navigation arrows visibility
			(value === 0) ? $timelineComponents['timelineNavigation'].find( '.qodef-prev' ).addClass( 'qodef-inactive' ) : $timelineComponents['timelineNavigation'].find( '.qodef-prev' ).removeClass( 'qodef-inactive' );
			(value === totWidth) ? $timelineComponents['timelineNavigation'].find( '.qodef-next' ).addClass( 'qodef-inactive' ) : $timelineComponents['timelineNavigation'].find( '.qodef-next' ).removeClass( 'qodef-inactive' );
		},
		updateFilling: function ( selectedEvent, filling, totWidth ) {
			//change .qodef-ht-nav-filling-line length according to the qodef-selected event

			if ( $( window ).width() < 480 ) {
				var lineWidth = ($( '.qodef-ht-nav-wrapper' ).width() - 50) / 2;
				$( '.qodef-ht-nav-inner ol > li:first-child > a' ).css(
					'left',
					lineWidth
				);
			}

			var eventStyle = window.getComputedStyle(
				selectedEvent.get( 0 ),
				null
				),
				eventLeft  = eventStyle.getPropertyValue( 'left' ),
				eventWidth = eventStyle.getPropertyValue( 'width' );

			eventLeft = Number( eventLeft.replace(
				'px',
				''
			) ) + Number( eventWidth.replace(
				'px',
				''
			) ) / 2;

			var scaleValue = eventLeft / totWidth;

			qodefHorizontalTimeline.setTransformValue(
				filling.get( 0 ),
				'scaleX',
				scaleValue
			);
		},
		setDatePosition: function ( $timelineComponents, min ) {
			for ( var i = 0; i < $timelineComponents['timelineDates'].length; i++ ) {
				var distance     = qodefHorizontalTimeline.daydiff(
					$timelineComponents['timelineDates'][0],
					$timelineComponents['timelineDates'][i]
					),
					distanceNorm = Math.round( distance / $timelineComponents['eventsMinLapse'] ) + 2;

				$timelineComponents['timelineEvents'].eq( i ).css(
					'left',
					distanceNorm * min + 'px'
				);
			}
		},
		setTimelineWidth: function ( $timelineComponents, width ) {
			var timeSpan     = qodefHorizontalTimeline.daydiff(
				$timelineComponents['timelineDates'][0],
				$timelineComponents['timelineDates'][$timelineComponents['timelineDates'].length - 1]
				),
				timeSpanNorm = Math.round( timeSpan / $timelineComponents.eventsMinLapse ) + 4,
				totalWidth   = timeSpanNorm * width;

			if ( totalWidth < $timelineComponents['timelineNavWrapperWidth'] ) {
				totalWidth = $timelineComponents['timelineNavWrapperWidth'];
			}

			$timelineComponents['timelineNavInner'].css(
				'width',
				totalWidth + 'px'
			);

			qodefHorizontalTimeline.updateFilling(
				$timelineComponents['timelineNavInner'].find( 'a.qodef-selected' ),
				$timelineComponents['fillingLine'],
				totalWidth
			);
			qodefHorizontalTimeline.updateTimelinePosition(
				'next',
				$timelineComponents['timelineNavInner'].find( 'a.qodef-selected' ),
				$timelineComponents
			);

			return totalWidth;
		},
		updateVisibleContent: function ( event, timelineEventContent ) {
			var eventDate             = event.data( 'date' ),
				visibleContent        = timelineEventContent.find( '.qodef-selected' ),
				selectedContent       = timelineEventContent.find( '[data-date="' + eventDate + '"]' ),
				selectedContentHeight = selectedContent.height(),
				classEnetering        = 'qodef-selected qodef-enter-left',
				classLeaving          = 'qodef-leave-right';

			if ( selectedContent.index() > visibleContent.index() ) {
				classEnetering = 'qodef-selected qodef-enter-right';
				classLeaving   = 'qodef-leave-left';
			}

			selectedContent.attr(
				'class',
				classEnetering
			);

			visibleContent.attr(
				'class',
				classLeaving
			).one(
				'webkitAnimationEnd oanimationend msAnimationEnd animationend',
				function () {
					visibleContent.removeClass( 'qodef-leave-right qodef-leave-left' );
					selectedContent.removeClass( 'qodef-enter-left qodef-enter-right' );
				}
			);

			timelineEventContent.css(
				'height',
				selectedContentHeight + 'px'
			);
		},
		updateOlderEvents: function ( event ) {
			event.parent( 'li' ).prevAll( 'li' ).children( 'a' ).addClass( 'qodef-older-event' ).end().end().nextAll( 'li' ).children( 'a' ).removeClass( 'qodef-older-event' );
		},

		getTranslateValue: function ( timeline ) {
			var timelineStyle     = window.getComputedStyle(
				timeline.get( 0 ),
				null
				),
				timelineTranslate = timelineStyle.getPropertyValue( '-webkit-transform' ) || timelineStyle.getPropertyValue( '-moz-transform' ) || timelineStyle.getPropertyValue( '-ms-transform' ) || timelineStyle.getPropertyValue( '-o-transform' ) || timelineStyle.getPropertyValue( 'transform' ),
				translateValue    = 0;

			if ( timelineTranslate.indexOf( '(' ) >= 0 ) {
				timelineTranslate = timelineTranslate.split( '(' )[1];
				timelineTranslate = timelineTranslate.split( ')' )[0];
				timelineTranslate = timelineTranslate.split( ',' );

				translateValue = timelineTranslate[4];
			}

			return Number( translateValue );
		},
		setTransformValue: function ( element, property, value ) {
			element.style['-webkit-transform'] = property + '(' + value + ')';
			element.style['-moz-transform']    = property + '(' + value + ')';
			element.style['-ms-transform']     = property + '(' + value + ')';
			element.style['-o-transform']      = property + '(' + value + ')';
			element.style['transform']         = property + '(' + value + ')';
		},
		//based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
		parseDate: function ( events ) {
			var dateArrays = [];

			events.each( function () {
				var singleDate  = $( this ),
					dateCompStr = new String( singleDate.data( 'date' ) ),
					dayComp     = ['2000', '0', '0'],
					timeComp    = ['0', '0'];

				if ( dateCompStr.length === 4 ) { //only year
					dayComp = [dateCompStr, '0', '0'];
				} else {
					var dateComp = dateCompStr.split( 'T' );

					dayComp = dateComp[0].split( '/' ); //only DD/MM/YEAR

					if ( dateComp.length > 1 ) { //both DD/MM/YEAR and time are provided
						dayComp  = dateComp[0].split( '/' );
						timeComp = dateComp[1].split( ':' );
					} else if ( dateComp[0].indexOf( ':' ) >= 0 ) { //only time is provide
						timeComp = dateComp[0].split( ':' );
					}
				}

				var newDate = new Date(
					dayComp[2],
					dayComp[0] - 1,
					dayComp[1],
					timeComp[0],
					timeComp[1]
				);

				dateArrays.push( newDate );
			} );

			return dateArrays;
		},
		daydiff: function ( first, second ) {
			return Math.round( (second - first) );
		},
		minLapse: function ( dates ) {
			//determine the minimum distance among events
			var dateDistances = [];

			for ( var i = 1; i < dates.length; i++ ) {
				var distance = qodefHorizontalTimeline.daydiff(
					dates[i - 1],
					dates[i]
				);
				dateDistances.push( distance );
			}

			return Math.min.apply(
				null,
				dateDistances
			);
		},
		/*
		 How to tell if a DOM element is visible in the current viewport?
		 http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
		 */
		elementInViewport: function ( el ) {
			var top    = el.offsetTop;
			var left   = el.offsetLeft;
			var width  = el.offsetWidth;
			var height = el.offsetHeight;

			while (el.offsetParent) {
				el = el.offsetParent;
				top += el.offsetTop;
				left += el.offsetLeft;
			}

			return (
				top < (window.pageYOffset + window.innerHeight) &&
				left < (window.pageXOffset + window.innerWidth) &&
				(top + height) > window.pageYOffset &&
				(left + width) > window.pageXOffset
			);
		},

		checkMQ: function () {
			//check if mobile or desktop device
			return window.getComputedStyle(
				document.querySelector( '.qodef-horizontal-timeline' ),
				'::before'
			).getPropertyValue( 'content' ).replace(
				/'/g,
				''
			).replace(
				/"/g,
				''
			);
		}
	};

	qodefCore.shortcodes.firstframe_core_horizontal_timeline.qodefHorizontalTimeline = qodefHorizontalTimeline;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_icon = {};

	$( document ).ready(
		function () {
			qodefIcon.init();
		}
	);

	var qodefIcon = {
		init: function () {
			this.icons = $( '.qodef-icon-holder' );

			if ( this.icons.length ) {
				this.icons.each(
					function () {
						qodefIcon.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefIcon.iconHoverColor( $currentItem );
			qodefIcon.iconHoverBgColor( $currentItem );
			qodefIcon.iconHoverBorderColor( $currentItem );
		},
		iconHoverColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-color' ) !== 'undefined' ) {
				var spanHolder    = $iconHolder.find( 'span' ).length ? $iconHolder.find( 'span' ) : $iconHolder;
				var originalColor = spanHolder.css( 'color' );
				var hoverColor    = $iconHolder.data( 'hover-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							hoverColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							originalColor
						);
					}
				);
			}
		},
		iconHoverBgColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $iconHolder.data( 'hover-background-color' );
				var originalBackgroundColor = $iconHolder.css( 'background-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							hoverBackgroundColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							originalBackgroundColor
						);
					}
				);
			}
		},
		iconHoverBorderColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $iconHolder.data( 'hover-border-color' );
				var originalBorderColor = $iconHolder.css( 'borderTopColor' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							hoverBorderColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							originalBorderColor
						);
					}
				);
			}
		},
		changeColor: function ( iconElement, cssProperty, color ) {
			iconElement.css(
				cssProperty,
				color
			);
		}
	};

	qodefCore.shortcodes.firstframe_core_icon.qodefIcon = qodefIcon;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_image_gallery                    = {};
	qodefCore.shortcodes.firstframe_core_image_gallery.qodefSwiper        = qodef.qodefSwiper;
	qodefCore.shortcodes.firstframe_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.firstframe_core_image_gallery.qodefMagnificPopup = qodef.qodefMagnificPopup;
	qodefCore.shortcodes.firstframe_core_image_gallery.qodefCustomCursor  = qodefCore.qodefCustomCursor;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_image_with_text                    = {};
	qodefCore.shortcodes.firstframe_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;
	qodefCore.shortcodes.firstframe_core_image_with_text.qodefAppear        = qodefCore.qodefAppear;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_item_showcase = {};

	$( document ).ready(
		function () {
			qodefItemShowcaseList.init();
		}
	);

	var qodefItemShowcaseList = {
		init: function () {
			this.holder = $( '.qodef-item-showcase' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefItemShowcaseList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					$currentItem.addClass( 'qodef--init' );
				}
			);
		},
	};

	qodefCore.shortcodes.firstframe_core_item_showcase.qodefItemShowcaseList = qodefItemShowcaseList;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_interactive_link_showcase = {};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_google_map = {};

	$( document ).ready(
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefGoogleMap.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			if ( typeof window.qodefGoogleMap !== 'undefined' ) {
				window.qodefGoogleMap.init( $currentItem.find( '.qodef-m-map' ) );
			}
		},
	};

	qodefCore.shortcodes.firstframe_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_progress_bar = {};

	$( document ).ready(
		function () {
			qodefProgressBar.init();
		}
	);

	/**
	 * Init progress bar shortcode functionality
	 */
	var qodefProgressBar = {
		init: function () {
			this.holder = $( '.qodef-progress-bar' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefProgressBar.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var layout = $currentItem.data( 'layout' );

			qodefCore.qodefIsInViewport.check(
				$currentItem,
				function () {
					$currentItem.addClass( 'qodef--init' );

					var $container = $currentItem.find( '.qodef-m-canvas' ),
						data       = qodefProgressBar.generateBarData( $currentItem, layout ),
						number     = $currentItem.data( 'number' ) / 100;

					switch (layout) {
						case 'circle':
							qodefProgressBar.initCircleBar( $container, data, number );
							break;
						case 'semi-circle':
							qodefProgressBar.initSemiCircleBar( $container, data, number );
							break;
						case 'line':
							data = qodefProgressBar.generateLineData( $currentItem, number );
							qodefProgressBar.initLineBar( $container, data );
							break;
						case 'custom':
							qodefProgressBar.initCustomBar( $container, data, number );
							break;
					}
				},
				false
			);
		},
		generateBarData: function ( thisBar, layout ) {
			var activeWidth   = thisBar.data( 'active-line-width' );
			var activeColor   = thisBar.data( 'active-line-color' );
			var inactiveWidth = thisBar.data( 'inactive-line-width' );
			var inactiveColor = thisBar.data( 'inactive-line-color' );
			var easing        = 'linear';
			var duration      = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor     = thisBar.data( 'text-color' );

			return {
				strokeWidth: activeWidth,
				color: activeColor,
				trailWidth: inactiveWidth,
				trailColor: inactiveColor,
				easing: easing,
				duration: duration,
				svgStyle: {
					width: '100%',
					height: '100%'
				},
				text: {
					style: {
						color: textColor
					},
					autoStyleContainer: false
				},
				from: {
					color: inactiveColor
				},
				to: {
					color: activeColor
				},
				step: function ( state, bar ) {
					if ( layout !== 'custom' ) {
						bar.setText( Math.round( bar.value() * 100 ) + '%' );
					}
				},
			};
		},
		generateLineData: function ( thisBar, number ) {
			var height         = thisBar.data( 'active-line-width' );
			var activeColor    = thisBar.data( 'active-line-color' );
			var inactiveHeight = thisBar.data( 'inactive-line-width' );
			var inactiveColor  = thisBar.data( 'inactive-line-color' );
			var duration       = typeof thisBar.data( 'duration' ) !== 'undefined' && thisBar.data( 'duration' ) !== '' ? parseInt( thisBar.data( 'duration' ), 10 ) : 1600;
			var textColor      = thisBar.data( 'text-color' );

			return {
				percentage: number * 100,
				duration: duration,
				fillBackgroundColor: activeColor,
				backgroundColor: inactiveColor,
				height: height,
				inactiveHeight: inactiveHeight,
				followText: thisBar.hasClass( 'qodef-percentage--floating' ),
				textColor: textColor,
			};
		},
		initCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Circle( $container[0], data );

				$bar.animate( number );
			}
		},
		initSemiCircleBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.SemiCircle( $container[0], data );

				$bar.animate( number );
			}
		},
		initCustomBar: function ( $container, data, number ) {
			if ( qodefProgressBar.checkBar( $container ) ) {
				var $bar = new ProgressBar.Path( $container[0], data );

				$bar.set( 0 );
				$bar.animate( number );
			}
		},
		initLineBar: function ( $container, data ) {
			$container.LineProgressbar( data );
		},
		checkBar: function ( $container ) {
			// check if svg is already in container, elementor fix
			return ! $container.find( 'svg' ).length;
		}
	};

	qodefCore.shortcodes.firstframe_core_progress_bar.qodefProgressBar = qodefProgressBar;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_stacked_images = {};

	$( document ).ready(
		function () {
			qodefStackedImages.init();
		}
	);

	var qodefStackedImages = {
		init: function () {
			var holder = $( '.qodef-stacked-images' );

			if ( holder.length ) {
				holder.each(
					function () {
						var images = $( this ).find('.qodef-m-image');

						if ( images.length ) {
							images.each(
								function ( i ) {
									var image = $( this );

									setTimeout(
										function () {
											image.addClass( 'qodef--appeared' );
										},
										500 * i
									);
								}
							);
						}
					}
				);
			}
		},
	};

	qodefCore.shortcodes.firstframe_core_stacked_images.qodefStackedImages = qodefStackedImages;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_stamp = {};

	$( document ).ready(
		function () {
			qodefInitStamp.init();
		}
	);

	/**
	 * Inti stamp shortcode on appear
	 */
	var qodefInitStamp = {
		init: function () {
			this.holder = $( '.qodef-stamp' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInitStamp.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var appearing_delay = typeof $currentItem.data( 'appearing-delay' ) !== 'undefined' ? parseInt( $currentItem.data( 'appearing-delay' ), 10 ) : 0;

			// Initialization
			qodefInitStamp.initStampText( $currentItem );
			qodefInitStamp.load( $currentItem, appearing_delay );

			if ( $currentItem.hasClass( 'qodef--repeating' ) ) {
				setInterval(
					function () {
						qodefInitStamp.reLoad( $currentItem );
					},
					5500
				);
			}
		},
		initStampText: function ( $currentItem ) {
			var $stamp = $currentItem.children( '.qodef-m-text' ),
				count  = typeof $currentItem.data( 'appearing-delay' ) !== 'undefined' ? parseInt( $stamp.data( 'count' ), 10 ) : 1;

			$stamp.children().each(
				function ( i ) {
					var transform       = -90 + i * 360 / count,
						transitionDelay = i * 60 / count * 10;

					$( this ).css(
						{
							'transform': 'rotate(' + transform + 'deg) translateZ(0)',
							'transition-delay': transitionDelay + 'ms',
						}
					);
				}
			);
		},
		load: function ( $holder, appearing_delay ) {
			if ( $holder.hasClass( 'qodef--nested' ) ) {
				setTimeout(
					function () {
						qodefInitStamp.appear( $holder );
					},
					appearing_delay
				);
			} else {
				qodefCore.qodefIsInViewport.check(
					$holder,
					function () {
						setTimeout(
							function () {
								qodefInitStamp.appear( $holder );
							},
							appearing_delay
						);
					}
				);
			}
		},
		reLoad: function ( $holder ) {
			$holder.removeClass( 'qodef--init' );

			setTimeout(
				function () {
					$holder.removeClass( 'qodef--appear' );

					setTimeout(
						function () {
							qodefInitStamp.appear( $holder );
						},
						500
					);
				},
				600
			);
		},
		appear: function ( $holder ) {
			$holder.addClass( 'qodef--appear' );

			setTimeout(
				function () {
					$holder.addClass( 'qodef--init' );
				},
				300
			);
		}
	};

	qodefCore.shortcodes.firstframe_core_stamp.qodefInitStamp = qodefInitStamp;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_swapping_image_gallery = {};

	$( document ).ready(
		function () {
			qodefSwappingImageGallery.init();
		}
	);

	var qodefSwappingImageGallery = {
		init: function () {
			this.holder = $( '.qodef-swapping-image-gallery' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefSwappingImageGallery.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $swiperHolder     = $currentItem.find( '.qodef-m-image-holder' );
			var $paginationHolder = $currentItem.find( '.qodef-m-thumbnails-holder .qodef-grid-inner' );
			var spaceBetween      = 0;
			var slidesPerView     = 1;
			var centeredSlides    = false;
			var loop              = false;
			var autoplay          = false;
			var speed             = 800;

			var $swiper = new Swiper(
				$swiperHolder,
				{
					slidesPerView: slidesPerView,
					centeredSlides: centeredSlides,
					spaceBetween: spaceBetween,
					autoplay: autoplay,
					loop: loop,
					speed: speed,
					pagination: {
						el: $paginationHolder,
						type: 'custom',
						clickable: true,
						bulletClass: 'qodef-m-thumbnail',
					},
					on: {
						init: function () {
							$swiperHolder.addClass( 'qodef-swiper--initialized' );
							$paginationHolder.find( '.qodef-m-thumbnail' ).eq( 0 ).addClass( 'qodef--active' );
						},
						slideChange: function slideChange() {
							var swiper      = this;
							var activeIndex = swiper.activeIndex;
							$paginationHolder.find( '.qodef--active' ).removeClass( 'qodef--active' );
							$paginationHolder.find( '.qodef-m-thumbnail' ).eq( activeIndex ).addClass( 'qodef--active' );
						}
					},
				}
			);
		},
	};

	qodefCore.shortcodes.firstframe_core_swapping_image_gallery.qodefSwappingImageGallery = qodefSwappingImageGallery;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_tabs = {};

	$( document ).ready(
		function () {
			qodefTabs.init();
		}
	);

	var qodefTabs = {
		init: function () {
			this.holder = $( '.qodef-tabs' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabs.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			$currentItem.children( '.qodef-tabs-content' ).each(
				function ( index ) {
					index = index + 1;

					var $that    = $( this ),
						link     = $that.attr( 'id' ),
						$navItem = $that.parent().find( '.qodef-tabs-navigation li:nth-child(' + index + ') a' ),
						navLink  = $navItem.attr( 'href' );

					link = '#' + link;

					if ( link.indexOf( navLink ) > -1 ) {
						$navItem.attr(
							'href',
							link
						);
					}
				}
			);

			$currentItem.addClass( 'qodef--init' ).tabs();
		},
		setHeight ( $holder ) {
			var $navigation      = $holder.find( '.qodef-tabs-navigation' ),
				$content         = $holder.find( '.qodef-tabs-content' ),
				navHeight,
				contentHeight,
				maxContentHeight = 0;

			if ( $navigation.length ) {
				navHeight = $navigation.outerHeight( true );
			}

			if ( $content.length ) {
				$content.each(
					function () {
						contentHeight = $( this ).outerHeight( true );
						maxContentHeight = contentHeight > maxContentHeight ? contentHeight : maxContentHeight;
					}
				)
			}

			$holder.height(navHeight + maxContentHeight);
		}
	};

	qodefCore.shortcodes.firstframe_core_tabs.qodefTabs = qodefTabs;

})( jQuery );

(function ($) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_text_marquee = {};

	$(document).ready(
		function () {
			qodefTextMarquee.init();
		}
	);

	$(window).resize(
		function () {
			qodefTextMarquee.init();
		}
	);

	var qodefTextMarquee = {
		init               : function () {
			this.holder = $('.qodef-text-marquee');

			if (this.holder.length) {
				this.holder.each(
					function () {
						qodefTextMarquee.prepareContent($(this));
						qodefTextMarquee.calculateWidthRatio($(this));
					}
				);
			}
		},
		prepareContent     : function ($currentItem) {
			var $contentInnerCopy = $currentItem.find('.qodef--copy');

			// remove holder init class
			$currentItem.removeClass('qodef--init');

			// remove duplicated content
			if ($contentInnerCopy.length) {
				$contentInnerCopy.remove();
			}
		},
		calculateWidthRatio: function ($currentItem) {
			var $content = $currentItem.find('.qodef-m-content'),
				$contentInner = $content.find('.qodef-m-content-inner'),
				multiplyCoef = Math.ceil($content.outerWidth() / $contentInner.outerWidth()),
				i;

			// duplicate content at least once
			for (i = 0; i < multiplyCoef; i++) {
				qodefTextMarquee.duplicateContent($content, $contentInner);
			}

			// add holder init class
			$currentItem.addClass('qodef--init');
		},
		duplicateContent   : function ($content, $contentInner) {
			$contentInner.clone().appendTo($content).addClass('qodef--copy');
		},
	};

	qodefCore.shortcodes.firstframe_core_text_marquee.qodefTextMarquee = qodefTextMarquee;

})(jQuery);

(function ($) {
	'use strict';

	qodefCore.shortcodes.firstframe_vertical_split_slider = {};

	$( document ).ready(
		function () {
			qodefVerticalSplitSlider.init();
		}
	);

	var qodefVerticalSplitSlider = {
		init              : function () {
			var $holder = $( '.qodef-vertical-split-slider' );

			if ($holder.length) {
				qodefVerticalSplitSlider.initItem( $holder );
			}
		},
		initItem          : function ($holder) {
			var $headerInner       = $( '#qodef-page-header-inner' ),
				breakpoint         = qodefVerticalSplitSlider.getBreakpoint( $holder ),
				initialHeaderStyle = '';

			if ($headerInner.hasClass( 'qodef-skin--light' )) {
				initialHeaderStyle = 'light';
			} else if ($headerInner.hasClass( 'qodef-skin--dark' )) {
				initialHeaderStyle = 'dark';
			}

			$holder.multiscroll(
				{
					navigation        : true,
					navigationPosition: 'right',
					easing: 'easeInOutCubic',
					scrollingSpeed: 800,
					afterRender       : function () {
						qodefCore.body.addClass( 'qodef-vertical-split-slider--init' );
						qodefVerticalSplitSlider.headerClassHandler( $( '.ms-left .ms-section:first-child' ).data( 'header-skin' ), initialHeaderStyle, $headerInner );
					},
					onLeave           : function (index, nextIndex) {
						qodefVerticalSplitSlider.headerClassHandler( $( $( '.ms-left .ms-section' )[nextIndex - 1] ).data( 'header-skin' ), initialHeaderStyle, $headerInner );
					},
				}
			);

			// $holder.height(qodefCore.windowHeight);
			qodefVerticalSplitSlider.buildAndDestroy( breakpoint );

			$( window ).resize(
				function () {
					qodefVerticalSplitSlider.buildAndDestroy( breakpoint );
				}
			);
		},
		getBreakpoint     : function ($holder) {
			if ($holder.hasClass( 'qodef-disable-below--768' )) {
				return 768;
			} else {
				return 1024;
			}
		},
		buildAndDestroy   : function (breakpoint) {
			if (qodefCore.windowWidth <= breakpoint) {
				$.fn.multiscroll.destroy();
				qodefCore.body.removeClass( 'qodef-vertical-split-slider--init' );
				// enable scroll on responsive layout
				qodefCore.body.css( {'overflow': 'initial'} );
				qodefCore.html.css( {'overflow': 'initial'} );
			} else {
				$.fn.multiscroll.build();
				qodefCore.body.addClass( 'qodef-vertical-split-slider--init' );
			}
		},
		headerClassHandler: function (slideHeaderStyle, initialHeaderStyle, $headerInner) {
			var $controls = $( '#multiscroll-nav' );

			if (slideHeaderStyle !== undefined && slideHeaderStyle !== '') {
				$headerInner.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );

				if ($controls.length) {
					$controls.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );
				}
			} else if (initialHeaderStyle !== '') {
				$headerInner.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );

				if ($controls.length) {
					$controls.removeClass( 'qodef-skin--light qodef-skin--dark' ).addClass( 'qodef-skin--' + slideHeaderStyle );
				}
			} else {
				$headerInner.removeClass( 'qodef-skin--light qodef-skin--dark' );

				if ($controls.length) {
					$controls.removeClass( 'qodef-skin--light qodef-skin--dark' );
				}
			}
		}
	};

	qodefCore.shortcodes.firstframe_vertical_split_slider.qodefVerticalSplitSlider = qodefVerticalSplitSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_workflow = {};

	$( document ).ready( function () {
		qodefWorkFlow.init();
	} );

	//adjustments on resize
	$( window ).resize( function () {
		var holder = $( '.qodef-workflow' );

		if ( holder.length ) {
			holder.each( function () {
				var params = qodefWorkFlow.getParams( $( this ) );

				qodefWorkFlow.setWidths( params );
				qodefWorkFlow.resizeTranslateAdj( params );
			} );
		}
	} );

	var qodefWorkFlow = {
		getParams: function ( $holder ) {
			var params = {
				roadmap: '',
				visibleItems: 6,
				roadmapHolderWidth: 0,
				itemsWidth: 0,
				itemsHeight: 0,
				firstActive: '',
				lastActive: '',
				translateCurrent: 0,
				moving: false
			};

			params.roadmap = $holder;
			params.roadmapItemsHolder = params.roadmap.find( '.qodef-m-inner' );
			params.roadmapItems = params.roadmap.find( '.qodef-e' );
			params.roadmapInitalWidth = params.roadmap.width();

			return params;
		},
		init: function () {
			this.holder = $( '.qodef-workflow' );

			if ( this.holder.length ) {
				this.holder.each( function () {

					var params = qodefWorkFlow.getParams( $( this ) );

					//inital set of widths and items
					qodefWorkFlow.setWidths( params );

					// Desktop drag events
					var dragEvent = {
						down: 'mousedown',
						up: 'mouseup',
						target: 'target',
					};

					var isTouchDevice = qodef.html.hasClass( 'touchevents' );

					// Touch drag events
					if ( isTouchDevice ) {
						dragEvent = {
							down: 'touchstart',
							up: 'touchend',
							target: 'srcElement',
						};
					}

					// Check if user is scrolling on touch devices
					var touchScrolling = function ( oldEvent, newEvent ) {
						if ( isTouchDevice ) {
							var oldY = oldEvent.originalEvent.changedTouches[0].clientY,
								newY = newEvent.originalEvent.changedTouches[0].clientY;

							if ( Math.abs( newY - oldY ) > 100 ) { // 100 is drag sensitivity
								return true;
							}
							;
						}
						return false;
					};

					var getXPos = function ( e ) {
						return isTouchDevice ? e.originalEvent.changedTouches[0].clientX : e.clientX;
					};

					// Drag logic for content items
					var mouseDown = false;

					params.roadmap.on(
						dragEvent.down,
						function ( e ) {
							if ( ! mouseDown && ! $( e[dragEvent.target] ).is( 'a, span' ) ) {
								var oldEvent = e,
									xPos     = getXPos( e );
								mouseDown    = true;

								params.roadmap.one(
									dragEvent.up,
									function ( e ) {
										var xPosNew = getXPos( e );
										if ( Math.abs( xPos - xPosNew ) > 10 && ! touchScrolling(
											oldEvent,
											e
										) ) {
											if ( xPos > xPosNew ) {
												qodefWorkFlow.moveRoadmap(
													1,
													200,
													params
												); //init movement to to right
											} else {
												qodefWorkFlow.moveRoadmap(
													-1,
													200,
													params
												); //init movement to to right
											}
										}
										mouseDown = false;
									}
								);
							}
						}
					);
				} );

				qodefCore.qodefIsInViewport.check(
					this.holder,
					function () {
						var $thisItem = $( this );

						$thisItem.addClass( 'qodef--init' );

						$thisItem.find( '.qodef-e-circle-holder' ).each(
							function ( i ) {
								var fadeInTime = .2 + i / 3;

								$( this ).addClass( 'qodef--appeared' );

								$( this ).css( {
									'animation-delay': fadeInTime + 's'
								} );
							}
						);

						$thisItem.find( '.qodef-e-content' ).each(
							function ( i ) {
								var fadeInTime = .3 + i / 3;

								$( this ).addClass( 'qodef--appeared' );

								$( this ).find( '.qodef-e-date-range' ).css( {
									'animation-delay': fadeInTime + 's'
								} );

								$( this ).find( '.qodef-e-text' ).css( {
									'animation-delay': fadeInTime + .1 + 's'
								} );
							}
						);
					}
				);
			}
		},

		//set width for items and holder, also set classes and first and last active items
		setWidths: function ( params ) {
			params.roadmapInitalWidth = params.roadmap.width();

			if ( qodef.windowWidth > 1024 ) {
				params.visibleItems = 5;
			} else if ( qodef.windowWidth > 680 ) {
				params.visibleItems = 2;
			} else {
				params.visibleItems = 1;
			}

			params.itemsWidth = params.roadmapInitalWidth / params.visibleItems - 62;

			params.roadmapItems.each( function () {
				var thisItem = $( this ),
					thisItemHeight;

				thisItem.width( params.itemsWidth );
				params.roadmapHolderWidth += params.itemsWidth;

				//needs to be here in order to calculate height right because of the width
				thisItemHeight = thisItem.find( '.qodef-e-content' ).outerHeight();

				if ( params.itemsHeight < thisItemHeight ) {
					params.itemsHeight = thisItemHeight;
				}
			} );

			params.roadmapItemsHolder.width( params.roadmapHolderWidth );
			//params.roadmap.css( { 'paddingBottom': params.itemsHeight + 20 } );

			//if first active set change them accordingly
			if ( params.firstActive !== '' ) {
				params.roadmapItems.removeClass( 'qodef--active' );
				params.firstActive.addClass( 'qodef--active' );
				for ( var i = 0; i < params.visibleItems - 1; i++ ) {
					params.firstActive.nextAll().eq( i ).addClass( 'qodef--active' );
				}
				params.lastActive = params.roadmapItems.filter( '.qodef--active' ).last();
			} else {
				params.roadmapItems.eq( params.visibleItems ).prevAll().addClass( 'qodef--active' );
				params.firstActive = params.roadmapItems.filter( '.qodef--active' ).first();
				params.lastActive  = params.roadmapItems.filter( '.qodef--active' ).last();
			}
		},

		//movement for provided step (> 0 to the right, < 0 to the left)
		moveRoadmap: function ( step, timeout, params ) {
			var nextItem;
			//prevent multiple clicks while animating with moving  var
			if ( ! params.moving ) {
				//grab item to be moved to
				if ( step >= 1 ) {
					nextItem = params.lastActive.nextAll().eq( step - 1 );
				} else {
					nextItem = params.firstActive.prevAll().eq( Math.abs( step ) - 1 );
				}

				if ( nextItem.length ) {
					params.moving = true;

					//adjust classes according to currently moved to item
					params.roadmapItems.removeClass( 'qodef--active' );
					nextItem.addClass( 'qodef--active' );

					var $i = 0;
					if ( step >= 1 ) {
						for ( $i; $i < params.visibleItems - 1; $i++ ) {
							nextItem.prevAll().eq( $i ).addClass( 'qodef--active' );
						}
					} else {
						for ( $i; $i < params.visibleItems - 1; $i++ ) {
							nextItem.nextAll().eq( $i ).addClass( 'qodef--active' );
						}
					}

					//set new first and last active items
					params.firstActive = params.roadmapItems.filter( '.qodef--active' ).first();
					params.lastActive  = params.roadmapItems.filter( '.qodef--active' ).last();

					//move holder and set var moving to false
					params.translateCurrent -= step * params.itemsWidth;
					params.roadmapItemsHolder.css( { 'transform': 'translateX(' + params.translateCurrent + 'px)' } );

					setTimeout(
						function () {
							params.moving = false;
						},
						timeout
					);
				}
			}
		},

		//move holder to provided item
		moveTo: function ( item, params ) {
			var firstActiveIndex = params.firstActive.index(),
				lastActiveIndex  = params.lastActive.index(),
				goToIndex        = item.index(),
				moveStep         = 0,
				middle;

			middle = (firstActiveIndex + lastActiveIndex) / 2;

			//if first or second item, go to third item
			//else if last or one before, go to third form the back
			//else go to the desired
			if ( goToIndex < Math.floor( params.visibleItems / 2 ) ) {
				moveStep = firstActiveIndex - 2;
			} else if ( goToIndex > params.roadmapItems.length - 1 - Math.floor( params.visibleItems / 2 ) ) {
				moveStep = params.roadmapItems.length - 1 - lastActiveIndex;
			} else {
				moveStep = goToIndex - middle;
			}

			qodefWorkFlow.moveRoadmap(
				moveStep,
				0,
				params
			);
		},

		//adjust translate so it wouldn't be stopped in the middle of items
		resizeTranslateAdj: function ( params ) {
			var adjustment = params.firstActive.index() * params.itemsWidth;

			params.translateCurrent = -adjustment;
			params.roadmapItemsHolder.css( { 'transform': 'translateX(' + params.translateCurrent + 'px)' } );
		}
	};

	qodefCore.shortcodes.firstframe_core_workflow.qodefWorkFlow = qodefWorkFlow;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_video_button                    = {};
	qodefCore.shortcodes.firstframe_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefStickySidebar.init();
		}
	);

	var qodefStickySidebar = {
		init: function () {
			var info = $( '.widget_firstframe_core_sticky_sidebar' );

			if ( info.length && qodefCore.windowWidth > 1024 ) {
				info.wrapper = info.parents( '#qodef-page-sidebar' );
				info.offsetM = info.offset().top - info.wrapper.offset().top;
				info.adj     = 15;

				qodefStickySidebar.callStack( info );

				$( window ).on(
					'resize',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.callStack( info );
						}
					}
				);

				$( window ).on(
					'scroll',
					function () {
						if ( qodefCore.windowWidth > 1024 ) {
							qodefStickySidebar.infoPosition( info );
						}
					}
				);
			}
		},
		calc: function ( info ) {
			var content = $( '.qodef-page-content-section' ),
				headerH = qodefCore.body.hasClass( 'qodef-header-appearance--none' ) ? 0 : parseInt( qodefGlobal.vars.headerHeight, 10 );

			// If posts not found set content to have the same height as the sidebar
			if ( qodefCore.windowWidth > 1024 && content.height() < 100 ) {
				content.css( 'height', info.wrapper.height() - content.height() );
			}

			info.start = content.offset().top;
			info.end   = content.outerHeight();
			info.h     = info.wrapper.height();
			info.w     = info.outerWidth();
			info.left  = info.offset().left;
			info.top   = headerH + qodefGlobal.vars.adminBarHeight - info.offsetM;
			info.data( 'state', 'top' );
		},
		infoPosition: function ( info ) {
			if ( qodefCore.scroll < info.start - info.top && qodefCore.scroll + info.h && info.data( 'state' ) !== 'top' ) {
				gsap.to(
					info.wrapper,
					.1,
					{
						y: 5,
					}
				);
				gsap.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
				info.data( 'state', 'top' );
				info.wrapper.css(
					{
						'position': 'static',
					}
				);
			} else if ( qodefCore.scroll >= info.start - info.top && qodefCore.scroll + info.h + info.adj <= info.start + info.end &&
				info.data( 'state' ) !== 'fixed' ) {
				var c = info.data( 'state' ) === 'top' ? 1 : -1;
				info.data( 'state', 'fixed' );
				info.wrapper.css(
					{
						'position': 'fixed',
						'top': info.top,
						'left': info.left,
						'width': info.w,
					}
				);
				gsap.fromTo(
					info.wrapper,
					.2,
					{
						y: 0
					},
					{
						y: c * 10,
						ease: Power4.easeInOut
					}
				);
				gsap.to(
					info.wrapper,
					.2,
					{
						y: 0,
						delay: .2,
					}
				);
			} else if ( qodefCore.scroll + info.h + info.adj > info.start + info.end && info.data( 'state' ) !== 'bottom' ) {
				info.data( 'state', 'bottom' );
				info.wrapper.css(
					{
						'position': 'absolute',
						'top': info.end - info.h - info.adj,
						'left': 'auto',
						'width': info.w,
					}
				);
				gsap.fromTo(
					info.wrapper,
					.1,
					{
						y: 0
					},
					{
						y: -5,
					}
				);
				gsap.to(
					info.wrapper,
					.3,
					{
						y: 0,
						delay: .1,
					}
				);
			}
		},
		callStack: function ( info ) {
			this.calc( info );
			this.infoPosition( info );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'firstframe_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;

})( jQuery );

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {
			if ( qodefCore.windowWidth > 1024 ) {
				if ( qodefCore.scroll <= 0 ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'margin-top', '0' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight ) + 'px' );
					$header.css( 'margin-top', parseInt( qodefGlobal.vars.topAreaHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefVerticalNavMenu.init();
		}
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalNavMenu = {
		initNavigation: function ( $verticalMenuObject ) {
			var $verticalNavObject = $verticalMenuObject.find( '.qodef-header-vertical-navigation' );

			if ( $verticalNavObject.hasClass( 'qodef-vertical-drop-down--below' ) ) {
				qodefVerticalNavMenu.dropdownClickToggle( $verticalNavObject );
			} else if ( $verticalNavObject.hasClass( 'qodef-vertical-drop-down--side' ) ) {
				qodefVerticalNavMenu.dropdownFloat( $verticalNavObject );
			}
		},
		dropdownClickToggle: function ( $verticalNavObject ) {
			var $menuItems = $verticalNavObject.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second, > ul' );
					var menuItem         = this;
					var $dropdownOpener  = $( this ).find( '> a' );
					var slideUpSpeed     = 'fast';
					var slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$( menuItem ).removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$( this ).parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $( this ).parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$( this ).parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
		dropdownFloat: function ( $verticalNavObject ) {
			var $menuItems = $verticalNavObject.find( 'ul li.menu-item-has-children' );
			var $allDropdowns = $menuItems.find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );
					var menuItem         = this;

					if ( Modernizr.touch ) {
						var $dropdownOpener = $( this ).find( '> a' );

						$dropdownOpener.on(
							'click tap',
							function ( e ) {
								e.preventDefault();
								e.stopPropagation();

								if ( $elementToExpand.hasClass( 'qodef-float--open' ) ) {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								} else {
									if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
										$menuItems.removeClass( 'qodef-menu-item--open' );
										$allDropdowns.removeClass( 'qodef-float--open' );
									}

									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								}
							}
						);
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$( this ).hoverIntent(
							{
								over: function () {
									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								},
								out: function () {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								},
								timeout: 300
							}
						);
					}
				}
			);
		},
		verticalAreaScrollable: function ( $verticalMenuObject ) {
			return $verticalMenuObject.hasClass( 'qodef-with-scroll' );
		},
		initVerticalAreaScroll: function ( $verticalMenuObject ) {
			if ( qodefVerticalNavMenu.verticalAreaScrollable( $verticalMenuObject ) && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $verticalMenuObject );
			}
		},
		init: function () {
			var $verticalMenuObject = $( '.qodef-header--vertical #qodef-page-header' );

			if ( $verticalMenuObject.length ) {
				qodefVerticalNavMenu.initNavigation( $verticalMenuObject );
				qodefVerticalNavMenu.initVerticalAreaScroll( $verticalMenuObject );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefVerticalSlidingNavMenu.init();
        }
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalSlidingNavMenu = {
		openedScroll: 0,

		initNavigation: function ( $verticalSlidingMenuObject ) {
			var $verticalSlidingNavObject = $verticalSlidingMenuObject.find( '.qodef-header-vertical-sliding-navigation' );

			if ( $verticalSlidingNavObject.hasClass( 'qodef-vertical-sliding-drop-down--below' ) ) {
				qodefVerticalSlidingNavMenu.dropdownClickToggle( $verticalSlidingNavObject );
			} else if ( $verticalSlidingNavObject.hasClass( 'qodef-vertical-sliding-drop-down--side' ) ) {
				qodefVerticalSlidingNavMenu.dropdownFloat( $verticalSlidingNavObject );
			}
		},
		dropdownClickToggle: function ( $verticalSlidingNavObject ) {
			var $menuItems = $verticalSlidingNavObject.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second, > ul' );
					var menuItem         = this;
					var $dropdownOpener  = $( this ).find( '> a' );
					var slideUpSpeed     = 'fast';
					var slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$( menuItem ).removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$( this ).parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $( this ).parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$( this ).parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$( this ).parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$( menuItem ).addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
		dropdownFloat: function ( $verticalSlidingNavObject ) {
			var $menuItems = $verticalSlidingNavObject.find( 'ul li.menu-item-has-children' );
			var $allDropdowns = $menuItems.find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );

			$menuItems.each(
				function () {
					var $elementToExpand = $( this ).find( ' > .qodef-drop-down-second > .qodef-drop-down-second-inner > ul, > ul' );
					var menuItem         = this;

					if ( Modernizr.touch ) {
						var $dropdownOpener = $( this ).find( '> a' );

						$dropdownOpener.on(
							'click tap',
							function ( e ) {
								e.preventDefault();
								e.stopPropagation();

								if ( $elementToExpand.hasClass( 'qodef-float--open' ) ) {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								} else {
									if ( ! $( this ).parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
										$menuItems.removeClass( 'qodef-menu-item--open' );
										$allDropdowns.removeClass( 'qodef-float--open' );
									}

									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								}
							}
						);
					} else {
						//must use hoverIntent because basic hover effect doesn't catch dropdown
						//it doesn't start from menu item's edge
						$( this ).hoverIntent(
							{
								over: function () {
									$elementToExpand.addClass( 'qodef-float--open' );
									$( menuItem ).addClass( 'qodef-menu-item--open' );
								},
								out: function () {
									$elementToExpand.removeClass( 'qodef-float--open' );
									$( menuItem ).removeClass( 'qodef-menu-item--open' );
								},
								timeout: 300
							}
						);
					}
				}
			);
		},
		verticalSlidingAreaScrollable: function ( $verticalSlidingMenuObject ) {
			return $verticalSlidingMenuObject.hasClass( 'qodef-with-scroll' );
		},
		initVerticalSlidingAreaScroll: function ( $verticalSlidingMenuObject ) {
			if ( qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable( $verticalSlidingMenuObject ) && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $verticalSlidingMenuObject );
			}
		},
		verticalSlidingAreaShowHide: function ( $verticalSlidingMenuObject ) {
			var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find( '.qodef-vertical-sliding-menu-opener' );

			$verticalSlidingMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();

					var $thisOpener = $( this );

					if ( ! $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' ) ) {
						$thisOpener.addClass( 'qodef--opened' );
						$verticalSlidingMenuObject.addClass( 'qodef-vertical-sliding-menu--opened' );
						qodefVerticalSlidingNavMenu.openedScroll = qodef.window.scrollTop();
					} else {
						$thisOpener.removeClass( 'qodef--opened' );
						$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
					}
				}
			);
		},
		verticalSlidingAreaCloseOnScroll: function ( $verticalSlidingMenuObject ) {
			qodef.window.on(
				'scroll',
				function () {
					if ( $verticalSlidingMenuObject.hasClass( 'qodef-vertical-sliding-menu--opened' ) && Math.abs( qodef.scroll - qodefVerticalSlidingNavMenu.openedScroll ) > 400 ) {
						$verticalSlidingMenuObject.find( '.qodef-vertical-sliding-menu-opener' ).removeClass( 'qodef--opened' );
						$verticalSlidingMenuObject.removeClass( 'qodef-vertical-sliding-menu--opened' );
					}
				}
			);
		},
		init: function () {
			var $verticalSlidingMenuObject = $( '.qodef-header--vertical-sliding #qodef-page-header' );

			if ( $verticalSlidingMenuObject.length ) {
				qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.verticalSlidingAreaCloseOnScroll( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.initNavigation( $verticalSlidingMenuObject );
				qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll( $verticalSlidingMenuObject );
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSideAreaMobileHeader.init();
		}
	);

	var qodefSideAreaMobileHeader = {
		init: function () {
			var $holder = $( '#qodef-side-area-mobile-header' );

			if ( $holder.length && qodefCore.body.hasClass( 'qodef-mobile-header--side-area' ) ) {
				var $navigation = $holder.find( '.qodef-m-navigation' );

				qodefSideAreaMobileHeader.initOpenerTrigger( $holder, $navigation );
				qodefSideAreaMobileHeader.initNavigationClickToggle( $navigation );

				if ( typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
					qodefCore.qodefPerfectScrollbar.init( $holder );
				}
			}
		},
		initOpenerTrigger: function ( $holder, $navigation ) {
			var $openerIcon = $( '.qodef-side-area-mobile-header-opener' ),
				$closeIcon  = $holder.children( '.qodef-m-close' );

			if ( $openerIcon.length && $navigation.length ) {
				$openerIcon.on(
					'tap click',
					function ( e ) {
						e.stopPropagation();
						e.preventDefault();

						if ( $holder.hasClass( 'qodef--opened' ) ) {
							$holder.removeClass( 'qodef--opened' );
						} else {
							$holder.addClass( 'qodef--opened' );
						}
					}
				);
			}

			$closeIcon.on(
				'tap click',
				function ( e ) {
					e.stopPropagation();
					e.preventDefault();

					if ( $holder.hasClass( 'qodef--opened' ) ) {
						$holder.removeClass( 'qodef--opened' );
					}
				}
			);
		},
		initNavigationClickToggle: function ( $navigation ) {
			var $menuItems = $navigation.find( 'ul li.menu-item-has-children' );

			$menuItems.each(
				function () {
					var $thisItem        = $( this ),
						$elementToExpand = $thisItem.find( ' > .qodef-drop-down-second, > ul' ),
						$dropdownOpener  = $thisItem.find( '> .qodef-menu-item-arrow' ),
						slideUpSpeed     = 'fast',
						slideDownSpeed   = 'slow';

					$dropdownOpener.on(
						'click tap',
						function ( e ) {
							e.preventDefault();
							e.stopPropagation();

							if ( $elementToExpand.is( ':visible' ) ) {
								$thisItem.removeClass( 'qodef-menu-item--open' );
								$elementToExpand.slideUp( slideUpSpeed );
							} else if ( $dropdownOpener.parent().parent().children().hasClass( 'qodef-menu-item--open' ) && $dropdownOpener.parent().parent().parent().hasClass( 'qodef-vertical-menu' ) ) {
								$thisItem.parent().parent().children().removeClass( 'qodef-menu-item--open' );
								$thisItem.parent().parent().children().find( ' > .qodef-drop-down-second' ).slideUp( slideUpSpeed );

								$thisItem.addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							} else {

								if ( ! $thisItem.parents( 'li' ).hasClass( 'qodef-menu-item--open' ) ) {
									$menuItems.removeClass( 'qodef-menu-item--open' );
									$menuItems.find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								if ( $thisItem.parent().parent().children().hasClass( 'qodef-menu-item--open' ) ) {
									$thisItem.parent().parent().children().removeClass( 'qodef-menu-item--open' );
									$thisItem.parent().parent().children().find( ' > .qodef-drop-down-second, > ul' ).slideUp( slideUpSpeed );
								}

								$thisItem.addClass( 'qodef-menu-item--open' );
								$elementToExpand.slideDown( slideDownSpeed );
							}
						}
					);
				}
			);
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchCoversHeader.init();
		}
	);

	var qodefSearchCoversHeader = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchForm   = $( '.qodef-search-cover-form' ),
				$searchClose  = $searchForm.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchForm.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.openCoversHeader( $searchForm );
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchCoversHeader.closeCoversHeader( $searchForm );
					}
				);
			}
		},
		openCoversHeader: function ( $searchForm ) {
			qodefCore.body.addClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).focus();
				},
				600
			);
		},
		closeCoversHeader: function ( $searchForm ) {
			qodefCore.body.removeClass( 'qodef-covers-search--opened qodef-covers-search--fadein' );
			qodefCore.body.addClass( 'qodef-covers-search--fadeout' );

			setTimeout(
				function () {
					$searchForm.find( '.qodef-m-form-field' ).val( '' );
					$searchForm.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-covers-search--fadeout' );
				},
				300
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearchFullscreen.init();
		}
	);

	var qodefSearchFullscreen = {
		init: function () {
			var $searchOpener = $( 'a.qodef-search-opener' ),
				$searchHolder = $( '.qodef-fullscreen-search-holder' ),
				$searchClose  = $searchHolder.find( '.qodef-m-close' );

			if ( $searchOpener.length && $searchHolder.length ) {
				$searchOpener.on(
					'click',
					function ( e ) {
						e.preventDefault();
						if ( qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) {
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						} else {
							qodefSearchFullscreen.openFullscreen( $searchHolder );
						}
					}
				);
				$searchClose.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefSearchFullscreen.closeFullscreen( $searchHolder );
					}
				);

				//Close on escape
				$( document ).keyup(
					function ( e ) {
						if ( e.keyCode === 27 && qodefCore.body.hasClass( 'qodef-fullscreen-search--opened' ) ) { //KeyCode for ESC button is 27
							qodefSearchFullscreen.closeFullscreen( $searchHolder );
						}
					}
				);
			}
		},
		openFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).focus();
				},
				900
			);

			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $searchHolder ) {
			qodefCore.body.removeClass( 'qodef-fullscreen-search--opened qodef-fullscreen-search--fadein' );
			qodefCore.body.addClass( 'qodef-fullscreen-search--fadeout' );

			setTimeout(
				function () {
					$searchHolder.find( '.qodef-m-form-field' ).val( '' );
					$searchHolder.find( '.qodef-m-form-field' ).blur();
					qodefCore.body.removeClass( 'qodef-fullscreen-search--fadeout' );
				},
				300
			);

			qodefCore.qodefScroll.enable();
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSearch.init();
		}
	);

	var qodefSearch = {
		init: function () {
			this.search = $( 'a.qodef-search-opener' );

			if ( this.search.length ) {
				this.search.each(
					function () {
						var $thisSearch = $( this );

						qodefSearch.searchHoverColor( $thisSearch );
					}
				);
			}
		},
		searchHoverColor: function ( $searchHolder ) {
			if ( typeof $searchHolder.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $searchHolder.data( 'hover-color' ),
					originalColor = $searchHolder.css( 'color' );

				$searchHolder.on(
					'mouseenter',
					function () {
						$searchHolder.css( 'color', hoverColor );
					}
				).on(
					'mouseleave',
					function () {
						$searchHolder.css( 'color', originalColor );
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( window ).load(
		function () {
			qodefPredefinedSpinner.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			const isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefPredefinedSpinner.init( isEditMode );
			}
		}
	);

	const qodefPredefinedSpinner = {
		init( isEditMode ) {
			const $holder = $( '#qodef-page-spinner.qodef-layout--predefined' );

			if ( $holder.length ) {
				if ( isEditMode ) {
				} else {
					qodefPredefinedSpinner.animateSpinner( $holder );
				}
			}
		},
		animateSpinner( $holder ) {
			var $svg                = $holder.find( 'svg' ),
				$stamp              = $holder.find( '.qodef-m-spinner-stamp' ),
				tlOutStarted        = false,

				$spinnerPlaceholder = $( '#qode-preloader-placeholder' ),
				placeholderSpinnerStyles,
				placeholderSpinnerWidth,
				placeholderSpinnerLeft,
				placeholderSpinnerTop,
				spinnerStyles,
				spinnerWidth,
				endScale               = 1;

			var tl = gsap.timeline(
				{
					paused: true,
				}
			);

			tl
			.to(
				$holder,
				{
					duration: 1,
					repeat: -1,
					onStart: () =>{
						window.scrollTo(0, 0);
					},
					onRepeat: () => {
						if ( qodefCore.qodefSpinner.windowLoaded && !tlOutStarted){
							tlOut.play();
							tlOutStarted = true;
						}
					},
				},
				'<'
			);

			tl.play();

			var tlOut = gsap.timeline(
				{
					paused: true,
				}
			);

			tlOut
			.to(
				$holder,
				{
					duration: .3,
				},
			)
			.to(
				$holder,
				{
					duration: 1,
					onStart: () => {
						window.scrollTo(0, 0);
						$holder.addClass( 'qodef--finished' );
						tl.pause();
					},
				},
			);

			if ( $spinnerPlaceholder.length ) {
				qodefCore.body.addClass( 'qode-force-fh' );
				$holder.addClass( 'qode-has-spinner-placeholder' );

				function calculateLogoPosition() {
					spinnerStyles = $stamp[0].getBoundingClientRect();
					spinnerWidth  = spinnerStyles.width;

					placeholderSpinnerStyles = $spinnerPlaceholder[0].getBoundingClientRect();
					placeholderSpinnerWidth  = placeholderSpinnerStyles.width;
					placeholderSpinnerLeft   = placeholderSpinnerStyles.left;
					placeholderSpinnerTop    = placeholderSpinnerStyles.top + qodefCore.scroll;

					endScale = placeholderSpinnerWidth /  spinnerWidth;
				}

				calculateLogoPosition();

				var tlOutCustom = gsap.timeline(
					{
						paused: true,
					}
				);

				tlOutCustom.to(
					$stamp,
					{
						scale: endScale,
						left: ()=> {
							return placeholderSpinnerLeft - qodefCore.windowWidth / 2
						},
						top: ()=> {
							return placeholderSpinnerTop - qodefCore.windowHeight / 2
						},
						x: placeholderSpinnerWidth / 2,
						y: placeholderSpinnerWidth / 2,
						duration: .7,
					},
				);

				tlOut.add(tlOutCustom.play(), '0')

				$( window ).resize( function () {
					calculateLogoPosition();
					tlOutCustom.play();
				} );
			}
		},
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function() {
			qodefProgressBarSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefProgressBarSpinner.windowLoaded = true;
			qodefProgressBarSpinner.completeAnimation();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefProgressBarSpinner.init( isEditMode );
			}
		}
	);

	var qodefProgressBarSpinner = {
		holder: '',
		windowLoaded: false,
		percentNumber: 0,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			if ( this.holder.length ) {
				qodefProgressBarSpinner.animateSpinner( this.holder, isEditMode );
			}
		},
		animateSpinner: function ( $holder, isEditMode ) {
			var $numberHolder = $holder.find( '.qodef-m-spinner-number-label' ),
				$spinnerLine  = $holder.find( '.qodef-m-spinner-line-front' );

			$spinnerLine.animate(
				{ 'width': '100%' },
				10000,
				'linear'
			);

			var numberInterval = setInterval(
				function () {
					qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );

					if ( qodefProgressBarSpinner.windowLoaded ) {
						clearInterval( numberInterval );
					}
				},
				100
			);

			if ( isEditMode ) {
				qodefProgressBarSpinner.fadeOutLoader( $holder );
			}
		},
		completeAnimation: function () {
			var $holder = qodefProgressBarSpinner.holder.length ? qodefProgressBarSpinner.holder : $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			var numberIntervalFastest = setInterval(
				function () {

					if ( qodefProgressBarSpinner.percentNumber >= 100 ) {
						clearInterval( numberIntervalFastest );

						$holder.find( '.qodef-m-spinner-line-front' ).stop().animate(
							{ 'width': '100%' },
							500
						);

						$holder.addClass( 'qodef--finished' );

						setTimeout(
							function () {
								qodefProgressBarSpinner.fadeOutLoader( $holder );
							},
							600
						);
					} else {
						qodefProgressBarSpinner.animatePercent(
							$holder.find( '.qodef-m-spinner-number-label' ),
							qodefProgressBarSpinner.percentNumber
						);
					}
				},
				6
			);
		},
		animatePercent: function ( $numberHolder, percentNumber ) {
			if ( percentNumber < 100 ) {
				percentNumber += 5;
				$numberHolder.text( percentNumber );

				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed  = speed ? speed : 600;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefTextualSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefTextualSpinner.windowLoaded = true;
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefTextualSpinner.init( isEditMode );
			}
		}
	);

	var qodefTextualSpinner = {
		init ( isEditMode ) {
			var $holder = $( '#qodef-page-spinner.qodef-layout--textual' );

			if ( $holder.length ) {
				if ( isEditMode ) {
					qodefTextualSpinner.fadeOutLoader( $holder );
				} else {
					qodefTextualSpinner.splitText( $holder );
				}
			}
		},
		splitText ( $holder ) {
			var $textHolder = $holder.find( '.qodef-m-text' );

			if ( $textHolder.length ) {
				var text     = $textHolder.text().trim(),
					chars    = text.split( '' ),
					cssClass = '';

				$textHolder.empty();

				chars.forEach(
					( element ) => {
						cssClass = (element === ' ' ? 'qodef-m-empty-char' : ' ');
						$textHolder.append( '<span class="qodef-m-char ' + cssClass + '">' + element + '</span>' );
					}
				);

				setTimeout(
					() => {
						qodefTextualSpinner.animateSpinner( $holder );
					}, 100
				);
			}
		},
		animateSpinner ( $holder ) {
			$holder.addClass( 'qodef--init' );

			function animationLoop ( animationProps ) {
				var $chars      = $holder.find( '.qodef-m-char' ),
					charsLength = $chars.length - 1;

				if ( $chars.length ) {
					$chars.each(
						( index, element ) => {
							var $thisChar = $( element );

							setTimeout(
								() => {
									$thisChar.animate(
									    animationProps.type,
										animationProps.duration,
										animationProps.easing,
										() => {
											if ( index === charsLength ) {
												if ( 1 === animationProps.repeat ) {
													animationLoop(
													    {
                                                            type: { opacity: 0 },
                                                            duration: 1200,
                                                            easing: 'swing',
                                                            delay: 0,
                                                            repeat: 0,
                                                        }
													);
												} else {
													if ( ! qodefTextualSpinner.windowLoaded ) {
														animationLoop(
														    {
                                                                type: { opacity: 1 },
                                                                duration: 1800,
                                                                easing: 'swing',
                                                                delay: 160,
                                                                repeat: 1,
                                                            }
														);
													} else {
														qodefTextualSpinner.fadeOutLoader(
															$holder,
															600,
															0,
															'swing'
														);

														setTimeout(
															() => {
																var $revSlider = $( '.qodef-after-spinner-rev rs-module' );

																if ( $revSlider.length ) {
																	$revSlider.revstart();
																}
															}, 800
														);
													}
												}
											}
										}
									);
								}, index * animationProps.delay
							);
						}
					);
				}
			}

			animationLoop (
			    {
                    type: { opacity: 1 },
                    duration: 1800,
                    easing: 'swing',
                    delay: 160,
                    repeat: 1,
                }
			);
		},
		fadeOutLoader( $holder, speed, delay, easing ) {
			speed  = speed ? speed : 500;
			delay  = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			if ( $holder.length ) {
				$holder.delay( delay ).fadeOut( speed, easing );

				$( window ).on(
					'bind',
					'pageshow',
					function( event ) {

						if ( event.originalEvent.persisted ) {
							$holder.fadeOut( speed, easing );
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_instagram_list = {};

	$( document ).ready(
		function () {
			qodefInstagram.init();
		}
	);

	var qodefInstagram = {
		init: function () {
			this.holder = $( '.qodef-instagram-list #sb_instagram' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {

						if ( $( this ).parent().hasClass( 'qodef-instagram-columns' ) ) {
							var $imagesHolder  = $( this ).find( '#sbi_images' ),
								$images        = $imagesHolder.find( '.sbi_item.sbi_type_image, .sbi_item.sbi_type_carousel' ),
								initialPadding = $imagesHolder.css( 'padding' );

							// remove some unnecessary paddings
							$imagesHolder.css('padding', '0');
							$imagesHolder.css('margin', '-' + initialPadding);
							$imagesHolder.css('width', 'calc(100% + ' + ( initialPadding) + ' + ' + ( initialPadding) + ')');

							$images.attr('style', 'padding: ' + initialPadding + '!important');
						} else if ( $( this ).parent().hasClass( 'qodef-instagram-slider' ) ) {
							qodefInstagram.initSlider( $( this ) );
						}
					}
				);
			}
		},
		initSlider: function ( $currentItem, $initAllItems ) {

			var $imagesHolder  = $currentItem.find( '#sbi_images' ),
				$images        = $currentItem.find( '.sbi_item.sbi_type_image' ),
				initialPadding = $imagesHolder.css( 'padding' );

			// remove some unnecessary paddings
			$imagesHolder.css('padding', '0');
			$images.css('padding', '0');

			// items will inherit this margin
			$imagesHolder.attr('style', 'margin-right: ' + (parseInt( initialPadding ) * 2) + 'px !important');

			var sliderOptions = {};

			sliderOptions.spaceBetween      = parseInt( initialPadding ) * 2;
			sliderOptions.customStages      = true;
			sliderOptions.slidesPerView     = $currentItem.data( 'cols' ) !== undefined && $currentItem.data( 'cols' ) !== '' ? $currentItem.data( 'cols' ) : 3;
			sliderOptions.slidesPerView1024 = $currentItem.data( 'cols' ) !== undefined && $currentItem.data( 'cols' ) !== '' ? $currentItem.data( 'cols' ) : 3;
			sliderOptions.slidesPerView680  = $currentItem.data( 'colstablet' ) !== undefined && $currentItem.data( 'colstablet' ) !== '' ? $currentItem.data( 'colstablet' ) : 2;
			sliderOptions.slidesPerView480  = $currentItem.data( 'colsmobile' ) !== undefined && $currentItem.data( 'colsmobile' ) !== '' ? $currentItem.data( 'colsmobile' ) : 1;

			$currentItem.attr( 'data-options', JSON.stringify(sliderOptions) );

			$imagesHolder.addClass( 'swiper-wrapper' );

			if ( $images.length ) {
				$images.each(
					function () {
						$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
					}
				);
			}

			if ( typeof qodef.qodefSwiper === 'object' ) {

				if ( false === $initAllItems ) {
					qodef.qodefSwiper.initSlider( $currentItem );
				} else {
					qodef.qodefSwiper.init( $currentItem );
				}
			}
		},
	};

	qodefCore.shortcodes.firstframe_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.firstframe_core_instagram_list.qodefSwiper    = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_product_category_list                    = {};
	qodefCore.shortcodes.firstframe_core_product_category_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.firstframe_core_product_category_list.qodefSwiper        = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'firstframe_core_product_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefDropDownCart.init();
		}
	);

	var qodefDropDownCart = {
		init: function () {
			var $holder = $( '.qodef-widget-dropdown-cart-content' );

			if ( $holder.length ) {
				$holder.off().each(
					function () {
						var $thisHolder = $( this );

						qodefDropDownCart.trigger( $thisHolder );

						qodefCore.body.on(
							'added_to_cart removed_from_cart',
							function () {
								qodefDropDownCart.init();
							}
						);
					}
				);
			}
		},
		trigger: function ( $holder ) {
			var $items = $holder.find( '.qodef-woo-mini-cart' );
			if ( $items.length && typeof qodefCore.qodefPerfectScrollbar === 'object' ) {
				qodefCore.qodefPerfectScrollbar.init( $items );
			}
		},
	};

})( jQuery );

(function ($) {
    'use strict';

    $(window).load(
        function () {
            qodefSideAreaCart.init();
        }
    );

    var qodefSideAreaCart = {
        init: function () {
            var $holder = $('.qodef-widget-side-area-cart-inner');

            if ($holder.length) {
                $holder.off().each(
                    function () {
                        var $thisHolder = $(this);

                        if (qodefCore.windowWidth > 680) {
                            qodefSideAreaCart.trigger($thisHolder);
                            qodefSideAreaCart.start($thisHolder);

                            qodefCore.body.on(
                                'added_to_cart removed_from_cart wc_fragments_refreshed',
                                function () {
                                    qodefSideAreaCart.init();
                                }
                            );

                            qodefCore.body.on(
                                'added_to_cart removed_from_cart',
                                function () {
                                    qodefSideAreaCart.init();
                                }
                            );
                        }
                    }
                );
            }
        },
        trigger: function ($holder) {
            var $items = $holder.find('.qodef-woo-side-area-cart');
            if ($items.length && typeof qodefCore.qodefPerfectScrollbar === 'object') {
                qodefCore.qodefPerfectScrollbar.init($items);
            }
        },
        start: function ($holder) {

            $(document).on(
                'click',
                '.qodef-m-opener',
                function (e) {
                    e.preventDefault();

                    if (!$holder.hasClass('qodef--opened')) {
                        qodefSideAreaCart.openSideArea($holder);
                        qodefSideAreaCart.trigger($holder);

                        $(document).keyup(
                            function (e) {
                                if (e.keyCode === 27) {
                                    qodefSideAreaCart.closeSideArea($holder);
                                }
                            }
                        );
                    } else {
                        qodefSideAreaCart.closeSideArea($holder);
                    }
                }
            );

            $(document).on(
                'click',
                '.qodef-m-close',
                function (e) {
                    e.preventDefault();
                    qodefSideAreaCart.closeSideArea($holder);
                }
            );
        },
        openSideArea: function ($holder) {
            qodefCore.qodefScroll.disable();

            $holder.addClass('qodef--opened');
            $('#qodef-page-wrapper').prepend('<div class="qodef-woo-side-area-cart-cover"/>');

            $('.qodef-woo-side-area-cart-cover').on(
                'click',
                function (e) {
                    e.preventDefault();

                    qodefSideAreaCart.closeSideArea($holder);
                }
            );
        },
        closeSideArea: function ($holder) {
            if ($holder.hasClass('qodef--opened')) {
                qodefCore.qodefScroll.enable();

                $holder.removeClass('qodef--opened');
                $('.qodef-woo-side-area-cart-cover').remove();
            }
        }
    };

})(jQuery);

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_clients_list             = {};
	qodefCore.shortcodes.firstframe_core_clients_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'firstframe_core_events_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'firstframe_core_masonry_gallery_list';

	qodefCore.shortcodes[shortcode]                    = {};
	qodefCore.shortcodes[shortcode].qodefMasonryLayout = qodef.qodefMasonryLayout;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefPreviewVideo.init();
			qodefFullscreenSliderHeight.init();
		}
	);

	var qodefFullscreenSliderHeight = {
		init: function () {
			this.holder = $( '.qodef-portfolio-list.qodef--full-screen-slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefFullscreenSliderHeight.initFullscreenSlider( $( this ) );
					}
				);
			}
		},
		initFullscreenSlider: function () {
			var $header       = $( '#qodef-page-header' );
			if ( qodefCore.windowWidth <= 1024 ) {
				$header = $( '#qodef-page-mobile-header' );
			}
			var $headerHeight = $header.outerHeight();
			var $sliderHeight = '100vh - ' + $headerHeight + 'px';
			if ( this.holder.length && $header.length ) {
				$( '.qodef-portfolio-list.qodef--full-screen-slider' ).css( { 'height': 'calc(' + $sliderHeight + ')' } );
			}
		}
	};

	var qodefPreviewVideo = {
		init: function () {
			this.item = $( '.qodef-portfolio-list .portfolio-item' );

			if ( this.item.length ) {
				this.item.each(
					function () {
						qodefPreviewVideo.itemHover( $( this ) );
					}
				);
			}
		},

		itemHover: function ( $item ) {
			if ( qodefCore.windowWidth > 1024 ) {
				var video = $item.find( '.qodef-video--on-hover video' );

				$item.on(
					'mouseenter touchstart',
					function () {
						if ( video.length ) {
							var isPlaying = video.get( 0 ).currentTime > 0 && ! video.get( 0 ).paused && ! video.get( 0 ).ended && video.get( 0 ).readyState > 2;

							if ( ! isPlaying ) {
								video.get( 0 ).play();
							}
						}
					}
				);
				$item.on(
					'mouseleave touchend',
					function () {
						if ( video.length ) {
							setTimeout(
								function () {
									video.get( 0 ).pause();
									// video.get( 0 ).currentTime = 0;
								},
								200
							);
						}
					}
				);
			}
		},
	};

	var shortcode = 'firstframe_core_portfolio_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'firstframe_core_team_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.firstframe_core_testimonials_list = {};

	$( document ).ready(
		function () {
			qodefTestimonialsSlider.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			elementorFrontend.hooks.addAction(
				'frontend/element_ready/firstframe_core_testimonials_list.default',
				function () {
					qodefTestimonialsSlider.init();
				}
			);
		}
	);

	var qodefTestimonialsSlider = {
		init: function () {
			var $holder = $( '.qodef-testimonials-slider-holder' );

			if ( $holder.length ) {
				$holder.each(
					function () {
						var $thisHolder = $( this );

						qodefTestimonialsSlider.initSlider( $thisHolder );
					}
				);
			}
		},
		initSlider: function ( $holder ) {
			var quoteSliderHolder = $holder.find( '.qodef-testimonials-list' )[0],
				quoteSlider       = $holder.find( '.qodef-testimonials-list' )[0].swiper,
				thumbSlider       = $holder.find( '.qodef-testimonials-thumbs' )[0].swiper;

			thumbSlider.params.centeredSlides       = true;
			thumbSlider.params.slideToClickedSlide  = true;
			thumbSlider.params.loopAdditionalSlides = 3;

			thumbSlider.autoplay.stop();
			thumbSlider.update();

			var numItemsThumb = thumbSlider.slides.length;

			quoteSlider.params.loopedSlides   = numItemsThumb;//real number of slides should be the same on both sides because of controller
			quoteSlider.params.centeredSlides = true;

			var quoteSliderOptions = quoteSlider.params;

			quoteSlider.update();
			quoteSlider.destroy();

			let quoteSliderNew = new Swiper(
				quoteSliderHolder,
				Object.assign( quoteSliderOptions )
			);

			quoteSliderNew.controller.control = thumbSlider;
			quoteSliderNew.controller.by      = 'slide';
			thumbSlider.controller.control    = quoteSliderNew;

			$holder.addClass( 'qodef-init' );
		}
	};

	qodefCore.shortcodes.firstframe_core_testimonials_list.qodefSwiper             = qodef.qodefSwiper;
	qodefCore.shortcodes.firstframe_core_testimonials_list.qodefTestimonialsSlider = qodefTestimonialsSlider;

})( jQuery );

(function ( $ ) {
	'use strict';

	/*
	 **	Re-init scripts on gallery loaded
	 */
	$( document ).on(
		'yith_wccl_product_gallery_loaded',
		function () {

			if ( typeof qodefCore.qodefWooMagnificPopup === 'function' ) {
				qodefCore.qodefWooMagnificPopup.init();
			}
		}
	);

})( jQuery );

(function ($) {
	'use strict';

	$(document).on(
		'qv_loader_stop qv_variation_gallery_loaded',
		function () {
			qodefYithSelect2.init();
		}
	);

	var qodefYithSelect2 = {
		init: function (settings) {
			this.holder = [];
			this.holder.push(
				{
					holder: $('#yith-quick-view-modal .variations select'),
					options: {
						minimumResultsForSearch: Infinity
					}
				}
			);

			// Allow overriding the default config
			$.extend(this.holder, settings);

			if (typeof this.holder === 'object') {
				$.each(
					this.holder,
					function (key, value) {
						qodefYithSelect2.createSelect2(value.holder, value.options);
					}
				);
			}
		},
		createSelect2: function ($holder, options) {
			if (typeof $holder.select2 === 'function') {
				$holder.select2(options);
			}
		}
	};

})(jQuery);

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefTextFollow.init();
		}
	);

	var qodefTextFollow = {
		init: function () {
			var $gallery = $( '.qodef-layout--text-on-hover' );

			if ( $gallery.length && qodefCore.body.hasClass('.qodef-custom-cursor-enabled')) {
				qodefCore.body.append( '<div class="qodef-e-content-follow-text"><div class="qodef-e-top-holder"></div><div class="qodef-e-text"></div></div>' );

				var $contentFollow = $( '.qodef-e-content-follow-text' ),
					$topHolder     = $contentFollow.find( '.qodef-e-top-holder' ),
					$textHolder    = $contentFollow.find( '.qodef-e-text' );

				$gallery.each(
					function () {
						$gallery.find( '.qodef-e-inner' ).each(
							function () {
								var $thisItem = $( this );

								//info element position
								$thisItem.on(
									'mousemove',
									function ( e ) {
										if ( e.clientX + 20 + $contentFollow.width() > qodefCore.windowWidth ) {
											$contentFollow.addClass( 'qodef-right' );
										} else {
											$contentFollow.removeClass( 'qodef-right' );
										}

										$contentFollow.css(
											{
												top: e.clientY - 100,
												left: e.clientX - 100,
											}
										);
									}
								);

								//show/hide info element
								$thisItem.on(
									'mouseenter',
									function () {
										var $thisItemTopHolder  = $( this ).find( '.qodef-e-top-holder' ),
											$thisItemTextHolder = $( this ).find( '.qodef-e-text' );

										if ( $thisItemTopHolder.length ) {
											$topHolder.html( $thisItemTopHolder.html() );
										}

										if ( $thisItemTextHolder.length ) {
											$textHolder.html( $thisItemTextHolder.html() );
										}

										if ( ! $contentFollow.hasClass( 'qodef-is-active' ) ) {
											$contentFollow.addClass( 'qodef-is-active' );
										}
									}
								).on(
									'mouseleave',
									function () {
										if ( $contentFollow.hasClass( 'qodef-is-active' ) ) {
											$contentFollow.removeClass( 'qodef-is-active' );
										}
									}
								);
							}
						);
					}
				);
			}
		},
	};

	qodefCore.shortcodes.firstframe_core_image_with_text.qodefTextFollow = qodefTextFollow;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInteractiveLinkShowcaseInteractiveList.init();
		}
	);

	var qodefInteractiveLinkShowcaseInteractiveList = {
		init: function () {
			this.holder = $( '.qodef-interactive-link-showcase.qodef-layout--interactive-list' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInteractiveLinkShowcaseInteractiveList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $links            = $currentItem.find( '.qodef-m-item' ),
				x                 = 0,
				y                 = 0,
				currentXCPosition = 0,
				currentYCPosition = 0;

			if ( $links.length ) {
				$links.on(
					'mouseenter',
					function () {
						$links.removeClass( 'qodef--active' );
						$( this ).addClass( 'qodef--active' );
					}
				).on(
					'mousemove',
					function ( event ) {
						var $thisLink         = $( this ),
							$followInfoHolder = $thisLink.find( '.qodef-e-follow-content' ),
							$followImage      = $followInfoHolder.find( '.qodef-e-follow-image' ),
							$followImageItem  = $followImage.find( 'img' ),
							followImageWidth  = $followImageItem.width(),
							followImagesCount = parseInt( $followImage.data( 'images-count' ), 10 ),
							followImagesSrc   = $followImage.data( 'images' ),
							$followTitle      = $followInfoHolder.find( '.qodef-e-follow-title' ),
							itemWidth         = $thisLink.outerWidth(),
							itemHeight        = $thisLink.outerHeight(),
							itemOffsetTop     = $thisLink.offset().top - qodefCore.scroll,
							itemOffsetLeft    = $thisLink.offset().left;

						x = (event.clientX - itemOffsetLeft) >> 0;
						y = (event.clientY - itemOffsetTop) >> 0;

						if ( x > itemWidth ) {
							currentXCPosition = itemWidth;
						} else if ( x < 0 ) {
							currentXCPosition = 0;
						} else {
							currentXCPosition = x;
						}

						if ( y > itemHeight ) {
							currentYCPosition = itemHeight;
						} else if ( y < 0 ) {
							currentYCPosition = 0;
						} else {
							currentYCPosition = y;
						}

						if ( followImagesCount > 1 ) {
							var imagesUrl    = followImagesSrc.split( '|' ),
								itemPartSize = itemWidth / followImagesCount;

							$followImageItem.removeAttr( 'srcset' );

							if ( currentXCPosition < itemPartSize ) {
								$followImageItem.attr( 'src', imagesUrl[0] );
							}

							// -2 is constant - to remove first and last item from the loop
							for ( var index = 1; index <= (followImagesCount - 2); index++ ) {
								if ( currentXCPosition >= itemPartSize * index && currentXCPosition < itemPartSize * (index + 1) ) {
									$followImageItem.attr( 'src', imagesUrl[index] );
								}
							}

							if ( currentXCPosition >= itemWidth - itemPartSize ) {
								$followImageItem.attr( 'src', imagesUrl[followImagesCount - 1] );
							}
						}

						$followImage.css(
							{
								'top': itemHeight / 2,
							}
						);
						$followTitle.css(
							{
								'transform': 'translateY(' + -(parseInt( itemHeight, 10 ) / 2 + currentYCPosition) + 'px)',
								'left': -(currentXCPosition - followImageWidth / 2),
							}
						);
						$followInfoHolder.css( { 'top': currentYCPosition, 'left': currentXCPosition } );
					}
				).on(
					'mouseleave',
					function () {
						$links.removeClass( 'qodef--active' );
					}
				);
			}

			$currentItem.addClass( 'qodef--init' );
		},
	};

	qodefCore.shortcodes.firstframe_core_interactive_link_showcase.qodefInteractiveLinkShowcaseInteractiveList = qodefInteractiveLinkShowcaseInteractiveList;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInteractiveLinkShowcaseList.init();
		}
	);

	var qodefInteractiveLinkShowcaseList = {
		init: function () {
			this.holder = $( '.qodef-interactive-link-showcase.qodef-layout--list' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInteractiveLinkShowcaseList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $images = $currentItem.find( '.qodef-m-image' ),
				$links  = $currentItem.find( '.qodef-m-item' );

			$images.eq( 0 ).addClass( 'qodef--active' );
			$links.eq( 0 ).addClass( 'qodef--active' );

			$links.on(
				'touchstart mouseenter',
				function ( e ) {
					var $thisLink = $( this );

					if ( ! qodefCore.html.hasClass( 'touchevents' ) || ( ! $thisLink.hasClass( 'qodef--active' ) && qodefCore.windowWidth > 680) ) {
						e.preventDefault();
						$images.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
						$links.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
					}
				}
			).on(
				'touchend mouseleave',
				function () {
					var $thisLink = $( this );

					if ( ! qodefCore.html.hasClass( 'touchevents' ) || ( ! $thisLink.hasClass( 'qodef--active' ) && qodefCore.windowWidth > 680) ) {
						$links.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
						$images.removeClass( 'qodef--active' ).eq( $thisLink.index() ).addClass( 'qodef--active' );
					}
				}
			);

			$currentItem.addClass( 'qodef--init' );
		},
	};

	qodefCore.shortcodes.firstframe_core_interactive_link_showcase.qodefInteractiveLinkShowcaseList = qodefInteractiveLinkShowcaseList;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInteractiveLinkShowcaseSlider.init();
		}
	);

	var qodefInteractiveLinkShowcaseSlider = {
		init: function () {
			this.holder = $( '.qodef-interactive-link-showcase.qodef-layout--slider' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefInteractiveLinkShowcaseSlider.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $currentItem ) {
			var $images = $currentItem.find( '.qodef-m-image' );

			var $swiperSlider = new Swiper(
				$currentItem.find( '.swiper-container' ),
				{
					loop: true,
					slidesPerView: 'auto',
					centeredSlides: true,
					speed: 1400,
					mousewheel: true,
					init: false
				}
			);
			qodef.qodefWaitForImages.check(
				$currentItem,
				function () {
					$swiperSlider.init();
				}
			);

			$swiperSlider.on(
				'init',
				function () {
					$images.eq( 0 ).addClass( 'qodef--active' );
					$currentItem.find( '.swiper-slide-active' ).addClass( 'qodef--active' );

					$swiperSlider.on(
						'slideChangeTransitionStart',
						function () {
							var $swiperSlides    = $currentItem.find( '.swiper-slide' ),
								$activeSlideItem = $currentItem.find( '.swiper-slide-active' );

							$images.removeClass( 'qodef--active' ).eq( $activeSlideItem.data( 'swiper-slide-index' ) ).addClass( 'qodef--active' );
							$swiperSlides.removeClass( 'qodef--active' );

							$activeSlideItem.addClass( 'qodef--active' );
						}
					);

					$currentItem.find( '.swiper-slide' ).on(
						'click',
						function ( e ) {
							var $thisSwiperLink  = $( this ),
								$activeSlideItem = $currentItem.find( '.swiper-slide-active' );

							if ( ! $thisSwiperLink.hasClass( 'swiper-slide-active' ) ) {
								e.preventDefault();
								e.stopImmediatePropagation();

								if ( e.pageX < $activeSlideItem.offset().left ) {
									$swiperSlider.slidePrev();
									return false;
								}

								if ( e.pageX > $activeSlideItem.offset().left + $activeSlideItem.outerWidth() ) {
									$swiperSlider.slideNext();
									return false;
								}
							}
						}
					);

					$currentItem.addClass( 'qodef--init' );
				}
			);
		},
	};

	qodefCore.shortcodes.firstframe_core_interactive_link_showcase.qodefInteractiveLinkShowcaseSlider = qodefInteractiveLinkShowcaseSlider;

})( jQuery );
