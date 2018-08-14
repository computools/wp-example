<?php
// Meta.
$portfolio_url     = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Insight_Helper::get_post_meta( 'portfolio_gallery', '' );
?>
<?php if ( has_post_thumbnail() ) : ?>
	<div class="portfolio-feature">
		<?php
		$full_image_size = get_the_post_thumbnail_url( null, 'full' );
		$image_url       = Insight_Helper::aq_resize( array(
			'url'    => $full_image_size,
			'width'  => 1170,
			'height' => 790,
			'crop'   => true,
		) );
		?>
		<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
	</div>
<?php endif; ?>

	<div class="portfolio-details-content">
		<h3 class="portfolio-title"><?php the_title(); ?></h3>
		<div class="portfolio-categories">
			<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ' / ' ); ?>
		</div>
		<?php the_content(); ?>

		<?php if ( $portfolio_url !== '' ) : ?>
			<div class="portfolio-link">
				<?php esc_html_e( 'Project Link:', 'tm-moody' ); ?><?php ?>
				<a class="tm-button-view-project"
				   href="<?php echo esc_url( $portfolio_url ); ?>"><?php echo esc_html( $portfolio_url ); ?></a>
			</div>
		<?php endif; ?>
	</div>

<?php Insight_Templates::portfolio_details(); ?>

	<div class="portfolio-details-social">
		<?php Insight_Templates::portfolio_like(); ?>
		<?php Insight_Templates::portfolio_view(); ?>
		<?php Insight_Templates::portfolio_sharing(); ?>
	</div>


<?php if ( $portfolio_gallery !== '' ) : ?>
	<?php
	$grid_classes = 'tm-grid tm-light-gallery';
	$grid_classes .= Insight_Helper::get_grid_animation_classes( 'scale-up' );
	?>
	<div class="tm-grid-wrapper tm-gallery"
	     data-type="masonry"
	     data-lg-columns="3"
	     data-sm-columns="2"
	     data-gutter="30"
	>
		<div class="<?php echo esc_attr( $grid_classes ); ?>">
			<div class="grid-sizer"></div>
			<?php
			foreach ( $portfolio_gallery as $key => $value ) {
				?>
				<div class="grid-item gallery-item">
					<a href="<?php echo wp_get_attachment_url( $value['id'], 'full' ); ?>"
					   class="zoom">
						<?php
						$full_image_size = wp_get_attachment_url( $value['id'], 'full' );
						$image_url       = Insight_Helper::aq_resize( array(
							'url'    => $full_image_size,
							'width'  => 370,
							'height' => 9999,
							'crop'   => false,
						) );
						?>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
						<div class="overlay">
							<div>+</div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
<?php endif; ?>
<?php
Insight_Templates::portfolio_link_pages();
