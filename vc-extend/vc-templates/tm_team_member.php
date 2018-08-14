<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $el_class = $animation = $social_networks = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-team-member ' . $el_class, $this->settings['base'], $atts );
$css_class .= "style-$style";

$css_class .= Insight_Helper::get_animation_classes( $animation );

$css_id = uniqid( 'tm-team-member-' );
$this->get_inline_css( '#' . $css_id, $atts );

$social_networks = (array) vc_param_group_parse_atts( $social_networks );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<div class="photo">
		<?php
		$full_image_size = wp_get_attachment_url( $photo, 'full' );
		$image_url       = Insight_Helper::aq_resize( array(
			'url'    => $full_image_size,
			'width'  => 384,
			'height' => 512,
			'crop'   => true,
		) );
		?>
		<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $name ); ?>"/>
	</div>
	<div class="overlay"></div>
	<div class="info">
		<div class="info-inner">
			<div class="info-wrap">
				<h3 class="name">
					<?php
					if ( $profile != '' ) {
						echo '<a href="' . esc_attr( $profile ) . '">';
						echo esc_html( $name );
						echo '</a>';
					} else {
						echo esc_html( $name );
					}
					?>
				</h3>
				<?php
				if ( $position !== '' ) : ?>
					<div class="position"><?php echo esc_html( $position ); ?></div>
				<?php endif; ?>
				<?php if ( $desc !== '' ) : ?>
					<?php echo '<div class="description">' . $desc . '</div>'; ?>
				<?php endif; ?>
				<?php if ( count( $social_networks ) > 0 ) { ?>
					<div class="info-footer">
						<div class="social-networks">
							<?php
							foreach ( $social_networks as $data ) {
								printf( '<a target="_blank" href="%s">
                                    <i class="%s"></i>
                                </a>', isset( $data['link'] ) ? esc_url( $data['link'] ) : '', isset( $data['icon'] ) ? $data['icon'] : '' );
							}
							?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
