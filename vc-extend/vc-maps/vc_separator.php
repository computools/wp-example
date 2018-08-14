<?php

vc_add_params( 'vc_separator', array(
	array(
		'heading'     => esc_html__( 'Position', 'tm-moody' ),
		'description' => esc_html__( 'Make the separator position absolute with column', 'tm-moody' ),
		'type'        => 'dropdown',
		'param_name'  => 'position',
		'value'       => array(
			esc_html__( 'None', 'tm-moody' )   => '',
			esc_html__( 'Top', 'tm-moody' )    => 'top',
			esc_html__( 'Bottom', 'tm-moody' ) => 'bottom',
		),
		'std'         => '',
	),
) );
