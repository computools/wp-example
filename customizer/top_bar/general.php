<?php
$section  = 'top_bar';
$priority = 1;
$prefix   = 'top_bar_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Visibility', 'tm-moody' ),
	'description' => esc_html__( 'Controls the visibility of top bar section.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'tm-moody' ),
		'1' => esc_html__( 'Show', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'style',
	'label'       => esc_html__( 'Style', 'tm-moody' ),
	'description' => esc_html__( 'Controls the default style of top bar.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => array(
		'01' => esc_html__( 'Style 01', 'tm-moody' ),
		'02' => esc_html__( 'Style 02', 'tm-moody' ),
	),
) );
