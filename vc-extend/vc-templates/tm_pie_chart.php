<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pie-chart ' . $el_class, $this->settings['base'], $atts );

$_bar_color      = $_track_color = '';
$primary_color   = Insight::setting( 'primary_color' );
$secondary_color = Insight::setting( 'secondary_color' );

if ( $bar_color === 'primary' ) {
	$_bar_color = '{ "color": "' . $primary_color . '" }';
} elseif ( $bar_color === 'secondary' ) {
	$_bar_color = '{ "color": "' . $secondary_color . '" }';
} elseif ( $bar_color === 'gradient' ) {
	$_bar_color = '{"gradient": ["' . $primary_color . '", "' . $secondary_color . '"]}';
} else {
	$_bar_color = '{ "color": "' . $custom_bar_color . '" }';
}

if ( $track_color === 'primary' ) {
	$_track_color = $primary_color;
} elseif ( $track_color === 'secondary' ) {
	$_track_color = $secondary_color;
} elseif ( $track_color === '' ) {
	$_track_color = 'rgba(170, 170, 170, .2)';
} else {
	if ( $custom_track_color ) {
		$_track_color = $custom_track_color;
	} else {
		$_track_color = 'transparent';
	}

}

wp_enqueue_script( 'circle-progress' );
wp_enqueue_script( 'insight-pie-chart' );

$value = $number / 100;

$css_id = uniqid( 'tm-pie-chart-' );
$this->get_inline_css( '#' . $css_id );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="chart"
	     data-fill="<?php echo esc_attr( $_bar_color ); ?>"
	     data-empty-fill="<?php echo esc_attr( $_track_color ); ?>"
	     data-thickness="<?php echo esc_attr( $line_width ); ?>"
	     data-size="<?php echo esc_attr( $size ); ?>"
	     data-value="<?php echo esc_attr( $value ); ?>"
	     data-line-cap="<?php echo esc_attr( $line_cap ); ?>"
		<?php
		printf( 'style="width: %spx; height: %spx;"', $size, $size );
		?>
	>
		<div class="inner-circle">
			<h6 class="piecharts-number"
			    data-max="<?php echo esc_attr( $number ); ?>"
			    data-units="<?php echo esc_attr( $unit ); ?>">
				0<span>%</span>
			</h6>
		</div>
	</div>
	<?php if ( isset( $title ) ) : ?>
		<div class="title"><h6><?php echo esc_html( $title ); ?></h6></div>
	<?php endif; ?>
	<?php if ( isset( $subtitle ) ) : ?>
		<div class="subtitle"><?php echo esc_html( $subtitle ); ?></div>
	<?php endif; ?>
</div>
