<?php
// Meta.
$portfolio_url     = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Insight_Helper::get_post_meta( 'portfolio_gallery', '' );
?>

<?php if ( $portfolio_gallery !== '' ) : ?>
	<div class="portfolio-feature">
		<div class="tm-swiper"
		     data-lg-items="1"
		     data-lg-gutter="30"
		     data-pagination="1"
		     data-autoheight="1"
		     data-autoplay="5000"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
					foreach ( $portfolio_gallery as $key => $value ) {
						?>
						<div class="swiper-slide">
							<?php
							$full_image_size = wp_get_attachment_url( $value['id'], 'full' );
							$image_url       = Insight_Helper::aq_resize( array(
								'url'    => $full_image_size,
								'width'  => 1170,
								'height' => 790,
								'crop'   => true,
							) );
							?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
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
