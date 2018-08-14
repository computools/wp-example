<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$skin  = $number_color = $text_color = '';
$style = 1;
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-countdown ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

$number_classes = array( 'number' );
if ( $skin === 'custom' && $number_color === 'primary_color' ) {
	$number_classes[] = 'primary-color';
}

$text_classes = array( 'text' );
if ( $skin === 'custom' && $text_color === 'primary_color' ) {
	$text_classes[] = 'primary-color';
}

$css_id = uniqid( 'tm-countdown-' );
$this->get_inline_css( '#' . $css_id, $atts );
wp_enqueue_script( 'countdown' );
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( $css_class ); ?>"></div>
<script type="text/javascript">
	jQuery( document ).ready( function() {
		jQuery( '#<?php echo esc_js( $css_id ); ?>' )
			.countdown( "<?php echo esc_js( $datetime ); ?>", function( event ) {
				jQuery( this )
					.html( event.strftime( '<div class="countdown-wrap"><div class="day"><span class="<?php echo esc_js( join( ' ', $number_classes ) ); ?>">%D</span><span class="<?php echo esc_js( join( ' ', $text_classes ) ); ?>"><?php echo esc_js( $days ); ?></span></div><div class="separator"><span>:</span></div><div class="hour"><span class="<?php echo esc_js( join( ' ', $number_classes ) ); ?>">%H</span><span class="<?php echo esc_js( join( ' ', $text_classes ) ); ?>"><?php echo esc_js( $hours ); ?></span></div><div class="separator"><span>:</span></div><div class="minute"><span class="<?php echo esc_js( join( ' ', $number_classes ) ); ?>">%M</span><span class="<?php echo esc_js( join( ' ', $text_classes ) ); ?>"><?php echo esc_js( $minutes ); ?></span></div><div class="separator"><span>:</span></div><div class="second"><span class="<?php echo esc_js( join( ' ', $number_classes ) ); ?>">%S</span><span class="<?php echo esc_js( join( ' ', $text_classes ) ); ?>"><?php echo esc_js( $seconds ); ?></span></div></div>' ) );
			} );
	} );
</script>
