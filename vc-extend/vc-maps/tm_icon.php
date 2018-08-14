<?php

class WPBakeryShortCode_TM_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;

		$wrapper_tmp = $tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$insight_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$insight_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$insight_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $atts['icon_color'] === 'custom' ) {
			$tmp .= "color: {$atts['custom_icon_color']}; ";
		}

		if ( $wrapper_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector  { $wrapper_tmp }";
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .icon { $tmp }";
		}

		if ( isset( $atts['font_size'] ) ) {
			Insight_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		if ( isset( $atts['font_size'] ) ) {
			Insight_VC::get_responsive_css( array(
				'element' => "$selector .tm-svg",
				'atts'    => array(
					'width' => array(
						'media_str' => $atts['font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$params = array_merge( Insight_VC::icon_libraries( array(
	'admin_label'    => false,
	'allow_none'     => true,
	'group'          => '',
	'param_name'     => 'icon_type',
	'icon_libraries' => array(
		esc_html__( 'Font Awesome', 'tm-moody' ) => 'fontawesome',
		esc_html__( 'Simple Line', 'tm-moody' )  => 'simple_line',
		esc_html__( 'Linea', 'tm-moody' )        => 'linea',
	),
) ), array(
	array(
		'heading'     => esc_html__( 'Font Size', 'tm-moody' ),
		'type'        => 'number_responsive',
		'param_name'  => 'font_size',
		'min'         => 8,
		'suffix'      => 'px',
		'media_query' => array(
			'lg' => '',
			'md' => '',
			'sm' => '',
			'xs' => '',
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Icon Color', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'icon_color',
		'value'      => array(
			esc_html__( 'Default Color', 'tm-moody' )   => '',
			esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Icon Color', 'tm-moody' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_icon_color',
		'dependency' => array(
			'element' => 'icon_color',
			'value'   => 'custom',
		),
		'std'        => '#fff',
	),
	array(
		'heading'    => esc_html__( 'Icon Alignment', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'align',
		'value'      => array(
			esc_html__( 'Left', 'tm-moody' )   => 'left',
			esc_html__( 'Center', 'tm-moody' ) => 'center',
			esc_html__( 'Right', 'tm-moody' )  => 'right',
		),
		'std'        => 'left',
	),
	array(
		'heading'    => esc_html__( 'Icon Align on medium device', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'md_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
			esc_html__( 'Left', 'tm-moody' )                       => 'left',
			esc_html__( 'Center', 'tm-moody' )                     => 'center',
			esc_html__( 'Right', 'tm-moody' )                      => 'right',
		),
		'std'        => '',
	),
	array(
		'heading'    => esc_html__( 'Icon Align on small device', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'sm_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
			esc_html__( 'Left', 'tm-moody' )                       => 'left',
			esc_html__( 'Center', 'tm-moody' )                     => 'center',
			esc_html__( 'Right', 'tm-moody' )                      => 'right',
		),
		'std'        => '',
	),
	array(
		'heading'    => esc_html__( 'Icon Align on extra small device', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'xs_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
			esc_html__( 'Left', 'tm-moody' )                       => 'left',
			esc_html__( 'Center', 'tm-moody' )                     => 'center',
			esc_html__( 'Right', 'tm-moody' )                      => 'right',
		),
		'std'        => '',
	),
	Insight_VC::get_animation_field(),
	Insight_VC::extra_class_field(),
), Insight_VC::get_vc_spacing_tab() );

vc_map( array(
	'name'                      => esc_html__( 'Icon', 'tm-moody' ),
	'base'                      => 'tm_icon',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => $params,
) );
