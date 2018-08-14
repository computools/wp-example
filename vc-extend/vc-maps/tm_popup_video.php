<?php

class WPBakeryShortCode_TM_Popup_Video extends WPBakeryShortCode {

}

vc_map( array(
	'name'                      => esc_html__( 'Popup Video', 'tm-moody' ),
	'base'                      => 'tm_popup_video',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-video',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Poster Style 1', 'tm-moody' ) => 'poster',
				esc_html__( 'Poster Style 2', 'tm-moody' ) => 'poster-2',
				esc_html__( 'Poster Style 3', 'tm-moody' ) => 'poster-3',
				esc_html__( 'Button Style 1', 'tm-moody' ) => 'button',
				esc_html__( 'Button Style 2', 'tm-moody' ) => 'button-2',
				esc_html__( 'Button Style 3', 'tm-moody' ) => 'button-3',
				esc_html__( 'Button Style 4', 'tm-moody' ) => 'button-4',
				esc_html__( 'Button Style 5', 'tm-moody' ) => 'button-5',
			),
			'std'         => 'poster',
		),
		array(
			'heading'    => esc_html__( 'Video Url', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'video',
		),
		array(
			'heading'    => esc_html__( 'Video Text', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'video_text',
		),
		array(
			'heading'    => esc_html__( 'Poster Image', 'tm-moody' ),
			'type'       => 'attach_image',
			'param_name' => 'poster',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'poster', 'poster-2', 'poster-3' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Poster Image Size', 'tm-moody' ),
			'description' => esc_html__( 'Controls the size of poster image.', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => array(
				esc_html__( '570x400', 'tm-moody' ) => '570x400',
				esc_html__( '600x420', 'tm-moody' ) => '600x420',
			),
			'std'         => '570x400',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'poster', 'poster-2', 'poster-3' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Overlay Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'tm-moody' )     => '',
				esc_html__( 'Style 01', 'tm-moody' ) => '1',
			),
			'std'         => '',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'poster', 'poster-2', 'poster-3' ),
			),
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
) );
