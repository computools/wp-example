/*--------------------------------------------------------------
 Custom js
 --------------------------------------------------------------*/

jQuery( document ).ready( function( $ ) {
	'use strict';

	function insightInitSwiper( $slider ) {
		var $sliderContainer = $slider.children( '.swiper-container' ).first();
		var lgItems = $slider.data( 'lg-items' ) ? $slider.data( 'lg-items' ) : 1;
		var mdItems = $slider.data( 'md-items' ) ? $slider.data( 'md-items' ) : lgItems;
		var smItems = $slider.data( 'sm-items' ) ? $slider.data( 'sm-items' ) : mdItems;
		var xsItems = $slider.data( 'xs-items' ) ? $slider.data( 'xs-items' ) : smItems;

		var lgGutter = $slider.data( 'lg-gutter' ) ? $slider.data( 'lg-gutter' ) : 0;
		var mdGutter = $slider.data( 'md-gutter' ) ? $slider.data( 'md-gutter' ) : lgGutter;
		var smGutter = $slider.data( 'sm-gutter' ) ? $slider.data( 'sm-gutter' ) : mdGutter;
		var xsGutter = $slider.data( 'xs-gutter' ) ? $slider.data( 'xs-gutter' ) : smGutter;

		var vertical = $slider.data( 'vertical' );
		var loop = $slider.data( 'loop' );
		var autoPlay = $slider.data( 'autoplay' );
		var speed = $slider.data( 'speed' );
		var nav = $slider.data( 'nav' );
		var pagination = $slider.data( 'pagination' );
		var paginationType = $slider.data( 'pagination-type' );
		var paginationNumber = $slider.data( 'pagination-number' );
		var wrapTools = $slider.data( 'wrap-tools' );
		var mouseWheel = $slider.data( 'mousewheel' );
		var effect = $slider.data( 'effect' );
		var slideWrap = $slider.data( 'slide-wrap' );

		if ( slideWrap ) {
			$slider.children( '.swiper-container' )
			       .children( '.swiper-wrapper' )
			       .children( 'div' )
			       .wrap( "<div class='swiper-slide'></div>" );
		}

		var slidePerView = $slider.data( 'slide-per-view' );

		if ( slidePerView ) {
			var options = {
				slidesPerView: 'auto',
				freeMode: true,
				spaceBetween: lgGutter,
				breakpoints: {
					767: {
						spaceBetween: xsGutter
					},
					990: {
						spaceBetween: smGutter
					},
					1199: {
						spaceBetween: mdGutter
					}
				}
			};
		} else {
			var options = {
				slidesPerView: lgItems,
				spaceBetween: lgGutter,
				breakpoints: {
					// when window width is <=
					767: {
						slidesPerView: xsItems,
						spaceBetween: xsGutter
					},
					990: {
						slidesPerView: smItems,
						spaceBetween: smGutter
					},
					1199: {
						slidesPerView: mdItems,
						spaceBetween: mdGutter
					}
				}
			};
		}

		if ( speed ) {
			options.speed = speed;
		}

		// Maybe: fade, flip
		if ( effect ) {
			options.effect = effect;
		}

		if ( loop ) {
			options.loop = true;
		}

		if ( autoPlay ) {
			options.autoplay = autoPlay;
			options.autoplayDisableOnInteraction = false;
		}

		var $wrapTools;

		if ( wrapTools ) {
			$wrapTools = $( '<div class="swiper-tools"></div>' );

			$slider.append( $wrapTools );
		}

		if ( nav ) {
			var $swiperPrev = $( '<div class="swiper-nav-button swiper-button-prev"><i class="nav-button-icon"></i></div>' );
			var $swiperNext = $( '<div class="swiper-nav-button swiper-button-next"><i class="nav-button-icon"></i></div>' );

			if ( $wrapTools ) {
				$wrapTools.append( $swiperPrev ).append( $swiperNext );
			} else {
				$slider.append( $swiperPrev ).append( $swiperNext );
			}

			options.prevButton = $swiperPrev;
			options.nextButton = $swiperNext;
		}

		if ( pagination ) {
			var $swiperPagination = $( '<div class="swiper-pagination"></div>' );
			$slider.addClass( 'has-pagination' );

			if ( $wrapTools ) {
				$wrapTools.append( $swiperPagination );
			} else {
				$slider.append( $swiperPagination );
			}

			//var $swiperPagination        = $slider.children( '.swiper-pagination' );
			options.pagination = $swiperPagination;
			options.paginationClickable = true;
			options.onPaginationRendered = function( swiper ) {
				var total = swiper.slides.length;
				if ( total <= options.slidesPerView ) {
					$swiperPagination.hide();
				} else {
					$swiperPagination.show();
				}
			};

			if ( paginationType ) {
				options.paginationType = paginationType;
			}

			if ( $slider.hasClass( 'pagination-style-4' ) ) {
				options.paginationType = 'fraction';
			}
		}

		if ( paginationNumber ) {
			options.paginationBulletRender = function( swiper, index, className ) {
				return '<span class="' + className + '">' + (
				       index + 1
				) + '</span>';
			}
		}

		if ( mouseWheel ) {
			options.mousewheelControl = true;
		}

		if ( vertical ) {
			options.direction = 'vertical'
		}

		var $swiper = new Swiper( $sliderContainer, options );
	}
