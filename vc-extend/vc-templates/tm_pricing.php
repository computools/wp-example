<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $animation = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pricing ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= Insight_Helper::get_animation_classes( $animation );

$_button_classes = 'tm-button style-flat smooth-scroll-link tm-pricing-button';

if ( $style === '2' ) {
	$_button_classes .= ' tm-button-secondary';
} elseif ( $style === '1' ) {
	$_button_classes .= ' tm-button-primary';
}

if ( $featured === '1' ) {
	$css_class .= ' tm-pricing-featured';
}

$css_id = uniqid( 'tm-pricing-' );
$this->get_inline_css( '#' . $css_id, $atts );

$button = vc_build_link( $button );

$items = (array) vc_param_group_parse_atts( $items );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="inner">

		<?php if ( in_array( $style, array( '3' ) ) ) { ?>
			<div class="tm-pricing-header">
				<?php if ( $image !== '' ) {
					$image_template = wp_get_attachment_image( $image, 'full' );
					if ( ! $image_template ) :
						echo '<div class="image">' . $image_template . '</div>';
					endif;
				}
				?>

				<h5 class="title"><?php echo esc_html( $title ); ?></h5>

				<div class="price-wrap">
					<div class="price-wrap-inner">
						<h5 class="price"><?php echo esc_html( $currency ); ?><?php echo esc_html( $price ); ?></h5>
						<h6 class="period"><?php echo esc_html( $period ); ?></h6>
					</div>
				</div>

				<div class="description"><?php echo esc_html( $desc ); ?></div>
			</div>
			<div class="tm-pricing-content">
				<?php if ( count( $items ) > 0 ) { ?>
					<ul class="tm-pricing-list">
						<?php
						foreach ( $items as $data ) { ?>
							<li>
								<?php if ( isset( $data['icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
								<?php endif; ?>
								<?php if ( isset( $data['text'] ) ) : ?>
									<?php echo '<span>' . esc_html( $data['text'] ) . '</span>'; ?>
								<?php endif; ?>
							</li>
							<?php
						}
						?>
					</ul>
				<?php } ?>
			</div>
			<?php if ( $button['url'] !== '' ) { ?>
				<div class="tm-pricing-footer">
					<?php
					$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'tm-moody' );
					printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
					?>
				</div>
			<?php } ?>
		<?php } else { ?>
			<?php if ( $featured === '1' ) : ?>
				<div class="tm-pricing-rating"><i class="fa fa-star"></i></div>
			<?php endif; ?>
			<div class="tm-pricing-header">
				<?php if ( $image !== '' ) {
					$image_template = wp_get_attachment_image( $image, 'full' );
					if ( ! $image_template ) :
						echo '<div class="image">' . $image_template . '</div>';
					endif;
				}
				?>
				<div class="price-wrap">
					<div class="price-wrap-inner">
						<h5 class="price"><?php echo esc_html( $currency ); ?><?php echo esc_html( $price ); ?></h5>
						<h6 class="period"><?php echo esc_html( $period ); ?></h6>
					</div>
				</div>
				<h5 class="title"><?php echo esc_html( $title ); ?></h5>
				<div class="description"><?php echo esc_html( $desc ); ?></div>
			</div>
			<div class="tm-pricing-content">
				<?php if ( count( $items ) > 0 ) { ?>
					<ul class="tm-pricing-list">
						<?php
						foreach ( $items as $data ) { ?>
							<li>
								<?php if ( isset( $data['icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
								<?php endif; ?>
								<?php if ( isset( $data['text'] ) ) : ?>
									<?php echo '<span>' . esc_html( $data['text'] ) . '</span>'; ?>
								<?php endif; ?>
							</li>
							<?php
						}
						?>
					</ul>
				<?php } ?>
			</div>
			<?php if ( $button['url'] !== '' ) { ?>
				<div class="tm-pricing-footer">
					<?php
					$_button_title = $button['title'] != '' ? $button['title'] : esc_html__( 'Sign Up', 'tm-moody' );
					printf( '<a href="%s" %s %s class="%s">%s</a>', $button['url'], $button['target'] != '' ? 'target="' . esc_attr( $button['target'] ) . '"' : '', $button['rel'] != '' ? 'rel="' . esc_attr( $button['rel'] ) . '"' : '', $_button_classes, $_button_title );
					?>
				</div>
			<?php } ?>
		<?php } ?>

	</div>
</div>
