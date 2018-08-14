<?php
/**
 * Template Name: Portfolio Fullscreen Split Slider 2
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */
get_header();

$cats   = Insight::setting( 'portfolio_fullscreen_split_slider_2_categories' );
$tags   = Insight::setting( 'portfolio_fullscreen_split_slider_2_tags' );
$number = Insight::setting( 'portfolio_fullscreen_split_slider_2_number' );

$insight_post_args = array(
	'post_type'      => 'portfolio',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'    => 'publish',
	'posts_per_page' => $number,
);

if ( ! empty( $cats ) || ! empty( $tags ) ) {
	$insight_post_args['tax_query'] = array();
	$tax_queries                    = array(); // List of taxonomies.
	if ( ! empty( $cats ) ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $cats,
		);
	}
	if ( ! empty( $tags ) ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_tags',
			'field'    => 'slug',
			'terms'    => $tags,
		);
	}
	$insight_post_args['tax_query']             = $tax_queries;
	$insight_post_args['tax_query']['relation'] = 'OR';
}

$insight_query = new WP_Query( $insight_post_args );
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div
		class="tm-swiper nav-style-portfolio-fullscreen-split pagination-style-portfolio-fullscreen-split"
		data-lg-items="1"
		data-wrap-tools="1"
		data-nav="1"
		data-pagination="1"
		data-pagination-number="1"
		data-mousewheel="1"
		data-loop="1"
		data-vertical="1"
		data-speed="1000"
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>
					<?php
					if ( has_post_thumbnail() ) {
						$full_image_size = get_the_post_thumbnail_url( null, 'full' );
						$image_url       = Insight_Helper::aq_resize( array(
							'url'    => $full_image_size,
							'width'  => 960,
							'height' => 1080,
							'crop'   => true,
						) );
					}
					?>
					<div class="swiper-slide">
						<div class="slide-wrapper">
							<div class="left-section">
								<div class="left-section-inner">
									<div class="portfolio-info">
										<div class="portfolio-categories">
											<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
										</div>
										<h5 class="portfolio-title">
											<a href="<?php the_permalink(); ?>"
											   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</h5>
										<a class="tm-button style-flat tm-button-secondary"
										   href="<?php the_permalink(); ?>">
											<span><?php esc_html_e( 'View Details', 'tm-moody' ); ?></span>
										</a>
									</div>
								</div>
							</div>
							<div class="right-section"
								<?php if ( $image_url ) : ?>
									style="background-image: url( '<?php echo esc_url( $image_url ); ?>' );"
								<?php endif; ?>>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
<?php get_footer( 'blank' );
