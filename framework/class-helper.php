<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper functions
 */
class Insight_Helper {

	public static function get_post_meta( $name, $default = false ) {
		global $insight_page_options;
		if ( $insight_page_options != false && isset( $insight_page_options[ $name ] ) ) {
			return $insight_page_options[ $name ];
		}

		return $default;
	}

	public static function get_the_post_meta( $options, $name, $default = false ) {
		if ( $options != false && isset( $options[ $name ] ) ) {
			return $options[ $name ];
		}

		return $default;
	}

	public static function get_portfolio_post_meta( $name, $default = '' ) {
		$options = unserialize( get_post_meta( get_the_ID(), 'insight_portfolio_options', true ) );
		if ( $options !== false && isset( $options[ $name ] ) ) {
			return $options[ $name ];
		}

		return $default;
	}

	public static function portfolio_the_permalink() {
		$_url = Insight_Helper::get_portfolio_post_meta( 'portfolio_external_url' );

		if ( $_url === '' ) {
			$_url = get_the_permalink();
		}

		echo esc_url( $_url );
	}

	/**
	 * @return array
	 */
	public static function get_list_revslider() {
		global $wpdb;
		$revsliders = array(
			'' => esc_html__( 'Select a slider', 'tm-moody' ),
		);

		if ( function_exists( 'rev_slider_shortcode' ) ) {

			$table_name = $wpdb->prefix . "revslider_sliders";
			$query      = $wpdb->prepare( "SELECT * FROM $table_name WHERE type != %s ORDER BY title ASC", 'template' );
			$results    = $wpdb->get_results( $query );
			if ( ! empty( $results ) ) {
				foreach ( $results as $result ) {
					$revsliders[ $result->alias ] = $result->title;
				}
			}
		}

		return $revsliders;
	}

	/**
	 * @return array|int|WP_Error
	 */
	public static function get_all_menus() {
		$args = array(
			'hide_empty' => true,
		);

		$menus   = get_terms( 'nav_menu', $args );
		$results = array();

		foreach ( $menus as $key => $menu ) {
			$results[ $menu->slug ] = $menu->name;
		}
		$results[''] = esc_html__( 'Default Menu', 'tm-moody' );

		return $results;
	}

	/**
	 * @param bool $default_option
	 *
	 * @return array
	 */
	public static function get_registered_sidebars( $default_option = false, $empty_option = true ) {
		global $wp_registered_sidebars;
		$sidebars = array();
		if ( $empty_option == true ) {
			$sidebars['none'] = esc_html__( 'No Sidebar', 'tm-moody' );
		}
		if ( $default_option == true ) {
			$sidebars['default'] = esc_html__( 'Default', 'tm-moody' );
		}
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}

		return $sidebars;
	}

	/**
	 * Get list sidebar positions
	 *
	 * @return array
	 */
	public static function get_list_sidebar_positions( $default = false ) {
		$positions = array(
			'left'  => esc_html__( 'Left', 'tm-moody' ),
			'right' => esc_html__( 'Right', 'tm-moody' ),
		);


		if ( $default == true ) {
			$positions['default'] = esc_html__( 'Default', 'tm-moody' );
		}

		return $positions;
	}

	/**
	 * Get content of file
	 *
	 * @param string $path
	 *
	 * @return mixed
	 */
	static function get_file_contents( $path = '' ) {
		$content = '';
		if ( $path !== '' ) {
			global $wp_filesystem;

			Insight::require_file( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();

			if ( file_exists( $path ) ) {
				$content = $wp_filesystem->get_contents( $path );
			}
		}

		return $content;
	}

	/**
	 * @param $var
	 *
	 * Output anything in debug bar.
	 */
	public static function d( $var ) {
		if ( function_exists( 'kint_debug_ob' ) ) {
			ob_start( 'kint_debug_ob' );
			d( $var );
			ob_end_flush();
		}
	}

	public static function strposa( $haystack, $needle, $offset = 0 ) {
		if ( ! is_array( $needle ) ) {
			$needle = array( $needle );
		}
		foreach ( $needle as $query ) {
			if ( strpos( $haystack, $query, $offset ) !== false ) {
				return true;
			} // stop on first true result
		}

		return false;
	}

	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @global $_wp_additional_image_sizes
	 * @uses   get_intermediate_image_sizes()
	 * @return array $sizes Data for all currently-registered image sizes.
	 */
	public static function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array( 'full' => 'full' );

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$_size_w                               = get_option( "{$_size}_size_w" );
				$_size_h                               = get_option( "{$_size}_size_h" );
				$sizes["$_size {$_size_w}x{$_size_h}"] = $_size;
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes["$_size {$_wp_additional_image_sizes[ $_size ]['width']}x{$_wp_additional_image_sizes[ $_size ]['height']}"] = $_size;
			}
		}

		return $sizes;
	}

	public static function get_attachment_info( $attachment_id ) {
		$attachment = get_post( $attachment_id );

		return array(
			'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment->guid,
			'title'       => $attachment->post_title,
		);
	}

	public static function w3c_iframe( $iframe ) {
		$iframe = str_replace( 'frameborder="0"', "", $iframe );
		$iframe = str_replace( 'frameborder="no"', "", $iframe );
		$iframe = str_replace( 'scrolling="no"', "", $iframe );

		return $iframe;
	}

	public static function get_md_media_query() {
		return '@media (max-width: 991px)';
	}

	public static function get_sm_media_query() {
		return '@media (max-width: 767px)';
	}

	public static function get_xs_media_query() {
		return '@media (max-width: 554px)';
	}

	public static function aq_resize( $args = array() ) {
		$defaults = array(
			'url'     => '',
			'width'   => null,
			'height'  => null,
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
			'echo'    => false,
		);

		$args  = wp_parse_args( $args, $defaults );
		$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );

		if ( $image === false ) {
			$image = $args['url'];
		}

		return $image;
	}

	public static function aq_resize_responsive( $args = array() ) {
		$defaults = array(
			'url'     => '',
			'width'   => null,
			'height'  => null,
			'md'      => array(),
			'sm'      => array(),
			'xs'      => array(),
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
			'echo'    => false,
		);

		$args  = wp_parse_args( $args, $defaults );
		$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );

		if ( $image === false ) {
			$image = $args['url'];
		}

		?>
		<img src="<?php echo esc_url( $image ); ?>" sizes="">
		<?php
	}

	public static function get_animation_list( $args = array() ) {
		return array(
			'none'             => esc_html__( 'None', 'tm-moody' ),
			'fade-in'          => esc_html__( 'Fade In', 'tm-moody' ),
			'move-up'          => esc_html__( 'Move Up', 'tm-moody' ),
			'move-down'        => esc_html__( 'Move Down', 'tm-moody' ),
			'move-left'        => esc_html__( 'Move Left', 'tm-moody' ),
			'move-right'       => esc_html__( 'Move Right', 'tm-moody' ),
			'scale-up'         => esc_html__( 'Scale Up', 'tm-moody' ),
			'fall-perspective' => esc_html__( 'Fall Perspective', 'tm-moody' ),
			'fly'              => esc_html__( 'Fly', 'tm-moody' ),
			'flip'             => esc_html__( 'Flip', 'tm-moody' ),
			'helix'            => esc_html__( 'Helix', 'tm-moody' ),
			'pop-up'           => esc_html__( 'Pop Up', 'tm-moody' ),
		);
	}

	public static function get_animation_classes( $animation ) {
		$classes = '';
		if ( isset( $animation ) && $animation !== '' && $animation !== 'none' ) {
			if ( Insight::is_handheld() ) {
				$mobile_animation_enable = Insight::setting( 'shortcode_animation_mobile_enable' );
				if ( $mobile_animation_enable === '1' ) {
					$classes .= " tm-animation $animation";
				}
			} else {
				$classes .= " tm-animation $animation";
			}
		}

		return $classes;
	}

	public static function get_grid_animation_classes( $animation ) {
		$classes = '';
		if ( isset( $animation ) && $animation !== '' && $animation !== 'none' ) {
			if ( Insight::is_handheld() ) {
				$mobile_animation_enable = Insight::setting( 'shortcode_animation_mobile_enable' );
				if ( $mobile_animation_enable === '1' ) {
					$classes .= " has-animation $animation";
				}
			} else {
				$classes .= " has-animation $animation";
			}
		}

		return $classes;
	}

	public static function get_coming_soon_demo_date() {
		$date = date( 'm/d/Y', strtotime( '+2 months', strtotime( date( 'Y/m/d' ) ) ) );

		return $date;
	}
}
