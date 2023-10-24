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
