<?php
$number_post = Insight::setting( 'single_post_related_number_enable' );
$results     = Insight_Query::get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );

if ( $results !== false && $results->have_posts() ) : ?>
	<div class="related-posts-wrap">
		<h3 class="related-title">
			<?php esc_html_e( 'Related posts', 'tm-moody' ); ?>
		</h3>
		<div class="related-posts tm-swiper equal-height"
		     data-lg-items="2"
		     data-md-items="2"
		     data-sm-items="1"
		     data-pagination="1"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php while ( $results->have_posts() ) : $results->the_post(); ?>
						<div class="swiper-slide">
							<div class="related-post-item">
								<div class="post-item-wrapper">
									<h3 class="related-post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="post-meta">
										<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
										<?php if ( has_category() ) : ?>
											<?php echo esc_html__( 'in', 'tm-moody' ) . ' '; ?>
											<div class="post-categories"><?php the_category( ', ' ); ?></div>
										<?php endif; ?>
									</div>
									<div class="related-post-excerpt">
										<?php Insight_Templates::excerpt( array( 'limit' => 10, 'type' => 'word' ) ); ?>
									</div>
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
