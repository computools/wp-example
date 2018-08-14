<?php
while ( $insight_query->have_posts() ) :
	$insight_query->the_post();
	$classes = array( 'portfolio-item grid-item' );
	?>
	<div <?php post_class( implode( ' ', $classes ) ); ?>>
		<div class="post-item-wrapper">
			<div class="post-thumbnail">
				<a href="<?php Insight_Helper::portfolio_the_permalink(); ?>">
					<div class="post-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php
							$image_url = get_the_post_thumbnail_url( null, 'full' );

							if ( $image_size !== '' ) {
								$_sizes  = explode( 'x', $image_size );
								$_width  = $_sizes[0];
								$_height = $_sizes[1];

								$image_url = Insight_Helper::aq_resize( array(
									'url'    => $image_url,
									'width'  => $_width,
									'height' => $_height,
									'crop'   => true,
								) );
							}
							?>
							<img src="<?php echo esc_url( $image_url ); ?>"
							     alt="<?php get_the_title(); ?>"/>
						<?php } else { ?>
							<?php Insight_Templates::image_placeholder( 480, 480 ); ?>
						<?php } ?>

					</div>
				</a>
				<?php if ( $overlay_style !== '' ) : ?>
					<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endwhile;
