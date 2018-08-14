<?php
if ( $metro_layout !== '' ) {
	$metro_layout = (array) vc_param_group_parse_atts( $metro_layout );
	$_sizes       = array();
	foreach ( $metro_layout as $key => $value ) {
		$_sizes[] = $value['size'];
	}
	$metro_layout = $_sizes;
} else {
	$metro_layout = array(
		'1:1',
		'2:2',
		'1:2',
		'1:1',
		'1:1',
		'2:2',
		'1:1',
		'1:2',
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

	$classes   = array( 'portfolio-item grid-item' );
	$classes[] = $metro_layout[ $metro_item_count ];

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
		<div class="post-item-wrapper">
			<div class="post-thumbnail">
				<?php
				if ( has_post_thumbnail() ) { ?>
					<?php
					$full_image_size = get_the_post_thumbnail_url( null, 'full' );
					$image_url       = Insight_Helper::aq_resize( array(
						'url'    => $full_image_size,
						'width'  => $_image_width,
						'height' => $_image_height,
						'crop'   => true,
					) );
					?>
					<img src="<?php echo esc_url( $image_url ); ?>"
					     alt="<?php get_the_title(); ?>"/>
					<?php
				} else {
					Insight_Templates::image_placeholder( $_image_width, $_image_height );
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
<?php endwhile;
