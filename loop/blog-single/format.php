<?php if ( has_post_thumbnail() ) { ?>
	<?php
	global $insight_vars;
	$insight_thumbnail_w = 970;
	$insight_thumbnail_h = 650;
	if ( $insight_vars->has_sidebar ) {
		$insight_thumbnail_w = 770;
		$insight_thumbnail_h = 516;
	}

	$full_image_size = get_the_post_thumbnail_url( null, 'full' );
	$image_url       = Insight_Helper::aq_resize( array(
		'url'    => $full_image_size,
		'width'  => $insight_thumbnail_w,
		'height' => $insight_thumbnail_h,
		'crop'   => true,
	) );
	?>
	<div class="post-feature post-thumbnail">
		<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
	</div>
<?php } ?>
