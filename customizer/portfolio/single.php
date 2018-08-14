<?php
$section  = 'single_portfolio';
$priority = 1;
$prefix   = 'single_portfolio_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_style',
	'label'       => esc_html__( 'Single Portfolio Style', 'tm-moody' ),
	'description' => esc_html__( 'Select style of all single portfolio post pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'left_details'  => esc_attr__( 'Left Details', 'tm-moody' ),
		'right_details' => esc_attr__( 'Right Details', 'tm-moody' ),
		'gallery'       => esc_attr__( 'Image Gallery', 'tm-moody' ),
		'slider'        => esc_attr__( 'Image Slider', 'tm-moody' ),
		'video'         => esc_attr__( 'Video', 'tm-moody' ),
		'image_header'  => esc_attr__( 'Image Header', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_related_enable',
	'label'       => esc_html__( 'Related Portfolios', 'tm-moody' ),
	'description' => esc_html__( 'Turn on this option to display related portfolio section.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'portfolio_related_title',
	'label'           => esc_html__( 'Related Title Section', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => esc_html__( 'Related Projects', 'tm-moody' ),
	'active_callback' => array(
		array(
			'settings' => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'portfolio_related_by',
	'label'           => esc_attr__( 'Related By', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'portfolio_category' ),
	'choices'         => array(
		'portfolio_category' => esc_html__( 'Portfolio Category', 'tm-moody' ),
		'portfolio_tags'     => esc_html__( 'Portfolio Tags', 'tm-moody' ),
	),
	'active_callback' => array(
		array(
			'settings' => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );


Insight_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'portfolio_related_number',
	'label'           => esc_html__( 'Number portfolios', 'tm-moody' ),
	'description'     => esc_html__( 'Controls the number of related portfolios', 'tm-moody' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 5,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'settings' => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_comment_enable',
	'label'       => esc_html__( 'Comments', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_share_enable',
	'label'       => esc_html__( 'Share', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to display Share list on single portfolio posts.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_meta_view_enable',
	'label'       => esc_html__( 'View', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to display View on single portfolio posts.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_meta_like_enable',
	'label'       => esc_html__( 'Like', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to display Like on single portfolio posts.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-moody' ),
		'1' => esc_html__( 'On', 'tm-moody' ),
	),
) );
