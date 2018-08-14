<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Insight_Widgets' ) ) {
	class Insight_Widgets {

		public function __construct() {
			$this->require_widgets();
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );
			add_action( 'widgets_init', array(
				$this,
				'register_widgets',
			) );
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {

			$defaults = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			);

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'blog_sidebar',
				'name'        => esc_html__( 'Blog Sidebar', 'tm-moody' ),
				'description' => esc_html__( 'Default Sidebar of blog.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'page_sidebar',
				'name'        => esc_html__( 'Page Sidebar', 'tm-moody' ),
				'description' => esc_html__( 'Add widgets here.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'shop_sidebar',
				'name'        => esc_html__( 'Shop Sidebar', 'tm-moody' ),
				'description' => esc_html__( 'Default Sidebar of shop.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'top_bar_widget_01',
				'name'        => esc_html__( 'Top Bar Widget 01', 'tm-moody' ),
				'description' => esc_html__( 'Add widgets to top bar section.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'top_bar_widget_02',
				'name'        => esc_html__( 'Top Bar Widget 02', 'tm-moody' ),
				'description' => esc_html__( 'Add widgets to top bar section.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'left_header_widget',
				'name'        => esc_html__( 'Left Header Widget', 'tm-moody' ),
				'description' => esc_html__( 'Add widgets to left header.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer_widget_01',
				'name'        => esc_html__( 'Footer Widget 01', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized footer area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer_widget_02',
				'name'        => esc_html__( 'Footer Widget 02', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized footer area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer_widget_03',
				'name'        => esc_html__( 'Footer Widget 03', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized footer area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer_widget_04',
				'name'        => esc_html__( 'Footer Widget 04', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized footer area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer_widget_05',
				'name'        => esc_html__( 'Footer Widget 05', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized footer area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'footer_widget_06',
				'name'        => esc_html__( 'Footer Widget 06', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized footer area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'copyright_widget_01',
				'name'        => esc_html__( 'Copyright Widget 01', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized copyright area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'copyright_widget_02',
				'name'        => esc_html__( 'Copyright Widget 02', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized copyright area.', 'tm-moody' ),
			) ) );

			register_sidebar( array_merge( $defaults, array(
				'id'          => 'copyright_widget_03',
				'name'        => esc_html__( 'Copyright Widget 03', 'tm-moody' ),
				'description' => esc_html__( 'Widgetized copyright area.', 'tm-moody' ),
			) ) );
		}

		public function require_widgets() {
			require_once INSIGHT_WIDGETS_DIR . '/facebook-page.php';
			require_once INSIGHT_WIDGETS_DIR . '/flickr.php';
			require_once INSIGHT_WIDGETS_DIR . '/posts.php';
		}

		public function register_widgets() {
			register_widget( 'TM_Posts_Widget' );
			register_widget( 'TM_Facebook_Page_Widget' );
			register_widget( 'TM_Flickr_Widget' );
		}

	}

	new Insight_Widgets();
}
