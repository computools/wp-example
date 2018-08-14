<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$el_class = $type = $icon_color = $icon_class = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-icon ' . $el_class, $this->settings['base'], $atts );

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $icon_type} );
}

if ( $icon_type === 'linea' ) {
	if ( $use_animate_svg_icon === '1' ) {
		wp_enqueue_script( 'vivus' );
	} else {
		wp_enqueue_style( 'font-linea' );
	}
}

$icon_classes = '';

if ( $icon_color === 'primary' ) {
	$icon_classes .= ' primary-color-important primary-border-color-important';
} elseif ( $icon_color === 'secondary' ) {
	$icon_classes .= ' secondary-color-important secondary-border-color-important';
}

$css_id = uniqid( 'tm-icon-' );
$this->get_inline_css( '#' . $css_id, $atts );

$css_class .= Insight_Helper::get_animation_classes( $animation );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	if ( $icon_type === 'linea' && $use_animate_svg_icon === '1' ) {
		$_icon = ${"icon_" . $icon_type};
		$_icon = str_replace( 'linea-', '', $_icon );
		$_icon = str_replace( '-', '_', $_icon );
		$_svg  = INSIGHT_THEME_URI . "/assets/svg/linea/{$_icon}.svg";
		?>
		<div class="tm-svg <?php echo esc_attr( $icon_classes ); ?>" data-svg="<?php echo esc_url( $_svg ); ?>"></div>
	<?php } else { ?>
		<div class="icon <?php echo esc_attr( $icon_classes ); ?>">
			<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
		</div>
	<?php } ?>
</div>
