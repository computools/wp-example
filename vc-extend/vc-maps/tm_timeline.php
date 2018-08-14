<?php

class WPBakeryShortCode_TM_Timeline extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Timeline', 'tm-moody' ),
	'base'                      => 'tm_timeline',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-timeline',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'    => esc_html__( 'Image', 'tm-moody' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Title', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Time', 'tm-moody' ),
					'type'       => 'textfield',
					'param_name' => 'time',
				),
				array(
					'heading'    => esc_html__( 'Text', 'tm-moody' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
			),

		),
	),
) );
