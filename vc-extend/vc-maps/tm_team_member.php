<?php

class WPBakeryShortCode_TM_Team_Member extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Team Member', 'tm-moody' ),
	'base'                      => 'tm_team_member',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'allowed_container_element' => 'vc_row',
	'icon'                      => 'tm-i tm-i-member',
	'params'                    => array_merge( array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '1', 'tm-moody' ) => '1',
				esc_html__( '2', 'tm-moody' ) => '2',
			),
			'std'         => '1',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Photo of member', 'tm-moody' ),
			'param_name'  => 'photo',
			'admin_label' => true,
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Name', 'tm-moody' ),
			'admin_label' => true,
			'param_name'  => 'name',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Position', 'tm-moody' ),
			'param_name'  => 'position',
			'description' => esc_html__( 'Example: CEO/Founder', 'tm-moody' ),
		),
		array(
			'type'       => 'textarea',
			'heading'    => esc_html__( 'Description', 'tm-moody' ),
			'param_name' => 'desc',
		),
		array(
			'type'       => 'textfield',
			'heading'    => esc_html__( 'Profile url', 'tm-moody' ),
			'param_name' => 'profile',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Social Networks', 'tm-moody' ),
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Social Networks', 'tm-moody' ),
			'param_name' => 'social_networks',
			'params'     => array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'tm-moody' ),
					'param_name' => 'icon',
					'settings'   => array(
						'emptyIcon'    => false,
						'iconsPerPage' => 4000,
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Link', 'tm-moody' ),
					'param_name'  => 'link',
					'admin_label' => true,
				),
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );
