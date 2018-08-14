<?php
$panel    = 'portfolio';
$priority = 1;

Insight_Kirki::add_section( 'archive_portfolio', array(
	'title'    => esc_html__( 'Portfolio Archive', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Portfolio Single', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_slider', array(
	'title'    => esc_html__( 'Fullscreen Slider Template', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_center_slider', array(
	'title'    => esc_html__( 'Fullscreen Center Slider Template', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_split_slider', array(
	'title'    => esc_html__( 'Fullscreen Split Slider Template', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_split_slider_2', array(
	'title'    => esc_html__( 'Fullscreen Split Slider 2 Template', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
