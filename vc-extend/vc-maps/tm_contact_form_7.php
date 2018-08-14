<?php

class WPBakeryShortCode_TM_Contact_Form_7 extends WPBakeryShortCode {

}

/**
 * Add Shortcode To Visual Composer
 */
$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

$contact_forms = array();
if ( $cf7 ) {
	foreach ( $cf7 as $cform ) {
		$contact_forms[ $cform->post_title ] = $cform->ID;
	}
} else {
	$contact_forms[ esc_html__( 'No contact forms found', 'tm-moody' ) ] = 0;
}

vc_map( array(
	'name'                      => esc_html__( 'Contact Form 7', 'tm-moody' ),
	'base'                      => 'tm_contact_form_7',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-contact-form-7',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Select contact form', 'tm-moody' ),
			'param_name'  => 'id',
			'value'       => $contact_forms,
			'save_always' => true,
			'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'tm-moody' ),
		),
		array(
			'heading'     => esc_html__( 'Form Skin', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'tm-moody' ) => '',
				esc_html__( 'Light', 'tm-moody' )   => 'light',
			),
			'std'         => '',
		),
		Insight_VC::extra_class_field(),
	),
) );
