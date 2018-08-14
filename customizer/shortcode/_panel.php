<?php
$panel    = 'shortcode';
$priority = 1;

Insight_Kirki::add_section( 'shortcode_animation', array(
	'title'    => esc_html__( 'CSS Animation', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
