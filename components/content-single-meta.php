<div class="post-meta">
	<div class="post-meta-left">
		<?php if ( Insight::setting( 'single_post_meta_date_enable' ) === '1' ) : ?>
			<div class="post-meta-item post-date style-1"><?php echo get_the_date( 'F d, Y' ); ?></div>
		<?php endif; ?>
		<?php if ( Insight::setting( 'single_post_meta_author_enable' ) === '1' ) : ?>
			<div class="post-meta-item post-author">
				<i class="fa fa-user"></i>
				<?php the_author_posts_link(); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="post-meta-right">
		<?php if ( Insight::setting( 'single_post_meta_like_enable' ) === '1' && get_post_type() === 'post' ) : ?>
			<span class="post-likes">
				<?php
				$insight_post_like = new Insight_Post_Like();
				$insight_post_like->get_simple_likes_button( get_the_ID() );
				?>
			</span>
		<?php endif; ?>
		<?php if ( Insight::setting( 'single_post_meta_share_enable' ) === '1' ) : ?>
			<?php Insight_Templates::post_sharing(); ?>
		<?php endif; ?>
	</div>
</div>
