<?php

class WPBakeryShortCode_TM_Twitter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		extract( $atts );
		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Twitter', 'tm-moody' ),
	'base'                      => 'tm_twitter',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-twitter',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'List', 'tm-moody' )   => 'list',
				esc_html__( 'Slider', 'tm-moody' ) => 'slider',
			),
			'std'         => 'slider',
		),
		array(
			'heading'    => esc_html__( 'Consumer Key', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_key',
		),
		array(
			'heading'    => esc_html__( 'Consumer Secret', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'consumer_secret',
		),
		array(
			'heading'    => esc_html__( 'Access Token', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'access_token',
		),
		array(
			'heading'    => esc_html__( 'Access Token Secret', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'access_token_secret',
		),
		array(
			'heading'    => esc_html__( 'Twitter Username', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'heading'    => esc_html__( 'Number of tweets', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'number_items',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
			'std'        => esc_html__( 'From Twitter', 'tm-moody' ),
		),
		array(
			'heading'    => esc_html__( 'Show date.', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'show_date',
			'value'      => array(
				esc_html__( 'Yes', 'tm-moody' ) => '1',
			),
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
) );
