<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Insight_Footer' ) ) {

	class Insight_Footer {

		public static function get_list_footers( $default = false ) {
			$args = array(
				'post_type'      => 'ic_footer',
				'posts_per_page' => -1,
				'meta_query'     => array(
					'relation' => 'OR',
				),
			);

			$query   = new WP_Query( $args );
			$results = array(
				'' => esc_html__( 'Select a footer', 'tm-moody' ),
			);

			if ( $default === true ) {
				$results['default'] = esc_html__( 'Default', 'tm-moody' );
			}

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					global $post;
					$slug             = $post->post_name;
					$results[ $slug ] = get_the_title();
				}
			}

			wp_reset_postdata();

			return $results;
		}
	}

	new Insight_Footer();
}
