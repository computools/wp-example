<?php
// Meta.
$portfolio_url     = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Insight_Helper::get_post_meta( 'portfolio_gallery', '' );
?>
<?php if ( $portfolio_gallery !== '' || has_post_thumbnail() ) : ?>
	<div class="portfolio-details-style6">
		<div class="tm-swiper"
		     data-lg-items="1"
		     data-nav="1"
		     data-mousewheel="1"
		     data-loop="1"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="swiper-slide"
						     style="background-image: url( <?php the_post_thumbnail_url( 'insight-full-hd' ); ?> );"></div>
					<?php endif; ?>
					<?php
					if ( $portfolio_gallery !== '' ) {
						foreach ( $portfolio_gallery as $key => $value ) {
							$image_url = wp_get_attachment_image_url( $value['id'], 'insight-full-hd' );
							if ( $image_url !== false ) {
								?>
								<div class="swiper-slide"
								     style="background-image: url( <?php echo esc_url( $image_url ); ?> );"></div>
								<?php
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<div id="portfolio-details-canvas" class="portfolio-details-canvas">
	<div class="btn-open primary-color">
		<div>
			<i class="fa fa-angle-down close-icon"></i>
			<i class="fa fa-angle-up open-icon"></i>
			<?php esc_html_e( 'Project Info', 'tm-moody' ); ?>
		</div>
	</div>
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="portfolio-details-content">
					<h3 class="portfolio-title"><?php the_title(); ?></h3>
					<?php the_content(); ?>
					<?php if ( $portfolio_url !== '' ) : ?>
						<a class="tm-button tm-button-default style-text tm-button-view-project"
						   href="<?php echo esc_url( $portfolio_url ); ?>">
							<span><?php esc_html_e( 'Visit site', 'tm-moody' ); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-md-12">
				<?php Insight_Templates::portfolio_details(); ?>
				<div class="portfolio-details-social">
					<div class="row col-xs-center">
						<div class="col-md-6">
							<?php Insight_Templates::portfolio_sharing(); ?>
						</div>
						<div class="col-md-6">
							<?php Insight_Templates::portfolio_like(); ?>
							<?php Insight_Templates::portfolio_view(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="return-prev-page" class="return-prev-page"></div>
