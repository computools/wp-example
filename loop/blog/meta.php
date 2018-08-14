<div class="post-meta">
	<div
		class="post-date heading-color"><?php echo get_the_date( 'F d, Y' ); ?></div>
	<?php if ( has_category() ) : ?>
		<?php echo esc_html__( 'in', 'tm-moody' ) . ' '; ?>
		<div class="post-categories">
			<?php the_category( ', ' ); ?>
		</div>
	<?php endif; ?>
</div>
