<?php
$section  = 'color_';
$priority = 1;
$prefix   = 'color_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'primary_color',
	'label'       => esc_html__( 'Primary Color', 'tm-moody' ),
	'description' => esc_html__( 'A light color.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'secondary_color',
	'label'       => esc_html__( 'Secondary Color', 'tm-moody' ),
	'description' => esc_html__( 'A dark color.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
) );
