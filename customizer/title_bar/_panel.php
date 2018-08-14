<?php
$panel    = 'title_bar';
$priority = 1;

Insight_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'title_bar_01', array(
	'title'    => esc_html__( 'Style 01', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'title_bar_02', array(
	'title'    => esc_html__( 'Style 02', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'title_bar_03', array(
	'title'    => esc_html__( 'Style 03', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'title_bar_04', array(
	'title'    => esc_html__( 'Style 04', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
