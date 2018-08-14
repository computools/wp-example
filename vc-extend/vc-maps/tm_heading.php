<?php

class WPBakeryShortCode_TM_Heading extends WPBakeryShortCode {

	/**
	 * Defines fields names for google_fonts, font_container and etc
	 *
	 * @since 4.4
	 * @var array
	 */
	protected $fields = array(
		'google_fonts' => 'google_fonts',
		'el_class'     => 'el_class',
		'css'          => 'css',
		'text'         => 'text',
	);

	/**
	 * Parses shortcode attributes and set defaults based on vc_map function relative to shortcode and fields names
	 *
	 * @param $atts
	 *
	 * @since 4.3
	 * @return array
	 */
	public function getAttributes( $atts ) {
		/**
		 * Shortcode attributes
		 *
		 * @var $text
		 * @var $google_fonts
		 * @var $el_class
		 * @var $css
		 */
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		extract( $atts );

		/**
		 * Get default values from VC_MAP.
		 */
		$google_fonts_field = $this->getParamData( 'google_fonts' );

		$el_class                    = $this->getExtraClass( $el_class );
		$google_fonts_obj            = new Vc_Google_Fonts();
		$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
		$google_fonts_data           = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

		return array(
			'text'              => isset( $text ) ? $text : '',
			'google_fonts'      => $google_fonts,
			'el_class'          => $el_class,
			'css'               => $css,
			'google_fonts_data' => $google_fonts_data,
		);
	}

	/**
	 * Get param value by providing key
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return array|bool
	 */
	protected function getParamData( $key ) {
		return WPBMap::getParam( $this->shortcode, $this->getField( $key ) );
	}

	/**
	 * Used to get field name in vc_map function for google_fonts, font_container and etc..
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return bool
	 */
	protected function getField( $key ) {
		return isset( $this->fields[ $key ] ) ? $this->fields[ $key ] : false;
	}

	/**
	 * Parses google_fonts_data to get needed css styles to markup
	 *
	 * @param $el_class
	 * @param $css
	 * @param $google_fonts_data
	 * @param $atts
	 *
	 * @since 4.3
	 * @return array
	 */
	public function getStyles( $el_class, $css, $google_fonts_data, $atts ) {
		$styles = array();
		if ( ( ! isset( $atts['custom_google_font'] ) || 'yes' !== $atts['custom_google_font'] ) && ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) ) {
			$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
			$styles[]            = 'font-family:' . $google_fonts_family[0];
		}

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-heading ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		return array(
			'css_class' => trim( preg_replace( '/\s+/', ' ', $css_class ) ),
			'styles'    => $styles,
		);
	}

	public function get_inline_css( $selector_id = '' ) {
		global $insight_shortcode_lg_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;
		$atts     = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		$selector = '#' . $selector_id;
		$css      = '';
		$tmp      = '';

		$css .= "$selector{ text-align: {$atts['align']} }";

		if ( $atts['md_align'] !== '' ) {
			$insight_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$insight_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$insight_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		$font_size = $atts['font_size'];
		$title     = $selector . ' .heading';

		if ( $atts['max_width'] !== '' ) {
			$tmp .= "max-width: {$atts['max_width']};";
		}
		if ( $atts['line_height'] !== '' ) {
			$tmp .= "line-height: {$atts['line_height']};";
		}
		if ( $atts['letter_spacing'] !== '' ) {
			$tmp .= "letter-spacing: {$atts['letter_spacing']};";
		}
		if ( $atts['font_weight'] !== '' ) {
			$tmp .= "font-weight: {$atts['font_weight']};";
		}
		if ( $atts['font_style'] !== '' ) {
			$tmp .= "font-style: {$atts['font_style']};";
		}

		if ( $tmp !== '' ) {
			$css .= "$title { $tmp }";
		}

		Insight_VC::get_responsive_css( array(
			'element' => $title,
			'atts'    => array(
				'font-size' => array(
					'media_str' => $font_size,
					'unit'      => 'px',
				),
			),
		) );

		$css .= Insight_VC::get_vc_spacing_css( $selector, $atts );

		$insight_shortcode_lg_css .= $css;


		$icon_tmp = '';

		if ( $atts['icon_color'] === 'custom' ) {
			$icon_tmp .= "color: {$atts['custom_icon_color']}; ";
		}

		if ( $icon_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .icon { $icon_tmp }";
		}

		if ( isset( $atts['icon_font_size'] ) ) {
			Insight_VC::get_responsive_css( array(
				'element' => "$selector .icon",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $atts['icon_font_size'],
						'unit'      => 'px',
					),
				),
			) );
		}
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Heading', 'tm-moody' ),
	'base'                      => 'tm_heading',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-typography',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Normal', 'tm-moody' )                => '',
				esc_html__( 'Highlight', 'tm-moody' )             => 'highlight-text',
				esc_html__( 'Highlight and Typed', 'tm-moody' )   => 'typed-text',
				esc_html__( 'Highlight and Typed 2', 'tm-moody' ) => 'typed-text-2',
			),
			'std'         => '',
		),
		array(
			'heading'     => esc_html__( 'Text', 'tm-moody' ),
			'type'        => 'textarea',
			'param_name'  => 'text',
			'description' => esc_html__( 'Wrap text in &lt;mark&gt;&lt;/mark&gt; tag to make text highlight', 'tm-moody' ),
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Typed String', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'typed_list',
			'params'     => array_merge( array(
				array(
					'heading'     => esc_html__( 'Text', 'tm-moody' ),
					'type'        => 'textfield',
					'param_name'  => 'text',
					'admin_label' => true,
				),
			) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'typed-text',
					'typed-text-2',
				),
			),

		),
		array(
			'heading'     => esc_html__( 'Link', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'link',
			'description' => esc_html__( 'Input link for heading.', 'tm-moody' ),
		),
		array(
			'heading'    => esc_html__( 'Element Tag', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'tag',
			'value'      => array(
				esc_html__( 'h1', 'tm-moody' )  => 'h1',
				esc_html__( 'h2', 'tm-moody' )  => 'h2',
				esc_html__( 'h3', 'tm-moody' )  => 'h3',
				esc_html__( 'h4', 'tm-moody' )  => 'h4',
				esc_html__( 'h5', 'tm-moody' )  => 'h5',
				esc_html__( 'h6', 'tm-moody' )  => 'h6',
				esc_html__( 'p', 'tm-moody' )   => 'p',
				esc_html__( 'div', 'tm-moody' ) => 'div',
			),
			'std'        => 'h3',
		),
		array(
			'heading'    => esc_html__( 'Use custom font family', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_google_font',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => 1 ),
			'std'        => 0,
		),
		array(
			'type'       => 'google_fonts',
			'param_name' => 'google_fonts',
			'value'      => 'font_family:' . rawurlencode( 'Poppins:300,regular,500,600,700' ) . '|font_style:' . rawurlencode( '600 semi-bold regular:600:normal' ),
			'settings'   => array(
				'fields' => array(
					'font_family_description' => esc_html__( 'Select font family.', 'tm-moody' ),
					'font_style_description'  => esc_html__( 'Select font styling.', 'tm-moody' ),
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Font Size', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'heading'     => esc_html__( 'Letter Spacing', 'tm-moody' ),
			'description' => esc_html__( 'Ex: 5px or 0.02em', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'letter_spacing',
		),
		array(
			'heading'     => esc_html__( 'Line Height', 'tm-moody' ),
			'description' => esc_html__( 'Ex: 18px or 1.8', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'line_height',
		),
		array(
			'heading'    => esc_html__( 'Font Weight', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'font_weight',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' )           => '',
				esc_html__( '100 - Ultra Light', 'tm-moody' ) => '100',
				esc_html__( '200 - Light', 'tm-moody' )       => '200',
				esc_html__( '300 - Book', 'tm-moody' )        => '300',
				esc_html__( '400 - Regular', 'tm-moody' )     => '400',
				esc_html__( '500 - Medium', 'tm-moody' )      => '500',
				esc_html__( '600 - SemiBold', 'tm-moody' )    => '600',
				esc_html__( '700 - Bold', 'tm-moody' )        => '700',
				esc_html__( '800 - Extra Bold', 'tm-moody' )  => '800',
				esc_html__( '900 - Ultra Bold', 'tm-moody' )  => '900',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Font Style', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'font_style',
			'value'      => array(
				esc_html__( 'Default', 'tm-moody' ) => '',
				esc_html__( 'Italic', 'tm-moody' )  => 'italic',
			),
			'std'        => '',
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
			'heading'    => esc_html__( 'Text Align on Medium Device', 'tm-moody' ),
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
			'heading'    => esc_html__( 'Text Align on Small Device', 'tm-moody' ),
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
			'heading'    => esc_html__( 'Text Align on Extra Small Device', 'tm-moody' ),
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
			'heading'    => esc_html__( 'Text Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-moody' )   => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary_color',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Text Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom' ),
			),
			'std'        => '#222',
		),
		array(
			'heading'     => esc_html__( 'Max Width', 'tm-moody' ),
			'description' => esc_html__( 'Input the max width that makes text multi lines. For ex: 400px', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'max_width',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		// Design Options Group.
		Insight_VC::css_editor_field(),
		array(
			'group'        => esc_html__( 'Design Options', 'tm-moody' ),
			'heading'      => esc_html__( 'Medium Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'md_spacing',
			'spacing_icon' => 'fa-tablet fa-rotate-270',
		),
		array(
			'group'        => esc_html__( 'Design Options', 'tm-moody' ),
			'heading'      => esc_html__( 'Small Device Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'sm_spacing',
			'spacing_icon' => 'fa-tablet',
		),
		array(
			'group'        => esc_html__( 'Design Options', 'tm-moody' ),
			'heading'      => esc_html__( 'Extra Small Spacing', 'tm-moody' ),
			'type'         => 'spacing',
			'param_name'   => 'xs_spacing',
			'spacing_icon' => 'fa-mobile',
		),
	), Insight_VC::icon_libraries( array(
		'admin_label' => false,
		'allow_none'  => true,
		'param_name'  => 'icon_type',
	) ), array(
		array(
			'group'       => esc_html__( 'Icon', 'tm-moody' ),
			'heading'     => esc_html__( 'Icon Font Size', 'tm-moody' ),
			'description' => esc_html__( 'Leave blank to inherit from title', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'icon_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'group'      => esc_html__( 'Icon', 'tm-moody' ),
			'heading'    => esc_html__( 'Icon Color', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__( 'Inherit', 'tm-moody' )         => '',
				esc_html__( 'Primary Color', 'tm-moody' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-moody' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-moody' )    => 'custom',
			),
			'std'        => '',
		),
		array(
			'group'      => esc_html__( 'Icon', 'tm-moody' ),
			'heading'    => esc_html__( 'Custom Icon Color', 'tm-moody' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_color',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => 'custom',
			),
			'std'        => '#fff',
		),
	) ),
) );
