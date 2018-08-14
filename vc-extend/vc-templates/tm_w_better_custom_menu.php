<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$title  = $nav_menu = $el_class = $style = $alignment = '';
$output = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-custom-menu ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " $alignment";
$output    = '<div class="' . esc_attr( $css_class ) . '">';
$type      = 'InsightCore_BMW';
$args      = array();
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget.
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo '' . $output;
} else {
	echo '' . $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : tm_w_better_custom_menu' );
}
