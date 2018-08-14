<?php if ( has_post_thumbnail() ) { ?>
	<?php
	$full_image_size = get_the_post_thumbnail_url( null, 'full' );
	$image_url       = Insight_Helper::aq_resize( array(
		'url'    => $full_image_size,
		'width'  => 270,
		'height' => 390,
		'crop'   => true,
	) );

	$small_url = Insight_Helper::aq_resize( array(
		'url'    => $full_image_size,
		'width'  => 370,
		'height' => 200,
		'crop'   => true,
	) );
	?>
	<div class="post-feature post-thumbnail">
		<a href="<?php the_permalink(); ?>"
		   title="<?php the_title_attribute(); ?>">
			<img srcset="<?php echo esc_url( $image_url ); ?> 1920w,
														<?php echo esc_url( $small_url ); ?> 767w"
			     src="<?php echo esc_url( $image_url ); ?>"
			     alt="<?php get_the_title(); ?>"/>
		</a>
	</div>
<?php } ?>
