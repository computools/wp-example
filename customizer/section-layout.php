<?php
$section  = 'layout';
$priority = 1;
$prefix   = 'site_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Layout', 'tm-moody' ),
	'description' => esc_html__( 'Controls the site layout.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'wide',
	'choices'     => array(
		'boxed' => esc_html__( 'Boxed', 'tm-moody' ),
		'wide'  => esc_html__( 'Wide', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Site Width', 'tm-moody' ),
	'description' => esc_html__( 'Controls the overall site width. Enter value including any valid CSS unit, ex: 1200px.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1200px',
) );
