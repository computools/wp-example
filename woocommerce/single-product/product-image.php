<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;
$class = 'images tm-light-gallery';
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<?php
		$props    = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
		$sub_html = '';

		if ( $props['title'] !== '' ) {
			$sub_html .= "<h4>{$props['title']}</h4>";
		}

		if ( $props['caption'] !== '' ) {
			$sub_html .= "<p>{$props['caption']}</p>";
		}

		$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title' => $props['title'],
			'alt'   => $props['alt'],
		) );

		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-src="%s" itemprop="image" class="woocommerce-main-image zoom" data-sub-html="%s">%s</a>', esc_url( $props['url'] ), esc_url( $props['url'] ), $sub_html, $image ), $post->ID );
		?>
		<?php
	} else {
		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'tm-moody' ) ), $post->ID );
	}
	?>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
