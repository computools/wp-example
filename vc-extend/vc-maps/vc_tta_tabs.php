<?php
$_color_field                                                 = WPBMap::getParam( 'vc_tta_tabs', 'color' );
$_color_field['value'][ esc_html__( 'Primary', 'tm-moody' ) ] = 'primary';
$_color_field['std']                                          = 'primary';
vc_update_shortcode_param( 'vc_tta_tabs', $_color_field );

vc_update_shortcode_param( 'vc_tta_tabs', array(
	'param_name' => 'style',
	'value'      => array(
		esc_html__( 'Moody 01', 'tm-moody' ) => 'moody-01',
		esc_html__( 'Moody 02', 'tm-moody' ) => 'moody-02',
		esc_html__( 'Moody 03', 'tm-moody' ) => 'moody-03',
		esc_html__( 'Moody 04', 'tm-moody' ) => 'moody-04',
		esc_html__( 'Classic', 'tm-moody' )  => 'classic',
		esc_html__( 'Modern', 'tm-moody' )   => 'modern',
		esc_html__( 'Flat', 'tm-moody' )     => 'flat',
		esc_html__( 'Outline', 'tm-moody' )  => 'outline',
	),
) );
