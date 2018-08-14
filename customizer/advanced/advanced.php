<?php
$section  = 'advanced';
$priority = 1;
$prefix   = 'advanced_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'preloader_enable',
	'label'       => esc_html__( 'Preloader', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to enable preloader.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'smooth_scroll_enable',
	'label'       => esc_html__( 'Smooth Scroll', 'tm-moody' ),
	'description' => esc_html__( 'Smooth scrolling experience for websites.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'scroll_top_enable',
	'label'       => esc_html__( 'To top button', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to enable the to top button which adds the scrolling to top functionality.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'google_api_key',
	'label'       => esc_html__( 'Google Api Key', 'tm-moody' ),
	'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button.', 'tm-moody' ), array(
		'a'      => array(
			'href'   => array(),
			'target' => array(),
		),
		'strong' => array(),
	) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'AIzaSyDPRJ5WltWsdOPLeOVfbImGhuUrkd8KbJU',
	'transport'   => 'postMessage',
) );
