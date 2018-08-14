<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row_Inner
 */
$el_class        = $equal_height = $content_placement = $css = $el_id = '';
$disable_element = '';
$output          = $after_output = '';
$atts            = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class    = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( $background_color === 'primary' ) {
	$css_classes[] = 'primary-background-color';
} elseif ( $background_color === 'secondary' ) {
	$css_classes[] = 'secondary-background-color';
}
if ( $overlay_background !== '' ) {
	$css_classes[] = 'vc_row-has-overlay';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper.

$css_id = uniqid( 'tm-row-inner-' );
Insight_VC::get_vc_row_inner_css( '#' . $css_id, $atts );
$wrapper_attributes[] = 'id="' . esc_attr( $css_id ) . '"';

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $overlay_background !== '' ) {
	$_overlay_row_style   = '';
	$_overlay_row_classes = 'vc_row-overlay';
	if ( $overlay_background === 'primary' ) {
		$_overlay_row_classes .= ' primary-background-color';
	} elseif ( $overlay_background === 'secondary' ) {
		$_overlay_row_classes .= ' secondary-background-color';
	} elseif ( $overlay_background === 'overlay_custom_background' ) {
		$_overlay_row_style .= 'background-color: ' . $overlay_custom_background . ';';
	}
	$_overlay_row_style .= 'opacity: ' . $overlay_opacity / 100 . ';';

	$output .= sprintf( '<div class="%s" style="%s"></div>', esc_attr( $_overlay_row_classes ), esc_attr( $_overlay_row_style ) );
}

$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo '' . $output;
