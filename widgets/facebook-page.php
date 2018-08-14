<?php
if ( ! class_exists( 'TM_Facebook_Page_Widget' ) ) {
	class TM_Facebook_Page_Widget extends Insight_Widget {

		public function __construct() {
			$this->widget_cssclass    = 'facebook_like';
			$this->widget_description = esc_html__( 'Adds support for Facebook Page Plugin.', 'tm-moody' );
			$this->widget_id          = 'facebook-like-widget';
			$this->widget_name        = esc_html__( '[Insight] Facebook Page Plugin', 'tm-moody' );
			$this->settings           = array(
				'title'        => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Find us on Facebook', 'tm-moody' ),
					'label' => esc_html__( 'Title', 'tm-moody' ),
				),
				'page_url'     => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Facebook Page Url', 'tm-moody' ),
				),
				'app_id'       => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Facebook App ID', 'tm-moody' ),
					'desc'  => sprintf( wp_kses( __( 'IMPORTANT: Please create a Facebook App and use its ID for features like sharing. <a href="%s" target="_blank">See Instructions</a>', 'tm-moody' ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) ), esc_url( 'https://developers.facebook.com/docs/apps/register' ) ),
				),
				'width'        => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 180,
					'max'   => 500,
					'std'   => 268,
					'label' => esc_html__( 'Width (has to be between 180 and 500)', 'tm-moody' ),
				),
				'show_faces'   => array(
					'type'  => 'checkbox',
					'std'   => 1,
					'label' => esc_html__( 'Show Friends Faces', 'tm-moody' ),
				),
				'show_stream'  => array(
					'type'  => 'checkbox',
					'std'   => 0,
					'label' => esc_html__( 'Show Posts', 'tm-moody' ),
				),
				'show_header'  => array(
					'type'  => 'checkbox',
					'std'   => 0,
					'label' => esc_html__( 'Show Cover Photo', 'tm-moody' ),
				),
				'small_header' => array(
					'type'  => 'checkbox',
					'std'   => 0,
					'label' => esc_html__( 'Use Small Header', 'tm-moody' ),
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			$page_url     = isset( $instance['page_url'] ) ? $instance['page_url'] : $this->settings['page_url']['std'];
			$app_id       = isset( $instance['app_id'] ) ? $instance['app_id'] : $this->settings['app_id']['std'];
			$widget_width = isset( $instance['width'] ) ? $instance['width'] : $this->settings['app_id']['std'];
			$show_faces   = isset( $instance['show_faces'] ) && $instance['show_faces'] === 1 ? 'true' : 'false';
			$show_stream  = isset( $instance['show_stream'] ) && $instance['show_stream'] === 1 ? 'true' : 'false';
			$show_header  = isset( $instance['show_header'] ) && $instance['show_header'] === 1 ? 'false' : 'true';
			$small_header = isset( $instance['small_header'] ) && $instance['small_header'] === 1 ? 'true' : 'false';
			$height       = '65';

			$height = ( 'true' === $show_faces ) ? '240' : $height;
			$height = ( 'true' === $show_stream ) ? '515' : $height;
			$height = ( 'true' === $show_stream && 'true' === $show_faces && 'true' === $show_header ) ? '540' : $height;
			$height = ( 'true' === $show_stream && 'true' === $show_faces && 'false' === $show_header ) ? '540' : $height;
			$height = ( 'true' === $show_header ) ? $height + 30 : $height;

			$this->widget_start( $args, $instance );

			if ( $page_url ) :
				$language = get_locale();
				if ( ! $language ) {
					$language = 'en_EN';
				}
				?>
				<script>
					(
						function( d, s, id ) {
							var js, fjs = d.getElementsByTagName( s )[ 0 ];
							if ( d.getElementById( id ) ) {
								return;
							}
							js = d.createElement( s );
							js.id = id;
							js.src = "<?php echo '//connect.facebook.net/' . $language . '/sdk.js#xfbml=1&version=v2.6&appId=' . $app_id; ?>";
							fjs.parentNode.insertBefore( js, fjs );
						}( document, 'script', 'facebook-jssdk' )
					);

					window.fbAsyncInit = function() {
						fusion_resize_page_widget();

						jQuery( window ).resize( function() {
							fusion_resize_page_widget();
						} );

						function fusion_resize_page_widget() {
							var $container_width = jQuery( '.<?php echo esc_js( $args['widget_id'] ); ?>' ).width();

							if ( $container_width != jQuery( '.<?php echo esc_js( $args['widget_id'] ); ?> .fb-page' )
									.data( 'width' ) ) {
								jQuery( '<?php echo ".{$args['widget_id']} .fb-page"; ?>' )
									.attr( 'data-width', $container_width );
								FB.XFBML.parse();
							}
						}
					}
				</script>

				<div class="fb-like-box-container <?php echo esc_attr( $args['widget_id'] ); ?>" id="fb-root">
					<div class="fb-page"
					     data-href="<?php echo esc_url( $page_url ); ?>"
					     data-width="<?php echo esc_attr( $widget_width ); ?>"
					     data-adapt-container-width="true"
					     data-small-header="<?php echo esc_attr( $small_header ); ?>"
					     data-height="<?php echo esc_attr( $height ); ?>"
					     data-hide-cover="<?php echo esc_attr( $show_header ); ?>"
					     data-show-facepile="<?php echo esc_attr( $show_faces ); ?>"
					     data-show-posts="<?php echo esc_attr( $show_stream ); ?>"></div>
				</div>
			<?php endif;

			$this->widget_end( $args );
		}
	}
}
