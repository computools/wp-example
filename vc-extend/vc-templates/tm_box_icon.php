<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $type = $use_animate_svg_icon = $icon_color = $heading_color = $text_color = $feature = $image = $icon_class = $_content_style = $_content_classes = $_heading_style = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-box-icon-' );
$this->get_inline_css( '#' . $css_id, $atts );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-box-icon ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( isset( ${"icon_" . $type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $type} );
}

if ( $type === 'linea' ) {
	if ( $use_animate_svg_icon === '1' ) {
		wp_enqueue_script( 'vivus' );
	} else {
		wp_enqueue_style( 'font-linea' );
	}
}

if ( $icon_class !== '' ) {
	if ( $icon_color === 'primary' ) {
		$icon_class .= ' primary-color-important primary-border-color-important';
	} elseif ( $icon_color === 'secondary' ) {
		$icon_class .= ' secondary-color-important secondary-border-color-important';
	}
}

ob_start();

if ( $icon_class !== '' ) {
	?>
	<div class="icon">
		<?php
		if ( $type === 'linea' && $use_animate_svg_icon === '1' ) {
			$_icon = ${"icon_" . $type};
			$_icon = str_replace( 'linea-', '', $_icon );
			$_icon = str_replace( '-', '_', $_icon );
			$_svg  = INSIGHT_THEME_URI . "/assets/svg/linea/{$_icon}.svg";
			?>
			<div class="tm-svg" data-svg="<?php echo esc_url( $_svg ); ?>"
				<?php if ( in_array( $style, array( '6', '7' ) ) ) : ?>
					data-hover="<?php echo esc_attr( '#' . $css_id ); ?>"
				<?php endif; ?>
			></div>
		<?php } else { ?>
			<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
		<?php } ?>
	</div>
	<?php
}
$_icon_template = ob_get_contents();
ob_end_clean();

if ( $background_color === 'primary' ) {
	$css_class .= ' primary-background-color-important';
} elseif ( $background_color === 'secondary' ) {
	$css_class .= ' secondary-background-color-important';
}

$_heading_classes = 'heading';

if ( $heading_color === 'primary' ) {
	$_heading_classes .= ' primary-color-important';
} elseif ( $heading_color === 'secondary' ) {
	$_heading_classes .= ' secondary-color-important';
}

$_text_classes = 'text';

if ( $text_color === 'primary' ) {
	$_text_classes .= ' primary-color-important';
} elseif ( $text_color === 'secondary' ) {
	$_text_classes .= ' secondary-color-important';
}

$css_class .= Insight_Helper::get_animation_classes( $animation );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	if ( $overlay_background !== '' ) {
		$_overlay_style   = '';
		$_overlay_classes = 'overlay';
		if ( $overlay_background === 'primary' ) {
			$_overlay_classes .= ' primary-background-color';
		} elseif ( $overlay_background === 'overlay_custom_background' ) {
			$_overlay_style .= 'background-color: ' . $overlay_custom_background . ';';
		}
		$_overlay_style .= 'opacity: ' . $overlay_opacity / 100 . ';';

		printf( '<div class="%s" style="%s"></div>', esc_attr( $_overlay_classes ), esc_attr( $_overlay_style ) );
	}
	?>
	<div class="content-wrap">
		<?php if ( $image ) : ?>
			<div class="image">
				<?php
				$full_image_size = wp_get_attachment_url( $image, 'full' );
				$image_url       = Insight_Helper::aq_resize( array(
					'url'    => $full_image_size,
					'width'  => 500,
					'height' => 286,
					'crop'   => true,
				) );
				?>
				<img src="<?php echo esc_url( $image_url ); ?>"
				     alt="<?php echo esc_html__( 'Box Image', 'tm-moody' ) ?>"/>
			</div>
		<?php endif; ?>

		<?php if ( ! in_array( $style, array( '3' ) ) ) : ?>
			<?php echo '' . $_icon_template; ?>
		<?php endif; ?>
		<div class="content">
			<div class="box-header">
				<?php if ( in_array( $style, array( '3' ) ) ) : ?>
					<?php echo '' . $_icon_template; ?>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
					<h4 class="<?php echo esc_attr( $_heading_classes ); ?>">
						<?php
						// Item Link.
						$link = vc_build_link( $link );
						if ( $link['url'] !== '' ) {
						?>
						<a class="link-secret" href="<?php echo esc_url( $link['url'] ); ?>"
							<?php if ( $link['target'] !== '' ): ?>
								target="<?php echo esc_attr( $link['target'] ); ?>"
							<?php endif; ?>
						>
							<?php } ?>

							<?php echo esc_html( $heading ); ?>

							<?php if ( $link['url'] !== '' ) { ?>
						</a>
					<?php } ?>

					</h4>
				<?php endif; ?>
			</div>
			<?php if ( $text ) : ?>
				<div class="<?php echo esc_attr( $_text_classes ); ?>">
					<?php echo esc_html( $text ); ?>
				</div>
			<?php endif; ?>

			<?php
			// Button.
			if ( $button && $button !== '' ) {
				$button = vc_build_link( $button );
				if ( $button['url'] !== '' ) {
					$button_classes = 'tm-button style-text tm-button-xs tm-box-icon__btn';
					if ( $button_color === 'primary' ) {
						$button_classes .= ' tm-button-primary';
					} elseif ( $button_color === 'secondary' ) {
						$button_classes .= ' tm-button-secondary';
					} else {
						$button_classes .= ' heading-color';
					}
					?>
					<a class="<?php echo esc_attr( $button_classes ); ?>"
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
