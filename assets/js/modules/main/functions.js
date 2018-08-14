var $window = $( window );
var $html = $( 'html' );
var $body = $( 'body' );
var $pageWrapper = $( '#page' );
var $pageHeader = $( '#page-header' );
var $headerInner = $( '#page-header-inner' );
var $pageContent = $( '#page-content' );
var headerStickyEnable = $insight.header_sticky_enable;
var headerStickyHeight = parseInt( $insight.header_sticky_height );
var wWidth = window.innerWidth;
/**
 * Global ajaxBusy = false
 * Desc: Status of ajax
 */
var ajaxBusy = false;
$( document ).ajaxStart( function() {
	ajaxBusy = true;
} ).ajaxStop( function() {
	ajaxBusy = false;
} );

var animateQueueDelay = 200,
    queueResetDelay;

function processItemQueue( itemQueue, queueDelay, queueTimer, queueResetDelay ) {
	clearTimeout( queueResetDelay );
	queueTimer = window.setInterval( function() {
		if ( itemQueue !== undefined && itemQueue.length ) {
			$( itemQueue.shift() ).addClass( 'animate' );
			processItemQueue();
		} else {
			window.clearInterval( queueTimer );
		}
	}, queueDelay );
}

calMobileMenuBreakpoint();

$( window ).resize( function() {
	wWidth = window.innerWidth;
	calMobileMenuBreakpoint();
	boxedFixVcRow();
	calculateLeftHeaderSize();
	initStickyHeader();
	initFooterParallax();
} );

$( window ).load( function() {
	$body.addClass( 'loaded' );
	setTimeout( function() {
		$( '#page-preloader' ).remove();
	}, 600 );
} );

$( '.tm-animation-queue' ).each( function() {
	var itemQueue  = [],
	    queueTimer,
	    queueDelay = $( this ).data( 'animation-delay' ) ? $( this ).data( 'animation-delay' ) : animateQueueDelay;

	$( this ).children( '.item' ).waypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		itemQueue.push( _self );
		processItemQueue( itemQueue, queueDelay, queueTimer );
		queueDelay += animateQueueDelay;
	}, {
		offset: '90%',
		triggerOnce: true
	} );
} );

calculateLeftHeaderSize();
initAnimationForElements();

insightInitGrid();

$( '.tm-swiper' ).each( function() {
	insightInitSwiper( $( this ) );
} );

$( '.tm-light-gallery' ).each( function() {
	insightInitLightGallery( $( this ) );
} );

setTimeout( function() {
	// Fix animation not showing.
	//$window.trigger( 'resize' );
	navOnePage();
}, 100 );
initFooterParallax();

$body.on( 'click', '.vc_tta-tab, .vc_tta-panel', function() {
	$( window ).trigger( 'resize' );
} );

initPortfolioFullscreenCenterSlider();

function initPortfolioFullscreenCenterSlider() {
	if ( ! $body.hasClass( 'page-template-portfolio-fullscreen-slider-center' ) ) {
		return;
	}

	var $slider = $( '#fullscreen-center-slider' );
	var $sliderContainer = $slider.children( '.swiper-container' ).first();

	var $swiperPrev = $slider.find( '.swiper-button-prev' );
	var $swiperNext = $slider.find( '.swiper-button-next' );

	$pageContent = $( '.swiper-background-fade-wrapper .inner' );


	var swiper = new Swiper( $sliderContainer, {
		nextButton: $swiperNext,
		prevButton: $swiperPrev,
		slidesPerView: 1,
		speed: 1500,
		spaceBetween: 0,
		mousewheelControl: true,
		loop: true,
		loopedSlides: 1,
		onSlideChangeStart: function( swiper ) {
			slideChangeCallback( swiper, $pageContent );
		},
		onSlideChangeEnd: function( swiper ) {
		}
	} );

	$slider.find( '.panr' ).each( function() {

		var $work = $( this ), $img = $( 'img', $work ), scaleLimit = 1.05;

		$img.panr( {
			moveTarget: $work,
			sensitivity: 50,
			scale: false,
			scaleOnHover: true,
			scaleTo: scaleLimit,
			scaleDuration: .8,
			panDuration: 3,
			resetPanOnMouseLeave: false
		} );
	} );
}

function slideChangeCallback( swiper, $pageContent ) {
	var $counterPrev = $( swiper.wrapper )
		.parent()
		.siblings( '.swiper-navigation-wrap' )
		.find( '.swiper-button-prev' );

	var $counterNext = $( swiper.wrapper )
		.parent()
		.siblings( '.swiper-navigation-wrap' )
		.find( '.swiper-button-next' );

	var total = $( swiper.wrapper )
		.find( '.swiper-slide:not(.swiper-slide-duplicate)' ).length;

	var prevText = swiper.realIndex + '/' + total;

	var nextText = swiper.realIndex + 2 + '/' + total, firstClass = '', lastClass = '';

	if ( (
		     swiper.realIndex
	     ) < 1 ) {
		firstClass = 'first';
		prevText = total + '/' + total;
	}

	if ( (
		     swiper.realIndex + 2
	     ) > total ) {
		lastClass = 'last';
		nextText = '1/' + total;
	}

	$counterPrev.removeClass( 'first' ).addClass( firstClass ).find( '.counter' ).text( prevText );
	$counterNext.removeClass( 'last' ).addClass( lastClass ).find( '.counter' ).text( nextText );

	if ( swiper.previousIndex > swiper.activeIndex ) {
		$( swiper.wrapper ).removeClass( 'swiper-to-next-slide' ).addClass( 'swiper-to-prev-slide' );
	} else {
		$( swiper.wrapper ).removeClass( 'swiper-to-prev-slide' ).addClass( 'swiper-to-next-slide' );
	}

	$pageContent.css( 'backgroundImage', 'url(' + $( swiper.wrapper )
		.find( '.swiper-slide' )
		.eq( swiper.activeIndex )
		.find( '.portfolio-item' )
		.data( 'background' ) + ')' );
}

boxedFixVcRow();
initStickyHeader();
initPopupSearch();
insightInitSmartmenu();
initMobileMenu();
initOffCanvasMenu();

initFullscreenSplitFeaturePage();
handlerPageNotFound();
marqueBackground();

function marqueBackground() {
	$( '.background-marque' ).each( function() {
		var $el = $( this );
		var x = 0;
		var step = 1;
		var speed = 10;

		if ( $el.hasClass( 'to-left' ) ) {
			step = - 1;
		}

		$el.css( 'background-repeat', 'repeat-x' );

		var loop = setInterval( function() {
			x += step;
			$el.css( 'background-position-x', x + 'px' );
		}, speed );

		if ( $el.data( 'marque-pause-on-hover' ) == true ) {
			$( this ).hover( function() {
				clearInterval( loop );
			}, function() {
				loop = setInterval( function() {
					x += step;
					$el.css( 'background-position-x', x + 'px' );
				}, speed );
			} );
		}
	} );
}

// Remove empty p tags form wpautop.
$( 'p:empty' ).remove();

$( '.tm-popup-video' ).each( function() {
	var options = {
		fullScreen: false,
		zoom: false
	};
	$( this ).lightGallery( options );
} );

initSmoothScrollLinks();

if ( $insight.scroll_top_enable == 1 ) {
	scrollToTop();
}

function initSmoothScrollLinks() {
	// Allows for easy implementation of smooth scrolling for buttons.
	$( '.smooth-scroll-link' ).on( 'click', function( e ) {
		var href = $( this ).attr( 'href' );
		var _wWidth = window.innerWidth;
		if ( href.match( /^([.#])(.+)/ ) ) {
			e.preventDefault();
			var offset = 0;
			if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {

				if ( $headerInner.data( 'header-position' ) === 'left' ) {
					if ( _wWidth < $insight.mobile_menu_breakpoint ) {
						offset += headerStickyHeight;
					}
				} else {
					offset += headerStickyHeight;
				}
			}

			// Add offset of admin bar when viewport min-width 600.
			if ( _wWidth > 600 ) {
				var adminBarHeight = $( '#wpadminbar' ).height();
				offset += adminBarHeight;
			}

			$.smoothScroll( {
				offset: - offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear'
			} );
		}
	} );
}

function initFullscreenSplitFeaturePage() {
	if ( $body.hasClass( 'page-template-fullscreen-split-feature' ) ) {
		var _wWidth = window.innerWidth;
		var _wHeight = window.innerHeight;

		var _extraH = 0;
		if ( $body.hasClass( 'admin-bar' ) ) {
			_extraH += 32;
		}
		var fullscreenWrapper = $( '#fullscreen-wrap' );
		fullscreenWrapper.width( _wWidth ).height( _wHeight - _extraH );
		$( window ).resize( function() {
			_wWidth = window.innerWidth;
			_wHeight = window.innerHeight;
			fullscreenWrapper.width( _wWidth ).height( _wHeight - _extraH );
		} )
	}
}

function initAnimationForElements() {
	$( '.tm-animation' ).waypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		$( _self ).addClass( 'animate' );
	}, {
		offset: '100%' // triggerOnce: true
	} );
}

function insightInitSmartmenu() {
	var $primaryMenu = $headerInner.find( '#page-navigation' ).find( 'ul' ).first();

	if ( ! $primaryMenu.hasClass( 'sm' ) ) {
		return;
	}

	$primaryMenu.smartmenus( {
		subMenusSubOffsetX: 0,
		subMenusSubOffsetY: 0
	} );

	// Add animation for sub menu.
	$primaryMenu.bind( {
		'show.smapi': function( e, menu ) {
			$( menu ).removeClass( 'hide-animation' ).addClass( 'show-animation' );
		},
		'hide.smapi': function( e, menu ) {
			$( menu ).removeClass( 'show-animation' ).addClass( 'hide-animation' );
		}
	} ).on( 'animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function( e ) {
		$( this ).removeClass( 'show-animation hide-animation' );
		e.stopPropagation();
	} );
}

function insightInitLightGallery( $gallery ) {
	var _download  = (
		$insight.light_gallery_download === '1'
	), _autoPlay   = (
		$insight.light_gallery_auto_play === '1'
	), _zoom       = (
		$insight.light_gallery_zoom === '1'
	), _fullScreen = (
		$insight.light_gallery_full_screen === '1'
	), _thumbnail  = (
		$insight.light_gallery_thumbnail === '1'
	);

	var options = {
		selector: '.zoom',
		thumbnail: _thumbnail,
		download: _download,
		autoplay: _autoPlay,
		zoom: _zoom,
		fullScreen: _fullScreen,
		animateThumb: false,
		showThumbByDefault: false,
		getCaptionFromTitleOrAlt: false
	};

	$gallery.lightGallery( options );
}

function animateMagicLineOnScroll( $li, onScroll, id ) {
	if ( onScroll == false ) {
		$li.each( function() {
			var link = $( this ).children( 'a[href*=\\#]:not([href=\\#])' );
			if ( link.attr( 'href' ) == id ) {

				$( this ).siblings( 'li' ).removeClass( 'current-menu-item' );
				$( this ).addClass( 'current-menu-item' );

				return true;
			}
		} );
	}
}

function navOnePage() {
	if ( ! $body.hasClass( 'one-page' ) ) {
		return;
	}
	var $header = $( '#page-header' );
	var $headerInner = $header.children( '#page-header-inner' );
	var $mainNav = $( '#page-navigation' ).find( '.menu__container' ).first();
	var $li = $mainNav.children( '.menu-item' );
	var $links = $li.children( 'a[href^=\\#]:not([href=\\#])' );
	var onScroll = false;

	$li.each( function() {
		var link = $( this ).children( 'a[href^=\\#]:not([href=\\#])' );

		if ( link.length > 0 ) {
			var id = link.attr( 'href' );
			if ( $( id ).length > 0 ) {
				$( id ).waypoint( function( direction ) {
					if ( direction === 'down' ) {
						animateMagicLineOnScroll( $li, onScroll, id );
					}
				}, {
					offset: '25%'
				} );

				$( id ).waypoint( function( direction ) {
					if ( direction === 'up' ) {
						animateMagicLineOnScroll( $li, onScroll, id );
					}
				}, {
					offset: '-25%'
				} );
			}
		}
	} );

	// Allows for easy implementation of smooth scrolling for navigation links.
	$links.on( 'click', function() {
		var $this = $( this );
		var href = $( this ).attr( 'href' );
		var offset = 0;

		if ( $body.hasClass( 'admin-bar' ) ) {
			offset += 32;
		}

		if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
			offset += headerStickyHeight;
			offset = - offset;
		}

		var parent = $this.parent( 'li' );

		parent.siblings( 'li' ).removeClass( 'current-menu-item' );
		parent.addClass( 'current-menu-item' );

		$.smoothScroll( {
			offset: offset,
			scrollTarget: $( href ),
			speed: 600,
			easing: 'linear',
			beforeScroll: function() {
				onScroll = true;
			},
			afterScroll: function() {
				onScroll = false;
			}
		} );
		return false;
	} );
}

function initFooterParallax() {
	var footerWrap = $( '#page-footer-wrapper' );

	if ( ! footerWrap.hasClass( 'parallax' ) || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}

	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );
		if ( wWidth >= 1024 ) {
			var fwHeight = footerWrap.height();
			$body.addClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: fwHeight
			} );
		} else {
			$body.removeClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: 0
			} );
		}
	}
}

function scrollToTop() {
	var $window = $( window );
	// Scroll up
	var $scrollup = $( '.scrollup' );
	var $scrollupFixed = $( '.scrollup--fixed' );

	$window.scroll( function() {
		if ( $window.scrollTop() > 100 ) {
			$scrollupFixed.addClass( 'show' );
		} else {
			$scrollupFixed.removeClass( 'show' );
		}
	} );

	$scrollup.on( 'click', function( evt ) {
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		evt.preventDefault();
	} );
}

function openMobileMenu() {
	$body.addClass( 'page-mobile-menu-opened' );
}

function closeMobileMenu() {
	$body.removeClass( 'page-mobile-menu-opened' );
}

function calMobileMenuBreakpoint() {
	var _breakpoint = $insight.mobile_menu_breakpoint;
	if ( wWidth <= _breakpoint ) {
		$body.removeClass( 'desktop-menu' ).addClass( 'mobile-menu' );
	} else {
		$body.addClass( 'desktop-menu' ).removeClass( 'mobile-menu' );
	}
}

function initMobileMenu() {
	$( '#page-open-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		openMobileMenu();
	} );

	$( '#page-close-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		closeMobileMenu();
	} );

	var menu = $( '#mobile-menu-primary' );

	menu.on( 'click', 'a', function( e ) {
		var $this = $( this );
		var _li = $( this ).parent( 'li' );
		var href = $this.attr( 'href' );

		if ( $body.hasClass( 'one-page' ) && href && href.match( /^([.#])(.+)/ ) ) {
			closeMobileMenu();
			var offset = 0;

			if ( $body.hasClass( 'admin-bar' ) ) {
				offset += 32;
			}

			if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
				offset += headerStickyHeight;
			}

			if ( offset > 0 ) {
				offset = - offset;
			}

			_li.siblings( 'li' ).removeClass( 'current-menu-item' );
			_li.addClass( 'current-menu-item' );

			setTimeout( function() {
				$.smoothScroll( {
					offset: offset,
					scrollTarget: $( href ),
					speed: 600,
					easing: 'linear'
				} );
			}, 300 );

			return false;
		}
	} );

	menu.on( 'click', '.toggle-sub-menu', function( e ) {
		var _li = $( this ).parents( 'li' ).first();

		e.preventDefault();
		e.stopPropagation();

		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	} );
}

function initOffCanvasMenu() {
	var menu = $( '#off-canvas-menu-primary' );
	var _lv1 = menu.children( 'li' );

	$( '#page-open-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'page-off-canvas-menu-opened' );
	} );

	$( '#page-close-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();

		menu.fadeOut( function() {
			$body.removeClass( 'page-off-canvas-menu-opened' );
			menu.fadeIn();
			menu.find( '.sub-menu' ).slideUp();
		} );
	} );

	var transDelay = 0.1;
	_lv1.each( function() {
		$( this )[ 0 ].setAttribute( 'style', '-webkit-transition-delay:' + transDelay + 's; -moz-transition-delay:' + transDelay + 's; -ms-transition-delay:' + transDelay + 's; -o-transition-delay:' + transDelay + 's; transition-delay:' + transDelay + 's' );
		transDelay += 0.1;
	} );

	menu.on( 'click', '.menu-item-has-children > a', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		var _li = $( this ).parent( 'li' );
		var _friends = _li.siblings( '.opened' );
		_friends.removeClass( 'opened' );
		_friends.find( '.opened' ).removeClass( 'opened' );
		_friends.find( '.sub-menu' ).stop().slideUp();

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	} );
}

function initStickyHeader() {
	if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {
		if ( $headerInner.data( 'header-position' ) != 'left' ) {
			var _hOffset = $headerInner.offset().top;
			var _hHeight = $headerInner.outerHeight();
			var offset = _hOffset + _hHeight;

			$pageHeader.headroom( {
				offset: offset,
				onTop: function() {
					if ( ! $body.hasClass( 'page-header-behind' ) ) {
						$pageWrapper.css( {
							paddingTop: 0
						} );
					}
				},
				onNotTop: function() {
					if ( ! $body.hasClass( 'page-header-behind' ) ) {
						$pageWrapper.css( {
							paddingTop: _hHeight + 'px'
						} );
					}
				}
			} );
		} else {
			if ( wWidth <= $insight.mobile_menu_breakpoint ) {
				if ( ! $pageHeader.data( 'headroom' ) ) {
					var _hOffset = $headerInner.offset().top;
					var _hHeight = $headerInner.outerHeight();
					var offset = _hOffset + _hHeight;

					$pageHeader.headroom( {
						offset: offset
					} );
				}
			} else {
				if ( $pageHeader.data( 'headroom' ) ) {
					$pageHeader.data( 'headroom' ).destroy();
					$pageHeader.removeData( 'headroom' );
				}
			}
		}
	}
}

function initPopupSearch() {
	var popupSearch = $( '#page-popup-search' );
	var searchField = popupSearch.find( '.search-field' );
	$( '#btn-open-popup-search' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'popup-search-opened' );
		$html.css( {
			'overflow': 'hidden'
		} );
		searchField.val( '' );
		setTimeout( function() {
			searchField.focus();
		}, 500 )
	} );

	$( '#popup-search-close' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.removeClass( 'popup-search-opened' );
		$html.css( {
			'overflow': ''
		} );
	} );

	$( document ).on( 'keyup', function( ev ) {
		// escape key.
		if ( ev.keyCode == 27 ) {
			$body.removeClass( 'popup-search-opened' );
			$html.css( {
				'overflow': ''
			} );
		}
	} );
}

function calculateLeftHeaderSize() {
	if ( $headerInner.data( 'header-position' ) != 'left' ) {
		return;
	}
	var _wWidth = window.innerWidth;
	var _containerWidth = parseInt( $body.data( 'content-width' ) );
	if ( _wWidth <= $insight.mobile_menu_breakpoint ) {
		$html.css( {
			marginLeft: 0
		} );
	} else {
		var headerWidth = $headerInner.outerWidth();
		$html.css( {
			marginLeft: headerWidth + 'px'
		} );

		var rows = $( '#page-main-content' ).children( 'article' ).children( '.vc_row' );
		var $contentWidth = $( '#page' ).width();
		rows.each( function() {
			if ( $( this ).attr( 'data-vc-full-width' ) ) {
				var left = 0;
				if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
					left = - (
						(
							$contentWidth - _containerWidth
						) / 2
					) + 'px';
				}
				var width = $contentWidth + 'px';
				$( this ).css( {
					left: left,
					width: width
				} );
				if ( $( this ).attr( 'data-vc-stretch-content' ) ) {

				} else {
					var _padding = 0;
					if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
						_padding = (
							(
								$contentWidth - _containerWidth
							) / 2
						);
					}
					$( this ).css( {
						paddingLeft: _padding,
						paddingRight: _padding
					} );
				}
			}
		} );

		/*if ( typeof revapi6 !== 'undefined' ) {
			revapi6.revredraw();
		}*/
	}
}

function boxedFixVcRow() {
	if ( $body.hasClass( 'boxed' ) ) {
		var contentWidth = $( '#page' ).outerWidth();
		$( '#page-content' ).find( '.vc_row' ).each( function() {
			if ( $( this ).data( 'vc-stretch-content' ) == true && $( this )
				.data( 'vc-stretch-content' ) == true ) {
				$( this ).css( {
					left: 0,
					width: contentWidth + 'px'
				} );
			}
		} );
	}
}

function handlerPageNotFound() {
	if ( ! $body.hasClass( 'error404' ) ) {
		return;
	}

	var page = $( '#page .error404' );
	var height = $( window ).height();
	page.css( {
		'min-height': height
	} );
	$( window ).resize( function() {
		height = $( window ).height();
		page.css( {
			'min-height': height
		} );
	} );

	$( '#tm-btn-go-back' ).on( 'click', function() {
		window.history.back();
	} );
}
