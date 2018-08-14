<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Insight_Metabox' ) ) {
	class Insight_Metabox {

		/**
		 * Insight_Metabox constructor.
		 */
		public function __construct() {
			add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
			add_filter( 'insight_page_meta_box_presets', array( $this, 'page_meta_box_presets' ) );
		}

		public function page_meta_box_presets( $presets ) {
			$presets[] = 'header_preset';

			return $presets;
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {

			$page_registered_sidebars = Insight_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Layout', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_attr__( 'Layout', 'tm-moody' ),
							'desc'    => esc_attr__( 'Controls the layout of this page.', 'tm-moody' ),
							'options' => array(
								''      => esc_html__( 'Default', 'tm-moody' ),
								'boxed' => esc_html__( 'Boxed', 'tm-moody' ),
								'wide'  => esc_html__( 'Wide', 'tm-moody' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_attr__( 'Site Width', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the site width for this page. Enter value including any valid CSS unit, ex: 1200px. Leave blank to use global setting.', 'tm-moody' ),
						),
						array(
							'id'      => 'content_padding',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Page Content Padding', 'tm-moody' ),
							'default' => '1',
							'options' => array(
								'0' => esc_html__( 'No Padding', 'tm-moody' ),
								'1' => esc_html__( 'Default', 'tm-moody' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_attr__( 'Info', 'tm-moody' ),
							'message' => esc_attr__( 'These options controls the background on boxed mode.', 'tm-moody' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_attr__( 'Background Color', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the background color of the outer background area in boxed mode of this page.', 'tm-moody' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_attr__( 'Background Image', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the background image of the outer background area in boxed mode of this page.', 'tm-moody' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_attr__( 'Background Repeat', 'tm-moody' ),
							'desc'    => esc_attr__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'tm-moody' ),
							'options' => array(
								'no-repeat' => esc_html__( 'No repeat', 'tm-moody' ),
								'repeat'    => esc_html__( 'Repeat', 'tm-moody' ),
								'repeat-x'  => esc_html__( 'Repeat X', 'tm-moody' ),
								'repeat-y'  => esc_html__( 'Repeat Y', 'tm-moody' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_attr__( 'Background Attachment', 'tm-moody' ),
							'desc'    => esc_attr__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'tm-moody' ),
							'options' => array(
								''       => esc_html__( 'Default', 'tm-moody' ),
								'fixed'  => esc_html__( 'Fixed', 'tm-moody' ),
								'scroll' => esc_html__( 'Scroll', 'tm-moody' ),
							),
						),
						array(
							'id'    => 'site_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the background position of the outer background area in boxed mode of this page.', 'tm-moody' ),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_attr__( 'Info', 'tm-moody' ),
							'message' => esc_attr__( 'These options controls the background of main content on this page.', 'tm-moody' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_attr__( 'Background Color', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the background color of main content on this page.', 'tm-moody' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_attr__( 'Background Image', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the background image of main content on this page.', 'tm-moody' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_attr__( 'Background Repeat', 'tm-moody' ),
							'desc'    => esc_attr__( 'Controls the background repeat of main content on this page.', 'tm-moody' ),
							'options' => array(
								'no-repeat' => esc_html__( 'No repeat', 'tm-moody' ),
								'repeat'    => esc_html__( 'Repeat', 'tm-moody' ),
								'repeat-x'  => esc_html__( 'Repeat X', 'tm-moody' ),
								'repeat-y'  => esc_html__( 'Repeat Y', 'tm-moody' ),
							),
						),
						array(
							'id'    => 'content_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'tm-moody' ),
							'desc'  => esc_attr__( 'Controls the background position of main content on this page.', 'tm-moody' ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Top Bar', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'top_bar_enable',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Enable', 'tm-moody' ),
							'default' => '2',
							'options' => array(
								'0' => esc_html__( 'Disable', 'tm-moody' ),
								'1' => esc_html__( 'Enable', 'tm-moody' ),
								'2' => esc_html__( 'Default', 'tm-moody' ),
							),
						),
						array(
							'id'      => 'top_bar_style',
							'type'    => 'select',
							'title'   => esc_attr__( 'Top Bar Style', 'tm-moody' ),
							'desc'    => esc_attr__( 'Select top bar style that displays on this page.', 'tm-moody' ),
							'default' => '-1',
							'options' => array(
								'default' => esc_html__( 'Default', 'tm-moody' ),
								'01'      => esc_html__( 'Style 01', 'tm-moody' ),
								'02'      => esc_html__( 'Style 02', 'tm-moody' ),
							),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Header', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'header_preset',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Preset', 'tm-moody' ),
							'desc'    => esc_attr__( 'Select header preset that displays on this page.', 'tm-moody' ),
							'default' => '-1',
							'options' => array(
								'-1'                                      => esc_html__( 'Default', 'tm-moody' ),
								'classic_l'                               => esc_html__( 'Header Classic - Light', 'tm-moody' ),
								'classic_d'                               => esc_html__( 'Header Classic - Dark', 'tm-moody' ),
								'classic_lt'                              => esc_html__( 'Header Classic - Light/Transparent', 'tm-moody' ),
								'classic_lt_border'                       => esc_html__( 'Header Classic - Light/Transparent/Border', 'tm-moody' ),
								'classic_social_networks_lt'              => esc_html__( 'Header Classic - Social Networks - Light/Transparent', 'tm-moody' ),
								'classic_left_nav_social_networks_l'      => esc_html__( 'Header Classic - Left Navigation - Social Networks - Light', 'tm-moody' ),
								'classic_dt'                              => esc_html__( 'Header Classic - Dark/Transparent', 'tm-moody' ),
								'minimal_social_networks_fluid_lt'        => esc_html__( 'Header Minimal Fluid - Social Networks - Light/Transparent', 'tm-moody' ),
								'minimal_l'                               => esc_html__( 'Header Minimal - Light', 'tm-moody' ),
								'minimal_d'                               => esc_html__( 'Header Minimal - Dark', 'tm-moody' ),
								'minimal_lt'                              => esc_html__( 'Header Minimal - Light/Transparent', 'tm-moody' ),
								'minimal_dt'                              => esc_html__( 'Header Minimal - Dark/Transparent', 'tm-moody' ),
								'minimal_fluid_l'                         => esc_html__( 'Header Minimal Fluid - Light', 'tm-moody' ),
								'minimal_fluid_d'                         => esc_html__( 'Header Minimal Fluid - Dark', 'tm-moody' ),
								'minimal_fluid_lt'                        => esc_html__( 'Header Minimal Fluid - Light/Transparent', 'tm-moody' ),
								'minimal_fluid_dt'                        => esc_html__( 'Header Minimal Fluid - Dark/Transparent', 'tm-moody' ),
								'left'                                    => esc_html__( 'Left Header', 'tm-moody' ),
								'left_no_shadow'                          => esc_html__( 'Left Header - No Shadow', 'tm-moody' ),
								'left_lt'                                 => esc_html__( 'Left Header - Light - Transparent - No Shadow', 'tm-moody' ),
								'classic_fluid_right_nav'                 => esc_html__( 'Header Classic Fluid - Right Navigation', 'tm-moody' ),
								'classic_fluid_with_button'               => esc_html__( 'Header Classic Fluid - Transparent - With Button', 'tm-moody' ),
								'classic_left_nav_with_language_switcher' => esc_html__( 'Header Classic - Left Navigation - With Language Switcher', 'tm-moody' ),
							),
						),
						array(
							'id'      => 'header_position',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Position', 'tm-moody' ),
							'default' => 'above',
							'options' => array(
								'above'  => esc_attr__( 'Above Slider', 'tm-moody' ),
								'below'  => esc_attr__( 'Below Slider', 'tm-moody' ),
								'behind' => esc_attr__( 'Overlay Header', 'tm-moody' ),
							),
						),
						array(
							'id'      => 'menu_display',
							'type'    => 'select',
							'title'   => esc_attr__( 'Primary menu', 'tm-moody' ),
							'desc'    => esc_attr__( 'Select which menu displays on this page.', 'tm-moody' ),
							'default' => '',
							'options' => Insight_Helper::get_all_menus(),
						),
						array(
							'id'      => 'menu_one_page',
							'type'    => 'switch',
							'title'   => esc_attr__( 'One Page Menu', 'tm-moody' ),
							'default' => '0',
							'options' => array(
								'0' => esc_html__( 'Disable', 'tm-moody' ),
								'1' => esc_html__( 'Enable', 'tm-moody' ),
							),
						),
						array(
							'id'      => 'custom_logo',
							'type'    => 'media',
							'title'   => esc_attr__( 'Custom logo', 'tm-moody' ),
							'desc'    => esc_attr__( 'Select which menu displays on this page.', 'tm-moody' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Page Title Bar', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'page_title_bar_layout',
							'type'    => 'switch',
							'title'   => esc_attr__( 'Layout', 'tm-moody' ),
							'default' => 'default',
							'options' => array(
								'default' => esc_html__( 'Default', 'tm-moody' ),
								'none'    => esc_html__( 'Hide', 'tm-moody' ),
								'01'      => esc_html__( 'Style 01', 'tm-moody' ),
								'02'      => esc_html__( 'Style 02', 'tm-moody' ),
								'03'      => esc_html__( 'Style 03', 'tm-moody' ),
								'04'      => esc_html__( 'Style 04', 'tm-moody' ),
							),
						),
						array(
							'id'      => 'page_title_bar_background_color',
							'type'    => 'color',
							'title'   => esc_attr__( 'Background Color', 'tm-moody' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background',
							'type'    => 'media',
							'title'   => esc_attr__( 'Background Image', 'tm-moody' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background_overlay',
							'type'    => 'color',
							'title'   => esc_attr__( 'Background Overlay', 'tm-moody' ),
							'default' => '',
						),
						array(
							'id'    => 'page_title_bar_custom_heading',
							'type'  => 'text',
							'title' => esc_attr__( 'Custom Heading Text', 'tm-moody' ),
							'desc'  => esc_attr__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'tm-moody' ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Sidebars', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'page_sidebar_1',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 1', 'tm-moody' ),
							'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'tm-moody' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_2',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 2', 'tm-moody' ),
							'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'tm-moody' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Sidebar Position', 'tm-moody' ),
							'default' => 'default',
							'options' => Insight_Helper::get_list_sidebar_positions( true ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Sliders', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'revolution_slider',
							'type'    => 'select',
							'title'   => esc_attr__( 'Revolution Slider', 'tm-moody' ),
							'desc'    => esc_attr__( 'Select the unique name of the slider.', 'tm-moody' ),
							'options' => Insight_Helper::get_list_revslider(),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Footer', 'tm-moody' ),
					'fields' => array(
						array(
							'id'      => 'footer_page',
							'type'    => 'select',
							'title'   => esc_attr__( 'Footer Page', 'tm-moody' ),
							'default' => 'default',
							'options' => Insight_Footer::get_list_footers( true ),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_page_options',
				'title'      => esc_html__( 'Page Options', 'tm-moody' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_post_options',
				'title'      => esc_html__( 'Page Options', 'tm-moody' ),
				'post_types' => array( 'post' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_attr__( 'Post', 'tm-moody' ),
								'fields' => array(
									array(
										'id'      => 'post_layout_style',
										'type'    => 'select',
										'title'   => esc_attr__( 'Single Blog Style', 'tm-moody' ),
										'desc'    => esc_attr__( 'Select style of this post page.', 'tm-moody' ),
										'default' => '',
										'options' => array(
											''  => esc_html__( 'Default', 'tm-moody' ),
											'1' => esc_html__( 'Blog With Post Format', 'tm-moody' ),
											'2' => esc_html__( 'Blog With Image Header', 'tm-moody' ),
										),
									),
									array(
										'id'    => 'post_gallery',
										'type'  => 'gallery',
										'title' => esc_attr__( 'Gallery Format', 'tm-moody' ),
									),
									array(
										'id'    => 'post_video',
										'type'  => 'textarea',
										'title' => esc_html__( 'Video Format', 'tm-moody' ),
									),
									array(
										'id'    => 'post_audio',
										'type'  => 'textarea',
										'title' => esc_html__( 'Audio Format', 'tm-moody' ),
									),
									array(
										'id'    => 'post_quote_text',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Text', 'tm-moody' ),
									),
									array(
										'id'    => 'post_quote_name',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Name', 'tm-moody' ),
									),
									array(
										'id'    => 'post_quote_url',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Url', 'tm-moody' ),
									),
									array(
										'id'    => 'post_link',
										'type'  => 'text',
										'title' => esc_html__( 'Link Format', 'tm-moody' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_product_options',
				'title'      => esc_html__( 'Page Options', 'tm-moody' ),
				'post_types' => array( 'product' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_portfolio_options',
				'title'      => esc_html__( 'Page Options', 'tm-moody' ),
				'post_types' => array( 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_attr__( 'Portfolio', 'tm-moody' ),
								'fields' => array(
									array(
										'id'      => 'portfolio_layout_style',
										'type'    => 'select',
										'title'   => esc_attr__( 'Single Portfolio Style', 'tm-moody' ),
										'desc'    => esc_attr__( 'Select style of this single portfolio post page.', 'tm-moody' ),
										'default' => '',
										'options' => array(
											''              => esc_html__( 'Default', 'tm-moody' ),
											'left_details'  => esc_html__( 'Left Details', 'tm-moody' ),
											'right_details' => esc_html__( 'Right Details', 'tm-moody' ),
											'gallery'       => esc_html__( 'Image Gallery', 'tm-moody' ),
											'slider'        => esc_html__( 'Image Slider', 'tm-moody' ),
											'video'         => esc_html__( 'Video', 'tm-moody' ),
											'image_header'  => esc_html__( 'Image Header', 'tm-moody' ),
										),
									),
									array(
										'id'    => 'portfolio_gallery',
										'type'  => 'gallery',
										'title' => esc_attr__( 'Gallery', 'tm-moody' ),
									),
									array(
										'id'    => 'portfolio_video_url',
										'type'  => 'textarea',
										'title' => esc_html__( 'Video Url', 'tm-moody' ),
									),
									array(
										'id'    => 'portfolio_client',
										'type'  => 'text',
										'title' => esc_html__( 'Client', 'tm-moody' ),
									),
									array(
										'id'    => 'portfolio_date',
										'type'  => 'text',
										'title' => esc_html__( 'Date', 'tm-moody' ),
									),
									array(
										'id'    => 'portfolio_awards',
										'type'  => 'text',
										'title' => esc_html__( 'Awards', 'tm-moody' ),
									),
									array(
										'id'    => 'portfolio_url',
										'type'  => 'text',
										'title' => esc_html__( 'Url', 'tm-moody' ),
									),
									array(
										'id'    => 'portfolio_external_url',
										'type'  => 'text',
										'title' => esc_html__( 'External Link', 'tm-moody' ),
										'desc'  => esc_html__( ' Enter URL to link instead of link to single portfolio page from Portfolio List page', 'tm-moody' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_testimonial_options',
				'title'      => esc_html__( 'Testimonial Options', 'tm-moody' ),
				'post_types' => array( 'testimonial' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Testimonial Details', 'tm-moody' ),
								'fields' => array(
									array(
										'id'      => 'by_line',
										'type'    => 'text',
										'title'   => esc_html__( 'By Line', 'tm-moody' ),
										'desc'    => esc_html__( 'Enter a byline for the customer giving this testimonial (for example: "CEO of Thememove").', 'tm-moody' ),
										'default' => '',
									),
									array(
										'id'      => 'url',
										'type'    => 'text',
										'title'   => esc_html__( 'Url', 'tm-moody' ),
										'desc'    => esc_html__( 'Enter a URL that applies to this customer (for example: http://www.thememove.com/).', 'tm-moody' ),
										'default' => '',
									),
								),
							),
						),
					),
				),
			);

			$meta_boxes[] = array(
				'id'         => 'insight_footer_options',
				'title'      => esc_html__( 'Footer Options', 'tm-moody' ),
				'post_types' => array( 'ic_footer' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array(
							array(
								'title'  => esc_html__( 'Effect', 'tm-moody' ),
								'fields' => array(
									array(
										'id'      => 'effect',
										'type'    => 'switch',
										'title'   => esc_attr__( 'Footer Effect', 'tm-moody' ),
										'default' => '',
										'options' => array(
											''         => esc_html__( 'Normal', 'tm-moody' ),
											'parallax' => esc_html__( 'Parallax', 'tm-moody' ),
										),
									),
								),
							),
							array(
								'title'  => esc_html__( 'Styling', 'tm-moody' ),
								'fields' => array(
									array(
										'id'      => 'widget_title_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Widget Title Color', 'tm-moody' ),
										'desc'    => esc_attr__( 'Controls the color of widget title.', 'tm-moody' ),
										'default' => '#fff',
									),
									array(
										'id'      => 'text_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Text Color', 'tm-moody' ),
										'desc'    => esc_attr__( 'Controls the color of footer text.', 'tm-moody' ),
										'default' => '#999',
									),
									array(
										'id'      => 'link_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Link Color', 'tm-moody' ),
										'desc'    => esc_attr__( 'Controls the color of footer links.', 'tm-moody' ),
										'default' => '#999',
									),
									array(
										'id'      => 'link_hover_color',
										'type'    => 'color',
										'title'   => esc_attr__( 'Link Hover Color', 'tm-moody' ),
										'desc'    => esc_attr__( 'Controls the color when hover of footer links.', 'tm-moody' ),
										'default' => Insight::PRIMARY_COLOR,
									),
								),
							),
						),
					),
				),
			);

			return $meta_boxes;
		}

	}

	new Insight_Metabox();
}
