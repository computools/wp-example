<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Insight_Maintenance' ) ) {

	class Insight_Maintenance {

		public static $templates = array(
			'maintenance.php',
			'coming-soon.php',
		);

		public function __construct() {
			add_action( 'wp', array( $this, 'maintenance_mode' ) );
		}

		public function maintenance_mode() {
			if ( defined( 'INSIGHT_MAINTENANCE' ) && INSIGHT_MAINTENANCE === true ) {
				global $pagenow;
				global $post;
				$maintenance_page = Insight::setting( 'maintenance_page' );

				if ( $maintenance_page !== '' && $post->ID != $maintenance_page && $pagenow !== 'wp-login.php' && ! current_user_can( 'manage_options' ) && ! is_admin() ) {
					wp_safe_redirect( get_permalink( $maintenance_page ) );
					exit;
				}
			}
		}

		public static function get_maintenance_templates() {
			return self::$templates;
		}

		public static function get_maintenance_templates_dir() {
			$results = array();

			foreach ( self::$templates as $value ) {
				$results[] = 'templates/' . $value;
			}

			return $results;
		}

		public static function get_maintenance_pages() {
			$maintenance_templates = self::get_maintenance_templates();

			$args = array(
				'post_type'  => 'page',
				'meta_query' => array(
					'relation' => 'OR',
				),
			);

			foreach ( $maintenance_templates as $value ) {
				$args['meta_query'][] = array(
					'key'     => '_wp_page_template',
					'value'   => $value,
					'compare' => 'LIKE',
				);
			}

			$query   = new WP_Query( $args );
			$results = array(
				'' => esc_html__( 'Select a page', 'tm-moody' ),
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();

					$id             = get_the_ID();
					$results[ $id ] = get_the_title();
				}
			}

			wp_reset_postdata();

			return $results;
		}

		public static function get_clock_template( $args = array() ) {
			$defaults = array(
				'width'  => 80,
				'height' => 80,
				'color'  => '#ffffff',
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<div id="clock" class="clock-wrap">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
				     y="0px"
				     width="<?php echo esc_attr( $args['width'] ); ?>px"
				     height="<?php echo esc_attr( $args['height'] ); ?>" viewBox="0 0 506 506"
				     enable-background="new 0 0 506 506"
				     xml:space="preserve">
											<g>
												<circle fill="none" stroke="<?php echo esc_attr( $args['color'] ); ?>"
												        stroke-width="9"
												        stroke-miterlimit="10" cx="253" cy="253" r="247.5"></circle>
												<circle fill="<?php echo esc_attr( $args['color'] ); ?>" cx="253"
												        cy="253" r="17.36"></circle>
												<line id="min" fill="none"
												      stroke="<?php echo esc_attr( $args['color'] ); ?>"
												      stroke-width="9"
												      stroke-miterlimit="10" x1="253" y1="67.375" x2="253" y2="253"
												      transform="rotate(36 253 253)"></line>
												<line id="hour" fill="none"
												      stroke="<?php echo esc_attr( $args['color'] ); ?>"
												      stroke-width="7"
												      stroke-miterlimit="10" x1="253" y1="129.247" x2="253" y2="253"
												      transform="rotate(303 253 253)"></line>
												<line id="sec" fill="none"
												      stroke="<?php echo esc_attr( $args['color'] ); ?>"
												      stroke-width="5"
												      stroke-miterlimit="10" x1="253" y1="48.815" x2="253" y2="253"
												      transform="rotate(252 253 253)"></line>
											</g>
										</svg>
			</div>
			<?php
		}
	}

	new Insight_Maintenance();
}
