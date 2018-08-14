jQuery( document ).ready( function( $ ) {
	'use strict';

	initStickyElement();
	function initStickyElement() {
		var sticky = $( '.tm-sticky-kit' );
		sticky.stick_in_parent();
	}
} );
