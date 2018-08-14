<?php
$section  = 'shortcode_animation';
$priority = 1;
$prefix   = 'shortcode_animation_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shortcode_animation_mobile_enable',
	'label'       => esc_html__( 'Mobile Animation', 'tm-moody' ),
	'description' => esc_html__( 'Controls the css animations on mobile & tablet.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'None', 'tm-moody' ),
		'1' => esc_html__( 'Yes', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_heading_css_animation',
	'label'    => esc_html__( 'Heading', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'move-down',
	'choices'  => Insight_Helper::get_animation_list(),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_button_css_animation',
	'label'    => esc_html__( 'Button', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'move-down',
	'choices'  => Insight_Helper::get_animation_list(),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_blog_css_animation',
	'label'    => esc_html__( 'Blog', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'move-up',
	'choices'  => Insight_Helper::get_animation_list(),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'shortcode_portfolio_css_animation',
	'label'    => esc_html__( 'Portfolio', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'move-up',
	'choices'  => Insight_Helper::get_animation_list(),
) );
