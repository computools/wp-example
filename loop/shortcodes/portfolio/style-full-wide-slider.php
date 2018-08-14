<?php
while ( $insight_query->have_posts() ) :
	$insight_query->the_post();
	$classes = array( 'portfolio-item grid-item swiper-slide' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-item-wrapper">
			<div class="post-thumbnail">
				<?php
				if ( has_post_thumbnail() ) {
					$full_image_size = get_the_post_thumbnail_url( null, 'full' );
					$image_url       = Insight_Helper::aq_resize( array(
						'url'     => $full_image_size,
						'width'   => 1920,
						'height'  => 700,
						'crop'    => true,
						'upscale' => true,
					) );

					$small_url = Insight_Helper::aq_resize( array(
						'url'     => $full_image_size,
						'width'   => 640,
						'height'  => 700,
						'crop'    => true,
						'upscale' => true,
					) );
					?>
					<img srcset="<?php echo esc_url( $image_url ); ?> 1920w,
														<?php echo esc_url( $small_url ); ?> 640w"
					     src="<?php echo esc_url( $image_url ); ?>"
					     alt="<?php get_the_title(); ?>"/>
				<?php } else {
					Insight_Templates::image_placeholder( 1920, 700 );
				}
				?>
				<div class="post-overlay-info">
					<div class="post-overlay-categories">
						<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
					</div>
					<h5 class="post-overlay-title">
						<a href="<?php Insight_Helper::portfolio_the_permalink(); ?>"
						   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h5>
					<div class="post-overlay-icon">
						<a href="<?php Insight_Helper::portfolio_the_permalink(); ?>"><span class="icon-plus"></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endwhile;
