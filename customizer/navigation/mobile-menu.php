<?php
$section  = 'navigation_mobile';
$priority = 1;
$prefix   = 'mobile_menu_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => $prefix . 'breakpoint',
	'label'       => esc_html__( 'Breakpoint', 'tm-moody' ),
	'description' => esc_html__( 'Controls the breakpoint of the mobile menu.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'postMessage',
	'default'     => 1199,
	'choices'     => array(
		'min'  => 460,
		'max'  => 1300,
		'step' => 10,
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'typo',
	'label'       => esc_html__( 'Typography', 'tm-moody' ),
	'description' => esc_html__( 'Controls the typography for all mobile menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.5',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .menu__container a, .page-mobile-main-menu .menu__container .tm-list__title',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'background_color',
	'label'       => esc_html__( 'Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color of mobile menu.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => $prefix . 'text_align',
	'label'     => esc_html__( 'Text Align', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => 'left',
	'choices'   => array(
		'left'   => esc_html__( 'Left', 'tm-moody' ),
		'center' => esc_html__( 'Center', 'tm-moody' ),
		'right'  => esc_html__( 'Right', 'tm-moody' ),
	),
	'output'    => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container',
			'property' => 'text-align',
		),
	),
) );

// Level 1.

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Level 1', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '10px',
		'bottom' => '10px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'item_font_size',
	'label'       => esc_html__( 'Font Size', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font size of items level 1.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 20,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of items level 1.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover of items level 1.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li > a:hover',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'divider_color',
	'label'       => esc_html__( 'Divider Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the divider color between items level 1', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255,255,255,.1)',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .menu__container > li + li > a, .page-mobile-main-menu .menu__container > li.opened > a',
			'property' => 'border-color',
		),
	),
) );

// Mobile Menu Dropdown Menu.

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Sub Items', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'sub_item_padding',
	'label'     => esc_html__( 'Item Padding', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '8px',
		'bottom' => '8px',
		'left'   => '0',
		'right'  => '0',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.page-mobile-main-menu .sub-menu a',
			),
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'sub_item_font_size',
	'label'       => esc_html__( 'Font Size', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font size of sub items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 17,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '
			.page-mobile-main-menu .sub-menu a,
			.page-mobile-main-menu .tm-list__item
			',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_color',
	'label'       => esc_html__( 'Link Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of sub items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .sub-menu a, .page-mobile-main-menu .tm-list__item',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'sub_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover of sub items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .sub-menu a:hover, .page-mobile-main-menu .tm-list__item:hover',
			'property' => 'color',
		),
	),
) );

// Widget Title

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'widget_title_typo',
	'label'       => esc_html__( 'Typography', 'tm-moody' ),
	'description' => esc_html__( 'Controls the typography for all mobile menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '700',
		'line-height'    => '1.5',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'uppercase',
	),
	'output'      => array(
		array(
			'element' => '.page-mobile-main-menu .widgettitle',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'widget_title_font_size',
	'label'       => esc_html__( 'Font Size', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font size of widget title in sub mega menu.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 8,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .widgettitle',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'widget_title_color',
	'label'       => esc_html__( 'Widget Title Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of widget title.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-mobile-main-menu .widgettitle',
			'property' => 'color',
		),
	),
) );
