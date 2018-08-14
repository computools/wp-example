<?php
$section  = 'header_sticky';
$priority = 1;
$prefix   = 'header_sticky_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'tm-moody' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'behaviour',
	'label'       => esc_html__( 'Behaviour', 'tm-moody' ),
	'description' => esc_html__( 'Controls the behaviour of header sticky when you scroll down to page', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'both',
	'choices'     => array(
		'both' => esc_html__( 'Sticky on scroll up/down', 'tm-moody' ),
		'up'   => esc_html__( 'Sticky on scroll up', 'tm-moody' ),
		'down' => esc_html__( 'Sticky on scroll down', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'height',
	'label'     => esc_html__( 'Height', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 70,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'height',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'item_padding',
	'label'       => esc_html__( 'Item Padding', 'tm-moody' ),
	'description' => esc_html__( 'Controls the item level 1 padding of navigation when sticky.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'top'    => '25px',
		'bottom' => '26px',
		'left'   => '22px',
		'right'  => '22px',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'.headroom--not-top.headroom--not-top .menu--primary .menu__container > li > a',
				'.headroom--not-top.headroom--not-top .menu--primary .menu__container > ul > li >a',
			),
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color of navigation when sticky.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'rgba( 255, 255, 255, 1 )',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'background',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of main menu items on sticky header.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#222',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary > ul > li > a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items on sticky header.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
				.headroom--not-top .menu--primary > ul > li:hover > a,
				.headroom--not-top .menu--primary > ul > li > a:focus,
				.headroom--not-top .menu--primary > ul > li.current-menu-item > a,
				.headroom--not-top .menu--primary > ul > li.current-menu-item > a .menu-item-title',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_arrow_color',
	'label'       => esc_html__( 'Link Arrow Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color for main menu items arrow.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(17,17,17 ,0.5)',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary .menu__container > li.menu-item-has-children > a:after',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_arrow_hover_color',
	'label'       => esc_html__( 'Link Arrow Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items arrow.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary .menu__container > li.menu-item-has-children:hover > a:after',
			'property' => 'color',
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
			'element'  => '.headroom--not-top .menu--primary .sm-simple > li:hover > a .menu-item-title:after,
				.headroom--not-top .menu--primary .sm-simple > li.current-menu-item > a .menu-item-title:after,
				.headroom--not-top .menu--primary .sm-simple > li.current-menu-parent > a .menu-item-title:after',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_sticky_icon_color',
	'label'       => esc_html__( 'Icon Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of icons in sticky header.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#333',
	'output'      => array(
		array(
			'element'  => '
			.headroom--not-top .page-open-mobile-menu i,
			.headroom--not-top .page-open-main-menu i,
			.headroom--not-top .popup-search-wrap i,
			.headroom--not-top .mini-cart .mini-cart-icon,
			.headroom--not-top .header-social-networks a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_sticky_icon_hover_color',
	'label'       => esc_html__( 'Icon Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color when of icons in sticky header.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
			.headroom--not-top .page-open-mobile-menu:hover i,
			.headroom--not-top .page-open-main-menu:hover i,
			.headroom--not-top .popup-search-wrap:hover i,
			.headroom--not-top .mini-cart .mini-cart-icon:hover,
			.headroom--not-top .header-social-networks a:hover',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'header_sticky_button_style',
	'label'    => esc_html__( 'Button Style', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'flat',
	'choices'  => array(
		'outline' => esc_html__( 'Outline', 'tm-atomlab' ),
		'flat'    => esc_html__( 'Flat', 'tm-atomlab' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'header_sticky_button_color',
	'label'    => esc_html__( 'Button Color', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'primary',
	'choices'  => array(
		'primary'   => esc_html__( 'Primary', 'tm-atomlab' ),
		'secondary' => esc_html__( 'Secondary', 'tm-atomlab' ),
		'white'     => esc_html__( 'White', 'tm-atomlab' ),
	),
) );
