<?php
$header_button_text        = Insight::setting( 'header_button_text' );
$header_button_link        = Insight::setting( 'header_button_link' );
$header_button_link_target = Insight::setting( 'header_button_link_target' );

$header_button_style = Insight::setting( 'header_button_style' );
$header_button_color = Insight::setting( 'header_button_color' );

$button_classes = 'header-on-top-button tm-button tm-button-sm';
$button_classes .= " style-{$header_button_style}";
$button_classes .= " tm-button-{$header_button_color}";

$header_sticky_button_style = Insight::setting( 'header_sticky_button_style' );
$header_sticky_button_color = Insight::setting( 'header_sticky_button_color' );

$header_sticky_button_classes = 'header-sticky-button tm-button tm-button-xs';
$header_sticky_button_classes .= " style-{$header_sticky_button_style}";
$header_sticky_button_classes .= " tm-button-{$header_sticky_button_color}";
?>
<?php if ( $header_button_link !== '' && $header_button_text !== '' ) : ?>
	<div class="header-button">
		<a class="<?php echo esc_attr( $button_classes ); ?>"
		   href="<?php echo esc_url( $header_button_link ); ?>"
			<?php if ( $header_button_link_target === '1' ) : ?>
				target="_blank"
			<?php endif; ?>
		>
			<?php echo esc_html( $header_button_text ); ?>
		</a>

		<a class="<?php echo esc_attr( $header_sticky_button_classes ); ?>"
		   href="<?php echo esc_url( $header_button_link ); ?>"
			<?php if ( $header_button_link_target === '1' ) : ?>
				target="_blank"
			<?php endif; ?>
		>
			<?php echo esc_html( $header_button_text ); ?>
		</a>
	</div>
<?php endif; ?>
