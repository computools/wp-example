<?php
$section  = 'portfolio_fullscreen_slider';
$priority = 1;
$prefix   = 'portfolio_fullscreen_slider_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'categories',
	'label'       => esc_html__( 'Filter By Cats', 'tm-moody' ),
	'description' => esc_html__( 'Select categories to filter by.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'multiple'    => 1000,
	'choices'     => Insight_Portfolio::get_categories(),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'tags',
	'label'       => esc_html__( 'Filter By Tags', 'tm-moody' ),
	'description' => esc_html__( 'Select tags to filter by.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'multiple'    => 1000,
	'choices'     => Insight_Portfolio::get_tags(),
	'default'     => array(
		'full-wide',
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'number',
	'label'       => esc_html__( 'Number portfolios', 'tm-moody' ),
	'description' => esc_html__( 'Controls the number of portfolios display on this template.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 10,
	'choices'     => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
) );
