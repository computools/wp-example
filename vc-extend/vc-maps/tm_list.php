<?php

class WPBakeryShortCode_TM_List extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;

		$marker_tmp = $heading_tmp = $text_tmp = '';

		if ( $atts['marker_color'] === 'custom' ) {
			$marker_tmp .= "color: {$atts['custom_marker_color']}; ";
		}

		if ( $marker_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .tm-list__marker{ $marker_tmp }";
			$insight_shortcode_lg_css .= "$selector .tm-list__icon{ $marker_tmp }";
		}

		if ( $atts['title_color'] === 'custom' ) {
			$heading_tmp .= "color: {$atts['custom_title_color']}; ";
		}

		if ( $heading_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .tm-list__title{ $heading_tmp }";
		}

		if ( $atts['desc_color'] === 'custom' ) {
			$text_tmp .= "color: {$atts['custom_desc_color']}; ";
		}

		if ( $text_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .tm-list__desc{ $text_tmp }";
		}

		if ( $atts['columns'] !== '' ) {
			$arr = explode( ';', $atts['columns'] );
			foreach ( $arr as $value ) {
				$key = explode( ':', $value );

				switch ( $key[0] ) {
					case 'xs':
						if ( $key[1] > 1 ) {
							$insight_shortcode_xs_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$insight_shortcode_xs_css .= "$selector .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					case 'sm':
						if ( $key[1] > 1 ) {
							$insight_shortcode_sm_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$insight_shortcode_sm_css .= "$selector  .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					case 'md':
						if ( $key[1] > 1 ) {
							$insight_shortcode_md_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$insight_shortcode_md_css .= "$selector  .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					case 'lg':
						if ( $key[1] > 1 ) {
							$insight_shortcode_lg_css .= "$selector .tm-list__item{ width: calc( 100%  / {$key[1]} - 30px ); float: left; }";
						} else {
							$insight_shortcode_lg_css .= "$selector  .tm-list__item{ width: calc( 100% - 30px ); float: none; }";
						}
						break;
					default:
						break;
				}
			}
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'List', 'tm-moody' ),
	'base'                      => 'tm_list',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-list',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'List Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'list_style',
			'value'       => array(
				esc_html__( 'Basic List', 'tm-moody' )                => 'basic',
				esc_html__( 'Circle List', 'tm-moody' )               => 'circle',
				esc_html__( 'Plus List', 'tm-moody' )                 => 'plus',
				esc_html__( 'Icon List', 'tm-moody' )                 => 'icon',
				esc_html__( 'Icon Above List', 'tm-moody' )           => 'icon-above',
				esc_html__( 'Delimited List', 'tm-moody' )            => 'delimited',
				esc_html__( 'Modern Icon List', 'tm-moody' )          => 'modern-icon',
				esc_html__( '(Automatic) Numbered List', 'tm-moody' ) => 'auto-numbered',
				esc_html__( '(Manual) Numbered List', 'tm-moody' )    => 'manual-numbered',
			),
			'admin_label' => true,
			'std'         => 'icon',
		),
		array(
			'heading'     => esc_html__( 'Columns', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
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
		array(
			'heading'    => esc_html__( 'Marker Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'marker_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Marker Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_marker_color',
			'dependency' => array(
				'element' => 'marker_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'heading'    => esc_html__( 'Title Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'title_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Title Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_title_color',
			'dependency' => array(
				'element' => 'title_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'heading'    => esc_html__( 'Description Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'desc_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Description Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_desc_color',
			'dependency' => array(
				'element' => 'desc_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
	),

		Insight_VC::icon_libraries( array(
			'admin_label' => false,
			'allow_none'  => true,
			'group'       => '',
			'param_name'  => 'icon_type',
			'dependency'  => array(
				'element' => 'list_style',
				'value'   => array(
					'icon',
					'modern-icon',
					'icon-above',
				),
			),
		) ), array(
			Insight_VC::get_animation_field(),
			Insight_VC::extra_class_field(),
			array(
				'group'      => esc_html__( 'Items', 'tm-moody' ),
				'heading'    => esc_html__( 'Items', 'tm-moody' ),
				'type'       => 'param_group',
				'param_name' => 'items',
				'params'     => array_merge( array(
					array(
						'heading'     => esc_html__( 'Number', 'tm-moody' ),
						'type'        => 'textfield',
						'param_name'  => 'item_number',
						'admin_label' => true,
						'description' => esc_html__( 'Only work with List Type: (Manual) Numbered list.', 'tm-moody' ),
					),
					array(
						'heading'     => esc_html__( 'Item title', 'tm-moody' ),
						'type'        => 'textfield',
						'param_name'  => 'item_title',
						'admin_label' => true,
					),
					array(
						'heading'    => esc_html__( 'Link', 'tm-moody' ),
						'type'       => 'vc_link',
						'param_name' => 'link',
					),
					array(
						'heading'     => esc_html__( 'Description', 'tm-moody' ),
						'type'        => 'textarea',
						'param_name'  => 'item_desc',
						'description' => esc_html__( 'Only work with List Type: (Automatic) & (Manual) Numbered list', 'tm-moody' ),
					),
				), Insight_VC::icon_libraries( array(
					'admin_label' => false,
					'allow_none'  => true,
				) ) ),

			),

		), Insight_VC::get_vc_spacing_tab() ),
) );
