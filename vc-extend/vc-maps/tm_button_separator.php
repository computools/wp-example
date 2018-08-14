<?php

class WPBakeryShortCode_TM_Button_Separator extends WPBakeryShortCode {

}

vc_map( array(
	'name'     => esc_html__( 'Separator with go to top button', 'tm-moody' ),
	'base'     => 'tm_button_separator',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-call-to-action',
	'params'   => array(
		Insight_VC::extra_class_field(),
	),
) );

