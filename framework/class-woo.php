<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions, filters, actions for WooCommerce.
 */
if ( ! class_exists( 'Insight_Woo' ) ) {
	class Insight_Woo {

		public function __construct() {
			// Disable Woocommerce cart fragments on home page.
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_woocommerce_cart_fragments' ), 11 );

			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ) );

			add_filter( 'woocommerce_checkout_fields', array( $this, 'override_checkout_fields' ) );

			add_action( 'wp_head', array( $this, 'init' ) );

			add_action( 'after_switch_theme', array( $this, 'change_woocommerce_image_dimensions' ), 1 );

			/* Begin hook for shop archive */

			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

			// Moving the catalog order to left side.
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );

			add_filter( 'woocommerce_pagination_args', array( $this, 'override_pagination_args' ) );
			add_filter( 'woocommerce_product_tag_cloud_widget_args', array( $this, 'change_product_tag_cloud_args' ) );

			// Change thumbnail size per product shortcode
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				$this,
				'change_template_loop_product_thumbnail',
			), 10 );

			/* End hook for shop archive */

			/* Begin hook for single product */

			// Remove tab heading in on single product pages.
			add_filter( 'woocommerce_product_description_heading', array(
				$this,
				'remove_product_description_heading',
			) );
			add_filter( 'woocommerce_product_additional_information_heading', array(
				$this,
				'remove_product_additional_information_heading',
			) );

			add_filter( 'woocommerce_review_gravatar_size', array( $this, 'woocommerce_review_gravatar_size' ) );

			/* End hook for single product */
		}

		public static function version_check( $version = '3.0.0' ) {
			global $woocommerce;

			if ( isset( $woocommerce->version ) && version_compare( $woocommerce->version, $version ) >= 0 ) {
				return true;
			}

			return false;
		}

		function change_template_loop_product_thumbnail() {
			global $woocommerce_loop;
			if ( isset( $woocommerce_loop['thumbnail_size'] ) && $woocommerce_loop['thumbnail_size'] !== '' ) {
				echo woocommerce_get_product_thumbnail( $woocommerce_loop['thumbnail_size'] );
			} else {
				echo woocommerce_get_product_thumbnail();
			}
		}

		function loop_shop_per_page( $cols ) {
			if ( isset( $_GET['shop_archive_number_item'] ) && $_GET['shop_archive_number_item'] !== '' ) {
				$number = $_GET['shop_archive_number_item'];
			} else {
				$number = Insight::setting( 'shop_archive_number_item' );
			}

			return isset( $_GET['product_per_page'] ) ? wc_clean( $_GET['product_per_page'] ) : $number;
		}

		function change_woocommerce_image_dimensions() {
			global $pagenow;

			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}

			update_option( 'woocommerce_single_image_width', 600 );
			update_option( 'woocommerce_thumbnail_image_width', 400 );
			update_option( 'woocommerce_thumbnail_cropping', 'custom' );
			update_option( 'woocommerce_thumbnail_cropping_custom_width', 3 );
			update_option( 'woocommerce_thumbnail_cropping_custom_height', 4 );
		}

		function change_product_tag_cloud_args( $args ) {
			$args['separator'] = ', ';

			return $args;
		}

		function override_pagination_args( $args ) {
			$args['prev_text'] = '<i class="fa fa-angle-double-left"></i>';
			$args['next_text'] = '<i class="fa fa-angle-double-right"></i>';

			return $args;
		}

		public function remove_product_description_heading() {
			return '';
		}

		public function remove_product_additional_information_heading() {
			return '';
		}

		public function woocommerce_review_gravatar_size() {
			return 100;
		}

		public function init() {
			if ( Insight::setting( 'single_product_up_sells_enable' ) === '0' ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

			if ( Insight::setting( 'single_product_related_enable' ) === '0' ) {
				add_filter( 'woocommerce_related_products_args', array( $this, 'wc_remove_related_products' ), 10 );
			}

			// Remove Cross Sells from default position at Cart. Then add them back UNDER the Cart Table.
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
			if ( Insight::setting( 'shopping_cart_cross_sells_enable' ) === '1' ) {
				add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
			}
		}

		/**
		 * wc_remove_related_products
		 *
		 * Clear the query arguments for related products so none show.
		 */
		function wc_remove_related_products( $args ) {
			return array();
		}

		public function override_checkout_fields( $fields ) {
			$fields['billing']['billing_first_name']['placeholder'] = esc_html__( 'First Name *', 'tm-moody' );
			$fields['billing']['billing_last_name']['placeholder']  = esc_html__( 'Last Name *', 'tm-moody' );
			$fields['billing']['billing_company']['placeholder']    = esc_html__( 'Company Name', 'tm-moody' );
			$fields['billing']['billing_email']['placeholder']      = esc_html__( 'Email Address *', 'tm-moody' );
			$fields['billing']['billing_phone']['placeholder']      = esc_html__( 'Phone *', 'tm-moody' );
			$fields['billing']['billing_address_1']['placeholder']  = esc_html__( 'Address *', 'tm-moody' );
			$fields['billing']['billing_address_2']['placeholder']  = esc_html__( 'Address', 'tm-moody' );
			$fields['billing']['billing_city']['placeholder']       = esc_html__( 'Town / City *', 'tm-moody' );
			$fields['billing']['billing_postcode']['placeholder']   = esc_html__( 'Zip *', 'tm-moody' );

			$fields['shipping']['shipping_first_name']['placeholder'] = esc_html__( 'First Name *', 'tm-moody' );
			$fields['shipping']['shipping_last_name']['placeholder']  = esc_html__( 'Last Name *', 'tm-moody' );
			$fields['shipping']['shipping_company']['placeholder']    = esc_html__( 'Company Name', 'tm-moody' );
			$fields['shipping']['shipping_city']['placeholder']       = esc_html__( 'Town / City *', 'tm-moody' );
			$fields['shipping']['shipping_postcode']['placeholder']   = esc_html__( 'Zip *', 'tm-moody' );

			return $fields;
		}

		public function dequeue_woocommerce_cart_fragments() {
			if ( is_front_page() && class_exists( 'WooCommerce' ) && add_theme_support( 'woo_speed' ) ) {
				wp_dequeue_script( 'wc-cart-fragments' );
			}
		}

		/**
		 * Ensure cart contents update when products are added to the cart via AJAX
		 * ========================================================================
		 *
		 * @param $fragments
		 *
		 * @return mixed
		 */
		function header_add_to_cart_fragment( $fragments ) {
			ob_start();
			$cart_html = self::get_minicart();
			echo '' . $cart_html;
			$fragments['.mini-cart__button'] = ob_get_clean();

			return $fragments;
		}


		/**
		 * Get mini cart HTML
		 * ==================
		 *
		 * @return string
		 */
		static function get_minicart() {
			$cart_html = '';
			$qty       = WC()->cart->get_cart_contents_count();
			$cart_html .= '<div class="mini-cart__button" title="' . esc_attr__( 'View your shopping cart', 'tm-moody' ) . '">';
			$cart_html .= '<span class="mini-cart-icon" data-count="' . $qty . '"></span>';
			$cart_html .= '</div>';

			return $cart_html;
		}

		static function render_mini_cart() {
			$shopping_cart_enable = Insight::setting( 'shopping_cart_icon_enable' );
			if ( class_exists( 'WooCommerce' ) && in_array( $shopping_cart_enable, array( '1', 'hide_on_empty' ) ) ) {
				global $woocommerce;
				$cart_url = '/cart';
				if ( isset( $woocommerce ) ) {
					$cart_url = wc_get_cart_url();
				}
				$classes = 'mini-cart';
				if ( $shopping_cart_enable === 'hide_on_empty' ) {
					$classes .= ' hide-on-empty';
				}
				?>
				<div id="mini-cart" class="<?php echo esc_attr( $classes ); ?>"
				     data-url="<?php echo esc_url( $cart_url ); ?>">
					<?php echo self::get_minicart(); ?>
					<div class="widget_shopping_cart_content"></div>
				</div>
			<?php }
		}
	}

	new Insight_Woo();
}
