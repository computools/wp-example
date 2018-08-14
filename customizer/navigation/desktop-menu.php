<?php
$section  = 'navigation';
$priority = 1;
$prefix   = 'navigation_';

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
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_padding',
	'label'     => esc_html__( 'Item Padding', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '30px',
		'bottom' => '30px',
		'left'   => '22px',
		'right'  => '22px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .menu--primary .menu__container > li > a',
			),
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'spacing',
	'settings'  => $prefix . 'item_margin',
	'label'     => esc_html__( 'Item Margin', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => array(
		'top'    => '0px',
		'bottom' => '0px',
		'left'   => '0px',
		'right'  => '0px',
	),
	'transport' => 'auto',
	'output'    => array(
		array(
			'element'  => array(
				'.desktop-menu .menu--primary .menu__container > li',
			),
			'property' => 'margin',
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
		'variant'        => '500',
		'line-height'    => '1.2',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.menu--primary a',
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
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.menu--primary a',
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
	'default'     => '#333',
	'output'      => array(
		array(
			'element'  => '.menu--primary a, .switcher-language-current',
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
			'element'  => '.menu--primary li:hover > a, .menu--primary > ul > li > a:hover, .menu--primary > ul > li > a:focus, .menu--primary .current-menu-item > a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_background_color',
	'label'       => esc_html__( 'Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color for main menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.menu--primary .menu__container > li > a',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_hover_background_color',
	'label'       => esc_html__( 'Hover Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color when hover for main menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.menu--primary .menu__container > li > a:hover, .menu--primary .menu__container > li.current-menu-item > a',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_current_underline_color',
	'label'       => esc_html__( 'Hover Underline Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the underline color when hover or current for main menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.menu--primary .sm-simple > li:hover > a .menu-item-title:after,
				.menu--primary .sm-simple > li.current-menu-item > a .menu-item-title:after,
				.menu--primary .sm-simple > li.current-menu-ancestor > a .menu-item-title:after,
				.menu--primary .sm-simple > li.current-menu-parent > a .menu-item-title:after',
			'property' => 'background-color',
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
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'dropdown_link_typography',
	'label'       => esc_html__( 'Typography', 'tm-moody' ),
	'description' => esc_html__( 'Controls the typography for all dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.2',
		'letter-spacing' => '-0.02em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.menu--primary .sub-menu a, .menu--primary .children a, .menu--primary .tm-list .item-wrapper',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'dropdown_link_font_size',
	'label'       => esc_html__( 'Font Size', 'tm-moody' ),
	'description' => esc_html__( 'Controls the font size for dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 15,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.menu--primary .sub-menu a, .menu--primary .children a, .menu--primary .tm-list .item-title',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Styling
--------------------------------------------------------------*/

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_bg_color',
	'label'       => esc_html__( 'Background', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color for dropdown menu', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu',
				'.menu--primary .children',
			),
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'dropdown_link_color',
	'label'       => esc_html__( 'Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color for dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu a',
				'.menu--primary .children a',
				'.menu--primary .tm-list .item-wrapper',
			),
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
	'default'     => '#1f1f1f',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu li:hover > a',
				'.menu--primary .children li:hover > a',
				'.menu--primary .tm-list li:hover .item-wrapper',
				'.menu--primary .sub-menu li:hover > a:after',
				'.menu--primary .children li:hover > a:after',
				'.menu--primary .sub-menu li.current-menu-item > a',
				'.menu--primary .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_link_hover_bg_color',
	'label'       => esc_html__( 'Hover Background', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color when hover for dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba( 255, 255, 255, 0 )',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .sub-menu li:hover > a',
				'.menu--primary .children li:hover > a',
				'.menu--primary .tm-list li:hover > a',
				'.menu--primary .sub-menu li.current-menu-item > a',
				'.menu--primary .sub-menu li.current-menu-ancestor > a',
			),
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'dropdown_separator_top_color',
	'label'       => esc_html__( 'Separator', 'tm-moody' ),
	'description' => esc_html__( 'Controls the separator top color between dropdown menu items.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba( 255, 255, 255, 0 )',
	'output'      => array(
		array(
			'element'  => array(
				'.menu--primary .children li + li > a',
				'.menu--primary .sub-menu li + li > a',
				'.menu--primary .tm-list li + li .item-wrapper',
				'.menu--primary .mega-menu .menu li + li > a',
			),
			'property' => 'border-color',
		),
	),
) );
