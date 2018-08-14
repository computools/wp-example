<?php
$section            = 'sliders';
$priority           = 1;
$prefix             = 'sliders_';
$revolution_sliders = Insight_Helper::get_list_revslider();

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'tm-moody' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Front Latest Posts Page', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'tm-moody' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Archive', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'tm-moody' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Archive', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'tm-moody' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Archive', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_rev_slider',
	'label'       => esc_html__( 'Revolution Slider', 'tm-moody' ),
	'description' => esc_html__( 'Select the unique name of the slider.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
	'choices'     => $revolution_sliders,
) );
