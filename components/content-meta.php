<div class="post-meta">
	<div class="post-meta-left">
		<?php if ( Insight::setting( 'single_post_meta_date_enable' ) === '1' ) : ?>
			<span class="post-date style-1"><?php echo get_the_date( 'F d, Y' ); ?></span>
		<?php endif; ?>
		<?php if ( Insight::setting( 'single_post_meta_author_enable' ) === '1' ) : ?>
			<span class="post-author">
				<i class="fa fa-user"></i>
				<span class="author vcard"><?php echo esc_html( get_the_author() ); ?></span>
			</span>
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
		<?php if ( Insight::setting( 'single_post_meta_comments_number_enable' ) === '1' ) : ?>
			<span class="post-comments-number"><i
					class="fa fa-comment-o"></i><?php echo get_comments_number(); ?></span>
		<?php endif; ?>
	</div>
</div>
