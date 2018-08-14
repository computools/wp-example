<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-contact-form-7 ' . $el_class, $this->settings['base'], $atts );

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
	wpcf7_enqueue_scripts();
}

if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
	wpcf7_enqueue_styles();
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php echo do_shortcode( '[contact-form-7 id="' . $id . '"]' ); ?>
</div>
