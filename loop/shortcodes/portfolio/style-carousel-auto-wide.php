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
						'url'    => $full_image_size,
						'width'  => 9999,
						'height' => 560,
						'crop'   => false,
					) );
					?>
					<img src="<?php echo esc_url( $image_url ); ?>"
					     alt="<?php get_the_title(); ?>"/>
				<?php } else {
					Insight_Templates::image_placeholder( 560, 560 );
				}
				?>
				<?php if ( $overlay_style !== '' ) : ?>
					<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile;
