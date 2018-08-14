<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup for customizer of this theme
 */
if ( ! class_exists( 'Insight_Customize' ) ) {
	class Insight_Customize {

		public function __construct() {
			// Build URL for customizer.
			add_filter( 'kirki/values/get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

			// Force load all variants and subsets.
			//add_action( 'after_setup_theme', array( $this, 'load_all_variants_and_subsets' ) );

			// Remove unused native sections and controls.
			add_action( 'customize_register', array( $this, 'remove_customizer_sections' ) );

			// Load customizer sections when all widgets init.
			add_action( 'init', array( $this, 'load_customizer' ), 99 );

			add_action( 'customize_controls_init', array(
				$this,
				'customize_preview_css',
			) );
		}

		/**
		 * Add customize preview css
		 */
		public function customize_preview_css() {
			wp_enqueue_style( 'kirki-custom-css', INSIGHT_THEME_URI . '/assets/admin/css/customizer.css' );
		}

		/**
		 * Load Customizer.
		 */
		public function load_customizer() {
			Insight::require_file( INSIGHT_THEME_DIR . DS . 'customizer/customizer.php' );
		}

		/**
		 * Remove unused native sections and controls
		 *
		 * @since 0.9.3
		 *
		 * @param $wp_customize
		 */
		public function remove_customizer_sections( $wp_customize ) {
			$wp_customize->remove_section( 'nav' );
			$wp_customize->remove_section( 'colors' );
			$wp_customize->remove_section( 'background_image' );
			$wp_customize->remove_section( 'header_image' );

			$wp_customize->get_section( 'title_tagline' )->priority = '100';

			$wp_customize->remove_control( 'blogdescription' );
			$wp_customize->remove_control( 'display_header_text' );
		}

		/**
		 * Force load all variants and subsets
		 *
		 * @since 0.9
		 */
		public function load_all_variants_and_subsets() {
			if ( class_exists( 'Kirki_Fonts_Google' ) ) {
				Kirki_Fonts_Google::$force_load_all_variants = true;
			}
		}

		/**
		 * Build URL for customizer
		 *
		 * @param $value
		 * @param $setting
		 *
		 * @return mixed
		 */
		public function kirki_db_get_theme_mod_value( $value, $setting ) {
			static $settings;
			static $count = 1;

			// Make preset in meta box.
			if ( ! is_customize_preview() && $count === 2 ) {
				$presets = apply_filters( 'insight_page_meta_box_presets', array() );
				if ( ! empty( $presets ) ) {
					foreach ( $presets as $preset ) {
						$page_preset_value = Insight_Helper::get_post_meta( $preset, '-1' );
						//if ( $page_preset_value && '-1' != $page_preset_value ) {
						$_GET[ $preset ] = $page_preset_value;
						//}
					}
				}
			}
			// Setup url.
			if ( is_null( $settings ) && $count == 2 ) {

				$settings = array();

				if ( ! empty( $_GET ) ) {
					foreach ( $_GET as $key => $query_value ) {
						if ( ! empty( Kirki::$fields[ $key ] ) ) {
							$settings[ $key ] = $query_value;

							if ( is_array( Kirki::$fields[ $key ] ) && 'kirki-preset' == Kirki::$fields[ $key ]['type'] && ! empty( Kirki::$fields[ $key ]['choices'] ) && ! empty( Kirki::$fields[ $key ]['choices'][ $query_value ] ) && ! empty( Kirki::$fields[ $key ]['choices'][ $query_value ]['settings'] ) ) {
								foreach ( Kirki::$fields[ $key ]['choices'][ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
									$settings[ $kirki_setting ] = $kirki_value;
								}
							}
						}
					}
				}
			}

			$count++;

			if ( isset ( $settings[ $setting ] ) ) {
				return $settings[ $setting ];
			}

			return $value;
		}

	}

	new Insight_Customize();
}
