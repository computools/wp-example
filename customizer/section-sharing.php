<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'tm-moody' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array( 'facebook', 'twitter', 'linkedin', 'google_plus', 'tumblr', 'email' ),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'tm-moody' ),
		'twitter'     => esc_attr__( 'Twitter', 'tm-moody' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'tm-moody' ),
		'google_plus' => esc_attr__( 'Google+', 'tm-moody' ),
		'tumblr'      => esc_attr__( 'Tumblr', 'tm-moody' ),
		'email'       => esc_attr__( 'Email', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => $prefix . 'order',
	'label'       => esc_attr__( 'Order', 'tm-moody' ),
	'description' => esc_html__( 'Controls the order of social share links.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'facebook',
		'twitter',
		'google_plus',
		'tumblr',
		'linkedin',
		'email',
	),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'tm-moody' ),
		'twitter'     => esc_attr__( 'Twitter', 'tm-moody' ),
		'google_plus' => esc_attr__( 'Google+', 'tm-moody' ),
		'tumblr'      => esc_attr__( 'Tumblr', 'tm-moody' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'tm-moody' ),
		'email'       => esc_attr__( 'Email', 'tm-moody' ),
	),
) );
