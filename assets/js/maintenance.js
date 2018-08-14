jQuery( document ).ready( function( $ ) {
	'use strict';

	var $clock = $( '#clock' );

	if ( $clock.length > 0 ) {
		/**
		 * Clock Init Start
		 */
		setInterval( function() {
			var d = new Date();
			r( sec, 6 * d.getSeconds() );
			r( min, 6 * d.getMinutes() );
			r( hour, 30 * (
				   d.getHours() % 12
			   ) + d.getMinutes() / 2 );
		}, 1000 );
	}

	function r( el, deg ) {
		el.setAttribute( 'transform', 'rotate(' + deg + ' 253 253)' )
	}

	var $countDown = $( '#countdown' );

	if ( $countDown.length > 0 ) {
		var datetime = $countDown.data( 'datetime' );
		$countDown.countdown( datetime, function( event ) {
			jQuery( this )
				.html( event.strftime( '<div class="countdown-wrap"><div class="day"><span class="number">%D</span><span class="text">days</span></div><div class="hour"><span class="number">%H</span><span class="text">hours</span></div><div class="minute"><span class="number">%M</span><span class="text">min</span></div><div class="second"><span class="number">%S</span><span class="text">sec</span></div></div>' ) );
		} );
	}

	function makePageFullHeight() {
		var page     = $( '#maintenance-wrap' );
		var height   = $( window ).height();
		var adminBar = $( '#wpadminbar' );
		if ( adminBar ) {
			height -= adminBar.outerHeight();
		}
		page.css( {
					  'min-height': height
				  } );
		$( window ).resize( function() {
			height = $( window ).height();
			if ( adminBar ) {
				height -= adminBar.outerHeight();
			}
			page.css( {
						  'min-height': height
					  } );
		} );
	}

	makePageFullHeight();
} );
