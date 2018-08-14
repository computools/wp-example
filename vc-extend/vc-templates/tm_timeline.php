<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-timeline ' . $el_class, $this->settings['base'], $atts );
if ( $style !== '' ) {
	$css_class .= " style-$style";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<ul class="tm-animation-queue" data-animation-delay="400">
		<?php foreach ( $items as $item ) { ?>
			<li class="item">
				<?php if ( isset( $item['time'] ) ) : ?>
					<div class="time"><?php echo esc_html( $item['time'] ); ?></div>
				<?php endif; ?>
				<div class="content-wrap">
					<?php if ( isset( $item['title'] ) ) : ?>
						<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
					<?php endif; ?>
					<?php if ( isset( $item['image'] ) ) : ?>
						<div class="photo">
							<?php
							$full_image_size = wp_get_attachment_url( $item['image'] );
							$image_url       = Insight_Helper::aq_resize( array(
								'url'    => $full_image_size,
								'width'  => 400,
								'height' => 200,
								'crop'   => true,
							) );
							?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo 'Photo'; ?>"/>
						</div>
					<?php endif; ?>
					<?php if ( isset( $item['text'] ) ) : ?>
						<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
					<?php endif; ?>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>
