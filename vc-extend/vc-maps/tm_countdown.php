<?php

class WPBakeryShortCode_TM_CountDown extends WPBakeryShortCode {
	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		$skin = $number_color = $custom_number_color = $text_color = $custom_text_color = '';
		extract( $atts );

		if ( $skin === 'custom' ) {
			$number_tmp = $text_tmp = '';

			if ( $number_color === 'custom' ) {
				$number_tmp .= "color: $custom_number_color; border-color: $custom_number_color";
			}

			if ( $number_tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector .number{ $number_tmp }";
			}

			if ( $text_color === 'custom' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector .text{ $text_tmp }";
			}
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Countdown', 'tm-moody' ),
	'base'                      => 'tm_countdown',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-countdownclock',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'tm-moody' ) => '1',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Custom', 'tm-moody' ) => 'custom',
				esc_html__( 'Dark', 'tm-moody' )   => 'dark',
				esc_html__( 'Light', 'tm-moody' )  => 'light',
			),
			'std'         => 'dark',
		),
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Number Color', 'tm-moody' ),
			'param_name'       => 'number_color',
			'value'            => array(
				esc_html__( 'Default Color', 'tm-moody' ) => '',
				esc_html__( 'Primary Color', 'tm-moody' ) => 'primary_color',
				esc_html__( 'Custom Color', 'tm-moody' )  => 'custom',
			),
			'std'              => 'primary_color',
			'edit_field_class' => 'vc_col-sm-4',
			'dependency'       => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom Number Color', 'tm-moody' ),
			'param_name'  => 'custom_number_color',
			'description' => esc_html__( 'Controls the color of number.', 'tm-moody' ),
			'dependency'  => array(
				'element' => 'number_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text Color', 'tm-moody' ),
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' ) => '',
				esc_html__( 'Primary Color', 'tm-moody' ) => 'primary_color',
				esc_html__( 'Custom Color', 'tm-moody' )  => 'custom',
			),
			'std'        => 'custom',
			'dependency' => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom Text Color', 'tm-moody' ),
			'param_name'  => 'custom_text_color',
			'description' => esc_html__( 'Controls the color of text.', 'tm-moody' ),
			'dependency'  => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'         => '#a9a9a9',
		),
		array(
			'heading'     => esc_html__( 'Date Time', 'tm-moody' ),
			'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'tm-moody' ),
			'type'        => 'datetimepicker',
			'param_name'  => 'datetime',
			'value'       => '',
			'admin_label' => true,
			'settings'    => array(
				'minDate' => 0,
			),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Days" text', 'tm-moody' ),
			'param_name' => 'days',
			'value'      => esc_attr( 'Days', 'tm-moody' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Hours" text', 'tm-moody' ),
			'param_name' => 'hours',
			'value'      => 'Hours',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Minutes" text', 'tm-moody' ),
			'param_name' => 'minutes',
			'value'      => esc_attr( 'Minutes', 'tm-moody' ),
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( '"Seconds" text', 'tm-moody' ),
			'param_name' => 'seconds',
			'value'      => esc_attr( 'Seconds', 'tm-moody' ),
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
) );

