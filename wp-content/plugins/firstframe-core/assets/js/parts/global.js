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
