<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product;

if ( ! $product->is_in_stock() ) {
	echo '<span class="out-of-stock-label">' . esc_html__( 'Sold out', 'tm-moody' ) . '</span>';
} else {
	$featured        = get_post_meta( $post->ID, '_featured', 'true' ) === 'yes' ? true : false;
	$postdate        = get_the_time( 'Y-m-d', $post->ID );
	$post_date_stamp = strtotime( $postdate );
	$new_days        = Insight::setting( 'shop_archive_new_days' );
	if ( $featured || $product->is_on_sale() || ( ( time() - ( 60 * 60 * 24 * $new_days ) ) < $post_date_stamp ) ) {
		echo '<div class="badges">';
		if ( $featured ) {
			echo '<span class="hot">' . esc_html__( 'Hot', 'tm-moody' ) . '</span>';
		}
		if ( $product->is_on_sale() ) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale', 'tm-moody' ) . '</span>', $post, $product );
		}
		if ( ( time() - ( 60 * 60 * 24 * $new_days ) ) < $post_date_stamp ) {
			echo '<span class="new">' . esc_html__( 'New', 'tm-moody' ) . '</span>';
		}
		echo '</div>';
	}
}
