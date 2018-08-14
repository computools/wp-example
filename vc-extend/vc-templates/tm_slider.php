<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$loop = $equal_height = $auto_play = $nav = $pagination = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider tm-swiper ' . $el_class, $this->settings['base'], $atts );

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

if ( $equal_height === '1' ) {
	$css_class .= ' equal-height';
}

if ( $fw_image === '1' ) {
	$css_class .= ' fw-image';
}

if ( $v_center === '1' ) {
	$css_class .= ' v-center';
}


$css_id = uniqid( 'tm-slider-' );
$this->get_inline_css( '#' . $css_id, $atts );

$items = (array) vc_param_group_parse_atts( $items );
?>
<?php if ( count( $items ) > 0 ) { ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
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
				<?php foreach ( $items as $item ) { ?>
					<div class="swiper-slide">
						<div>
							<?php
							$_flag = false;
							if ( isset( $item['link'] ) ) {
								$link = vc_build_link( $item['link'] );
								if ( $link['url'] !== '' ) {
									$_target = $link['target'] !== '' ? ' target="_blank"' : '';
									$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
									echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . '>';
									$_flag = true;
								}
							}
							?>
							<?php if ( isset( $item['image'] ) ) : ?>
								<div class="image">
									<?php
									$image_url = wp_get_attachment_url( $item['image'], 'full' );

									if ( $image_size !== 'full' ) {
										$_sizes  = explode( 'x', $image_size );
										$_width  = $_sizes[0];
										$_height = $_sizes[1];

										$image_url = Insight_Helper::aq_resize( array(
											'url'    => $image_url,
											'width'  => $_width,
											'height' => $_height,
											'crop'   => true,
										) );
									}
									?>
									<img src="<?php echo esc_url( $image_url ); ?>"
									     alt="<?php echo esc_html__( 'Slide Image', 'tm-moody' ); ?>"/>
								</div>
							<?php endif; ?>
							<?php if ( isset( $item['image'] ) && ( isset( $item['title'] ) || isset( $item['text'] ) ) ) : ?>
								<div class="spacing"></div>
							<?php endif; ?>
							<?php if ( isset( $item['title'] ) ) : ?>
								<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
							<?php endif; ?>
							<?php if ( isset( $item['text'] ) ) : ?>
								<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
							<?php endif; ?>
							<?php
							if ( $_flag === true ) {
								echo '</a>';
							}
							?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php }
