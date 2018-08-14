<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Insight_Custom_Css' ) ) {
	class Insight_Custom_Css {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$primary_color   = Insight::setting( 'primary_color' );
			$secondary_color = Insight::setting( 'secondary_color' );
			$px              = 'px';

			// Responsive body font-size.
			$body_font_sensitive       = Insight::setting( 'body_font_sensitive' );
			$body_font_size_max        = Insight::setting( 'body_font_size' );
			$body_font_size_min        = $body_font_size_max * $body_font_sensitive;
			$body_font_size_responsive = "calc($body_font_size_min$px + ($body_font_size_max - $body_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H1 font-size.
			$heading_font_sensitive  = Insight::setting( 'heading_font_sensitive' );
			$h1_font_size_max        = Insight::setting( 'h1_font_size' );
			$h1_font_size_min        = $h1_font_size_max * $heading_font_sensitive;
			$h1_font_size_responsive = "calc($h1_font_size_min$px + ($h1_font_size_max - $h1_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H2 font-size.
			$h2_font_size_max        = Insight::setting( 'h2_font_size' );
			$h2_font_size_min        = $h2_font_size_max * $heading_font_sensitive;
			$h2_font_size_responsive = "calc($h2_font_size_min$px + ($h2_font_size_max - $h2_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H3 font-size.
			$h3_font_size_max        = Insight::setting( 'h3_font_size' );
			$h3_font_size_min        = $h3_font_size_max * $heading_font_sensitive;
			$h3_font_size_responsive = "calc($h3_font_size_min$px + ($h3_font_size_max - $h3_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H4 font-size.
			$h4_font_size_max        = Insight::setting( 'h4_font_size' );
			$h4_font_size_min        = $h4_font_size_max * $heading_font_sensitive;
			$h4_font_size_responsive = "calc($h4_font_size_min$px + ($h4_font_size_max - $h4_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H5 font-size.
			$h5_font_size_max        = Insight::setting( 'h5_font_size' );
			$h5_font_size_min        = $h5_font_size_max * $heading_font_sensitive;
			$h5_font_size_responsive = "calc($h5_font_size_min$px + ($h5_font_size_max - $h5_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H6 font-size.
			$h6_font_size_max        = Insight::setting( 'h6_font_size' );
			$h6_font_size_min        = $h6_font_size_max * $heading_font_sensitive;
			$h6_font_size_responsive = "calc($h6_font_size_min$px + ($h6_font_size_max - $h6_font_size_min) * ((100vw - 554px) / 646))";

			$body_typo     = Insight::setting( 'typography_body' );
			$_primary_font = $body_typo['font-family'];

			$extra_style = "
				.primary-font, .tm-button, button, input, select, textarea{ font-family: $_primary_font }
				.primary-font-important { font-family: $_primary_font !important }
				::-moz-selection { color: #fff; background-color: $primary_color }
				::selection { color: #fff; background-color: $primary_color }
				body{font-size: $body_font_size_min$px}
				h1,.h1{font-size: $h1_font_size_min$px}
				h2,.h2{font-size: $h2_font_size_min$px}
				h3,.h3{font-size: $h3_font_size_min$px}
				h4,.h4{font-size: $h4_font_size_min$px}
				h5,.h5{font-size: $h5_font_size_min$px}
				h6,.h6{font-size: $h6_font_size_min$px}

				@media (min-width: 544px) and (max-width: 1199px) {
					body{font-size: $body_font_size_responsive}
					h1,.h1{font-size: $h1_font_size_responsive}
					h2,.h2{font-size: $h2_font_size_responsive}
					h3,.h3{font-size: $h3_font_size_responsive}
					h4,.h4{font-size: $h4_font_size_responsive}
					h5,.h5{font-size: $h5_font_size_responsive}
					h6,.h6{font-size: $h6_font_size_responsive}
				}
			";


			$extra_style .= "
            .gradient-text-1 {
                background: -webkit-linear-gradient(left, {$secondary_color} 25%, {$primary_color} 80% );
                background: linear-gradient(left, {$secondary_color} 25%, {$primary_color} 80%);
                -webkit-background-clip: text;
	            -webkit-text-fill-color: transparent;
            }
            ";

			$headerStickyHeight = Insight::setting( 'header_sticky_height' );
			$stickyPadding      = $headerStickyHeight + 30;
			if ( is_admin_bar_showing() ) {
				$stickyPadding += 32;
			}

			$extra_style .= ".tm-sticky-kit.is_stuck { 
				padding-top: {$stickyPadding}px; 
			}";

			$site_width = Insight_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Insight::setting( 'site_width' );
			}
			if ( $site_width !== '' ) {
				$extra_style .= ".boxed {
                max-width: $site_width;
            }
            @media (min-width: 1200px) { .container {
				max-width: $site_width;
			}}";
			}

			$tmp = '';

			$site_background_color = Insight_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Insight_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Insight_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp                    .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Insight_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			$site_background_attachment = Insight_Helper::get_post_meta( 'site_background_attachment', '' );
			if ( $site_background_attachment !== '' ) {
				$tmp .= "background-attachment: $site_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "body { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Insight_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Insight_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Insight_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp                       .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Insight_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			$content_padding = Insight_Helper::get_post_meta( 'content_padding' );
			if ( $content_padding === '0' ) {
				$tmp .= 'padding-top: 0;';
				$tmp .= 'padding-bottom: 0;';
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".page-content { $tmp; }";
			}

			$extra_style .= $this->primary_color_css();
			$extra_style .= $this->secondary_color_css();
			$extra_style .= $this->sidebar_css();
			$extra_style .= $this->title_bar_css();
			$extra_style .= $this->footer_css();
			$extra_style .= $this->light_gallery_css();

			wp_add_inline_style( 'insight-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function sidebar_css() {
			$css = '';

			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$page_sidebar1 = Insight::setting( 'search_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'search_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				$page_sidebar1 = Insight::setting( 'product_archive_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'product_archive_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'portfolio' ) || Insight_Portfolio::is_taxonomy() ) {
				$page_sidebar1 = Insight::setting( 'portfolio_archive_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'portfolio_archive_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'post' ) ) {
				$page_sidebar1 = Insight::setting( 'blog_archive_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'blog_archive_page_sidebar_2' );
			} elseif ( is_home() ) {
				$page_sidebar1 = Insight::setting( 'home_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'home_page_sidebar_2' );
			} elseif ( is_singular( 'post' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'post_page_sidebar_1' );
				}
				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'post_page_sidebar_2' );
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'portfolio_page_sidebar_2' );
				}
			} elseif ( is_singular( 'product' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'product_page_sidebar_2' );
				}
			} else {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'page_sidebar_2' );
				}
			}

			if ( 'none' !== $page_sidebar1 ) {
				if ( 'none' !== $page_sidebar2 ) {
					$sidebar_width  = Insight::setting( 'dual_sidebar_width' );
					$sidebar_offset = Insight::setting( 'dual_sidebar_offset' );
					$content_width  = 100 - $sidebar_width * 2;
				} else {
					$sidebar_width  = Insight::setting( 'single_sidebar_width' );
					$sidebar_offset = Insight::setting( 'single_sidebar_offset' );
					$content_width  = 100 - $sidebar_width;
				}

				$css .= "@media (min-width: 768px) {
				.page-sidebar {
					flex: 0 0 $sidebar_width%;
					max-width: $sidebar_width%;
				}
				.page-main-content {
					flex: 0 0 $content_width%;
					max-width: $content_width%;
				}
			}
			@media (min-width: 1200px) {
				.page-sidebar-left .page-sidebar-inner {
					padding-right: $sidebar_offset;
				}
				.page-sidebar-right .page-sidebar-inner {
					padding-left: $sidebar_offset;
				}
			}";
			}

			return $css;
		}

		function title_bar_css() {
			$css = $title_bar_tmp = $overlay_tmp = '';

			$bg_color   = Insight_Helper::get_post_meta( 'page_title_bar_background_color', '' );
			$bg_image   = Insight_Helper::get_post_meta( 'page_title_bar_background', '' );
			$bg_overlay = Insight_Helper::get_post_meta( 'page_title_bar_background_overlay', '' );

			if ( $bg_color !== '' ) {
				$title_bar_tmp .= "background-color: {$bg_color}!important;";
			}

			if ( $bg_image !== '' ) {
				$title_bar_tmp .= "background-image: url({$bg_image})!important;";
			}

			if ( $bg_overlay !== '' ) {
				$overlay_tmp .= "background-color: {$bg_overlay}!important;";
			}

			if ( $title_bar_tmp !== '' ) {
				$css .= ".page-title-bar-inner{ {$title_bar_tmp} }";
			}

			if ( $overlay_tmp !== '' ) {
				$css .= ".page-title-bar-overlay{ {$overlay_tmp} }";
			}

			return $css;
		}

		function footer_css() {
			$footer_page = Insight_Helper::get_post_meta( 'footer_page', 'default' );
			$css         = '';
			if ( $footer_page === 'default' ) {
				$footer_page = Insight::setting( 'footer_page' );
			}

			if ( $footer_page === '' ) {
				return '';
			}

			$_insight_args = array(
				'post_type' => 'ic_footer',
				'name'      => $footer_page,
			);

			$_insight_query = new WP_Query( $_insight_args );

			if ( $_insight_query->have_posts() ) {
				while ( $_insight_query->have_posts() ) : $_insight_query->the_post();


					$footer_options = unserialize( get_post_meta( get_the_ID(), 'insight_footer_options', true ) );

					$css                = '';
					$widget_title_color = Insight_Helper::get_the_post_meta( $footer_options, 'widget_title_color', '' );
					$text_color         = Insight_Helper::get_the_post_meta( $footer_options, 'text_color', '' );
					$link_color         = Insight_Helper::get_the_post_meta( $footer_options, 'link_color', '' );
					$link_hover_color   = Insight_Helper::get_the_post_meta( $footer_options, 'link_hover_color', '' );

					if ( $widget_title_color !== '' ) {
						$css .= ".page-footer .widgettitle { color: {$widget_title_color}; }";
					}

					if ( $text_color !== '' ) {
						$css .= ".page-footer { color: {$text_color}; }";
					}

					if ( $link_color !== '' ) {
						$css .= "
			                .page-footer a,
			                .page-footer .widget_recent_entries li a,
			                .page-footer .widget_recent_comments li a,
			                .page-footer .widget_archive li a,
			                .page-footer .widget_categories li a,
			                .page-footer .widget_meta li a,
			                .page-footer .widget_product_categories li a,
			                .page-footer .widget_rss li a,
			                .page-footer .widget_pages li a,
			                .page-footer .widget_nav_menu li a,
			                .page-footer .insight-core-bmw li a { 
			                    color: {$link_color};
			                }";
					}

					if ( $link_hover_color !== '' ) {
						$css .= "
			                .page-footer a:hover,
			                .page-footer .widget_recent_entries li a:hover,
			                .page-footer .widget_recent_comments li a:hover,
			                .page-footer .widget_archive li a:hover,
			                .page-footer .widget_categories li a:hover,
			                .page-footer .widget_meta li a:hover,
			                .page-footer .widget_product_categories li a:hover,
			                .page-footer .widget_rss li a:hover,
			                .page-footer .widget_pages li a:hover,
			                .page-footer .widget_nav_menu li a:hover,
			                .page-footer .insight-core-bmw li a:hover {
			                    color: {$link_hover_color}; 
			                }";
					}
				endwhile;
			}
			wp_reset_postdata();

			return $css;
		}

		function primary_color_css() {
			$color   = Insight::setting( 'primary_color' );
			$alpha17 = Insight_Color::hex2rgba( $color, '0.17' );

			// Color.
			$css = ".primary-color,
				.topbar a,
				a.liked,
				.page-popup-search .search-field,
				.page-popup-search .search-field:focus,
				.page-popup-search .form-description,
				.tm-swiper.nav-style-3 .swiper-nav-button:hover,
				.tm-swiper.nav-style-6 .swiper-nav-button:hover,
				.preview-icon-list span:before,
				.tm-button,
				.tm-button.style-text .button-icon,
				.tm-box-icon.style-1 .icon,
				.tm-box-icon.style-2 .heading,
				.tm-box-icon.style-3 .icon,
				.tm-box-icon.style-4 .icon, 
				.wpcf7-text.wpcf7-text, .wpcf7-textarea,
				.tm-team-member .position,
				.tm-team-member .social-networks a:hover,
				.tm-testimonial.style-1 .testimonial-by-line,
				.tm-testimonial.style-2 .testimonial-by-line,
				.tm-pricing .tm-pricing-list > li > i,
				.highlight-text mark, .typed-text mark, .typed-text-2 mark,
				.typed-text .typed-cursor, .typed-text-2 .typed-cursor,
				.tm-twitter a:hover,
				.page-content .widget .tm-twitter a:hover,
				.tm-list--auto-numbered .tm-list__marker,
				.tm-list--manual-numbered .tm-list__marker,
				.tm-list__icon,
				.tm-info-boxes.style-metro .grid-item.skin-secondary .box-title,
				.tm-slider-icon-list .marker,
				.tm-social-networks .link:hover,
				.tm-counter.style-1 .number-wrap,
				.tm-countdown.skin-dark .number,
				.tm-countdown.skin-dark .separator,
				.tm-countdown.skin-light .number,
				.cs-countdown .number,
				.page-template-maintenance .maintenance-title,
				.tm-grid-wrapper .btn-filter:hover .filter-text, .tm-grid-wrapper .btn-filter.current .filter-text, 
				.tm-blog .post-read-more .btn-icon,
				.tm-blog .post-read-more:hover .btn-text,
				.tm-blog.style-list .post-title a:hover,
				.tm-blog.style-list .post-categories,
				.tm-blog.style-list .post-item .post-link a:hover,
				.tm-blog.style-grid .post-title a:hover,
				.tm-blog.style-grid .post-categories,
				.tm-blog.style-grid_feature .post-title a:hover,
				.tm-blog.style-grid_feature .post-categories,
				.tm-blog.style-grid_feature .post-link a:hover,
				.tm-blog.style-grid_classic .post-title a:hover,
				.tm-blog.style-grid_classic .post-categories,
				.tm-blog.style-grid_classic .post-link a:hover,
				.tm-blog.style-grid_simple .post-title a:hover,
				.tm-blog.style-grid_simple .post-categories,
				.tm-blog.style-grid_classic .comment-icon,
				.tm-blog.style-carousel .post-title a:hover,
				.tm-blog.style-carousel .post-categories,
				.tm-blog.style-magazine .post-title a:hover,
				.tm-blog.style-magazine .post-categories,
				.tm-blog.style-metro .post-title a:hover,
				.tm-blog.style-metro .post-categories,
				.tm-blog.style-grid_left_image .post-title a:hover,
				.tm-blog.style-grid_left_image .post-categories,
				.tm-blog.style-grid_flip_box .front .post-categories,
				.tm-blog.style-grid_modern .post-title a:hover,
				.tm-blog.style-grid_modern .post-categories,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay-categories,
				.tm-portfolio [data-overlay-animation='modern'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='modern'] .post-overlay-categories,
				.tm-portfolio [data-overlay-animation='zoom'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='zoom'] .post-overlay-categories,
				.tm-portfolio [data-overlay-animation='zoom2'] .post-overlay-title a:hover,
				.tm-portfolio [data-overlay-animation='zoom2'] .post-overlay-categories,
				.tm-portfolio.style-full-wide-slider .post-overlay-categories,
				.tm-portfolio.style-full-wide-slider .post-overlay-title a:hover,
				.page-template-portfolio-fullscreen-slider .portfolio-categories,
				.page-template-portfolio-fullscreen-slider .portfolio-title a:hover,
				.page-template-portfolio-fullscreen-split-slider .portfolio-categories,
				.page-template-portfolio-fullscreen-split-slider .portfolio-title a:hover,
				.page-template-portfolio-fullscreen-split-slider .tm-social-network a:hover,
				.page-template-portfolio-fullscreen-split-slider-2 .portfolio-categories,
				.page-template-portfolio-fullscreen-split-slider-2 .portfolio-title a:hover,
				.page-template-portfolio-fullscreen-slider-center .portfolio-categories,
				.page-template-portfolio-fullscreen-slider-center .portfolio-title a:hover,
				.tm-accordion .accordion-section.active .accordion-title,
				.tm-accordion .accordion-title:hover,
				.tm-pricing.style-3 .price,
				.tm-twitter .tweet:before,
				.page-template-one-page-scroll[data-row-skin='dark'] #fp-nav ul li .fp-tooltip,
				.page-content .widget a:hover,
				.single-portfolio .portfolio-categories,
				.single-portfolio .post-share a:hover,
				.single-portfolio .portfolio-link a:hover,
				.single-portfolio .related-post-item .post-overlay-categories,
				.single-portfolio .related-portfolio-wrap .post-overlay-title a:hover,
				.single-post .post-categories,
				.single-post .page-main-content .post-tags a:hover,
				.single-post .related-posts .related-post-title a:hover,
				.single-post .blog-header-image .insight_core_breadcrumb a:hover,
				.search-results .page-main-content .search-form .search-submit:hover, .search-no-results .page-main-content .search-form .search-submit:hover,
				.gmap-marker-content,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-title>a,
				.widget_search .search-submit:hover i, .widget_product_search .search-submit:hover i,
				.comment-list .comment-datetime:before { 
					color: {$color} 
				}";

			// Color Important.
			$css .= ".primary-color-important,
				.primary-color-hover-important:hover,
				.widget_categories a:hover, .widget_categories .current-cat-ancestor > a, .widget_categories .current-cat-parent > a, .widget_categories .current-cat > a {
					color: {$color}!important;
				}";

			// Background Color.
			$css .= ".primary-background-color,
				.lg-progress-bar .lg-progress,
				.tm-swiper.nav-style-4 .swiper-nav-button,
				.tm-button.style-flat.tm-button-primary,
				.tm-button.style-flat.tm-button-secondary:hover,
				.tm-button.style-outline.tm-button-primary:hover,
				.tm-team-member.style-1 .info-footer:after,
				.tm-social-networks.style-icons-with-border .link:hover,
				.tm-gradation .count, .tm-gradation .count-wrap:before, .tm-gradation .count-wrap:after,
				.tm-popup-video.style-poster .video-play,
				.tm-popup-video.style-poster-2 .video-play,
				.tm-popup-video.style-button .video-play,
				.tm-popup-video.style-button-4 .video-play,
				.tm-pricing.style-3.tm-pricing-featured .inner,
				.tm-timeline ul li:after,
				.tm-box-icon.style-6:hover .content-wrap,
				.tm-box-icon.style-7:hover .content-wrap,
				.tm-info-boxes.style-metro .grid-item.skin-primary,
				.tm-info-boxes.style-grid .box-info-wrapper:hover .box-info,
				.tm-blog.style-grid_flip_box .back .content-wrap:before,
				.tm-swiper.pagination-style-3 .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
				.tm-contact-form-7.skin-light .wpcf7-submit:hover,
				.tm-mailchimp-form.style-3 button:hover,
				.tm-accordion .accordion-title:after,
				.tm-grid-wrapper .btn-filter:hover .filter-text:after, .tm-grid-wrapper .btn-filter.current .filter-text:after,
				.single-portfolio .swiper-nav-button:hover,
				.scrollup,
				.maintenance-progress-bar,
				.maintenance-progress:before,
				.page-loading .sk-child,
				.page-preloader .object,
				.portfolio-details-gallery .gallery-item .overlay,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-moody-04 .vc_active .vc_tta-icon,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-tab>a,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-tabs.vc_tta-color-primary.vc_tta-style-modern .vc_tta-tab > a,
				.vc_tta-color-primary.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-tab>a,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:focus,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:focus,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:hover {
					background-color: {$color};
				}";

			$css .= ".primary-background-color-important,
				.primary-background-color-hover-important:hover,
				.mejs-controls .mejs-time-rail .mejs-time-current {
					background-color: {$color}!important;
				}";

			$css .= ".primary-border-color,
				.page-template-portfolio-fullscreen-split-slider #multiscroll-nav .active span,
				.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover,
				.tm-button.style-outline.tm-button-primary,
				.tm-contact-form-7.skin-light .wpcf7-submit,
				.tm-social-networks.style-icons-with-border .link:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-moody-04 .vc_active .vc_tta-icon,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-controls-icon::after,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-controls-icon::before,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::after,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::before,
				.vc_tta-tabs.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab > a,
				.tagcloud a:hover {
					border-color: {$color};
				}";


			$css .= ".primary-border-color-important,
				.primary-border-color-hover-important:hover {
					border-color: {$color}!important;
				}";

			$css .= ".tm-grid-wrapper .filter-counter:before {
					border-top-color: {$color};
				}";

			$css .= ".page-popup-search .search-field:-webkit-autofill {
				-webkit-text-fill-color: {$color};
			}";

			$css .= ".popup-search-opened .page-popup-search .search-field,
			.tm-box-icon.style-7 .content-wrap
			{
				border-bottom-color: {$color};
			}";

			$css .= ".tm-blockquote.style-3.skin-light path,
			.tm-testimonial.style-6 svg{
				fill: {$color};
			}";

			$css .= ".tm-box-icon.style-6 .tm-svg *,
			.tm-box-icon.style-7 .tm-svg *
			{
				stroke: {$color};
			}";

			$css .= ".tm-info-boxes.style-grid .box-info-wrapper:hover .box-info,
			.tm-blog.style-grid_flip_box .tm-rotate-box .back,
			.tm-box-icon.style-6:hover .content-wrap
			{
				box-shadow: -6px 12px 20px {$alpha17};
			}";

			if ( class_exists( 'WooCommerce' ) ) {
				$css .= ".woocommerce .cart.shop_table .amount,
				.woocommerce .cart-collaterals .amount,
				.woocommerce .cart.shop_table td.product-subtotal,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce input.button.alt, .button,
				.woocommerce .cart_list.product_list_widget a,
				.woocommerce ul.product_list_widget li .product-title:hover,
				.woocommerce.single-product div.product form.cart label,
				.woocommerce .cart.shop_table td.product-name a,
				.woocommerce table.woocommerce-checkout-review-order-table .amount,
				.woocommerce.single-product div.product .in-stock,
				.woocommerce.single-product div.product .product-meta a:hover,
				.woocommerce.single-product div.product .post-share .product-sharing-list a:hover {
					color: {$color}
				}";

				$css .= ".widget_product_categories a:hover, .widget_product_categories .current-cat-ancestor > a, .widget_product_categories .current-cat-parent > a, .widget_product_categories .current-cat > a
				{
					color: {$color}!important;
				}";

				$css .= ".tm-product [data-overlay-animation='faded'] .product-overlay,
				.mini-cart .mini-cart-icon:after,
				.woocommerce .cats .product-category:hover .cat-text,
				.woocommerce .products div.product .product-overlay,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce .widget_price_filter .price_slider_amount .button:hover,
				.woocommerce.single-product div.product .single_add_to_cart_button:hover,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover { 
					background-color: {$color}; 
				}";

				$css .= ".woocommerce.single-product div.product .in-stock,
				.woocommerce.single-product div.product .single_add_to_cart_button:hover,
				.woocommerce.single-product div.product .images .thumbnails .item img:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover {
					border-color: {$color};
				}";

				$css .= "
				.mini-cart .widget_shopping_cart_content,
				.woocommerce.single-product div.product .woocommerce-tabs ul.tabs li.active {
					border-bottom-color: {$color};
				}";
			}

			return $css;
		}

		function secondary_color_css() {
			$color = Insight::setting( 'secondary_color' );

			// Color.
			$css = ".secondary-color,
				.tm-button.style-outline.tm-button-secondary,
				.tm-button.style-text.tm-button-secondary .button-icon,
				.tm-button.style-text.tm-button-secondary:hover,
				.tm-drop-cap.style-1 .drop-cap,
				.tm-pricing.style-1 .price, .tm-pricing.style-1 .period,
				.tm-pricing.style-2 .price, .tm-pricing.style-2 .period,
				.tm-twitter a,
				.page-content .widget .tm-twitter a,
				.tm-info-boxes.style-metro .grid-item.skin-primary .box-title,
				.tm-blog.style-list .post-categories a:hover,
				.tm-blog.style-list .post-item .post-link a,
				.tm-blog.style-list .post-categories a:hover,
				.tm-blog.style-grid_feature .post-link a,
				.tm-blog.style-grid_feature .post-categories a:hover,
				.tm-blog.style-grid_classic .post-categories a:hover,
				.tm-blog.style-grid_simple .post-categories a:hover,
				.tm-blog.style-magazine .post-categories a:hover,
				.tm-blog.style-grid_left_image .post-categories a:hover,
				.tm-blog.style-grid_modern .post-categories a:hover,
				.tm-portfolio [data-overlay-animation='zoom'] .post-overlay-categories a:hover,
				.tm-portfolio [data-overlay-animation='zoom2'] .post-overlay-categories a:hover,
				.tm-portfolio.style-full-wide-slider .post-overlay-categories a:hover,
				.skin-secondary .wpcf7-text.wpcf7-text, .skin-secondary .wpcf7-textarea,
				.tm-menu .menu-price,
				.wpb-js-composer .vc_tta-style-moody-01 .vc_tta-tab,
				.wpb-js-composer .vc_tta-style-moody-03 .vc_tta-tab,
				.page-content .tm-custom-menu.style-1 .menu a:hover,
				.page-template-portfolio-fullscreen-split-slider-2 .portfolio-categories a:hover,
				.single-post .post-categories a:hover,
				.single-post .page-main-content .post-tags span,
				.single-portfolio .portfolio-link a,
				.single-portfolio .portfolio-categories a:hover,
				.tm-view-demo-icon .item-icon,
				.menu--primary .menu-item-feature,
				.gmap-marker-title,
				.page-links > a,
				.comment-nav-links li a, .comment-nav-links li span,
				.page-pagination li a, .page-pagination li span { 
					color: {$color} 
				}";

			// Color Important.
			$css .= ".secondary-color-important,
				.secondary-color-hover-important:hover {
					color: {$color}!important;
				}";

			// Background Color.
			$css .= ".secondary-background-color,
				.page-loading,
				.page-popup-search,
				.page-close-mobile-menu i, .page-close-mobile-menu i:before, .page-close-mobile-menu i:after,
				.animated-dot .middle-dot,
				.animated-dot div[class*='signal'],
				.tm-gallery .overlay,
				.tm-grid-wrapper .filter-counter,
				.tm-blog.style-list .post-quote,
				.tm-blog.style-grid .post-overlay,
				.tm-blog.style-carousel .post-overlay,
				.tm-blog.style-grid_feature .post-quote,
				.tm-blog.style-grid_classic .format-quote,
				.tm-blog.style-magazine .post-thumbnail,
				.tm-blog.style-metro .post-thumbnail,
				.tm-drop-cap.style-2 .drop-cap,
				.tm-info-boxes.style-metro .grid-item.skin-secondary,
				.tm-button.style-flat.tm-button-primary:hover,
				.tm-button.style-flat.tm-button-secondary,
				.tm-button.style-outline.tm-button-secondary:hover,
				.tm-blockquote.skin-dark,
				.tm-view-demo .overlay-content,
				.tm-mailchimp-form.style-3 button,
				.tm-swiper.nav-style-4 .swiper-nav-button:hover,
				.wpb-js-composer .vc_tta-style-moody-01 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta-style-moody-03 .vc_tta-tab.vc_active > a,
				.page-template-fullscreen-split-feature .tm-social-network a span:after,
				.single-post .post-feature .post-link,
				.single-post .post-feature .post-quote,
				.page-links > span, .page-links > a:hover, .page-links > a:focus,
				.comment-nav-links li a:hover, .comment-nav-links li a:focus, .comment-nav-links li .current,
				.page-pagination li a:hover, .page-pagination li a:focus, .page-pagination li .current {
					background-color: {$color};
				}";

			$css .= ".secondary-background-color-important,
				.secondary-background-color-hover-important:hover {
					background-color: {$color}!important;
				}";

			// Border.
			$css .= ".secondary-border-color,
				.tm-button.style-outline.tm-button-secondary,
				.tm-button.style-text span,
				.tm-blog.style-grid .post-item:hover,
				.tm-blog.style-carousel .post-item:hover,
				.page-links > span, .page-links > a:hover, .page-links > a:focus,
				.comment-nav-links li a:hover, .comment-nav-links li a:focus, .comment-nav-links li .current,
				.page-pagination li a:hover, .page-pagination li a:focus, .page-pagination li .current {
					border-color: {$color};
				}";


			// Border Important.
			$css .= ".secondary-border-color-important,
				.secondary-border-color-hover-important:hover,
				#fp-nav ul li a.active span, .fp-slidesNav ul li a.active span {
					border-color: {$color}!important;
				}";


			// Border Top.
			$css .= ".wpb-js-composer .vc_tta-style-moody-01 .vc_tta-tab.vc_active:after {
					border-top-color: {$color};
				}";

			$css .= ".wpb-js-composer .vc_tta-style-moody-03 .vc_tta-tab.vc_active:after {
				border-left-color: {$color};
			}";

			// Border Bottom.
			$css .= ".wpb-js-composer .vc_tta-style-moody-02 .vc_tta-tab.vc_active,
				.header04 .navigation .menu__container > .current-menu-item > a > .menu-item-title,
				.header04 .navigation .menu__container > li > a:hover > .menu-item-title {
					border-bottom-color: {$color};
				}";

			// Fill.
			$css .= ".tm-blockquote.skin-light path{
				fill: {$color};
			}";

			if ( class_exists( 'WooCommerce' ) ) {
				$css .= ".woocommerce nav.woocommerce-pagination ul li span, .woocommerce nav.woocommerce-pagination ul li a,
				.woocommerce-Price-amount, .amount, .woocommerce div.product p.price, .woocommerce div.product span.price,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .button:hover,
				.woocommerce-Price-amount, .amount, .woocommerce div.product p.price, .woocommerce div.product span.price {
					color: {$color}
				}";

				$css .= ".woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.woocommerce .widget_price_filter .price_slider_amount .button { 
					background-color: {$color}; 
				}";

				$css .= ".woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce input.button.alt, .button {
					border-color: {$color};
				}";

				$css .= "
				body.woocommerce-cart table.cart td.actions .coupon .input-text,
				.woocommerce .select2-container .select2-choice {
					border-bottom-color: {$color};
				}";
			}

			return $css;
		}

		function light_gallery_css() {
			$css                    = '';
			$primary_color          = Insight::setting( 'primary_color' );
			$secondary_color        = Insight::setting( 'secondary_color' );
			$cutom_background_color = Insight::setting( 'light_gallery_custom_background' );
			$background             = Insight::setting( 'light_gallery_background' );

			$tmp = '';

			if ( $background === 'primary' ) {
				$tmp .= "background-color: {$primary_color} !important;";
			} elseif ( $background === 'secondary' ) {
				$tmp .= "background-color: {$secondary_color} !important;";
			} else {
				$tmp .= "background-color: {$cutom_background_color} !important;";
			}

			$css .= ".lg-backdrop { $tmp }";

			return $css;
		}

		function get_typo_css( $typography ) {
			$css = '';

			if ( ! empty( $typography ) ) {
				foreach ( $typography as $attr => $value ) {
					if ( $attr === 'subsets' ) {
						continue;
					}
					if ( $attr === 'font-family' ) {
						$css .= "{$attr}: \"{$value}\", Helvetica, Arial, sans-serif;";
					} elseif ( $attr === 'variant' ) {
						$css .= "font-weight: {$value};";
					} else {
						$css .= "{$attr}: {$value};";
					}
				}
			}

			return $css;
		}
	}

	new Insight_Custom_Css();
}
