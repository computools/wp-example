<?php

class WPBakeryShortCode_TM_Pricing extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Pricing Table', 'tm-moody' ),
	'base'                      => 'tm_pricing',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-pricing',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'tm-moody' ) => '1',
				esc_html__( '02', 'tm-moody' ) => '2',
				esc_html__( '03', 'tm-moody' ) => '3',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Featured', 'tm-moody' ),
			'description' => esc_html__( 'Checked the box if you want make this item featured', 'tm-moody' ),
			'type'        => 'checkbox',
			'param_name'  => 'featured',
			'value'       => array( esc_html__( 'Yes', 'tm-moody' ) => 1 ),
			'std'         => 0,
		),
		array(
			'heading'    => esc_html__( 'Image', 'tm-moody' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
		array(
			'heading'     => esc_html__( 'Title', 'tm-moody' ),
			'type'        => 'textfield',
			'admin_label' => true,
			'param_name'  => 'title',
		),
		array(
			'heading'    => esc_html__( 'Price', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'price',
		),
		array(
			'heading'    => esc_html__( 'Currency', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'currency',
			'value'      => '$',
		),
		array(
			'heading'    => esc_html__( 'Period', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'period',
			'value'      => 'per monthly',
		),
		array(
			'heading'     => esc_html__( 'Description', 'tm-moody' ),
			'description' => esc_html__( 'Controls the text that display under price', 'tm-moody' ),
			'type'        => 'textarea',
			'param_name'  => 'desc',
		),
		array(
			'type'       => 'vc_link',
			'heading'    => esc_html__( 'Button', 'tm-moody' ),
			'param_name' => 'button',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Icon', 'tm-moody' ),
					'type'       => 'iconpicker',
					'param_name' => 'icon',
					'settings'   => array(
						'emptyIcon'    => true,
						'iconsPerPage' => 4000,
					),
					'value'      => '',
				),
				array(
					'heading'     => esc_html__( 'Text', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'text',
					'admin_label' => true,
				),
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );
