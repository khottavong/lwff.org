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
