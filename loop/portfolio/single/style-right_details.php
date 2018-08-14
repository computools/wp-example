<?php
// Meta.
$portfolio_url     = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Insight_Helper::get_post_meta( 'portfolio_gallery', '' );

if ( $portfolio_gallery !== '' || has_post_thumbnail() ) {
	$class = 'col-md-4';
} else {
	$class = 'col-md-12';
}
?>
	<div class="row portfolio-details-style1">
		<?php if ( $portfolio_gallery !== '' || has_post_thumbnail() ) : ?>
			<div class="col-md-7">
				<div class="feature-wrap">
					<div class="portfolio-details-gallery">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php
							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							$image_url       = Insight_Helper::aq_resize( array(
								'url'    => $full_image_size,
								'width'  => 670,
								'height' => 9999,
								'crop'   => false,
							) );
							?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
						<?php endif; ?>
						<?php
						if ( $portfolio_gallery !== '' ) {
							foreach ( $portfolio_gallery as $key => $value ) {
								$full_image_size = wp_get_attachment_url( $value['id'] );
								$image_url       = Insight_Helper::aq_resize( array(
									'url'    => $full_image_size,
									'width'  => 670,
									'height' => 9999,
									'crop'   => false,
								) );
								?>
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
							<?php }
						} ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr( $class ); ?>">
			<div id="sticky-element" class="tm-sticky-kit">
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
			</div>
		</div>
	</div>
<?php
Insight_Templates::portfolio_link_pages();
