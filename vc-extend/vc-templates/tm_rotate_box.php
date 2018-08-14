<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$el_class            = $direction = $front_background_color = $back_background_color = $front_heading = $front_text = $front_button = $back_heading = $back_text = $back_button = '';
$front_heading_color = $front_text_color = $front_button_color = $back_heading_color = $back_text_color = $back_button_color = $front_button_style = $back_button_style = '';
$atts                = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-rotate-box ' . $el_class, $this->settings['base'], $atts );

$css_id = uniqid( 'tm-rotate-box-' );
$this->get_inline_css( "#$css_id", $atts );

$css_class .= " style-$style";

$css_class .= Insight_Helper::get_animation_classes( $animation );

$flipper_classes = 'flipper';
$flipper_classes .= " to-$direction";

$front_classes = 'front';
if ( $front_background_color === 'primary' ) {
	$front_classes .= ' primary-background-color-important';
} elseif ( $front_background_color === 'secondary' ) {
	$front_classes .= ' secondary-background-color-important';
}

$back_classes = 'back';
if ( $back_background_color === 'primary' ) {
	$back_classes .= ' primary-background-color-important';
} elseif ( $back_background_color === 'secondary' ) {
	$back_classes .= ' secondary-background-color-important';
}

$_front_heading_classes = 'heading';
$_front_text_classes    = 'text';
$_back_heading_classes  = 'heading';
$_back_text_classes     = 'text';

if ( $front_heading_color === 'primary' ) {
	$_front_heading_classes .= ' primary-color-important';
} elseif ( $front_heading_color === 'secondary' ) {
	$_front_heading_classes .= ' secondary-color-important';
}

if ( $front_text_color === 'primary' ) {
	$_front_text_classes .= ' primary-color-important';
} elseif ( $front_text_color === 'secondary' ) {
	$_front_text_classes .= ' secondary-color-important';
}

if ( $back_heading_color === 'primary' ) {
	$_back_heading_classes .= ' primary-color-important';
} elseif ( $back_heading_color === 'secondary' ) {
	$_back_heading_classes .= ' secondary-color-important';
}

if ( $back_text_color === 'primary' ) {
	$_back_text_classes .= ' primary-color-important';
} elseif ( $back_text_color === 'secondary' ) {
	$_back_text_classes .= ' secondary-color-important';
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="<?php echo esc_attr( $flipper_classes ); ?>">
		<div class="thumb-wrap">
			<div class="<?php echo esc_attr( $front_classes ); ?>">
				<div class="content-wrap">
					<?php if ( $front_heading !== '' ) : ?>
						<h4 class="<?php echo esc_attr( $_front_heading_classes ); ?>">
							<?php echo esc_html( $front_heading ); ?>
						</h4>
					<?php endif; ?>
					<?php if ( $front_text !== '' ) : ?>
						<div class="<?php echo esc_attr( $_front_text_classes ); ?>">
							<?php echo esc_html( $front_text ); ?>
						</div>
					<?php endif; ?>

					<?php
					if ( $front_button && $front_button !== '' ) {
						$button = vc_build_link( $front_button );
						if ( $button['url'] !== '' ) {
							$_button_classes = "tm-button tm-rotate-box-btn";
							if ( $front_button_color !== 'custom' ) {
								$_button_classes .= " tm-button-$front_button_color";
							}

							if ( $front_button_style !== '' ) {
								$_button_classes .= " style-$front_button_style";
							}
							?>
							<a class="<?php echo esc_attr( $_button_classes ); ?>"
							   href="<?php echo esc_url( $button['url'] ); ?>"
								<?php if ( $button['target'] !== '' ) { ?>
									target="<?php echo esc_attr( $button['target'] ); ?>"
								<?php } ?>
							>
								<?php echo esc_html( $button['title'] ); ?>
							</a>
						<?php }
					} ?>
				</div>
			</div>
			<div class="<?php echo esc_attr( $back_classes ); ?>">
				<div class="content-wrap">
					<?php if ( $back_heading !== '' ) : ?>
						<h4 class="<?php echo esc_attr( $_back_heading_classes ); ?>">
							<?php echo esc_html( $back_heading ); ?>
						</h4>
					<?php endif; ?>
					<?php if ( $back_text !== '' ) : ?>
						<div class="<?php echo esc_attr( $_back_text_classes ); ?>">
							<?php echo esc_html( $back_text ); ?>
						</div>
					<?php endif; ?>

					<?php
					if ( $back_button && $back_button !== '' ) {
						$button = vc_build_link( $back_button );
						if ( $button['url'] !== '' ) {
							$_button_classes = "tm-button tm-rotate-box-btn";
							if ( $back_button_color !== 'custom' ) {
								$_button_classes .= " tm-button-$back_button_color";
							}

							if ( $back_button_style !== '' ) {
								$_button_classes .= " style-$back_button_style";
							}
							?>
							<a class="<?php echo esc_attr( $_button_classes ); ?>"
							   href="<?php echo esc_url( $button['url'] ); ?>"
								<?php if ( $button['target'] !== '' ) { ?>
									target="<?php echo esc_attr( $button['target'] ); ?>"
								<?php } ?>
							>
								<?php echo esc_html( $button['title'] ); ?>
							</a>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
