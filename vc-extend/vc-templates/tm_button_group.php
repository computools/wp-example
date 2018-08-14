<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-button-group ' . $el_class, $this->settings['base'], $atts );
$css_id    = uniqid( 'tm-button-group-' );
//$this->get_inline_css( '#' . $css_id, $atts );
$css_class .= ' ' . $align;
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>
