<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$el_class = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}
$css_id = uniqid( 'tm-view-demo-' );
$this->get_inline_css( '#' . $css_id, $atts );
$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-view-demo ' . $el_class, $this->settings['base'], $atts );

$css_class    .= ' tm-grid-wrapper filter-style-1';
$grid_classes = 'tm-grid';
$grid_classes .= Insight_Helper::get_grid_animation_classes( 'scale-up' );

$filters = array();
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-type="masonry"
     data-lg-columns="3"
     data-sm-columns="2"
     data-xs-columns="1"
     data-gutter="85"
>
	<?php
	ob_start();
	?>

	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<div class="grid-sizer"></div>
		<?php
		foreach ( $items as $item ) {
			$classes = 'grid-item';
			if ( isset( $item['category'] ) && $item['category'] !== '' ) {
				$categories = explode( ',', $item['category'] );
				foreach ( $categories as $cat ) {
					$cat       = trim( $cat );
					$classes   .= " $cat";
					$filters[] = $cat;
				}
			}

			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'name'        => $item['pages'],
			);

			$query = new WP_Query( $args );
			?>
			<?php if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="<?php echo esc_attr( $classes ); ?>">
						<div class="item-wrap">
							<div class="thumbnail">
								<a class="btn-view-demo"
								   href="<?php the_permalink(); ?>"
								   target="_blank"
								>
									<?php if ( isset( $item['image'] ) ) : ?>
										<?php
										$full_image_size = wp_get_attachment_url( $item['image'] );
										$image_url       = Insight_Helper::aq_resize( array(
											'url'    => $full_image_size,
											'width'  => 600,
											'height' => 9999,
											'crop'   => false,
										) );
										?>
										<img src="<?php echo esc_url( $image_url ); ?>"
										     alt="<?php get_the_title(); ?>"/>
									<?php endif ?>
									<div class="overlay-content">
										<div class="btn-view-demo-text">
											<?php esc_html_e( 'View Demo', 'tm-moody' ); ?>
										</div>
									</div>
								</a>
							</div>
							<div class="info">
								<h3 class="heading">
									<a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
								</h3>
							</div>
							<?php if ( isset( $item['badge'] ) && $item['badge'] === 'new' ) : ?>
								<div class="badge">
									<?php esc_html_e( 'New!', 'tm-moody' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php } ?>
	</div>

	<?php
	$grid_output = ob_get_contents();
	ob_end_clean();
	$filters        = array_unique( $filters );
	$filter_align   = 'center';
	$filter_counter = 1;
	$filter_wrap    = '1';

	$filter_classes = array( 'tm-filter-button-group', $filter_align );
	if ( $filter_counter == 1 ) {
		$filter_classes[] = 'show-filter-counter';
	}
	?>

	<div class="<?php echo implode( ' ', $filter_classes ); ?>"
		<?php if ( $filter_counter == 1 ) : ?>
			data-filter-counter="true"
		<?php endif; ?>
	>
		<?php if ( $filter_wrap == '1' ) { ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php } ?>
					<a href="javascript:void(0);" class="btn-filter current"
					   data-filter="*">
						<span class="filter-text"><?php esc_html_e( 'All', 'tm-moody' ); ?></span>
					</a>
					<?php
					foreach ( $filters as $filter_item ) {
						printf( '<a href="javascript:void(0);" class="btn-filter" data-filter=".%s"><span class="filter-text">%s</span></a>', esc_attr( $filter_item ), $filter_item );
					}
					?>
					<?php if ( $filter_wrap == '1' ) { ?>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>

	<?php echo '' . $grid_output; ?>
</div>
