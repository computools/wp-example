<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Insight Static Classes
 */
class Insight {

	const PRIMARY_FONT    = 'Work Sans';
	const SECONDARY_FONT  = 'Libre Baskerville';
	const PRIMARY_COLOR   = '#45deb0';
	const SECONDARY_COLOR = '#1a237e';

	/**
	 * is_tablet
	 *
	 * @return bool
	 */
	public static function is_tablet() {
		return Insight_Detect::instance()->isTablet();
	}

	/**
	 * is_mobile
	 *
	 * @return bool
	 */
	public static function is_mobile() {
		if ( self::is_tablet() ) {
			return false;
		}

		return Insight_Detect::instance()->isMobile();
	}

	/**
	 * is_handheld
	 *
	 * @return bool
	 */
	public static function is_handheld() {
		return ( self::is_mobile() || self::is_tablet() );
	}

	/**
	 * is_desktop
	 *
	 * @since 0.9.8
	 * @return bool
	 */
	public static function is_desktop() {
		return ! self::is_handheld();
	}

	/**
	 * Insight settings for Kirki
	 *
	 * @param string $setting
	 *
	 * @return mixed
	 */
	public static function setting( $setting = '' ) {
		$settings = Insight_Kirki::get_option( 'theme', $setting );

		return $settings;
	}

	/**
	 * Requirement one file.
	 *
	 * @param string $file Enter your file path here (included .php)
	 */
	public static function require_file( $file = '' ) {
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			wp_die( esc_html__( 'Could not load theme file: ', 'tm-moody' ) . $file );
		}
	}

	/**
	 * Primary Menu
	 */
	public static function menu_primary( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => 'ul',
			'menu_class'     => 'menu__container sm sm-simple',
		);
		$args     = wp_parse_args( $args, $defaults );

		if ( has_nav_menu( 'primary' ) && class_exists( 'Insight_Walker_Nav_Menu' ) ) {
			$args['walker'] = new Insight_Walker_Nav_Menu;
		}

		$menu = Insight_Helper::get_post_meta( 'menu_display', '' );

		if ( $menu !== '' ) {
			$args['menu'] = $menu;
		}

		wp_nav_menu( $args );
	}

	/**
	 * Off Canvas Menu
	 */
	public static function off_canvas_menu_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'off-canvas-menu-primary',
		) );
	}

	/**
	 * Mobile Menu
	 */
	public static function menu_mobile_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'mobile-menu-primary',
		) );
	}

	/**
	 * Logo
	 */
	public static function branding_logo() {
		$logo_url       = '';
		$logo_light_url = Insight::setting( 'logo_light' );
		$logo_dark_url  = Insight::setting( 'logo_dark' );
		if ( Insight_Helper::get_post_meta( 'custom_logo' ) ) {
			$logo_url = Insight_Helper::get_post_meta( 'custom_logo' );
		} else {
			$logo     = Insight::setting( 'logo' );
			$logo_url = Insight::setting( $logo );
		}

		if ( $logo_url !== '' ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( $logo_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="main-logo">
				<img src="<?php echo esc_url( $logo_light_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="light-logo">
				<img src="<?php echo esc_url( $logo_dark_url ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>" class="dark-logo">
				<img src="<?php echo esc_url( Insight::setting( 'sticky_logo' ) ); ?>"
				     alt="<?php bloginfo( 'name' ); ?>"
				     class="sticky-logo">
			</a>
		<?php } else { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php } ?>
		<?php
	}

	/**
	 * Adds custom attributes to the body tag.
	 */
	public static function body_attributes() {
		$attrs = apply_filters( 'insight_body_attributes', array() );

		$attrs_string = '';
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
			}
		}

		echo '' . $attrs_string;
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function header_class( $class = '' ) {
		$classes = array( 'page-header' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_header_class', $classes, $class );

		$classes = array_unique( $classes );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the branding.
	 */
	public static function branding_class( $class = '' ) {
		$classes = array( 'branding' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_branding_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the navigation.
	 */
	public static function navigation_class( $class = '' ) {
		$classes = array( 'navigation page-navigation' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_navigation_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the footer.
	 */
	public static function footer_class( $class = '' ) {
		$classes = array( 'page-footer' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_footer_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}
}
