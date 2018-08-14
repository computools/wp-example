<?php
$section     = 'xs_header';
$priority    = 1;
$prefix      = 'xs_header_';
$media_query = Insight_Helper::get_xs_media_query();

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Spacing', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'spacing_inherit',
	'label'       => esc_html__( 'Inherit from larger device.', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to inherit all settings for larger devices.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => $prefix . 'padding_top',
	'label'           => esc_html__( 'Padding top', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 0,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'          => array(
		array(
			'element'     => '.page-header-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
	'active_callback' => array(
		array(
			'settings' => $prefix . 'spacing_inherit',
			'operator' => '==',
			'value'    => '0',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => $prefix . 'padding_bottom',
	'label'           => esc_html__( 'Padding bottom', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 0,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'          => array(
		array(
			'element'     => '.page-header-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
	'active_callback' => array(
		array(
			'settings' => $prefix . 'spacing_inherit',
			'operator' => '==',
			'value'    => '0',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => $prefix . 'margin_top',
	'label'           => esc_html__( 'Margin top', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 0,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'          => array(
		array(
			'element'     => '.page-header-inner',
			'property'    => 'margin-top',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
	'active_callback' => array(
		array(
			'settings' => $prefix . 'spacing_inherit',
			'operator' => '==',
			'value'    => '0',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'slider',
	'settings'        => $prefix . 'margin_bottom',
	'label'           => esc_html__( 'Margin bottom', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 0,
	'transport'       => 'auto',
	'choices'         => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'          => array(
		array(
			'element'     => '.page-header-inner',
			'property'    => 'margin-bottom',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
	'active_callback' => array(
		array(
			'settings' => $prefix . 'spacing_inherit',
			'operator' => '==',
			'value'    => '0',
		),
	),
) );
