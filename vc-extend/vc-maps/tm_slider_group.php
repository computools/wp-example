<?php

class WPBakeryShortCode_TM_Slider_Group extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                    => esc_html__( 'Slider Group', 'tm-moody' ),
	'base'                    => 'tm_slider_group',
	'as_parent'               => array( 'only' => 'tm_box_icon,tm_team_member,tm_group' ),
	// Use only|except attributes to limit child shortcodes (separate multiple values with comma).
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'tm-i tm-i-carousel',
	'params'                  => array_merge( array(
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
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
		),
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
	'js_view'                 => 'VcColumnView',
) );

