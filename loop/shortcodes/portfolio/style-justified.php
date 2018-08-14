<?php
while ( $insight_query->have_posts() ) :
	$insight_query->the_post();
	$classes = array( 'portfolio-item grid-item test' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>

		<a href="<?php Insight_Helper::portfolio_the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				$image_full_url = get_the_post_thumbnail_url( null, 'full' );

				$image_url = Insight_Helper::aq_resize( array(
					'url'    => $image_full_url,
					'width'  => 1170,
					'height' => 9999,
					'crop'   => false,
				) );
				?>
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
				<?php

			} else {
				Insight_Templates::image_placeholder( 600, 600 );
			}
			?>
		</a>
		<div class="post-thumbnail">
			<?php if ( $overlay_style !== '' ) : ?>
				<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endwhile;
