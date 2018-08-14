<?php
$section  = 'typography';
$priority = 1;
$prefix   = 'typography_';

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="desc"><strong class="tm-label tm-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'tm-moody' ) . '</strong>' . esc_html__( 'This section contains general typography options. Additional typography options for specific areas can be found within other sections. Example: For breadcrumb typography options go to the breadcrumb section.', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'kirki-typography',
	'settings'  => $prefix . 'secondary',
	'label'     => esc_html__( 'Secondary Font family', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'transport' => 'auto',
	'default'   => array(
		'font-family' => Insight::SECONDARY_FONT,
		'subsets'     => array( 'latin-ext' ),
	),
	'choices'   => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
	'output'    => array(
		array(
			'element' => '.secondary-font, .tm-pie-chart .subtitle, .typed-text-2 mark',
		),
	),
) );

/*--------------------------------------------------------------
# Link color
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Link', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of all links.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#222222',
	'output'      => array(
		array(
			'element'  => 'a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'link_color_hover',
	'label'       => esc_html__( 'Hover Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of all links when hover.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => 'a:hover, a:focus, .comment-list .comment-meta a:hover, .comment-list .comment-meta a:focus,
			.woocommerce-MyAccount-navigation .is-active a',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Body Typography
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body Typography', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font family', 'tm-moody' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '1.5',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
	),
	'choices'     => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'body, .body-font',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'body_color',
	'label'       => esc_html__( 'Body Text Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of body text.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#999',
	'output'      => array(
		array(
			'element'  => 'body, .body-color',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'body_font_sensitive',
	'label'       => esc_html__( 'Font sensitivity', 'tm-moody' ),
	'description' => esc_html__( 'Values below 1 decrease rate of resizing, values above 1 increase rate of resizing.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
	'choices'     => array(
		'min'  => 0.5,
		'max'  => 1,
		'step' => 0.05,
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'body_font_size',
	'label'     => esc_html__( 'Font size', 'tm-moody' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 16,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => 'body, .body-font-size',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Heading typography
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading Typography', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font family', 'tm-moody' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.2',
		'letter-spacing' => '-0.03em',
		'subsets'        => array( 'latin-ext' ),
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the color of heading.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#333',
	'output'      => array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th, .heading-color,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce.single-product #reviews .comment-reply-title,
			.woocommerce.single-product .comment-respond .comment-form-rating label
			',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'heading_font_sensitive',
	'label'       => esc_html__( 'Font sensitivity', 'tm-moody' ),
	'description' => esc_html__( 'Values below 1 decrease rate of resizing, values above 1 increase rate of resizing.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 0.7,
	'choices'     => array(
		'min'  => 0.5,
		'max'  => 1,
		'step' => 0.05,
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'tm-moody' ),
	'description' => esc_html__( 'H1', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 56,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h1,.h1',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 36,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h2,.h2',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 32,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h3,.h3',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h4,.h4',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 20,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h5,.h5',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 14,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'     => 'h6,.h6',
			'property'    => 'font-size',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Button Color
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'tm-moody' ) . '</div>',
) );

$button_selector = '
button, input[type="button"], input[type="reset"], input[type="submit"],
.woocommerce #respond input#submit.disabled,
.woocommerce #respond input#submit:disabled,
.woocommerce #respond input#submit:disabled[disabled],
.woocommerce a.button.disabled,
.woocommerce a.button:disabled,
.woocommerce a.button:disabled[disabled],
.woocommerce button.button.disabled,
.woocommerce button.button:disabled,
.woocommerce button.button:disabled[disabled],
.woocommerce input.button.disabled,
.woocommerce input.button:disabled,
.woocommerce input.button:disabled[disabled],
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
.woocommerce a.button.alt,
.woocommerce input.button.alt,
.woocommerce button.button.alt,
.button
';

$button_hover_selector = '
button:hover,
input[type="button"]:hover,
input[type="reset"]:hover,
input[type="submit"]:hover,
.woocommerce #respond input#submit.disabled:hover,
.woocommerce #respond input#submit:disabled:hover,
.woocommerce #respond input#submit:disabled[disabled]:hover,
.woocommerce a.button.disabled:hover,
.woocommerce a.button:disabled:hover,
.woocommerce a.button:disabled[disabled]:hover,
.woocommerce button.button.disabled:hover,
.woocommerce button.button:disabled:hover,
.woocommerce button.button:disabled[disabled]:hover,
.woocommerce input.button.disabled:hover,
.woocommerce input.button:disabled:hover,
.woocommerce input.button:disabled[disabled]:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover,
.woocommerce button.button:hover,
.woocommerce input.button:hover,
.woocommerce a.button.alt:hover,
.woocommerce input.button.alt:hover,
.woocommerce button.button.alt:hover,
.button:hover
';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_background_color',
	'label'       => esc_html__( 'Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color of all buttons.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => $button_selector,
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_border_color',
	'label'       => esc_html__( 'Border Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the border color of all buttons.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => $button_selector,
			'property' => 'border-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_text_color',
	'label'       => esc_html__( 'Text Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text color of all buttons.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => $button_selector,
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Hover Colors', 'tm-moody' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_hover_background_color',
	'label'       => esc_html__( 'Background Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the background color when hover of all buttons.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => $button_hover_selector,
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_hover_border_color',
	'label'       => esc_html__( 'Border Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the border color when hover of all buttons.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => $button_hover_selector,
			'property' => 'border-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'button_hover_text_color',
	'label'       => esc_html__( 'Text Color', 'tm-moody' ),
	'description' => esc_html__( 'Controls the text color when hover of all buttons.', 'tm-moody' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => $button_hover_selector,
			'property' => 'color',
		),
	),
) );
