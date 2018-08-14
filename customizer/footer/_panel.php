<?php
$panel    = 'footer';
$priority = 1;

Insight_Kirki::add_section( 'footer', array(
	'title'    => esc_html__( 'General', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
