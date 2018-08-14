<?php
$section  = 'portfolio_fullscreen_split_slider_2';
$priority = 1;
$prefix   = 'portfolio_fullscreen_split_slider_2_';

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
		'split-2',
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'number',
	'label'       => esc_html__( 'Number portfolios', 'tm-moody' ),
	'description' => esc_html__( 'Controls the number of portfolios display on this template.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 5,
	'choices'     => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
) );
