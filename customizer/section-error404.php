<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'tm-moody' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Woops, looks like this page doesn\'t exist', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'error404_page_text',
	'label'       => esc_html__( 'Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display on error 404 page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'You could either go back or go to homepage', 'tm-moody' ),
) );
