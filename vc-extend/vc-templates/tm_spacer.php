<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-spacer ', $this->settings['base'], $atts );
$css_id    = uniqid( 'tm-spacer-' );
$this->get_inline_css( "#$css_id", $atts );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"></div>
