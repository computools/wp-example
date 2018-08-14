<?php
$section  = 'portfolio_fullscreen_center_slider';
$priority = 1;
$prefix   = 'portfolio_fullscreen_center_slider_';

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
		'center',
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

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'left_column_text',
	'label'       => esc_html__( 'Left Column Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display on left column.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'info@thememove.com', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'right_column_text',
	'label'       => esc_html__( 'Right Column Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display on right column.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( '(102) 6666 8888', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'social_networks_enable',
	'label'       => esc_html__( 'Show Social Networks', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to display social networks on right column.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'copyright_text2',
	'label'       => esc_html__( 'Copyright Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display on left column.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( '(102) 6666 8888', 'tm-moody' ),
) );
