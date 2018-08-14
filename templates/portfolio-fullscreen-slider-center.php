<?php
/**
 * Template Name: Portfolio Fullscreen Slider Center
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */
get_header();

$cats              = Insight::setting( 'portfolio_fullscreen_center_slider_categories' );
$tags              = Insight::setting( 'portfolio_fullscreen_center_slider_tags' );
$number            = Insight::setting( 'portfolio_fullscreen_center_slider_number' );
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

$insight_query          = new WP_Query( $insight_post_args );
$left_column_text       = Insight::setting( 'portfolio_fullscreen_center_slider_left_column_text' );
$right_column_text      = Insight::setting( 'portfolio_fullscreen_center_slider_right_column_text' );
$social_networks_enable = Insight::setting( 'portfolio_fullscreen_center_slider_social_networks_enable' );
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div class="page-main-content">
		<div id="fullscreen-center-slider">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php while ( $insight_query->have_posts() ) :
						$insight_query->the_post(); ?>
						<?php
						if ( has_post_thumbnail() ) {
							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							$image_bg_url    = Insight_Helper::aq_resize( array(
								'url'    => $full_image_size,
								'width'  => 1920,
								'height' => 1080,
								'crop'   => true,
							) );

							/*$image_feature_url = Insight_Helper::aq_resize( array(
								                                                'url'    => $full_image_size,
								                                                'width'  => 1170,
								                                                'height' => 670,
								                                                'crop'   => true,
							                                                ) );*/
						}
						?>
						<div class="swiper-slide">
							<div class="portfolio-item"
							     data-background="<?php echo esc_url( $image_bg_url ); ?>">
								<div class="portfolio-thumbnail panr">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo esc_url( $image_bg_url ); ?>" alt="">
									</a>
								</div>
								<div class="portfolio-info">
									<div class="portfolio-categories">
										<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
									</div>
									<h5 class="portfolio-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="swiper-navigation-wrap">
				<div class="swiper-nav-button swiper-button-prev">
					<div class="counter"></div>
				</div>
				<div class="swiper-nav-button swiper-button-next">
					<div class="counter"></div>
				</div>
			</div>
		</div>
		<div class="swiper-background-fade-wrapper">
			<div class="inner"></div>
		</div>
		<?php if ( $left_column_text !== '' || $social_networks_enable === '1' || $right_column_text !== '' ) { ?>
			<div class="extra-info">
				<div class="container-fluid">
					<div class="row row-xs-center">
						<div class="col-sm-4 left-column">
							<?php if ( $left_column_text !== '' ) : ?>
								<?php echo '<div>' . $left_column_text . '</div>'; ?>
							<?php endif; ?>
						</div>
						<?php if ( $social_networks_enable === '1' ) : ?>
							<div class="col-sm-4 center-column">
								<div class="tm-social-network"><?php Insight_Templates::social_icons( array(
										'display'        => 'icon',
										'tooltip_enable' => false,
									) ); ?></div>
							</div>
						<?php endif; ?>
						<div class="col-sm-4 right-column">
							<?php if ( $right_column_text !== '' ) : ?>
								<?php echo '<div>' . $right_column_text . '</div>'; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer( 'blank' );
