<?php

class WPBakeryShortCode_TM_W_Better_Custom_Menu extends WPBakeryShortCode {

}

$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	if ( is_array( $menus ) && ! empty( $menus ) ) {
		foreach ( $menus as $single_menu ) {
			if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
				$custom_menus[ $single_menu->name ] = $single_menu->slug;
			}
		}
	}
}

vc_map( array(
	'name'     => esc_html__( 'Widget Better Custom Menu', 'tm-moody' ),
	'base'     => 'tm_w_better_custom_menu',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-custom-menu',
	'class'    => 'wpb_vc_wp_widget',
	'params'   => array(
		array(
			'heading'     => esc_html__( 'Widget title', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'title',
			'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'tm-moody' ),
		),
		array(
			'heading'    => esc_html__( 'Style', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'style',
			'value'      => array(
				esc_html__( '01', 'tm-moody' ) => '1',
			),
			'std'        => '1',
		),
		array(
			'heading'    => esc_html__( 'Alignment', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'alignment',
			'value'      => array(
				esc_html__( 'Vertical', 'tm-moody' )   => 'vertical',
				esc_html__( 'Horizontal', 'tm-moody' ) => 'horizontal',
			),
			'std'        => 'vertical',
		),
		array(
			'heading'     => esc_html__( 'Menu', 'tm-moody' ),
			'description' => empty( $custom_menus ) ? wp_kses( __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'tm-moody' ), array(
				'b' => array(),

			) ) : esc_html__( 'Select menu to display.', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'nav_menu',
			'value'       => $custom_menus,
			'save_always' => true,
		),
		Insight_VC::extra_class_field(),
	),
) );
