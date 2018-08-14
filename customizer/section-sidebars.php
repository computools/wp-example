<?php
$section             = 'sidebars';
$priority            = 1;
$prefix              = 'sidebars_';
$sidebar_positions   = Insight_Helper::get_list_sidebar_positions();
$registered_sidebars = Insight_Helper::get_registered_sidebars();

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => sprintf( '<div class="desc">
			<strong class="tm-label tm-label-info">%s</strong>
			<p>%s</p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'tm-moody' ), esc_html__( 'Sidebar 2 can only be used if sidebar 1 is selected.', 'tm-moody' ), esc_html__( 'Sidebar position option will control the position of sidebar 1. If sidebar 2 is selected, it will display on the opposite side.', 'tm-moody' ) ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Sidebar Layouts', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'single_sidebar_width',
	'label'       => esc_html__( 'Single Sidebar Width', 'tm-moody' ),
	'description' => esc_html__( 'Controls the width of the sidebar when only one sidebar is present. Input value as % unit. Ex: 33.33333', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '33.33333',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'single_sidebar_offset',
	'label'       => esc_html__( 'Single Sidebar Offset', 'tm-moody' ),
	'description' => esc_html__( 'Controls the offset of the sidebar when only one sidebar is present. Enter value including any valid CSS unit. Ex: 70px.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Dual Sidebar Layouts', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'dual_sidebar_width',
	'label'       => esc_html__( 'Dual Sidebar Width', 'tm-moody' ),
	'description' => esc_html__( 'Controls the width of sidebars when dual sidebars are present. Enter value including any valid CSS unit. Ex: 33.33333.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '25',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'dual_sidebar_offset',
	'label'       => esc_html__( 'Dual Sidebar Offset', 'tm-moody' ),
	'description' => esc_html__( 'Controls the offset of sidebars when dual sidebars are present. Enter value including any valid CSS unit. Ex: 70px.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Pages', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on all pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on all pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );


Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Search Page', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on search results page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on search results page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'search_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
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
	'settings'    => 'home_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on front latest posts page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'home_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on front latest posts page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'home_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Blog Posts', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single blog post pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'post_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single blog post pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'post_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
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
	'settings'    => 'blog_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on blog archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'blog_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on blog archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'blog_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Portfolio Posts', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single portfolio pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single portfolio pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
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
	'settings'    => 'portfolio_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on portfolio archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'portfolio_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on portfolio archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'portfolio_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );

//
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Single Product', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on single product pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on single product pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'left',
	'choices'  => $sidebar_positions,
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
	'settings'    => 'product_archive_page_sidebar_1',
	'label'       => esc_html__( 'Sidebar 1', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 1 that will display on product archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'product_archive_page_sidebar_2',
	'label'       => esc_html__( 'Sidebar 2', 'tm-moody' ),
	'description' => esc_html__( 'Select sidebar 2 that will display on product archive pages.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'none',
	'choices'     => $registered_sidebars,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_archive_page_sidebar_position',
	'label'    => esc_html__( 'Sidebar Position', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => 'right',
	'choices'  => $sidebar_positions,
) );
