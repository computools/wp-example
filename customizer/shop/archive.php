<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_archive_new_days',
	'label'       => esc_html__( 'New Badge (Days)', 'tm-moody' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'tm-moody' ),
		'1'  => esc_html__( '1 day', 'tm-moody' ),
		'2'  => esc_html__( '2 days', 'tm-moody' ),
		'3'  => esc_html__( '3 days', 'tm-moody' ),
		'4'  => esc_html__( '4 days', 'tm-moody' ),
		'5'  => esc_html__( '5 days', 'tm-moody' ),
		'6'  => esc_html__( '6 days', 'tm-moody' ),
		'7'  => esc_html__( '7 days', 'tm-moody' ),
		'8'  => esc_html__( '8 days', 'tm-moody' ),
		'9'  => esc_html__( '9 days', 'tm-moody' ),
		'10' => esc_html__( '10 days', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'tm-moody' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 12,
	'choices'     => array(
		'min'  => 1,
		'max'  => 30,
		'step' => 1,
	),
) );
