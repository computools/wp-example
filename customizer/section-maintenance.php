<?php
$section  = 'maintenance';
$priority = 1;
$prefix   = 'maintenance_';

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => sprintf( '<div class="desc">
			<strong class="tm-label tm-label-info">%s</strong>
			<p>%s</p>
			<p><span class="tm-label tm-label-info">%s</span></p>
			<p>%s</p>
		</div>', esc_html__( 'IMPORTANT NOTE: ', 'tm-moody' ), esc_html__( 'To active maintenance mode, please add this line to wp-config.php file, before "That\'s all, stop editing! Happy blogging" comment.', 'tm-moody' ), esc_html__( 'define(\'INSIGHT_MAINTENANCE\', true);', 'tm-moody' ), esc_html__( 'Then select a maintenance page below.', 'tm-moody' ) ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'General', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'maintenance_page',
	'label'    => esc_html__( 'Page', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '',
	'choices'  => Insight_Maintenance::get_maintenance_pages(),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'tm-moody' ),
	'description' => esc_html__( 'Select an image file for background.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'maintenance_logo',
	'label'       => esc_html__( 'Logo', 'tm-moody' ),
	'description' => esc_html__( 'Choose logo for maintenance page.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'logo_light',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'tm-moody' ),
		'logo_light' => esc_html__( 'Light Logo', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Maintanance', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'progress_bar',
	'label'       => esc_html__( 'Progress bar', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to show progress bar form in maintenance mode', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'tm-moody' ),
		'1' => esc_html__( 'Show', 'tm-moody' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'percent',
	'label'     => esc_attr__( 'Percent Done', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 85,
	'choices'   => array(
		'min'  => '1',
		'max'  => '100',
		'step' => '1',
	),
	'transport' => 'postMessage',
	'output'    => array(
		array(
			'element'  => '.maintenance-number',
			'property' => 'left',
			'units'    => '%',
		),
		array(
			'element'  => '.maintenance-progress-bar',
			'property' => 'width',
			'units'    => '%',
		),
	),
	'js_vars'   => array(
		array(
			'element'  => '.maintenance-number',
			'property' => 'left',
			'function' => 'css',
			'units'    => '%',
		),
		array(
			'element'  => '.maintenance-progress-bar',
			'property' => 'width',
			'function' => 'css',
			'units'    => '%',
		),
		array(
			'element'  => '.maintenance-number',
			'function' => 'html',
			'units'    => '%',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Title', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Site maintenance', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'sub_title',
	'label'       => esc_html__( 'Sub Title', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display below title.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'We are currently working on our new website', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'text',
	'label'       => esc_html__( 'Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display below title.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'We sincerely apologize for the inconvenience. Our site is currently undergoing scheduled maintenance and upgrades, but will return shortly after.
', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => $prefix . 'sub_text',
	'label'       => esc_html__( 'Sub Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display below main text.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Thank you for your patience!', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Coming Soon', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'date',
	'settings' => 'cs_countdown',
	'label'    => esc_html__( 'Countdown', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => Insight_Helper::get_coming_soon_demo_date(),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => 'cs_title',
	'label'    => esc_html__( 'Title', 'tm-moody' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => esc_html__( 'Something awesome is in the works. ', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'cs_text',
	'label'       => esc_html__( 'Text', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text that display below title.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'You can subscribe us to get noticed when our website is ready.', 'tm-moody' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'cs_mailchimp_enable',
	'label'       => esc_html__( 'Mailchimp Form', 'tm-moody' ),
	'description' => esc_html__( 'Turn on to show mailchimp form in maintenance mode', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'tm-moody' ),
		'1' => esc_html__( 'Show', 'tm-moody' ),
	),
) );
