<?php
/*
 * Example
    array(
        'type'       => 'radio_image',
        'heading'    => esc_html__( 'Style', 'tm-moody' ),
        'param_name' => 'style',
		'value' => array(
			'style1' => array(
				'url' => 'image_sample.png',
				'title' => 'Style 1',
			),
			'style2' => array(
				'url' => 'image_sample2.png',
				'title' => 'Style 2',
			),
		),
    ),
*/
if ( ! class_exists( 'Insight_VC_Radio_Image' ) ) {
	class Insight_VC_Radio_Image {

		private $settings = array();

		private $value = '';

		/**
		 *
		 * @param array  $settings
		 * @param string $value
		 */
		public function __construct( array $settings, $value ) {
			$this->settings = $settings;
			$this->value    = $value;
		}

		public function render() {
			$param_name = isset( $this->settings['param_name'] ) ? $this->settings['param_name'] : '';
			$values     = isset( $this->settings['value'] ) ? $this->settings['value'] : '';

			$output = '<div class="tm-image-radio">';
			foreach ( $values as $value => $label ) {
				$title = '';
				if ( is_array( $label ) ) {
					$title = 'class="hint--top hint-bounce" data-hint="' . $label['title'] . '" ';
					$label = $label['url'];
				}
				$radio_id    = uniqid( 'tm-image-radio-' );
				$checked     = ( $value == $this->value ) ? 'checked="checked"' : '';
				$selected    = ( $value == $this->value ) ? 'class="selected"' : '';
				$param_class = ( $value == $this->value ) ? 'class="wpb_vc_param_value"' : '';

				$output .= '<input type="radio" name="' . $param_name . '" id="' . $radio_id . '" ' . $checked . ' value="' . $value . '" ' . $param_class . ' />';
				$output .= '<label ' . $selected . ' for="' . $radio_id . '">';
				$output .= '<div ' . $title . ' ><img src="' . $label . '" /></div>';
				$output .= '</label>';
			}
			$output .= '</div>';

			return $output;
		}
	}
}

if ( class_exists( 'Insight_VC_Radio_Image' ) ) {

	function insight_vc_image_radio_settings_field( $settings, $value ) {

		$field = new Insight_VC_Radio_Image( $settings, $value );

		return $field->render();
	}

	WpbakeryShortcodeParams::addField( 'image_radio', 'insight_vc_image_radio_settings_field', INSIGHT_THEME_URI . '/vc-extend/vc-params/radio_image/scripts.js' );
}
