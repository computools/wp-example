<?php

vc_add_params( 'vc_single_image', array(
	array(
		'heading'    => esc_html__( 'Full Width', 'tm-moody' ),
		'type'       => 'checkbox',
		'param_name' => 'full_width',
	),
	array(
		'heading'    => esc_html__( 'Alignment on Tablet', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'tablet_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
			esc_html__( 'Left', 'tm-moody' )                       => 'left',
			esc_html__( 'Center', 'tm-moody' )                     => 'center',
			esc_html__( 'Right', 'tm-moody' )                      => 'right',
		),
		'std'        => '',
	),
	array(
		'heading'    => esc_html__( 'Alignment on Mobile', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'mobile_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
			esc_html__( 'Left', 'tm-moody' )                       => 'left',
			esc_html__( 'Center', 'tm-moody' )                     => 'center',
			esc_html__( 'Right', 'tm-moody' )                      => 'right',
		),
		'std'        => '',
	),
) );
