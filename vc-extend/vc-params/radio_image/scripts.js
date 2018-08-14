if ( _.isUndefined( window.vc ) ) {
	var vc = { atts: {} };
}

jQuery( document ).ready( function( $ ) {
	$( '.tm-image-radio label' ).click( function() {
		$( this ).addClass( 'selected' ).siblings().removeClass( 'selected' );
		$( this ).closest( '.tm-image-radio' ).find( 'input[type=radio]' ).removeClass( 'wpb_vc_param_value' );
		$( this ).prev().addClass( 'wpb_vc_param_value' );
	} );
} );
