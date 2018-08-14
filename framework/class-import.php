<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initial OneClick import for this theme
 */
if ( ! class_exists( 'Insight_Import' ) ) {
	class Insight_Import {

		public function __construct() {
			add_filter( 'insight_core_import_demos', array( $this, 'import_demos' ) );
			add_filter( 'insight_core_import_generate_thumb', array( $this, 'import_generate_thumb' ) );
		}

		public function import_demos() {
			return array(
				'01' => array(
					'screenshot' => INSIGHT_THEME_URI . '/screenshot.jpg',
					'name'       => INSIGHT_THEME_NAME,
					'url'        => 'https://www.dropbox.com/s/x10hkrw8gn6sbgb/tm-moody-insightcore01-1.1.zip?dl=1',
				),
			);
		}

		/**
		 * Generate thumbnail while importing
		 */
		function import_generate_thumb() {
			return false;
		}
	}

	new Insight_Import();
}
