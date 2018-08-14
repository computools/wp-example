<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pricing-group ' . $el_class, $this->settings['base'], $atts );
$css_id    = uniqid( 'tm-pricing-group-' );
$this->get_inline_css( '#' . $css_id, $atts );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="pricing-wrap">
		<?php echo wpb_js_remove_wpautop( $content ); ?>
	</div>
</div>
