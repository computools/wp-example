<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 */
if ( ! class_exists( 'Insight_Functions' ) ) {
	class Insight_Functions {

		public function __construct() {
			add_action( 'wp_footer', array( $this, 'footer_template' ) );
			add_action( 'wp_footer', array( $this, 'mobile_menu_template' ) );

			// Add scroll top code to hook.
			add_action( 'insight/body', array( $this, 'scroll_top' ) );

			// Add popup search code to hook.
			add_action( 'insight/body', array( $this, 'popup_search' ) );
		}

		public function popup_search() {
			$search_popup_text = Insight::setting( 'search_popup_text' );
			?>
			<div id="page-popup-search" class="page-popup-search">
				<a id="popup-search-close" href="#" class="popup-search-close"><i class="icon-close"></i></a>
				<div class="page-popup-search-inner">
					<?php get_search_form(); ?>
					<p class="form-description"><?php echo esc_html( $search_popup_text ); ?></p>
				</div>
			</div>
			<?php
		}

		/**
		 * Add html to footer
		 */
		public function footer_template() {
			get_template_part( 'components/bodyhook' );
		}

		/**
		 * Add mobile to footer
		 */
		public function mobile_menu_template() {
			?>
			<div id="page-mobile-main-menu" class="page-mobile-main-menu">
				<div class="page-mobile-menu-header">
					<div class="page-mobile-menu-logo">
						<?php
						$logo_url = Insight::setting( 'logo_dark' );
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( $logo_url ); ?>"
							     alt="<?php esc_attr__( 'Logo', 'tm-moody' ) ?>"/>
						</a>
					</div>
					<div id="page-close-mobile-menu" class="page-close-mobile-menu">
						<div><i></i></div>
					</div>
				</div>
				<?php Insight::menu_mobile_primary(); ?>
			</div>
			<?php
		}

		/**
		 * Scroll to top JS
		 */
		public function scroll_top() {
			?>
			<?php if ( Insight::setting( 'scroll_top_enable' ) ) : ?>
				<a class="scrollup scrollup--fixed"><i class="fa fa-angle-up"></i></a>
			<?php endif; ?>
			<?php
		}

		/**
		 * Pass a PHP string to Javasript variable
		 **/
		public function esc_js( $string ) {
			return str_replace( "\n", '\n', str_replace( '"', '\"', addcslashes( str_replace( "\r", '', (string) $string ), "\0..\37" ) ) );
		}
	}

	new Insight_Functions();
}
