<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style              = $el_class = $order = $overlay_style = $animation = $filter_wrap = $filter_enable = $filter_category = $filter_align = $filter_counter = $pagination_align = $pagination_button_text = '';
$carousel_direction = $carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';
$gutter             = 0;
$image_size         = $metro_layout = $filter_type = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$insight_post_args = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
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
$css_id   = uniqid( 'tm-portfolio-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-portfolio ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$is_swiper = false;
if ( in_array( $style, array( 'carousel', 'carousel-auto-wide', 'full-wide-slider' ), true ) ) {
	$is_swiper = true;
}

if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

$grid_classes = 'tm-grid';

if ( $is_swiper ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " pagination-style-$carousel_pagination";
	}
}

if ( $style === 'carousel-auto-wide' ) {
	$slider_classes .= ' auto-slide-wide';
}

if ( ! $is_swiper ) {
	if ( $animation === '' ) {
		$animation = Insight::setting( 'shortcode_portfolio_css_animation' );
	}
	$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );
}
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>

		<?php if ( $filter_type === 'ajax' ) : ?>
			data-filter-type="ajax"
		<?php endif; ?>

		<?php if ( in_array( $style, array( 'grid', 'metro', 'masonry' ), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( $is_swiper ) { ?>
			data-type="swiper"
		<?php } elseif ( in_array( $style, array( 'justified' ), true ) ) { ?>
			data-type="justified"
			<?php if ( $justify_row_height !== '' && $justify_row_height > 0 ) { ?>
				data-justified-height="<?php echo esc_attr( $justify_row_height ); ?>"
			<?php } ?>
			<?php if ( $justify_max_row_height !== '' && $justify_max_row_height > 0 ) { ?>
				data-justified-max-height="<?php echo esc_attr( $justify_max_row_height ); ?>"
			<?php } ?>
			<?php if ( $justify_last_row_alignment !== '' ) { ?>
				data-justified-last-row="<?php echo esc_attr( $justify_last_row_alignment ); ?>"
			<?php } ?>
		<?php } ?>

		<?php if ( in_array( $style, array( 'metro' ), true ) ) : ?>
			data-grid-ratio="1:1"
		<?php endif; ?>

		<?php if ( in_array( $style, array( 'grid', 'metro', 'masonry' ), true ) && $columns !== '' ): ?>
			<?php
			$arr = explode( ';', $columns );
			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
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
		$insight_query_params['action']        = 'portfolio_infinite_load';
		$insight_query_params['max_num_pages'] = $insight_query->max_num_pages;
		$insight_query_params['found_posts']   = $insight_query->found_posts;
		$insight_query_params['taxonomies']    = $taxonomies;
		$insight_query_params['style']         = $style;
		$insight_query_params['image_size']    = $image_size;
		$insight_query_params['metro_layout']  = $metro_layout;
		$insight_query_params['overlay_style'] = $overlay_style;
		$insight_query_params['pagination']    = $pagination;
		$insight_query_params['count']         = $count;
		$insight_query_params                  = htmlspecialchars( wp_json_encode( $insight_query_params ) );
		?>

		<?php Insight_Templates::grid_portfolio_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap, $filter_category, $insight_query->found_posts ); ?>

		<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $insight_query_params . '"'; ?>/>

		<?php if ( $is_swiper ) { ?>
		<div class="<?php echo esc_attr( $slider_classes ); ?>"
			<?php if ( $style === 'carousel-auto-wide' ) { ?>
				data-slide-per-view="1"
			<?php } elseif ( $style === 'full-wide-slider' ) { ?>
				data-lg-items="1"
				data-effect="fade"
				data-loop="1"
			<?php } else { ?>
				<?php
				if ( $carousel_items_display !== '' ) {
					$arr = explode( ';', $carousel_items_display );
					foreach ( $arr as $value ) {
						$tmp = explode( ':', $value );
						echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
					}
				}
				?>
			<?php } ?>

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
					<?php if ( ! in_array( $style, array( 'full-wide-slider' ) ) ) : ?>
						data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"
					<?php endif; ?>
				>
					<?php if ( in_array( $style, array( 'grid', 'metro', 'masonry' ), true ) ): ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>

					<?php
					set_query_var( 'insight_query', $insight_query );
					set_query_var( 'count', $count );
					set_query_var( 'overlay_style', $overlay_style );
					set_query_var( 'image_size', $image_size );
					set_query_var( 'metro_layout', $metro_layout );

					get_template_part( 'loop/shortcodes/portfolio/style', $style );
					?>

				</div>

				<?php if ( $is_swiper ) { ?>
			</div>
		</div>
	<?php } ?>

		<?php Insight_Templates::grid_pagination( $insight_query, $number, $pagination, $pagination_align, $pagination_button_text ); ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
