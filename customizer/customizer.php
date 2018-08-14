<?php
/**
 * Theme Customizer
 *
 * @package TM Moody
 * @since   1.0
 */

/**
 * Setup configuration
 */
Insight_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 */
$priority = 1;

Insight_Kirki::add_section( 'layout', array(
	'title'    => esc_html__( 'Layout', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'color_', array(
	'title'    => esc_html__( 'Colors', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'background', array(
	'title'    => esc_html__( 'Background', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'top_bar', array(
	'title'    => esc_html__( 'Top bar', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'header', array(
	'title'    => esc_html__( 'Header', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'logo', array(
	'title'    => esc_html__( 'Logo', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'navigation', array(
	'title'    => esc_html__( 'Navigation', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'sliders', array(
	'title'    => esc_html__( 'Sliders', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'title_bar', array(
	'title'    => esc_html__( 'Page Title Bar', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'footer', array(
	'title'    => esc_html__( 'Footer', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'portfolio', array(
	'title'    => esc_html__( 'Portfolio', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'social_sharing', array(
	'title'    => esc_html__( 'Social Sharing', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'search', array(
	'title'    => esc_html__( 'Search', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( 'Error 404 Page', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance Mode', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'shortcode', array(
	'title'    => esc_html__( 'Shortcodes', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_panel( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'tm-moody' ),
	'priority' => $priority++,
) );

Insight_Kirki::add_section( 'custom_code', array(
	'title'    => esc_html__( 'Custom Code', 'tm-moody' ),
	'priority' => $priority++,
) );

/**
 * Load panel & section files
 */
require_once INSIGHT_CUSTOMIZER_DIR . '/header/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/sticky.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/lg.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/md.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/sm.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/xs.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/top_bar/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/top_bar/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/top_bar/style-01.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/top_bar/style-02.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/desktop-menu.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/off-canvas-menu.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/mobile-menu.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/section-sliders.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/style-01.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/style-02.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/style-03.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/style-04.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/footer/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/footer/general.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/advanced/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/advanced/advanced.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/advanced/light-gallery.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/shortcode/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shortcode/animation.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/section-background.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-color.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-custom.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-error404.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-layout.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-logo.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/blog/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/blog/archive.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/blog/single.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/archive.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-slider.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-center-slider.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-split-slider.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-split-slider-2.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/single.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/shop/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/archive.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/single.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/cart.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/search/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/search/search-page.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/search/search-popup.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/section-sharing.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-sidebars.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-socials.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-typography.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-maintenance.php';
