<?php
$panel    = 'blog';
$priority = 1;

/*Insight_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );*/

Insight_Kirki::add_section( 'blog_single', array(
	'title'    => esc_html__( 'Blog Single Post', 'tm-moody' ),
	'panel'    => $panel,
	'priority' => $priority++,
) );
