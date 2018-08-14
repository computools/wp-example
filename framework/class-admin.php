<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do nothing if not an admin page.
if ( ! is_admin() ) {
	return;
}

/**
 * Hook & filter that run only on admin pages.
 */
if ( ! class_exists( 'Insight_Admin' ) ) {
	class Insight_Admin {

		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		 * Enqueue scrips & styles.
		 *
		 * @access public
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'insight-admin', INSIGHT_THEME_URI . '/assets/admin/css/style.css' );
			$screen = get_current_screen();
			if ( $screen->id === 'nav-menus' ) {
				wp_enqueue_media();
				wp_enqueue_script( 'menu-image-hover', INSIGHT_THEME_URI . '/assets/admin/js/attach.js', array( 'jquery' ), null, true );
			}
		}

	}

	new Insight_Admin();
}
