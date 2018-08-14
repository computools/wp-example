<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) { ?>

	<div class="thumbnails tm-swiper"
	     data-nav="1"
	     data-lg-items="4"
	     data-lg-gutter="10"
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php
				foreach ( $attachment_ids as $attachment_id ) {
					$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
					$sub_html        = '';
					$image_url       = Insight_Helper::aq_resize( array(
						'url'    => $full_size_image[0],
						'width'  => 135,
						'height' => 167,
						'crop'   => true,
					) );

					$title   = get_post_field( 'post_title', $attachment_id );
					$caption = get_post_field( 'post_excerpt', $attachment_id );

					$classes     = array( 'zoom' );
					$image_class = implode( ' ', $classes );

					if ( $title !== '' ) {
						$sub_html .= "<h4>{$title}</h4>";
					}

					if ( $caption !== '' ) {
						$sub_html .= "<p>{$caption}</p>";
					}

					echo sprintf( '
					<div class="swiper-slide">
						<a href="%s" data-src="%s" class="%s" data-sub-html="%s"><img src="%s" alt="%s"></a>
					</div>', esc_url( $full_size_image[0] ), esc_url( $full_size_image[0] ), esc_attr( $image_class ), $sub_html, $image_url, $title, 0 );
				}
				?>
			</div>
		</div>
	</div>

	<?php
}
