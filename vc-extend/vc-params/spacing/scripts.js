! function ( $ ) {
	$( '.tm_spacing-item' ).on( 'change', function () {
		var _wrapper = $( this ).parents( '.tm_spacing-layout' ).first();
		var data = [];
		_wrapper.find( '.tm_spacing-item' ).each( function () {

			var $id = $( this ).attr( 'data-key' );
			if ( $( this ).val() != '' ) {
				data.push( $id + ':' + $( this ).val() );
			}
		} );

		_wrapper.children( '.wpb_vc_param_value' ).val( data.join( ';' ) );
	} );
}( window.jQuery );
