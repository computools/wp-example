<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_gallery'] ) ) {
	$gallery = $post_options['post_gallery'];
	?>
	<div class="post-feature post-gallery tm-swiper" data-pagination="1"
	     data-loop="1">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ( $gallery as $image ) { ?>
					<div class="swiper-slide">
						<?php
						$full_image_size = wp_get_attachment_url( $image['id'] );
						$image_url       = Insight_Helper::aq_resize( array(
							'url'    => $full_image_size,
							'width'  => 400,
							'height' => 535,
							'crop'   => true,
						) );
						?>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
