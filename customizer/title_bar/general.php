<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

$title_bar_stylish = array(
	'default' => esc_html__( 'Default', 'tm-moody' ),
	'none'    => esc_html__( 'Hide', 'tm-moody' ),
	'01'      => esc_html__( 'Style 01', 'tm-moody' ),
	'02'      => esc_html__( 'Style 02', 'tm-moody' ),
	'03'      => esc_html__( 'Style 03', 'tm-moody' ),
	'04'      => esc_html__( 'Style 04', 'tm-moody' ),
);

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'layout',
	'label'    => esc_html__( 'Global Layout', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '01',
	'choices'  => array(
		'none' => esc_html__( 'Hide', 'tm-moody' ),
		'01'   => esc_html__( 'Style 01', 'tm-moody' ),
		'02'   => esc_html__( 'Style 02', 'tm-moody' ),
		'03'   => esc_html__( 'Style 03', 'tm-moody' ),
		'04'   => esc_html__( 'Style 04', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Search results for: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Category: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Tag: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Author: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Year: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Month: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Day: ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_portfolio_title',
	'label'       => esc_html__( 'Single Portfolio Heading', 'tm-moody' ),
	'description' => esc_html__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Portfolio', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_page_title_bar_layout',
	'label'       => esc_html__( 'Single Page Title Bar Layout', 'tm-moody' ),
	'description' => esc_html__( 'Controls the layout of Title Bar that displays on all single pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '02',
	'choices'     => $title_bar_stylish,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_title_bar_layout',
	'label'       => esc_html__( 'Single Blog Page Title Bar Layout', 'tm-moody' ),
	'description' => esc_html__( 'Controls the layout of Title Bar that displays on all single blog post pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '03',
	'choices'     => $title_bar_stylish,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_title_bar_layout',
	'label'       => esc_html__( 'Single Product Page Title Bar Layout', 'tm-moody' ),
	'description' => esc_html__( 'Controls the layout of Title Bar that displays on all single product pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '03',
	'choices'     => $title_bar_stylish,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_title_bar_layout',
	'label'       => esc_html__( 'Single Portfolio Page Title Bar Layout', 'tm-moody' ),
	'description' => esc_html__( 'Controls the layout of Title Bar that displays on all single profolio pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '03',
	'choices'     => $title_bar_stylish,
) );
