<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */
$style = 'list';

if ( have_posts() ) :
	global $wp_query;
	$insight_query = $wp_query;
	$count         = $insight_query->post_count;
	$classes       = array(
		'tm-blog',
		"style-$style",
	);
	$grid_classes  = array( 'tm-grid' );

	?>
	<div class="tm-grid-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $grid_classes ) ); ?>"
			<?php
			if ( $style === 'list' ) {
				echo 'data-grid-has-gallery="true"';
			}
			?>
		>
			<?php if ( $style === 'list' ) { ?>
				<?php
				while ( $insight_query->have_posts() ) :
					$insight_query->the_post();
					$classes = array( 'grid-item', 'post-item' );
					$format  = '';
					if ( get_post_format() !== false ) {
						$format = get_post_format();
					}
					?>
					<div <?php post_class( implode( ' ', $classes ) ); ?>>
						<?php if ( ! in_array( $format, array( 'link' ) ) ) : ?>
							<?php get_template_part( 'loop/blog/format', $format ); ?>
						<?php endif; ?>
						<div class="post-info">
							<?php get_template_part( 'loop/blog/title' ); ?>
							<?php if ( is_sticky() ) : ?>
								<span class="post-sticky"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
									<?php esc_html_e( 'Sticky', 'tm-moody' ); ?></span>
							<?php endif; ?>
							<?php get_template_part( 'loop/blog/meta' ); ?>
							<?php if ( in_array( $format, array( 'link' ) ) ) : ?>
								<?php get_template_part( 'loop/blog/format', $format ); ?>
							<?php endif; ?>
							<div class="post-excerpt">
								<?php Insight_Templates::excerpt( array( 'limit' => 42, 'type' => 'word' ) ); ?>
							</div>
							<?php get_template_part( 'loop/blog/readmore' ); ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php } ?>
		</div>
		<div class="tm-grid-pagination">
			<?php Insight_Templates::paging_nav(); ?>
		</div>
	</div>
<?php else : get_template_part( 'components/content', 'none' ); ?>
<?php endif; ?>
