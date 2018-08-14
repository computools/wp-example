<?php

class WPBakeryShortCode_TM_Slider_Icon_List extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		$slide_tmp = '';

		if ( isset( $atts['text_align'] ) && $atts['text_align'] !== '' ) {
			$slide_tmp .= "text-align: {$atts['text_align']};";
		}

		if ( $slide_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .swiper-slide { $slide_tmp }";
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$slides_tab  = esc_html__( 'Slides', 'tm-moody' );
$styling_tab = esc_html__( 'Styling', 'tm-moody' );

vc_map( array(
	'name'                      => esc_html__( 'Slider Icon List', 'tm-moody' ),
	'base'                      => 'tm_slider_icon_list',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-carousel',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Slider List Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Two Vertical Item / List Icon', 'tm-moody' ) => 'two-vertical-item-list-icon',
				esc_html__( 'Numbered Manual', 'tm-moody' )               => 'numbered-manual',
			),
			'std'         => 'list',
		),
		array(
			'heading'    => esc_html__( 'Auto Height', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'auto_height',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Loop', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'loop',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
			'std'        => '1',
		),
		array(
			'heading'     => esc_html__( 'Auto Play', 'tm-moody' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'tm-moody' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'auto_play',
		),
		array(
			'heading'    => esc_html__( 'Equal Height', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'equal_height',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Vertically Center', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'v_center',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Navigation', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'nav',
			'value'      => Insight_VC::get_slider_navs(),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Pagination', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => Insight_VC::get_slider_dots(),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Gutter', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
		),
		array(
			'heading'     => esc_html__( 'Items Display', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 1,
				'md' => '',
				'sm' => '',
				'xs' => 1,
			),
		),
		Insight_VC::extra_class_field(),
		array(
			'group'      => $slides_tab,
			'heading'    => esc_html__( 'Slides', 'tm-moody' ),
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
					'heading'    => esc_html__( 'Text', 'tm-moody' ),
					'type'       => 'textarea',
					'param_name' => 'text',
				),
				array(
					'heading'    => esc_html__( 'Link', 'tm-moody' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
					'value'      => esc_html__( 'Link', 'tm-moody' ),
				),
				array(
					'heading'     => esc_html__( 'Number', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'number',
					'admin_label' => true,
				),
			), Insight_VC::icon_libraries( array(
				'admin_label' => false,
				'allow_none'  => true,
			) ) ),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'text_align',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )    => 'left',
				esc_html__( 'Center', 'tm-moody' )  => 'center',
				esc_html__( 'Right', 'tm-moody' )   => 'right',
				esc_html__( 'Justify', 'tm-moody' ) => 'justify',
			),
			'std'        => '',

		),
	), Insight_VC::get_vc_spacing_tab() ),
) );
