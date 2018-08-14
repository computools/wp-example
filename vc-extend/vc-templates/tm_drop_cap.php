<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$text = $style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-drop-cap ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
?>
<?php if ( $text !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
		<?php
		$text = preg_replace( '/^([\<\sa-z\d\/\>]*)(([a-z\&\;]+)|([\"\'\w]))/', '$1<span class="drop-cap">$2</span>', $text );
		echo wp_kses( $text, array(
			'span' => array(
				'class' => array(),
			),
		) );
		?>
	</div>
<?php endif;
