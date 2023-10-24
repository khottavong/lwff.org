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
