<?php
$section  = 'archive_portfolio';
$priority = 1;
$prefix   = 'archive_portfolio_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_style',
	'label'       => esc_html__( 'Portfolio Style', 'tm-moody' ),
	'description' => esc_html__( 'Select portfolio style that display for archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'1' => esc_attr__( 'Grid Classic', 'tm-moody' ),
		'2' => esc_attr__( 'Grid Metro', 'tm-moody' ),
		'3' => esc_attr__( 'Grid Masonry', 'tm-moody' ),
		'4' => esc_attr__( 'Carousel Slider', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_thumbnail_size',
	'label'    => esc_html__( 'Thumbnail Size', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'insight-grid-classic',
	'choices'  => array(
		'insight-grid-classic'        => esc_attr__( '500x675', 'tm-moody' ),
		'insight-grid-classic-2'      => esc_attr__( '600x463', 'tm-moody' ),
		'insight-grid-classic-square' => esc_attr__( '600x600', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_columns',
	'label'    => esc_html__( 'Columns', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '3',
	'choices'  => array(
		'2' => esc_attr__( '2 Columns', 'tm-moody' ),
		'3' => esc_attr__( '3 Columns', 'tm-moody' ),
		'4' => esc_attr__( '4 Columns', 'tm-moody' ),
		'5' => esc_attr__( '5 Columns', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_overlay_style',
	'label'    => esc_html__( 'Columns', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'faded',
	'choices'  => array(
		'none'  => esc_attr__( 'None', 'tm-moody' ),
		'zoom'  => esc_attr__( 'Image zoom - content below', 'tm-moody' ),
		'faded' => esc_attr__( 'Faded', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_animation',
	'label'       => esc_html__( 'CSS Animation', 'tm-moody' ),
	'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'scale-up',
	'choices'     => array(
		'none'             => esc_attr__( 'None', 'tm-moody' ),
		'fade-in'          => esc_attr__( 'Fade In', 'tm-moody' ),
		'move-up'          => esc_attr__( 'Move Up', 'tm-moody' ),
		'scale-up'         => esc_attr__( 'Scale Up', 'tm-moody' ),
		'fall-perspective' => esc_attr__( 'Fall Perspective', 'tm-moody' ),
		'fly'              => esc_attr__( 'Fly', 'tm-moody' ),
		'flip'             => esc_attr__( 'Flip', 'tm-moody' ),
		'helix'            => esc_attr__( 'Helix', 'tm-moody' ),
		'pop-up'           => esc_attr__( 'Pop Up', 'tm-moody' ),
	),
) );
