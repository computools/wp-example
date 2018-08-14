<?php
$panel    = 'top_bar';
$priority = 1;

Insight_Kirki::add_section( 'top_bar', array(
	'title'    => esc_html__( 'General', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'top_bar_01', array(
	'title'    => esc_html__( 'Style 01', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'top_bar_02', array(
	'title'    => esc_html__( 'Style 02', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
