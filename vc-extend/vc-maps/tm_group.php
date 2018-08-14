<?php

class WPBakeryShortCode_TM_Group extends WPBakeryShortCodesContainer {

}

vc_map( array(
	'name'                    => esc_html__( 'Group', 'tm-moody' ),
	'base'                    => 'tm_group',
	// Use only|except attributes to limit child shortcodes (separate multiple values with comma).
	'content_element'         => true,
	'show_settings_on_create' => false,
	'is_container'            => true,
	'category'                => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                    => 'tm-i tm-i-pricing-group',
	'params'                  => array(
		Insight_VC::extra_class_field(),
	),
	'js_view'                 => 'VcColumnView',
) );

