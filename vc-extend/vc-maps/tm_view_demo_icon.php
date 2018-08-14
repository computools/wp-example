<?php

class WPBakeryShortCode_TM_View_Demo_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$spacing_tab = esc_html__( 'Design Options', 'tm-moody' );

vc_map( array(
	'name'                      => esc_html__( 'View Demo Icon', 'tm-moody' ),
	'base'                      => 'tm_view_demo_icon',
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
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-moody' ),
					'param_name'  => 'icon_linea',
					'value'       => 'icon-basic-accelerator',
					'settings'    => array(
						'emptyIcon'    => true,
						'type'         => 'linea',
						'iconsPerPage' => 400,
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-moody' ),
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
