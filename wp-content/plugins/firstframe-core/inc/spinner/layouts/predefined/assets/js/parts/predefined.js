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
