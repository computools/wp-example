<?php
/**
 * Class ThemeMove_Number_Responsive
 *
 * @package ThemeMove
 */

if ( ! class_exists( 'ThemeMove_Number_Responsive' ) ) {
	class ThemeMove_Number_Responsive {

		private $settings = array();

		private $value = '';

		private $icons = array(
			'lg' => 'fa-desktop',
			'md' => 'fa-tablet fa-rotate-270',
			'sm' => 'fa-tablet',
			'xs' => 'fa-mobile',
		);

		/**
		 *
		 * @param array  $settings
		 * @param string $value
		 */
		public function __construct( array $settings, $value ) {
			$this->settings = $settings;
			$this->value    = $value;
		}

		/**
		 * @return array
		 */
		private function get_data() {

			if ( is_numeric( $this->value ) ) {
				$this->value = 'lg:' . $this->value;
			}

			if ( empty( $this->value ) && $this->settings['media_query'] && is_array( $this->settings['media_query'] ) ) {
				$this->value = $this->parse_default_value( $this->settings['media_query'] );
			}

			$data     = preg_split( '/;/', $this->value );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( ':', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$number           = $pieces[1];
					$data_arr[ $key ] = $number;
				}
			}

			return $data_arr;
		}

		private function get_number( $key ) {
			$data_arr = $this->get_data();

			foreach ( $data_arr as $key1 => $number ) {
				if ( $key == $key1 ) {
					return $number;
				}
			}

			return '';
		}

		private function parse_default_value( $media_queries = array() ) {

			$str = '';

			if ( ! empty( $media_queries ) ) {
				foreach ( $media_queries as $key => $value ) {
					$str .= $key . ':' . $value . ';';
				}
			}

			return $str;
		}

		public function render() {
			$param_name    = isset( $this->settings['param_name'] ) ? $this->settings['param_name'] : '';
			$min           = isset( $this->settings['min'] ) ? $this->settings['min'] : '';
			$max           = isset( $this->settings['max'] ) ? $this->settings['max'] : '';
			$step          = isset( $this->settings['step'] ) ? $this->settings['step'] : '';
			$suffix        = isset( $this->settings['suffix'] ) ? $this->settings['suffix'] : '';
			$media_queries = $this->settings['media_query'];

			$sizes = array(
				'lg' => esc_html__( 'Large', 'tm-moody' ),
				'md' => esc_html__( 'Medium', 'tm-moody' ),
				'sm' => esc_html__( 'Small', 'tm-moody' ),
				'xs' => esc_html__( 'Extra small', 'tm-moody' ),
			);

			$output = '<div class="tm_number_responsive" data-number-responsive="true">';
			$output .= '<input name="' . esc_attr( $param_name ) . '" class="wpb_vc_param_value ' . esc_attr( $param_name ) . ' ' . esc_attr( $this->settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $this->value ) . '"/>';
			$output .= '<div class="responsive_options">';
			foreach ( $media_queries as $key => $value ) {
				$icon   = '<i class="fa ' . $this->icons[ $key ] . '"></i>';
				$output .= $this->media_query_input( $icon, $sizes[ $key ], $key, $min, $max, $step );
			}

			$output .= '<span class="unit">' . $suffix . '</span>';
			$output .= '</div>';
			$output .= '</div>';

			return $output;
		}

		public function media_query_input( $icon, $tooltip, $key, $min, $max, $step ) {
			$html = '<div class="number_responsive_item tm_number">';
			$html .= '<label for="' . $key . '" class="hint--top hint-bounce" data-hint="' . $tooltip . '">' . $icon . "</label>";
			$html .= '<input id="' . $key . '" type="number" min="' . $min . '" max="' . $max . '" step="' . $step . '" class="' . $this->settings['type'] . '_field" value="' . $this->get_number( $key ) . '"/>';
			$html .= '<div class="buttons">';
			$html .= '<input type="button" value="+" class="plus" />';
			$html .= '<input type="button" value="-" class="minus" />';
			$html .= '</div>';
			$html .= '</div>';

			return $html;
		}
	}
}

if ( class_exists( 'ThemeMove_Number_Responsive' ) ) {

	function thememove_number_responsive_settings_field( $settings, $value ) {

		$number_responsive = new ThemeMove_Number_Responsive( $settings, $value );

		return $number_responsive->render();
	}

	WpbakeryShortcodeParams::addField( 'number_responsive', 'thememove_number_responsive_settings_field', INSIGHT_THEME_URI . '/vc-extend/vc-params/number_responsive/number_responsive.js' );
}
