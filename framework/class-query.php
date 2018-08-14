<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions, filters, actions for visual composer page builder.
 */
if ( ! class_exists( 'Insight_Query' ) ) {
	class Insight_Query {

		public function __construct() {

		}

		public static function get_related_posts( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}

			$categories = get_the_category( $args['post_id'] );

			if ( ! $categories ) {
				return false;
			}

			foreach ( $categories as $category ) {
				if ( $category->parent === 0 ) {
					$term_ids[] = $category->term_id;
				} else {
					$term_ids[] = $category->parent;
					$term_ids[] = $category->term_id;
				}
			}

			// Remove duplicate values from the array.
			$unique_array = array_unique( $term_ids );

			$query_args = array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true, // Skip pagination, makes the query faster.
				'tax_query'      => array(
					array(
						'taxonomy'         => 'category',
						'terms'            => $unique_array,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );

			return $query;
		}

		public static function get_related_portfolios( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}
			$query_args = array(
				'post_type'      => 'portfolio',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true, // Skip pagination, makes the query faster.
			);

			$query_args['orderby'] = isset( $args['orderby'] ) ? $args['orderby'] : 'ID';
			$query_args['order']   = isset( $args['orderby'] ) ? $args['orderby'] : 'DESC';

			$related_by              = Insight::setting( 'portfolio_related_by' );
			$query_args['tax_query'] = array();
			if ( ! empty( $related_by ) ) {
				foreach ( $related_by as $tax ) {
					$terms = get_the_terms( $args['post_id'], $tax );
					if ( $terms && ! is_wp_error( $terms ) ) {
						$term_ids = array();
						foreach ( $terms as $term ) {
							$term_ids[] = $term->term_id;
						}
						$query_args['tax_query'][] = array(
							'terms'    => $term_ids,
							'taxonomy' => $tax,
						);
					}
				}
				if ( count( $query_args['tax_query'] ) > 1 ) {
					$query_args['tax_query']['relation'] = 'OR';
				}
			}

			$query = new WP_Query( $query_args );

			return $query;
		}

		public static function get_latest_portfolios( $args ) {
			$defaults = array(
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 ) {
				return false;
			}

			$query_args = array(
				'post_type'           => 'portfolio',
				'orderby'             => 'ID',
				'order'               => 'DESC',
				'ignore_sticky_posts' => 0,
				'meta_key'            => '_thumbnail_id',
				'posts_per_page'      => $args['number_posts'],
				'no_found_rows'       => true, // Skip pagination, makes the query faster.
			);

			$query = new WP_Query( $query_args );

			return $query;
		}

	}

	new Insight_Query();
}
