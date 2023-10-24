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
