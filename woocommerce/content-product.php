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
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$product_id            = $product->get_id();
$class                 = '';
$page_sidebar_position = Insight_Helper::get_post_meta( 'page_sidebar_position', 'default' );
$page_sidebar1         = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
$page_sidebar2         = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );

if ( $page_sidebar1 === 'default' ) {
	$page_sidebar1 = Insight::setting( 'product_archive_page_sidebar_1' );
}

if ( $page_sidebar2 === 'default' ) {
	$page_sidebar2 = Insight::setting( 'product_archive_page_sidebar_2' );
}

if ( $page_sidebar_position === 'default' ) {
	$page_sidebar_position = Insight::setting( 'product_archive_page_sidebar_position' );
}
if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
	$class .= 'col-lg-6 col-sm-6';
} else {
	$class .= 'col-lg-4 col-sm-6';
}
?>
<div <?php wc_product_class( $class ); ?>>
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
