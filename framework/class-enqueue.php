<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Insight_Enqueue' ) ) {
	class Insight_Enqueue {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array(
				$this,
				'enqueue',
			) );

			add_action( 'wp_enqueue_scripts', array(
				$this,
				'custom_css',
			) );

			// Add custom JS.
			add_action( 'wp_footer', array( $this, 'custom_js' ), 99 );

			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );
		}

		/**
		 * Enqueue scripts & styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$post_type   = get_post_type();
			$min         = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ? '' : '.min';
			$single_shop = false;

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Deregister font awesome from visual composer plugin.
			wp_deregister_style( 'font-awesome' );
			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			wp_register_style( 'font-linea', INSIGHT_THEME_URI . '/assets/fonts/linea/style.css', null, null );

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			wp_enqueue_style( 'insight-style', get_stylesheet_uri() );

			/*
			 * Begin Register scripts to be enqueued later using the wp_enqueue_script() function.
			 */

			wp_register_script( 'easing', INSIGHT_THEME_URI . '/assets/custom_libs/easing/jquery.easing.min.js', array( 'jquery' ), '1.3', true );
			wp_register_script( 'matchheight', INSIGHT_THEME_URI . '/assets/libs/matchHeight/jquery.matchHeight-min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_register_script( 'gmap3', INSIGHT_THEME_URI . '/assets/custom_libs/gmap3/gmap3.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_register_script( 'countdown', INSIGHT_THEME_URI . '/assets/libs/jquery.countdown/js/jquery.countdown.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_register_script( 'easy-pie-chart', INSIGHT_THEME_URI . '/assets/custom_libs/ease-pie-chart/jquery.easypiechart.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'typed', INSIGHT_THEME_URI . '/assets/js/typed.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'insight-pie-chart', INSIGHT_THEME_URI . '/assets/js/tm_pie_chart.js', array(
				'jquery',
				'waypoints',
			), null, true );

			wp_register_script( 'sticky-kit', INSIGHT_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
				'jquery',
				'insight-main',
			), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'smooth-scroll', INSIGHT_THEME_URI . '/assets/libs/smooth-scroll-for-web/SmoothScroll.min.js', array(
				'jquery',
			), '1.4.6', true );

			wp_register_script( 'firefly', INSIGHT_THEME_URI . '/assets/js/firefly.js', array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'odometer', INSIGHT_THEME_URI . '/assets/libs/odometer/odometer.min.js', array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'counter-up', INSIGHT_THEME_URI . '/assets/custom_libs/counterup/jquery.counterup.min.js', array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'counter', INSIGHT_THEME_URI . '/assets/js/tm_counter.js', array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'vivus', INSIGHT_THEME_URI . '/assets/js/vivus.min.js', array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'circle-progress', INSIGHT_THEME_URI . '/assets/js/circle-progress.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'insight-accordion', INSIGHT_THEME_URI . '/assets/js/accordion.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'tween-max', INSIGHT_THEME_URI . '/assets/js/TweenMax.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'panr', INSIGHT_THEME_URI . '/assets/js/jquery.panr.js', array(
				'jquery',
				'tween-max',
			), null, true );

			// Fix old WP version not register this script.
			if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
				wp_register_script( 'imagesloaded', INSIGHT_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
			}

			/*
			 * End register scripts
			 */

			if ( Insight::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', INSIGHT_THEME_URI . '/assets/js/headroom.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			}

			if ( Insight::setting( 'smooth_scroll_enable' ) ) {
				wp_enqueue_script( 'smooth-scroll' );
			}

			wp_enqueue_script( 'picturefill', INSIGHT_THEME_URI . '/assets/js/picturefill.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'lightgallery', INSIGHT_THEME_URI . '/assets/js/lg-full.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'matchheight' );
			wp_enqueue_script( 'jquery-smooth-scroll', INSIGHT_THEME_URI . '/assets/custom_libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'swiper-jquery', INSIGHT_THEME_URI . '/assets/custom_libs/swiper/js/swiper.jquery.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'isotope-masonry', INSIGHT_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'isotope-packery', INSIGHT_THEME_URI . '/assets/js/packery-mode.pkgd.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'waypoints', INSIGHT_THEME_URI . '/assets/libs/waypoints/jquery.waypoints.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'mousewheel', INSIGHT_THEME_URI . '/assets/js/jquery.mousewheel.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'smartmenus', INSIGHT_THEME_URI . '/assets/js/jquery.smartmenus.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'justifiedGallery', INSIGHT_THEME_URI . '/assets/custom_libs/justifiedGallery/jquery.justifiedGallery.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );

			$single_portfolio_sticky = Insight::setting( 'single_portfolio_sticky_detail_enable' );
			if ( is_singular() && $post_type === 'portfolio' && $single_portfolio_sticky === '1' ) {
				wp_enqueue_script( 'sticky-kit' );
			}

			if ( is_singular( 'product' ) ) {
				$single_shop = true;
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				if ( $post_type === 'post' ) {
					if ( Insight::setting( 'single_post_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} elseif ( $post_type === 'portfolio' ) {
					if ( Insight::setting( 'single_portfolio_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} else {
					wp_enqueue_script( 'comment-reply' );
				}
			}

			$maintenance_templates = Insight_Maintenance::get_maintenance_templates_dir();

			if ( is_page_template( $maintenance_templates ) ) {
				wp_enqueue_script( 'countdown' );
				wp_enqueue_script( 'insight-maintenance', INSIGHT_THEME_URI . '/assets/js/maintenance.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			}

			if ( is_page_template( 'templates/portfolio-fullscreen-split-slider.php' ) ) {
				wp_enqueue_script( 'multiscroll', INSIGHT_THEME_URI . '/assets/js/jquery.multiscroll.js', array(
					'jquery',
					'easing',
				), null, true );
				wp_enqueue_style( 'multiscroll', INSIGHT_THEME_URI . '/assets/custom_libs/multiscroll/jquery.multiscroll.min.css' );
			}

			if ( is_page_template( 'templates/portfolio-fullscreen-slider-center.php' ) ) {
				wp_enqueue_script( 'panr' );
			}

			wp_enqueue_script( 'wpb_composer_front_js' );

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'insight-main', INSIGHT_THEME_URI . '/assets/js/main.js', array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			if ( class_exists( 'WooCommerce' ) ) {
				wp_enqueue_script( 'insight-woo', INSIGHT_THEME_URI . '/assets/js/woo.js', array(
					'insight-main',
				), INSIGHT_THEME_VERSION, true );
			}

			if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
				wp_enqueue_script( 'full-page', INSIGHT_THEME_URI . '/assets/js/jquery.fullPage.js', array( 'jquery' ), null, true );
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'templateUrl'               => INSIGHT_THEME_URI,
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'primary_color'             => Insight::setting( 'primary_color' ),
				'header_sticky_enable'      => Insight::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Insight::setting( 'header_sticky_height' ),
				'footer_effect'             => Insight::setting( 'footer_effect' ),
				'scroll_top_enable'         => Insight::setting( 'scroll_top_enable' ),
				'light_gallery_auto_play'   => Insight::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Insight::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Insight::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Insight::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Insight::setting( 'light_gallery_thumbnail' ),
				'mobile_menu_breakpoint'    => Insight::setting( 'mobile_menu_breakpoint' ),
				'isSingleProduct'           => $single_shop,
				'like'                      => esc_html__( 'Like', 'tm-moody' ),
				'unlike'                    => esc_html__( 'Unlike', 'tm-moody' ),
			);
			wp_localize_script( 'insight-main', '$insight', $js_variables );
		}

		/**
		 * Enqueue custom style
		 */
		public function custom_css() {
			if ( Insight::setting( 'custom_css_enable' ) ) {
				wp_add_inline_style( 'insight-style', html_entity_decode( Insight::setting( 'custom_css' ), ENT_QUOTES ) );
			}
		}

		/**
		 * Load custom JS
		 */
		public function custom_js() {
			if ( Insight::setting( 'custom_js_enable' ) == 1 ) {
				echo '<script>' . html_entity_decode( Insight::setting( 'custom_js' ) ) . '</script>';
			}
		}
	}

	new Insight_Enqueue();
}
