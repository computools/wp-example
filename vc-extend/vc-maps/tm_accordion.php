<?php

class WPBakeryShortCode_TM_Accordion extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Accordion', 'tm-moody' ),
	'base'                      => 'tm_accordion',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-accordion',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'    => esc_html__( 'Multi Open', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'multi_open',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
		),
		Insight_VC::extra_class_field(),
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
					'heading'    => esc_html__( 'Content', 'tm-moody' ),
					'type'       => 'textarea',
					'param_name' => 'content',
				),
			),
		),
	),
) );
