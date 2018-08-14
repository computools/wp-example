<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_audio'] ) ) {
	$audio = $post_options['post_audio'];
	?>
	<?php if ( strrpos( $audio, '.mp3' ) !== false ) { ?>
		<?php echo do_shortcode( '[audio mp3="' . $audio . '"][/audio]' ); ?>
	<?php } else { ?>
		<div class="post-feature post-audio">
			<?php if ( wp_oembed_get( $audio ) ) { ?>
				<?php echo Insight_Helper::w3c_iframe( wp_oembed_get( $audio ) ); ?>
			<?php } ?>
		</div>
	<?php }
} ?>
