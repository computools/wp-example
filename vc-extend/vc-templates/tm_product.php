<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style  = $el_class = $animation = $thumbnail_size = '';
$gutter = 0;
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$insight_post_args = array(
	'post_type'      => 'product',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
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
$css_id   = uniqid( 'tm-product-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-product ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $filter_wrap == '1' ) {
	$css_class .= ' filter-wrap';
}

$grid_classes = 'tm-grid';
$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );

if ( in_array( $style, array( 'carousel' ), true ) ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
}

global $woocommerce_loop;
$woocommerce_loop['thumbnail_size'] = $thumbnail_size;
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div class="woocommerce">
		<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>"
		     id="<?php echo esc_attr( $css_id ); ?>"

			<?php if ( in_array( $style, array( 'grid' ), true ) ) { ?>
				data-type="masonry"
				data-grid-fitrows="true"
			<?php } elseif ( in_array( $style, array( 'carousel' ), true ) ) { ?>
				data-type="swiper"
			<?php } ?>

			<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
				data-pagination="<?php echo esc_attr( $pagination ); ?>"
			<?php endif; ?>

			<?php if ( in_array( $style, array( 'grid' ), true ) ): ?>
				<?php
				if ( $columns !== '' ) {
					$arr = explode( ';', $columns );
					foreach ( $arr as $value ) {
						$tmp = explode( ':', $value );
						echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
					}
				}
				?>
			<?php endif; ?>

			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		>
			<?php
			$count = $insight_query->post_count;

			$insight_query_params                  = $insight_post_args;
			$insight_query_params['action']               = 'product_infinite_load';
			$insight_query_params['max_num_pages'] = $insight_query->max_num_pages;
			$insight_query_params['found_posts']   = $insight_query->found_posts;
			$insight_query_params['taxonomies']    = $taxonomies;
			$insight_query_params['style']         = $style;
			$insight_query_params['pagination']    = $pagination;
			$insight_query_params['count']         = $count;
			$insight_query_params                  = htmlspecialchars( wp_json_encode( $insight_query_params ) );
			?>

			<?php //Insight_Templates::grid_portfolio_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap ) ?>

			<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $insight_query_params . '"'; ?>/>

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
					     data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"
					>
						<?php if ( in_array( $style, array( 'grid' ), true ) ): ?>
							<div class="grid-sizer"></div>
						<?php endif; ?>

						<?php if ( $style === 'grid' ) { ?>
							<?php
							while ( $insight_query->have_posts() ) :
								$insight_query->the_post();
								$classes = array( 'product-item grid-item' );
								?>
								<div <?php post_class( $classes ); ?>>
									<div class="product-thumbnail">
										<?php woocommerce_template_loop_product_link_open(); ?>
										<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
										<?php woocommerce_template_loop_product_link_close(); ?>
										<div class="<?php echo esc_attr( "actions" ); ?>">
											<div class="action action-view-detail">
												<?php woocommerce_template_loop_product_link_open(); ?>
												<i class="icon-magnifier-1"></i>
												<?php woocommerce_template_loop_product_link_close(); ?>
											</div>
											<div class="action action-add-to-cart">
												<?php woocommerce_template_loop_add_to_cart(); ?>
											</div>
										</div>
									</div>
									<div class="product-info">
										<?php
										woocommerce_template_loop_product_link_open();
										do_action( 'woocommerce_shop_loop_item_title' );
										woocommerce_template_loop_price();
										woocommerce_template_loop_product_link_close();
										?>
									</div>
								</div>
							<?php endwhile; ?>
						<?php } elseif ( $style === 'carousel' ) { ?>
							<?php
							while ( $insight_query->have_posts() ) :
								$insight_query->the_post();
								$classes = array( 'product-item grid-item swiper-slide' );
								?>
								<div <?php post_class( $classes ); ?>>
									<div class="product-thumbnail">
										<?php woocommerce_template_loop_product_link_open(); ?>
										<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
										<?php woocommerce_template_loop_product_link_close(); ?>
										<div class="<?php echo esc_attr( "actions" ); ?>">
											<div class="action action-view-detail">
												<?php woocommerce_template_loop_product_link_open(); ?>
												<i class="icon-magnifier-1"></i>
												<?php woocommerce_template_loop_product_link_close(); ?>
											</div>
											<div class="action action-add-to-cart">
												<?php woocommerce_template_loop_add_to_cart(); ?>
											</div>
										</div>
									</div>
									<div class="product-info">
										<?php
										woocommerce_template_loop_product_link_open();
										do_action( 'woocommerce_shop_loop_item_title' );
										woocommerce_template_loop_price();
										woocommerce_template_loop_product_link_close();
										?>
									</div>
								</div>
							<?php endwhile; ?>
						<?php } ?>
					</div>

					<?php if ( $style === 'carousel' ) { ?>
				</div>
			</div>
		<?php } ?>

			<?php Insight_Templates::grid_pagination( $insight_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata();
