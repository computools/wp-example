<?php
/**
 * Template Name: Coming Soon
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */

get_header( 'blank' );

$maintenance_logo = Insight::setting( 'maintenance_logo' );
$logo             = Insight::setting( $maintenance_logo );
$background       = Insight::setting( 'maintenance_background' );

$cs_title         = Insight::setting( 'cs_title' );
$cs_text          = Insight::setting( 'cs_text' );
$mailchimp_enable = Insight::setting( 'cs_mailchimp_enable' );

$countdown = Insight::setting( 'cs_countdown' );

if ( $logo === '' ) {
	$logo = INSIGHT_THEME_URI . '/assets/images/logo_light.png';
}
if ( $background === '' ) {
	$background = INSIGHT_THEME_URI . '/assets/images/bg-maintenance.jpg';
}
?>
	<div id="maintenance-wrap" class="maintenance-page maintenance-bg-img"
	     style="background-image: url('<?php echo esc_url( $background ); ?>')">

		<div class="maintenance-header">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( $logo ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="maintenance-logo">
			</a>
		</div>

		<div class="maintenance-body text-center">
			<div class="container">
				<div class="row  maintenance-row">
					<div class="col-lg-10">
						<div class="cs-countdown">
							<?php if ( $countdown !== '' ) : ?>
								<div id="countdown" class="countdown"
								     data-datetime="<?php echo esc_attr( $countdown ); ?>"></div>
							<?php endif; ?>
						</div>
						<?php if ( $cs_title !== '' ) : ?>
							<h2 class="maintenance-title  maintenance-title--white">
								<?php echo esc_html( $cs_title ); ?>
							</h2>
						<?php endif; ?>

						<?php if ( $cs_text !== '' ) : ?>
							<div class="maintenance-text">
								<?php echo esc_html( $cs_text ); ?>
							</div>
						<?php endif; ?>

						<?php
						if ( $mailchimp_enable === '1' && function_exists( 'mc4wp_show_form' ) ) : ?>
							<div class="cs-form">
								<?php echo do_shortcode( '[tm_mailchimp_form skin="secondary"]' ); ?>
							</div>
						<?php endif;
						?>

					</div>
				</div>
			</div>

		</div>

	</div>
<?php get_footer( 'blank' );
