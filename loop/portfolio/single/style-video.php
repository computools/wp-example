<?php
// Meta.
$portfolio_url = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$video         = Insight_Helper::get_post_meta( 'portfolio_video_url', '' );
?>

<?php if ( $video !== '' ) : ?>
	<div class="post-video embed-responsive-16by9 embed-responsive">
		<?php if ( wp_oembed_get( $video ) ) { ?>
			<?php echo Insight_Helper::w3c_iframe( wp_oembed_get( $video ) ); ?>
		<?php } else { ?>
			<?php Insight_Helper::w3c_iframe( $video ); ?>
		<?php } ?>
	</div>
<?php endif; ?>

	<div class="portfolio-details-content">
		<h3 class="portfolio-title"><?php the_title(); ?></h3>
		<div class="portfolio-categories">
			<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ' / ' ); ?>
		</div>
		<?php the_content(); ?>

		<?php if ( $portfolio_url !== '' ) : ?>
			<div class="portfolio-link">
				<?php esc_html_e( 'Project Link:', 'tm-moody' ); ?><?php ?>
				<a class="tm-button-view-project"
				   href="<?php echo esc_url( $portfolio_url ); ?>"><?php echo esc_html( $portfolio_url ); ?></a>
			</div>
		<?php endif; ?>
	</div>

<?php Insight_Templates::portfolio_details(); ?>

	<div class="portfolio-details-social">
		<?php Insight_Templates::portfolio_like(); ?>
		<?php Insight_Templates::portfolio_view(); ?>
		<?php Insight_Templates::portfolio_sharing(); ?>
	</div>
<?php

Insight_Templates::portfolio_link_pages();
