<?php
/**
 * The template for displaying archive portfolio pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */
get_header();

$page_sidebar_position = Insight::setting( 'portfolio_archive_page_sidebar_position' );
$page_sidebar1         = Insight::setting( 'portfolio_archive_page_sidebar_1' );
$page_sidebar2         = Insight::setting( 'portfolio_archive_page_sidebar_2' );

$style               = Insight::setting( 'archive_portfolio_style' );
$columns             = Insight::setting( 'archive_portfolio_columns' );
$thumbnail_size      = Insight::setting( 'archive_portfolio_thumbnail_size' );
$overlay_style       = Insight::setting( 'archive_portfolio_overlay_style' );
$animation           = Insight::setting( 'archive_portfolio_animation' );
$gutter              = 30;
$carousel_nav        = '1';
$carousel_pagination = '1';
$carousel_auto_play  = 5000;
$carousel_gutter     = 30;
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content col-md-12">
					<?php if ( have_posts() ) : ?>
						<?php
						$css_class = 'tm-portfolio';
						$css_class .= ' style-' . $style;

						$css_class    .= ' grid-' . $columns . '-column';
						$grid_classes = 'tm-grid';
						$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );
						if ( $style === '4' ) {
							$grid_classes   .= ' swiper-wrapper';
							$slider_classes = 'tm-swiper';
							if ( $carousel_nav !== '' ) {
								$slider_classes .= " nav-style-$carousel_nav";
							}
							if ( $carousel_pagination !== '' ) {
								$slider_classes .= " pagination-style-$carousel_pagination";
							}
						}

						global $wp_query;
						$count = $wp_query->post_count;
						?>
						<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>"
							<?php if ( in_array( $style, array( '1', '2', '3' ), true ) ) { ?>
								data-type="masonry"
							<?php } elseif ( in_array( $style, array( '4' ), true ) ) { ?>
								data-type="swiper"
							<?php } ?>
							<?php if ( in_array( $style, array( '1', '3' ), true ) ): ?>
								data-lg-columns="<?php echo esc_attr( $columns ); ?>"
								data-sm-columns="2"
								data-xs-columns="1"
							<?php endif; ?>
							<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
								data-gutter="<?php echo esc_attr( $gutter ); ?>"
							<?php endif; ?>
							<?php if ( $style === '2' ) : ?>
								data-lg-columns="3"
								data-md-columns="3"
								data-sm-columns="2"
								data-xs-columns="1"
								data-grid-metro="2"
							<?php endif; ?>
						>
							<?php if ( $style === '4' ) { ?>
							<div class="<?php echo esc_attr( $slider_classes ); ?>"
							     data-lg-items="<?php echo esc_attr( $columns ); ?>"
							     data-sm-items="3"
							     data-xs-items="1"
								<?php if ( $carousel_gutter > 1 ) : ?>
									data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
								<?php endif; ?>
								<?php if ( $carousel_nav !== '' ) : ?>
									data-nav="1"
								<?php endif; ?>
								<?php if ( $carousel_pagination !== '' ) : ?>
									data-pagination="1"
								<?php endif; ?>
								<?php if ( $carousel_auto_play !== '' ) : ?>
									data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
								<?php endif; ?>
							>
								<div class="swiper-container">
									<?php } ?>

									<div class="<?php echo esc_attr( $grid_classes ); ?>"
									     data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"
									>
										<div class="grid-sizer"></div>
										<?php if ( $style === '1' ) { ?>
											<?php
											while ( have_posts() ) :
												the_post();
												$classes = array( 'portfolio-item grid-item' );
												?>
												<div <?php post_class( implode( ' ', $classes ) ); ?>>
													<div class="post-item-wrapper">
														<div class="post-thumbnail">
															<a href="<?php Insight_Helper::portfolio_the_permalink(); ?>">
																<?php
																if ( has_post_thumbnail() ) {
																	the_post_thumbnail( $thumbnail_size );
																} else {
																	switch ( $thumbnail_size ) {
																		case 'insight-grid-classic-square' :
																			Insight_Templates::image_placeholder( 600, 600 );
																			break;
																		case 'insight-grid-classic-2' :
																			Insight_Templates::image_placeholder( 600, 463 );
																			break;
																		default :
																			Insight_Templates::image_placeholder( 500, 675 );
																			break;
																	}
																}
																?>
															</a>
															<?php if ( $overlay_style !== '' ) : ?>
																<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
															<?php endif; ?>
														</div>
													</div>
												</div>
											<?php endwhile; ?>

										<?php } elseif ( $style === '2' ) { ?>

											<?php
											$metro_layout       = array(
												'',
												'grid-item--width2 grid-item--height2',
												'grid-item--height2',
												'',
												'',
												'grid-item--width2 grid-item--height2',
												'',
												'grid-item--height2',
												'',
												'',
											);
											$metro_layout_count = count( $metro_layout );
											$metro_item_count   = 0;
											while ( have_posts() ) :
												the_post();
												$classes    = array( 'portfolio-item grid-item' );
												$categories = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' );

												$_image_size              = 'insight-grid-metro';
												$_image_placeholdit_width = 400;
												$_image_placeholdit_heigh = 400;

												$classes[] = $metro_layout[ $metro_item_count ];
												if ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
													$_image_size               = 'insight-grid-metro-height-2';
													$_image_placeholdit_height = 800;
												} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
													$_image_placeholdit_width  = 800;
													$_image_placeholdit_height = 800;
													$_image_size               = 'insight-grid-metro-width-2-height-2';
												}
												?>
												<div <?php post_class( implode( ' ', $classes ) ); ?>
													<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
														'grid-item--width2',
														'grid-item--width2 grid-item--height2',
													), true ) ) : ?>
														data-width="2"
													<?php endif; ?>
													<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
														'grid-item--height2',
														'grid-item--width2 grid-item--height2',
													), true ) ) : ?>
														data-height="2"
													<?php endif; ?>
												>
													<div class="post-item-wrapper">
														<div class="post-thumbnail">
															<?php
															if ( has_post_thumbnail() ) {
																the_post_thumbnail( $_image_size );
															} else {
																Insight_Templates::image_placeholder( $_image_placeholdit_width, 570 );
															}
															?>
															<?php if ( $overlay_style !== '' ) : ?>
																<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
															<?php endif; ?>
														</div>
													</div>
												</div>
												<?php
												$metro_item_count++;
												if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
													$metro_item_count = 0;
												}
												?>
											<?php endwhile; ?>
										<?php } elseif ( $style === '3' ) { ?>
											<?php
											while ( have_posts() ) :
												the_post();
												$classes = array( 'portfolio-item grid-item' );
												?>
												<div <?php post_class( implode( ' ', $classes ) ); ?>>
													<div class="post-item-wrapper">
														<div class="post-thumbnail">
															<?php
															if ( has_post_thumbnail() ) {
																the_post_thumbnail( 'insight-grid-masonry' );
															} else {
																Insight_Templates::image_placeholder( 570, 570 );
															}
															?>
															<?php if ( $overlay_style !== '' ) : ?>
																<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
															<?php endif; ?>
														</div>
													</div>
												</div>
											<?php endwhile; ?>
										<?php } elseif ( $style === '4' ) { ?>
											<?php
											while ( have_posts() ) :
												the_post();
												$classes = array( 'portfolio-item grid-item swiper-slide' );
												?>
												<div <?php post_class( implode( ' ', $classes ) ); ?>>
													<div class="post-item-wrapper">
														<div class="post-thumbnail">
															<?php
															if ( has_post_thumbnail() ) {
																the_post_thumbnail( $thumbnail_size );
															} else {
																switch ( $thumbnail_size ) {
																	case 'insight-grid-classic-square' :
																		Insight_Templates::image_placeholder( 600, 600 );
																		break;
																	case 'insight-grid-classic-2' :
																		Insight_Templates::image_placeholder( 600, 463 );
																		break;
																	default :
																		Insight_Templates::image_placeholder( 500, 675 );
																		break;
																}
															}
															?>
															<?php if ( $overlay_style !== '' ) : ?>
																<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
															<?php endif; ?>
														</div>
													</div>
												</div>
											<?php endwhile; ?>
										<?php } ?>
									</div>
									<?php if ( $style === '4' ) { ?>
								</div>
							</div>
						<?php } ?>
						</div>
					<?php else :
						get_template_part( 'components/content', 'none' );
					endif; ?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();
