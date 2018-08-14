<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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

get_header( 'shop' );

$page_sidebar_position = Insight::setting( 'product_archive_page_sidebar_position' );
$page_sidebar1         = Insight::setting( 'product_archive_page_sidebar_1' );
$page_sidebar2         = Insight::setting( 'product_archive_page_sidebar_2' );

$category_per_page = 4;
if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
	$category_per_page = 3;
}
?>

<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content col-md-12">

					<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
					?>

					<?php
					$shop_page_display = get_option( 'woocommerce_shop_page_display' );

					if ( $shop_page_display !== '' ) {
						woocommerce_output_product_categories( array(
							'before' => '<div class="cats tm-swiper" data-lg-items="' . $category_per_page . '" data-sm-items="2" data-xs-items="1" data-lg-gutter="30" data-nav="1" data-loop="1"><div class="swiper-container"><div class="swiper-wrapper">',
							'after'  => '</div></div></div>',
						) );
					}
					?>

					<?php if ( woocommerce_product_loop() ) : ?>

						<div class="archive-shop-actions row row-xs-center">
							<?php
							/**
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>

						<?php
						woocommerce_product_loop_start();

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}

						woocommerce_product_loop_end();

						/**
						 * woocommerce_after_shop_loop hook.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					else :
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					endif; ?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer( 'shop' );

