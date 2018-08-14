<?php

class WPBakeryShortCode_TM_Pie_Chart extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		if ( isset( $atts['number_font_size'] ) ) {
			Insight_VC::get_responsive_css( array(
				'element' => "$selector .piecharts-number",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['number_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}
	}
}

$content_group = esc_html__( 'Content', 'tm-moody' );
$style_group   = esc_html__( 'Styling', 'tm-moody' );

vc_map( array(
	'name'                      => esc_html__( 'Pie Chart', 'tm-moody' ),
	'base'                      => 'tm_pie_chart',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-pie-chart',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Number', 'tm-moody' ),
			'description' => esc_html__( 'Controls the number you would like to display in pie chart.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'min'         => 1,
			'max'         => 100,
			'std'         => 75,
		),
		array(
			'heading'     => esc_html__( 'Circle Size', 'tm-moody' ),
			'description' => esc_html__( 'Controls the size of the pie chart circle. Default: 200', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'size',
			'suffix'      => 'px',
			'std'         => 180,
		),
		array(
			'heading'     => esc_html__( 'Measuring unit', 'tm-moody' ),
			'description' => esc_html__( 'Controls the unit of chart.', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'unit',
			'std'         => '%',
		),
		Insight_VC::extra_class_field(),
		array(
			'group'      => $content_group,
			'heading'    => esc_html__( 'Title', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'title',
		),
		array(
			'group'      => $content_group,
			'heading'    => esc_html__( 'Subtitle', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'subtitle',
		),
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Line Cap', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'line_cap',
			'value'      => array(
				esc_html__( 'Butt', 'tm-moody' )   => 'butt',
				esc_html__( 'Round', 'tm-moody' )  => 'round',
				esc_html__( 'Square', 'tm-moody' ) => 'square',
			),
			'std'        => 'round',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Line Width', 'tm-moody' ),
			'description' => esc_html__( 'Controls the line width of chart.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'line_width',
			'suffix'      => 'px',
			'min'         => 1,
			'max'         => 50,
			'std'         => 7,
		),
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Bar Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'bar_color',
			'value'      => array(
				esc_html__( 'Gradient Color', 'tm-moody' )  => 'gradient',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => 'gradient',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Custom Bar Color', 'tm-moody' ),
			'description' => esc_html__( 'Controls the color of bar', 'tm-moody' ),
			'type'        => 'colorpicker',
			'param_name'  => 'custom_bar_color',
			'dependency'  => array( 'element' => 'bar_color', 'value' => array( 'custom' ) ),
		),
		array(
			'group'      => $style_group,
			'heading'    => esc_html__( 'Track Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'track_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Custom Track Color', 'tm-moody' ),
			'description' => esc_html__( 'Controls the color of track for the bar', 'tm-moody' ),
			'type'        => 'colorpicker',
			'param_name'  => 'custom_track_color',
			'dependency'  => array( 'element' => 'track_color', 'value' => array( 'custom' ) ),
		),
		array(
			'group'       => $style_group,
			'heading'     => esc_html__( 'Number Font Size', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'number_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
	),
) );
