<?php

class WPBakeryShortCode_TM_Social_Networks extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_lg_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );
		$tmp = '';

		if ( $custom_style === '1' ) {
			$tmp .= "font-size: {$font_size}px;";
		}

		if ( $atts['align'] !== '' ) {
			$tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$insight_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$insight_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$insight_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector { $tmp }";
		}
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Social Networks', 'tm-moody' ),
	'base'                      => 'tm_social_networks',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-social-networks',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Icons', 'tm-moody' )              => 'icons',
				esc_html__( 'Icons Width Border', 'tm-moody' ) => 'icons-with-border',
				esc_html__( 'Title', 'tm-moody' )              => 'title',
				esc_html__( 'Icon + Title', 'tm-moody' )       => 'icon-title',
			),
			'std'         => 'icons',
		),
		array(
			'heading'     => esc_html__( 'Layout', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'layout',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Inline', 'tm-moody' )    => 'inline',
				esc_html__( 'List', 'tm-moody' )      => 'list',
				esc_html__( '2 Columns', 'tm-moody' ) => 'two-columns',
			),
			'std'         => 'inline',
		),
		array(
			'heading'     => esc_html__( 'Skin', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Dark', 'tm-moody' )  => 'dark',
				esc_html__( 'Light', 'tm-moody' ) => 'light',
			),
			'std'         => 'dark',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )    => 'left',
				esc_html__( 'Center', 'tm-moody' )  => 'center',
				esc_html__( 'Right', 'tm-moody' )   => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Text Align on Medium Device', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'md_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Text Align on Small Device', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'sm_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Text Align on Extra Small Device', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'xs_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Open link in a new tab.', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'target',
			'value'      => array(
				esc_html__( 'Yes', 'tm-moody' ) => '1',
			),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Show tooltip as item title.', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'tooltip_enable',
			'value'      => array(
				esc_html__( 'Yes', 'tm-moody' ) => '1',
			),
		),
		array(
			'heading'    => esc_html__( 'Custom style', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_style',
			'value'      => array(
				esc_html__( 'Yes', 'tm-moody' ) => '1',
			),
		),
		array(
			'heading'     => esc_html__( 'Font Size', 'tm-moody' ),
			'description' => esc_html__( 'Controls the font size of links', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'font_size',
			'std'         => 20,
			'min'         => 10,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'custom_style',
				'value'   => array( '1' ),
			),
		),

		array(
			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array_merge( array(
				array(
					'heading'     => esc_html__( 'Title', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Link', 'tm-moody' ),
					'type'       => 'textfield',
					'param_name' => 'link',
				),
			), // Icon.
				Insight_VC::icon_libraries( array(
					'element' => 'add_icon',
					'value'   => 'true',
				), false, true ) ),

			'value' => rawurlencode( wp_json_encode( array(
				array(
					'title'            => esc_html__( 'Twitter', 'tm-moody' ),
					'link'             => '#',
					'type'             => 'fontawesome',
					'icon_fontawesome' => 'fa fa-twitter',
				),
				array(
					'title'            => esc_html__( 'Facebook', 'tm-moody' ),
					'link'             => '#',
					'type'             => 'fontawesome',
					'icon_fontawesome' => 'fa fa-facebook',
				),
				array(
					'title'            => esc_html__( 'Google+', 'tm-moody' ),
					'link'             => '#',
					'type'             => 'fontawesome',
					'icon_fontawesome' => 'fa fa-google-plus',
				),
				array(
					'title'            => esc_html__( 'Linkedin', 'tm-moody' ),
					'link'             => '#',
					'type'             => 'fontawesome',
					'icon_fontawesome' => 'fa fa-linkedin',
				),
			) ) ),

		),
		Insight_VC::extra_class_field(),
	),
) );
