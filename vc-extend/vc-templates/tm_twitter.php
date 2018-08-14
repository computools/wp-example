<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$username = $consumer_key = $consumer_secret = $access_token = $access_token_secret = $number_items = $el_class = $style = $heading = $show_date = '';
$css_id   = uniqid( 'tm-twitter-' );
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $username !== '' && $consumer_key !== '' && $consumer_secret !== '' && $access_token !== '' && $access_token_secret !== '' && $number_items !== '' ) {
	$trans_name = 'list_tweets_' . $css_id;
	$cache_time = 10;
	if ( false === ( $twitter_data = get_transient( $trans_name ) ) ) {

		$token = get_option( 'cfTwitterToken_' . $css_id );

		// Get a new token anyways.
		delete_option( 'cfTwitterToken_' . $css_id );

		// Getting new auth bearer only if we don't have one.
		if ( ! $token ) {
			// preparing credentials.
			$credentials = $consumer_key . ':' . $consumer_secret;
			$to_send     = insight_core_base_encode( $credentials );

			// http post arguments.
			$args = array(
				'method'      => 'POST',
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'Authorization' => 'Basic ' . $to_send,
					'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
				),
				'body'        => array( 'grant_type' => 'client_credentials' ),
			);

			add_filter( 'https_ssl_verify', '__return_false' );
			$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

			$keys = json_decode( wp_remote_retrieve_body( $response ) );

			if ( $keys ) {
				// Saving token to wp_options table.
				update_option( 'cfTwitterToken_' . $css_id, $keys->access_token );
				$token = $keys->access_token;
			}
		}
		// We have bearer token whether we obtain it from API or from options.
		$args = array(
			'httpversion' => '1.1',
			'blocking'    => true,
			'headers'     => array(
				'Authorization' => "Bearer $token",
			),
		);

		add_filter( 'https_ssl_verify', '__return_false' );
		$api_url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $number_items;
		$response = wp_remote_get( $api_url, $args );

		set_transient( $trans_name, wp_remote_retrieve_body( $response ), 60 * $cache_time );
	}
	@$twitter = json_decode( get_transient( $trans_name ), true );
}

if ( ! is_array( $twitter ) ) {
	return;
}

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-twitter ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$this->get_inline_css( "#$css_id", $atts );

$grid_classes = 'tm-grid';

$is_swiper = false;
if ( in_array( $style, array( 'slider' ), true ) ) {
	$is_swiper = true;

	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
}
?>

<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>">

	<?php if ( $is_swiper === true ) { ?>
	<div class="<?php echo esc_attr( $slider_classes ); ?>"
	     data-pagination="1"
	     data-loop="1"
	>
		<div class="swiper-container">
			<?php } ?>

			<div class="<?php echo esc_attr( $grid_classes ); ?>">

				<?php if ( $style === 'slider' ) { ?>
					<?php foreach ( $twitter as $tweet ) : ?>
						<?php
						$latest_tweet = $tweet['text'];
						$latest_tweet = preg_replace( '/(https:\/\/[a-z0-9\.\/]+)/i', '&nbsp;<a href="$1" target="_blank">$1</a>&nbsp;', $latest_tweet );
						$latest_tweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latest_tweet );
						$latest_tweet = preg_replace( '/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latest_tweet );
						?>
						<div class="swiper-slide">
							<div class="tweet">
								<?php if ( '' !== $heading ) : ?>
									<h5 class="tweet-heading">
										<?php echo esc_html( $heading ); ?>
									</h5>
								<?php endif; ?>
								<span
									class="tweet-username">@<?php echo esc_html( $tweet['user']['screen_name'] ); ?></span>;
								<?php echo '<div class="tweet-text">' . $latest_tweet . '</div>'; ?>
								<?php if ( '1' === $show_date ) : ?>
									<span
										class="tweet-date"><?php echo date( 'F d, Y', strtotime( $tweet['created_at'] ) ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php } elseif ( $style === "list" ) { ?>
					<?php foreach ( $twitter as $tweet ) : ?>
						<?php
						$latest_tweet = $tweet['text'];
						$latest_tweet = preg_replace( '/(https:\/\/[a-z0-9\.\/]+)/i', '&nbsp;<a href="$1" target="_blank">$1</a>&nbsp;', $latest_tweet );
						$latest_tweet = preg_replace( '/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latest_tweet );
						$latest_tweet = preg_replace( '/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latest_tweet );
						?>
						<div class="item">
							<div class="tweet">
								<?php echo '<div class="tweet-text">' . $latest_tweet . '</div>'; ?>
								<?php if ( '1' === $show_date ) : ?>
									<span
										class="tweet-date"><?php echo date( 'F d, Y', strtotime( $tweet['created_at'] ) ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php } ?>

			</div>

			<?php if ( $is_swiper === true ) { ?>
		</div>
	</div>
<?php } ?>
</div>
