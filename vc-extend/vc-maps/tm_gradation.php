<?php

class WPBakeryShortCode_TM_Gradation extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Gradation', 'tm-moody' ),
	'base'                      => 'tm_gradation',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'list_style',
			'value'       => array(
				esc_html__( 'Basic', 'tm-moody' ) => 'basic',
			),
			'admin_label' => true,
			'std'         => 'basic',
		),
		array(
			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Title', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Description', 'tm-moody' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),

		),

	), Insight_VC::get_vc_spacing_tab() ),
) );
