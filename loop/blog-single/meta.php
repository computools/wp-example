<div class="post-meta">
	<?php if ( Insight::setting( 'single_post_date_enable' ) === '1' ) : ?>
		<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
	<?php endif; ?>
	<?php if ( Insight::setting( 'single_post_categories_enable' ) === '1' && has_category() ) : ?>
		<?php echo esc_html__( 'in', 'tm-moody' ) . ' '; ?>
		<div class="post-categories"><?php the_category( ', ' ); ?></div>
	<?php endif; ?>
</div>
