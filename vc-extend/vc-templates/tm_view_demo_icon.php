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
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-view-demo-icon ' . $el_class, $this->settings['base'], $atts );

$css_class    .= ' tm-grid-wrapper';
$grid_classes = 'tm-grid';
$grid_classes .= Insight_Helper::get_grid_animation_classes( 'scale-up' );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     data-type="masonry"
     data-lg-columns="4"
     data-sm-columns="2"
     data-xs-columns="1"
     data-gutter="30"
     data-grid-fitrows="true"
     data-match-height="true"
>
	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<div class="grid-sizer"></div>
		<?php
		foreach ( $items as $item ) {
			$classes = 'grid-item';
			$args    = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'name'        => $item['pages'],
			);

			$query = new WP_Query( $args );

			$_icon      = '';
			$icon_class = '';
			if ( isset( $item['icon_linea'] ) && $item['icon_linea'] !== '' ) {
				$icon_class .= $item['icon_linea'];
			}
			?>
			<?php if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="<?php echo esc_attr( $classes ); ?>">
						<a href="<?php the_permalink(); ?>">
							<div class="item-wrap">
								<?php if ( $icon_class !== '' ) : ?>
									<div class="item-icon">
										<i class=" <?php echo esc_attr( $icon_class ); ?>"></i>
									</div>
								<?php endif; ?>
								<h3 class="heading">
									<?php the_title(); ?>
								</h3>
							</div>
						</a>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php } ?>
	</div>
</div>
