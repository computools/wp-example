<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Insight_Instagram' ) ) {

	class Insight_Instagram {

		public function __construct() {

		}

		/**
		 * Quick-and-dirty Instagram web scrape
		 * based on https://gist.github.com/cosmocatalano/4544576
		 *
		 * @param     $username
		 * @param int $slice
		 *
		 * @return array|WP_Error
		 */
		public static function scrape_instagram( $username, $slice ) {
			$username     = trim( strtolower( $username ) );
			$photos_array = get_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username ) );

			if ( false === $photos_array ) {
				switch ( substr( $username, 0, 1 ) ) {
					case '#':
						$url = 'https://instagram.com/explore/tags/' . str_replace( '#', '', $username );
						break;
					default:
						$url = 'https://instagram.com/' . str_replace( '@', '', $username );
						break;
				}

				$remote = wp_remote_get( $url );

				if ( is_wp_error( $remote ) ) {
					return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'tm-moody' ) );
				}

				if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
					return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'tm-moody' ) );
				}

				$shards      = explode( 'window._sharedData = ', $remote['body'] );
				$insta_json  = explode( ';</script>', $shards[1] );
				$insta_array = json_decode( $insta_json[0], true );

				if ( ! $insta_array ) {
					return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'tm-moody' ) );
				}

				if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
					$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
				} elseif ( isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
					$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
				} else {
					return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'tm-moody' ) );
				}

				if ( ! is_array( $images ) ) {
					return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'tm-moody' ) );
				}

				$photos_array = array();

				foreach ( $images as $image ) {
					$image = $image['node'];

					if ( true === $image['is_video'] ) {
						$type = 'video';
					} else {
						$type = 'image';
					}

					$caption = esc_html__( 'Instagram Image', 'tm-moody' );
					if ( ! empty( $image['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
						$caption = wp_kses( $image['edge_media_to_caption']['edges'][0]['node']['text'], array() );
					}

					$image['thumbnail_src'] = preg_replace( '/^https?\:/i', '', $image['thumbnail_src'] );
					$image['display_url']   = preg_replace( '/^https?\:/i', '', $image['display_url'] );

					if ( isset( $image['thumbnail_resources'] ) && ! empty( $image['thumbnail_resources'] ) ) {
						foreach ( $image['thumbnail_resources'] as $photo ) {
							switch ( $photo['config_width'] ) {
								case 150 :
									$image['thumbnail'] = $photo['src'];
									break;
								case 240 :
									$image['small'] = $photo['src'];
									break;
								case 320 :
									$image['medium'] = $photo['src'];
									break;
								case 480 :
									$image['large'] = $photo['src'];
									break;
								case 640 :
									$image['extra_large'] = $photo['src'];
									break;
							}
						}
					}

					$photos_array[] = array(
						'description' => $caption,
						'link'        => trailingslashit( '//instagram.com/p/' . $image['shortcode'] ),
						'time'        => $image['taken_at_timestamp'],
						'comments'    => self::roundNumber( $image['edge_media_to_comment']['count'] ),
						'likes'       => self::roundNumber( $image['edge_liked_by']['count'] ),
						'thumbnail'   => $image['thumbnail'],
						'small'       => $image['small'],
						'medium'      => $image['medium'],
						'large'       => $image['large'],
						'extra_large' => $image['extra_large'],
						'original'    => $image['display_url'],
						'type'        => $type,
					);
				}

				if ( empty( $photos_array ) ) {
					return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'tm-moody' ) );
				}

				set_transient( 'instagram-media-new-' . sanitize_title_with_dashes( $username ), $photos_array, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 24 ) );
			}

			$photos_array = array_slice( $photos_array, 0, $slice );

			return $photos_array;
		}

		/**
		 * Generate rounded number
		 * Example: 11200 --> 11K
		 *
		 * @param $number
		 *
		 * @return string
		 */
		public static function roundNumber( $number ) {
			if ( $number > 999 && $number <= 999999 ) {
				$result = floor( $number / 1000 ) . ' K';
			} elseif ( $number > 999999 ) {
				$result = floor( $number / 1000000 ) . ' M';
			} else {
				$result = $number;
			}

			return $result;
		}
	}

	new Insight_Instagram();
}
