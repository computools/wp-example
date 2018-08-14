<?php
$section  = 'socials';
$priority = 1;
$prefix   = 'social_';
/*--------------------------------------------------------------
# Social links
--------------------------------------------------------------*/

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'social_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'tm-moody' ),
		'1' => esc_html__( 'Yes', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'repeater',
	'settings'    => 'social_link',
	'description' => wp_kses( __( 'You can find icon class <a target="_blank" href="http://fontawesome.io/cheatsheet/">here</a>.', 'tm-moody' ), array(
		'a' => array(
			'href'   => array(),
			'target' => array(),
		),
	) ),
	'section'     => $section,
	'priority'    => $priority++,
	'choices'     => array(
		'labels' => array(
			'add-new-row' => esc_html__( 'Add new social network', 'tm-moody' ),
		),
	),
	'row_label'   => array(
		'type'  => 'field',
		'field' => 'tooltip',
	),
	'default'     => array(
		array(
			'tooltip'    => esc_html__( 'Facebook', 'tm-moody' ),
			'icon_class' => 'fa-facebook',
			'link_url'   => 'https://facebook.com',
		),
		array(
			'tooltip'    => esc_html__( 'Twitter', 'tm-moody' ),
			'icon_class' => 'fa-twitter',
			'link_url'   => 'https://twitter.com',
		),
		array(
			'tooltip'    => esc_html__( 'Instagram', 'tm-moody' ),
			'icon_class' => 'fa-instagram',
			'link_url'   => 'https://www.instagram.com',
		),
		array(
			'tooltip'    => esc_html__( 'Dribbble', 'tm-moody' ),
			'icon_class' => 'fa-dribbble',
			'link_url'   => 'https://www.dribbble.com',
		),
	),
	'fields'      => array(
		'tooltip'    => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Tooltip', 'tm-moody' ),
			'description' => esc_html__( 'Enter your hint text for your icon', 'tm-moody' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Font Awesome Class', 'tm-moody' ),
			'description' => esc_html__( 'This will be the icon class for your link', 'tm-moody' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'tm-moody' ),
			'description' => esc_html__( 'This will be the link URL', 'tm-moody' ),
			'default'     => '',
		),
	),
) );
