<?php

class WPBakeryShortCode_TM_Mailchimp_Form extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Mailchimp Form', 'tm-moody' ),
	'base'                      => 'tm_mailchimp_form',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Form Id', 'tm-moody' ),
			'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'form_id',
		),
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'tm-moody' ) => '1',
				esc_html__( '2', 'tm-moody' ) => '2',
				esc_html__( '3', 'tm-moody' ) => '3',
				esc_html__( '4', 'tm-moody' ) => '4',
			),
			'std'         => '1',
		),
		Insight_VC::extra_class_field(),
	),
) );
