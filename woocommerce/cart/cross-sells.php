<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
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
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $cross_sells ) : ?>

	<div class="cross-sells products">
		<h2><?php esc_html_e( 'You may be interested in&hellip;', 'tm-moody' ) ?></h2>

		<div class="tm-swiper"
		     data-lg-items="4"
		     data-md-items="3"
		     data-sm-items="2"
		     data-xs-items="1"
		     data-nav="1"
		     data-lg-gutter="30"
		>
			<div class="swiper-container">
				<div class="swiper-wrapper">

					<?php foreach ( $cross_sells as $cross_sell ) : ?>

						<?php
						$post_object = get_post( $cross_sell->get_id() );
						setup_postdata( $GLOBALS['post'] =& $post_object );
						?>
						<div class="swiper-slide">
							<?php wc_get_template_part( 'content', 'product2' ); ?>
						</div>

					<?php endforeach; ?>

				</div>
			</div>
		</div>

	</div>

<?php endif;

wp_reset_postdata();

