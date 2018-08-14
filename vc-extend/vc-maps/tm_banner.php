<?php

class WPBakeryShortCode_TM_Banner extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_lg_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Banner', 'tm-moody' ),
	'base'     => 'tm_banner',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-product-categories',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'tm-moody' ) => '1',
				esc_html__( '02', 'tm-moody' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'heading'    => esc_html__( 'Image', 'tm-moody' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'    => esc_html__( 'Text', 'tm-moody' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'heading'    => esc_html__( 'Button', 'tm-moody' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
) );
