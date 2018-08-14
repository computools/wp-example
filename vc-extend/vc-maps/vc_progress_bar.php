<?php
vc_map_update( 'vc_progress_bar', array(
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-processbar',
) );

vc_remove_param( 'vc_progress_bar', 'bgcolor' );
vc_remove_param( 'vc_progress_bar', 'custombgcolor' );
vc_remove_param( 'vc_progress_bar', 'customtxtcolor' );
vc_remove_param( 'vc_progress_bar', 'values' );
vc_remove_param( 'vc_progress_bar', 'css' );
vc_remove_param( 'vc_progress_bar', 'title' );

$weight      = 100;
$spacing_tab = esc_html__( 'Design Options', 'tm-moody' );

vc_add_params( 'vc_progress_bar', array(
	array(
		'heading'    => esc_html__( 'Style', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'style',
		'value'      => array(
			esc_html__( '01', 'tm-moody' ) => '1',
			esc_html__( '02', 'tm-moody' ) => '2',
		),
		'std'        => '1',
		'weight'     => $weight--,
	),
	array(
		'heading'     => esc_html__( 'Bar height', 'tm-moody' ),
		'description' => esc_html__( 'Controls the height of bar.', 'tm-moody' ),
		'type'        => 'number',
		'param_name'  => 'bar_height',
		'std'         => 5,
		'min'         => 1,
		'max'         => 50,
		'step'        => 1,
		'suffix'      => 'px',
		'weight'      => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Background Color', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
		),
		'std'        => 'custom',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Background Color', 'tm-moody' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#222',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Track Color', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'track_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
		),
		'std'        => 'custom',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Track Color', 'tm-moody' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_track_color',
		'dependency' => array(
			'element' => 'track_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#eee',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Text Color', 'tm-moody' ),
		'type'       => 'dropdown',
		'param_name' => 'text_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
		),
		'std'        => 'custom',
		'weight'     => $weight--,
	),
	array(
		'heading'    => esc_html__( 'Custom Text Color', 'tm-moody' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_text_color',
		'dependency' => array(
			'element' => 'text_color',
			'value'   => array( 'custom' ),
		),
		'std'        => '#333',
		'weight'     => $weight--,
	),
	array(
		'group'       => esc_html__( 'Items', 'tm-moody' ),
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Values', 'tm-moody' ),
		'param_name'  => 'values',
		'description' => esc_html__( 'Enter values for graph - value, title and color.', 'tm-moody' ),
		'value'       => rawurlencode( wp_json_encode( array(
			array(
				'label' => esc_html__( 'Development', 'tm-moody' ),
				'value' => '90',
			),
			array(
				'label' => esc_html__( 'Design', 'tm-moody' ),
				'value' => '80',
			),
			array(
				'label' => esc_html__( 'Marketing', 'tm-moody' ),
				'value' => '70',
			),
		) ) ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Label', 'tm-moody' ),
				'param_name'  => 'label',
				'description' => esc_html__( 'Enter text used as title of bar.', 'tm-moody' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Value', 'tm-moody' ),
				'param_name'  => 'value',
				'description' => esc_html__( 'Enter value of bar.', 'tm-moody' ),
				'admin_label' => true,
			),
			array(
				'heading'    => esc_html__( 'Background Color', 'tm-moody' ),
				'type'       => 'dropdown',
				'param_name' => 'background_color',
				'value'      => array(
					esc_html__( 'Default', 'tm-moody' )         => '',
					esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
					esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
					esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Background Color', 'tm-moody' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_background_color',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Text Color', 'tm-moody' ),
				'type'       => 'dropdown',
				'param_name' => 'text_color',
				'value'      => array(
					esc_html__( 'Default', 'tm-moody' )         => '',
					esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
					esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
					esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Text Color', 'tm-moody' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_text_color',
				'dependency' => array(
					'element' => 'text_color',
					'value'   => array( 'custom' ),
				),
				'std'        => '#333',
			),
		),
	),
	array(
		'group'        => $spacing_tab,
		'heading'      => esc_html__( 'Large Device Spacing', 'tm-moody' ),
		'type'         => 'spacing',
		'param_name'   => 'lg_spacing',
		'spacing_icon' => 'fa-desktop',
	),
	array(
		'group'        => $spacing_tab,
		'heading'      => esc_html__( 'Medium Device Spacing', 'tm-moody' ),
		'type'         => 'spacing',
		'param_name'   => 'md_spacing',
		'spacing_icon' => 'fa-tablet fa-rotate-270',
	),
	array(
		'group'        => $spacing_tab,
		'heading'      => esc_html__( 'Small Device Spacing', 'tm-moody' ),
		'type'         => 'spacing',
		'param_name'   => 'sm_spacing',
		'spacing_icon' => 'fa-tablet',
	),
	array(
		'group'        => $spacing_tab,
		'heading'      => esc_html__( 'Extra Small Spacing', 'tm-moody' ),
		'type'         => 'spacing',
		'param_name'   => 'xs_spacing',
		'spacing_icon' => 'fa-mobile',
	),
) );
