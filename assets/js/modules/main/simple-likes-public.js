(
	function( $ ) {
		'use strict';
		$( document ).on( 'click', '.sl-button', function() {
			var button    = $( this );
			var post_id   = button.attr( 'data-post-id' );
			var security  = button.attr( 'data-nonce' );
			var isComment = button.attr( 'data-iscomment' );
			var allButtons;
			if ( isComment === '1' ) { /* Comments can have same id */
				allButtons = $( '.sl-comment-button-' + post_id );
			} else {
				allButtons = $( '.sl-button-' + post_id );
			}
			var loader = allButtons.next( '.sl-loader' );
			if ( post_id !== '' ) {
				$.ajax( {
							type: 'POST', url: $insight.ajaxurl, data: {
						action: 'process_simple_like', post_id: post_id, nonce: security, is_comment: isComment
					}, beforeSend: function() {
						loader.html( '&nbsp;<div class="loader">Loading...</div>' );
					}, success: function( response ) {
						var icon  = response.icon;
						var count = response.count;
						allButtons.html( icon + count );
						if ( response.status === 'unliked' ) {
							var likeText = $insight.like;
							allButtons.prop( 'title', likeText );
							allButtons.removeClass( 'liked' );
						} else {
							var unLikeText = $insight.unlike;
							allButtons.prop( 'title', unLikeText );
							allButtons.addClass( 'liked' );
						}
						loader.empty();
					}
						} );
			}
			return false;
		} );
	}
)( jQuery );
