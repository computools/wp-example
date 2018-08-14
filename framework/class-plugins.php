<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin installation and activation for WordPress themes
 */
if ( ! class_exists( 'Insight_Register_Plugins' ) ) {
	class Insight_Register_Plugins {

		public function __construct() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins() {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'tm-moody' ),
					'slug'     => 'insight-core',
					'source'   => 'https://www.dropbox.com/s/bndt5usja93gu9j/insight-core-1.5.3.6.zip?dl=1',
					'version'  => '1.5.3.6',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Revolution Slider', 'tm-moody' ),
					'slug'     => 'revslider',
					'source'   => 'https://www.dropbox.com/s/1cqsrhnbymc5eac/revslider-5.4.8.zip?dl=1',
					'version'  => '5.4.8',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'WPBakery Page Builder', 'tm-moody' ),
					'slug'     => 'js_composer',
					'source'   => 'https://www.dropbox.com/s/rj50hc1dom5ul35/js_composer-5.5.2.zip?dl=1',
					'version'  => '5.5.2',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard', 'tm-moody' ),
					'slug'    => 'vc_clipboard',
					'source'  => 'https://www.dropbox.com/s/kixfch51gkna4j3/vc_clipboard-4.5.0.zip?dl=1',
					'version' => '4.5.0',
				),
				array(
					'name' => esc_html__( 'Contact Form 7', 'tm-moody' ),
					'slug' => 'contact-form-7',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'tm-moody' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'tm-moody' ),
					'slug' => 'woocommerce',
				),
				array(
					'name' => esc_html__( 'WP-PostViews', 'tm-moody' ),
					'slug' => 'wp-postviews',
				),
			);

			return $plugins;
		}

	}

	new Insight_Register_Plugins();
}
