<?php
$section  = 'search_popup';
$priority = 1;
$prefix   = 'search_popup_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'text',
	'label'       => esc_html__( 'Search Popup Text', 'tm-moody' ),
	'description' => esc_html__( 'Enter the text that displays below search field in popup search.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Hit enter to search or ESC to close', 'tm-moody' ),
) );
