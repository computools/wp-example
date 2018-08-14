jQuery( document ).ready( function( $ ) {
	'use strict';

	var $body       = $( 'body' );
	var multiScroll = $( '#tm-multi-scroll' );
	var tooltip     = multiScroll.data( 'tooltip' );

	var topSpacing = 0;

	if ( $body.hasClass( 'admin-bar' ) ) {
		var adminBarH = $( '#wpadminbar' ).height();
		topSpacing += adminBarH;
	}

	var options = {
		css3      : true,
		navigation: true,
		loopBottom: true,
		loopTop   : true
	};

	if ( tooltip ) {
		options.navigationTooltips = tooltip;
	}

	if ( topSpacing > 0 ) {
		options.paddingTop = topSpacing + 'px';
	}

	multiScroll.multiscroll( options );
} );
