<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add extra fields to nav menu edit
 */
class Insight_Extra_Nav_Menu_Items {

	function __construct() {
		add_action( 'wp_edit_nav_menu_walker', array( $this, 'edit_nav_menu_walker' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_nav_menu_item' ), 10, 3 );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'setup_nav_menu_item' ) );
	}

	/**
	 * Change the admin menu walker class name.
	 *
	 * @param string $walker
	 *
	 * @return string
	 */
	public function edit_nav_menu_walker( $walker ) {
		require_once get_template_directory() . '/framework/class-walker-nav-menu-edit.php';

		// Swap the menu walker class only if it's the default wp class (just in case).
		if ( $walker === 'Walker_Nav_Menu_Edit' ) {
			$walker = 'Insight_Walker_Nav_Menu_Edit';
		}

		return $walker;
	}

	public function update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {
		if ( isset( $_REQUEST['menu-item-feature'] ) && is_array( $_REQUEST['menu-item-feature'] ) ) {
			if ( isset( $_REQUEST['menu-item-feature'][ $menu_item_db_id ] ) ) {
				$custom_value = $_REQUEST['menu-item-feature'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_feature', $custom_value );
			}
		} else {
			update_post_meta( $menu_item_db_id, '_menu_item_feature', '0' );
		}

		if ( is_array( $_REQUEST['menu-item-image_hover'] ) ) {
			$custom_value = $_REQUEST['menu-item-image_hover'][ $menu_item_db_id ];
			update_post_meta( $menu_item_db_id, '_menu_item_image_hover', $custom_value );
		}
	}

	public function setup_nav_menu_item( $menu_item ) {
		$menu_item->feature     = get_post_meta( $menu_item->ID, '_menu_item_feature', true );
		$menu_item->image_hover = get_post_meta( $menu_item->ID, '_menu_item_image_hover', true );

		if ( $menu_item->image_hover !== '' ) {
			$full_image_size            = wp_get_attachment_url( $menu_item->image_hover );
			$menu_item->image_hover_url = Insight_Helper::aq_resize( array(
				'url'    => $full_image_size,
				'width'  => 150,
				'height' => 999,
				'crop'   => false,
			) );
		}

		return $menu_item;
	}
}

new Insight_Extra_Nav_Menu_Items;
