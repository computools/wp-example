<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $skin = $heading = $sub_heading = $text = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blockquote ' . $el_class, $this->settings['base'], $atts );

$css_class .= " style-$style";
$css_class .= " skin-$skin";

?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php

	if ( $text !== '' ) { ?>
		<?php if ( $style === '3' ) : ?>
			<blockquote>
				<?php echo Insight_Helper::get_file_contents( INSIGHT_THEME_DIR . '/assets/images/blockquote2.svg' ); ?>
				<div class="quote-text">
					<?php echo esc_html( $text ); ?>
				</div>
				<div class="block-header">
					<?php if ( $heading !== '' ) { ?>
						<h6 class="heading"><?php echo esc_html( $heading ); ?></h6>
					<?php } ?>

					<?php if ( $sub_heading !== '' ) { ?>
						<h6 class="sub-heading"><?php echo esc_html( $sub_heading ); ?></h6>
					<?php } ?>
				</div>
			</blockquote>
		<?php else : ?>
			<blockquote>
				<?php if ( $style === '2' ) : ?>
					<?php echo Insight_Helper::get_file_contents( INSIGHT_THEME_DIR . '/assets/images/blockquote.svg' ); ?>
				<?php endif; ?>
				<?php if ( $heading !== '' ) { ?>
					<h6 class="heading"><?php echo esc_html( $heading ); ?></h6>
				<?php } ?>
				<?php echo esc_html( $text ); ?>
			</blockquote>
		<?php endif; ?>
	<?php } ?>
</div>
