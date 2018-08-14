<?php
$panel    = 'search';
$priority = 1;

Insight_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'search_popup', array(
	'title'    => esc_html__( 'Search Popup', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
