<?php

class WPBakeryShortCode_TM_Restaurant_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Restaurant Menu', 'tm-moody' ),
	'base'                      => 'tm_restaurant_menu',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-restaurant-menu',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'description' => esc_html__( 'Select style for menu.', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( '01', 'tm-moody' ) => '1',
			),
			'admin_label' => true,
		),
		Insight_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Title', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Item Description', 'tm-moody' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Item Price', 'tm-moody' ),
					'type'       => 'textfield',
					'param_name' => 'price',
				),
				array(
					'heading'     => esc_html__( 'Badge', 'tm-moody' ),
					'type'        => 'dropdown',
					'param_name'  => 'badge',
					'value'       => array(
						esc_html__( 'None', 'tm-moody' ) => '',
						esc_html__( 'New', 'tm-moody' )  => 'new',
					),
					'admin_label' => true,
				),
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );
