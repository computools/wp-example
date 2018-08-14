<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $video = $poster = $image_size = $overlay_style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-popup-video ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
if ( $overlay_style !== '' ) {
	$css_class .= " overlay-style-$overlay_style";
}
?>
<?php if ( $video !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
		<a href="<?php echo esc_url( $video ); ?>">
			<?php if ( in_array( $style, array( 'poster', 'poster-2', 'poster-3' ) ) ) { ?>
				<?php
				$full_image_size = wp_get_attachment_url( $poster, 'full' );

				$_sizes  = explode( 'x', $image_size );
				$_width  = $_sizes[0];
				$_height = $_sizes[1];

				$image_url = Insight_Helper::aq_resize( array(
					'url'    => $full_image_size,
					'width'  => $_width,
					'height' => $_height,
					'crop'   => true,
				) );
				?>
				<img src="<?php echo esc_url( $image_url ); ?>"
				     alt=""/>
				<div class="video-overlay">
					<div class="video-play">
						<i class="fa fa-play"></i>
					</div>
				</div>
			<?php } elseif ( in_array( $style, array( 'button-2' ) ) ) { ?>
				<div class="video-wrap">
					<div class="video-play">
						<i class="fa fa-play"></i>
					</div>
					<?php if ( $video_text !== '' ): ?>
						<div class="video-text">
							<?php echo esc_html( $video_text ); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php } else { ?>
				<div class="video-play">
					<i class="fa fa-play"></i>
				</div>
			<?php } ?>
		</a>
	</div>
<?php endif;
