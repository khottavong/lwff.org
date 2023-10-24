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