<?php
/**
 * Template Name: Fullscreen Split Feature
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */
get_header();
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div id="fullscreen-wrap" class="fullscreen-wrap">
			<div class="left-section"
				<?php if ( has_post_thumbnail() ) : ?>
					<?php
					$full_image_size = get_the_post_thumbnail_url( null, 'full' );
					$image_url       = Insight_Helper::aq_resize( array(
						'url'    => $full_image_size,
						'width'  => 960,
						'height' => 1080,
						'crop'   => true,
					) );
					?>
					style="background-image: url( <?php echo esc_url( $image_url ); ?> );"
				<?php endif; ?>
			>
			</div>
			<div class="right-section">
				<div class="row">
					<div class="col-md-12">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="tm-social-network"><?php Insight_Templates::social_icons( array(
						'display'        => 'text',
						'tooltip_enable' => false,
					) ); ?></div>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer( 'blank' );
