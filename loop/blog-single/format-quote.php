<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_quote_text'] ) && $post_options['post_quote_text'] !== '' ) {
	$text = $post_options['post_quote_text'];
	$name = isset( $post_options['post_quote_name'] ) ? $post_options['post_quote_name'] : '';
	$url  = isset( $post_options['post_quote_url'] ) ? $post_options['post_quote_url'] : '';
	?>
	<div class="post-feature post-quote">
		<h3 class="post-quote-text"><?php echo esc_html( '&ldquo;' . $text . '&rdquo;' ); ?></h3>
		<?php if ( $name !== '' ) { ?>
			<h6 class="post-quote-name">
				<?php if ( $url !== '' ) { ?>
					<a href="<?php echo esc_url( $url ); ?>" target="_blank"><?php echo esc_html( $name ); ?></a>
				<?php } else { ?>
					<?php echo esc_html( $name ); ?>
				<?php } ?>
			</h6>
		<?php } ?>
	</div>
<?php } ?>
