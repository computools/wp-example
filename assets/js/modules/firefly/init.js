jQuery( document ).ready( function( $ ) {
	'use strict';

	$( window ).load( function() {
		$( '.vc_row' ).each( function() {

			if ( $( this ).data( 'row-effect' ) == 'firefly' ) {

				var $_wrap = $( this ).find( '.firefly-wrapper' );
				var _color = $( this ).data( 'firefly-color' ) ? $( this ).data( 'firefly-color' ) : '#fff';
				var _min = $( this ).data( 'firefly-min' ) ? $( this ).data( 'firefly-min' ) : 1;
				var _max = $( this ).data( 'firefly-max' ) ? $( this ).data( 'firefly-max' ) : 3;
				var _total = $( this ).data( 'firefly-total' ) ? $( this ).data( 'firefly-total' ) : 30;

				$.firefly( {
					color: _color,
					minPixel: _min,
					maxPixel: _max,
					total: _total,
					on: $_wrap,
					borderRadius: '50%'
				} );
			}
		} );
	} );
} );
