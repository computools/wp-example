<?php

class WPBakeryShortCode_TM_Counter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		$align = 'center';
		$skin  = $number_color = $custom_number_color = $text_color = $custom_text_color = $icon_color = $custom_icon_color = '';
		$tmp   = '';
		extract( $atts );

		$tmp .= "text-align: {$align}";

		if ( $skin === 'custom' ) {
			$number_tmp = $text_tmp = $icon_tmp = '';

			if ( $number_color === 'custom' ) {
				$number_tmp .= "color: $custom_number_color;";
			}

			if ( $number_tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector .number-wrap{ $number_tmp }";
			}

			if ( $text_color === 'custom' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector .text{ $text_tmp }";
			}

			if ( $icon_color === 'custom' ) {
				$icon_tmp .= "color: $custom_icon_color;";
			}

			if ( $icon_tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
			}
		}

		$insight_shortcode_lg_css .= "$selector { $tmp }";
		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Counter', 'tm-moody' ),
	'base'                      => 'tm_counter',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-counter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'tm-moody' ) => '1',
			),
			'std'         => '1',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Counter Animation', 'tm-moody' ),
			'param_name' => 'animation',
			'value'      => array(
				esc_html__( 'Counter Up', 'tm-moody' ) => 'counter-up',
				esc_html__( 'Odometer', 'tm-moody' )   => 'odometer',
			),
			'std'        => 'counter-up',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Left', 'tm-moody' )   => 'left',
				esc_html__( 'Center', 'tm-moody' ) => 'center',
				esc_html__( 'Right', 'tm-moody' )  => 'right',
			),
			'std'        => 'center',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Skin', 'tm-moody' ),
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Dark', 'tm-moody' )   => 'dark',
				esc_html__( 'Light', 'tm-moody' )  => 'light',
				esc_html__( 'Custom', 'tm-moody' ) => 'custom',
			),
			'std'         => 'dark',
		),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Number Color', 'tm-moody' ),
			'param_name' => 'number_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => 'primary_color',
			'dependency' => array(
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
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
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
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Icon Color', 'tm-moody' ),
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => 'custom',
			'dependency' => array(
				'element' => 'skin',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Custom Icon Color', 'tm-moody' ),
			'param_name'  => 'custom_icon_color',
			'description' => esc_html__( 'Controls the color of icon.', 'tm-moody' ),
			'dependency'  => array(
				'element' => 'icon_color',
				'value'   => array( 'custom' ),
			),
			'std'         => '#a9a9a9',
		),
		array(
			'group'       => esc_html__( 'Data', 'tm-moody' ),
			'heading'     => esc_html__( 'Number', 'tm-moody' ),
			'type'        => 'number',
			'admin_label' => true,
			'param_name'  => 'number',
		),
		array(
			'group'       => esc_html__( 'Data', 'tm-moody' ),
			'heading'     => esc_html__( 'Number Prefix', 'tm-moody' ),
			'description' => esc_html__( 'Prefix your number with a symbol or text.', 'tm-moody' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_prefix',
		),
		array(
			'group'       => esc_html__( 'Data', 'tm-moody' ),
			'heading'     => esc_html__( 'Number Suffix', 'tm-moody' ),
			'description' => esc_html__( 'Suffix your number with a symbol or text.', 'tm-moody' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'number_suffix',
		),
		array(
			'group'       => esc_html__( 'Data', 'tm-moody' ),
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Text', 'tm-moody' ),
			'admin_label' => true,
			'param_name'  => 'text',
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::icon_libraries( array( 'allow_none' => true ) ), Insight_VC::get_vc_spacing_tab() ),
) );
