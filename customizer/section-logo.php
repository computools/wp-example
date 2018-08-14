<?php
$section  = 'logo';
$priority = 1;
$prefix   = 'logo_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Default Logo', 'tm-moody' ),
	'description' => esc_html__( 'Choose default logo.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'logo_dark',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'tm-moody' ),
		'logo_light' => esc_html__( 'Light Logo', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_dark',
	'label'    => esc_html__( 'Dark Version', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => INSIGHT_THEME_URI . '/assets/images/logo.png',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'image',
	'settings' => 'logo_light',
	'label'    => esc_html__( 'Light Version', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => INSIGHT_THEME_URI . '/assets/images/logo_light.png',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Logo Width', 'tm-moody' ),
	'description' => esc_html__( 'Ex: 200px', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '60px',
	'output'      => array(
		array(
			'element'  => '.branding__logo img,
			.maintenance-header img
			',
			'property' => 'width',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Logo Padding', 'tm-moody' ),
	'description' => esc_html__( 'Ex: 30px 0px 30px 0px', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '20px',
		'right'  => '0px',
		'bottom' => '20px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.branding__logo img',
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sticky Logo', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'sticky_logo',
	'label'       => esc_html__( 'Logo', 'tm-moody' ),
	'description' => esc_html__( 'Select an image file for your sticky header logo.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/logo.png',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'sticky_logo_width',
	'label'       => esc_html__( 'Logo Width', 'tm-moody' ),
	'description' => esc_html__( 'Controls the width of sticky header logo. Ex: 120px', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '60px',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'width',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => 'sticky_logo_padding',
	'label'       => esc_html__( 'Logo Padding', 'tm-moody' ),
	'description' => esc_html__( 'Controls the padding of sticky header logo.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '18px',
		'right'  => '0px',
		'bottom' => '18px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Mobile Logo', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => 'mobile_logo_width',
	'label'       => esc_html__( 'Logo Width', 'tm-moody' ),
	'description' => esc_html__( 'Controls the width of mobile header logo. Ex: 120px', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '60px',
	'output'      => array(
		array(
			'element'  => '.page-mobile-menu-logo img',
			'property' => 'width',
		),
	),
) );
