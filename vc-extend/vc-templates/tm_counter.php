<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $el_class = $text = $icon_class = $skin = $number_prefix = $number_suffix = $animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-counter ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " align-$align";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

if ( isset( ${"icon_" . $type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $type} );
}
if ( $skin === 'custom' && $icon_class !== '' ) {
	if ( $icon_color === 'primary_color' ) {
		$icon_class .= ' primary-color-important';
	} elseif ( $icon_color === 'secondary_color' ) {
		$icon_class .= ' secondary-color-important';
	}
}

$number_wrap_classes = array( 'number-wrap' );
if ( $skin === 'dark' || ( $skin === 'custom' && $number_color === 'primary_color' ) ) {
	$number_wrap_classes[] = 'primary-color-important';
}
if ( $skin === 'custom' && $number_color === 'secondary_color' ) {
	$number_wrap_classes[] = 'secondary-color-important';
}

$text_classes = array( 'text' );
if ( $skin === 'custom' ) {
	if ( $text_color === 'primary_color' ) {
		$text_classes[] = 'primary-color-important';
	} elseif ( $text_color === 'secondary_color' ) {
		$text_classes[] = 'secondary-color-important';
	}
}

$css_id = uniqid( 'tm-counter-' );
$this->get_inline_css( '#' . $css_id, $atts );

if ( $animation === 'odometer' ) {
	wp_enqueue_script( 'odometer' );
} else {
	wp_enqueue_script( 'counter-up' );
}
wp_enqueue_script( 'counter' );
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>"
     data-animation="<?php echo esc_attr( $animation ); ?>"
>
	<div class="counter-wrap">
		<?php if ( $icon_class !== '' ) : ?>
			<div class="icon">
				<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
			</div>
		<?php endif; ?>

		<?php if ( $number !== '' ) : ?>
			<div class="<?php echo esc_attr( join( ' ', $number_wrap_classes ) ); ?>">
				<?php if ( $number_prefix !== '' ) : ?>
					<span class="number-prefix"><?php echo esc_html( $number_prefix ); ?></span>
				<?php endif; ?>
				<span class="number"><?php echo esc_html( $number ); ?></span>
				<?php if ( $number_suffix !== '' ) : ?>
					<span class="number-suffix">&nbsp;<?php echo esc_html( $number_suffix ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( $text !== '' ) : ?>
			<?php
			printf( '<h6 class="%s">%s</h6>', join( ' ', $text_classes ), esc_html( $text ) );
			?>
		<?php endif; ?>
	</div>
</div>
