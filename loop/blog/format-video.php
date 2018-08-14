<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_video'] ) ) {
	$video = $post_options['post_video'];
	?>
	<div class="post-video embed-responsive-16by9 embed-responsive">
		<?php if ( wp_oembed_get( $video ) ) { ?>
			<?php echo Insight_Helper::w3c_iframe( wp_oembed_get( $video ) ); ?>
		<?php } else { ?>
			<?php Insight_Helper::w3c_iframe( $video ); ?>
		<?php } ?>
	</div>
<?php } ?>
