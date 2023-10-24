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
