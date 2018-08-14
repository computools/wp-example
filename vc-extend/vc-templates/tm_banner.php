<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $image = $text = $button = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-banner ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_id = uniqid( 'tm-banner-' );
$this->get_inline_css( '#' . $css_id, $atts );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="content-wrap"
		<?php if ( $image ) : ?>
			<?php
			$full_image_size = wp_get_attachment_url( $image, 'full' );
			$image_url       = Insight_Helper::aq_resize( array(
				'url'    => $full_image_size,
				'width'  => 552,
				'height' => 320,
				'crop'   => true,
			) );
			?>
		<?php endif; ?>
		 style="background-image: url( <?php echo esc_url( $image_url ); ?> );"
	>
		<div class="content">
			<?php if ( $text ) : ?>
				<?php echo '<h6 class="heading">' . $text . '</h6>'; ?>
			<?php endif; ?>
			<?php
			// Button.
			if ( $button && $button !== '' ) {
				$button = vc_build_link( $button );
				if ( $button['url'] !== '' ) {
					?>
					<a class="tm-button style-text tm-button-primary tm-button-xs tm-banner-button heading-color"
					   href="<?php echo esc_url( $button['url'] ) ?>"
						<?php if ( $button['target'] !== '' ) { ?>
							target="<?php echo esc_attr( $button['target'] ); ?>"
						<?php } ?>
					>
						<span class="button-text"><?php echo esc_html( $button['title'] ); ?></span>
						<span class="button-icon icon-arrow-2-right"></span>
					</a>
				<?php }
			} ?>
		</div>
	</div>
</div>
