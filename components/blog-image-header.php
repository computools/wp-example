<?php
$style = '';
if ( has_post_thumbnail() ) {
	$full_image_size = get_the_post_thumbnail_url( null, 'full' );
	$image_url       = Insight_Helper::aq_resize( array(
		'url'    => $full_image_size,
		'width'  => 1920,
		'height' => 800,
		'crop'   => true,
	) );

	$style .= "background-image: url('{$image_url}')";
}
?>
<div class="blog-header-image"
	<?php if ( $style !== '' ) : ?>
		style="<?php echo esc_attr( $style ); ?>"
	<?php endif; ?>
>
	<div class="overlay"></div>
	<div class="container">
		<div class="row row-xs-center">
			<div class="col-md-12">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php get_template_part( 'loop/blog-single/meta' ); ?>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<?php get_template_part( 'components/breadcrumb' ); ?>
</div>
