<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$smooth_scroll = $align = $el_class = '';
$atts          = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-button-wrapper ' . $el_class, $this->settings['base'], $atts );
$css_id    = uniqid( 'tm-button-' );
$this->get_inline_css( "#$css_id", $atts );
$classes = "tm-button";
$classes .= " style-$style";
$classes .= " tm-button-$size";
$classes .= " tm-button-$color";

$icon_class = '';
if ( isset( $icon_type ) && isset( ${"icon_" . $icon_type} ) ) {
	$icon_class .= esc_attr( ${"icon_" . $icon_type} );
	$classes    .= " has-icon icon-$icon_align";
}

if ( $full_wide === '1' ) {
	$classes .= ' tm-button-full-wide';
}

$button = vc_build_link( $button );

if ( $smooth_scroll !== '' ) {
	$classes .= " smooth-scroll-link";
}

if ( $animation === '' ) {
	$animation = Insight::setting( 'shortcode_button_css_animation' );
}
$css_class .= Insight_Helper::get_animation_classes( $animation );

if ( $style === 'text' ) {
	$classes .= ' heading-color';
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	$_button_title = $button['title'] !== '' ? $button['title'] : esc_html__( 'Button Text', 'tm-moody' );
	?>
	<a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $button['url'] ); ?>"
		<?php if ( $button['target'] !== '' ) {
			echo 'target="' . $button['target'] . '"';
		} ?>
	>
		<?php if ( $style === 'text' ) : ?>
			<span class="button-text">
				<?php echo esc_html( $_button_title ); ?>
			</span>
			<span class="button-icon icon-arrow-2-right"></span>
		<?php else: ?>
			<?php if ( $icon_class !== '' && $icon_align === 'left' ) { ?>
				<span class="button-icon <?php echo esc_attr( $icon_class ); ?>"></span>
			<?php } ?>
			<span class="button-text">
			<?php echo esc_html( $_button_title ); ?>
		</span>
			<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
				<span class="button-icon <?php echo esc_attr( $icon_class ); ?>"></span>
			<?php } ?>
		<?php endif; ?>
	</a>
</div>
