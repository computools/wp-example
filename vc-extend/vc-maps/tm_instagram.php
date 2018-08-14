<?php

class WPBakeryShortCode_TM_Instagram extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		extract( $atts );
		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Instagram', 'tm-moody' ),
	'base'                      => 'tm_instagram',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-instagram',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid', 'tm-moody' ) => 'grid',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'User Name', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'username',
		),
		array(
			'heading'    => esc_html__( 'Number of items', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'number_items',
			'std'        => '6',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 10,
			'step'        => 1,
			'suffix'      => 'column (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'gutter',
		),
		array(
			'heading'    => esc_html__( 'Show overlay likes and comments', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'overlay',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Open links in a new tab.', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'link_target',
			'value'      => array(
				esc_html__( 'Yes', 'tm-moody' ) => '1',
			),
			'std'        => '1',
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
) );
