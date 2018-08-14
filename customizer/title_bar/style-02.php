<?php
$section  = 'title_bar_02';
$priority = 1;
$prefix   = 'title_bar_02_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color of the page title bar.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-inner',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => $prefix . 'bg_image',
	'label'       => esc_html__( 'Background Image', 'tm-moody' ),
	'description' => esc_html__( 'Select an image for the page title bar background. If left empty, the page title bar background color will be used.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-inner',
			'property' => 'background-image',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background overlay color when has background image of page title bar.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-overlay',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'border_color',
	'label'       => esc_html__( 'Border Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the border bottom color of the page title bar.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding Bottom', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 61,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding Bottom', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 61,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 500,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '500',
		'line-height'    => '1.3',
		'letter-spacing' => '-0.03em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
		'color'          => '#fff',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-02 .page-title-bar-inner .heading',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'heading_font_size',
	'label'     => esc_html__( 'Font Size', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 22,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-title-bar-02 .page-title-bar-inner .heading',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'breadcrumb_typography',
	'label'       => esc_html__( 'Typography', 'tm-moody' ),
	'description' => esc_html__( 'Controls the typography for the breadcrumb text.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.2',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
		'font-size'      => '16px',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-02 .insight_core_breadcrumb li, .page-title-bar-02 .insight_core_breadcrumb li a',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_text_color',
	'label'       => esc_html__( 'Text Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of text on breadcrumb.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .insight_core_breadcrumb li',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_color',
	'label'       => esc_html__( 'Link Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of links on breadcrumb.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .insight_core_breadcrumb a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'breadcrumb_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover of links on breadcrumb.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-02 .insight_core_breadcrumb a:hover',
			'property' => 'color',
		),
	),
) );
