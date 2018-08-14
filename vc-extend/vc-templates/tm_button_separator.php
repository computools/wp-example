<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-button-separator ' . $el_class, $this->settings['base'], $atts );
$css_id    = uniqid( 'tm-button-separator-' );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="vc_separator vc_separator_align_center">
		<span class="vc_sep_holder vc_sep_holder_l">
			<span class="vc_sep_line"></span>
		</span>
		<h4 class="p-0">
			<a class="scrollup"><i class="fa fa-angle-up"></i></a>
		</h4>
		<span class="vc_sep_holder vc_sep_holder_r">
			<span class="vc_sep_line"></span>
		</span>
	</div>
</div>
