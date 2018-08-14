<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'page',
	'label'       => esc_html__( 'Footer', 'tm-moody' ),
	'description' => esc_html__( 'Select page as default footer.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'footer-01',
	'choices'     => Insight_Footer::get_list_footers(),
) );
