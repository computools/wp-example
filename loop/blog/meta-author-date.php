<div class="post-meta">
	<div class="post-author">
		<?php $author = get_the_author(); ?>
		<?php echo esc_html__( 'by', 'tm-moody' ) . ' <span class="author heading-color">' . $author . '</span>' ?>
	</div>

	<div
		class="post-date">/ <?php echo get_the_date( 'F d, Y' ); ?></div>
</div>
