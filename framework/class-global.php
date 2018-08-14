<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize Global Variables
 */
if ( ! class_exists( 'Insight_Global' ) ) {
	class Insight_Global {

		public $has_sidebar      = false;
		public $has_both_sidebar = false;

		function __construct() {
			add_action( 'wp', array( $this, 'init_global_variable' ) );
		}

		function init_global_variable() {
			global $insight_page_options;
			if ( is_singular( 'portfolio' ) ) {
				$insight_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );
			} elseif ( is_singular( 'post' ) ) {
				$insight_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
			} elseif ( is_singular( 'page' ) ) {
				$insight_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_page_options', true ) );
			} elseif ( is_singular( 'product' ) ) {
				$insight_page_options = unserialize( get_post_meta( get_the_ID(), 'insight_product_options', true ) );
			}
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				// Get page id of shop.
				$page_id              = wc_get_page_id( 'shop' );
				$insight_page_options = unserialize( get_post_meta( $page_id, 'insight_page_options', true ) );
			}

			$this->check_sidebar();
		}

		function check_sidebar() {
			$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
			$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );

			if ( is_singular( 'post' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['post_page_sidebar_1'] ) ? $_GET['post_page_sidebar_1'] : Insight::setting( 'post_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['post_page_sidebar_2'] ) ? $_GET['post_page_sidebar_2'] : Insight::setting( 'post_page_sidebar_2' );
				}
			} elseif ( is_singular( 'page' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['page_sidebar_1'] ) ? $_GET['page_sidebar_1'] : Insight::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['page_sidebar_2'] ) ? $_GET['page_sidebar_2'] : Insight::setting( 'page_sidebar_2' );
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['portfolio_page_sidebar_1'] ) ? $_GET['portfolio_page_sidebar_1'] : Insight::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['portfolio_page_sidebar_2'] ) ? $_GET['portfolio_page_sidebar_2'] : Insight::setting( 'portfolio_page_sidebar_2' );
				}
			} elseif ( is_singular( 'product' ) ) {
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = isset( $_GET['product_page_sidebar_1'] ) ? $_GET['product_page_sidebar_1'] : Insight::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = isset( $_GET['product_page_sidebar_2'] ) ? $_GET['product_page_sidebar_2'] : Insight::setting( 'product_page_sidebar_2' );
				}
			}

			if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
				$this->has_sidebar = true;
			}

			if ( $page_sidebar1 !== 'none' && $page_sidebar2 !== 'none' ) {
				$this->has_both_sidebar = true;
			}
		}
	}

	global $insight_vars;
	$insight_vars = new Insight_Global();
}
