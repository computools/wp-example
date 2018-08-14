<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Insight_Actions_Filters' ) ) {
	class Insight_Actions_Filters {

		/**
		 * Insight_Filters constructor.
		 */
		public function __construct() {
			add_filter( 'wp_kses_allowed_html', array( $this, 'wp_kses_allowed_html' ), 2, 99 );
			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );
			add_filter( 'widget_tag_cloud_args', array( $this, 'change_widget_tag_cloud_args' ) );
			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.
			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'insight_body_attributes', array( $this, 'add_attributes_to_body' ) );

			remove_filter( 'the_excerpt', 'wpautop' );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			add_action( 'wp_ajax_portfolio_infinite_load', array( $this, 'portfolio_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_portfolio_infinite_load', array( $this, 'portfolio_infinite_load' ) );

			add_action( 'wp_ajax_post_infinite_load', array( $this, 'post_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'post_infinite_load' ) );

			add_action( 'wp_ajax_product_infinite_load', array( $this, 'product_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_product_infinite_load', array( $this, 'product_infinite_load' ) );

			// Add inline style for shortcode.
			add_action( 'wp_footer', array( $this, 'shortcode_style' ) );

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );
		}

		public function wp_kses_allowed_html( $allowedtags, $context ) {
			switch ( $context ) {
				case 'moody-default' :
					$allowedtags = array(
						'a'      => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
						'img'    => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
						),
						'div'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'strong' => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'b'      => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'span'   => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'i'      => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'del'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'ins'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'br'     => array(),
						'ul'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'ol'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'li'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
					);
					break;
			}

			return $allowedtags;
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['walker'] = new Insight_Walker_Nav_Menu;

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			// First remove span that added by woocommerce.
			$links = str_replace( '<span class="count">', '', $links );
			$links = str_replace( '</span>', '', $links );

			// Then add span again for both blog & shop.

			$links = str_replace( '</a> ', ' <span class="count">', $links );
			$links = str_replace( ')', ')</span></a>', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			return $links;
		}


		function change_widget_tag_cloud_args( $args ) {
			/* set the smallest & largest size in px */
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		function shortcode_style() {
			global $insight_shortcode_lg_css;
			global $insight_shortcode_md_css;
			global $insight_shortcode_sm_css;
			global $insight_shortcode_xs_css;
			$css = '';

			if ( $insight_shortcode_lg_css && $insight_shortcode_lg_css !== '' ) {
				$css .= $insight_shortcode_lg_css;
			}

			if ( $insight_shortcode_md_css && $insight_shortcode_md_css !== '' ) {
				$css .= "@media (max-width: 1199px) { $insight_shortcode_md_css }";
			}

			if ( $insight_shortcode_sm_css && $insight_shortcode_sm_css !== '' ) {
				$css .= "@media (max-width: 992px) { $insight_shortcode_sm_css }";
			}

			if ( $insight_shortcode_xs_css && $insight_shortcode_xs_css !== '' ) {
				$css .= "@media (max-width: 767px) { $insight_shortcode_xs_css }";
			}

			if ( $css !== '' ) : ?>
				<script type="text/javascript">
					var mainStyle = document.getElementById( 'insight-style-inline-css' );
					if ( mainStyle !== null ) {
						mainStyle.textContent += '<?php echo '' . $css; ?>';
					}
				</script>
			<?php endif;
		}

		/**
		 * Remove empty p tag created by wpautop()
		 */
		public function remove_empty_p( $content ) {
			$content = force_balance_tags( $content );
			$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
			$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );

			return $content;
		}

		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Insight::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$filter = Insight::setting( 'search_page_filter' );
				if ( $filter !== 'all' ) {
					$query->set( 'post_type', $filter );
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Insight_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function portfolio_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( isset( $_POST['extra_taxonomy'] ) && ! empty( $_POST['extra_taxonomy'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['extra_taxonomy'] );
			}

			$style = 'grid';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}

			$overlay_style = $_POST['overlay_style'];
			$image_size    = $_POST['image_size'];
			$metro_layout  = $_POST['metro_layout'];
			$count         = $_POST['count'];
			$insight_query = new WP_Query( $args );

			$response = array(
				'max_num_pages' => $insight_query->max_num_pages,
				'found_posts'   => $insight_query->found_posts,
				'count'         => $insight_query->post_count,
			);

			ob_start();

			if ( $insight_query->have_posts() ) :

				set_query_var( 'insight_query', $insight_query );
				set_query_var( 'count', $count );
				set_query_var( 'overlay_style', $overlay_style );
				set_query_var( 'image_size', $image_size );
				set_query_var( 'metro_layout', $metro_layout );

				get_template_part( 'loop/shortcodes/portfolio/style', $style );

			endif;

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public function post_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( isset( $_POST['extra_taxonomy'] ) && ! empty( $_POST['extra_taxonomy'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['extra_taxonomy'] );
			}

			$style = 1;
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}
			$count         = $_POST['count'];
			$insight_query = new WP_Query( $args );

			$response = array(
				'max_num_pages' => $insight_query->max_num_pages,
				'found_posts'   => $insight_query->found_posts,
				'count'         => $insight_query->post_count,
			);

			ob_start();

			if ( $insight_query->have_posts() ) : ?>
				<?php if ( $style === '1' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'grid-item', 'post-item' );
						$format  = '';
						if ( get_post_format() !== false ) {
							$format = get_post_format();
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<?php get_template_part( 'loop/blog/format', $format ); ?>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h2 class="post-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<?php if ( is_sticky() ) : ?>
									<span class="post-sticky"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
										<?php esc_html_e( 'Sticky', 'tm-moody' ); ?></span>
								<?php endif; ?>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								<div class="post-excerpt">
									<?php Insight_Templates::excerpt( array( 'limit' => 42, 'type' => 'word' ) ); ?>
								</div>
								<div class="post-read-more">
									<a class="tm-button style-3 tm-button-default tm-button-lg"
									   href="<?php the_permalink(); ?>">
										<span><?php esc_html_e( 'Read full post', 'tm-moody' ); ?></span>
									</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '2' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-day">
								<h4>
									<?php echo get_the_date( 'd' ); ?>
								</h4>
							</div>
							<div class="post-feature-overlay">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-feature"
									     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
									</div>
								<?php } ?>
								<div class="post-overlay">

								</div>
							</div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								<div class="post-excerpt">
									<?php Insight_Templates::excerpt( array(
										'limit' => 140,
										'type'  => 'character',
									) ); ?>
								</div>
								<div class="post-read-more">
									<a class="tm-button style-3 tm-button-default tm-button-lg"
									   href="<?php the_permalink(); ?>">
										<span><?php esc_html_e( 'Read full post', 'tm-moody' ); ?></span>
									</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '3' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item' );
						$format  = '';
						if ( get_post_format() !== false ) {
							$format = get_post_format();
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
							<div class="post-feature-overlay">
								<div class="post-overlay">

								</div>
							</div>
							<div class="post-day">
								<h4>
									<?php echo get_the_date( 'd' ); ?>
								</h4>
							</div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '4' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item swiper-slide' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-day">
								<h4>
									<?php echo get_the_date( 'd' ); ?>
								</h4>
							</div>
							<div class="post-feature-overlay">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-feature"
									     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
									</div>
								<?php } ?>
								<div class="post-overlay">

								</div>
							</div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								<div class="post-excerpt">
									<?php Insight_Templates::excerpt( array(
										'limit' => 140,
										'type'  => 'character',
									) ); ?>
								</div>
								<div class="post-read-more">
									<a class="tm-button style-3 tm-button-default tm-button-lg"
									   href="<?php the_permalink(); ?>">
										<span><?php esc_html_e( 'Read full post', 'tm-moody' ); ?></span>
									</a>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } ?>
				<?php
			endif;

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public function product_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			if ( isset( $_POST['extra_taxonomy'] ) && ! empty( $_POST['extra_taxonomy'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['extra_taxonomy'] );
			}

			$style = 'grid';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}
			$count         = $_POST['count'];
			$insight_query = new WP_Query( $args );

			$response = array(
				'max_num_pages' => $insight_query->max_num_pages,
				'found_posts'   => $insight_query->found_posts,
				'count'         => $insight_query->post_count,
			);

			ob_start();

			if ( $insight_query->have_posts() ) : ?>
				<?php if ( $style === 'grid' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'product-item grid-item' );
						?>
						<div <?php post_class( $classes ); ?>>
							<div class="product-thumbnail">
								<?php woocommerce_template_loop_product_link_open(); ?>
								<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
								<?php woocommerce_template_loop_product_link_close(); ?>
								<div class="<?php echo esc_attr( "actions" ); ?>">
									<div class="action action-view-detail">
										<?php woocommerce_template_loop_product_link_open(); ?>
										<i class="icon-magnifier-1"></i>
										<?php woocommerce_template_loop_product_link_close(); ?>
									</div>
									<div class="action action-add-to-cart">
										<?php woocommerce_template_loop_add_to_cart(); ?>
									</div>
								</div>
							</div>
							<div class="product-info">
								<?php
								woocommerce_template_loop_product_link_open();
								do_action( 'woocommerce_shop_loop_item_title' );
								woocommerce_template_loop_price();
								woocommerce_template_loop_product_link_close();
								?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === 'carousel' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'product-item grid-item swiper-slide' );
						?>
						<div <?php post_class( $classes ); ?>>
							<div class="product-thumbnail">
								<?php woocommerce_template_loop_product_link_open(); ?>
								<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
								<?php woocommerce_template_loop_product_link_close(); ?>
								<div class="<?php echo esc_attr( "actions" ); ?>">
									<div class="action action-view-detail">
										<?php woocommerce_template_loop_product_link_open(); ?>
										<i class="icon-magnifier-1"></i>
										<?php woocommerce_template_loop_product_link_close(); ?>
									</div>
									<div class="action action-add-to-cart">
										<?php woocommerce_template_loop_add_to_cart(); ?>
									</div>
								</div>
							</div>
							<div class="product-info">
								<?php
								woocommerce_template_loop_product_link_open();
								do_action( 'woocommerce_shop_loop_item_title' );
								woocommerce_template_loop_price();
								woocommerce_template_loop_product_link_close();
								?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } ?>
				<?php
			endif;

			wp_reset_postdata();

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Insight_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Insight::setting( 'site_width' );
			}
			$attrs['data-content-width'] = $site_width;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			global $insight_vars;

			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Adds a class for mobile device.
			if ( Insight::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Insight::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Insight::is_handheld() ) {
				$classes[] = 'handheld';
				$classes[] = 'mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Insight::is_desktop() ) {
				$classes[] = 'desktop';
				$classes[] = 'desktop-menu';
			}

			$one_page_enable = Insight_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			$title_bar_layout = Insight_Helper::get_post_meta( 'page_title_bar_layout', 'default' );
			if ( $title_bar_layout === 'default' ) {
				if ( is_singular( 'post' ) ) {
					$title_bar_layout = Insight::setting( 'single_post_title_bar_layout' );
				} elseif ( is_singular( 'page' ) ) {
					$title_bar_layout = Insight::setting( 'single_page_title_bar_layout' );
				} elseif ( is_singular( 'product' ) ) {
					$title_bar_layout = Insight::setting( 'single_product_title_bar_layout' );
				} elseif ( is_singular( 'portfolio' ) ) {
					$title_bar_layout = Insight::setting( 'single_portfolio_title_bar_layout' );
				} else {
					$title_bar_layout = Insight::setting( 'title_bar_layout' );
				}
				if ( $title_bar_layout === 'default' ) {
					$title_bar_layout = Insight::setting( 'title_bar_layout' );
				}
			}

			$single_post_layout = '';

			if ( $title_bar_layout !== 'none' ) {
				if ( is_singular( 'post' ) ) {
					$single_post_layout = Insight_Helper::get_post_meta( 'post_layout_style', '' );
					if ( $single_post_layout === '' ) {
						$single_post_layout = Insight::setting( 'single_post_style' );
					}
				}

				if ( $single_post_layout !== '2' ) {
					$classes[] = "page-title-bar-$title_bar_layout";
				}
			}

			if ( is_singular( 'portfolio' ) ) {
				$style = Insight_Helper::get_post_meta( 'portfolio_layout_style', '' );
				if ( $style === '' ) {
					$style = Insight::setting( 'single_portfolio_style' );
				}
				$classes[] = "single-portfolio-style-$style";
			}

			$header_position = Insight_Helper::get_post_meta( 'header_position', '' );
			if ( $header_position !== '' ) {
				$classes[] = "page-header-$header_position";
			}

			$header_type = Insight::setting( 'header_type' );
			$classes[]   = 'header' . $header_type;

			$header_sticky_behaviour = Insight::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Insight_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Insight::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			if ( is_singular( 'post' ) || is_singular( 'product' ) ) {

				if ( $insight_vars->has_sidebar === true ) {
					$classes[] = 'page-has-sidebar';
				} else {
					$classes[] = 'page-has-no-sidebar';
				}

				if ( $insight_vars->has_both_sidebar ) {
					$classes[] = 'page-has-both-sidebar';
				}
			}

			return $classes;
		}
	}

	new Insight_Actions_Filters();
}
