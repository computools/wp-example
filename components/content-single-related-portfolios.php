<?php
$number_post = Insight::setting( 'portfolio_related_number' );
$results     = Insight_Query::get_related_portfolios( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );
?>
<?php if ( $results !== false && $results->have_posts() ) : ?>
	<div class="related-portfolio-wrap">
		<h3 class="related-portfolio-title">
			<?php echo esc_html( Insight::setting( 'portfolio_related_title' ) ); ?>
		</h3>
		<div class="related-portfolio-list tm-swiper"
		     data-lg-items="3"
		     data-md-items="2"
		     data-xs-items="1"
		     data-lg-gutter="30"
		     data-pagination="1"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php while ( $results->have_posts() ) : $results->the_post(); ?>
						<div class="swiper-slide">
							<div class="related-post-item">
								<div class="post-thumbnail">
									<?php
									if ( has_post_thumbnail() ) {
										$full_image_size = get_the_post_thumbnail_url( null, 'full' );
										$image_url       = Insight_Helper::aq_resize( array(
											'url'    => $full_image_size,
											'width'  => 500,
											'height' => 340,
											'crop'   => true,
										) );
										?>
										<img src="<?php echo esc_url( $image_url ); ?>"
										     alt="<?php get_the_title(); ?>"/>
										<?php
									} else {
										Insight_Templates::image_placeholder( 500, 340 );
									}
									?>
									<?php get_template_part( 'loop/portfolio/overlay', 'faded' ); ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
