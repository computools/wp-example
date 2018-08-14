<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style              = $el_class = $columns = $animation = '';
$gutter             = 0;
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';
$atts               = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $images === '' ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-gallery-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-gallery tm-grid-wrapper ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid tm-light-gallery';
$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );

$images = explode( ',', $images );
$count  = count( $images );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"

	<?php if ( in_array( $style, array( 'grid', 'metro', 'masonry' ), true ) ) { ?>
		data-type="masonry"
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
	<div class="<?php echo esc_attr( $grid_classes ); ?>">

		<?php if ( in_array( $style, array( 'grid', 'metro', 'masonry' ), true ) ) : ?>
			<div class="grid-sizer"></div>
		<?php endif; ?>

		<?php if ( $style === 'grid' ) { ?>
			<?php
			foreach ( $images as $image ) {
				$classes = array( 'gallery-item grid-item' );

				$image_full = Insight_Helper::get_attachment_info( $image );

				$image_url = Insight_Helper::aq_resize( array(
					'url'    => $image_full['src'],
					'width'  => 480,
					'height' => 480,
					'crop'   => true,
				) );
				$_sub_html = '';
				if ( $image_full['title'] !== '' ) {
					$_sub_html .= "<h4>{$image_full['title']}</h4>";
				}

				if ( $image_full['caption'] !== '' ) {
					$_sub_html .= "<p>{$image_full['caption']}</p>";
				}
				?>
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<a href="<?php echo esc_url( $image_full['src'] ); ?>" class="zoom"
					   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="">
						<div class="overlay">
							<div>+</div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
		<?php } elseif ( $style === 'masonry' ) { ?>
			<?php
			foreach ( $images as $image ) {
				$classes = array( 'gallery-item grid-item' );

				$image_full = Insight_Helper::get_attachment_info( $image );

				$image_url = Insight_Helper::aq_resize( array(
					'url'    => $image_full['src'],
					'width'  => 480,
					'height' => 9999,
					'crop'   => false,
				) );
				$_sub_html = '';
				if ( $image_full['title'] !== '' ) {
					$_sub_html .= "<h4>{$image_full['title']}</h4>";
				}

				if ( $image_full['caption'] !== '' ) {
					$_sub_html .= "<p>{$image_full['caption']}</p>";
				}
				?>
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<a href="<?php echo esc_url( $image_full['src'] ); ?>" class="zoom"
					   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="">
						<div class="overlay">
							<div>+</div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
		<?php } elseif ( $style === 'metro' ) { ?>
			<?php
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

			foreach ( $images as $image ) {
				$classes = array( 'gallery-item grid-item' );

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


				$image_full = Insight_Helper::get_attachment_info( $image );

				$image_url = Insight_Helper::aq_resize( array(
					'url'    => $image_full['src'],
					'width'  => $_image_width,
					'height' => $_image_height,
					'crop'   => true,
				) );
				$_sub_html = '';
				if ( $image_full['title'] !== '' ) {
					$_sub_html .= "<h4>{$image_full['title']}</h4>";
				}

				if ( $image_full['caption'] !== '' ) {
					$_sub_html .= "<p>{$image_full['caption']}</p>";
				}
				?>
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
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
					<a href="<?php echo esc_url( $image_full['src'] ); ?>" class="zoom"
					   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="">
						<div class="overlay">
							<div>+</div>
						</div>
					</a>
				</div>
				<?php
				$metro_item_count++;
				if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
					$metro_item_count = 0;
				}
				?>
			<?php } ?>
		<?php } elseif ( $style === 'justified' ) { ?>
			<?php
			foreach ( $images as $image ) {
				$classes = array( 'gallery-item grid-item' );

				$image_full = Insight_Helper::get_attachment_info( $image );

				$image_url = Insight_Helper::aq_resize( array(
					'url'    => $image_full['src'],
					'width'  => 480,
					'height' => 9999,
					'crop'   => false,
				) );
				$_sub_html = '';
				if ( $image_full['title'] !== '' ) {
					$_sub_html .= "<h4>{$image_full['title']}</h4>";
				}

				if ( $image_full['caption'] !== '' ) {
					$_sub_html .= "<p>{$image_full['caption']}</p>";
				}
				?>
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<a href="<?php echo esc_url( $image_full['src'] ); ?>" class="zoom"
					   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="">
						<div class="overlay">
							<div>+</div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
		<?php } ?>
	</div>
</div>
