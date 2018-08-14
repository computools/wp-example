jQuery( document ).ready( function( $ ) {
	'use strict';

	var itemQueue = [];
	var delay     = 200;
	var queueTimer;
	var $body     = $( 'body' );
	var $opScroll = $( '#page-main-content' );
	var wWidth = window.innerWidth;
	function processItemQueue() {
		// We're already processing the queue.
		if ( queueTimer ) {
			return;
		}
		queueTimer = window.setInterval( function() {
			if ( itemQueue.length ) {
				$( itemQueue.shift() ).addClass( 'animate' );
				processItemQueue();
			} else {
				window.clearInterval( queueTimer );
				queueTimer = null;
			}
		}, delay );
	}

	function onepageScroll() {
		var $hWindows = $( window ).height();
		var $opPagination;

		$opScroll.onepage_scroll( {
									  sectionContainer  : '.vc_row-outer',
									  loop              : false,
									  responsiveFallback: 768,
									  beforeMove        : function() {
										  if ( $opPagination ) {
											  var link = $opPagination.find( '.active' );
											  var skin = link.attr( 'data-skin' );
											  $body.attr( 'data-row-skin', skin );
										  }
									  },
									  afterMove         : function( index ) {
										  var activeRow = $opScroll.children( '.section.active' );
										  // Do animate for elements when section when on the first time.
										  if ( ! activeRow.hasClass( 'viewed' ) ) {
											  activeRow.find( '.tm-animation' )
													   .each( function() {
														   itemQueue.push( $( this ) );
														   processItemQueue();
													   } );
											  var grid = activeRow.find( '.tm-grid' );
											  if ( grid.length > 0 ) {
												  grid.each( function() {
													  if ( $( this ).data( 'animation' ) == true ) {
														  $( this ).children( '.grid-item' ).each( function() {
															  itemQueue.push( $( this ) );
															  processItemQueue();
														  } );
													  }
												  } );
											  }
											  activeRow.addClass( 'viewed' );
										  }
									  }
								  } );


		if ( wWidth > 768 ) {
			$opScroll.css( 'height', $hWindows + 'px' );
		}

		$opPagination = $( '.onepage-pagination' );
		$opScroll.children( '.vc_row-outer' ).each( function( i, o ) {
			var pageIndex = i + 1;
			var title     = $( this ).data( 'section-title' );
			var skin      = $( this ).data( 'section-pagination-skin' );
			var content   = '<span class="number">' + pageIndex + '</span><span class="text">- ' + title + '</span>';

			var link = $opPagination.find( 'a[data-index="' + pageIndex + '"]' );
			if ( link.hasClass( 'active' ) ) {
				$body.attr( 'data-row-skin', skin );
			}
			link.attr( 'data-skin', skin );
			link.html( content );
		} );
	}

	onepageScroll();
	$( window ).resize( function() {
		wWidth = window.innerWidth;
		if ( wWidth > 768 ) {
			var $hWindows = $( window ).height();
			$opScroll.css( 'height', $hWindows + 'px' );
		} else {
			$opScroll.css( 'height', 'auto' );
		}
	} );
} );
