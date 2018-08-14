<?php
vc_update_shortcode_param( 'vc_tta_section', array(
	'param_name' => 'i_type',
	'value'      => array(
		esc_html__( 'Font Awesome', 'tm-moody' ) => 'fontawesome',
		esc_html__( 'Line Simple', 'tm-moody' )  => 'simple_line',
	),
) );

vc_update_shortcode_param( 'vc_tta_section', array(
	'param_name' => 'el_class',
	'weight'     => -1,
) );

vc_remove_param( 'vc_tta_section', 'i_icon_openiconic' );
vc_remove_param( 'vc_tta_section', 'i_icon_typicons' );
vc_remove_param( 'vc_tta_section', 'i_icon_entypo' );
vc_remove_param( 'vc_tta_section', 'i_icon_linecons' );
vc_remove_param( 'vc_tta_section', 'i_icon_monosocial' );
vc_remove_param( 'vc_tta_section', 'i_icon_material' );

vc_add_params( 'vc_tta_section', array(
	array(
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Icon', 'tm-moody' ),
		'param_name'  => 'i_icon_simple_line',
		'value'       => 'icon-arrow-1-circle-down',
		'settings'    => array(
			'emptyIcon'    => false,
			'type'         => 'simple_line',
			'iconsPerPage' => 400,
		),
		'dependency'  => array(
			'element' => 'i_type',
			'value'   => 'simple_line',
		),
		'description' => esc_html__( 'Select icon from library.', 'tm-moody' ),
	),
) );
