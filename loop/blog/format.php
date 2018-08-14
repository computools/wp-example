<?php if ( has_post_thumbnail() ) { ?>
	<?php
	$full_image_size = get_the_post_thumbnail_url( null, 'full' );
	$image_url       = Insight_Helper::aq_resize( array(
		'url'    => $full_image_size,
		'width'  => 770,
		'height' => 520,
		'crop'   => true,
	) );
	?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>"
		   title="<?php the_title_attribute(); ?>">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
		</a>
	</div>
<?php } ?>

