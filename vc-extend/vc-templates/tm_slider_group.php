<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$el_class = $nav = $pagination = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-group tm-swiper ' . $el_class, $this->settings['base'], $atts );

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

$css_id = uniqid( 'tm-slider-group-' );
$this->get_inline_css( '#' . $css_id, $atts );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-slide-wrap="1"
	<?php
	if ( $items_display !== '' ) {
		$arr = explode( ';', $items_display );
		foreach ( $arr as $value ) {
			$tmp = explode( ':', $value );
			echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
		}
	}
	?>
	<?php if ( $gutter > 1 ) : ?>
		data-lg-gutter="<?php echo esc_attr( $gutter ); ?>"
	<?php endif; ?>
	<?php if ( $nav !== '' ) : ?>
		data-nav="1"
	<?php endif; ?>
	<?php if ( $pagination !== '' ) : ?>
		data-pagination="1"
	<?php endif; ?>
	<?php if ( $auto_play !== '' ) : ?>
		data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
	<?php endif; ?>
	<?php if ( $loop === '1' ) : ?>
		data-loop="1"
	<?php endif; ?>
>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php echo wpb_js_remove_wpautop( $content ); ?>
		</div>
	</div>
</div>
