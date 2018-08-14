<?php

class WPBakeryShortCode_TM_Info_Boxes extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_lg_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'tm-moody' );

vc_map( array(
	'name'     => esc_html__( 'Info Boxes', 'tm-moody' ),
	'base'     => 'tm_info_boxes',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-info-boxes',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Info Boxes Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Metro', 'tm-moody' )   => 'metro',
				esc_html__( 'Grid Classic', 'tm-moody' ) => 'grid',
			),
			'std'         => 'metro',
		),
		array(
			'heading'    => esc_html__( 'Metro Layout', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'metro_layout',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Size', 'tm-moody' ),
					'type'        => 'dropdown',
					'param_name'  => 'size',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Width 1 - Height 1', 'tm-moody' ) => '1:1',
						esc_html__( 'Width 1 - Height 2', 'tm-moody' ) => '1:2',
						esc_html__( 'Width 2 - Height 1', 'tm-moody' ) => '2:1',
						esc_html__( 'Width 2 - Height 2', 'tm-moody' ) => '2:2',
					),
					'std'         => '1:1',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'size' => '2:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Columns', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'metro', 'grid' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'tm-moody' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 0,
			'min'         => 0,
			'max'         => 100,
			'step'        => 2,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'metro', 'grid' ),
			),
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(

			'group'      => esc_html__( 'Items', 'tm-moody' ),
			'heading'    => esc_html__( 'Items', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Image', 'tm-moody' ),
					'type'        => 'attach_image',
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'heading'     => esc_html__( 'Skin', 'tm-moody' ),
					'type'        => 'dropdown',
					'param_name'  => 'skin',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Primary', 'tm-moody' )   => 'primary',
						esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
					),
					'std'         => 'primary',
				),
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
					'heading'    => esc_html__( 'Button', 'tm-moody' ),
					'type'       => 'vc_link',
					'param_name' => 'link',
				),
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );

