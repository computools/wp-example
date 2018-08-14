<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions, filters, actions for visual composer page builder.
 */
if ( ! class_exists( 'Insight_VC' ) ) {
	class Insight_VC {

		public function __construct() {
			if ( ! class_exists( 'Vc_Manager' ) ) {
				return;
			}
			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( get_template_directory() . '/vc-extend/vc-templates' );
			}

			add_action( 'vc_before_init', array( $this, 'vc_set_as_theme' ) );
			add_action( 'vc_after_init', array( $this, 'load_vc_maps' ), 9999 );
			add_action( 'vc_after_init', array( $this, 'vc_after_init' ) );

			// Hook for admin editor.
			add_action( 'vc_build_admin_page', array( $this, 'remove_default_elements' ), 11 );
			// Hook for frontend editor.
			add_action( 'vc_load_shortcode', array( $this, 'remove_default_elements' ), 11 );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			add_filter( 'vc_google_fonts_get_fonts_filter', array( $this, 'update_google_fonts' ) );

			// Narrow data taxonomies.
			add_filter( 'vc_autocomplete_tm_blog_taxonomies_callback', array(
				$this,
				'autocomplete_blog_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_blog_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_blog_filter_category_callback', array(
				$this,
				'autocomplete_blog_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_blog_filter_category_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_portfolio_filter_category_callback', array(
				$this,
				'autocomplete_portfolio_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_portfolio_filter_category_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_callback', array(
				$this,
				'autocomplete_portfolio_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_callback', array(
				$this,
				'autocomplete_testimonial_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_taxonomies_callback', array(
				$this,
				'autocomplete_product_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_category_taxonomies_callback', array(
				$this,
				'autocomplete_product_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_category_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_items_pages_callback', array(
				$this,
				'autocomplete_pages_field_callback',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_items_pages_render', array(
				$this,
				'autocomplete_pages_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_icon_items_pages_callback', array(
				$this,
				'autocomplete_pages_field_callback',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_icon_items_pages_render', array(
				$this,
				'autocomplete_pages_field_render',
			), 10, 1 );
		}

		function vc_set_as_theme() {
			vc_set_as_theme();
		}

		function autocomplete_pages_field_render( $term ) {
			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'name'        => $term['value'],
			);

			$query = new WP_Query( $args );
			$data  = false;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		function autocomplete_pages_field_callback( $search_string ) {
			$data = array();
			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				's'           => $search_string,
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data[] = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		function vc_after_init() {
			$this->load_vc_params();
		}

		public function remove_default_elements() {
			vc_remove_element( 'vc_icon' );
			vc_remove_element( 'vc_empty_space' );
			vc_remove_element( 'contact-form-7' );
		}

		public function load_vc_maps() {
			require_once INSIGHT_VC_MAPS_DIR . '/tm_accordion.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_blog.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_box_icon.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_icon.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_rotate_box.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_button_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_button.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_countdown.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_counter.php';

			if ( class_exists( 'WPCF7' ) ) {
				require_once INSIGHT_VC_MAPS_DIR . '/tm_contact_form_7.php';
			}

			if ( function_exists( 'mc4wp_show_form' ) ) {
				require_once INSIGHT_VC_MAPS_DIR . '/tm_mailchimp_form.php';
			}

			require_once INSIGHT_VC_MAPS_DIR . '/tm_gmaps.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_gallery.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_heading.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_drop_cap.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_blockquote.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_list.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_gradation.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_restaurant_menu.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_instagram.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_twitter.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_pie_chart.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_portfolio.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_info_boxes.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_banner.php';
			if ( class_exists( 'WooCommerce' ) ) {
				require_once INSIGHT_VC_MAPS_DIR . '/tm_product.php';
				require_once INSIGHT_VC_MAPS_DIR . '/tm_product_categories.php';
			}

			require_once INSIGHT_VC_MAPS_DIR . '/tm_pricing.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_pricing_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_popup_video.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_slider_icon_list.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_slider.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_slider_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_team_member.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_testimonial.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_timeline.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_social_networks.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_view_demo.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_view_demo_icon.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_w_better_custom_menu.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_button_separator.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_spacer.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_column.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_column_inner.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_progress_bar.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_row.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_row_inner.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_single_image.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_separator.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_widget_sidebar.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_tta_tabs.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_tta_section.php';
		}

		public function load_vc_params() {
			require_once INSIGHT_VC_PARAMS_DIR . '/number/number.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/number_responsive/number_responsive.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/spacing/spacing.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/datetime_picker/datetime_picker.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/gradient/gradient.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/radio_image/radio_image.php';
		}

		public static function get_slider_navs() {
			return array(
				esc_html__( 'None', 'tm-moody' )     => '',
				esc_html__( 'Style 01', 'tm-moody' ) => '1',
				esc_html__( 'Style 02', 'tm-moody' ) => '2',
				esc_html__( 'Style 03', 'tm-moody' ) => '3',
				esc_html__( 'Style 04', 'tm-moody' ) => '4',
				esc_html__( 'Style 05', 'tm-moody' ) => '5',
				esc_html__( 'Style 06', 'tm-moody' ) => '6',
				esc_html__( 'Style 07', 'tm-moody' ) => '7',
			);
		}

		public static function get_slider_dots() {
			return array(
				esc_html__( 'None', 'tm-moody' )     => '',
				esc_html__( 'Style 01', 'tm-moody' ) => '1',
				esc_html__( 'Style 02', 'tm-moody' ) => '2',
				esc_html__( 'Style 03', 'tm-moody' ) => '3',
				esc_html__( 'Style 04', 'tm-moody' ) => '4',
			);
		}

		public static function extra_class_field() {
			return array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'tm-moody' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'tm-moody' ),
				'std'         => '',
			);
		}

		public static function css_editor_field() {
			return array(
				'group'      => esc_html__( 'Design Options', 'tm-moody' ),
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'tm-moody' ),
				'param_name' => 'css',
			);
		}

		public static function get_animation_field( $args = array() ) {
			$defaults = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'CSS Animation', 'tm-moody' ),
				'desc'       => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'tm-moody' ),
				'param_name' => 'animation',
				'value'      => array(
					esc_html__( 'Default', 'tm-moody' )          => '',
					esc_html__( 'None', 'tm-moody' )             => 'none',
					esc_html__( 'Fade In', 'tm-moody' )          => 'fade-in',
					esc_html__( 'Move Up', 'tm-moody' )          => 'move-up',
					esc_html__( 'Move Down', 'tm-moody' )        => 'move-down',
					esc_html__( 'Move Left', 'tm-moody' )        => 'move-left',
					esc_html__( 'Move Right', 'tm-moody' )       => 'move-right',
					esc_html__( 'Scale Up', 'tm-moody' )         => 'scale-up',
					esc_html__( 'Fall Perspective', 'tm-moody' ) => 'fall-perspective',
					esc_html__( 'Fly', 'tm-moody' )              => 'fly',
					esc_html__( 'Flip', 'tm-moody' )             => 'flip',
					esc_html__( 'Helix', 'tm-moody' )            => 'helix',
					esc_html__( 'Pop Up', 'tm-moody' )           => 'pop-up',
				),
				'std'        => '',
			);
			$args     = wp_parse_args( $args, $defaults );

			return $args;
		}

		/**
		 * @param $term
		 *
		 * @return array|bool
		 */
		function autocomplete_taxonomies_field_render( $term ) {
			$t    = explode( ':', $term['value'] );
			$term = get_term_by( 'slug', $t[1], $t[0] );

			$data = false;
			if ( $term !== false ) {
				$data = $this->vc_get_term_object( $term );
			}

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_blog_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'post' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_portfolio_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'portfolio' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_product_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'product' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_testimonial_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'testimonial' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_get_data_from_post_type( $search_string, $post_type ) {
			$data             = array();
			$taxonomies_types = get_object_taxonomies( $post_type );
			$taxonomies       = get_terms( $taxonomies_types, array(
				'hide_empty' => false,
				'search'     => $search_string,
			) );
			if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = $this->vc_get_term_object( $t );
					}
				}
			}

			return $data;
		}

		function vc_get_term_object( $term ) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label'    => $term->name,
				'value'    => $term->taxonomy . ':' . $term->slug,
				'group_id' => $term->taxonomy,
				'group'    => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'tm-moody' ),
			);
		}

		public static function get_tax_query_of_taxonomies( $businext_post_args, $taxonomies ) {
			if ( empty( $taxonomies ) ) {
				return $businext_post_args;
			}

			$terms       = explode( ', ', $taxonomies );
			$tax_queries = array(); // List of taxonomies.

			if ( ! isset( $businext_post_args['tax_query'] ) ) {
				$businext_post_args['tax_query'] = array();

				foreach ( $terms as $term ) {
					$tmp       = explode( ':', $term );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];
					if ( ! isset( $tax_queries[ $taxonomy ] ) ) {
						$tax_queries[ $taxonomy ] = array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => array( $term_slug ),
						);
					} else {
						$tax_queries[ $taxonomy ]['terms'][] = $term_slug;
					}
				}
				$businext_post_args['tax_query']             = array_values( $tax_queries );
				$businext_post_args['tax_query']['relation'] = 'OR';
			} else {
				foreach ( $terms as $term ) {
					$tmp       = explode( ':', $term );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];

					foreach ( $businext_post_args['tax_query'] as $key => $query ) {
						if ( is_array( $query ) ) {
							if ( $query['taxonomy'] == $taxonomy ) {
								$businext_post_args['tax_query'][ $key ]['terms'][] = $term_slug;
							}
						}
					}
				}
			}

			return $businext_post_args;
		}

		public function admin_enqueue_scripts() {
			if ( ! function_exists( 'get_current_screen' ) ) {
				return;
			}

			$screen = get_current_screen();

			if ( $screen->base !== 'post' ) {
				return;
			}

			wp_enqueue_style( 'datetime-picker', INSIGHT_THEME_URI . '/assets/custom_libs/datetimepicker/jquery.datetimepicker.css' );
			wp_enqueue_script( 'datetime-picker', INSIGHT_THEME_URI . '/assets/custom_libs/datetimepicker/jquery.datetimepicker.full.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );

			// Enqueue CSS.
			wp_enqueue_style( 'is-colorpicker', INSIGHT_THEME_URI . '/assets/custom_libs/colorpicker/css/jquery-colorpicker.css' );
			wp_enqueue_style( 'is-classygradient', INSIGHT_THEME_URI . '/assets/custom_libs/classygradient/css/jquery-classygradient-min.css' );

			wp_enqueue_script( 'is-colorpicker', INSIGHT_THEME_URI . '/assets/custom_libs/colorpicker/js/jquery-colorpicker.js', array( 'jquery' ), INSIGHT_THEME_VERSION, false );
			wp_enqueue_script( 'is-classygradient', INSIGHT_THEME_URI . '/assets/custom_libs/classygradient/js/jquery-classygradient-min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, false );
		}

		public static function get_progress_bar_inline_css( $selector = '', $atts ) {
			global $insight_shortcode_lg_css;
			extract( $atts );

			if ( $atts['bar_height'] !== '' ) {
				$insight_shortcode_lg_css .= "$selector.vc_progress_bar .vc_general.vc_single_bar { height: {$atts['bar_height']}px; }";
			}

			if ( $atts['track_color'] === 'custom' ) {
				$insight_shortcode_lg_css .= "$selector .vc_single_bar { background-color: {$atts['custom_track_color']}; }";
			}

			if ( $atts['background_color'] === 'custom' ) {
				$insight_shortcode_lg_css .= "$selector .vc_single_bar .vc_bar { background-color: {$atts['custom_background_color']}; }";
			}

			if ( $atts['text_color'] === 'custom' ) {
				$insight_shortcode_lg_css .= "$selector .vc_single_bar_title { color: {$atts['custom_text_color']}; }";
			}

			$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_column_css( $selector = '', $atts ) {
			global $insight_shortcode_lg_css;
			global $insight_shortcode_md_css;
			global $insight_shortcode_sm_css;
			global $insight_shortcode_xs_css;
			$tmp = '';
			$css = '';

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						$tmp .= "background-size: {$atts['background_size']};";
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector { $tmp }";
			}

			if ( $atts['max_width'] !== '' ) {
				$insight_shortcode_lg_css .= self::get_media_query_css( $selector, 'max-width', $atts['max_width'], 'min-width: 1200px' );
			}

			if ( isset( $atts['order'] ) && $atts['order'] !== '' ) {
				$orders = explode( ';', $atts['order'] );
				foreach ( $orders as $order ) {
					$value = explode( ':', $order );
					if ( $value['0'] === 'lg' ) {
						$insight_shortcode_lg_css .= "$selector { -webkit-order: {$value['1']}; -moz-order: {$value['1']}; order: {$value['1']}; }";
					} elseif ( $value['0'] === 'md' ) {
						$insight_shortcode_md_css .= "$selector { -webkit-order: {$value['1']}; -moz-order: {$value['1']}; order: {$value['1']}; }";
					} elseif ( $value['0'] === 'sm' ) {
						$insight_shortcode_sm_css .= "$selector { -webkit-order: {$value['1']}; -moz-order: {$value['1']}; order: {$value['1']}; }";
					} elseif ( $value['0'] === 'xs' ) {
						$insight_shortcode_xs_css .= "$selector { -webkit-order: {$value['1']}; -moz-order: {$value['1']}; order: {$value['1']}; }";
					}
				}
			}

			$spacing_selector = $selector . ' > .vc_column-inner';

			$insight_shortcode_lg_css .= self::get_vc_spacing_css( $spacing_selector, $atts );
		}

		public static function get_vc_row_css( $selector = '', $atts ) {
			global $insight_shortcode_lg_css;
			$gutter = '';
			extract( $atts );
			$tmp           = '';
			$primary_color = Insight::setting( 'primary_color' );
			$_color        = '#000';
			if ( $atts['separator_type'] === 'big_triangle' ) {

				if ( $atts['separator_color_1'] === 'primary_color' ) {
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:before{ border-right-color: $primary_color; }";
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:after{ border-left-color: $primary_color; }";
				} elseif ( $atts['separator_color_1'] === 'custom' ) {
					$_color                   = $atts['custom_separator_color_1'];
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:before{ border-right-color: $_color; }";
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:after{ border-left-color: $_color; }";
				}

				if ( $atts['separator_color_2'] === 'primary_color' ) {
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:before{ border-bottom-color: $primary_color; }";
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:after{ border-bottom-color: $primary_color; }";
				} elseif ( $atts['separator_color_2'] === 'custom' ) {
					$_color                   = $atts['custom_separator_color_2'];
					$insight_shortcode_lg_css .= "$selector .vc_row-separator:before, $selector .vc_row-separator:after{ border-bottom-color: $_color; }";
				}

			} elseif ( $atts['separator_type'] === 'triangle' ) {
				if ( $atts['separator_color_1'] === 'primary_color' ) {
					$_color = $primary_color;
				} elseif ( $atts['separator_color_1'] === 'custom' ) {
					$_color = $atts['custom_separator_color_1'];
				}
				$insight_shortcode_lg_css .= "$selector .vc_row-separator:before, $selector .vc_row-separator:after{ background: $_color; }";
			} elseif ( $atts['separator_type'] === 'half_circle' ) {
				if ( $atts['separator_color_1'] === 'primary_color' ) {
					$_color = $primary_color;
				} elseif ( $atts['separator_color_1'] === 'custom' ) {
					$_color = $atts['custom_separator_color_1'];
				}
				$insight_shortcode_lg_css .= "$selector .vc_row-separator:before, $selector .vc_row-separator:after{ background: $_color; }";
			}

			if ( isset( $layer_index ) && $layer_index !== '' ) {
				$tmp .= "position: relative; z-index: {$layer_index}";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= "-moz-border-radius: {$atts['border_radius']};-webkit-border-radius: {$atts['border_radius']};border-radius: {$atts['border_radius']};";
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= "-moz-box-shadow: {$atts['box_shadow']};-webkit-box-shadow: {$atts['box_shadow']};box-shadow: {$atts['box_shadow']};";
			}

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						if ( $atts['background_size'] === 'manual' ) {
							if ( $atts['background_size_manual'] !== '' ) {
								$tmp .= "background-size: {$atts['background_size_manual']};";
							}
						} else {
							$tmp .= "background-size: {$atts['background_size']};";
						}
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector{ $tmp }";
			}

			$insight_shortcode_lg_css .= self::get_vc_row_gutter( $selector, $gutter );

			$insight_shortcode_lg_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_row_inner_css( $selector = '', $atts ) {
			global $insight_shortcode_lg_css;
			global $insight_shortcode_md_css;
			global $insight_shortcode_sm_css;
			global $insight_shortcode_xs_css;
			$gutter = '';
			extract( $atts );
			$tmp = '';

			if ( $atts['max_width'] !== '' ) {
				$tmp .= "width: {$atts['max_width']}; max-width: 100%;";
				if ( $atts['content_alignment'] === 'center' ) {
					$tmp .= "margin: 0 auto;";
				} elseif ( $atts['content_alignment'] === 'right' ) {
					$tmp .= "float: right;";
				}
				if ( $atts['md_content_alignment'] !== '' ) {
					if ( $atts['md_content_alignment'] === 'left' ) {
						$insight_shortcode_md_css .= "$selector{ float: left; }";
					} elseif ( $atts['md_content_alignment'] === 'center' ) {
						$insight_shortcode_md_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['md_content_alignment'] === 'right' ) {
						$insight_shortcode_md_css .= "$selector{ float: right; }";
					}
				}
				if ( $atts['sm_content_alignment'] !== '' ) {
					if ( $atts['sm_content_alignment'] === 'left' ) {
						$insight_shortcode_sm_css .= "$selector{ float: left; }";
					} elseif ( $atts['sm_content_alignment'] === 'center' ) {
						$insight_shortcode_sm_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['sm_content_alignment'] === 'right' ) {
						$insight_shortcode_sm_css .= "$selector{ float: right; }";
					}
				}
				if ( $atts['xs_content_alignment'] !== '' ) {
					if ( $atts['xs_content_alignment'] === 'left' ) {
						$insight_shortcode_xs_css .= "$selector{ float: left; }";
					} elseif ( $atts['xs_content_alignment'] === 'center' ) {
						$insight_shortcode_xs_css .= "$selector{ margin: 0 auto; float: none; }";
					} elseif ( $atts['xs_content_alignment'] === 'right' ) {
						$insight_shortcode_xs_css .= "$selector{ float: right; }";
					}
				}
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= "-moz-border-radius: {$atts['border_radius']};-webkit-border-radius: {$atts['border_radius']};border-radius: {$atts['border_radius']};";
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= "-moz-box-shadow: {$atts['box_shadow']};-webkit-box-shadow: {$atts['box_shadow']};box-shadow: {$atts['box_shadow']};";
			}

			if ( $atts['background_color'] === 'custom' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						$tmp .= "background-size: {$atts['background_size']};";
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $tmp !== '' ) {
				$insight_shortcode_lg_css .= "$selector{ $tmp }";
			}

			$insight_shortcode_lg_css .= self::get_vc_row_gutter( $selector, $gutter );

			$insight_shortcode_lg_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function vc_spacing_has_border( $atts ) {
			$spacings = array(
				'lg_spacing',
				'md_spacing',
				'sm_spacing',
				'xs_spacing',
			);
			foreach ( $spacings as $val ) {
				if ( isset( $atts[ $val ] ) && $atts[ $val ] !== '' ) {
					if ( strpos( $atts[ $val ], 'border' ) !== false ) {
						return true;
					}
				}
			}

			return false;
		}

		public static function get_vc_spacing_tab() {
			$spacing_tab = esc_html__( 'Design Options', 'tm-moody' );

			return array(
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Large Device Spacing', 'tm-moody' ),
					'type'         => 'spacing',
					'param_name'   => 'lg_spacing',
					'spacing_icon' => 'fa-desktop',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Medium Device Spacing', 'tm-moody' ),
					'type'         => 'spacing',
					'param_name'   => 'md_spacing',
					'spacing_icon' => 'fa-tablet fa-rotate-270',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Small Device Spacing', 'tm-moody' ),
					'type'         => 'spacing',
					'param_name'   => 'sm_spacing',
					'spacing_icon' => 'fa-tablet',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Extra Small Spacing', 'tm-moody' ),
					'type'         => 'spacing',
					'param_name'   => 'xs_spacing',
					'spacing_icon' => 'fa-mobile',
				),
			);
		}

		/**
		 * Generate to gutter CSS
		 *
		 * @param $selector
		 * @param $gutter
		 *
		 * @return string
		 */
		public static function get_vc_row_gutter( $selector, $gutter ) {
			$css = $default_css = $css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( $gutter !== '' ) {

				if ( ! is_numeric( $gutter ) ) {
					$arr = self::parse_responsive_string( $gutter );

					if ( ! empty( $arr ) ) {
						if ( count( $arr ) > 1 ) {

							foreach ( $arr as $key => $number ) {
								$number /= 2;
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_xs_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'sm':
										$css_sm_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_sm_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'md':
										$css_md_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_md_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'lg':
										$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									default:
										break;
								}
							}
						} else { // default css.
							$number     = $arr['lg'] / 2;
							$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
							$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
						}
					}
				} else {
					$number      = $gutter / 2;
					$default_css .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
					$default_css .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
				}

				if ( $default_css ) {
					$css .= $default_css;
				}

				if ( $css_lg_tmp ) {
					$css .= $css_lg_tmp;
				}
				if ( $css_md_tmp ) {
					$css .= "@media (max-width: 1199px){ $css_md_tmp }";
				}

				if ( $css_sm_tmp ) {
					$css .= "@media (max-width: 767px){ $css_sm_tmp }";
				}

				if ( $css_xs_tmp ) {
					$css .= "@media (max-width: 543px){ $css_xs_tmp }";
				}
			}

			return $css;
		}

		public static function get_vc_spacing_css( $selector = '', $atts ) {
			$css = '';

			if ( isset( $atts['lg_spacing'] ) && $atts['lg_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['lg_spacing'] );
			}

			if ( $atts['md_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['md_spacing'], 'max-width: 1199px' );
			}

			if ( $atts['sm_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['sm_spacing'], 'max-width: 992px' );
			}

			if ( $atts['xs_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['xs_spacing'], 'max-width: 767px' );
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $selector
		 * @param $values
		 * @param $media
		 *
		 * @return string
		 */
		public static function parse_spacing_value( $atts, $selector, $values, $media = '' ) {

			$css = '';
			if ( $selector ) {
				$spacing = explode( ';', $values );

				if ( $media !== '' ) {
					$css .= "@media ( $media ) {";
				}

				$css .= "$selector {";

				foreach ( $spacing as $value ) {
					$tmp  = explode( ':', $value );
					$attr = str_replace( '_', '-', $tmp[0] );
					$val  = $tmp[1];

					if ( strpos( $attr, 'border' ) !== false ) {
						$css          .= "$attr-width : {$val}px !important;";
						$border_color = '';
						if ( $atts['border_color'] === 'custom' ) {
							$border_color = $atts['custom_border_color'];
						} elseif ( $atts['border_color'] === 'primary' ) {
							$border_color = Insight::setting( 'primary_color' );
						}
						$css .= "$attr-color: $border_color;";
						$css .= "$attr-style: {$atts['border_style']};";
					} else {
						$css .= "$attr : {$val}px !important;";
					}
				}

				$css .= "}";

				if ( $media !== '' ) {
					$css .= "}";
				}
			}

			return $css;
		}

		public static function get_media_query_css( $selector, $attr, $value, $media ) {
			$css = '';
			if ( $selector ) {
				$css .= "@media ( $media ) { $selector { $attr:{$value}; } }";
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $args
		 *
		 * @return string
		 */
		public static function get_responsive_css( $args = array() ) {
			global $insight_shortcode_lg_css;
			global $insight_shortcode_md_css;
			global $insight_shortcode_sm_css;
			global $insight_shortcode_xs_css;

			$css = $default_css = $css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( ! empty( $args['element'] ) && ! empty( $args['atts'] ) ) {

				$element = $args['element'];

				foreach ( $args['atts'] as $prop => $prop_array ) {
					$unit = $prop_array['unit'];

					if ( ! is_numeric( $prop_array['media_str'] ) ) {
						$arr = self::parse_responsive_string( $prop_array['media_str'] );

						if ( ! empty( $arr ) ) {
							foreach ( $arr as $key => $number ) {
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									case 'sm':
										$css_sm_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									case 'md':
										$css_md_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									case 'lg':
										$css_lg_tmp .= $prop . ':' . $number . $unit . ';';
										break;
									default:
										break;
								}
							}
						}
					} else {
						$default_css .= $prop . ':' . $prop_array['media_str'] . $unit . ';';
					}
				}

				if ( $default_css ) {
					$insight_shortcode_lg_css .= "$element { $default_css }";
				}

				if ( $css_lg_tmp ) {
					$insight_shortcode_lg_css .= "$element { $css_lg_tmp }";
				}

				if ( $css_md_tmp ) {
					$insight_shortcode_md_css .= "$element { $css_md_tmp }";
				}

				if ( $css_sm_tmp ) {
					$insight_shortcode_sm_css .= "$element { $css_sm_tmp }";
				}

				if ( $css_xs_tmp ) {
					$insight_shortcode_xs_css .= "$element { $css_xs_tmp }";
				}
			}
		}

		/**
		 * Parse responsive string to array
		 *
		 * @param $str
		 *
		 * @return array
		 */
		public static function parse_responsive_string( $str ) {
			$data     = preg_split( '/;/', $str );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( ':', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$number           = $pieces[1];
					$data_arr[ $key ] = $number;
				}
			}

			return $data_arr;
		}

		public static function icon_libraries( $args = array() ) {
			$defaults = array(
				'dependency'     => array(),
				'admin_label'    => true,
				'allow_none'     => false,
				'param_name'     => 'type',
				'icon_libraries' => array(
					esc_html__( 'Font Awesome', 'tm-moody' ) => 'fontawesome',
					esc_html__( 'Simple Line', 'tm-moody' )  => 'simple_line',
				),
				'group'          => esc_html__( 'Icon', 'tm-moody' ),
			);
			$args     = wp_parse_args( $args, $defaults );

			if ( $args['allow_none'] ) {
				$args['icon_libraries'] = array( esc_html__( 'None', 'tm-moody' ) => '' ) + $args['icon_libraries'];
			}

			$type = array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'tm-moody' ),
				'value'       => $args['icon_libraries'],
				'param_name'  => $args['param_name'],
				'description' => esc_html__( 'Select icon library.', 'tm-moody' ),
			);

			if ( $args['admin_label'] ) {
				$type['admin_label'] = true;
			}

			if ( ! empty( $args['dependency'] ) ) {
				$type['dependency'] = $args['dependency'];
			}

			$results = array(
				$type,
			);

			$_svg_animate_allowed = array( 'linea' );
			$_svg_flag            = false;

			foreach ( $args['icon_libraries'] as $key => $value ) {
				if ( in_array( $value, $_svg_animate_allowed ) ) {
					$_svg_flag = true;
				}

				if ( $value === 'fontawesome' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'tm-moody' ),
						'param_name'  => 'icon_fontawesome',
						'value'       => 'fa fa-adjust',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'fontawesome',
							'iconsPerPage' => 4000,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'fontawesome',
						),
						'description' => esc_html__( 'Select icon from library.', 'tm-moody' ),
					);
				} elseif ( $value === 'simple_line' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'tm-moody' ),
						'param_name'  => 'icon_simple_line',
						'value'       => 'icon-arrow-1-circle-down',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'simple_line',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'simple_line',
						),
						'description' => esc_html__( 'Select icon from library.', 'tm-moody' ),
					);
				} elseif ( $value === 'linea' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'tm-moody' ),
						'param_name'  => 'icon_linea',
						'value'       => 'icon-basic-accelerator',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'linea',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'linea',
						),
						'description' => esc_html__( 'Select icon from library.', 'tm-moody' ),
					);
				}
			}

			if ( $_svg_flag === true ) {
				$results[] = array(
					'heading'    => esc_html__( 'Use Animate SVG Icon', 'tm-moody' ),
					'type'       => 'checkbox',
					'param_name' => 'use_animate_svg_icon',
					'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
					'std'        => '1',
					'dependency' => array(
						'element' => $args['param_name'],
						'value'   => $_svg_animate_allowed,
					),
				);
			}

			if ( $args['group'] !== '' ) {
				foreach ( $results as $key => $item ) {
					$results[ $key ]['group'] = $args['group'];
				}
			}

			return $results;
		}

		public function update_google_fonts() {
			global $wp_filesystem;

			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();

			$path = get_template_directory() . '/assets/fonts/vc_google_fonts.json';

			$fonts = array();

			if ( file_exists( $path ) ) {

				$json  = $wp_filesystem->get_contents( $path );
				$fonts = json_decode( $json );
			}

			return $fonts;
		}
	}

	new Insight_VC();
}
