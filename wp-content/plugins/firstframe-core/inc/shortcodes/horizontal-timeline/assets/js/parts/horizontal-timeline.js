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
