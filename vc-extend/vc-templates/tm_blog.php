<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style              = $el_class = '';
$categories         = $meta_key = $pagination = $animation = '';
$filter_category    = $filter_type = '';
$carousel_direction = $carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';
$atts               = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$insight_post_args = array(
	'post_type'      => 'post',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'post__not_in'   => get_option( 'sticky_posts' ),
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
	$insight_post_args['meta_key'] = $meta_key;
}

if ( get_query_var( 'paged' ) ) {
	$insight_post_args['paged'] = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$insight_post_args['paged'] = get_query_var( 'page' );
}

$insight_post_args = Insight_VC::get_tax_query_of_taxonomies( $insight_post_args, $taxonomies );

$insight_query = new WP_Query( $insight_post_args );

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-blog-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blog ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

$grid_classes = 'tm-grid';

if ( $style === 'carousel' ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper equal-height';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
}

if ( $animation === '' ) {
	$animation = Insight::setting( 'shortcode_blog_css_animation' );
}
$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );
?>

<?php if ( $insight_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( $filter_type === 'ajax' ) : ?>
			data-filter-type="ajax"
		<?php endif; ?>

		<?php if ( in_array( $style, array(
			'grid',
			'grid_left_image',
			'grid_feature',
			'grid_classic',
			'grid_simple',
			'grid_flip_box',
			'grid_modern',
			'magazine',
			'metro',
		), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( in_array( $style, array( 'carousel' ), true ) ) { ?>
			data-type="swiper"
		<?php } ?>

		<?php if ( in_array( $style, array(
				'grid',
				'grid_left_image',
				'grid_feature',
				'grid_classic',
				'grid_simple',
				'grid_flip_box',
				'grid_modern',
				'metro',
			), true ) && $columns !== ''
		) { ?>
			<?php
			$arr = explode( ';', $columns );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
			}
			?>
		<?php } ?>

		<?php if ( $style === 'metro' ) { ?>
			data-grid-ratio="1:1"
		<?php } elseif ( $style === 'magazine' ) { ?>
			data-grid-ratio="114:77"
			data-lg-columns="2"
			data-sm-columns="1"
		<?php } ?>

		<?php if ( in_array( $style, array(
			'grid',
			'grid_left_image',
			'grid_classic',
			'grid_simple',
			'grid_flip_box',
			'grid_modern',
		), true ) ) : ?>
			data-grid-fitrows="true"
			data-match-height="true"
		<?php endif; ?>

		<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
			data-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>
	>
		<?php
		$i     = 0;
		$count = $insight_query->post_count;

		$insight_query_params                  = $insight_post_args;
		$insight_query_params['action']        = 'post_infinite_load';
		$insight_query_params['max_num_pages'] = $insight_query->max_num_pages;
		$insight_query_params['found_posts']   = $insight_query->found_posts;
		$insight_query_params['style']         = $style;
		$insight_query_params['pagination']    = $pagination;
		$insight_query_params['count']         = $count;
		$insight_query_params['taxonomies']    = $taxonomies;
		$insight_query_params                  = htmlspecialchars( wp_json_encode( $insight_query_params ) );
		?>

		<?php Insight_Templates::grid_blog_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap, $filter_category, $insight_query->found_posts ); ?>

		<input type="hidden" class="tm-grid-query" value="<?php echo '' . $insight_query_params; ?>"/>

		<?php if ( $style === 'carousel' ) { ?>
		<div class="<?php echo esc_attr( $slider_classes ); ?>"
			<?php
			if ( $carousel_items_display !== '' ) {
				$arr = explode( ';', $carousel_items_display );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
				}
			}
			?>
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
					<?php if ( in_array( $style, array( 'list', 'grid_feature' ), true ) ) : ?>
						data-grid-has-gallery="true"
					<?php endif; ?>
				>

					<?php if ( in_array( $style, array(
						'grid',
						'grid_left_image',
						'grid_feature',
						'grid_classic',
						'grid_simple',
						'grid_flip_box',
						'grid_modern',
						'magazine',
						'metro',
					), true ) ) : ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>

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
					<?php } elseif ( $style === 'grid' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-feature-overlay">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-feature"
										     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
										</div>
									<?php } ?>
									<div class="post-overlay">

									</div>
								</div>
								<div class="post-info">
									<?php get_template_part( 'loop/blog/title' ); ?>
									<?php get_template_part( 'loop/blog/meta' ); ?>
									<?php get_template_part( 'loop/blog/excerpt' ); ?>
									<div class="post-footer">
										<?php get_template_part( 'loop/blog/readmore' ); ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'grid_left_image' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-wrapper">
									<?php if ( has_post_thumbnail() ) { ?>
										<?php get_template_part( 'loop/blog-left-image/format' ); ?>
									<?php } ?>
									<div class="post-info">
										<?php get_template_part( 'loop/blog/category' ); ?>
										<?php get_template_part( 'loop/blog/title' ); ?>
										<div class="post-footer">
											<?php get_template_part( 'loop/blog/readmore' ); ?>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'grid_feature' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							$format  = '';
							if ( get_post_format() !== false ) {
								$format = get_post_format();
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<?php if ( ! in_array( $format, array( 'link' ) ) ) : ?>
									<?php get_template_part( 'loop/blog-feature/format', $format ); ?>
								<?php endif; ?>
								<div class="post-info">
									<?php get_template_part( 'loop/blog/title' ); ?>
									<?php get_template_part( 'loop/blog/meta' ); ?>
									<?php if ( in_array( $format, array( 'link' ) ) ) : ?>
										<?php get_template_part( 'loop/blog-feature/format', $format ); ?>
									<?php endif; ?>
									<?php get_template_part( 'loop/blog/excerpt' ); ?>
									<div class="post-footer">
										<?php get_template_part( 'loop/blog/readmore' ); ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'grid_simple' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							$format  = '';
							if ( get_post_format() !== false ) {
								$format = get_post_format();
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-format-wrapper">
									<?php get_template_part( 'loop/blog-simple/format' ); ?>
									<a href="<?php the_permalink(); ?>">
										<div class="post-overlay"></div>
										<div class="post-overlay-content"></div>
									</a>
								</div>
								<div class="post-info">
									<?php get_template_part( 'loop/blog/title' ); ?>
									<?php get_template_part( 'loop/blog/meta' ); ?>
									<?php get_template_part( 'loop/blog/excerpt' ); ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'grid_classic' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							$format  = '';
							if ( get_post_format() !== false ) {
								$format = get_post_format();
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>
								<?php if ( in_array( $format, array( 'gallery' ), true ) ) : ?>
									data-width="2"
								<?php endif; ?>
							>
								<div class="wrap">
									<?php if ( ! in_array( $format, array( 'link', 'quote' ) ) ) : ?>
										<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
									<?php endif; ?>
									<div class="inner">
										<div class="post-info">
											<?php get_template_part( 'loop/blog/meta' ); ?>

											<?php if ( ! in_array( $format, array( 'quote' ), true ) ) : ?>
												<?php get_template_part( 'loop/blog/title' ); ?>
												<?php get_template_part( 'loop/blog/excerpt' ); ?>
											<?php endif; ?>

											<?php if ( in_array( $format, array( 'link', 'quote' ) ) ) : ?>
												<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
											<?php endif; ?>
											<div class="post-footer">
												<?php get_template_part( 'loop/blog/author' ); ?>
												<?php get_template_part( 'loop/blog/comment', 'count' ); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'grid_modern' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-wrapper">
									<?php get_template_part( 'loop/blog-classic/format' ); ?>

									<div class="post-info">
										<?php get_template_part( 'loop/blog/category' ); ?>
										<?php get_template_part( 'loop/blog/title' ); ?>
										<div class="post-footer">
											<?php get_template_part( 'loop/blog/meta-author-date' ); ?>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'grid_flip_box' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );

							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							$image_url       = Insight_Helper::aq_resize( array(
								'url'    => $full_image_size,
								'width'  => 480,
								'height' => 480,
								'crop'   => true,
							) );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="tm-rotate-box">
									<div class="flipper to-left">
										<div class="thumb-wrap">
											<div class="front">
												<div class="content-wrap">
													<div class="content-inner">
														<?php get_template_part( 'loop/blog/category' ); ?>
														<?php get_template_part( 'loop/blog/title' ); ?>
													</div>
													<?php get_template_part( 'loop/blog/meta-author-date' ); ?>
												</div>
											</div>
											<div class="back">
												<div class="content-wrap"
												     style="background-image: url(<?php echo esc_url( $image_url ); ?>)">
													<div class="content-inner">
														<?php get_template_part( 'loop/blog/category' ); ?>
														<?php get_template_part( 'loop/blog/title' ); ?>
													</div>
													<?php get_template_part( 'loop/blog/meta-author-date' ); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'carousel' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item swiper-slide' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-feature-overlay">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-feature"
										     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
										</div>
									<?php } ?>
									<div class="post-overlay">

									</div>
								</div>
								<div class="post-info">
									<?php get_template_part( 'loop/blog/title' ); ?>
									<?php get_template_part( 'loop/blog/meta' ); ?>
									<?php get_template_part( 'loop/blog/excerpt' ); ?>
									<div class="post-footer">
										<?php get_template_part( 'loop/blog/readmore' ); ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === 'magazine' ) {
						$metro_layout       = array(
							'grid-item--width2',
							'',
							'',
							'grid-item--height2',
							'',
							'',
						);
						$metro_layout_count = count( $metro_layout );
						$metro_item_count   = 0;
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();

							$classes   = array( 'post-item grid-item' );
							$classes[] = $metro_layout[ $metro_item_count ];

							$_image_width  = 570;
							$_image_height = 385;
							if ( $metro_layout[ $metro_item_count ] === 'grid-item--width2' ) {
								$_image_width  = 1170;
								$_image_height = 385;
							} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
								$_image_width  = 570;
								$_image_height = 800;
							} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
								$_image_width  = 1170;
								$_image_height = 800;
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
								<?php if ( has_post_thumbnail() ) { ?>
									<?php
									$full_image_size = get_the_post_thumbnail_url( null, 'full' );
									$image_url       = Insight_Helper::aq_resize( array(
										'url'    => $full_image_size,
										'width'  => $_image_width,
										'height' => $_image_height,
										'crop'   => true,
									) );
									?>
									<div class="post-thumbnail"
									     style="background-image: url(<?php echo esc_url( $image_url ); ?>);"></div>
									<div class="post-overlay"></div>
								<?php } ?>
								<div class="post-info">
									<?php get_template_part( 'loop/blog/title' ); ?>
									<?php get_template_part( 'loop/blog/meta' ); ?>
									<div class="post-footer">
										<?php get_template_part( 'loop/blog/readmore' ); ?>
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
					<?php } elseif ( $style === 'metro' ) {
						if ( $metro_layout ) {
							$metro_layout = (array) vc_param_group_parse_atts( $metro_layout );
							$_sizes       = array();
							foreach ( $metro_layout as $key => $value ) {
								$_sizes[] = $value['size'];
							}
							$metro_layout = $_sizes;
						} else {
							$metro_layout = array(
								'2:2',
								'1:1',
								'1:1',
								'2:2',
								'1:1',
								'1:1',
							);
						}

						if ( count( $metro_layout ) < 1 ) {
							return;
						}

						$metro_layout_count = count( $metro_layout );
						$metro_item_count   = 0;

						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();

							$classes = array( 'post-item grid-item' );

							$_image_width  = 480;
							$_image_height = 480;
							if ( $metro_layout[ $metro_item_count ] === '2:1' ) {
								$_image_width  = 960;
								$_image_height = 480;
							} elseif ( $metro_layout[ $metro_item_count ] === '1:2' ) {
								$_image_width  = 480;
								$_image_height = 960;
							} elseif ( $metro_layout[ $metro_item_count ] === '2:2' ) {
								$_image_width  = 960;
								$_image_height = 960;
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>
								<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
									'2:1',
									'2:2',
								), true ) ) : ?>
									data-width="2"
								<?php endif; ?>
								<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
									'1:2',
									'2:2',
								), true ) ) : ?>
									data-height="2"
								<?php endif; ?>
							>
								<?php if ( has_post_thumbnail() ) { ?>
									<?php
									$full_image_size = get_the_post_thumbnail_url( null, 'full' );
									$image_url       = Insight_Helper::aq_resize( array(
										'url'    => $full_image_size,
										'width'  => $_image_width,
										'height' => $_image_height,
										'crop'   => true,
									) );
									?>
									<div class="post-thumbnail"
									     style="background-image: url(<?php echo esc_url( $image_url ); ?>);"></div>
									<div class="post-overlay"></div>
								<?php } ?>
								<div class="post-info">
									<?php get_template_part( 'loop/blog/title' ); ?>
									<?php get_template_part( 'loop/blog/meta' ); ?>
								</div>
							</div>
							<?php
							$metro_item_count++;
							if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
								$metro_item_count = 0;
							}
							?>
						<?php endwhile; ?>
					<?php } ?>
				</div>

				<?php if ( $style === 'carousel' ) { ?>
			</div>
		</div>
	<?php } ?>

		<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
			<div class="tm-grid-pagination" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">
				<?php if ( $pagination === 'loadmore' || $pagination === 'infinite' ) { ?>
					<div class="tm-loader"></div>
					<?php if ( $pagination === 'loadmore' ) { ?>
						<a href="#" class="tm-button style-flat tm-button-default tm-button-nm tm-grid-loadmore-btn">
							<span><?php echo esc_html( $pagination_button_text ); ?></span>
						</a>
					<?php } ?>
				<?php } elseif ( $pagination === 'pagination' ) { ?>
					<?php Insight_Templates::paging_nav( $insight_query ); ?>
				<?php } ?>
			</div>
			<div class="tm-grid-messages" style="display: none;">
				<?php esc_html_e( 'All items displayed.', 'tm-moody' ); ?>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
