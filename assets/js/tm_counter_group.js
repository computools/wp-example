jQuery( function( $ ) {
	'use strict';

	$( '.tm-counter-group' ).each( function() {
		$( this ).find( '.tm-counter' ).matchHeight();
	} );
} );
