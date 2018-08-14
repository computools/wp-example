<?php
$section  = 'navigation_minimal';
$priority = 1;
$prefix   = 'navigation_minimal_';

/*--------------------------------------------------------------
# Level 1
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Level 1', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(26, 35, 126, .95)',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '0',
		'bottom' => '0',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-off-canvas-main-menu .menu__container > li > a',
				'.page-off-canvas-main-menu .menu__container > ul > li >a',
			),
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'typography',
	'label'       => esc_html__( 'Typography', 'tm-moody' ),
	'description' => esc_html__( 'These settings control the typography for menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.7',
		'letter-spacing' => '0',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.page-off-canvas-main-menu .menu__container a',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font size for main menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 32,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color for main menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container a:hover, .page-off-canvas-main-menu .menu__container a:focus',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Main Menu Dropdown Menu
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu Dropdown', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 20,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container .sub-menu a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container .sub-menu a, .page-off-canvas-main-menu .widgettitle',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_hover_color',
	'label'       => esc_html__( 'Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover for dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-off-canvas-main-menu .menu__container .sub-menu a:hover',
			'property' => 'color',
		),
	),
) );
