<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php post_class(); ?>>
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
