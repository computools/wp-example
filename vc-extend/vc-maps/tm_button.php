<?php

class WPBakeryShortCode_TM_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_lg_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;
		$wrapper_tmp = '';
		$button_tmp  = $button_hover_tmp = '';

		$_primary_color   = Insight::setting( 'primary_color' );
		$_secondary_color = Insight::setting( 'secondary_color' );

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$insight_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$insight_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$insight_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $atts['size'] === 'custom' ) {
			if ( $atts['width'] !== '' ) {
				$button_tmp .= "min-width: {$atts['width']}px;";
			}

			if ( $atts['height'] !== '' ) {
				$button_tmp   .= "min-height: {$atts['height']}px;";
				$_line_height = $atts['height'];
				if ( $atts['border_width'] !== '' ) {
					$_line_height = $_line_height - ( $atts['border_width'] * 2 );
					$button_tmp   .= "border-width: {$atts['border_width']}px;";
				}

				$button_tmp .= "line-height: {$_line_height}px;";
			}
		}

		if ( $atts['color'] === 'custom' ) {
			if ( $atts['button_bg_color'] === 'custom' ) {
				if ( $atts['custom_button_bg_color'] !== '' ) {
					$button_tmp .= "background-color: {$atts['custom_button_bg_color']};";
				} else {
					$button_tmp .= "background-color: transparent;";
				}
			} elseif ( $atts['button_bg_color'] === 'primary' ) {
				$button_tmp .= "background-color: {$_primary_color};";
			} elseif ( $atts['button_bg_color'] === 'secondary' ) {
				$button_tmp .= "background-color: {$_secondary_color};";
			}

			if ( $atts['font_color'] === 'custom' ) {
				if ( $atts['custom_font_color'] !== '' ) {
					$button_tmp .= "color: {$atts['custom_font_color']};";
				} else {
					$button_tmp .= "color: transparent;";
				}
			} elseif ( $atts['font_color'] === 'primary' ) {
				$button_tmp .= "color: {$_primary_color};";
			} elseif ( $atts['font_color'] === 'secondary' ) {
				$button_tmp .= "color: {$_secondary_color};";
			}

			if ( $atts['button_border_color'] === 'custom' ) {
				if ( $atts['custom_button_border_color'] !== '' ) {
					$button_tmp .= "border-color: {$atts['custom_button_border_color']};";
				} else {
					$button_tmp .= "border-color: transparent;";
				}
			} elseif ( $atts['button_border_color'] === 'primary' ) {
				$button_tmp .= "border-color: {$_primary_color};";
			} elseif ( $atts['button_border_color'] === 'secondary' ) {
				$button_tmp .= "border-color: {$_secondary_color};";
			}

			// Hover.
			if ( $atts['button_bg_color_hover'] === 'custom' ) {
				if ( $atts['custom_button_bg_color_hover'] !== '' ) {
					$button_hover_tmp .= "background-color: {$atts['custom_button_bg_color_hover']};";
				} else {
					$button_hover_tmp .= "background-color: transparent;";
				}
			} elseif ( $atts['button_bg_color_hover'] === 'primary' ) {
				$button_hover_tmp .= "background-color: {$_primary_color};";
			} elseif ( $atts['button_bg_color_hover'] === 'secondary' ) {
				$button_hover_tmp .= "background-color: {$_secondary_color};";
			}

			if ( $atts['font_color_hover'] === 'custom' ) {
				if ( $atts['custom_font_color_hover'] !== '' ) {
					$button_hover_tmp .= "color: {$atts['custom_font_color_hover']};";
				} else {
					$button_hover_tmp .= "color: transparent;";
				}
			} elseif ( $atts['font_color_hover'] === 'primary' ) {
				$button_hover_tmp .= "color: {$_primary_color};";
			} elseif ( $atts['font_color_hover'] === 'secondary' ) {
				$button_hover_tmp .= "color: {$_secondary_color};";
			}

			if ( $atts['button_border_color_hover'] === 'custom' ) {
				if ( $atts['custom_button_border_color_hover'] !== '' ) {
					$button_hover_tmp .= "border-color: {$atts['custom_button_border_color_hover']};";
				} else {
					$button_hover_tmp .= "border-color: transparent;";
				}
			} elseif ( $atts['button_border_color_hover'] === 'primary' ) {
				$button_hover_tmp .= "border-color: {$_primary_color};";
			} elseif ( $atts['button_border_color_hover'] === 'secondary' ) {
				$button_hover_tmp .= "border-color: {$_secondary_color};";
			}
		}

		if ( isset( $atts['border_radius'] ) && $atts['border_radius'] !== '' ) {
			$button_tmp .= "border-radius: {$atts['border_radius']};";
		}

		if ( isset( $atts['border_padding'] ) && $atts['border_padding'] !== '' ) {
			$button_tmp .= "padding: {$atts['border_padding']};";
		}

		if ( $wrapper_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector { $wrapper_tmp }";
		}

		if ( $button_tmp !== '' ) {
			if ( $atts['style'] === 'text' ) {
				$insight_shortcode_lg_css .= "$selector .tm-button span { $button_tmp }";
			} else {
				$insight_shortcode_lg_css .= "$selector .tm-button{ $button_tmp }";
			}
		}

		if ( $button_hover_tmp !== '' ) {
			if ( $atts['style'] === 'text' ) {
				$insight_shortcode_lg_css .= "$selector .tm-button:hover span { $button_hover_tmp }";
			} else {
				$insight_shortcode_lg_css .= "$selector .tm-button:hover{ $button_hover_tmp }";
			}
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'     => esc_html__( 'Button', 'tm-moody' ),
	'base'     => 'tm_button',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-button',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Flat', 'tm-moody' )    => 'flat',
				esc_html__( 'Outline', 'tm-moody' ) => 'outline',
				esc_html__( 'Text', 'tm-moody' )    => 'text',
			),
			'std'         => 'flat',
		),
		array(
			'heading'     => esc_html__( 'Size', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Large', 'tm-moody' )       => 'lg',
				esc_html__( 'Normal', 'tm-moody' )      => 'nm',
				esc_html__( 'Small', 'tm-moody' )       => 'sm',
				esc_html__( 'Extra Small', 'tm-moody' ) => 'xs',
				esc_html__( 'Custom', 'tm-moody' )      => 'custom',
			),
			'std'         => 'nm',
		),
		array(
			'heading'     => esc_html__( 'Width', 'tm-moody' ),
			'description' => esc_html__( 'Controls the width of button.', 'tm-moody' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'width',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Height', 'tm-moody' ),
			'description' => esc_html__( 'Controls the height of button.', 'tm-moody' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'height',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Border Width', 'tm-moody' ),
			'description' => esc_html__( 'Controls the border width of button.', 'tm-moody' ),
			'type'        => 'number',
			'suffix'      => 'px',
			'param_name'  => 'border_width',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Padding', 'tm-moody' ),
			'description' => esc_html__( 'Controls the padding of button. For EX: 5px 10px', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'border_padding',
			'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		),
		array(
			'heading'     => esc_html__( 'Border Radius', 'tm-moody' ),
			'description' => esc_html__( 'Controls the rounded of button. For EX: 10px', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'border_radius',
		),
		array(
			'heading'     => esc_html__( 'Force Full Width', 'tm-moody' ),
			'description' => esc_html__( 'Make button full wide.', 'tm-moody' ),
			'type'        => 'checkbox',
			'param_name'  => 'full_wide',
			'value'       => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
		),
		array(
			'heading'    => esc_html__( 'Button', 'tm-moody' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
			'value'      => esc_html__( 'Button', 'tm-moody' ),
		),
		array(
			'heading'    => esc_html__( 'Button Alignment', 'tm-moody' ),
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
			'heading'    => esc_html__( 'Button Align on medium device', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'md_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Button Align on small device', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'sm_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Button Align on extra small device', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'xs_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-moody' ) => '',
				esc_html__( 'Left', 'tm-moody' )                       => 'left',
				esc_html__( 'Center', 'tm-moody' )                     => 'center',
				esc_html__( 'Right', 'tm-moody' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'group'      => esc_html__( 'Icon', 'tm-moody' ),
			'heading'    => esc_html__( 'Icon Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_align',
			'value'      => array(
				esc_html__( 'Left', 'tm-moody' )  => 'left',
				esc_html__( 'Right', 'tm-moody' ) => 'right',
			),
			'std'        => 'right',
		),
		array(
			'heading'     => esc_html__( 'Smooth Scroll', 'tm-moody' ),
			'description' => esc_html__( 'Make button smooth scroll to a section on click.', 'tm-moody' ),
			'type'        => 'checkbox',
			'param_name'  => 'smooth_scroll',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
	), Insight_VC::icon_libraries( array(
		'admin_label' => false,
		'allow_none'  => true,
		'param_name'  => 'icon_type',
	) ), array(
		array(
			'group'       => esc_html__( 'Color', 'tm-moody' ),
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Color', 'tm-moody' ),
			'param_name'  => 'color',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'         => 'primary',
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background color', 'tm-moody' ),
			'param_name' => 'button_bg_color',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )   => '',
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'        => 'default',
			'dependency' => array(
				'element' => 'color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Custom background color', 'tm-moody' ),
			'param_name' => 'custom_button_bg_color',
			'dependency' => array(
				'element' => 'button_bg_color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text color', 'tm-moody' ),
			'param_name' => 'font_color',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )   => '',
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'        => 'default',
			'dependency' => array(
				'element' => 'color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Custom text color', 'tm-moody' ),
			'param_name' => 'custom_font_color',
			'dependency' => array(
				'element' => 'font_color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Border color', 'tm-moody' ),
			'param_name' => 'button_border_color',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )   => '',
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'        => 'default',
			'dependency' => array(
				'element' => 'color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Custom Border color', 'tm-moody' ),
			'param_name' => 'custom_button_border_color',
			'dependency' => array(
				'element' => 'button_border_color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background color (on hover)', 'tm-moody' ),
			'param_name' => 'button_bg_color_hover',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )   => '',
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'        => 'default',
			'dependency' => array(
				'element' => 'color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Custom background color (on hover)', 'tm-moody' ),
			'param_name' => 'custom_button_bg_color_hover',
			'dependency' => array(
				'element' => 'button_bg_color_hover',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Text color (on hover)', 'tm-moody' ),
			'param_name' => 'font_color_hover',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )   => '',
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'        => 'default',
			'dependency' => array(
				'element' => 'color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Custom Text color (on hover)', 'tm-moody' ),
			'param_name' => 'custom_font_color_hover',
			'dependency' => array(
				'element' => 'font_color_hover',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Border color (on hover)', 'tm-moody' ),
			'param_name' => 'button_border_color_hover',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )   => '',
				esc_html__( 'Primary', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom', 'tm-moody' )    => 'custom',
			),
			'std'        => 'default',
			'dependency' => array(
				'element' => 'color',
				'value'   => 'custom',
			),
		),
		array(
			'group'      => esc_html__( 'Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Custom Border color (on hover)', 'tm-moody' ),
			'param_name' => 'custom_button_border_color_hover',
			'dependency' => array(
				'element' => 'button_border_color_hover',
				'value'   => 'custom',
			),
		),
	),

		Insight_VC::get_vc_spacing_tab() ),
) );
