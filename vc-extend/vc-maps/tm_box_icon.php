<?php

class WPBakeryShortCode_TM_Box_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		$tmp         = '';
		$icon_tmp    = '';
		$heading_tmp = '';
		$text_tmp    = '';
		$btn_tmp     = '';

		$tmp .= "text-align: {$atts['align']};";

		if ( $atts['background_color'] === 'custom' ) {
			$tmp .= "background-color: {$atts['custom_background_color']};";
		} elseif ( $atts['background_color'] === 'gradient' ) {
			$tmp .= $atts['background_gradient'];
		}

		if ( $atts['background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
			if ( $_url !== false ) {
				$tmp .= "background-image: url( $_url );";

				if ( $atts['background_size'] !== 'auto' ) {
					$tmp .= "background-size: {$atts['background_size']};";
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";
				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector{ $tmp }";
		}

		if ( $atts['icon_color'] === 'custom' ) {
			$icon_tmp .= "color: {$atts['custom_icon_color']}; border-color: {$atts['custom_icon_color']}; ";
		}

		if ( $icon_tmp !== '' ) {
			if ( $atts['style'] === '2' ) {
				$insight_shortcode_lg_css .= "$selector .icon i{ $icon_tmp }";
			} else {
				$insight_shortcode_lg_css .= "$selector .icon{ $icon_tmp }";
			}
		}

		if ( $atts['heading_color'] === 'custom' ) {
			$heading_tmp .= "color: {$atts['custom_heading_color']}; ";
		}

		if ( $heading_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .heading{ $heading_tmp }";
		}

		if ( $atts['text_color'] === 'custom' ) {
			$text_tmp .= "color: {$atts['custom_text_color']}; ";
		}

		if ( $text_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .text{ $text_tmp }";
		}

		if ( $atts['text'] === '' && $atts['heading'] === '' ) {
			$insight_shortcode_lg_css .= "$selector .image{ margin-bottom: 0; }";
		}

		if ( $atts['button_color'] === 'custom' ) {
			$btn_tmp .= "color: {$atts['custom_button_color']}; ";
		}

		if ( $btn_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .tm-button .button-text{ $btn_tmp }";
		}

		if ( $atts['tablet_align'] !== '' ) {
			$insight_shortcode_lg_css .= Insight_VC::get_media_query_css( $selector, 'text-align', $atts['tablet_align'], 'max-width: 767px' );
		}

		if ( $atts['mobile_align'] !== '' ) {
			$insight_shortcode_lg_css .= Insight_VC::get_media_query_css( $selector, 'text-align', $atts['mobile_align'], 'max-width: 543px' );
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$spacing_tab = esc_html__( 'Design Options', 'tm-moody' );
$styling_tab = esc_html__( 'Styling', 'tm-moody' );

vc_map( array(
	'name'                      => esc_html__( 'Box Icon', 'tm-moody' ),
	'base'                      => 'tm_box_icon',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'description' => esc_html__( 'Select style for box icon.', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'tm-moody' ) => '1',
				esc_html__( 'Style 02', 'tm-moody' ) => '2',
				esc_html__( 'Style 03', 'tm-moody' ) => '3',
				esc_html__( 'Style 04', 'tm-moody' ) => '4',
				esc_html__( 'Style 05', 'tm-moody' ) => '5',
				esc_html__( 'Style 06', 'tm-moody' ) => '6',
				esc_html__( 'Style 07', 'tm-moody' ) => '7',
			),
			'admin_label' => true,
			'std'         => '1',
		),
		array(
			'heading'    => esc_html__( 'Image', 'tm-moody' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
		),
	), Insight_VC::icon_libraries( array(
		'group'          => '',
		'admin_label'    => false,
		'allow_none'     => true,
		'icon_libraries' => array(
			esc_html__( 'Font Awesome', 'tm-moody' ) => 'fontawesome',
			esc_html__( 'Simple Line', 'tm-moody' )  => 'simple_line',
			esc_html__( 'Linea', 'tm-moody' )        => 'linea',
		),
	) ), array(
		array(
			'heading'     => esc_html__( 'Heading', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'heading',
			'admin_label' => true,
		),
		array(
			'heading'     => esc_html__( 'Link', 'tm-moody' ),
			'description' => esc_html__( 'Add a link to heading.', 'tm-moody' ),
			'type'        => 'vc_link',
			'param_name'  => 'link',
		),
		array(
			'heading'    => esc_html__( 'Text', 'tm-moody' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'heading'    => esc_html__( 'Button', 'tm-moody' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
		),
		array(
			'heading'    => esc_html__( 'Text Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'align',
			'value'      => array(
				esc_html__( 'Left', 'tm-moody' )   => 'left',
				esc_html__( 'Center', 'tm-moody' ) => 'center',
				esc_html__( 'Right', 'tm-moody' )  => 'right',
			),
			'std'        => 'left',
		),
		array(
			'heading'    => esc_html__( 'Text Align on Tablet', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'tablet_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Text Align on Mobile', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'mobile_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Heading Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'heading_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Heading Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_heading_color',
			'dependency' => array(
				'element' => 'heading_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Icon Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Icon Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_color',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Text Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Text Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#999',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Button Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'button_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Button Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_button_color',
			'dependency' => array(
				'element' => 'button_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#fff',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'background_color',
			'value'      => array(
				esc_html__( 'None', 'tm-moody' )           => '',
				esc_html__( 'Primary Color', 'tm-moody' )  => 'primary',
				esc_html__( 'Custom Color', 'tm-moody' )   => 'custom',
				esc_html__( 'Gradient Color', 'tm-moody' ) => 'gradient',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_background_color',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'tm-moody' ),
			'type'       => 'gradient',
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Image', 'tm-moody' ),
			'type'       => 'attach_image',
			'param_name' => 'background_image',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Repeat', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'No repeat', 'tm-moody' )         => 'no-repeat',
				esc_html__( 'Tile', 'tm-moody' )              => 'repeat',
				esc_html__( 'Tile Horizontally', 'tm-moody' ) => 'repeat-x',
				esc_html__( 'Tile Vertically', 'tm-moody' )   => 'repeat-y',
			),
			'std'        => 'no-repeat',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Size', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'Auto', 'tm-moody' )    => 'auto',
				esc_html__( 'Cover', 'tm-moody' )   => 'cover',
				esc_html__( 'Contain', 'tm-moody' ) => 'contain',
			),
			'std'        => 'cover',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Position', 'tm-moody' ),
			'description' => esc_html__( 'Ex: left center', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'background_position',
			'dependency'  => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Overlay', 'tm-moody' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_background',
			'value'       => array(
				esc_html__( 'None', 'tm-moody' )          => '',
				esc_html__( 'Primary Color', 'tm-moody' ) => 'primary',
				esc_html__( 'Custom Color', 'tm-moody' )  => 'overlay_custom_background',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'tm-moody' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'tm-moody' ),
			'type'        => 'colorpicker',
			'param_name'  => 'overlay_custom_background',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'overlay_background',
				'value'   => array( 'overlay_custom_background' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Opacity', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'overlay_background',
				'not_empty' => true,
			),
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Large Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'lg_spacing',
			'spacing_icon' => 'fa-desktop',
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Medium Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'md_spacing',
			'spacing_icon' => 'fa-tablet fa-rotate-270',
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Small Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'sm_spacing',
			'spacing_icon' => 'fa-tablet',
		),
		array(
			'group'        => $spacing_tab,
			'heading'      => esc_html__( 'Extra Small Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'xs_spacing',
			'spacing_icon' => 'fa-mobile',
		),
	) ),

) );
