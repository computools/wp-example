<?php
if ( ! class_exists( 'TM_DateTime_Picker' ) ) {
	class TM_DateTime_Picker {

		function __construct() {
			if ( class_exists( 'WpbakeryShortcodeParams' ) ) {
				WpbakeryShortcodeParams::addField( 'datetimepicker', array( $this, 'datetimepicker' ) );
			}
		}

		function datetimepicker( $settings, $value ) {
			$dependency = '';
			$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
			$type       = isset( $settings['type'] ) ? $settings['type'] : '';
			$class      = isset( $settings['class'] ) ? $settings['class'] : '';
			$settings   = isset( $settings['settings'] ) ? $settings['settings'] : array();

			$uni = uniqid( 'datetimepicker-' . rand() );

			$output = '<div class="">';
			$output .= '<input id="datetimepicker-' . $uni . '" name="' . $param_name . '" value="' . $value . '" type="text" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" />';
			$output .= '</div>';
			$output .= '<script>
							jQuery("#datetimepicker-' . $uni . '").datetimepicker( ' . wp_json_encode( $settings ) . ' );
						</script>';

			return $output;
		}

	}

	new TM_DateTime_Picker();
}
