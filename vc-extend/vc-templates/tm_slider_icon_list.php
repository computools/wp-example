<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $loop = $equal_height = $auto_play = $nav = $pagination = $el_class = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-slider-icon-list tm-swiper ' . $el_class, $this->settings['base'], $atts );

if ( $style !== '' ) {
	$css_class .= " style-$style";
}

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " pagination-style-$pagination";
}

if ( $equal_height === '1' ) {
	$css_class .= ' equal-height';
}

if ( $v_center === '1' ) {
	$css_class .= ' v-center';
}

$css_id = uniqid( 'tm-slider-icon-list-' );
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
				<?php if ( $style === 'numbered-manual' ) { ?>
					<?php
					$_count = count( $items );
					$_loop  = 1;
					?>
					<?php foreach ( $items as $item ) { ?>
						<div class="swiper-slide">
							<div class="slide-item-wrapper">
								<?php
								$_has_link = false;
								if ( isset( $item['link'] ) ) {
									$link = vc_build_link( $item['link'] );
									if ( $link['url'] !== '' ) {
										$_target = $link['target'] !== '' ? ' target="_blank"' : '';
										$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
										echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . '>';
										$_has_link = true;
									}
								}
								?>
								<?php if ( isset( $item['number'] ) ): ?>
									<div class="marker number">
										<?php echo esc_html( $item['number'] ); ?>
									</div>
								<?php endif; ?>
								<div class="slide-content-wrapper">
									<?php if ( isset( $item['title'] ) ) : ?>
										<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
									<?php endif; ?>
									<?php if ( isset( $item['text'] ) ) : ?>
										<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
									<?php endif; ?>
								</div>
								<?php
								if ( $_has_link === true ) {
									echo '</a>';
								}
								?>
							</div>
						</div>
						<?php $_loop++; ?>
					<?php } ?>
				<?php } else { ?>
					<?php
					$_count = count( $items );
					$_loop  = 1;
					?>
					<?php foreach ( $items as $item ) { ?>

						<?php if ( $_loop % 2 !== 0 ) : ?>
							<div class="swiper-slide">
						<?php endif; ?>

						<div class="slide-item-wrapper">
							<?php
							$_has_link = false;
							if ( isset( $item['link'] ) ) {
								$link = vc_build_link( $item['link'] );
								if ( $link['url'] !== '' ) {
									$_target = $link['target'] !== '' ? ' target="_blank"' : '';
									$_title  = $link['title'] !== '' ? ' title="' . esc_attr( $link['title'] ) . '"' : '';
									echo '<a href="' . esc_url( $link['url'] ) . '"' . $_target . $_title . '>';
									$_has_link = true;
								}
							}
							?>
							<?php
							$icon_class = '';

							if ( isset( $item['type'] ) && isset( $item[ "icon_" . $item['type'] ] ) ) {
								$icon_class .= esc_attr( $item[ "icon_" . $item['type'] ] );
							}
							?>
							<?php if ( $icon_class !== '' ): ?>
								<div class="marker icon">
									<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
								</div>
							<?php endif; ?>
							<div class="slide-content-wrapper">
								<?php if ( isset( $item['title'] ) ) : ?>
									<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
								<?php endif; ?>
								<?php if ( isset( $item['text'] ) ) : ?>
									<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
								<?php endif; ?>
							</div>
							<?php
							if ( $_has_link === true ) {
								echo '</a>';
							}
							?>
						</div>

						<?php if ( $_loop % 2 === 0 || $_loop === $_count ) : ?>
							</div>
						<?php endif; ?>
						<?php $_loop++; ?>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php }
