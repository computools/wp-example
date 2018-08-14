<?php
/**
 * Template Name: Maintenance
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
$single_image     = Insight::setting( 'maintenance_single_image' );
$progress_bar     = Insight::setting( 'maintenance_progress_bar' );
$percent          = Insight::setting( 'maintenance_percent' );
$title            = Insight::setting( 'maintenance_title' );
$sub_title        = Insight::setting( 'maintenance_sub_title' );
$text             = Insight::setting( 'maintenance_text' );
$sub_text         = Insight::setting( 'maintenance_sub_text' );
$copyright        = Insight::setting( 'maintenance_copyright' );
$mailchimp_enable = Insight::setting( 'maintenance_mailchimp_enable' );
if ( $logo === '' ) {
	$logo = INSIGHT_THEME_URI . '/assets/images/logo.png';
}
if ( $background === '' ) {
	$background = INSIGHT_THEME_URI . '/assets/images/bg-maintenance-02.jpg';
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
				<div class="row maintenance-row">
					<div class="col-lg-8">
						<?php if ( $progress_bar === '1' ) : ?>
							<div class="maintenance-progress">
								<span class="maintenance-number"><?php echo esc_html( $percent ); ?>%</span>
								<div class="maintenance-progress-bar"
								     role="progressbar"></div>
							</div>
						<?php endif; ?>
						<?php if ( $title !== '' ) : ?>
							<h2 class="maintenance-title">
								<?php echo esc_html( $title ); ?>
							</h2>
						<?php endif; ?>

						<?php if ( $text !== '' ) : ?>
							<div class="maintenance-text">
								<?php echo esc_html( $text ); ?>
							</div>
						<?php endif; ?>
						<?php if ( $sub_text !== '' ) : ?>
							<div class="maintenance-sub-text">
								<?php echo esc_html( $sub_text ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>

		<div class="maintenance-footer">
			<div class="maintenance-social-list primary-color">
				<?php Insight_Templates::social_icons(); ?>
			</div>
		</div>

	</div>
<?php get_footer( 'blank' );
