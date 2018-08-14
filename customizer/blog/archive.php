<?php
$section  = 'blog_archive';
$priority = 1;
$prefix   = 'blog_archive_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'style',
	'label'       => esc_html__( 'Blog Style', 'tm-moody' ),
	'description' => esc_html__( 'Select blog style that display for archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'1' => esc_html__( 'Large Image', 'tm-moody' ),
		'2' => esc_html__( 'Grid Classic', 'tm-moody' ),
		'3' => esc_html__( 'Grid Masonry', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'columns',
	'label'       => esc_html__( 'Grid Layout Columns', 'tm-moody' ),
	'description' => esc_html__( 'Select columns for blog.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '2',
	'choices'     => array(
		'2' => esc_html__( '2 Columns', 'tm-moody' ),
		'3' => esc_html__( '3 Columns', 'tm-moody' ),
		'4' => esc_html__( '4 Columns', 'tm-moody' ),
	),
) );
