jQuery( document ).ready( function( $ ) {
	'use strict';

	$( window ).load( function() {
		$( '.tm-svg' ).each( function() {
			var _settings = $( this ).data();

			var _type = _settings.type ? _settings.type : 'oneByOne';
			var _duration = _settings.duration ? _settings.duration : 150;

			var _options = {
				type: _type,
				duration: _duration,
				file: _settings.svg
			};

			var _vivus = new Vivus( $( this )[ 0 ], _options );

			if ( _settings.hover ) {
				$( _settings.hover ).on( 'hover', function() {
					_vivus.stop()
					      .reset()
					      .play( 2 );
				} );
			}
		} );
	} );
} );
