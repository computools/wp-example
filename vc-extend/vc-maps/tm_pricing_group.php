<?php

class WPBakeryShortCode_TM_Pricing_Group extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                    => esc_html__( 'Pricing Group', 'tm-moody' ),
	'base'                    => 'tm_pricing_group',
	'as_parent'               => array( 'only' => 'tm_pricing' ),
	// Use only|except attributes to limit child shortcodes (separate multiple values with comma).
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'tm-i tm-i-pricing-group',
	'params'                  => array_merge( array(
		Insight_VC::extra_class_field(),
	), Insight_VC::get_vc_spacing_tab() ),
	'js_view'                 => 'VcColumnView',
) );

