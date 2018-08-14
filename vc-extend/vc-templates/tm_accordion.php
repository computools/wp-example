<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-accordion ' . $el_class, $this->settings['base'], $atts );

$items = (array) vc_param_group_parse_atts( $items );
wp_enqueue_script( 'insight-accordion' );
?>
<?php if ( count( $items ) > 0 ) { ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>"
		<?php
		if ( $multi_open === '1' ) {
			echo 'data-multi-open="1"';
		}
		?>

	>
		<?php
		$i = 0;
		foreach ( $items as $item ) {
			?>

			<div class="accordion-section <?php if ( $i == 0 ) {
				echo 'active';
			} ?>">
				<h6 class="accordion-title">
					<?php if ( isset( $item['title'] ) ) { ?>
						<?php echo esc_html( $item['title'] ); ?>
						<span class="accordion-icon"></span>
					<?php } ?>

				</h6>
				<div class="accordion-content">
					<?php if ( isset( $item['content'] ) ) : ?>
						<?php echo wp_kses( $item['content'], 'moody-default' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<?php
			$i++;
		}
		?>
	</div>
<?php }
