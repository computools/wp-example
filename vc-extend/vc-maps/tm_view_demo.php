<?php

class WPBakeryShortCode_TM_View_Demo extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$spacing_tab = esc_html__( 'Design Options', 'tm-moody' );

vc_map( array(
	'name'                      => esc_html__( 'View Demo', 'tm-moody' ),
	'base'                      => 'tm_view_demo',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-iconbox',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		Insight_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Page', 'tm-moody' ),
					'type'        => 'autocomplete',
					'param_name'  => 'pages',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Image', 'tm-moody' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Category', 'tm-moody' ),
					'description' => esc_html__( 'Multi categories separator with comma', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'category',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Badge', 'tm-moody' ),
					'type'       => 'dropdown',
					'param_name' => 'badge',
					'value'      => array(
						esc_html__( 'None', 'tm-moody' ) => '',
						esc_html__( 'New', 'tm-moody' )  => 'new',
					),
					'std'        => '',
				),
			),
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Large Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'lg_spacing',
			'spacing_icon' => 'fa-desktop',
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Medium Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'md_spacing',
			'spacing_icon' => 'fa-tablet fa-rotate-270',
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Small Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'sm_spacing',
			'spacing_icon' => 'fa-tablet',
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Extra Small Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'xs_spacing',
			'spacing_icon' => 'fa-mobile',
		),
	),
) );
