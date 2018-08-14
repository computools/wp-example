<?php
$panel    = 'header';
$priority = 1;

Insight_Kirki::add_section( 'header', array(
	'title'    => esc_html__( 'General', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'lg_header', array(
	'title'       => esc_html__( 'Large Device', 'tm-moody' ),
	'description' => esc_html__( 'Controls settings of header on large devices.', 'tm-moody' ),
	'panel'       => $panel,
	'priority'    => $priority++,
) );

Insight_Kirki::add_section( 'md_header', array(
	'title'       => esc_html__( 'Medium Device', 'tm-moody' ),
	'description' => esc_html__( 'Controls settings of header on medium devices.', 'tm-moody' ),
	'panel'       => $panel,
	'priority'    => $priority++,
) );

Insight_Kirki::add_section( 'sm_header', array(
	'title'       => esc_html__( 'Small Device', 'tm-moody' ),
	'description' => esc_html__( 'Controls settings of header on small devices.', 'tm-moody' ),
	'panel'       => $panel,
	'priority'    => $priority++,
) );

Insight_Kirki::add_section( 'xs_header', array(
	'title'       => esc_html__( 'Extra Small Device', 'tm-moody' ),
	'description' => esc_html__( 'Controls settings of header on extra small devices.', 'tm-moody' ),
	'panel'       => $panel,
	'priority'    => $priority++,
) );

Insight_Kirki::add_section( 'header_sticky', array(
	'title'    => esc_html__( 'Header Sticky', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
